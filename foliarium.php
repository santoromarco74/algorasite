<?php $active = 'foliarium'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Foliarium — Gestione Archivi Catastali Storici | Algora Studio</title>
<meta name="description" content="Foliarium è il software desktop per la gestione e consultazione degli archivi catastali storici italiani. Sviluppato da Algora Studio.">
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

<!-- HERO PRODOTTO -->
<header class="prod-hero">
  <p class="label mb-20">Un prodotto Algora Studio</p>
  <div class="prod-hero-inner">
    <div class="ph-left fade-up">
      <?php /* alt vuoto: il marchio ripete il nome del prodotto e la sua
               descrizione, entrambi presenti come testo qui sotto. Con un alt
               descrittivo un lettore di schermo annuncerebbe "Foliarium" due
               volte di seguito. */ ?>
      <img class="ph-marchio" src="img/marchi/foliarium-logo.png" alt=""
           width="800" height="308" fetchpriority="high" decoding="async">
      <div class="ph-badge"><span>Versione 1.5 — Attivo</span></div>
      <h1>Foliarium</h1>
      <p class="ph-tagline">dove il tempo incontra i dati</p>
      <p class="desc">Sistema completo per la digitalizzazione, gestione e consultazione degli archivi catastali storici italiani. Sviluppato da Algora Studio su commissione dell'Archivio di Stato di Savona, dove è in uso dalla versione 1.0.</p>
      <div class="btn-row">
        <a href="contatti.php" class="btn btn-dark">Richiedi demo gratuita</a>
        <a href="caso-studio.php" class="btn btn-outline">Caso Studio Savona</a>
      </div>
    </div>
    <div class="ph-right fade-up fade-up-2">
      <div class="pricing-card">
        <p class="pc-label">Prezzo di lancio</p>
        <div class="pc-price">€ 1.200</div>
        <p class="pc-price-note">+ IVA 22% · Licenza singola postazione</p>
        <ul class="pc-includes">
          <li>Installazione remota o on-site (vedi note)</li>
          <li>Database demo precaricato</li>
          <li>Manuale utente completo</li>
          <li>Aggiornamenti sicurezza 12 mesi</li>
          <li>Supporto avvio (prime 4 settimane)</li>
        </ul>
        <a href="contatti.php" class="btn btn-gold btn-block">Richiedi preventivo</a>
      </div>
    </div>
  </div>
</header>

<div class="strip">
  <span class="strip-item">Piattaforme: <strong>Windows · Linux · macOS</strong></span>
  <span class="strip-item">Database: <strong>PostgreSQL 15+</strong></span>
  <span class="strip-item">Interfaccia: <strong>Desktop nativa PyQt6</strong></span>
  <span class="strip-item">Cliente attivo: <strong>Archivio di Stato di Savona</strong></span>
</div>

