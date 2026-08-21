# RELAZIONE TECNICA DI PROGETTO

*Versione italiana — [English version ↓](#project-technical-report)*

**Corso:** Web and Multimedia Technologies (Laurea Magistrale)
**Docente:** Prof. Marco Porta — Università degli Studi di Pavia
**Studente:** Marco Santoro
**Progetto:** Algora Studio — sito istituzionale e piattaforma di contatto
**Anno Accademico:** 2025/2026

---

## 1. INTRODUZIONE E CONTESTO APPLICATIVO

Questa relazione descrive la progettazione e le scelte tecniche del sito web di **Algora Studio**, uno studio di sviluppo software specializzato in soluzioni verticali per il patrimonio culturale e la memoria storica documentale italiana (Archivi di Stato, archivi storici comunali, studi notarili, fondazioni).

Il prodotto attorno a cui ruota la comunicazione del sito è **Foliarium**, un gestionale sviluppato per l'Archivio di Stato di Savona per la digitalizzazione, la modellazione relazionale e la consultazione *fuzzy* degli archivi catastali storici (dal 1830 a oggi).

### Motivazione della scelta

La maggior parte dei siti per software house si appoggia a template generici o a CMS che frammentano il controllo sul codice. Realizzare un portale ad hoc risponde all'obiettivo di dimostrare che la programmazione web nativa (**HTML5, CSS3, JavaScript Vanilla, PHP e MySQL/MariaDB**) permette di ottenere:

1. un'estetica caratterizzata ("Archivio Caldo") coerente con il dominio trattato;
2. un carico di rete ridotto, con un solo foglio di stile e un solo file JavaScript;
3. conformità alla validazione W3C e alle regole di base di usabilità e accessibilità viste a lezione.

---

## 2. ARCHITETTURA DELL'INFORMAZIONE E MAPPATURA DEI FILE

Il sito si articola su **6 pagine di contenuto**, servite da PHP, più **1 script server-side** per la persistenza dei dati e **1 schermata di servizio** riservata a chi gestisce il sito. Le parti comuni sono estratte in due **include PHP** riusati da tutte le pagine.

| File | Ruolo |
| :--- | :--- |
| `index.php` | **Home.** Vision dello studio, manifesto, metriche di sintesi, anteprima del caso studio, sezione approccio, call to action finale. |
| `chi-siamo.php` | **Profilo dello studio.** Filosofia dello sviluppo verticale, i tre valori guida, profilo del fondatore, stack tecnologico, prospettive future. |
| `foliarium.php` | **Scheda prodotto.** Funzionalità di Foliarium (ricerca fuzzy, albero delle proprietà, audit trail, esportazione report), requisiti di sistema, licenze e pacchetti di assistenza. |
| `caso-studio.php` | **Caso studio Archivio di Stato di Savona.** Risultati quantitativi (69 comuni, 12.000+ partite, 8.500+ possessori), confronto "prima e dopo", fasi del progetto. |
| `contatti.php` | **Contatti e demo.** Guida in quattro fasi, modulo di contatto con consenso al trattamento, FAQ a fisarmonica. |
| `privacy.php` | **Informativa privacy.** Dati raccolti, finalità, base giuridica, conservazione, diritti dell'interessato, sezione sui cookie. |
| `nav.php` | Include: barra di navigazione, generata da un array PHP che marca automaticamente la voce attiva. |
| `footer.php` | Include: piè di pagina comune a tutte le pagine. |
| `invia-contatto.php` | **Backend.** Riceve il POST del modulo, valida, inserisce nel database con istruzione preparata, restituisce la pagina di esito. |
| `archivio.php` | **Area riservata.** Schermata di servizio protetta da password: elenco delle richieste, inserimento manuale, modifica ed eliminazione (§5.7). |
| `config-db.php` | Parametri di connessione al database, isolati dalla logica applicativa. |
| `config-admin.php` | Impronta della password dell'area riservata, isolata come i parametri del database. |
| `crea_db.sql` | Script DDL di creazione di database e tabella. |
| `style.css` | Foglio di stile unico dell'intero sito (1.518 righe, ~60 KB). |
| `main.js` | Comportamenti client-side (63 righe). |
| `fonts/` | I due caratteri tipografici in formato WOFF2 (8 file, 300 KB). |
| `img/` | Schermate del prodotto e fotogramma poster del filmato, con le istruzioni in `LEGGIMI.md`. |
| `video/` | Il filmato dimostrativo nelle due codifiche (§3.5). |

### 2.1 Perché PHP anche sulle pagine di contenuto

Le sei pagine di contenuto non contengono logica applicativa, ma hanno estensione `.php` per poter usare `include`:

```php
<?php $active = 'home'; ?>
...
<?php include 'nav.php'; ?>
```

Barra di navigazione e piè di pagina esistono così in **un'unica copia**. La voce di menu corrispondente alla pagina corrente viene evidenziata confrontando la variabile `$active` con le chiavi dell'array che descrive il menu:

```php
$navItems = [
  'home'      => ['href' => 'index.php',    'label' => 'Home'],
  'chi-siamo' => ['href' => 'chi-siamo.php', 'label' => 'Chi siamo'],
  /* ... */
];
foreach ($navItems as $key => $item) {
  /* class="active" quando $active === $key */
}
```

Senza include, una modifica al menu andrebbe replicata a mano sugli otto file che lo mostrano — le sei pagine di contenuto, la pagina di esito e l'area riservata — con il rischio concreto di disallineamenti.

---

## 3. FRONTEND: HTML5 SEMANTICO, CSS3 E DESIGN SYSTEM

### 3.1 Scrittura nativa e struttura semantica

Il codice è scritto interamente a mano, senza editor WYSIWYG e senza framework CSS (Bootstrap, Tailwind). Ogni pagina usa i tag strutturali di HTML5: `<nav>` per la navigazione, `<main>` per il contenuto principale, `<header>` per le sezioni di apertura, `<section>` per i blocchi tematici, `<footer>` per la chiusura.

L'intero contenuto di ogni pagina è racchiuso in `<main id="contenuto">`: questo definisce il *landmark* principale e permette il funzionamento del collegamento di salto descritto in §6.

### 3.2 Design system "Archivio Caldo"

La palette e la tipografia sono definite con **variabili CSS** (custom properties) raccolte in `:root`, così che un cambio di tonalità si propaghi a tutto il sito modificando una riga sola:

* **Colori:** fondo pergamena (`--parchment: #F4EFE4`, `--cream: #F9F6EF`), testo e contenitori inchiostro (`--ink: #1E150A`), accenti dorati (`--gold: #B8821A`), verde archivio per le conferme (`--green: #1A3A28`).
* **Tipografia:** *Cormorant Garamond* per i titoli display e *Libre Baskerville* per il testo corrente, entrambi da Google Fonts; *Trebuchet MS / Calibri* in maiuscolo spaziato per etichette e micro-testi.

I due caratteri erano inizialmente caricati con un `@import` da `fonts.googleapis.com`. Era l'**unica richiesta a un dominio terzo** dell'intero sito, e non è un dettaglio tecnico: ogni visita comunicava l'indirizzo IP dell'utente a un server esterno, senza che ne fosse informato e senza che avesse modo di opporsi.

I file WOFF2 sono quindi stati **scaricati e ospitati sul sito stesso**, in `fonts/`, e l'`@import` è stato sostituito da otto dichiarazioni `@font-face`:

```css
@font-face {
  font-family: 'Cormorant Garamond';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url('fonts/cormorant-garamond-400.woff2') format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, /* ... */;
}
```

Sono inclusi soltanto gli otto tagli effettivamente usati dal foglio di stile e soltanto il subset `latin`, che copre l'italiano accentato e la punteggiatura tipografica: in tutto 300 KB. I quattro segni presenti nelle pagine che escono da quel subset (`→ ● ○ ★`) ricadono sul carattere di sistema, esattamente come accadeva prima, perché nessun subset servito da Google li conteneva.

La direttiva `font-display: swap` mostra subito il testo con il carattere di ripiego e lo sostituisce a caricamento concluso, evitando l'intervallo di pagina vuota che si avrebbe con il comportamento predefinito.

Il sito non effettua oggi **nessuna richiesta a domini esterni**: è la premessa che rende possibile quanto descritto in §6.6.

Come descritto in §6.2, l'oro di marca è usato per filetti, bordi e sfondi, mentre **come colore di testo** il foglio di stile ricorre a due varianti calibrate sul fondo, perché la tonalità originale non raggiungeva il contrasto minimo richiesto.

Al design system appartengono anche i **nomi delle classi**. Nella prima stesura ogni pagina aveva battezzato a modo suo componenti identici: la stessa griglia di card compariva con undici nomi diversi (`.ph-grid`, `.val-grid`, `.feat-grid`, `.lic-grid`, `.ris-grid`…), l'occhiello sopra il titolo con altrettanti (`.ph-num`, `.vn`, `.feat-n`, `.ris-n`…), e la card in evidenza era marcata di volta in volta `.active`, `.dark`, `.featured`, `.after` o — su *chi siamo* — da un `:nth-child(2)` che dipendeva dalla posizione nella griglia. Il foglio pagava quella traduzione a ogni regola, sotto forma di elenchi di selettori lunghi cinque o sei voci.

I componenti che si ripetono hanno ora un nome solo: `.card-grid` (con `.card-grid-2` per le griglie a due colonne), `.label-sm` per l'occhiello — la stessa idea di `.label`, un gradino più in piccolo — `.card-dark` per la variante scura, `.card-price` per la cifra in caratteri display, `.note-box` per il riquadro su fondo oro tenue. Sono rimaste le classi che dicono *cosa* è un elemento e non solo come è colorato (`.active` per la fase in corso, `.before` e `.after` per il confronto prima e dopo), mentre quelle puramente descrittive (`.dark`, `.featured`) sono sparite. Restano al loro posto anche i nomi delle sezioni (`.valori`, `.problema`, `.faq`…): raggruppano più sezioni sotto uno stesso sfondo, ma descrivono il contenuto, e sostituirli con classi come `.sfondo-crema` sposterebbe nell'HTML una decisione che appartiene al foglio di stile.

Il consolidamento ha reso visibile una dipendenza dalla specificità che i nomi lunghi tenevano nascosta. `.ph-card.active` (due classi) vinceva su `.ph-card` (una) a prescindere dalla posizione nel foglio; `.card-dark` da sola perderebbe invece contro il fondo che ogni pagina assegna alla propria card, dichiarato più avanti. Le due regole che dipingono la card scura sono perciò scritte a partire dalla griglia che la contiene, `.card-grid .card-dark`, che è esattamente il gradino di specificità mancante. Lo stesso vale per l'occhiello: essendo un `<p>`, perde il confronto con la regola che colora tutti i paragrafi della card, e dove quella regola esiste il colore va dichiarato un livello più in profondità.

### 3.3 Layout non lineare

Il requisito di un layout non semplicemente lineare è soddisfatto da tre tecniche, tutte fuori dal flusso normale del documento:

1. **Barra di navigazione ancorata:** `#nav` usa `position: fixed; top: 0; left: 0; right: 0; z-index: 200`, restando visibile durante lo scorrimento.
2. **Griglie asimmetriche con CSS Grid:** la hero e il caso studio usano colonne di larghezza diversa (`grid-template-columns: 1fr 400px`) e griglie a `gap: 1px` su fondo colorato, che producono l'effetto di "caselle" archivistiche separate da un filetto. In tutto il foglio di stile sono presenti 13 contesti di griglia: erano 18 prima che il consolidamento descritto in §3.2 riducesse a una sola le undici griglie di card.
3. **Confronto "prima e dopo":** in `caso-studio.php`, due colonne a contrasto invertito (pergamena contro inchiostro) affiancano il processo manuale e quello digitalizzato.

A questi si aggiungono elementi in `position: absolute` usati come decorazione (la lettera "A" in filigrana nella hero, i punti della timeline).

### 3.4 Comportamento responsive: impostazione mobile-first

Il foglio di stile è scritto **mobile-first**: le regole di base descrivono lo schermo stretto, e un unico punto di rottura a `961px` introduce la disposizione desktop tramite `@media (min-width: 961px)`.

Concretamente, ogni griglia nasce a colonna singola:

```css
.card-grid {
  display: grid; grid-template-columns: 1fr;
  gap: 24px; background: var(--border);
}
```

e le colonne multiple arrivano dal blocco desktop della sezione:

```css
@media (min-width: 961px) {
  .card-grid { grid-template-columns: repeat(3,1fr); gap: 2px; }
}
```

I blocchi `@media` non sono raccolti in coda al file ma collocati **al termine della sezione che riguardano** — uno per le griglie comuni, uno per il piè di pagina, uno per ciascuna pagina — così che la variante desktop di un componente si legga accanto alla sua definizione di base.

Il passo orizzontale delle fasce a tutta larghezza è centralizzato in una variabile, ridichiarata una sola volta per il desktop:

```css
:root { --pad-x: 20px; }
@media (min-width: 961px) {
  :root { --pad-x: clamp(24px, 5vw, 72px); }
}
```

Dodici regole (barra di navigazione, sezioni, fasce, piè di pagina, intestazioni di pagina, area riservata) usano `var(--pad-x)`: il margine di pagina si modifica in un punto solo.

#### Perché non uno strato correttivo `max-width`

L'impostazione precedente definiva il layout desktop nelle regole di base e lo correggeva a valle con un blocco `@media (max-width: 960px)` che riportava a colonna singola tutte le griglie. Quel blocco aveva bisogno di **nove dichiarazioni `!important`** per vincere sulle regole che stava annullando, ed è un difetto strutturale, non estetico: `!important` scavalca la specificità, quindi una regola mirata perde contro una regola generica dichiarata dopo di essa.

Il caso concreto emerso in questo progetto: i titoli di colonna del piè di pagina sono governati da `.footer-col h2 { font-size: 10px }`, ma lo strato correttivo conteneva `h2 { font-size: clamp(28px, 6vw, 36px) !important }`. Su schermo stretto vinceva quest'ultima, e le etichette "Studio", "Prodotti", "Contatti" venivano rese a 28px anziché a 10px — visibile solo sotto i 960px. Rimosso lo strato, la regola specifica torna a valere e il difetto sparisce senza alcun intervento mirato.

Nel foglio di stile non resta oggi nessun `!important` di layout: gli unici tre superstiti sono quelli, idiomatici, del blocco `prefers-reduced-motion`, dove servono proprio a scavalcare qualunque animazione dichiarata altrove.

### 3.5 Contenuti multimediali: il filmato dimostrativo

La scheda prodotto ospita un filmato di un minuto e diciotto che mostra Foliarium in funzione: la schermata iniziale, l'elenco dei comuni, la scheda di una partita, l'albero delle variazioni, la ricerca, l'esportazione in CSV, Excel e PDF, e infine reportistica e statistiche. È l'unico contenuto temporale del sito, e le scelte che lo riguardano seguono lo stesso criterio del resto del progetto.

**Ospitato in proprio, non incorporato.** Un `<iframe>` di YouTube o Vimeo avrebbe risolto il problema in una riga, al prezzo di reintrodurre in pagina un dominio terzo che riceve l'indirizzo IP di ogni visitatore e imposta cookie — esattamente ciò che §3.2 ha eliminato con i caratteri tipografici e su cui poggia §6.6. Il filmato sta quindi in `video/`, servito dallo stesso dominio del resto del sito, e nulla cambia nell'informativa privacy.

**Due codifiche, per una ragione misurata.** Il file è servito in H.264 (1,6 MB) e in VP9 (1,5 MB). La differenza di peso è trascurabile e da sola non giustificherebbe due file; la ragione è un'altra, emersa provando: il browser usato per le verifiche automatiche è una build di Chromium **senza codec proprietari**, e dell'H.264 non sa che farsene. È esattamente la situazione che il secondo formato esiste per coprire. L'ordine dei `<source>` mette il WebM per primo, perché il browser prende il primo che sa riprodurre.

**Il preload: `none`, non `metadata`.** La scelta di partenza era `preload="metadata"`, che in teoria fa scaricare la sola intestazione del file. Il registro degli accessi di Apache dice altro:

| Attributo | Richieste al filmato al caricamento | Byte inviati dal server |
| :--- | :--- | :--- |
| `preload="metadata"` | 1 | 1.518.502 (il file intero) |
| `preload="none"` | 0 | 0 |

Per leggere la durata il browser chiede `Range: bytes=0-`, e il server gli spedisce tutto. Un megabyte e mezzo scaricato da chi il filmato non lo guarda è un megabyte e mezzo sprecato, e su hosting condiviso è banda che si paga. Con `preload="none"` si carica il solo fotogramma poster (67 KB) e il file arriva al primo clic su *Riproduci*. Il prezzo è che la durata totale compare solo dopo l'avvio: per questo è scritta nella didascalia.

La scheda prodotto pesa così **352 KB** al caricamento, contro i 183 KB di una pagina senza immagini: il filmato non incide finché non lo si chiede.

**Accessibilità.** I controlli sono quelli nativi di `<video controls>`, per la stessa ragione per cui il menu e le FAQ sono `<button>` e non `<div>` (§6.1): sono già nell'ordine di tabulazione, rispondono a `Barra spaziatrice` e alle frecce, e vengono annunciati correttamente senza una riga di JavaScript. Il filmato è muto, quindi il criterio sui sottotitoli (WCAG 1.2.2) non si applica; si applica però quello sull'alternativa al contenuto temporale (1.2.1), risolto con una descrizione passo per passo dentro un elemento `<details>` nella didascalia — apribile da tastiera e senza JavaScript, e utile anche a chi la pagina la legge soltanto. Non c'è autoplay né loop, `width` e `height` sono dichiarati contro lo slittamento del layout, e il poster evita il rettangolo nero.

**Il taglio.** La registrazione originale durava 84 secondi e nei suoi ultimi istanti passava dalla schermata delle statistiche a quella di gestione degli utenti, dove è leggibile un indirizzo email personale. Il filmato pubblicato si ferma a 78,2 secondi: chiude sui grafici, che è anche un finale migliore, e non pubblica un recapito privato su una pagina indicizzabile.

**Nel foglio di stile** il filmato non ha introdotto un componente nuovo: la regola che vestiva le schermate è diventata `.shot img, .shot video`, perché è la stessa figura con un media diverso. È la disciplina descritta in §3.2.

---

## 4. CLIENT-SIDE: JAVASCRIPT VANILLA

`main.js` contiene tre comportamenti, scritti in JavaScript ES6+ senza librerie.

* **Menu di navigazione (mobile).** Il pulsante apre e chiude l'elenco dei collegamenti, aggiornando l'attributo `aria-expanded`; il tasto `Esc` chiude il menu e riporta il focus sul pulsante che lo aveva aperto.
* **Ombra della barra allo scorrimento.** Un listener su `scroll` aggiunge la classe `.scrolled` a `#nav` oltre i 20 px, staccando visivamente la barra dal contenuto.
* **FAQ a fisarmonica.** Al clic su una domanda le altre risposte si chiudono; l'apertura è animata sulla proprietà `max-height` e comunicata alle tecnologie assistive tramite `aria-expanded`.

Entrambi i comandi interattivi sono elementi **`<button>` nativi**: la scelta è discussa in §6.1.

---

## 5. SERVER-SIDE E PERSISTENZA DATI

### 5.1 Architettura

Un modulo che invii una email via `mailto:` o simuli l'invio in JavaScript non garantisce né persistenza né tracciabilità. Il progetto adotta quindi l'architettura a tre livelli **Client (HTML/CSS/JS) → Application server (PHP 8) → Database server (MySQL/MariaDB)**.

### 5.2 Base di dati (`algorast_db`)

```sql
CREATE DATABASE IF NOT EXISTS algorast_db
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE algorast_db;

CREATE TABLE IF NOT EXISTS contatti (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    nome             VARCHAR(100) NOT NULL,
    ente             VARCHAR(100),
    email            VARCHAR(100) NOT NULL,
    tipo             VARCHAR(50),
    messaggio        TEXT         NOT NULL,
    consenso_privacy TINYINT(1)   NOT NULL DEFAULT 0,
    data_consenso    DATETIME     DEFAULT NULL,
    data_invio       DATETIME     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
```

Le colonne `consenso_privacy` e `data_consenso` sono state aggiunte in un secondo momento, dopo la prima messa in produzione della tabella; su un'installazione preesistente `CREATE TABLE IF NOT EXISTS` non le aggiunge da solo, quindi `crea_db.sql` prevede anche l'`ALTER TABLE` corrispondente da eseguire una tantum.

La codifica `utf8mb4` copre l'intero repertorio Unicode, inclusi i caratteri accentati e i segni tipografici usati nei nomi di enti e località.

### 5.3 Flusso di elaborazione

1. **Verifica del metodo HTTP.** Una richiesta che non sia `POST` (tipicamente l'apertura diretta dell'URL) non ha dati da elaborare: lo script risponde con un redirect `303 See Other` verso `contatti.php`, invece di mostrare una pagina di errore priva di significato.
2. **Validazione.** `trim()` sui campi, controllo dei campi obbligatori, `filter_var($email, FILTER_VALIDATE_EMAIL)` per la correttezza formale dell'indirizzo. Messaggi di errore distinti per campi mancanti e per email non valida.
3. **Inserimento con istruzione preparata.**

```php
$stmt = $conn->prepare(
    'INSERT INTO contatti (nome, ente, email, tipo, messaggio,
                           consenso_privacy, data_consenso)
     VALUES (?, ?, ?, ?, ?, 1, NOW())'
);
$stmt->bind_param('sssss', $nome, $ente, $email, $tipo, $messaggio);
$stmt->execute();
```

   I segnaposto `?` e il binding separato dei parametri tengono distinti comandi SQL e dati forniti dall'utente: il contenuto dei campi non può essere reinterpretato come istruzione. Un invio con `nome = "Rossi'); DROP TABLE contatti; --"` viene memorizzato come stringa letterale e la tabella resta intatta.
