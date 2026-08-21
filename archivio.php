<?php
/*
 * Area riservata — gestione dell'archivio dei contatti.
 *
 * Il modulo pubblico (contatti.php -> invia-contatto.php) sa fare una sola
 * delle quattro operazioni fondamentali su una tabella: l'inserimento.
 * Questa pagina completa il quadro con le altre tre — lettura, modifica ed
 * eliminazione — in un'unica schermata a uso di chi gestisce il sito.
 *
 * Scelte di impianto, tutte volutamente minime:
 *
 *  - un solo file. Le tre viste (elenco, modifica, conferma eliminazione)
 *    sono rami della stessa pagina: cosi' la sequenza richiesta -> azione
 *    -> risposta resta leggibile dall'alto in basso senza rimbalzare fra
 *    sorgenti diversi;
 *
 *  - le operazioni che cambiano i dati viaggiano solo in POST. Un
 *    collegamento in GET viene seguito dai crawler e ripetuto dal tasto
 *    "aggiorna" del browser: un archivio non puo' dipendere da questo.
 *    I collegamenti "Modifica" ed "Elimina" in GET non toccano nulla,
 *    aprono soltanto la vista corrispondente;
 *
 *  - dopo ogni scrittura si risponde con un redirect 303 (schema
 *    Post/Redirect/Get): ricaricare la pagina di esito non riesegue
 *    l'operazione;
 *
 *  - ogni interrogazione passa da un'istruzione preparata, e ogni dato
 *    stampato a video passa da htmlspecialchars(). Le stesse due regole
 *    di invia-contatto.php: parametri separati dal comando SQL in
 *    ingresso, escaping una volta sola in uscita.
 *
 * Nota sull'autenticazione: una password unica condivisa, confrontata con
 * la sua impronta bcrypt, e' il minimo sindacale — sufficiente per un
 * pannello dimostrativo su una singola postazione, non per un archivio in
 * produzione, che richiederebbe utenze nominali, HTTPS obbligatorio,
 * limitazione dei tentativi e registro degli accessi.
 */

session_start();

$active   = '';   // nessuna voce del menu corrisponde a questa pagina
$cfgAdmin = require 'config-admin.php';

// Categorie proposte nel modulo pubblico: qui servono per la stessa
// tendina, in modo che i valori salvati restino gli stessi.
$TIPI = [
    'Archivio di Stato',
    'Archivio storico comunale',
    'Studio notarile',
    'Genealogista professionista',
    'Fondazione culturale',
    'Università / Centro di ricerca',
    'Altro',
];

/*
 * Token anti-CSRF.
 *
 * Senza, una pagina ostile aperta in un'altra scheda potrebbe inviare di
 * nascosto un POST a questo indirizzo: il browser vi allegherebbe il
 * cookie di sessione e l'eliminazione andrebbe a buon fine. Il token e'
 * noto solo alla sessione e viene ricopiato in ogni modulo: una pagina di
 * terzi non puo' leggerlo.
 */
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

/** Escaping per l'output: usato a ogni stampa di dato proveniente dal DB. */
function h(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}

/** Connessione al database, con gli stessi parametri del modulo pubblico. */
function apriConnessione(): mysqli
{
    $cfg = require __DIR__ . '/config-db.php';

    // Con PHP 8.1+ mysqli solleva eccezioni invece di restituire false:
    // gli errori vengono raccolti dal try/catch di chi chiama.
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $conn = new mysqli($cfg['host'], $cfg['user'], $cfg['password'], $cfg['dbname']);
    $conn->set_charset($cfg['charset']);

    return $conn;
}

/** Messaggio da mostrare dopo il redirect e ritorno alla pagina (303). */
function rimanda(string $testo = '', string $tipo = 'ok', string $query = ''): never
{
    if ($testo !== '') {
        $_SESSION['avviso'] = ['testo' => $testo, 'tipo' => $tipo];
    }
    header('Location: archivio.php' . $query, true, 303);
    exit;
}

