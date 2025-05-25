document.addEventListener("DOMContentLoaded", () => {
    const baseEl = document.getElementById("price-total");
    if (!baseEl) return;

    const basePrice = parseInt(baseEl.dataset.basePrice || 0);

    const getSelectedPrice = (selector) => {
        const el = document.querySelector(selector);
        if (!el) return 0;
        const selected = el.options ? el.options[el.selectedIndex] : el;
        return parseInt(selected?.dataset?.price || 0);
    };

    const getCheckedRadioPrice = (name) => {
        const selected = document.querySelector(`input[name="${name}"]:checked`);
        return selected ? parseInt(selected.dataset.price || 0) : 0;
    };

    const getCheckedCheckboxesTotal = (name) => {
        const boxes = document.querySelectorAll(`input[name="${name}[]"]:checked`);
        return Array.from(boxes).reduce((total, box) => {
            return total + parseInt(box.dataset.price || 0);
        }, 0);
    };

    const updatePrice = () => {
        const jours = parseInt(document.getElementById("jours")?.value || 1);
        const transport = getSelectedPrice("#transport");
        const hotelPerDay = getSelectedPrice("#hotel");
        const restaurant = getCheckedRadioPrice("restaurant");
        const carPerDay = getCheckedRadioPrice("car");
        const activitiesTotal = getCheckedCheckboxesTotal("activities");

        let total = basePrice
            + transport
            + restaurant
            + activitiesTotal
            + (hotelPerDay * jours)
            + (carPerDay * jours);

        baseEl.textContent = `Prix estimé : ${total} €`;
    };

    // Liste des champs à surveiller
    const selectors = [
        "#transport", "#hotel", "#jours",
        'input[name="restaurant"]',
        'input[name="car"]',
        'input[name="activities[]"]'
    ];

    selectors.forEach(selector => {
        document.querySelectorAll(selector).forEach(el => {
            el.addEventListener("change", updatePrice);
            el.addEventListener("input", updatePrice);
        });
    });

    updatePrice(); // Initialisation
});

