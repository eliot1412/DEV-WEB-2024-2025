// results.js
// Tri dynamique des résultats de voyages sans rechargement ni requête HTTP

document.addEventListener('DOMContentLoaded', () => {
  // 1. Récupération du conteneur des résultats
  const container = document.querySelector('.results-container');
  if (!container) {
    console.error('🛑 .results-container introuvable');
    return;
  }

  // 2. Snapshot des éléments de résultats (chaque .result-item doit avoir les data-attrs)
  const items = Array.from(container.querySelectorAll('.result-item'));

  // 3. Création de la barre de tri
  const sortSection = document.createElement('div');
  sortSection.className = 'sort-section';
  sortSection.innerHTML = `
    <h3>Trier par :</h3>
    <div class="sort-options">
      <button class="sort-btn" data-sort="date">Date</button>
      <button class="sort-btn" data-sort="price">Prix</button>
      <button class="sort-btn" data-sort="duration">Durée</button>
      <button class="sort-btn" data-sort="rating">Note</button>
    </div>
  `;
  container.parentNode.insertBefore(sortSection, container);

  // 4. Fonctions utilitaires de parsing
  const parsePrice = txt => parseFloat(txt.replace(/[^\d,.-]/g, '').replace(',', '.')) || 0;
  const parseDate  = iso => {
    const d = new Date(iso);
    return isNaN(d) ? 0 : d.getTime();
  };
  const parseDuration = txt => {
    const m = txt.match(/(\d+)/);
    return m ? parseInt(m[1], 10) : 0;
  };
  const parseRating = txt => parseFloat(txt) || 0;

  // 5. Comparateurs selon critère
  const comparators = {
    date:     (a, b) => parseDate(a.dataset.date)   - parseDate(b.dataset.date),
    price:    (a, b) => parsePrice(a.dataset.price) - parsePrice(b.dataset.price),
    duration: (a, b) => parseDuration(a.dataset.duration) - parseDuration(b.dataset.duration),
    rating:   (a, b) => parseRating(a.dataset.rating)  - parseRating(b.dataset.rating)
  };

  // 6. Gestion du click sur les boutons de tri
  sortSection.querySelectorAll('.sort-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      // Visuel du bouton actif
      sortSection.querySelectorAll('.sort-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      
      // Tri des items (on prend le container <div> contenant les data-attrs)
      const crit = btn.dataset.sort;
      const sorted = items.slice().sort((a, b) => {
        const cardA = a;
        const cardB = b;
        return comparators[crit](cardA, cardB);
      });

      // Ré-injection dans le DOM
      sorted.forEach(el => container.appendChild(el));
    });
  });

  // 7. Optionnel : déclencher un tri par défaut (ex. date)
  const defaultBtn = sortSection.querySelector('[data-sort="date"]');
  if (defaultBtn) defaultBtn.click();
});