<!-- FUNZIONALITÀ -->
<section class="features">
  <div class="feat-intro">
    <p class="label">Funzionalità</p>
    <h2>Costruito per la<br><em>complessità del catasto storico.</em></h2>
    <p>Foliarium non è un gestionale generico adattato. È un sistema progettato specificamente per le peculiarità degli archivi catastali italiani: denominazioni storiche, varianti grafiche dei cognomi, passaggi di proprietà su archi temporali di oltre un secolo.</p>
  </div>

  <div class="feat-grid">
    <div class="feat-card dark">
      <p class="feat-n">Ricerca</p>
      <h3>Fuzzy Search multi-entità</h3>
      <p>Algoritmo Levenshtein con soglia configurabile. Trova possessori e partite anche con errori di battitura, varianti ortografiche storiche dei cognomi, grafie alternative tipiche dei documenti dell'Ottocento.</p>
      <ul class="feat-detail">
        <li>Ricerca su tutti i campi contemporaneamente</li>
        <li>Filtro per tipo entità (Comune, Partita, Possessore)</li>
        <li>Soglia di similarità regolabile</li>
        <li>Esportazione risultati in CSV e PDF</li>
      </ul>
    </div>
    <div class="feat-card">
      <p class="feat-n">Genealogia</p>
      <h3>Albero delle proprietà</h3>
      <p>Ricostruisce automaticamente la catena completa dei passaggi di proprietà dal primo impianto catastale ad oggi. Ogni variazione è collegata all'atto notarile corrispondente.</p>
      <ul class="feat-detail">
        <li>Visualizzazione ascendente e discendente</li>
        <li>Contratti notarili: data, notaio, repertorio</li>
        <li>Trasferimenti parziali e volture complete</li>
        <li>Export report genealogico in PDF</li>
      </ul>
    </div>
    <div class="feat-card">
      <p class="feat-n">Gestione dati</p>
      <h3>Modello dati completo</h3>
      <p>Schema relazionale progettato per rappresentare fedelmente la struttura del catasto storico italiano: comuni con gestione storica dei nomi, partite, possessori, immobili, variazioni, contratti, consultazioni.</p>
      <ul class="feat-detail">
        <li>Workflow guidato per nuove partite</li>
        <li>Operazioni transazionali sicure</li>
        <li>Gestione suffissi e partite secondarie</li>
        <li>Import massivo da CSV</li>
      </ul>
    </div>
    <div class="feat-card dark">
      <p class="feat-n">Report</p>
      <h3>Reportistica archivistica</h3>
      <p>Generazione di report PDF e Excel con un click. Ogni output rispetta gli standard archivistici e include metadati di autenticità. Ideale per ricerche storiche, pratiche notarili e documentazione ufficiale.</p>
      <ul class="feat-detail">
        <li>Report di partita (dettaglio completo)</li>
        <li>Report possessore (anagrafica + patrimonio)</li>
        <li>Albero genealogico della proprietà</li>
        <li>Esportazione massiva per comune</li>
      </ul>
    </div>
    <div class="feat-card">
      <p class="feat-n">Sicurezza</p>
      <h3>Controllo accessi e audit</h3>
      <p>Gestione multi-utente con tre ruoli distinti. Ogni operazione viene registrata nell'audit trail in modo permanente e non modificabile — fondamentale per la compliance degli archivi pubblici.</p>
      <ul class="feat-detail">
        <li>Consultatore · Operatore · Amministratore</li>
        <li>Audit trail con JSON prima/dopo</li>
        <li>Log filtrabili per utente, data, operazione</li>
        <li>Sessioni tracciate con IP e applicazione</li>
      </ul>
    </div>
    <div class="feat-card">
      <p class="feat-n">Infrastruttura</p>
      <h3>Backup e manutenzione</h3>
      <p>Sistema integrato di backup e ripristino. Ottimizzazione database con viste materializzate. Suggerimenti automatici di manutenzione. Tutto accessibile dall'interfaccia senza competenze tecniche.</p>
      <ul class="feat-detail">
        <li>Backup completo con un click</li>
        <li>Ripristino guidato da file</li>
        <li>Aggiornamento viste materializzate</li>
        <li>Pulizia automatica log di sistema</li>
      </ul>
    </div>
  </div>
</section>


