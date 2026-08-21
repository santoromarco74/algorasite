<?php
/*
 * Informativa privacy.
 *
 * ─────────────────────────────────────────────────────────────────────
 * DA COMPILARE PRIMA DELLA PUBBLICAZIONE
 * I punti marcati nel testo con la classe .da-compilare contengono
 * segnaposto: vanno sostituiti con i dati reali del titolare. Sono resi
 * con uno stile evidente proprio per non passare inosservati.
 *
 *   1. Ragione sociale e forma giuridica del titolare
 *   2. Partita IVA e codice fiscale
 *   3. Indirizzo completo della sede
 *   4. Tempo di conservazione delle richieste di contatto
 *   5. Fornitore di hosting (e' responsabile esterno del trattamento e
 *      va nominato, con contratto ex art. 28 GDPR)
 *   6. Eventuale fornitore di posta elettronica usato per rispondere
 *
 * Lo stesso segnaposto della partita IVA compare in footer.php.
 * ─────────────────────────────────────────────────────────────────────
 *
 * NOTA SUI COOKIE: allo stato attuale il sito non imposta alcun cookie e
 * non effettua richieste a domini terzi (i caratteri tipografici sono
 * ospitati localmente). Se in futuro verra' introdotto il token anti-CSRF
 * basato su sessione PHP, comparira' il cookie tecnico PHPSESSID: non
 * richiede consenso, ma va dichiarato nella sezione "Cookie" qui sotto.
 */

$active = 'privacy';
?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Informativa privacy — Algora Studio</title>
<meta name="description" content="Come Algora Studio tratta i dati personali raccolti tramite il modulo di contatto del sito.">
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

<header class="doc-hero">
  <p class="label">Informativa</p>
  <h1>Privacy<br><em>e trattamento dei dati.</em></h1>
  <p class="doc-lead">Questa pagina spiega quali dati personali raccogliamo attraverso il sito, perché li raccogliamo, per quanto tempo li conserviamo e quali diritti puoi esercitare. È redatta ai sensi degli articoli 13 e 14 del Regolamento (UE) 2016/679.</p>
  <p class="doc-date">Ultimo aggiornamento: agosto 2026</p>
</header>