/**
 * Legge e valida i campi comuni a inserimento e modifica.
 * Restituisce [dati grezzi, messaggio di errore]; l'errore vuoto significa
 * che i dati sono utilizzabili.
 */
function leggiCampi(): array
{
    $dati = [
        'nome'      => trim($_POST['nome']      ?? ''),
        'ente'      => trim($_POST['ente']      ?? ''),
        'email'     => trim($_POST['email']     ?? ''),
        'tipo'      => trim($_POST['tipo']      ?? ''),
        'messaggio' => trim($_POST['messaggio'] ?? ''),
        // Una casella non spuntata non viene inviata affatto: l'assenza
        // della chiave e' essa stessa il valore "no".
        'consenso'  => isset($_POST['consenso']) ? 1 : 0,
    ];

    $errore = '';
    if ($dati['nome'] === '' || $dati['messaggio'] === '') {
        $errore = 'Nome e messaggio sono obbligatori.';
    } elseif (filter_var($dati['email'], FILTER_VALIDATE_EMAIL) === false) {
        $errore = 'L\'indirizzo email non è valido.';
    }

    return [$dati, $errore];
}

$autenticato = !empty($_SESSION['archivio_admin']);

// ══════════════════════════════════════════════════════════════════════
//  AZIONI (POST)
// ══════════════════════════════════════════════════════════════════════
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $azione = $_POST['azione'] ?? '';

    // ── Accesso ───────────────────────────────────────────────────────
    if ($azione === 'accedi') {
        if (password_verify($_POST['password'] ?? '', $cfgAdmin['password_hash'])) {
            // Rigenerare l'identificativo al cambio di privilegi impedisce
            // il "session fixation": un identificativo eventualmente
            // imposto prima dell'accesso non vale piu' nulla.
            session_regenerate_id(true);
            $_SESSION['archivio_admin'] = true;
            rimanda();
        }
        // Messaggio unico e generico: non si conferma mai a un estraneo
        // quale meta' della credenziale ha indovinato.
        rimanda('Password non riconosciuta.', 'errore');
    }

    // Da qui in poi si scrive sull'archivio: servono sessione valida e token.
    if (!$autenticato) {
        rimanda('Sessione scaduta: accedi di nuovo.', 'errore');
    }

    // hash_equals confronta in tempo costante, senza fermarsi al primo
    // carattere diverso: il tempo di risposta non rivela quanto ci si e'
    // avvicinati al token.
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        rimanda('Richiesta non valida (token mancante o scaduto).', 'errore');
    }

    // ── Uscita ────────────────────────────────────────────────────────
    if ($azione === 'esci') {
        $_SESSION = [];
        session_destroy();
        rimanda();
    }

    $id = (int) ($_POST['id'] ?? 0);

    try {
        $conn = apriConnessione();

        switch ($azione) {

            // ── CREATE ────────────────────────────────────────────────
            case 'crea':
                [$dati, $errore] = leggiCampi();
                if ($errore !== '') {
                    // I valori digitati tornano indietro con l'errore:
                    // nessuno deve riscrivere il modulo da capo.
                    $_SESSION['bozza'] = $dati;
                    rimanda($errore, 'errore');
                }

                $stmt = $conn->prepare(
                    'INSERT INTO contatti (nome, ente, email, tipo, messaggio,
                                           consenso_privacy, data_consenso)
                     VALUES (?, ?, ?, ?, ?, ?, IF(? = 1, NOW(), NULL))'
                );
                $stmt->bind_param(
                    'sssssii',
                    $dati['nome'], $dati['ente'], $dati['email'],
                    $dati['tipo'], $dati['messaggio'],
                    $dati['consenso'], $dati['consenso']
                );
                $stmt->execute();
                $stmt->close();
                $conn->close();

                rimanda('Richiesta inserita nell\'archivio.');

            // ── UPDATE ────────────────────────────────────────────────
            case 'aggiorna':
                [$dati, $errore] = leggiCampi();
                if ($errore !== '') {
                    $_SESSION['bozza'] = $dati;
                    rimanda($errore, 'errore', '?azione=modifica&id=' . $id);
                }

                // La data del consenso non si riscrive a ogni salvataggio:
                // se il consenso c'era gia', si conserva il momento in cui
                // e' stato prestato (art. 7 GDPR); se viene revocato, il
                // campo torna vuoto.
                $stmt = $conn->prepare(
                    'UPDATE contatti
                        SET nome = ?, ente = ?, email = ?, tipo = ?, messaggio = ?,
                            consenso_privacy = ?,
                            data_consenso = IF(? = 1, COALESCE(data_consenso, NOW()), NULL)
                      WHERE id = ?'
                );
                $stmt->bind_param(
                    'sssssiii',
                    $dati['nome'], $dati['ente'], $dati['email'],
                    $dati['tipo'], $dati['messaggio'],
                    $dati['consenso'], $dati['consenso'], $id
                );
                $stmt->execute();
                $stmt->close();
                $conn->close();

                rimanda('Richiesta n. ' . $id . ' aggiornata.');

            // ── DELETE ────────────────────────────────────────────────
            case 'elimina':
                $stmt = $conn->prepare('DELETE FROM contatti WHERE id = ?');
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $eliminate = $stmt->affected_rows;
                $stmt->close();
                $conn->close();

                rimanda(
                    $eliminate > 0
                        ? 'Richiesta n. ' . $id . ' eliminata definitivamente.'
                        : 'Nessuna richiesta con numero ' . $id . '.',
                    $eliminate > 0 ? 'ok' : 'errore'
                );

            default:
                $conn->close();
                rimanda('Operazione sconosciuta.', 'errore');
        }
    } catch (mysqli_sql_exception $e) {
        // Il dettaglio tecnico va nel log del server: i messaggi del DBMS
        // descrivono la struttura del database a chiunque li legga.
        error_log('[algora] archivio, operazione "' . $azione . '" fallita: ' . $e->getMessage());
        rimanda('Operazione non riuscita per un problema tecnico sul database.', 'errore');
    }
}

