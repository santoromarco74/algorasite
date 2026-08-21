# Immagini

## Schermate di Foliarium

Cinque schermate del gestionale, usate nella sezione "Schermate" di
`foliarium.php`.

| File | Cosa mostra |
| :--- | :--- |
| `foliarium-cruscotto.png` | Schermata iniziale: ricerca rapida, contatori dell'archivio, ultimi inserimenti, registro attività |
| `foliarium-ricerca-partite.png` | Elenco delle partite con la scheda di dettaglio aperta |
| `foliarium-albero-genealogico.png` | Albero delle variazioni di una partita e report testuale |
| `foliarium-statistiche.png` | Grafici per comune, stato delle partite, variazioni per anno |
| `foliarium-esportazione.png` | Esportazione e file risultante aperto nel foglio di calcolo |

### Provenienza dei dati

Le schermate vengono dall'**archivio dimostrativo**, non da quello in
produzione presso l'Archivio di Stato di Savona. I contatori visibili
(330 partite, 120 possessori) sono quindi molto inferiori alle cifre citate
nel caso studio (12.000+ partite, 8.500+ possessori). L'introduzione della
sezione lo dichiara esplicitamente: senza quella riga il divario fra le due
cifre risulterebbe una contraddizione.

Per lo stesso motivo queste immagini stanno solo sulla scheda prodotto e non
sulla pagina del caso studio, dove le cifre grandi sono l'argomento portante.

### Nomi di persona

Le schermate contengono nomi di possessori tratti da registri catastali fra
il 1870 e il 1951 (per esempio "Gaggero Antonio di Marco", "Bolla Teresa fu
Luigi"). Sono dati d'archivio storico riferiti a persone da tempo decedute.
Se in futuro si aggiungessero schermate con partite più recenti, va
verificato che non compaiano persone identificabili ancora in vita.

### Ottimizzazione

I file originali sono stati ridotti a 256 colori: le schermate di interfaccia
hanno poche tinte piatte e si comprimono molto bene. Il peso è sceso di circa
il 55% con uno scarto misurato fra lo 0,2 e lo 0,5%, invisibile a occhio.

Sono caricate con `loading="lazy"`: sulla scheda prodotto valgono circa
280 KB, che il visitatore scarica solo se scorre fino alla sezione.

### Se le sostituisci

Aggiorna anche gli attributi `width` e `height` nel markup con le dimensioni
reali dei nuovi file: servono a riservare lo spazio prima che l'immagine
arrivi, evitando che il testo sottostante slitti durante il caricamento.

E riscrivi il testo alternativo. L'attributo `alt` non descrive l'aspetto
della schermata ma dice a chi non la vede **che cosa dimostra**: "schermata
del software" non serve a nessuno. Gli `alt` attuali citano numeri e nomi
visibili nelle immagini, quindi diventano falsi se le immagini cambiano.

## Fotogramma poster del filmato

| File | Cosa mostra |
| :--- | :--- |
| `foliarium-demo-poster.jpg` | Fotogramma tratto dal terzo secondo del filmato dimostrativo (§3.5 della relazione): la schermata iniziale del gestionale. Serve come immagine di anteprima dell'elemento `<video>`, che con `preload="none"` non scarica nulla finché non si preme Riproduci. |

Va rigenerato insieme al filmato, dallo stesso sorgente:

```
ffmpeg -i video/foliarium-demo.mp4 -ss 3 -frames:v 1 -q:v 3 img/foliarium-demo-poster.jpg
```
