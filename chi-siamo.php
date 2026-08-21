<?php $active = 'chi-siamo'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chi Siamo — Algora Studio</title>
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

<!-- HERO -->
<header class="about-hero">
  <div class="ah-left fade-up">
    <p class="label">Chi siamo</p>
    <h1>Uno studio.<br>Software verticale.<br><em>Fatto bene.</em></h1>
    <p>Algora Studio è uno studio di sviluppo software che progetta applicazioni verticali per domini specifici. Non facciamo tutto — costruiamo strumenti precisi per chi ha esigenze che il software generico non riesce a soddisfare.</p>
  </div>
  <div class="ah-right fade-up fade-up-2">
    <div class="founder-portrait">
      <div class="fp-initials">MS</div>
      <p class="fp-name">Marco Santoro</p>
      <p class="fp-role">Fondatore · Sviluppatore</p>
      <p class="fp-bio">Sviluppatore software con esperienza in applicazioni gestionali per enti pubblici e privati. Ha progettato e sviluppato Foliarium su commissione dell'Archivio di Stato di Savona, dove il software è attivo dalla versione 1.0.</p>
    </div>
  </div>
</header>

<div class="strip">
  <span class="strip-item">Sede: <strong>Savona, Liguria — Italia</strong></span>
  <span class="strip-item">Fondato: <strong>2025</strong></span>
  <span class="strip-item">Stack: <strong>Python · PostgreSQL · PyQt6</strong></span>
</div>

<!-- VALORI -->
<section class="valori" id="valori">
  <div class="section-intro">
    <p class="label mb-16">I nostri valori</p>
    <h2>Cosa guida<br><em>ogni scelta.</em></h2>
  </div>
  <div class="val-grid">
    <div class="val-card">
      <p class="vn">01</p>
      <h3>Specializzazione verticale</h3>
      <p>Software costruito per domini precisi. La profondità conta più della larghezza. Ogni settore ha le sue regole — il software deve rifletterle, non costringere l'utente ad adattarsi a un modello che non gli appartiene.</p>
    </div>
    <div class="val-card">
      <p class="vn">02</p>
      <h3>Il cliente come co-progettista</h3>
      <p>Non sviluppiamo ipotesi di prodotto. Ogni strumento nasce lavorando fianco a fianco con chi lo userà ogni giorno. Foliarium nasce dall'Archivio di Stato di Savona, non da una ricerca di mercato astratta.</p>
    </div>
    <div class="val-card">
      <p class="vn">03</p>
      <h3>Tecnologie durevoli</h3>
      <p>Python, PostgreSQL, stack open source consolidato. Niente framework del momento, niente lock-in proprietario. Il software che costruiamo deve essere mantenibile tra dieci anni da chiunque.</p>
    </div>
  </div>
</section>

