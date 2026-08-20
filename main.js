function toggleNav() {
  document.getElementById('navLinks').classList.toggle('open');
}
window.addEventListener('scroll', () => {
  document.getElementById('nav').classList.toggle('scrolled', window.scrollY > 20);
});

function toggleFaq(el) {
  const isOpen = el.classList.contains('open');
  document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
  if (!isOpen) el.classList.add('open');
}
