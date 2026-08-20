<?php $active = 'contatti'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contatti — Algora Studio</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'nav.php'; ?>

<!-- HERO -->
<header class="contact-hero">
  <div class="ch-text fade-up">
    <p class="label">Contatti</p>
    <h1>Parliamo<br><em>del tuo archivio.</em></h1>
  </div>
  <div class="ch-aside fade-up fade-up-2">
    <div class="contact-info-card">
      <p class="ci-title">Algora Studio</p>
      <div class="ci-item">
        <label>Fondatore</label>
        <span>Marco Santoro</span>
      </div>
      <div class="ci-item">
        <label>Email</label>
        <a href="mailto:info@algorastudio.it">info@algorastudio.it</a>
      </div>
      <div class="ci-item">
        <label>Sito prodotto</label>
        <a href="https://foliarium.it" target="_blank" rel="noopener">foliarium.it</a>
      </div>
      <div class="ci-item">
        <label>Sede</label>
        <span>Savona, Liguria — Italia</span>
      </div>
      <div class="ci-item">
        <label>Risposta</label>
        <span>Entro 24 ore lavorative</span>
      </div>
    </div>
  </div>
</header>

<div class="strip">
  <span class="strip-item">Demo gratuita: <strong>45 minuti · su appuntamento</strong></span>
  <span class="strip-item">Risposta garantita: <strong>entro 24 ore lavorative</strong></span>
  <span class="strip-item">Senza impegno</span>
</div>

<!-- FORM + INFO -->
<section class="contact-form-section" id="demo">
  <div class="grid-2 form-grid">
    <div class="form-intro">
      <p class="label mb-16">Richiedi una demo</p>
      <h2>Come funziona<br><em>la nostra demo.</em></h2>
      <p>Offriamo una dimostrazione gratuita di Foliarium della durata di 45 minuti. Utilizziamo un database demo precaricato con dati storici realistici della Provincia di Savona — così vedi il software in azione su un archivio catastale completo, non su dati di fantasia.</p>
      <p>La demo avviene in videochiamata, senza che tu debba installare nulla. Alla fine, se Foliarium fa per te, ti prepariamo un preventivo personalizzato.</p>

      <ul class="demo-steps">
        <li>
          <span class="ds-n">01</span>
          <div class="ds-t">
            <strong>Ci scrivi</strong>
            <p>Compila il form o manda un'email. Ci dici in 2 righe qual è la tua situazione.</p>
          </div>
        </li>
        <li>
          <span class="ds-n">02</span>
          <div class="ds-t">
            <strong>Concordiamo un orario</strong>
            <p>Ti proponiamo 2-3 orari disponibili entro la settimana successiva.</p>
          </div>
        </li>
        <li>
          <span class="ds-n">03</span>
          <div class="ds-t">
            <strong>45 minuti di demo</strong>
            <p>Vedi Foliarium in azione. Puoi fare tutte le domande che vuoi.</p>
          </div>
        </li>
        <li>
          <span class="ds-n">04</span>
          <div class="ds-t">
            <strong>Preventivo personalizzato</strong>
            <p>Se ti convince, ti prepariamo un preventivo su misura entro 48 ore.</p>
          </div>
        </li>
      </ul>
    </div>

    <div class="contact-form">
      <p class="label mb-24">Modulo di contatto</p>
      <form action="invia-contatto.php" method="POST" id="contactForm">
        <div class="form-row">
          <div class="form-group">
            <label for="nome">Nome e cognome</label>
            <input type="text" id="nome" name="nome" placeholder="Mario Rossi" required>
          </div>
          <div class="form-group">
            <label for="ente">Ente / Studio / Organizzazione</label>
            <input type="text" id="ente" name="ente" placeholder="Archivio di Stato di...">
          </div>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="nome@ente.it" required>
        </div>
        <div class="form-group">
          <label for="tipo">Sei...</label>
          <select id="tipo" name="tipo">
            <option value="">Seleziona una categoria</option>
            <option>Archivio di Stato</option>
            <option>Archivio storico comunale</option>
            <option>Studio notarile</option>
            <option>Genealogista professionista</option>
            <option>Fondazione culturale</option>
            <option>Università / Centro di ricerca</option>
            <option>Altro</option>
          </select>
        </div>
        <div class="form-group">
          <label for="messaggio">Descrivi brevemente la tua esigenza</label>
          <textarea id="messaggio" name="messaggio" placeholder="Es: gestiamo l'archivio catastale di 15 comuni e stiamo cercando un sistema per digitalizzarlo e renderlo consultabile..."></textarea>
        </div>
        <button type="submit" class="form-submit">Invia richiesta →</button>
        <p class="form-note">Risponderemo entro 24 ore lavorative. Nessun impegno, nessun commerciale aggressivo.</p>
      </form>
      <div id="form-success" class="form-success">
        <p>Messaggio inviato</p>
        <p>Grazie per averci scritto. Ti risponderemo entro 24 ore lavorative.</p>
      </div>
    </div>
  </div>
</section>

