<footer>
  <div class="footer-main">
    <div class="footer-brand">
      <span class="footer-brand-riga">
        <span class="footer-brand-marchio"><?php readfile(__DIR__ . '/img/marchi/algora-marchio.svg'); ?></span>
        <span>
          <span class="brand">ALGORA</span>
          <span class="sub">STUDIO</span>
        </span>
      </span>
      <p>Software verticale per domini specifici. Strumenti precisi, duraturi, costruiti per la complessità reale di chi li usa.</p>
    </div>
    <div class="footer-col">
      <h2 class="label-sm">Studio</h2>
      <ul>
        <li><a href="chi-siamo.php">Chi siamo</a></li>
        <li><a href="chi-siamo.php#approccio">Il nostro approccio</a></li>
        <li><a href="chi-siamo.php#valori">Valori</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h2 class="label-sm">Prodotti</h2>
      <ul>
        <li><a href="foliarium.php">Foliarium</a></li>
        <li><a href="foliarium.php#prezzi">Prezzi</a></li>
        <li><a href="caso-studio.php">Caso Studio Savona</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h2 class="label-sm">Contatti</h2>
      <ul>
        <li><a href="contatti.php">Scrivici</a></li>
        <li><a href="contatti.php#demo">Richiedi demo</a></li>
        <li><a href="mailto:info@algorastudio.it">info@algorastudio.it</a></li>
      </ul>
    </div>
  </div>
  <?php /* Le due immagini sono ospitate sul sito, non richiamate da w3.org:
           un'immagine remota comunicherebbe l'IP del visitatore a un
           dominio terzo a ogni caricamento di pagina, dato che il pie' di
           pagina e' incluso ovunque. Stessa ragione dei caratteri
           tipografici in fonts/ (vedi img/badge/LEGGIMI.md). Il badge
           dichiara HTML5, non HTML 4.01: e' quella la versione che il
           sito usa e che la §6.5 della relazione dichiara validata. */ ?>
  <div class="footer-valid">
    <a href="https://validator.w3.org/nu/?doc=https%3A%2F%2Falgorastudio.it%2F">
      <img src="img/badge/valid-html5.png" width="79" height="31" alt="HTML valido" loading="lazy">
    </a>
    <a href="https://jigsaw.w3.org/css-validator/check/referer">
      <img src="img/badge/valid-css.png" width="88" height="31" alt="CSS valido" loading="lazy">
    </a>
  </div>
  <div class="footer-bottom">
    <p>© 2025 Algora Studio — Marco Santoro — P.IVA [01925090092] — Savona, Liguria</p>
    <p><a href="privacy.php">Privacy</a> · <a href="privacy.php#cookie">Cookie</a> · <a href="archivio.php">Area riservata</a></p>
  </div>
</footer>