<!-- SCHERMATE -->
<section class="schermate">
  <div class="feat-intro">
    <p class="label mb-16">Schermate</p>
    <h2>Foliarium<br><em>in funzione.</em></h2>
    <p>Le immagini che seguono sono riprese dall'archivio dimostrativo che usiamo durante le demo: contiene dati storici reali della provincia di Savona, in quantità ridotta rispetto all'archivio in produzione.</p>
  </div>

  <div class="shot-grid">
    <figure class="shot">
      <img src="img/foliarium-cruscotto.png"
           alt="Schermata iniziale di Foliarium: una barra di ricerca rapida sull'intero catasto e quattro contatori — 69 comuni, 330 partite, 120 possessori, 660 immobili — seguiti dagli ultimi inserimenti e dal registro delle attività degli utenti."
           width="1915" height="1031" loading="lazy" decoding="async">
      <figcaption>Il quadro d'insieme all'apertura: quanto contiene l'archivio, che cosa è stato inserito di recente e chi vi ha lavorato.</figcaption>
    </figure>

    <figure class="shot">
      <img src="img/foliarium-ricerca-partite.png"
           alt="Elenco delle partite catastali, filtrabile per comune, numero e possessore. In primo piano la scheda della partita 3003 bis di Carcare, impiantata nel 1951, con il nome del possessore e le linguette per immobili, variazioni e documenti allegati."
           width="1917" height="1032" loading="lazy" decoding="async">
      <figcaption>Dalla ricerca alla scheda della singola partita, con possessori, immobili e variazioni raccolti in un'unica vista.</figcaption>
    </figure>

    <figure class="shot">
      <img src="img/foliarium-albero-genealogico.png"
           alt="Ricostruzione della storia di una proprietà: l'albero della partita 1001 di Savona mostra la partita che l'ha preceduta, estinta da una vendita del 1891. Accanto, il report testuale con intestatari, predecessori e successori."
           width="1908" height="996" loading="lazy" decoding="async">
      <figcaption>La catena delle variazioni ricostruita all'indietro nel tempo: è la ricerca che sui registri cartacei costava giorni di lavoro.</figcaption>
    </figure>

    <figure class="shot">
      <img src="img/foliarium-statistiche.png"
           alt="Tre grafici: le partite per comune nei primi dieci comuni, la quota di partite attive e inattive — 84,8 per cento contro 15,2 — e il numero di variazioni registrate anno per anno dal 1876 al 1984."
           width="1908" height="978" loading="lazy" decoding="async">
      <figcaption>Una lettura d'insieme del fondo archivistico, difficile da ricavare quando i dati stanno solo sui volumi.</figcaption>
    </figure>

    <figure class="shot">
      <img src="img/foliarium-esportazione.png"
           alt="La stessa selezione esportata in un foglio di calcolo: il registro dell'operazione riporta 33 partite, 12 possessori, 66 immobili e 9 variazioni, e il file aperto mostra la scheda delle partite con numero, stato e data di impianto."
           width="1910" height="999" loading="lazy" decoding="async">
      <figcaption>Ogni selezione può uscire dall'archivio in CSV, Excel o PDF, pronta per essere allegata a una risposta.</figcaption>
    </figure>
  </div>
</section>

<!-- LICENZE -->
<section class="licenze">
  <p class="label mb-16">Licenze software</p>
  <h2 class="mb-12">Scegli il tipo<br><em>di licenza.</em></h2>
  <p class="pricing-lead">La licenza è un acquisto una tantum che include installazione, onboarding e documentazione. Il canone di assistenza è separato e facoltativo.</p>

  <div class="lic-grid">
    <div class="lic-card">
      <p class="lic-name">Singola postazione</p>
      <div class="lic-price">€ 1.200</div>
      <p class="lic-note">+ IVA · una tantum</p>
      <p class="lic-desc">1 postazione. Ideale per studi professionali, genealogisti, piccoli archivi.</p>
      <p class="lic-upsell">Con assistenza Standard: <strong>€ 3.600</strong></p>
    </div>
    <div class="lic-card featured">
      <p class="lic-name">Multi-postazione</p>
      <div class="lic-price">€ 1.800</div>
      <p class="lic-note">+ IVA · una tantum · fino a 5 postazioni</p>
      <p class="lic-desc">Fino a 5 postazioni. Per studi strutturati e archivi con più operatori.</p>
      <p class="lic-upsell">Con assistenza Standard: <strong>€ 4.200</strong></p>
    </div>
    <div class="lic-card">
      <p class="lic-name">Sito</p>
      <div class="lic-price">€ 3.600</div>
      <p class="lic-note">+ IVA · una tantum · postazioni illimitate</p>
      <p class="lic-desc">Postazioni illimitate. Per enti, archivi di Stato, PA strutturate.</p>
      <p class="lic-upsell">Con assistenza Standard: <strong>€ 4.800</strong></p>
    </div>
  </div>

  <div class="pa-note">
    <div class="pa-note-icon">i</div>
    <div>
      <p class="pa-note-title">Nota per la Pubblica Amministrazione</p>
      <p class="pa-note-body">Tutti i pacchetti Foliarium sono studiati per rientrare nella soglia di <strong>€ 4.999 imponibile</strong> che consente l'affidamento diretto semplificato ai sensi del Codice degli Appalti — senza necessità di procedure di gara. La combinazione massima (Licenza Sito + Assistenza Standard) raggiunge <strong>€ 4.800 + IVA</strong>, entro soglia. Per la Pubblica Amministrazione si applica lo split payment ex art. 17-ter DPR 633/1972: l'IVA viene versata direttamente dall'ente all'Erario.</p>
    </div>
  </div>
