/* Algora Studio — comportamenti client-side
   Ogni widget interattivo e' un <button> nativo: click, Invio e Barra
   spaziatrice funzionano senza gestori di tastiera dedicati, e lo stato
   viene comunicato alle tecnologie assistive tramite aria-expanded. */

// ── Menu di navigazione (mobile) ──────────────────────────────────────
const navToggle = document.getElementById('navToggle');
const navLinks  = document.getElementById('navLinks');

if (navToggle && navLinks) {
  navToggle.addEventListener('click', () => {
    const isOpen = navLinks.classList.toggle('open');
    navToggle.setAttribute('aria-expanded', String(isOpen));
    navToggle.setAttribute('aria-label', isOpen ? 'Chiudi il menu' : 'Apri il menu');
  });

  // Se la finestra viene allargata oltre il punto di rottura a menu aperto,
  // il pannello non ha piu' senso: si chiude e si riallinea aria-expanded.
  window.addEventListener('resize', () => {
    if (window.innerWidth >= 961 && navLinks.classList.contains('open')) {
      navLinks.classList.remove('open');
      navToggle.setAttribute('aria-expanded', 'false');
      navToggle.setAttribute('aria-label', 'Apri il menu');
    }
  });

  // Esc chiude il menu e riporta il focus sul pulsante che lo ha aperto.
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && navLinks.classList.contains('open')) {
      navLinks.classList.remove('open');
      navToggle.setAttribute('aria-expanded', 'false');
      navToggle.setAttribute('aria-label', 'Apri il menu');
      navToggle.focus();
    }
  });
}

// ── Ombra della barra di navigazione allo scroll ──────────────────────
const nav = document.getElementById('nav');
if (nav) {
  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 20);
  });
}

// ── FAQ a fisarmonica ─────────────────────────────────────────────────
// Apertura di una risposta per volta: le altre si richiudono.
document.querySelectorAll('.faq-trigger').forEach((trigger) => {
  trigger.addEventListener('click', () => {
    const item   = trigger.closest('.faq-item');
    const isOpen = item.classList.contains('open');

    document.querySelectorAll('.faq-item').forEach((other) => {
      other.classList.remove('open');
      other.querySelector('.faq-trigger').setAttribute('aria-expanded', 'false');
    });

    if (!isOpen) {
      item.classList.add('open');
      trigger.setAttribute('aria-expanded', 'true');
    }
  });
});
