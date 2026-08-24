# Filmato dimostrativo

Un minuto e diciotto di Foliarium in funzione, muto, usato nella sezione
"Schermate" di `foliarium.php`. Le scelte tecniche sono documentate in §3.5
della relazione.

| File | Codifica | Peso |
| :--- | :--- | :--- |
| `foliarium-demo.webm` | VP9, 1280×686, 30 fps | 1,5 MB |
| `foliarium-demo.mp4` | H.264 high@4.0, 1280×686, 30 fps | 1,6 MB |

Le due codifiche non servono a risparmiare byte — la differenza è
trascurabile — ma a coprire i browser costruiti senza i codec proprietari,
che l'H.264 non lo riproducono. Nell'HTML il WebM viene per primo.

## Come sono stati prodotti

La registrazione originale è a 1920×1080, ma l'immagine utile occupa un
riquadro di 1536×824 in alto a sinistra: il resto è cornice nera e barra
delle applicazioni. Da qui il ritaglio. La registrazione dura 84 secondi e
negli ultimi si vede la schermata di gestione degli utenti, dove è leggibile
un indirizzo email personale: il filmato pubblicato si ferma prima.

```
FILTRO="crop=1536:824:192:108,scale=1280:-2,fps=30"

ffmpeg -i grezzo.mp4 -t 78.2 -vf "$FILTRO" \
  -c:v libx264 -crf 24 -preset slow -profile:v high -level 4.0 \
  -pix_fmt yuv420p -movflags +faststart -an video/foliarium-demo.mp4

ffmpeg -i grezzo.mp4 -t 78.2 -vf "$FILTRO" \
  -c:v libvpx-vp9 -crf 38 -b:v 0 -row-mt 1 -deadline good -cpu-used 2 \
  -an video/foliarium-demo.webm
```

`-movflags +faststart` sposta l'indice del file in testa: senza, la
riproduzione non parte finché il download non è concluso.

La registrazione grezza non è versionata: in repository sta solo il
risultato compresso.

## Provenienza dei dati

Come per le schermate, il filmato viene dall'**archivio dimostrativo** e non
da quello in produzione presso l'Archivio di Stato di Savona. I contatori
visibili (69 comuni, 330 partite, 120 possessori, 660 immobili) sono quindi
molto inferiori alle cifre citate nel caso studio. L'introduzione della
sezione lo dichiara esplicitamente.