// ══════════════════════════════════════════════════════════════════════
//  LETTURA (GET)
// ══════════════════════════════════════════════════════════════════════
$avviso = $_SESSION['avviso'] ?? null;
$bozza  = $_SESSION['bozza']  ?? null;
unset($_SESSION['avviso'], $_SESSION['bozza']);

$vuoto = ['nome' => '', 'ente' => '', 'email' => '', 'tipo' => '',
          'messaggio' => '', 'consenso' => 1];

$vista     = 'elenco';
$contatti  = [];
$scheda    = null;              // riga su cui si sta lavorando
$erroreDb  = '';

if ($autenticato) {
    $azione = $_GET['azione'] ?? '';
    $id     = (int) ($_GET['id'] ?? 0);

    try {
        $conn = apriConnessione();

        if (($azione === 'modifica' || $azione === 'elimina') && $id > 0) {
            $stmt = $conn->prepare('SELECT * FROM contatti WHERE id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $scheda = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            if ($scheda === null) {
                $avviso = ['testo' => 'La richiesta n. ' . $id . ' non esiste più.', 'tipo' => 'errore'];
            } else {
                $vista = $azione;
            }
        }

        if ($vista === 'elenco') {
            // Nessun parametro dall'esterno: query diretta, la piu' recente
            // in cima.
            $ris = $conn->query('SELECT * FROM contatti ORDER BY data_invio DESC, id DESC');
            $contatti = $ris->fetch_all(MYSQLI_ASSOC);
            $ris->free();
        }

        $conn->close();
    } catch (mysqli_sql_exception $e) {
        error_log('[algora] archivio, lettura fallita: ' . $e->getMessage());
        $erroreDb = 'Archivio non raggiungibile: verifica che il server MySQL sia avviato '
                  . 'e che il database sia stato creato con crea_db.sql.';
    }
}