<section class="doc">
  <div class="doc-body">

    <h2>1. Titolare del trattamento</h2>
    <p>Il titolare del trattamento è <span class="da-compilare">[ragione sociale e forma giuridica]</span>, con sede in <span class="da-compilare">[indirizzo completo]</span>, Savona (Liguria), partita IVA <span class="da-compilare">[partita IVA]</span>.</p>
    <p>Per qualsiasi questione relativa ai tuoi dati puoi scrivere a <a href="mailto:info@algorastudio.it">info@algorastudio.it</a>.</p>
    <p>Il titolare non ha nominato un Responsabile della protezione dei dati (DPO), non ricorrendone i presupposti previsti dall'articolo 37 del Regolamento.</p>

    <h2 id="dati">2. Quali dati raccogliamo</h2>
    <p>Il sito raccoglie dati personali in un solo punto: il modulo di contatto della pagina <a href="contatti.php">Contatti</a>. I dati sono quelli che inserisci tu:</p>
    <!-- Una tabella non si comprime sotto la larghezza minima del proprio
         contenuto: sotto i 390px sfonderebbe la pagina. Il contenitore la
         rende scorrevole, ed e' raggiungibile da tastiera (tabindex="0")
         perche' altrimenti chi non usa il mouse non potrebbe scorrerla. -->
    <div class="doc-table-scroll" role="region" tabindex="0" aria-labelledby="tab-dati-cap">
    <table class="doc-table">
      <caption id="tab-dati-cap">Dati raccolti dal modulo di contatto</caption>
      <thead>
        <tr><th scope="col">Dato</th><th scope="col">Obbligatorio</th><th scope="col">Perché lo chiediamo</th></tr>
      </thead>
      <tbody>
        <tr><td>Nome e cognome</td><td>Sì</td><td>Per rivolgerci a te nella risposta</td></tr>
        <tr><td>Indirizzo email</td><td>Sì</td><td>È il recapito a cui rispondiamo</td></tr>
        <tr><td>Messaggio</td><td>Sì</td><td>È la richiesta a cui dobbiamo rispondere</td></tr>
        <tr><td>Ente o organizzazione</td><td>No</td><td>Per capire il contesto della richiesta</td></tr>
        <tr><td>Categoria di appartenenza</td><td>No</td><td>Per capire il contesto della richiesta</td></tr>
      </tbody>
    </table>
    </div>
    <p>Al momento dell'invio registriamo anche la data e l'ora della richiesta e il fatto che tu abbia prestato il consenso a questa informativa.</p>
    <p>Non raccogliamo categorie particolari di dati (articolo 9 del Regolamento) e non ti chiediamo di fornirne: ti preghiamo di non inserirne nel campo del messaggio.</p>

    <h2>3. Perché trattiamo i dati e su quale base giuridica</h2>
    <p>Trattiamo i dati per una sola finalità: <strong>rispondere alla richiesta che ci hai inviato</strong> ed eventualmente proseguire la conversazione che ne nasce, per esempio fissando una dimostrazione del prodotto o preparando un preventivo.</p>
    <p>La base giuridica è il <strong>consenso</strong> che presti spuntando l'apposita casella prima dell'invio (articolo 6, paragrafo 1, lettera a del Regolamento). Puoi revocarlo in qualsiasi momento scrivendo a <a href="mailto:info@algorastudio.it">info@algorastudio.it</a>: la revoca non pregiudica la liceità del trattamento svolto prima della revoca stessa.</p>
    <p>Non usiamo i tuoi dati per inviarti comunicazioni commerciali non richieste, non facciamo profilazione e non prendiamo decisioni automatizzate.</p>

    <h2>4. Per quanto tempo li conserviamo</h2>
      <p>Conserviamo le richieste di contatto per <strong>24 mesi</strong> dall'ultimo scambio, dopodiché vengono cancellate dal database. Se dalla richiesta nasce un rapporto contrattuale, i dati necessari alla sua gestione seguono i termini di conservazione previsti dalla normativa fiscale e civilistica.</p>

    <h2>5. A chi vengono comunicati</h2>
    <p>I dati non vengono diffusi né ceduti a terzi per finalità commerciali. Possono essere trattati, per nostro conto e su nostra istruzione, dai soggetti che ci forniscono servizi tecnici, nominati responsabili del trattamento ai sensi dell'articolo 28 del Regolamento:</p>
    <ul class="doc-list">
      <li><strong>VHosting Solution s.r.l.</strong>, che ospita il sito e il database su cui le richieste vengono salvate;</li>
      <li><strong>VHosting Solution s.r.l.</strong>, attraverso cui viene inviata la risposta.</li>
    </ul>
    <p>Non trasferiamo dati personali fuori dallo Spazio economico europeo.</p>

    <h2 id="cookie">6. Cookie e servizi di terze parti</h2>
    <p><strong>Questo sito non utilizza cookie.</strong> Non ne imposta di propri, non ne imposta di terze parti, non usa strumenti di analisi statistica né pulsanti di condivisione sui social network. Per questo non trovi alcun banner di consenso: non c'è nulla da consentire.</p>
    <p>Il sito non effettua inoltre alcuna richiesta a domini esterni. I caratteri tipografici usati nelle pagine sono ospitati sul server del sito stesso: navigando non comunichi il tuo indirizzo IP a nessun fornitore terzo.</p>
    <p>L'unico trattamento tecnico che avviene a tua insaputa è quello svolto dal server web, che registra nei propri file di log gli accessi ricevuti (indirizzo IP, data e ora, pagina richiesta) per finalità di sicurezza e diagnostica, secondo le impostazioni del fornitore di hosting.</p>

    <h2>7. I tuoi diritti</h2>
    <p>In relazione ai dati che ti riguardano puoi in ogni momento chiedere:</p>
    <ul class="doc-list">
      <li>di <strong>accedere</strong> ai dati e ottenerne una copia (articolo 15);</li>
      <li>di <strong>rettificarli</strong> se inesatti o incompleti (articolo 16);</li>
      <li>di <strong>cancellarli</strong> (articolo 17);</li>
      <li>di <strong>limitarne il trattamento</strong> (articolo 18);</li>
      <li>di <strong>riceverli</strong> in formato strutturato e leggibile da un dispositivo automatico (articolo 20);</li>
      <li>di <strong>revocare il consenso</strong> prestato, in qualsiasi momento.</li>
    </ul>
    <p>È sufficiente scrivere a <a href="mailto:info@algorastudio.it">info@algorastudio.it</a>. Rispondiamo entro un mese dalla richiesta.</p>
    <p>Se ritieni che il trattamento dei tuoi dati violi il Regolamento, hai diritto di proporre reclamo al <strong>Garante per la protezione dei dati personali</strong> (<a href="https://www.garanteprivacy.it" target="_blank" rel="noopener">garanteprivacy.it</a>) oppure di ricorrere all'autorità giudiziaria.</p>

    <h2>8. Modifiche a questa informativa</h2>
    <p>Se cambieranno le modalità di trattamento, aggiorneremo questa pagina e ne modificheremo la data di ultimo aggiornamento indicata in apertura.</p>

  </div>
</section>

</main>

<?php include 'footer.php'; ?>

<script src="main.js"></script>
</body>
</html>
