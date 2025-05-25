// results.js
document.addEventListener('DOMContentLoaded', () => {
  const container = document.querySelector('.results-container');
  if (!container) return console.error('Container introuvable');

  // 1) Récupère tous les items
  const items = Array.from(container.querySelectorAll('.result-item'));

  // 2) Injecte la barre de tri
  const sortSection = document.createElement('div');
  sortSection.className = 'sort-section';
  sortSection.innerHTML = `
    <h3>Trier par :</h3>
    <div class="sort-options">
      <button class="sort-btn" data-sort="date">Date</button>
      <button class="sort-btn" data-sort="price">Prix</button>
      <button class="sort-btn" data-sort="duration">Durée</button>
      <button class="sort-btn" data-sort="rating">Note</button>
      <button class="sort-btn" data-sort="alpha">A–Z</button>
    </div>
  `;
  container.parentNode.insertBefore(sortSection, container);

  // 3) Fonctions utilitaires de parsing
  const parseDate = s => new Date(s).getTime() || 0;
  const parseNum  = s => parseFloat(s) || 0;

  // 4) Comparateurs
  const comparators = {
    date:     (a, b) => parseDate(a.dataset.date)       - parseDate(b.dataset.date),
    price:    (a, b) => parseNum(a.dataset.price)       - parseNum(b.dataset.price),
    duration: (a, b) => parseNum(a.dataset.duration)    - parseNum(b.dataset.duration),
    rating:   (a, b) => parseNum(a.dataset.rating)      - parseNum(b.dataset.rating),
    alpha:    (a, b) => {
      const nameA = a.querySelector('.volcano-name').textContent.trim().toLowerCase();
      const nameB = b.querySelector('.volcano-name').textContent.trim().toLowerCase();
      return nameA.localeCompare(nameB);
    }
  };

  // 5) Écouteurs sur les boutons de tri
  sortSection.querySelectorAll('.sort-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      // active state
      sortSection.querySelectorAll('.sort-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      // tri proprement dit
      const crit   = btn.dataset.sort;
      const sorted = items.slice().sort((a, b) => comparators[crit](a, b));
      sorted.forEach(el => container.appendChild(el));
    });
  });
  // tri par défaut sur la date
  sortSection.querySelector('[data-sort="date"]').click();


  // 6) (re)lancez ici votre code de filtre par continent si besoin
  document.querySelector('.filter-btn[data-filter="all"]').click();
});