/** Campi del contatto, condivisi da inserimento e modifica. */
function campiContatto(array $d, array $tipi): void
{ ?>
  <div class="form-row">
    <div class="form-group">
      <label for="nome">Nome e cognome</label>
      <input type="text" id="nome" name="nome" value="<?= h($d['nome']) ?>" required>
    </div>
    <div class="form-group">
      <label for="ente">Ente / Studio</label>
      <input type="text" id="ente" name="ente" value="<?= h($d['ente']) ?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= h($d['email']) ?>" required>
    </div>
    <div class="form-group">
      <label for="tipo">Categoria</label>
      <select id="tipo" name="tipo">
        <option value="">Non indicata</option>
        <?php foreach ($tipi as $t): ?>
          <option<?= $d['tipo'] === $t ? ' selected' : '' ?>><?= h($t) ?></option>
        <?php endforeach; ?>
        <?php /* Un valore salvato in passato e non piu' in elenco resta
                 comunque selezionabile: la modifica non deve alterarlo di
                 nascosto. */ ?>
        <?php if ($d['tipo'] !== '' && !in_array($d['tipo'], $tipi, true)): ?>
          <option selected><?= h($d['tipo']) ?></option>
        <?php endif; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="messaggio">Messaggio</label>
    <textarea id="messaggio" name="messaggio" required><?= h($d['messaggio']) ?></textarea>
  </div>
  <div class="form-consenso">
    <input type="checkbox" id="consenso" name="consenso" value="1"<?= $d['consenso'] ? ' checked' : '' ?>>
    <label for="consenso">Consenso al trattamento dei dati prestato dall'interessato</label>
  </div>
<?php }
?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Archivio contatti — Algora Studio</title>
<?php /* Una pagina di servizio non ha ragione di comparire nei motori di ricerca. */ ?>
<meta name="robots" content="noindex, nofollow">
<link rel="icon" href="favicon.ico" sizes="any">
<link rel="icon" href="img/marchi/favicon-32.png" type="image/png" sizes="32x32">
<link rel="apple-touch-icon" href="img/marchi/apple-touch-icon.png">
<link rel="manifest" href="site.webmanifest">
<meta name="theme-color" content="#F4EFE4">
<link rel="stylesheet" href="style.css">
</head>
<body>

<a class="skip-link" href="#contenuto">Vai al contenuto</a>

<?php include 'nav.php'; ?>

<main id="contenuto">

<section class="area-riservata">

  <?php if ($avviso !== null): ?>
    <?php /* role="status" fa annunciare il messaggio dai lettori di schermo
             appena la pagina si carica, senza rubare il focus. */ ?>
    <p class="ar-avviso ar-avviso-<?= $avviso['tipo'] === 'errore' ? 'errore' : 'ok' ?>" role="status">
      <?= h($avviso['testo']) ?>
    </p>
  <?php endif; ?>

<?php if (!$autenticato): ?>

  <!-- ── ACCESSO ──────────────────────────────────────────────────── -->
  <div class="ar-accesso">
    <p class="label">Area riservata</p>
    <h1 class="mt-10">Archivio contatti</h1>
    <p class="mt-15 text-mid">
      Le richieste raccolte dal modulo pubblico. L'accesso è riservato a chi gestisce il sito.
    </p>
    <form method="POST" action="archivio.php" class="mt-25">
      <input type="hidden" name="azione" value="accedi">
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" autocomplete="current-password" required>
      </div>
      <button type="submit" class="form-submit">Entra</button>
    </form>
  </div>

