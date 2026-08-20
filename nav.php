<?php
// Richiede $active impostata dalla pagina chiamante prima dell'include
// (valori: 'home', 'chi-siamo', 'foliarium', 'caso-studio', 'contatti')
$navItems = [
  'home'        => ['href' => 'index.php',       'label' => 'Home'],
  'chi-siamo'   => ['href' => 'chi-siamo.php',    'label' => 'Chi siamo'],
  'foliarium'   => ['href' => 'foliarium.php',    'label' => 'Foliarium'],
  'caso-studio' => ['href' => 'caso-studio.php',  'label' => 'Caso Studio'],
];
?>
<nav id="nav">
  <a href="index.php" class="nav-logo">
    <span class="brand">ALGORA</span>
    <span class="sub">STUDIO</span>
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
