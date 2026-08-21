<?php $active = 'caso-studio'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Caso Studio — Archivio di Stato di Savona | Algora Studio</title>
<meta name="description" content="Come Foliarium ha digitalizzato 190 anni di storia catastale per l'Archivio di Stato di Savona. Il caso studio completo.">
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
<header class="cs-hero">
  <div class="cs-hero-inner">
    <p class="label fade-up">Caso Studio</p>
    <h1 class="fade-up fade-up-1">Archivio di Stato<br><em>di Savona.</em></h1>
    <p class="fade-up fade-up-2">Come Foliarium ha digitalizzato 190 anni di storia catastale, trasformando settimane di ricerca manuale in pochi secondi di consultazione digitale.</p>
  </div>
</header>

<div class="cs-stat-band">
  <div class="cs-sband-inner">
    <div class="cs-stat"><strong>69</strong><span>Comuni gestiti</span></div>
    <div class="cs-stat"><strong>12.000+</strong><span>Partite catastali</span></div>
    <div class="cs-stat"><strong>8.500+</strong><span>Possessori</span></div>
    <div class="cs-stat"><strong>Dal 1830</strong><span>Copertura storica</span></div>
  </div>
</div>

<div class="strip">
  <span class="strip-item">Cliente: <strong>Ministero della Cultura — Archivio di Stato di Savona</strong></span>
  <span class="strip-item">Prodotto: <strong>Foliarium v1.0 → v1.5</strong></span>
  <span class="strip-item">Territorio: <strong>Provincia di Savona, Liguria</strong></span>
</div>

<!-- IL PROBLEMA -->
<section class="problema">
  <div class="section-title">
    <p class="label">Il problema</p>
    <h2>190 anni di storia<br><em>inaccessibile.</em></h2>
    <p>L'Archivio di Stato di Savona custodisce i registri catastali storici dell'intera provincia — una documentazione che risale al primo impianto catastale post-unitario del 1830. Un patrimonio immenso, conservato in volumi cartacei, praticamente impossibile da consultare in modo efficiente.</p>
  </div>

  <div class="before-after">
    <div class="ba-col before">
      <p class="ba-label">Prima di Foliarium</p>
      <h3>Ricerca manuale tra i volumi</h3>
      <ul class="ba-list">
        <li><span class="ba-icon">—</span> Giorni o settimane per ricostruire la storia di una proprietà</li>
        <li><span class="ba-icon">—</span> Nessuna possibilità di incrociare dati tra comuni diversi</li>
        <li><span class="ba-icon">—</span> Errori di lettura per grafia antica o deterioramento</li>
        <li><span class="ba-icon">—</span> Impossibile cercare per possessore su più partite</li>
        <li><span class="ba-icon">—</span> Nessuna reportistica strutturata per le richieste esterne</li>
        <li><span class="ba-icon">—</span> Rischio di deterioramento progressivo dei documenti originali</li>
      </ul>
    </div>
    <div class="ba-col after">
      <p class="ba-label">Con Foliarium</p>
      <h3>Consultazione digitale immediata</h3>
      <ul class="ba-list">
        <li><span class="ba-icon">+</span> Ricerca in pochi secondi su 12.000+ partite</li>
        <li><span class="ba-icon">+</span> Ricerca fuzzy per varianti grafiche storiche dei cognomi</li>
        <li><span class="ba-icon">+</span> Albero genealogico automatico della proprietà</li>
        <li><span class="ba-icon">+</span> Incroci tra comuni, possessori e periodi storici</li>
        <li><span class="ba-icon">+</span> Report PDF e Excel in un click</li>
        <li><span class="ba-icon">+</span> Audit trail completo di ogni consultazione</li>
      </ul>
    </div>
  </div>

  <div class="quote-block">
    <blockquote>"In pochi secondi troviamo qualsiasi partita catastale. Quello che prima richiedeva ore di ricerca manuale oggi è immediato."</blockquote>
    <cite>Archivio di Stato di Savona — Provincia di Savona, Liguria</cite>
  </div>
