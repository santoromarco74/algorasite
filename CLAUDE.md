# Convenzioni del progetto

## Relazione

Il sorgente della relazione è **`Relazione_Dettagliata_Progetto.md`**: è l'unico
file da modificare.

Il `.pdf` si rigenera da lì, direttamente dal Markdown:

```
pandoc Relazione_Dettagliata_Progetto.md -s -o Relazione_Dettagliata_Progetto.pdf \
  --pdf-engine=xelatex --highlight-style=tango \
  -V fontsize=11pt -V geometry:a4paper -V geometry:margin=22mm \
  -V mainfont="DejaVu Serif" -V monofont="DejaVu Sans Mono" \
  -V colorlinks=true -V lang=it -V linkcolor=black -V 'urlcolor=[HTML]{845C10}'
```

Non va più tenuta in repository una versione `.tex` intermedia: il LaTeX resta
un dettaglio interno di pandoc.
