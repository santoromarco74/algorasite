<?php $active = 'home'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Algora Studio — Software per il Patrimonio Culturale</title>
<meta name="description" content="Algora Studio sviluppa software specializzato per archivi, enti culturali e professionisti del patrimonio documentale italiano.">
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'nav.php'; ?>

<!-- HERO -->
<header class="hero">
  <p class="label hero-label fade-up">Software · Formazione · Consulenza IT</p>
  <h1 class="fade-up fade-up-1">Strumenti digitali<br><em>per chi custodisce<br>la conoscenza.</em></h1>

  <div class="hero-grid">
    <div class="hero-body fade-up fade-up-2">
      <p>Algora Studio è uno studio di sviluppo software che progetta applicazioni verticali per domini specifici. Costruiamo strumenti precisi e duraturi — software pensato per rispettare la complessità reale di ciò che gestisce. Il nostro primo prodotto, Foliarium, è dedicato agli archivi catastali storici italiani.</p>
      <div class="btn-row">
        <a href="foliarium.php" class="btn btn-dark">Il nostro prodotto</a>
        <a href="contatti.php" class="btn btn-outline">Richiedi una demo</a>
      </div>
    </div>
    <div class="hero-aside fade-up fade-up-3">
      <div class="manifesto">
        <p>"Nasce per colmare il vuoto tra la ricchezza del patrimonio storico italiano e la povertà degli strumenti digitali disponibili per gestirlo."</p>
        <cite>Marco Santoro — Fondatore</cite>
      </div>
      <div class="hero-meta">
        <div class="meta-item"><strong>1</strong><span>Prodotto attivo</span></div>
        <div class="meta-item"><strong>Savona</strong><span>Cliente di riferimento</span></div>
        <div class="meta-item"><strong>v 1.5</strong><span>Release corrente</span></div>
        <div class="meta-item"><strong>2025</strong><span>Anno di lancio</span></div>
      </div>
    </div>
  </div>
</header>

<div class="strip">
  <span class="strip-item">Prodotto attivo: <strong>Foliarium</strong></span>
  <span class="strip-item">Cliente: <strong>Archivio di Stato di Savona</strong></span>
  <span class="strip-item">Stack: <strong>Python · PostgreSQL · PyQt6</strong></span>
  <span class="strip-item">Demo: <strong>su appuntamento, gratuita</strong></span>
</div>

<!-- PRODOTTI -->
<section class="prod-home">
  <div class="ph-intro">
    <p class="label">I nostri prodotti</p>
    <h2>Software verticale.<br><em>Per domini precisi.</em></h2>
    <p>Non facciamo tutto. Ogni prodotto Algora Studio nasce da un problema reale, costruito su misura per chi lavora quotidianamente in un settore specifico. Il software generico non basta quando il dominio ha la complessità della storia.</p>
  </div>

  <div class="ph-grid">
    <div class="ph-card active">
      <p class="ph-num">01 — Attivo</p>
      <h3>Foliarium</h3>
      <p>Sistema completo per la gestione e consultazione degli archivi catastali storici italiani. In uso presso l'Archivio di Stato di Savona dalla versione 1.0.</p>
      <span class="ph-tag">Disponibile · v1.5</span><br>
      <a href="foliarium.php" class="link-arrow">Scopri il prodotto →</a>
    </div>
    <div class="ph-card">
      <p class="ph-num">02 — In definizione</p>
      <h3>Prossimo prodotto</h3>
      <p>Il secondo prodotto Algora Studio nascerà dall'ascolto del mercato. Se hai un'esigenza specifica nel settore archivistico o documentale, raccontacela.</p>
      <span class="ph-tag">In ascolto</span>
    </div>
    <div class="ph-card">
      <p class="ph-num">03 — In esplorazione</p>
      <h3>Formazione digitale</h3>
      <p>Percorsi formativi su digitalizzazione archivistica e intelligenza artificiale applicata per professionisti del patrimonio culturale.</p>
      <span class="ph-tag">Prossimamente</span>
    </div>
  </div>
</section>