</section>

<!-- LA SOLUZIONE -->
<section class="soluzione">
  <div class="grid-2 sol-grid">
    <div class="sol-text">
      <p class="label mb-16">La soluzione</p>
      <h2>Foliarium: progettato<br><em>per il catasto storico.</em></h2>
      <p>Algora Studio ha affrontato il progetto partendo da un'analisi approfondita delle specificità del catasto storico italiano — non adattando uno strumento generico, ma progettando dall'inizio un sistema che rispecchiasse la struttura reale dell'archivio.</p>
      <p>Il modello dati gestisce le peculiarità del sistema catastale post-unitario: comuni con denominazioni storiche diverse, partite con suffissi e partite secondarie, possessori con paternità, variazioni di proprietà con atti notarili collegati, immobili con classificazioni d'epoca.</p>
      <p>La ricerca fuzzy è stata progettata specificamente per gestire le varianti grafiche dei cognomi liguri dell'Ottocento — uno dei problemi più critici nella ricerca archivistica storica.</p>

      <div class="sol-features">
        <ul class="feat-list">
          <li>
            <div class="feat-dot"></div>
            <div class="ft">
              <strong>Schema relazionale su misura</strong>
              <p>15 tabelle normalizzate che rispecchiano la struttura reale del catasto storico italiano.</p>
            </div>
          </li>
          <li>
            <div class="feat-dot"></div>
            <div class="ft">
              <strong>Ricerca Levenshtein configurabile</strong>
              <p>L'archivista può regolare la soglia di similarità in base alla specificità della ricerca.</p>
            </div>
          </li>
          <li>
            <div class="feat-dot"></div>
            <div class="ft">
              <strong>Genealogia automatica delle proprietà</strong>
              <p>Ricostruzione in un click della catena completa di passaggi di proprietà dal 1830.</p>
            </div>
          </li>
          <li>
            <div class="feat-dot"></div>
            <div class="ft">
              <strong>Formazione inclusa nel progetto</strong>
              <p>Sessioni di formazione per tutto il personale archivistico, con documentazione completa.</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <div>
      <ul class="timeline">
        <li>
          <span class="tl-label">Fase 1 — Analisi</span>
          <p>Raccolta dettagliata dei requisiti con il personale dell'Archivio. Studio dei registri cartacei originali per capire la struttura del dato. Progettazione del modello relazionale.</p>
        </li>
        <li>
          <span class="tl-label">Fase 2 — Sviluppo</span>
          <p>Sviluppo del database PostgreSQL e dell'interfaccia PyQt6. Implementazione delle procedure stored, delle funzioni di ricerca fuzzy e del sistema di audit. Test su dati reali.</p>
        </li>
        <li>
          <span class="tl-label">Fase 3 — Impianto dati</span>
          <p>Caricamento e strutturazione dell'intero archivio catastale della provincia di Savona: 69 comuni, 12.000+ partite, 8.500+ possessori, documentazione dal 1830.</p>
        </li>
        <li>
          <span class="tl-label">Fase 4 — Formazione</span>
          <p>Sessioni di formazione dedicate per archivisti e funzionari. Il sistema è stato operativo da subito, senza periodo di transizione problematico.</p>
        </li>
        <li>
          <span class="tl-label">Fase 5 — Aggiornamenti continui</span>
          <p>Rapporto attivo con l'Archivio. Da Foliarium v1.0 a v1.5: ogni nuova versione nasce da feedback concreti del cliente. Il sistema evolve con le esigenze.</p>
        </li>
      </ul>
    </div>
  </div>
</section>

