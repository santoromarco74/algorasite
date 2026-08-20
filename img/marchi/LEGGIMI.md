# Marchi — cosa serve e in che formato

Questa cartella ospita i marchi di Algora Studio e di Foliarium. Finché i file
non ci sono, il sito usa il lettering testuale attuale e non si rompe nulla.

## Stato

I marchi esistono in versione a colori (una "A" con taglio diagonale per Algora,
un libro aperto con dissolvenza digitale per Foliarium) ma **non sono ancora
utilizzabili sul sito**. Mancano tre requisiti, elencati qui sotto: assenza di
filigrana, sfondo trasparente, e una variante cromatica compatibile con la
palette del sito.

## File attesi

| Nome file | Cosa contiene |
| :--- | :--- |
| `algora-marchio.svg` | Il solo simbolo, senza testo, in proporzione quadrata. Serve per la favicon e per gli usi piccoli. |
| `algora-logo.svg` | Il blocco completo (simbolo + scritta), sviluppato in orizzontale. |
| `foliarium-marchio.svg` | Il solo simbolo di Foliarium, in proporzione quadrata. |
| `foliarium-logo.svg` | Il blocco completo di Foliarium, in orizzontale. |

Se di uno dei due esiste solo il blocco completo e non il simbolo isolato, va
bene lo stesso: si usa quello ovunque e per la favicon si ritaglia.

## Requisito 1: nessuna filigrana

Le esportazioni degli strumenti di grafica online includono spesso il nome del
servizio in un angolo. Un file con filigrana non può essere pubblicato: serve
l'esportazione pulita. La rimozione a posteriori non è un'opzione — su un
raster lascia aloni visibili, e aggira comunque la licenza dell'esportazione.

## Requisito 2: sfondo trasparente

I marchi devono comparire sia sulla pergamena chiara sia sull'inchiostro quasi
nero del piè di pagina. Un file con il fondo chiaro incorporato mostra un
rettangolo bianco su entrambi, evidentissimo sul secondo.

## Requisito 3: variante cromatica compatibile

La palette del sito è composta da quattro colori:

| Ruolo | Valore |
| :--- | :--- |
| Pergamena (fondo) | `#F4EFE4` |
| Inchiostro (testo) | `#1E150A` |
| Oro (accenti) | `#B8821A` |
| Verde archivio | `#1A3A28` |

Un marchio che introduce un colore estraneo — per esempio un blu — sembra
appoggiato sopra il sito invece che parte di esso. La soluzione abituale è una
**variante monocromatica** del marchio da usare sul web, tenendo quella a colori
per carta intestata e documenti. Se nell'SVG i riempimenti sono impostati su
`currentColor`, la variante monocromatica si ottiene da sola: il marchio prende
il colore del testo circostante e si adatta a entrambi i fondi.

## Formato: SVG, e perché conta

**SVG di gran lunga preferibile.** Il marchio compare a 28 px di altezza nella
barra di navigazione e a 16 px nella scheda del browser: a quelle misure un PNG
si impasta, un SVG resta nitido. In più pesa una frazione e non richiede la
versione a doppia risoluzione per gli schermi ad alta densità.

Se hai solo un raster, mandalo **PNG con sfondo trasparente, almeno 1024 px sul
lato lungo**. Da lì ricavo io le misure che servono.

Evita JPEG: non ha trasparenza, e su un marchio si vedono gli aloni.

## Il colore: il punto a cui fare attenzione

Il marchio deve comparire su **due fondi opposti**:

- barra di navigazione e corpo pagina → pergamena chiara (`#F4EFE4`)
- piè di pagina, fascia contatti, riquadri di chiusura → inchiostro (`#1E150A`)

Se l'SVG ha i colori fissati dentro, servono **due versioni** (una chiara e una
scura). Se invece nell'SVG i riempimenti sono impostati su `currentColor`, il
marchio prende automaticamente il colore del testo circostante e ne basta uno
solo: si adatta da sé a entrambi i fondi, come fa oggi il lettering.

È la soluzione migliore. Se il file te lo ha preparato qualcun altro e non sai
come è fatto dentro, mandalo comunque: guardo io se è convertibile.

## Prova di leggibilità

Prima di mandarlo, guarda il marchio rimpicciolito a 16 px. Se a quella misura
diventa una macchia, serve una versione semplificata per la favicon: meno
dettagli, tratti più spessi. È normale che un marchio ne abbia due varianti.

## Simbolo isolato, non blocco completo

Nella barra di navigazione va **solo il simbolo**, non il blocco con la scritta.
Due motivi: il blocco completo duplicherebbe il lettering testuale già presente,
e a 28 px di altezza una scritta incorporata in un'immagine diventa illeggibile.

Vale anche per i sottotitoli incorporati nel marchio ("gestione digitale archivi
catastali storici" e simili): ripetono quello che le pagine già dicono a parole,
e in un'immagine quel testo non è né selezionabile né leggibile da un lettore di
schermo. Meglio la versione con il solo nome.

## Cosa faccio io una volta ricevuti

- Inserimento nella barra di navigazione e nel piè di pagina, con il lettering
  che resta come testo accanto al simbolo (non lo sostituisco con un'immagine:
  il testo è selezionabile, ingrandibile e leggibile dai lettori di schermo).
- Testo alternativo corretto: il collegamento alla home deve annunciarsi come
  "Algora Studio — home", non come "logo".
- Favicon completa: `.ico` per i browser datati, PNG a 32 e 180 px, più il
  file `site.webmanifest`.
- Dimensioni dichiarate nel markup, così la pagina non slitta al caricamento.