<!-- APPROCCIO -->
<section class="approccio-section" id="approccio">
  <div class="grid-2 approccio-grid">
    <div class="approccio-text">
      <p class="label mb-16">Il nostro approccio</p>
      <h2>Non adattiamo.<br><em>Progettiamo.</em></h2>
      <p>Il problema che vediamo spesso nel software per enti culturali è che vengono usati strumenti generalisti — gestionali, database, fogli di calcolo — adattati per forza a esigenze che non erano state previste nel design originale.</p>
      <p>Algora Studio parte da un assunto diverso: ogni dominio ha le sue regole, la sua struttura, la sua storia. Il software deve rispecchiarle, non costringere l'utente ad adattarsi a un modello che non gli appartiene.</p>
      <p>Per il catasto storico italiano questo ha significato progettare un modello dati che gestisce denominazioni storiche dei comuni, varianti grafiche dei cognomi dell'Ottocento, catene di passaggi di proprietà che si estendono su secoli, atti notarili con repertori e notai. Non una scorciatoia — una soluzione vera.</p>

      <div class="manifesto-full">
        <h3>Il metodo in tre punti</h3>
        <p><strong class="mf-strong">Ascolto prima del codice.</strong> Prima di scrivere una riga, passiamo tempo sul campo a capire come funziona davvero il dominio. Con gli archivisti, non a distanza.</p>
        <p><strong class="mf-strong">Iterazioni brevi e feedback frequenti.</strong> Il cliente vede il prodotto mentre si costruisce. Questo evita sorprese e garantisce che il risultato sia utile, non solo corretto.</p>
        <p><strong class="mf-strong">Rapporto continuativo dopo il lancio.</strong> Il software è vivo. Ogni nuova versione di Foliarium nasce dai feedback dell'Archivio di Savona. Questo è il modello che vogliamo replicare con ogni cliente.</p>
      </div>
    </div>

    <div class="stack-full">
      <h3>Lo stack tecnologico</h3>
      <ul class="tech-rows">
        <li><strong>Python 3.11+</strong><span>Logica applicativa</span></li>
        <li><strong>PostgreSQL 15+</strong><span>Database relazionale enterprise</span></li>
        <li><strong>PyQt6</strong><span>Interfaccia desktop nativa</span></li>
        <li><strong>PL/pgSQL</strong><span>Stored procedure e trigger</span></li>
        <li><strong>psycopg2</strong><span>Connettore Python–PostgreSQL</span></li>
        <li><strong>fpdf2</strong><span>Generazione report PDF</span></li>
        <li><strong>openpyxl</strong><span>Esportazione Excel</span></li>
        <li><strong>PyInstaller</strong><span>Packaging applicazione desktop</span></li>
      </ul>

      <div class="tools-note">
        <p class="label mb-12">Perché questi strumenti</p>
        <p>Python è versatile, leggibile e ha un ecosistema maturo per le applicazioni gestionali. PostgreSQL è il database relazionale open source più avanzato disponibile — affidabile, performante, con funzionalità enterprise. PyQt6 garantisce interfacce desktop native su tutti i sistemi operativi. Stack consolidato, documentato, senza dipendenze esotiche.</p>
      </div>
    </div>
  </div>
</section>

<!-- FUTURO -->
<section class="futuro">
  <p class="label mb-16">Dove stiamo andando</p>
  <h2>Algora Studio<br><em>nel tempo.</em></h2>
  <p class="futuro-lead">Foliarium è il primo prodotto. Non l'unico. Algora Studio è uno studio che vuole costruire un portfolio di strumenti specializzati per il patrimonio culturale e documentale italiano — ciascuno nato da un'esigenza reale del mercato.</p>

  <div class="futuro-grid">
    <div class="fut-card">
      <p class="fut-n">Oggi</p>
      <h3>Foliarium v1.5</h3>
      <p>Gestione archivi catastali storici. In uso presso l'Archivio di Stato di Savona. Disponibile per nuovi clienti.</p>
      <p class="fut-status">● Attivo · In evoluzione</p>
    </div>
    <div class="fut-card">
      <p class="fut-n">Prossimamente</p>
      <h3>Secondo prodotto</h3>
      <p>Il prossimo software Algora Studio nascerà dall'ascolto del mercato. Se hai un'esigenza specifica nel settore documentale, raccontacela — potrebbe diventare il nostro prossimo progetto.</p>
      <p class="fut-status">○ In ascolto</p>
    </div>
    <div class="fut-card">
      <p class="fut-n">In esplorazione</p>
      <h3>Formazione digitale</h3>
      <p>Percorsi formativi su digitalizzazione archivistica, gestione documentale e intelligenza artificiale applicata per professionisti del patrimonio culturale italiano.</p>
      <p class="fut-status">○ In definizione</p>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-final">
  <div>
    <p class="label">Lavoriamo insieme?</p>
    <h2>Hai un progetto<br><em>che richiede precisione?</em></h2>
    <p class="cta-lead">Se gestisci un archivio storico, uno studio professionale con esigenze documentali complesse, o un ente culturale che vuole digitalizzare il proprio patrimonio — parliamoci. Una conversazione di 30 minuti basta per capire se possiamo aiutarti.</p>
    <a href="contatti.php" class="btn btn-gold">Scrivici</a>
    <a href="foliarium.php" class="btn btn-outline-light">Scopri Foliarium</a>
  </div>
</section>

</main>

<?php include 'footer.php'; ?>

<script src="main.js"></script>
</body>
</html>