<?php elseif ($erroreDb !== ''): ?>

  <div class="ar-accesso">
    <p class="label msg-error">Archivio non disponibile</p>
    <h1 class="mt-10">Nessuna connessione</h1>
    <p class="mt-15 text-mid"><?= h($erroreDb) ?></p>
  </div>

<?php elseif ($vista === 'modifica'): ?>

  <!-- ── MODIFICA ─────────────────────────────────────────────────── -->
  <div class="ar-scheda">
    <p class="label">Richiesta n. <?= (int) $scheda['id'] ?></p>
    <h1 class="mt-10">Modifica</h1>
    <p class="mt-10 text-mid">
      Ricevuta il <?= h(date('d/m/Y \a\l\l\e H:i', strtotime($scheda['data_invio']))) ?>.
    </p>

    <form method="POST" action="archivio.php" class="mt-25">
      <input type="hidden" name="azione" value="aggiorna">
      <input type="hidden" name="id" value="<?= (int) $scheda['id'] ?>">
      <input type="hidden" name="csrf" value="<?= h($_SESSION['csrf']) ?>">
      <?php
        // Se il salvataggio precedente e' stato respinto, in pagina tornano
        // i valori digitati; altrimenti quelli in archivio.
        campiContatto($bozza ?? [
            'nome'      => $scheda['nome'],
            'ente'      => $scheda['ente'],
            'email'     => $scheda['email'],
            'tipo'      => $scheda['tipo'],
            'messaggio' => $scheda['messaggio'],
            'consenso'  => (int) $scheda['consenso_privacy'],
        ], $TIPI);
      ?>
      <button type="submit" class="form-submit">Salva le modifiche</button>
    </form>
    <a href="archivio.php" class="btn btn-outline btn-block mt-15">Annulla</a>
  </div>

<?php elseif ($vista === 'elimina'): ?>

  <!-- ── CONFERMA ELIMINAZIONE ────────────────────────────────────── -->
  <?php /* La conferma e' una pagina a se' e non una finestra di dialogo del
           browser: funziona anche senza JavaScript, e mostra per esteso il
           dato che sta per sparire. */ ?>
  <div class="ar-scheda">
    <p class="label msg-error">Eliminazione</p>
    <h1 class="mt-10">Confermi?</h1>
    <p class="mt-15 text-mid">
      Stai per eliminare definitivamente la richiesta n. <?= (int) $scheda['id'] ?>
      di <strong><?= h($scheda['nome']) ?></strong>
      (<?= h($scheda['email']) ?>), ricevuta il
      <?= h(date('d/m/Y', strtotime($scheda['data_invio']))) ?>.
      L'operazione non è reversibile.
    </p>
    <blockquote class="ar-messaggio mt-15"><?= nl2br(h($scheda['messaggio'])) ?></blockquote>

    <form method="POST" action="archivio.php" class="mt-25">
      <input type="hidden" name="azione" value="elimina">
      <input type="hidden" name="id" value="<?= (int) $scheda['id'] ?>">
      <input type="hidden" name="csrf" value="<?= h($_SESSION['csrf']) ?>">
      <button type="submit" class="form-submit ar-elimina">Elimina definitivamente</button>
    </form>
    <a href="archivio.php" class="btn btn-outline btn-block mt-15">Annulla</a>
  </div>

