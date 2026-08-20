<?php
/*
 * Elaborazione lato server del modulo di contatto.
 *
 * Flusso: verifica del metodo HTTP -> validazione -> inserimento con
 * istruzione preparata -> pagina di esito.
 *
 * Nota sulla sanitizzazione: i dati vengono salvati nel database cosi'
 * come l'utente li ha scritti, e l'escaping HTML avviene soltanto al
 * momento di stamparli a video. Applicarlo anche in ingresso salverebbe
 * nel database entita' HTML al posto dei caratteri reali: un cognome come
 * "Sant'Angelo" verrebbe memorizzato come "Sant&#039;Angelo" e ristampato
 * come "Sant&amp;#039;Angelo". La regola e' "escape all'output, una volta sola".
 */

$active = 'contatti';

// Un accesso diretto via URL (GET) non ha dati da elaborare: si torna al modulo.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contatti.php', true, 303);
    exit;
}

$successo = false;
$errore   = '';

// ── Validazione ───────────────────────────────────────────────────────
// I dati restano grezzi: nessun escaping in questa fase.
$nome      = trim($_POST['nome']      ?? '');
$ente      = trim($_POST['ente']      ?? '');
$emailRaw  = trim($_POST['email']     ?? '');
$tipo      = trim($_POST['tipo']      ?? '');
$messaggio = trim($_POST['messaggio'] ?? '');

$email = filter_var($emailRaw, FILTER_VALIDATE_EMAIL);

if ($nome === '' || $messaggio === '') {
    $errore = 'Per favore compila tutti i campi obbligatori: nome, email e messaggio.';
} elseif ($email === false) {
    $errore = 'L\'indirizzo email inserito non sembra valido. Controllalo e riprova.';
} else {
    // ── Inserimento con istruzione preparata ──────────────────────────
    // I segnaposto "?" tengono separati comandi SQL e dati utente:
    // il contenuto dei campi non puo' essere interpretato come SQL.
    $cfg = require 'config-db.php';

    // Con PHP 8.1+ mysqli segnala gli errori sollevando eccezioni: senza
    // un try/catch un errore di connessione stamperebbe a video una
    // traccia contenente i parametri del database.
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $conn = new mysqli($cfg['host'], $cfg['user'], $cfg['password'], $cfg['dbname']);
        $conn->set_charset($cfg['charset']);

        $stmt = $conn->prepare(
            'INSERT INTO contatti (nome, ente, email, tipo, messaggio) VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->bind_param('sssss', $nome, $ente, $email, $tipo, $messaggio);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        $successo = true;
    } catch (mysqli_sql_exception $e) {
        // All'utente un messaggio generico, il dettaglio tecnico nel log
        // del server: i messaggi del DBMS rivelano struttura e credenziali.
        error_log('[algora] inserimento contatto fallito: ' . $e->getMessage());
        $errore = 'Non siamo riusciti a registrare la richiesta per un problema tecnico. '
                . 'Riprova fra qualche minuto oppure scrivici a info@algorastudio.it.';
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $successo ? 'Richiesta inviata' : 'Invio non riuscito' ?> — Algora Studio</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<a class="skip-link" href="#contenuto">Vai al contenuto</a>

<?php include 'nav.php'; ?>

<main id="contenuto">

<section class="esito-section">
  <div class="esito-card">
    <?php if ($successo): ?>
      <p class="label msg-success">Messaggio ricevuto</p>
      <h1 class="mt-10">Grazie, <?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>!</h1>
      <p class="mt-15 text-mid">
        La tua richiesta<?= $ente !== '' ? ' per ' . htmlspecialchars($ente, ENT_QUOTES, 'UTF-8') : '' ?>
        è stata registrata correttamente.
      </p>
      <p class="mt-10 text-mid">
        Ti rispondiamo all'indirizzo
        <em><?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></em>
        entro 24 ore lavorative.
      </p>
      <a href="index.php" class="btn btn-dark mt-25">Torna alla home</a>
    <?php else: ?>
      <p class="label msg-error">Invio non riuscito</p>
      <h1 class="mt-10">Si è verificato un problema</h1>
      <p class="mt-15 text-mid"><?= htmlspecialchars($errore, ENT_QUOTES, 'UTF-8') ?></p>
      <a href="contatti.php" class="btn btn-outline mt-25">Torna al modulo</a>
    <?php endif; ?>
  </div>
</section>

</main>

<?php include 'footer.php'; ?>

<script src="main.js"></script>
</body>
</html>
