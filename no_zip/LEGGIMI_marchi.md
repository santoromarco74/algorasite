# Marchi

## Cosa c'è in questa cartella

| File | Ruolo |
| :--- | :--- |
| `Logo_uff_Algora.jpg` | Marchio ufficiale Algora a colori, 2048×2048. Sorgente, non usato dalle pagine. |
| `logo_foliarium1.png` | Marchio Foliarium a colori, 2816×1536. Sorgente, non ancora usato dalle pagine. |
| `algora-marchio.svg` | **Variante monocromatica della "A"**, usata dal sito. |
| `favicon-32.png`, `apple-touch-icon.png`, `icona-512.png` | Icone generate dalla variante monocromatica. |

La favicon vera e propria è `favicon.ico` nella radice del sito, dove i browser
la cercano anche senza che sia dichiarata.

## Come è stata ricavata la variante monocromatica

Il marchio ufficiale è blu navy e rame. Nessuno dei due colori appartiene alla
palette del sito (pergamena, inchiostro, oro, verde archivio): inserito così
com'è nella barra di navigazione, sembrerebbe il marchio di un'altra azienda
appoggiato sopra questo sito. La strada consueta in questi casi non è cambiare
il marchio, ma affiancargli una variante monocromatica per gli usi in cui il
colore pieno non funziona.

Il procedimento, riproducibile:

1. **Ritaglio della sola "A"** dal blocco completo, escludendo il lettering.
   Il lettering nel sito resta testo vero, non immagine.
2. **Soglia sulla luminosità al 94%.** Il fondo del file originale è a 253/255,
   mentre il punto più chiaro del rame sta più in basso: la soglia separa figura
   e fondo senza bucare i riflessi. Sopra il 97% entrerebbe il rumore JPEG del
   fondo, sotto il 90% si perderebbero i riflessi del rame.
3. **Chiusura morfologica con raggio 6.** I riflessi speculari nel raccordo fra
   gamba e piede della lettera restavano come piccoli morsi bianchi; un raggio
   minore non li chiudeva, uno maggiore non serviva. Il canale bianco della
   curva che attraversa la "A" e la controforma restano aperti.
4. **Vettorializzazione con potrace**, quantizzando le coordinate a `-u 1`:
   il file scende da 20 KB a 11 KB (3,6 KB compressi) con la stessa resa.

## Perché `currentColor` e non due file

Il marchio compare su fondo pergamena nella barra e su fondo inchiostro nel piè
di pagina. Invece di tenere due file da mantenere allineati, l'SVG dichiara
`fill="currentColor"`: eredita il colore del testo che lo circonda, esattamente
come fa il lettering accanto.

Perché funzioni, l'elemento contenitore deve avere un colore dichiarato. Nella
barra il marchio sta dentro un `<a>`, e senza una regola esplicita erediterebbe
il **blu predefinito dei collegamenti** — proprio il colore che si voleva
evitare. Per questo `.nav-logo` porta `color: var(--ink)`.

Per la stessa ragione l'SVG viene **incorporato nella pagina** con `readfile()`
invece che richiamato con `<img>`: un'immagine esterna non può ereditare il
colore del contesto.

## Accessibilità

L'SVG porta `aria-hidden="true"`: il marchio è decorativo, il nome dello studio
è già presente come testo accanto ed è quello che i lettori di schermo devono
annunciare. Il collegamento alla home si annuncia come "ALGORA STUDIO", non
come "logo".

## Marchio Foliarium: ancora da inserire

Il file a colori è in questa cartella ma non è usato dalle pagine. Verde scuro
e oro sono compatibili con la palette, quindi qui non serve una variante
monocromatica; il problema è un altro: il marchio è molto ricco (libro,
rilegatura decorata, dissolvenza in quadretti, penna, mappa) e a misura ridotta
diventa una macchia. Va usato **grande, nella testata della scheda prodotto**,
dove ha spazio per leggersi, e va ritagliato il fondo chiaro incorporato.

Il suo sottotitolo "gestione digitale archivi catastali storici" ripete quello
che la pagina già dice a parole: dentro un'immagine quel testo non è
selezionabile né leggibile da un lettore di schermo, quindi va preferita la
versione con il solo simbolo e nome, se disponibile.
