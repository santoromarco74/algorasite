<?php
// Richiede $active impostata dalla pagina chiamante prima dell'include
// (valori: 'home', 'chi-siamo', 'foliarium', 'caso-studio', 'contatti')
$navItems = [
  'home'        => ['href' => 'index.php',       'label' => 'Home'],
  'chi-siamo'   => ['href' => 'chi-siamo.php',    'label' => 'Chi siamo'],
  'foliarium'   => ['href' => 'foliarium.php',    'label' => 'Foliarium'],
  'caso-studio' => ['href' => 'caso-studio.php',  'label' => 'Caso Studio'],
  'archivio'    => ['href' => 'archivio.php',     'label' => 'Area riservata'],
];
?>
<nav id="nav">
  <a href="index.php" class="nav-logo">
    <?php /* Il marchio e' incorporato nella pagina invece che richiamato con
             <img>: solo cosi' il suo fill="currentColor" puo' ereditare il
             colore del testo circostante. Il file resta unico e condiviso. */ ?>
    <span class="nav-logo-marchio"><?php readfile(__DIR__ . '/img/marchi/algora-marchio.svg'); ?></span>
    <span class="nav-logo-testo">
      <span class="brand">ALGORA</span>
      <span class="sub">STUDIO</span>
    </span>
  </a>
  <ul class="nav-links" id="navLinks">
    <?php foreach ($navItems as $key => $item): ?>
    <li><a href="<?= $item['href'] ?>"<?= $active === $key ? ' class="active"' : '' ?>><?= $item['label'] ?></a></li>
    <?php endforeach; ?>
    <li><a href="contatti.php" class="nav-cta<?= $active === 'contatti' ? ' active' : '' ?>">Contatti</a></li>
  </ul>
  <button type="button" class="nav-burger" id="navToggle"
          aria-controls="navLinks" aria-expanded="false" aria-label="Apri il menu">
    <span></span><span></span><span></span>
  </button>
</nav>