<!-- LO SVILUPPO -->
<section class="sviluppo">
  <div class="section-title">
    <p class="label">Il progetto in numeri</p>
    <h2>Sei fasi.<br><em>Un sistema completo.</em></h2>
    <p>Il progetto si è sviluppato in fasi sequenziali, dalla raccolta dei requisiti alla messa in produzione, con un approccio iterativo che ha coinvolto il personale dell'Archivio in ogni passaggio chiave.</p>
  </div>
  <div class="fasi-grid">
    <div class="fase-card">
      <p class="fase-n">01</p>
      <h3>Analisi preliminare</h3>
      <p>Raccolta dati e analisi dettagliata dello schema ER. Setup dell'ambiente di sviluppo e del database di test.</p>
      <p class="fase-period">Aprile 2025 — 2 settimane</p>
    </div>
    <div class="fase-card">
      <p class="fase-n">02</p>
      <h3>Struttura dati</h3>
      <p>Progettazione e implementazione delle tabelle gerarchiche, delle relazioni e dei vincoli di integrità referenziale.</p>
      <p class="fase-period">Aprile 2025 — 1 settimana</p>
    </div>
    <div class="fase-card">
      <p class="fase-n">03</p>
      <h3>Implementazione core</h3>
      <p>Sviluppo dei trigger di audit, delle stored procedure e di tutta la logica di business del catasto storico.</p>
      <p class="fase-period">Aprile 2025 — 1 settimana</p>
    </div>
    <div class="fase-card">
      <p class="fase-n">04</p>
      <h3>Sistema di ricerca</h3>
      <p>Implementazione degli indici GIN, delle funzioni fuzzy e delle viste materializzate per le query frequenti.</p>
      <p class="fase-period">Aprile–Maggio 2025 — 1 settimana</p>
    </div>
    <div class="fase-card">
      <p class="fase-n">05</p>
      <h3>Test e ottimizzazione</h3>
      <p>Test con dati estesi, stress test del database e ottimizzazione delle performance. Documentazione tecnica completa.</p>
      <p class="fase-period">Maggio 2025 — 2 settimane</p>
    </div>
    <div class="fase-card">
      <p class="fase-n">06</p>
      <h3>Pilota e formazione</h3>
      <p>Implementazione sul sistema dell'Archivio, formazione del personale, aggiustamenti finali e verifica.</p>
      <p class="fase-period">Maggio–Giugno 2025 — 2 settimane</p>
    </div>
  </div>
</section>

<!-- RISULTATI -->
<section class="risultati">
  <p class="label mb-16">I risultati</p>
  <h2>L'archivio storico<br><em>è ora vivo.</em></h2>
  <p class="ris-lead">Foliarium ha trasformato un patrimonio documentale quasi inaccessibile in un sistema consultabile in tempo reale da tutto il personale autorizzato dell'Archivio.</p>

  <div class="ris-grid">
    <div class="ris-card">
      <p class="ris-n">Efficienza</p>
      <strong>Secondi</strong>
      <p>Da giorni di ricerca manuale a pochi secondi di ricerca digitale per trovare qualsiasi partita catastale.</p>
    </div>
    <div class="ris-card">
      <p class="ris-n">Copertura</p>
      <strong>190 anni</strong>
      <p>L'intero patrimonio catastale dal 1830 ad oggi è accessibile in un unico sistema strutturato e consultabile.</p>
    </div>
    <div class="ris-card">
      <p class="ris-n">Affidabilità</p>
      <strong>v 1.5</strong>
      <p>Da Foliarium 1.0 a 1.5: il software è in uso continuativo e migliora ad ogni versione su feedback reali.</p>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-final">
  <div>
    <p class="label">Il tuo archivio</p>
    <h2>Hai un archivio storico<br><em>da rendere consultabile?</em></h2>
    <p class="cta-lead">Il metodo che ha funzionato per Savona può funzionare per il tuo archivio. Il primo passo è una conversazione: raccontaci la tua situazione e capiamo insieme se Foliarium fa per te.</p>
    <a href="contatti.php" class="btn btn-gold">Parliamo</a>
    <a href="foliarium.php" class="btn btn-outline-light">Scopri Foliarium</a>
  </div>
</section>

</main>

<?php include 'footer.php'; ?>

<script src="main.js"></script>
</body>
</html>