<?php else: ?>

  <!-- ── ELENCO ───────────────────────────────────────────────────── -->
  <div class="ar-testata">
    <div>
      <p class="label">Area riservata</p>
      <h1 class="mt-10">Archivio contatti</h1>
      <p class="mt-10 text-mid">
        <?= count($contatti) ?>
        <?= count($contatti) === 1 ? 'richiesta registrata' : 'richieste registrate' ?>.
      </p>
    </div>
    <form method="POST" action="archivio.php">
      <input type="hidden" name="azione" value="esci">
      <input type="hidden" name="csrf" value="<?= h($_SESSION['csrf']) ?>">
      <button type="submit" class="btn btn-outline">Esci</button>
    </form>
  </div>

  <?php if ($contatti === []): ?>
    <p class="ar-vuoto">Nessuna richiesta in archivio: le prime arriveranno dal modulo di contatto.</p>
  <?php else: ?>
    <?php /* La tabella non si comprime sotto una certa larghezza: su schermo
             stretto scorre orizzontalmente dentro il proprio contenitore,
             che e' focalizzabile da tastiera per poterlo scorrere senza mouse. */ ?>
    <div class="ar-tabella-wrap" tabindex="0" role="region" aria-label="Elenco delle richieste">
      <table class="ar-tabella">
        <caption>Richieste di contatto, dalla più recente</caption>
        <thead>
          <tr>
            <th scope="col">N.</th>
            <th scope="col">Ricevuta</th>
            <th scope="col">Nome</th>
            <th scope="col">Ente</th>
            <th scope="col">Email</th>
            <th scope="col">Categoria</th>
            <th scope="col">Messaggio</th>
            <th scope="col">Consenso</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($contatti as $c): ?>
          <tr>
            <td><?= (int) $c['id'] ?></td>
            <td class="ar-quando"><?= h(date('d/m/Y H:i', strtotime($c['data_invio']))) ?></td>
            <td><?= h($c['nome']) ?></td>
            <td><?= $c['ente'] !== '' && $c['ente'] !== null ? h($c['ente']) : '—' ?></td>
            <td><a href="mailto:<?= h($c['email']) ?>"><?= h($c['email']) ?></a></td>
            <td><?= $c['tipo'] !== '' && $c['tipo'] !== null ? h($c['tipo']) : '—' ?></td>
            <td class="ar-estratto">
              <?php
                // In elenco basta l'inizio del messaggio: il testo completo
                // e' nella vista di modifica.
                $testo = trim(preg_replace('/\s+/u', ' ', $c['messaggio']));
                echo h(mb_strimwidth($testo, 0, 90, '…', 'UTF-8'));
              ?>
            </td>
            <td>
              <?php if ((int) $c['consenso_privacy'] === 1): ?>
                <span class="ar-si">sì</span>
                <?php if ($c['data_consenso'] !== null): ?>
                  <span class="ar-data"><?= h(date('d/m/Y', strtotime($c['data_consenso']))) ?></span>
                <?php endif; ?>
              <?php else: ?>
                <span class="ar-no">no</span>
              <?php endif; ?>
            </td>
            <td class="ar-azioni">
              <a href="archivio.php?azione=modifica&amp;id=<?= (int) $c['id'] ?>">Modifica</a>
              <a href="archivio.php?azione=elimina&amp;id=<?= (int) $c['id'] ?>" class="ar-link-elimina">Elimina</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php /* Il suggerimento riguarda solo lo schermo stretto, dove la tabella
             scorre: il foglio di stile lo nasconde da 961px in su. */ ?>
    <p class="ar-scorri">Scorri la tabella lateralmente per vedere tutte le colonne.</p>
  <?php endif; ?>

  <!-- ── INSERIMENTO ──────────────────────────────────────────────── -->
  <div class="ar-nuovo">
    <p class="label mb-16">Nuova richiesta</p>
    <p class="text-mid mb-24">
      Per annotare a mano una richiesta arrivata per telefono o di persona.
      Il consenso va spuntato solo se l'interessato lo ha effettivamente prestato.
    </p>
    <form method="POST" action="archivio.php">
      <input type="hidden" name="azione" value="crea">
      <input type="hidden" name="csrf" value="<?= h($_SESSION['csrf']) ?>">
      <?php campiContatto($bozza ?? $vuoto, $TIPI); ?>
      <button type="submit" class="form-submit">Inserisci in archivio</button>
    </form>
  </div>

<?php endif; ?>

</section>

</main>

<?php include 'footer.php'; ?>

<script src="main.js"></script>
</body>
</html>