4. **Pagina di esito.** In base all'esito lo script produce una pagina di conferma personalizzata o una scheda di errore, entrambe con la navigazione, il piè di pagina e il foglio di stile del resto del sito.

### 5.4 Escaping: una sola volta, in uscita

I dati vengono salvati nel database **così come l'utente li ha scritti**, e `htmlspecialchars()` viene applicato soltanto al momento di stamparli nella pagina.

Applicare l'escaping anche in ingresso — errore frequente, perché sembra "più sicuro" — produce una doppia codifica: un cognome come `Sant'Angelo` verrebbe memorizzato come `Sant&#039;Angelo` e ristampato a video come `Sant&amp;#039;Angelo`. Il database si riempirebbe di entità HTML al posto dei caratteri reali, rendendo inutilizzabili i dati per qualsiasi uso diverso dalla pagina web (esportazioni, email, ricerche). La protezione dalle *SQL injection* è affidata all'istruzione preparata, non all'escaping HTML, che serve a un problema diverso (*Cross-Site Scripting*, in uscita).

### 5.5 Gestione degli errori e credenziali

I parametri di connessione stanno in `config-db.php`, separati dalla logica. L'ambiente locale è stato inoltre configurato con **lo stesso nome di database, lo stesso utente e la stessa password** dell'hosting: il file è quindi identico nei due ambienti, e la pubblicazione non richiede di modificarlo affatto.