<!-- PERCHÉ SCEGLIERCI -->
<section class="perche">
  <div class="section-intro">
    <p class="label mb-16">Perché Algora Studio</p>
    <h2>Non vendiamo software<br><em>vendiamo soluzioni.</em></h2>
  </div>
  <div class="perche-grid">
    <div class="pc-card">
      <p class="pc-n">Referenza reale</p>
      <h3>L'Archivio di Savona usa Foliarium ogni giorno</h3>
      <p>Non è un prodotto in beta. È in produzione dall'inizio del 2025 su un archivio reale di 69 comuni. Puoi chiederci una referenza diretta.</p>
    </div>
    <div class="pc-card">
      <p class="pc-n">Installazione inclusa</p>
      <h3>Non dovete gestire nulla di tecnico</h3>
      <p>L'installazione avviene da remoto oppure on-site a seconda delle esigenze del cliente. Gestiamo tutto noi: il cliente non deve fare nulla di tecnico. Modalità e costi si concordano nel preventivo.</p>
    </div>
    <div class="pc-card">
      <p class="pc-n">Rapporto diretto</p>
      <h3>Parlate sempre con chi ha sviluppato il software</h3>
      <p>Nessun call center, nessun ticket system senza risposta. Il supporto è gestito direttamente da Marco Santoro, che conosce ogni riga di codice.</p>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="faq">
  <div class="faq-intro">
    <p class="label mb-16">FAQ</p>
    <h2>Domande frequenti.</h2>
  </div>
  <div class="faq-list">
    <div class="faq-item" onclick="toggleFaq(this)">
      <div class="faq-q">
        <span>Quanto tempo ci vuole per installare Foliarium?</span>
        <span class="faq-toggle">+</span>
      </div>
      <p class="faq-a">L'installazione può avvenire in due modalità. Remota: se il cliente è autonomo nell'uso di strumenti come TeamViewer o AnyDesk, effettuiamo tutto in videochiamata (circa 1-2 ore). On-site: interveniamo fisicamente presso la sede del cliente — tempi e costi sono concordati nel preventivo in base alla distanza e alla complessità. In entrambi i casi installiamo PostgreSQL, il database, l'applicazione e configuriamo tutto. Il cliente non deve avere competenze tecniche specifiche.</p>
    </div>
    <div class="faq-item" onclick="toggleFaq(this)">
      <div class="faq-q">
        <span>Funziona anche con archivi molto grandi?</span>
        <span class="faq-toggle">+</span>
      </div>
      <p class="faq-a">Sì. Foliarium utilizza PostgreSQL come database — un sistema relazionale enterprise usato in produzione da aziende Fortune 500. Il caso studio di Savona gestisce 12.000+ partite e 8.500+ possessori senza problemi di performance. Per archivi più grandi, ottimizziamo la configurazione del server in fase di installazione.</p>
    </div>
    <div class="faq-item" onclick="toggleFaq(this)">
      <div class="faq-q">
        <span>Possiamo importare i dati che abbiamo già in Excel o CSV?</span>
        <span class="faq-toggle">+</span>
      </div>
      <p class="faq-a">Sì. Foliarium supporta l'importazione massiva da CSV con report dettagliati degli errori. Se i dati esistenti sono in formati diversi (Excel, database proprietari, altri sistemi), lo valutiamo caso per caso durante la fase di analisi preliminare, inclusa gratuitamente nel preventivo.</p>
    </div>
    <div class="faq-item" onclick="toggleFaq(this)">
      <div class="faq-q">
        <span>Un ente pubblico può acquistare Foliarium?</span>
        <span class="faq-toggle">+</span>
      </div>
      <p class="faq-a">Sì. Algora Studio emette regolare fattura con P.IVA e può operare con gli strumenti di acquisto della PA. Tutti i pacchetti Foliarium sono studiati per restare sotto la soglia di € 4.999 imponibile che consente l'affidamento diretto semplificato senza procedure di gara. La combinazione massima (Licenza Sito + Assistenza Standard) raggiunge € 4.800 + IVA. Per la PA si applica lo split payment: l'IVA viene versata direttamente dall'ente all'Erario.</p>
    </div>
    <div class="faq-item" onclick="toggleFaq(this)">
      <div class="faq-q">
        <span>Cosa succede se avete problemi o chiudete?</span>
        <span class="faq-toggle">+</span>
      </div>
      <p class="faq-a">Foliarium utilizza esclusivamente tecnologie open source (PostgreSQL, Python, PyQt6). Il codice non è criptato né legato a licenze proprietarie di terze parti. In qualsiasi momento, il cliente può fare un backup completo del database e dell'applicazione. Il dato rimane sempre di proprietà del cliente.</p>
    </div>
    <div class="faq-item" onclick="toggleFaq(this)">
      <div class="faq-q">
        <span>È possibile personalizzare Foliarium per esigenze specifiche?</span>
        <span class="faq-toggle">+</span>
      </div>
      <p class="faq-a">Sì, con il pacchetto Premium o tramite un preventivo separato per sviluppo custom. Ogni personalizzazione viene valutata in base alla complessità e documentata. Le personalizzazioni più richieste diventano spesso funzionalità standard nelle versioni successive.</p>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<script src="main.js"></script>
</body>
</html>
