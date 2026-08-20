# Schermate di Foliarium

Questa cartella ospita le immagini della scheda prodotto (`foliarium.php`).

## Cosa serve

Il blocco che le mostra è già presente in `foliarium.php`, commentato, subito
dopo la sezione delle funzionalità. Cerca il commento `SCHERMATE DEL PRODOTTO`.

Per attivarlo servono tre file:

| File | Cosa mostrare |
| :--- | :--- |
| `foliarium-ricerca.png` | La ricerca fuzzy con un risultato che mostra una corrispondenza approssimata |
| `foliarium-albero.png` | L'albero delle proprietà di un possessore |
| `foliarium-report.png` | Un report esportato, o la schermata da cui si esporta |

## Requisiti tecnici

- **Formato:** PNG per le schermate di interfaccia (il testo resta nitido).
- **Larghezza:** 1600 px. Il layout le rimpicciolisce, ma su schermi ad alta
  densità la definizione doppia si vede.
- **Dimensioni dichiarate:** dopo aver messo i file, aggiorna gli attributi
  `width` e `height` nel markup con le dimensioni reali in pixel. Servono a
  riservare lo spazio prima che l'immagine arrivi, evitando che il testo
  sottostante salti durante il caricamento.

## Testi alternativi

L'attributo `alt` non deve descrivere l'aspetto della schermata, ma dire a chi
non la vede *che cosa dimostra*. "Schermata del software" non serve a nessuno.
Nel markup commentato trovi tre `alt` già scritti in questo modo: adattali a
quello che le tue immagini mostrano davvero.

La didascalia (`<figcaption>`) è visibile a tutti e completa l'immagine: può
ripetere il concetto con parole diverse, non deve duplicare l'`alt`.

## Dati personali

Le schermate provengono da un archivio reale. Prima di pubblicarle verifica che
non compaiano nomi di persone identificabili: usa il database dimostrativo,
oppure oscura i dati sensibili.