È una precauzione contro l'errore più banale del passaggio in produzione, che non è sbagliare le credenziali ma dimenticarsene: si carica il sito, si lascia il file con i valori locali e il modulo di contatto smette di scrivere: oppure, più insidioso, si aggiorna il file sull'hosting e alla successiva sincronizzazione lo si sovrascrive con la copia locale. Se il file non deve cambiare, nessuna delle due cose può accadere. Il prezzo è dover tenere anche in locale credenziali non banali, invece dell'utente `root` senza password che gli ambienti di sviluppo propongono come impostazione predefinita — il che, per inciso, è comunque una buona abitudine.

Resta valido, e anzi diventa più stringente, che in un deployment reale il file vada **escluso dal versionamento**: ora è l'unico punto in cui compare in chiaro una password che vale anche in produzione.

A partire da PHP 8.1 l'estensione `mysqli` segnala gli errori **sollevando eccezioni** anziché valorizzando `connect_error`. Un controllo scritto nella forma tradizionale `if ($conn->connect_error)` non verrebbe quindi mai eseguito, e un database irraggiungibile produrrebbe una traccia di stack contenente host, utente e percorso del file. La connessione è perciò racchiusa in un `try/catch`: all'utente arriva un messaggio generico, il dettaglio tecnico finisce nel log del server tramite `error_log()`.

### 5.6 Consenso al trattamento

Il modulo raccoglie dati personali e li scrive in un database: la base giuridica su cui poggia il trattamento è il consenso dell'interessato. Prima del pulsante di invio è quindi presente una casella obbligatoria che rimanda all'informativa:

```html
<div class="form-consenso">
  <input type="checkbox" id="consenso" name="consenso" value="1" required>
  <label for="consenso">Ho letto l'<a href="privacy.php">informativa
    privacy</a> e acconsento al trattamento dei miei dati personali
    per ricevere una risposta a questa richiesta.</label>
</div>
```

L'attributo `required` fa segnalare l'omissione dal browser, ma il controllo che conta è quello lato server, perché la validazione client si aggira banalmente:

```php
$consenso = isset($_POST['consenso']) && $_POST['consenso'] === '1';
```

Senza consenso lo script non esegue alcun inserimento e restituisce un messaggio di errore specifico. Quando invece il consenso c'è, non viene registrato soltanto il fatto che la casella fosse spuntata: l'articolo 7 del Regolamento richiede di poter **dimostrare** che il consenso è stato prestato, quindi la tabella conserva anche il momento in cui è avvenuto, nelle colonne `consenso_privacy` e `data_consenso`.

### 5.7 Area riservata: le altre tre operazioni sull'archivio

Il flusso descritto fin qui esegue **una sola** delle quattro operazioni fondamentali su una tabella: l'inserimento. Lettura, modifica ed eliminazione restavano possibili soltanto da phpMyAdmin, cioè dal pannello di amministrazione del DBMS. È un limite pratico e insieme giuridico: la sezione 4 dell'informativa promette che le richieste vengono cancellate al termine del periodo di conservazione, e gli articoli 16 e 17 del Regolamento riconoscono all'interessato il diritto di ottenere rettifica e cancellazione dei propri dati. Una promessa che si può mantenere solo aprendo il pannello del database è una promessa fragile.

`archivio.php` completa il quadro con una schermata di servizio protetta da password, raggiungibile dalla voce "Area riservata" della barra di navigazione e dal collegamento omonimo nel piè di pagina. Le quattro operazioni si distribuiscono così:

| Operazione | Istruzione SQL | Come viene richiesta |
| :--- | :--- | :--- |
| Lettura (*Read*) | `SELECT` | `GET archivio.php` |
| Inserimento (*Create*) | `INSERT` | `POST` con `azione=crea` |
| Modifica (*Update*) | `UPDATE` | `POST` con `azione=aggiorna` |
| Eliminazione (*Delete*) | `DELETE` | `POST` con `azione=elimina` |

#### Un solo file, tre viste

Elenco, modifica e conferma di eliminazione sono rami della stessa pagina, non file distinti: la sequenza **richiesta → azione → risposta** resta leggibile dall'alto in basso, come in `invia-contatto.php`. In testa allo script stanno le azioni che scrivono, subito sotto le interrogazioni di lettura, e solo in fondo il markup. Nessuna riga di HTML viene prodotta prima che si sappia come è andata l'operazione: è la condizione perché il redirect del punto successivo possa funzionare, dato che le intestazioni HTTP vanno inviate prima del corpo della risposta.

#### Le scritture viaggiano solo in POST

Un collegamento in `GET` viene seguito dai crawler dei motori di ricerca e ripetuto dal tasto "aggiorna" del browser: affidare a un `GET` la cancellazione di una riga significa consegnare l'archivio al primo indicizzatore che passa. Nella schermata i collegamenti "Modifica" ed "Elimina" sono effettivamente `GET`, ma non toccano nulla: aprono soltanto la vista corrispondente. Tutto ciò che scrive è un `POST`.

#### Post/Redirect/Get

Dopo ogni scrittura lo script non produce direttamente una pagina, ma risponde con un redirect `303 See Other` verso sé stesso. Ricaricare la pagina di esito ripete quindi una lettura, non l'inserimento o l'eliminazione appena eseguiti — il classico problema del modulo inviato due volte per un `F5` di troppo. Il messaggio di esito e, in caso di errore di validazione, i valori digitati vengono trasportati **in sessione** e non nella *querystring*: un messaggio ripreso dall'URL sarebbe testo di provenienza esterna stampato in pagina, cioè esattamente ciò che si evita in §5.4.

#### Token anti-CSRF

Il cookie di sessione viene allegato dal browser a **qualsiasi** richiesta diretta al sito, anche a quella partita da una pagina ostile aperta in un'altra scheda. Senza contromisure, un modulo nascosto su un sito di terzi potrebbe inviare a `archivio.php` un `POST` di eliminazione, e il server lo eseguirebbe come se fosse legittimo. La contromisura è un valore casuale noto soltanto alla sessione, ricopiato in ogni modulo della pagina e verificato a ogni scrittura:

```php
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
/* ... a ogni operazione che scrive ... */
if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
    /* richiesta respinta */
}
```

Una pagina di terzi non può leggere quel valore, quindi non può costruire una richiesta valida. Il confronto usa `hash_equals()` e non l'operatore `===` perché il primo non si ferma al primo carattere diverso: il tempo di risposta non lascia intuire quanto ci si è avvicinati al token.

#### Autenticazione

Il file `config-admin.php` non contiene la password ma la sua **impronta** calcolata con `password_hash()`, isolata dalla logica applicativa come i parametri del database:

```php
if (password_verify($_POST['password'] ?? '', $cfgAdmin['password_hash'])) {
    session_regenerate_id(true);
    $_SESSION['archivio_admin'] = true;
}
```

L'algoritmo bcrypt è lento per costruzione e applica un *sale* diverso a ogni chiamata: due impronte della stessa password sono diverse fra loro e non sono confrontabili con una tabella precalcolata. `session_regenerate_id(true)` sostituisce l'identificativo di sessione nel momento in cui cambiano i privilegi, così un identificativo eventualmente imposto prima dell'accesso non vale più nulla (*session fixation*). Il messaggio di errore è unico e generico: a un estraneo non si conferma mai quale metà della credenziale ha indovinato.

I limiti dell'impostazione sono dichiarati nel commento in testa al file: una password unica condivisa è sufficiente per un pannello dimostrativo su una singola postazione, mentre un archivio in produzione richiederebbe utenze nominali, HTTPS obbligatorio, limitazione dei tentativi di accesso e registro degli accessi.

#### La conferma di eliminazione è una pagina, non una finestra di dialogo

Un `confirm()` JavaScript sparirebbe con lo script disattivato, lasciando un pulsante che cancella al primo clic. La conferma è quindi una vista a sé, raggiunta in `GET`, che mostra per esteso il dato in procinto di sparire — nome, indirizzo, data e testo integrale del messaggio — e contiene il solo modulo `POST` che esegue davvero l'eliminazione. Funziona senza JavaScript e dà modo di accorgersi di aver scelto la riga sbagliata.

#### La data del consenso non si riscrive a ogni salvataggio

Se la modifica sovrascrivesse `data_consenso` con `NOW()` a ogni salvataggio, la prova richiesta dall'articolo 7 del Regolamento (§5.6) diventerebbe la data dell'ultima correzione di un refuso, non il momento in cui il consenso è stato prestato. La colonna viene perciò valorizzata solo alla prima spunta e azzerata in caso di revoca:

```sql
UPDATE contatti
   SET nome = ?, ente = ?, email = ?, tipo = ?, messaggio = ?,
       consenso_privacy = ?,
       data_consenso = IF(? = 1, COALESCE(data_consenso, NOW()), NULL)
 WHERE id = ?
```

#### Continuità con il resto del progetto

Ogni interrogazione passa da un'istruzione preparata e ogni dato stampato a video passa da `htmlspecialchars()`: le stesse due regole di §5.3 e §5.4, applicate qui a un numero molto maggiore di valori in uscita. La schermata riusa i componenti già definiti nel foglio di stile e, su schermo stretto, la tabella non si comprime ma scorre orizzontalmente dentro un contenitore dichiarato `role="region"` e focalizzabile da tastiera, che si può quindi scorrere anche senza mouse; il messaggio di esito è marcato `role="status"`, perché venga annunciato dai lettori di schermo senza sottrarre il focus. La pagina porta infine `<meta name="robots" content="noindex, nofollow">`: una schermata di servizio non ha ragione di comparire nei motori di ricerca.

---

## 6. USABILITÀ E ACCESSIBILITÀ