</section>

<!-- PACCHETTI -->
<section class="pacchetti" id="prezzi">
  <p class="label mb-16">Assistenza e manutenzione</p>
  <h2 class="mb-12">Scegli il livello<br><em>di supporto.</em></h2>
  <p class="pricing-lead">I contratti di assistenza garantiscono continuità operativa, aggiornamenti e formazione. Si rinnovano automaticamente con 30 giorni di preavviso per la disdetta.</p>

  <div class="pack-grid">
    <div class="pack-card">
      <p class="pack-name">Base</p>
      <div class="pack-price">€ 1.200</div>
      <p class="pack-cadence">+ IVA / anno</p>
      <ul class="pack-feats">
        <li>Supporto email</li>
        <li>Risposta entro 72h lavorative</li>
        <li>1 sessione formazione/anno</li>
        <li>Fix bug critici garantiti</li>
      </ul>
      <a href="contatti.php" class="pack-cta">Richiedi info</a>
    </div>
    <div class="pack-card featured">
      <p class="pack-name">★ Standard · Più scelto</p>
      <div class="pack-price">€ 2.400</div>
      <p class="pack-cadence">+ IVA / anno</p>
      <ul class="pack-feats">
        <li>Tutto di Base, più:</li>
        <li>Risposta prioritaria 24h</li>
        <li>Aggiornamenti funzionali</li>
        <li>2 sessioni formazione/anno</li>
        <li>Accesso remoto assistito</li>
      </ul>
      <a href="contatti.php" class="pack-cta">Richiedi preventivo</a>
    </div>
    <div class="pack-card">
      <p class="pack-name">Premium</p>
      <div class="pack-price">€ 3.600</div>
      <p class="pack-cadence">+ IVA / anno</p>
      <ul class="pack-feats">
        <li>Tutto di Standard, più:</li>
        <li>Risposta in 4h lavorative</li>
        <li>Interventi on-site (max 2/anno)</li>
        <li>Sviluppo funzionalità custom</li>
        <li>Priorità assoluta</li>
      </ul>
      <a href="contatti.php" class="pack-cta">Richiedi info</a>
    </div>
  </div>
</section>

<!-- REQUISITI -->
<section class="requisiti">
  <p class="label mb-16">Requisiti di sistema</p>
  <h2 class="mb-40"><em>Cosa serve</em><br>per installare Foliarium.</h2>

  <div class="req-grid">
    <div class="req-cell"><strong>Sistema operativo</strong><span>Windows 10/11, Linux, macOS</span></div>
    <div class="req-cell"><strong>RAM minima</strong><span>4 GB (consigliati 8 GB)</span></div>
    <div class="req-cell"><strong>PostgreSQL</strong><span>Versione 15 o superiore</span></div>
    <div class="req-cell"><strong>Python</strong><span>Versione 3.11 o superiore</span></div>
    <div class="req-cell"><strong>Spazio disco</strong><span>Minimo 10 GB liberi</span></div>
    <div class="req-cell"><strong>Risoluzione schermo</strong><span>Minimo 1366 × 768</span></div>
  </div>

  <p class="req-note">L'installazione può essere effettuata da remoto (se il cliente è autonomo nell'uso degli strumenti di accesso remoto) oppure on-site presso la sede del cliente. Tempi e costi variano in base alla modalità scelta — contattateci per un preventivo personalizzato.</p>
</section>

<!-- CTA -->
<section class="cta-final">
  <div>
    <p class="label">Passo successivo</p>
    <h2><em>Una demo vale</em><br>più di mille parole.</h2>
    <p class="cta-lead">Offriamo una dimostrazione gratuita di 45 minuti, su dati realistici della Provincia di Savona. Vedrai Foliarium in azione su un archivio catasto storico completo.</p>
    <a href="contatti.php" class="btn btn-gold">Prenota la demo</a>
    <a href="caso-studio.php" class="btn btn-outline-light">Caso Studio Savona</a>
  </div>
</section>

</main>

<?php include 'footer.php'; ?>

<script src="main.js"></script>
</body>
</html>