<!-- CASO STUDIO TEASER -->
<section class="caso-home">
  <p class="label mb-16">Riferimento attivo</p>
  <div class="grid-2 ch-grid">
    <div class="ch-left">
      <div class="quote-block">
        <blockquote>"In pochi secondi troviamo qualsiasi partita catastale. Quello che prima richiedeva ore di ricerca manuale oggi è immediato."</blockquote>
        <cite>Archivio di Stato di Savona — Liguria</cite>
      </div>
      <div class="ch-stat-band">
        <div class="ch-stat"><strong>69</strong><span>Comuni</span></div>
        <div class="ch-stat"><strong>12.000+</strong><span>Partite</span></div>
        <div class="ch-stat"><strong>8.500+</strong><span>Possessori</span></div>
        <div class="ch-stat"><strong>Dal 1830</strong><span>Copertura</span></div>
      </div>
    </div>
    <div class="ch-right">
      <h2>Come Foliarium è<br><em>nato da un problema reale.</em></h2>
      <p>L'Archivio di Stato di Savona custodisce i registri catastali storici di tutta la provincia. Prima di Foliarium, ogni ricerca richiedeva la consultazione manuale di volumi cartacei. La storia di una singola proprietà poteva richiedere giorni di lavoro.</p>
      <p>Algora Studio ha progettato e sviluppato Foliarium su commissione diretta dell'Archivio, trasformando un archivio cartaceo in un sistema digitale consultabile in pochi secondi.</p>
      <p>Questo è il nostro metodo: partire da un problema reale, costruire una soluzione su misura, mantenere un rapporto continuativo con il cliente.</p>
      <a href="caso-studio.php" class="btn btn-dark mt-8">Leggi il caso studio</a>
    </div>
  </div>
</section>

<!-- APPROCCIO -->
<section class="approccio">
  <div class="grid-2 app-grid">
    <div class="app-text">
      <p class="label mb-16">Il nostro approccio</p>
      <h2>Specializzazione.<br><em>Non generalismo.</em></h2>
      <p>Algora Studio non è una software house generalista. Siamo uno studio piccolo, preciso, che lavora in profondità su un numero limitato di domini — uno alla volta, bene.</p>
      <p>Ogni strumento che costruiamo deve rispettare la complessità reale del dominio che gestisce. Il software generico non basta quando le regole del settore hanno sfumature che nessun gestionale preconfezionato ha mai previsto.</p>
      <ul class="val-list">
        <li>
          <span class="val-n">01</span>
          <div class="val-text">
            <strong>Verticale prima di tutto</strong>
            <p>Software costruito per domini precisi. La profondità conta più della larghezza.</p>
          </div>
        </li>
        <li>
          <span class="val-n">02</span>
          <div class="val-text">
            <strong>Il cliente come co-progettista</strong>
            <p>Ogni prodotto nasce lavorando a fianco di chi userà il software ogni giorno.</p>
          </div>
        </li>
        <li>
          <span class="val-n">03</span>
          <div class="val-text">
            <strong>Tecnologie durevoli</strong>
            <p>Stack open source consolidato. Niente hype, tutto manutenibile nel tempo.</p>
          </div>
        </li>
      </ul>
    </div>
    <div class="app-aside">
      <div class="stack-box">
        <h3>Stack tecnologico</h3>
        <div class="stack-grid">
          <div class="stack-item"><strong>Python 3.11+</strong><span>Logica applicativa</span></div>
          <div class="stack-item"><strong>PostgreSQL 15+</strong><span>Database relazionale</span></div>
          <div class="stack-item"><strong>PyQt6</strong><span>Interfaccia desktop</span></div>
          <div class="stack-item"><strong>Open source</strong><span>Stack completo</span></div>
        </div>
      </div>
      <div class="founder-box">
        <p class="fn">Marco Santoro — Fondatore</p>
        <p>Sviluppatore software specializzato in applicazioni gestionali per enti pubblici e privati. Ha progettato e sviluppato Foliarium su commissione dell'Archivio di Stato di Savona. Specializzato in Python, database relazionali e interfacce desktop native.</p>
        <a href="chi-siamo.php" class="link-arrow">Chi siamo →</a>
      </div>
    </div>
  </div>
</section>

<!-- CTA FINALE -->
<section class="cta-final">
  <div class="cta-wide">
    <p class="label">Iniziamo una conversazione</p>
    <h2>Hai un archivio da digitalizzare?</h2>
    <p class="cta-lead">Che tu sia un archivio pubblico, uno studio notarile o un ente culturale, il primo passo è una conversazione. Offriamo una demo gratuita di Foliarium su appuntamento, senza impegno.</p>
    <a href="contatti.php" class="btn btn-gold">Scrivici</a>
    <a href="foliarium.php" class="btn btn-outline-light">Scopri Foliarium</a>
  </div>
</section>

<?php include 'footer.php'; ?>

<script src="main.js"></script>
</body>
</html>