L'accessibilità è stata trattata come requisito di progetto e non come rifinitura finale. Le verifiche sono state condotte con il **W3C Nu Markup Validation Service** per la correttezza formale e con **axe-core** (motore di analisi automatica delle regole WCAG) per il comportamento, su tutte le pagine e su due larghezze di viewport (1440 px e 390 px).

### 6.1 Comandi interattivi azionabili da tastiera

Il menu a scomparsa e la fisarmonica delle FAQ erano inizialmente `<div>` con un gestore `onclick`. Un `<div>` non è raggiungibile con il tasto `Tab` e non risponde a `Invio` o `Barra spaziatrice`: entrambi i comandi funzionavano solo con il mouse. L'aggiunta di `role="button"` e `tabindex="0"` al solo elemento del menu peggiorava anzi la situazione, perché faceva annunciare l'elemento come pulsante a uno screen reader senza renderlo effettivamente azionabile.

Entrambi sono stati riscritti come elementi **`<button type="button">` nativi**. Un pulsante nativo è già nell'ordine di tabulazione, risponde a `Invio` e `Barra spaziatrice` senza codice aggiuntivo, viene annunciato correttamente e riceve gli stili di focus del sistema. Lo stato di apertura è esposto con `aria-expanded`, e `aria-controls` collega il comando al blocco che governa:

```html
<button type="button" class="faq-trigger"
        aria-expanded="false" aria-controls="faq-a1">
  <span>Quanto tempo ci vuole per installare Foliarium?</span>
  <span class="faq-toggle" aria-hidden="true">+</span>
</button>
```

Il segno `+` che ruota in `×` è decorativo e duplicherebbe l'informazione già data da `aria-expanded`: è quindi marcato `aria-hidden="true"`. Ogni domanda è inoltre racchiusa in un `<h3>`, così che la lista delle FAQ sia percorribile anche navigando per intestazioni.

Quando una risposta è chiusa, oltre a `max-height: 0` le viene applicato `visibility: hidden`, con la transizione ritardata a fine animazione: il testo non resta leggibile agli screen reader mentre `aria-expanded` dichiara il blocco chiuso.

### 6.2 Contrasto cromatico

L'analisi automatica ha inizialmente rilevato **200 violazioni** del criterio WCAG 2.1 AA sul contrasto (1.4.3), distribuite su tutte e cinque le pagine. Le cause erano tre:

| Causa | Rapporto misurato | Richiesto |
| :--- | :--- | :--- |
| Oro `#B8821A` come testo su fondo pergamena (tutte le etichette in maiuscoletto) | 2,93:1 | 4,5:1 |
| Testo avorio semitrasparente su fondo scuro con opacità troppo bassa (piè di pagina a `.25`) | 2,07:1 | 4,5:1 |
| Testo avorio sul pulsante oro | 3,30:1 | 4,5:1 |

Gli interventi hanno preservato l'identità visiva invece di appiattire la palette:

* l'oro di marca `--gold` resta invariato per **filetti, bordi, pallini e sfondi**, dove il criterio sul contrasto del testo non si applica;
* per il **testo** sono state introdotte due varianti calibrate sul fondo: `--gold-text: #845C10` sui fondi chiari (minimo 4,84:1) e `--gold-on-dark: #C9942B` sui fondi scuri (minimo 5,93:1);
* le opacità del testo chiaro su fondo scuro sono state portate al valore minimo che soddisfa il criterio (0,62 sull'inchiostro, 0,72 sul verde archivio);
* il pulsante oro ha ora testo color inchiostro (5,35:1), lo stesso trattamento già usato dalle altre etichette su fondo oro.

Al termine, le violazioni rilevate sono **0** su tutte le pagine e su entrambe le larghezze di viewport.

### 6.3 Struttura, landmark e collegamento di salto

Il contenuto di ogni pagina è racchiuso in `<main id="contenuto">`; con `<nav>` e `<footer>` questo garantisce che nessuna porzione di pagina resti fuori da un landmark, e permette agli utenti di screen reader di saltare direttamente al contenuto.

La prima tabulazione di ogni pagina incontra un **collegamento di salto**, nascosto fuori dallo schermo con `transform: translateY(-120%)` e reso visibile da `.skip-link:focus`. Senza di esso, un utente che naviga da tastiera dovrebbe attraversare l'intero menu su ogni pagina prima di raggiungere il testo.

La gerarchia delle intestazioni è continua su tutte le pagine: un solo `<h1>`, sezioni `<h2>`, blocchi `<h3>`, senza salti di livello.

### 6.4 Focus, movimento e modulo

* **Focus visibile.** Una regola `:focus-visible` unica applica un contorno oro a ogni elemento attivabile, con una variante più chiara sui fondi scuri. I campi del modulo avevano `outline: none` e affidavano il segnale di focus al solo colore del bordo: la dichiarazione è stata rimossa.
* **Movimento.** Le animazioni di ingresso e lo scorrimento morbido sono racchiusi in `@media (prefers-reduced-motion: no-preference)`; a chi ha richiesto meno animazioni nelle impostazioni di sistema il sito risponde senza transizioni.
* **Modulo.** Le etichette sono associate ai campi tramite `for`/`id`. Il campo del messaggio, obbligatorio lato server, porta ora anche l'attributo `required`, così l'errore viene segnalato dal browser prima dell'invio invece di costare un cambio di pagina. Nella scheda dei recapiti alcuni `<label>` erano usati come testo decorativo, senza alcun controllo da etichettare: sono stati sostituiti da `<span>`.

### 6.5 Validazione W3C

Tutte le pagine, **incluse l'informativa privacy ed entrambe le varianti della pagina di esito** (conferma ed errore), superano la validazione senza errori né avvisi. Le segnalazioni emerse durante lo sviluppo e come sono state risolte:

| Segnalazione | Causa | Soluzione |
| :--- | :--- | :--- |
| `aria-label on div` | Attributo ARIA su un `<div>` privo di ruolo | Elemento riscritto come `<button>` nativo (§6.1) |
| `Skipping heading level` | `<h4>` sotto sezioni gestite con `<h2>` | Alberatura dei titoli ristrutturata su `<h3>` |
| `Skipping heading level` (piè di pagina) | I titoli di colonna erano `<h3>`; nella pagina di esito, dove il titolo principale è un `<h1>` e non esistono sezioni `<h2>`, saltavano un livello | Titoli di colonna portati a `<h2>` |
| Stili inline | Attributi `style="..."` nei blocchi di layout | Regole centralizzate nel solo `style.css` |

### 6.6 Nessun cookie e nessun terzo

Le pagine pubbliche non impostano cookie — né propri né di terze parti — non usano strumenti di analisi statistica e, una volta ospitati localmente i caratteri tipografici (§3.2), non effettuano alcuna richiesta a domini esterni. Di conseguenza **non è necessario alcun banner di consenso ai cookie**: non c'è nulla da consentire.

L'unica eccezione è l'area riservata (§5.7): l'accesso apre una sessione PHP, e con essa il cookie tecnico `PHPSESSID`, senza il quale il pannello non avrebbe modo di riconoscere chi ha effettuato l'accesso da una richiesta alla successiva. È un cookie di sessione strettamente necessario a un servizio richiesto dall'utente, e come tale esente dal consenso ai sensi dell'articolo 122 del Codice privacy; per di più riguarda soltanto chi gestisce il sito, non chi lo visita. Va comunque dichiarato: un'eccezione taciuta vale quanto un banner mancante, ed è la ragione per cui questa relazione afferma "le pagine pubbliche" e non "il sito".

È una scelta che vale la pena rendere esplicita, perché il banner è oggi la principale fonte di attrito nella navigazione, e nella grande maggioranza dei siti serve a giustificare trattamenti che il sito potrebbe semplicemente non fare. Qui l'ordine è stato invertito: prima si è eliminato il trattamento, poi è venuto a mancare il motivo del banner.

L'informativa in `privacy.php` documenta comunque la situazione, perché l'assenza di cookie va dichiarata quanto la loro presenza, e descrive l'unico trattamento che l'utente non può evitare: la registrazione degli accessi nei file di log del server web.

---

## 7. INSTALLAZIONE E COLLAUDO IN LOCALE

1. Avviare i moduli **Apache** e **MySQL/MariaDB** del proprio ambiente locale (XAMPP, MAMP o WAMP).
2. Copiare la cartella del progetto nella directory servita dal server (per esempio `C:\xampp\htdocs\algora_site` oppure `C:\wamp64\www\algora_site`).
3. Aprire **phpMyAdmin** (`http://localhost/phpmyadmin`) ed eseguire lo script `crea_db.sql`, che crea il database `algorast_db` e la tabella `contatti`.
4. Verificare che i parametri in `config-db.php` corrispondano alla propria installazione. Il progetto usa un utente MySQL dedicato (`algorast_user`) con privilegi limitati al database `algorast_db`, invece dell'utente `root` predefinito di XAMPP/MAMP/WAMP: se l'utente non esiste ancora va creato e associato al database, altrimenti l'inserimento dei contatti fallisce con un errore di accesso. Le credenziali sono deliberatamente le stesse dell'hosting, per la ragione spiegata in §5.5: così il file non va toccato al momento della pubblicazione.
5. Aprire `http://localhost/algora_site/index.php`.
6. Per collaudare la parte server-side, aprire `http://localhost/algora_site/contatti.php`, compilare il modulo e inviarlo. Va verificato che compaia la pagina di conferma e che la riga sia presente nella tabella `contatti`.
7. Per collaudare l'area riservata (§5.7), aprire `http://localhost/algora_site/archivio.php` — o seguire la voce "Area riservata" nella barra di navigazione — ed entrare con la password dimostrativa `algora2025`. Per sostituirla si rigenera l'impronta da riga di comando e si aggiorna `config-admin.php`:

```
php -r 'echo password_hash("nuova-password", PASSWORD_DEFAULT), "\n";'
```

### 7.1 Casi di prova eseguiti

| Caso | Esito atteso | Esito |
| :--- | :--- | :--- |
| Invio corretto, con consenso | Pagina di conferma, riga inserita | Superato |
| Invio senza consenso al trattamento | Errore specifico, **nessun inserimento** | Superato |
| Consenso falsificato (valore diverso da quello atteso) | Errore specifico, nessun inserimento | Superato |
| Nome con apostrofo e `&` (`Sant'Angelo & C.`) | Caratteri corretti a video **e** nel database | Superato |
| Email formalmente non valida | Messaggio di errore specifico, nessun inserimento | Superato |
| Campi obbligatori vuoti | Messaggio di errore specifico, nessun inserimento | Superato |
| Apertura diretta di `invia-contatto.php` via URL | Redirect `303` al modulo | Superato |
| Stringa di SQL injection nel campo nome | Memorizzata come testo, tabella intatta | Superato |
| Database irraggiungibile | Messaggio generico all'utente, dettaglio nel log, nessun dato tecnico esposto | Superato |
| Area riservata: password errata | Messaggio generico, nessun accesso | Superato |
| Area riservata: `POST` di eliminazione senza sessione valida | Richiesta respinta, riga intatta | Superato |
| Area riservata: `POST` privo di token anti-CSRF | Richiesta respinta, riga intatta | Superato |
| Modifica con email non valida | Errore specifico, valori digitati riproposti nel modulo, nessuna scrittura | Superato |
| Doppio salvataggio con consenso già presente | `data_consenso` invariata | Superato |
| Revoca del consenso in modifica | `consenso_privacy` a `0` e `data_consenso` azzerata | Superato |
| Eliminazione di un numero inesistente | Messaggio specifico, nessuna riga toccata | Superato |
| Nome contenente `<b>` e apostrofo, mostrato in elenco | Stampato come testo, non interpretato dal browser | Superato |
| Caricamento della scheda prodotto con `preload="none"` | Nessuna richiesta al filmato nel registro del server | Superato |
| Riproduzione dopo il clic | Il filmato parte, durata 78,2 s letta correttamente, nessun errore | Superato |
| Richiesta del filmato con intestazione `Range` | `206 Partial Content`, quindi barra di avanzamento funzionante | Superato |
| Browser privo di codec proprietari | Ricade sul WebM e riproduce | Superato |

### 7.2 Verifica del passaggio a mobile-first

La riscrittura del foglio di stile non doveva cambiare il risultato a video. Per dimostrarlo sono state acquisite le schermate a pagina intera delle cinque pagine a `390`, `768`, `960`, `961` e `1440` px prima e dopo l'intervento, e confrontate pixel per pixel:

* a `961` e `1440` px le immagini sono risultate **identiche**, a conferma che la disposizione desktop è invariata;
* a `390`, `768` e `960` px l'unica differenza misurata riguarda l'altezza del piè di pagina, cioè esattamente la correzione descritta in §3.4; l'altezza di ogni altro elemento è rimasta invariata.

È stata inoltre verificata l'assenza di scorrimento orizzontale da `320` a `1920` px.

Lo stesso metodo è stato applicato al consolidamento dei nomi di classe descritto in §3.2, che per definizione non doveva cambiare nulla a video: ventotto schermate a pagina intera (le sette pagine per quattro larghezze) sono state confrontate pixel per pixel prima e dopo l'intervento e sono risultate **tutte identiche**, insieme alle due schermate di stato — FAQ aperta e menu mobile aperto — e alle tre larghezze estreme. I primi confronti avevano invece segnalato differenze reali, tutte dovute a regole che avevano perso il confronto di specificità: sono state la guida per correggere il consolidamento prima di considerarlo concluso.

---

## 8. PUBBLICAZIONE ONLINE

Il sito è pensato per essere pubblicato sul dominio `www.algorastudio.it`. Su hosting condiviso la procedura è la seguente:

1. Caricare i file del progetto nella cartella pubblica del dominio (tipicamente `public_html` o `httpdocs`), `video/` compresa. Non serve invece caricare i marchi sorgente in `img/marchi/` che il `LEGGIMI` dichiara non usati dalle pagine: sono 5,7 MB che nessuna pagina richiede.
2. Creare il database dal pannello dell'hosting ed eseguirvi `crea_db.sql`.
3. Creare l'utente del database con le stesse credenziali usate in locale (§5.5), così che `config-db.php` non debba essere modificato, e assegnargli i soli privilegi che il codice usa davvero: `SELECT`, `INSERT`, `UPDATE` e `DELETE` sulla tabella `contatti`. Gli ultimi due servono all'area riservata (§5.7): con i soli `INSERT` e `SELECT` il modulo pubblico funzionerebbe e il pannello no.
4. Verificare che `config-db.php` non sia raggiungibile dall'esterno e che non venga incluso nel versionamento.

---

## 9. LIMITI NOTI E SVILUPPI FUTURI

Per completezza si segnalano gli aspetti ancora aperti:

* **Lingua dei contenuti multimediali.** Le cinque schermate e il filmato dimostrativo (§3.5) mostrano l'interfaccia in italiano, e la descrizione passo per passo che accompagna il filmato è scritta in italiano. Se il sito avrà una versione inglese, quei contenuti andranno rigirati oppure accompagnati da una nota: un filmato è l'unica parte del sito che una traduzione del testo non raggiunge.
* **Dati del titolare nell'informativa.** L'informativa privacy è completa nella struttura, ma i riferimenti anagrafici del titolare (ragione sociale, partita IVA, sede), il periodo di conservazione e i fornitori nominati responsabili esterni sono segnaposto, resi graficamente evidenti nella pagina. Vanno compilati prima della pubblicazione: un'informativa pubblicata a metà è peggio di nessuna informativa. Lo stesso segnaposto della partita IVA compare nel piè di pagina.
* **Protezione del modulo pubblico.** Il token anti-CSRF descritto in §5.7 protegge l'area riservata, ma non è stato esteso al modulo di contatto, che resta privo anche di una misura anti-spam. Per un uso in produzione andrebbero aggiunti entrambi. Per la seconda è preferibile una tecnica passiva — campo esca più controllo sul tempo di compilazione — rispetto a un CAPTCHA: quelli visuali sono un ostacolo di accessibilità, e i servizi di terze parti reintrodurrebbero in pagina la dipendenza esterna eliminata in §3.2.
* **Autenticazione dell'area riservata.** L'accesso a `archivio.php` poggia su un'unica password condivisa: basta a proteggere un pannello dimostrativo, non un archivio in produzione, che richiederebbe utenze nominali, HTTPS obbligatorio, limitazione dei tentativi di accesso e registro delle operazioni eseguite. Manca inoltre una cancellazione programmata al termine del periodo di conservazione: oggi la cancellazione è un gesto manuale, per quanto ora possibile senza aprire phpMyAdmin.

---

# PROJECT TECHNICAL REPORT

*English version — [↑ Versione italiana](#relazione-tecnica-di-progetto)*

**Course:** Web and Multimedia Technologies (Master's Degree)
**Lecturer:** Prof. Marco Porta — University of Pavia
**Student:** Marco Santoro
**Project:** Algora Studio — corporate website and contact platform
**Academic Year:** 2025/2026

---

## 1. INTRODUCTION AND APPLICATION CONTEXT

This report describes the design and the technical decisions behind the website of **Algora Studio**, a software development studio specialising in vertical solutions for Italian cultural heritage and historical documentary records (State Archives, municipal historical archives, notarial offices, foundations).

The product the site's communication revolves around is **Foliarium**, a management application developed for the State Archive of Savona to digitise, relationally model and *fuzzy*-search historical land registry archives (from 1830 to the present day).

### Rationale

Most software-house websites rely on generic templates or on CMSs that fragment control over the code. Building a bespoke site serves the goal of demonstrating that native web programming (**HTML5, CSS3, Vanilla JavaScript, PHP and MySQL/MariaDB**) is enough to obtain:

1. a distinctive aesthetic ("Warm Archive") consistent with the subject matter;
2. a light network payload, with a single stylesheet and a single JavaScript file;
3. compliance with W3C validation and with the basic usability and accessibility rules covered in the course.

---

## 2. INFORMATION ARCHITECTURE AND FILE MAP

The site is built on **6 content pages**, served by PHP, plus **1 server-side script** for data persistence and **1 service screen** reserved for whoever runs the site. The shared parts are extracted into two **PHP includes** reused by every page.

| File | Role |
| :--- | :--- |
| `index.php` | **Home.** Studio vision, manifesto, summary metrics, case study preview, approach section, closing call to action. |
| `chi-siamo.php` | **Studio profile.** The philosophy of vertical development, the three guiding values, founder profile, technology stack, future prospects. |
| `foliarium.php` | **Product page.** Foliarium's features (fuzzy search, property tree, audit trail, report export), system requirements, licences and support packages. |
| `caso-studio.php` | **Case study: State Archive of Savona.** Quantitative results (69 municipalities, 12,000+ land registry entries, 8,500+ owners), "before and after" comparison, project phases. |
| `contatti.php` | **Contact and demo.** Four-step guide, contact form with consent to data processing, accordion FAQ. |
| `privacy.php` | **Privacy notice.** Data collected, purposes, legal basis, retention, data subject rights, cookie section. |
| `nav.php` | Include: navigation bar, generated from a PHP array that automatically marks the current item. |
| `footer.php` | Include: footer shared by every page. |
| `invia-contatto.php` | **Backend.** Receives the form POST, validates, inserts into the database with a prepared statement, returns the outcome page. |
| `archivio.php` | **Reserved area.** Password-protected service screen: list of requests, manual insertion, editing and deletion (§5.7). |
| `config-db.php` | Database connection parameters, kept apart from the application logic. |
| `config-admin.php` | Hash of the reserved area password, isolated like the database parameters. |
| `crea_db.sql` | DDL script creating the database and the table. |
| `style.css` | Single stylesheet for the whole site (1,518 lines, ~60 KB). |
| `main.js` | Client-side behaviours (63 lines). |
| `fonts/` | The two typefaces in WOFF2 format (8 files, 300 KB). |
| `img/` | Product screenshots and the video poster frame, with instructions in `LEGGIMI.md`. |
| `video/` | The demo video in its two encodings (§3.5). |

### 2.1 Why PHP on the content pages too

The six content pages contain no application logic, but carry the `.php` extension so that they can use `include`:

```php
<?php $active = 'home'; ?>
...
<?php include 'nav.php'; ?>
```

Navigation bar and footer therefore exist in **a single copy**. The menu item matching the current page is highlighted by comparing the `$active` variable against the keys of the array that describes the menu:

```php
$navItems = [
  'home'      => ['href' => 'index.php',    'label' => 'Home'],
  'chi-siamo' => ['href' => 'chi-siamo.php', 'label' => 'Chi siamo'],
  /* ... */
];
foreach ($navItems as $key => $item) {
  /* class="active" when $active === $key */
}
```

Without includes, a change to the menu would have to be replicated by hand across the eight files that display it — the six content pages, the outcome page and the reserved area — with a real risk of them drifting apart.

---

## 3. FRONT END: SEMANTIC HTML5, CSS3 AND DESIGN SYSTEM

### 3.1 Hand-written code and semantic structure

The code is written entirely by hand, without WYSIWYG editors and without CSS frameworks (Bootstrap, Tailwind). Every page uses the structural tags of HTML5: `<nav>` for navigation, `<main>` for the main content, `<header>` for opening sections, `<section>` for thematic blocks, `<footer>` for the closing.

The entire content of each page is wrapped in `<main id="contenuto">`: this defines the main *landmark* and makes the skip link described in §6 work.

### 3.2 The "Warm Archive" design system

Palette and typography are defined with **CSS variables** (custom properties) collected in `:root`, so that a change of shade propagates across the whole site by editing a single line:

* **Colours:** parchment backgrounds (`--parchment: #F4EFE4`, `--cream: #F9F6EF`), ink text and containers (`--ink: #1E150A`), golden accents (`--gold: #B8821A`), archive green for confirmations (`--green: #1A3A28`).
* **Typography:** *Cormorant Garamond* for display headings and *Libre Baskerville* for body text, both from Google Fonts; *Trebuchet MS / Calibri* in letter-spaced uppercase for labels and micro-copy.

The two typefaces were initially loaded with an `@import` from `fonts.googleapis.com`. That was the **only request to a third-party domain** in the entire site, and it is not a technical detail: every visit disclosed the user's IP address to an external server, without their being informed and without any way to object.

The WOFF2 files were therefore **downloaded and self-hosted**, under `fonts/`, and the `@import` was replaced by eight `@font-face` declarations:

```css
@font-face {
  font-family: 'Cormorant Garamond';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url('fonts/cormorant-garamond-400.woff2') format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, /* ... */;
}
```

Only the eight weights actually used by the stylesheet are included, and only the `latin` subset, which covers accented Italian and typographic punctuation: 300 KB in total. The four characters used in the pages that fall outside that subset (`→ ● ○ ★`) fall back to the system font, exactly as they did before, because no subset served by Google contained them either.

The `font-display: swap` directive shows the text immediately in the fallback face and swaps it once loading completes, avoiding the blank interval that the default behaviour would produce.

The site today makes **no request to any external domain**: that is the premise which makes §6.6 possible.

As described in §6.2, the brand gold is used for rules, borders and backgrounds, whereas **as a text colour** the stylesheet falls back on two variants calibrated for the background, because the original shade did not reach the required minimum contrast.

The design system also covers the **class names**. In the first draft each page had christened identical components in its own way: the same card grid appeared under eleven different names (`.ph-grid`, `.val-grid`, `.feat-grid`, `.lic-grid`, `.ris-grid`…), the eyebrow above the heading under just as many (`.ph-num`, `.vn`, `.feat-n`, `.ris-n`…), and the highlighted card was marked variously `.active`, `.dark`, `.featured`, `.after` or — on *chi siamo* — by a `:nth-child(2)` that depended on its position in the grid. The stylesheet paid for that translation in every rule, in the form of selector lists five or six entries long.

Repeated components now have a single name each: `.card-grid` (with `.card-grid-2` for two-column grids), `.label-sm` for the eyebrow — the same idea as `.label`, one step smaller — `.card-dark` for the dark variant, `.card-price` for the display-face figure, `.note-box` for the panel on a faint gold background. The classes that say *what* an element is, and not merely how it is coloured, have been kept (`.active` for the phase under way, `.before` and `.after` for the before/after comparison), while the purely descriptive ones (`.dark`, `.featured`) are gone. The section names also stay (`.valori`, `.problema`, `.faq`…): they group several sections under a shared background, but they describe the content, and replacing them with classes such as `.sfondo-crema` would move into the HTML a decision that belongs to the stylesheet.

The consolidation made visible a dependency on specificity that the long names had kept hidden. `.ph-card.active` (two classes) beat `.ph-card` (one) regardless of position in the file; `.card-dark` on its own would instead lose against the background each page assigns to its own card, declared further down. The two rules that paint the dark card are therefore written starting from the grid that contains it, `.card-grid .card-dark`, which supplies exactly the missing step of specificity. The same holds for the eyebrow: being a `<p>`, it loses against the rule that colours every paragraph of the card, and wherever that rule exists the colour has to be declared one level deeper.

### 3.3 Non-linear layout

The requirement for a layout that is not merely linear is met by three techniques, all of them outside the document's normal flow:

1. **Pinned navigation bar:** `#nav` uses `position: fixed; top: 0; left: 0; right: 0; z-index: 200`, staying visible while scrolling.
2. **Asymmetric CSS Grid layouts:** the hero and the case study use columns of different widths (`grid-template-columns: 1fr 400px`) and `gap: 1px` grids over a coloured background, producing the effect of archival "boxes" separated by a hairline. The stylesheet contains 13 grid contexts in all: there were 18 before the consolidation described in §3.2 reduced eleven card grids to one.
3. **"Before and after" comparison:** in `caso-studio.php`, two columns in inverted contrast (parchment against ink) set the manual process alongside the digitised one.

To these are added `position: absolute` elements used as decoration (the watermark letter "A" in the hero, the timeline dots).

### 3.4 Responsive behaviour: a mobile-first stylesheet

The stylesheet is written **mobile-first**: the base rules describe the narrow screen, and a single breakpoint at `961px` introduces the desktop layout through `@media (min-width: 961px)`.

Concretely, every grid starts as a single column:

```css
.card-grid {
  display: grid; grid-template-columns: 1fr;
  gap: 24px; background: var(--border);
}
```

and the multiple columns arrive from the section's desktop block:

```css
@media (min-width: 961px) {
  .card-grid { grid-template-columns: repeat(3,1fr); gap: 2px; }
}
```

The `@media` blocks are not gathered at the end of the file but placed **at the end of the section they concern** — one for the shared grids, one for the footer, one for each page — so that the desktop variant of a component reads next to its base definition.

The horizontal padding of the full-width bands is centralised in a variable, redeclared just once for desktop:

```css
:root { --pad-x: 20px; }
@media (min-width: 961px) {
  :root { --pad-x: clamp(24px, 5vw, 72px); }
}
```

Twelve rules (navigation bar, sections, bands, footer, page headers, reserved area) use `var(--pad-x)`: the page margin is changed in a single place.

#### Why not a corrective `max-width` layer

The previous arrangement defined the desktop layout in the base rules and corrected it downstream with a `@media (max-width: 960px)` block that pushed every grid back to a single column. That block needed **nine `!important` declarations** to win against the rules it was undoing, and that is a structural flaw rather than a cosmetic one: `!important` bypasses specificity, so a targeted rule loses against a generic rule declared after it.

The concrete case that surfaced in this project: the footer column headings are governed by `.footer-col h2 { font-size: 10px }`, but the corrective layer contained `h2 { font-size: clamp(28px, 6vw, 36px) !important }`. On narrow screens the latter won, and the labels "Studio", "Prodotti", "Contatti" were rendered at 28px instead of 10px — visible only below 960px. With the layer removed, the specific rule applies again and the defect disappears with no targeted fix.

No layout `!important` remains in the stylesheet today: the only three survivors are the idiomatic ones inside the `prefers-reduced-motion` block, where their whole purpose is to override any animation declared elsewhere.

### 3.5 Multimedia content: the demo video

The product page hosts a one-minute-eighteen video showing Foliarium at work: the opening screen, the list of municipalities, a land registry entry, the tree of its variations, the search, the export to CSV, Excel and PDF, and finally reporting and statistics. It is the site's only time-based content, and the decisions around it follow the same criterion as the rest of the project.

**Self-hosted, not embedded.** A YouTube or Vimeo `<iframe>` would have solved the problem in one line, at the price of putting back into the page a third-party domain that receives every visitor's IP address and sets cookies — exactly what §3.2 removed with the typefaces, and what §6.6 rests on. The video therefore lives in `video/`, served from the same domain as everything else, and the privacy notice needs no change.

**Two encodings, for a measured reason.** The file is served in H.264 (1.6 MB) and in VP9 (1.5 MB). The size difference is negligible and would not on its own justify two files; the real reason emerged while testing: the browser used for the automated checks is a Chromium build **without proprietary codecs**, and has no use for H.264. That is precisely the situation the second format exists to cover. The `<source>` order puts WebM first, because the browser takes the first one it can play.

**Preload: `none`, not `metadata`.** The starting choice was `preload="metadata"`, which in theory fetches only the file header. Apache's access log says otherwise:

| Attribute | Requests for the video on page load | Bytes sent by the server |
| :--- | :--- | :--- |
| `preload="metadata"` | 1 | 1,518,502 (the whole file) |
| `preload="none"` | 0 | 0 |

To read the duration the browser asks for `Range: bytes=0-`, and the server sends everything. A megabyte and a half downloaded by someone who never watches the video is a megabyte and a half wasted, and on shared hosting it is bandwidth that costs money. With `preload="none"` only the poster frame loads (67 KB) and the file arrives on the first click of *Play*. The price is that the total duration appears only after playback starts: hence it is stated in the caption.

The product page therefore weighs **352 KB** on load, against the 183 KB of a page with no images: the video costs nothing until it is asked for.

**Accessibility.** The controls are the native ones of `<video controls>`, for the same reason the menu and the FAQ are `<button>` rather than `<div>` (§6.1): they are already in the tab order, they respond to `Space` and to the arrow keys, and they are announced correctly without a line of JavaScript. The video is silent, so the captions criterion (WCAG 1.2.2) does not apply; the one on an alternative for time-based media (1.2.1) does, and it is met with a step-by-step description inside a `<details>` element in the caption — operable from the keyboard and without JavaScript, and useful to anyone who merely reads the page. There is no autoplay and no loop, `width` and `height` are declared against layout shift, and the poster avoids a black rectangle.

**The trim.** The original recording ran 84 seconds and in its final moments moved from the statistics screen to user management, where a personal email address is legible. The published video stops at 78.2 seconds: it closes on the charts, which is also a better ending, and it does not publish a private contact detail on an indexable page.

**In the stylesheet** the video introduced no new component: the rule that dressed the screenshots became `.shot img, .shot video`, because it is the same figure with a different medium. It is the discipline described in §3.2.

---

## 4. CLIENT SIDE: VANILLA JAVASCRIPT

`main.js` contains three behaviours, written in ES6+ JavaScript without libraries.

* **Navigation menu (mobile).** The button opens and closes the list of links, updating the `aria-expanded` attribute; the `Esc` key closes the menu and returns focus to the button that opened it.
* **Navigation bar shadow on scroll.** A `scroll` listener adds the `.scrolled` class to `#nav` beyond 20 px, visually detaching the bar from the content.
* **Accordion FAQ.** Clicking a question closes the other answers; opening is animated on the `max-height` property and communicated to assistive technologies through `aria-expanded`.

Both interactive controls are native **`<button>` elements**: the reasoning is discussed in §6.1.

---

## 5. SERVER SIDE AND DATA PERSISTENCE

### 5.1 Architecture

A form that sends an email through `mailto:` or fakes the submission in JavaScript guarantees neither persistence nor traceability. The project therefore adopts the three-tier architecture **Client (HTML/CSS/JS) → Application server (PHP 8) → Database server (MySQL/MariaDB)**.

### 5.2 Database (`algorast_db`)

```sql
CREATE DATABASE IF NOT EXISTS algorast_db
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE algorast_db;

CREATE TABLE IF NOT EXISTS contatti (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    nome             VARCHAR(100) NOT NULL,
    ente             VARCHAR(100),
    email            VARCHAR(100) NOT NULL,
    tipo             VARCHAR(50),
    messaggio        TEXT         NOT NULL,
    consenso_privacy TINYINT(1)   NOT NULL DEFAULT 0,
    data_consenso    DATETIME     DEFAULT NULL,
    data_invio       DATETIME     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
```

The `utf8mb4` encoding covers the whole Unicode repertoire, including the accented characters and typographic marks that appear in the names of institutions and places.

The `consenso_privacy` and `data_consenso` columns were added later, after the table had first gone into production; on a pre-existing installation `CREATE TABLE IF NOT EXISTS` does not add them by itself, so `crea_db.sql` also carries the corresponding one-off `ALTER TABLE`.

### 5.3 Processing flow

1. **HTTP method check.** A request that is not a `POST` (typically someone opening the URL directly) has no data to process: the script answers with a `303 See Other` redirect to `contatti.php`, instead of showing a meaningless error page.
2. **Validation.** `trim()` on the fields, check of the mandatory ones, `filter_var($email, FILTER_VALIDATE_EMAIL)` for the formal correctness of the address. Distinct error messages for missing fields and for an invalid email.
3. **Insertion with a prepared statement.**

```php
$stmt = $conn->prepare(
    'INSERT INTO contatti (nome, ente, email, tipo, messaggio,
                           consenso_privacy, data_consenso)
     VALUES (?, ?, ?, ?, ?, 1, NOW())'
);
$stmt->bind_param('sssss', $nome, $ente, $email, $tipo, $messaggio);
$stmt->execute();
```

   The `?` placeholders and the separate binding of parameters keep SQL commands and user-supplied data apart: the content of the fields cannot be reinterpreted as an instruction. A submission with `nome = "Rossi'); DROP TABLE contatti; --"` is stored as a literal string and the table is left intact.
4. **Outcome page.** Depending on the result the script produces either a personalised confirmation page or an error panel, both carrying the navigation, footer and stylesheet of the rest of the site.

### 5.4 Escaping: once only, on the way out

Data is stored in the database **exactly as the user typed it**, and `htmlspecialchars()` is applied only at the moment of printing it into the page.

Escaping on the way in as well — a frequent mistake, because it feels "safer" — produces double encoding: a surname such as `Sant'Angelo` would be stored as `Sant&#039;Angelo` and printed back on screen as `Sant&amp;#039;Angelo`. The database would fill up with HTML entities instead of real characters, making the data unusable for anything other than the web page (exports, emails, searches). Protection against *SQL injection* rests on the prepared statement, not on HTML escaping, which addresses a different problem (*Cross-Site Scripting*, on output).

### 5.5 Error handling and credentials

The connection parameters live in `config-db.php`, separate from the logic. The local environment has moreover been set up with **the same database name, the same user and the same password** as the hosting: the file is therefore identical in both environments, and publishing requires no edit to it at all.

It is a precaution against the most banal mistake of going into production, which is not getting the credentials wrong but forgetting about them: you upload the site, leave the file with the local values, and the contact form quietly stops writing — or, more insidiously, you update the file on the host and then overwrite it with the local copy on the next sync. If the file never has to change, neither can happen. The price is having to keep non-trivial credentials locally too, instead of the passwordless `root` user that development environments offer by default — which, incidentally, is a good habit anyway.

It remains true, and indeed becomes more pressing, that in a real deployment the file must be **excluded from version control**: it is now the single place where a password that also works in production appears in clear text.

From PHP 8.1 onwards the `mysqli` extension reports errors by **throwing exceptions** rather than setting `connect_error`. A check written in the traditional `if ($conn->connect_error)` form would therefore never run, and an unreachable database would produce a stack trace containing host, user and file path. The connection is consequently wrapped in a `try/catch`: the user receives a generic message, while the technical detail goes to the server log through `error_log()`.

### 5.6 Consent to data processing

The form collects personal data and writes it to a database: the legal basis for the processing is the data subject's consent. Before the submit button there is therefore a mandatory checkbox pointing to the privacy notice:

```html
<div class="form-consenso">
  <input type="checkbox" id="consenso" name="consenso" value="1" required>
  <label for="consenso">Ho letto l'<a href="privacy.php">informativa
    privacy</a> e acconsento al trattamento dei miei dati personali
    per ricevere una risposta a questa richiesta.</label>
</div>
```

The `required` attribute makes the browser flag the omission, but the check that counts is the server-side one, because client validation is trivially bypassed:

```php
$consenso = isset($_POST['consenso']) && $_POST['consenso'] === '1';
```

Without consent the script performs no insertion and returns a specific error message. When consent is given, what gets recorded is not merely the fact that the box was ticked: Article 7 of the Regulation requires being able to **demonstrate** that consent was given, so the table also preserves the moment at which it happened, in the `consenso_privacy` and `data_consenso` columns.

### 5.7 Reserved area: the other three operations on the archive

The flow described so far performs **one only** of the four fundamental operations on a table: insertion. Reading, editing and deletion remained possible only through phpMyAdmin, that is, through the DBMS administration panel. This is a limitation at once practical and legal: section 4 of the privacy notice promises that requests are erased at the end of the retention period, and Articles 16 and 17 of the Regulation grant the data subject the right to obtain rectification and erasure of their data. A promise that can be kept only by opening the database panel is a fragile promise.

`archivio.php` completes the picture with a password-protected service screen, reachable from the "Area riservata" item in the navigation bar and from the matching link in the footer. The four operations are distributed as follows:

| Operation | SQL statement | How it is requested |
| :--- | :--- | :--- |
| Read | `SELECT` | `GET archivio.php` |
| Create | `INSERT` | `POST` with `azione=crea` |
| Update | `UPDATE` | `POST` with `azione=aggiorna` |
| Delete | `DELETE` | `POST` with `azione=elimina` |

#### One file, three views

List, edit and delete confirmation are branches of the same page, not separate files: the **request → action → response** sequence stays readable from top to bottom, as in `invia-contatto.php`. The actions that write sit at the head of the script, the read queries just below, and only at the bottom the markup. No line of HTML is produced before the outcome of the operation is known: that is the precondition for the redirect described next, since HTTP headers must be sent before the response body.

#### Writes travel by POST only

A `GET` link is followed by search-engine crawlers and repeated by the browser's reload button: entrusting the deletion of a row to a `GET` means handing the archive to the first indexer that comes along. In the screen the "Modifica" and "Elimina" links are indeed `GET`, but they touch nothing: they merely open the corresponding view. Everything that writes is a `POST`.

#### Post/Redirect/Get

After every write the script does not produce a page directly but answers with a `303 See Other` redirect to itself. Reloading the outcome page therefore repeats a read, not the insertion or the deletion just performed — the classic problem of the form submitted twice because of one `F5` too many. The outcome message and, in case of a validation error, the values typed by the user travel **in the session** rather than in the query string: a message taken from the URL would be externally supplied text printed into the page, precisely what §5.4 avoids.

#### Anti-CSRF token

The session cookie is attached by the browser to **any** request directed at the site, including one originating from a hostile page open in another tab. Without countermeasures, a hidden form on a third-party site could send `archivio.php` a deletion `POST`, and the server would carry it out as though it were legitimate. The countermeasure is a random value known only to the session, copied into every form on the page and verified on every write:

```php
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
/* ... on every operation that writes ... */
if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
    /* request rejected */
}
```

A third-party page cannot read that value, and therefore cannot build a valid request. The comparison uses `hash_equals()` rather than the `===` operator because the former does not stop at the first differing character: the response time gives away nothing about how close an attacker got to the token.

#### Authentication

The file `config-admin.php` does not hold the password but its **hash**, computed with `password_hash()` and isolated from the application logic just like the database parameters:

```php
if (password_verify($_POST['password'] ?? '', $cfgAdmin['password_hash'])) {
    session_regenerate_id(true);
    $_SESSION['archivio_admin'] = true;
}
```

The bcrypt algorithm is slow by design and applies a different *salt* on every call: two hashes of the same password differ from each other and cannot be looked up in a precomputed table. `session_regenerate_id(true)` replaces the session identifier at the moment privileges change, so that an identifier possibly imposed before login is worth nothing afterwards (*session fixation*). The error message is single and generic: a stranger is never told which half of the credentials they guessed right.

The limits of the arrangement are stated in the comment at the head of the file: one shared password is enough for a demonstration panel on a single workstation, whereas an archive in production would call for named accounts, mandatory HTTPS, rate limiting on login attempts and an access log.

#### The delete confirmation is a page, not a dialog box

A JavaScript `confirm()` would vanish with scripting disabled, leaving a button that deletes on the first click. The confirmation is therefore a view of its own, reached by `GET`, showing in full the record about to disappear — name, address, date and the complete text of the message — and containing the only `POST` form that actually performs the deletion. It works without JavaScript and gives you a chance to notice you picked the wrong row.

#### The consent date is not rewritten on every save

If editing overwrote `data_consenso` with `NOW()` on every save, the evidence required by Article 7 of the Regulation (§5.6) would become the date of the last typo correction rather than the moment consent was given. The column is therefore set only on the first tick and cleared if consent is withdrawn:

```sql
UPDATE contatti
   SET nome = ?, ente = ?, email = ?, tipo = ?, messaggio = ?,
       consenso_privacy = ?,
       data_consenso = IF(? = 1, COALESCE(data_consenso, NOW()), NULL)
 WHERE id = ?
```

#### Continuity with the rest of the project

Every query goes through a prepared statement and every value printed on screen goes through `htmlspecialchars()`: the same two rules as §5.3 and §5.4, applied here to a far larger number of output values. The screen reuses the components already defined in the stylesheet and, on narrow screens, the table does not compress but scrolls horizontally inside a container declared `role="region"` and focusable from the keyboard, so it can be scrolled without a mouse; the outcome message is marked `role="status"`, so that screen readers announce it without stealing focus. Finally the page carries `<meta name="robots" content="noindex, nofollow">`: a service screen has no reason to appear in search engines.

---

## 6. USABILITY AND ACCESSIBILITY

Accessibility was treated as a project requirement rather than as a finishing touch. Checks were carried out with the **W3C Nu Markup Validation Service** for formal correctness and with **axe-core** (an automated WCAG rule engine) for behaviour, across every page and at two viewport widths (1440 px and 390 px).

### 6.1 Interactive controls operable from the keyboard

The collapsible menu and the FAQ accordion were initially `<div>`s with an `onclick` handler. A `<div>` cannot be reached with `Tab` and does not respond to `Enter` or `Space`: both controls worked with the mouse only. Adding `role="button"` and `tabindex="0"` to the menu element alone actually made things worse, because it made a screen reader announce the element as a button without making it genuinely operable.

Both were rewritten as native **`<button type="button">`** elements. A native button is already in the tab order, responds to `Enter` and `Space` with no extra code, is announced correctly and receives the system focus styles. The open state is exposed with `aria-expanded`, and `aria-controls` ties the control to the block it governs:

```html
<button type="button" class="faq-trigger"
        aria-expanded="false" aria-controls="faq-a1">
  <span>Quanto tempo ci vuole per installare Foliarium?</span>
  <span class="faq-toggle" aria-hidden="true">+</span>
</button>
```

The `+` sign that rotates into `×` is decorative and would duplicate the information already carried by `aria-expanded`: it is therefore marked `aria-hidden="true"`. Each question is moreover wrapped in an `<h3>`, so that the FAQ list can also be traversed by navigating through headings.

When an answer is closed, besides `max-height: 0` it also receives `visibility: hidden`, with the transition delayed to the end of the animation: the text does not stay readable to screen readers while `aria-expanded` declares the block closed.

### 6.2 Colour contrast

Automated analysis initially reported **200 violations** of WCAG 2.1 AA contrast (1.4.3), spread across all five pages. There were three causes:

| Cause | Measured ratio | Required |
| :--- | :--- | :--- |
| Gold `#B8821A` as text on parchment (all the small-caps labels) | 2.93:1 | 4.5:1 |
| Semi-transparent ivory text on a dark background with too low an opacity (footer at `.25`) | 2.07:1 | 4.5:1 |
| Ivory text on the gold button | 3.30:1 | 4.5:1 |

The fixes preserved the visual identity instead of flattening the palette:

* the brand gold `--gold` is unchanged for **rules, borders, dots and backgrounds**, where the text contrast criterion does not apply;
* for **text**, two variants calibrated for the background were introduced: `--gold-text: #845C10` on light backgrounds (4.84:1 minimum) and `--gold-on-dark: #C9942B` on dark ones (5.93:1 minimum);
* the opacities of light text on dark backgrounds were raised to the lowest value that satisfies the criterion (0.62 on ink, 0.72 on archive green);
* the gold button now has ink-coloured text (5.35:1), the same treatment already used by the other labels on gold.

Afterwards the violations detected are **0** on every page and at both viewport widths.

### 6.3 Structure, landmarks and skip link

The content of each page is wrapped in `<main id="contenuto">`; together with `<nav>` and `<footer>` this guarantees that no portion of the page falls outside a landmark, and lets screen reader users jump straight to the content.

The first tab stop on every page is a **skip link**, hidden off-screen with `transform: translateY(-120%)` and revealed by `.skip-link:focus`. Without it, a keyboard user would have to traverse the entire menu on every page before reaching the text.

The heading hierarchy is continuous across all pages: a single `<h1>`, `<h2>` sections, `<h3>` blocks, with no skipped levels.

### 6.4 Focus, motion and the form

* **Visible focus.** A single `:focus-visible` rule applies a gold outline to every actionable element, with a lighter variant on dark backgrounds. The form fields had `outline: none` and entrusted the focus signal to the border colour alone: that declaration was removed.
* **Motion.** The entrance animations and the smooth scrolling are wrapped in `@media (prefers-reduced-motion: no-preference)`; anyone who has asked for less motion in their system settings gets the site without transitions.
* **Form.** Labels are tied to fields through `for`/`id`. The message field, mandatory server-side, now also carries the `required` attribute, so the error is flagged by the browser before submission instead of costing a page change. In the contact details panel some `<label>`s were being used as decorative text, with no control to label: they were replaced by `<span>`s.

### 6.5 W3C validation

All pages, **including the privacy notice and both variants of the outcome page** (confirmation and error), pass validation with neither errors nor warnings. The issues that came up during development and how they were resolved:

| Issue | Cause | Solution |
| :--- | :--- | :--- |
| `aria-label on div` | ARIA attribute on a `<div>` with no role | Element rewritten as a native `<button>` (§6.1) |
| `Skipping heading level` | `<h4>` under sections handled with `<h2>` | Heading tree restructured on `<h3>` |
| `Skipping heading level` (footer) | The column headings were `<h3>`; on the outcome page, where the main heading is an `<h1>` and there are no `<h2>` sections, they skipped a level | Column headings raised to `<h2>` |
| Inline styles | `style="..."` attributes in the layout blocks | Rules centralised in `style.css` alone |

### 6.6 No cookies and no third parties

The public pages set no cookies — neither their own nor third-party ones — use no analytics, and, once the typefaces were self-hosted (§3.2), make no request to external domains. Consequently **no cookie consent banner is required**: there is nothing to consent to.

The one exception is the reserved area (§5.7): logging in opens a PHP session, and with it the technical `PHPSESSID` cookie, without which the panel would have no way of recognising who logged in from one request to the next. It is a session cookie strictly necessary to a service the user requested, and as such exempt from consent under Article 122 of the Italian privacy code; moreover it concerns only whoever runs the site, not whoever visits it. It must be declared all the same: an unstated exception is worth as much as a missing banner, and it is why this report says "the public pages" and not "the site".

It is a choice worth stating explicitly, because the banner is today the main source of friction in browsing, and on the vast majority of sites it exists to justify processing that the site could simply not carry out. Here the order was reversed: the processing was removed first, and the reason for the banner then disappeared on its own.

The notice in `privacy.php` documents the situation anyway, because the absence of cookies deserves to be declared as much as their presence, and it describes the one processing operation the user cannot avoid: the recording of accesses in the web server's log files.

---

## 7. LOCAL INSTALLATION AND TESTING

1. Start the **Apache** and **MySQL/MariaDB** modules of your local environment (XAMPP, MAMP or WAMP).
2. Copy the project folder into the directory served by the server (for example `C:\xampp\htdocs\algora_site` or `C:\wamp64\www\algora_site`).
3. Open **phpMyAdmin** (`http://localhost/phpmyadmin`) and run the `crea_db.sql` script, which creates the `algorast_db` database and the `contatti` table.
4. Check that the parameters in `config-db.php` match your installation. The project uses a dedicated MySQL user (`algorast_user`) with privileges limited to the `algorast_db` database, rather than the `root` user that XAMPP/MAMP/WAMP provide by default: if that user does not exist yet it must be created and associated with the database, otherwise inserting a contact fails with an access error. The credentials are deliberately the same as the hosting's, for the reason explained in §5.5: this way the file needs no editing at publication time.
5. Open `http://localhost/algora_site/index.php`.
6. To test the server-side part, open `http://localhost/algora_site/contatti.php`, fill in the form and submit it. Check that the confirmation page appears and that the row is present in the `contatti` table.
7. To test the reserved area (§5.7), open `http://localhost/algora_site/archivio.php` — or follow the "Area riservata" item in the navigation bar — and log in with the demonstration password `algora2025`. To replace it, regenerate the hash from the command line and update `config-admin.php`:

```
php -r 'echo password_hash("nuova-password", PASSWORD_DEFAULT), "\n";'
```

### 7.1 Test cases executed

| Case | Expected outcome | Result |
| :--- | :--- | :--- |
| Correct submission, with consent | Confirmation page, row inserted | Passed |
| Submission without consent to processing | Specific error, **no insertion** | Passed |
| Forged consent (value other than the expected one) | Specific error, no insertion | Passed |
| Name with an apostrophe and `&` (`Sant'Angelo & C.`) | Correct characters on screen **and** in the database | Passed |
| Formally invalid email | Specific error message, no insertion | Passed |
| Empty mandatory fields | Specific error message, no insertion | Passed |
| Opening `invia-contatto.php` directly via URL | `303` redirect to the form | Passed |
| SQL injection string in the name field | Stored as text, table intact | Passed |
| Unreachable database | Generic message to the user, detail in the log, no technical data exposed | Passed |
| Reserved area: wrong password | Generic message, no access | Passed |
| Reserved area: deletion `POST` without a valid session | Request rejected, row intact | Passed |
| Reserved area: `POST` with no anti-CSRF token | Request rejected, row intact | Passed |
| Editing with an invalid email | Specific error, typed values returned to the form, no write | Passed |
| Saving twice with consent already given | `data_consenso` unchanged | Passed |
| Withdrawing consent while editing | `consenso_privacy` set to `0` and `data_consenso` cleared | Passed |
| Deleting a non-existent number | Specific message, no row touched | Passed |
| Name containing `<b>` and an apostrophe, shown in the list | Printed as text, not interpreted by the browser | Passed |
| Loading the product page with `preload="none"` | No request for the video in the server log | Passed |
| Playback after the click | The video starts, duration 78.2 s read correctly, no errors | Passed |
| Video request with a `Range` header | `206 Partial Content`, so the progress bar works | Passed |
| Browser without proprietary codecs | Falls back to WebM and plays | Passed |

### 7.2 Verifying the move to mobile-first

Rewriting the stylesheet was not supposed to change anything on screen. To demonstrate it, full-page screenshots of the five pages were captured at `390`, `768`, `960`, `961` and `1440` px before and after the change, and compared pixel by pixel:

* at `961` and `1440` px the images came out **identical**, confirming that the desktop layout is unchanged;
* at `390`, `768` and `960` px the only measured difference concerns the height of the footer, which is exactly the fix described in §3.4; the height of every other element stayed the same.

The absence of horizontal scrolling was also verified from `320` to `1920` px.

The same method was applied to the class-name consolidation described in §3.2, which by definition was not supposed to change anything on screen: twenty-eight full-page screenshots (the seven pages at four widths) were compared pixel by pixel before and after, and came out **all identical**, together with the two state screenshots — FAQ open and mobile menu open — and the three extreme widths. The first comparisons had instead reported real differences, all of them caused by rules that had lost the specificity contest: they were the guide for correcting the consolidation before considering it finished.

---

## 8. PUBLISHING ONLINE

The site is meant to be published on the domain `www.algorastudio.it`. On shared hosting the procedure is as follows:

1. Upload the project files into the domain's public folder (typically `public_html` or `httpdocs`), `video/` included. There is no need to upload the source logos in `img/marchi/` that the `LEGGIMI` file marks as unused by the pages: they are 5.7 MB no page ever requests.
2. Create the database from the hosting control panel and run `crea_db.sql` on it.
3. Create the database user with the same credentials used locally (§5.5), so that `config-db.php` needs no editing, and grant it only the privileges the code actually uses: `SELECT`, `INSERT`, `UPDATE` and `DELETE` on the `contatti` table. The last two are for the reserved area (§5.7): with `INSERT` and `SELECT` alone the public form would work and the panel would not.
4. Check that `config-db.php` is not reachable from outside and that it is not included in version control.

---

## 9. KNOWN LIMITATIONS AND FUTURE WORK

For completeness, the points still open:

* **Language of the multimedia content.** The five screenshots and the demo video (§3.5) show the interface in Italian, and the step-by-step description accompanying the video is written in Italian. Should the site gain an English version, that material will have to be re-recorded or accompanied by a note: a video is the one part of a site that translating the text does not reach.
* **Controller details in the privacy notice.** The privacy notice is structurally complete, but the controller's identifying details (company name, VAT number, registered office), the retention period and the suppliers appointed as processors are placeholders, made graphically obvious on the page. They must be filled in before publication: a half-published notice is worse than no notice at all. The same VAT number placeholder appears in the footer.
* **Protection of the public form.** The anti-CSRF token described in §5.7 protects the reserved area, but it has not been extended to the contact form, which also lacks an anti-spam measure. Both should be added for production use. For the latter a passive technique is preferable — a honeypot field plus a check on how long the form took to fill in — over a CAPTCHA: visual CAPTCHAs are an accessibility obstacle, and third-party services would reintroduce into the page the external dependency removed in §3.2.
* **Authentication of the reserved area.** Access to `archivio.php` rests on a single shared password: enough to protect a demonstration panel, not an archive in production, which would require named accounts, mandatory HTTPS, rate limiting on login attempts and a log of the operations performed. There is also no scheduled erasure at the end of the retention period: today erasure is a manual act, however much it is now possible without opening phpMyAdmin.
