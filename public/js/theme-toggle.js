document.addEventListener('DOMContentLoaded', function () {
  const root = document.documentElement;
  const saved = localStorage.getItem('theme');
  if (saved === 'dark') {
    root.classList.add('dark');
  }

  const toggle = document.getElementById('theme-toggle');
  if (toggle) {
    toggle.addEventListener('click', function (e) {
      e.preventDefault();
      if (root.classList.contains('dark')) {
        root.classList.remove('dark');
        localStorage.setItem('theme', 'light');
      } else {
        root.classList.add('dark');
        localStorage.setItem('theme', 'dark');
      }
    });
  }
});
