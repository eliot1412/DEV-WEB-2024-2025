
    const form = document.querySelector('form');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const errorMessage = document.getElementById('error-message');

    form.addEventListener('submit', function (e) {

        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();
        let errors = 0;

        // Vérifie si les champs sont vides
        if (email === '' || password === '') {
            e.preventDefault();
            errorMessage.innerHTML="L'email et le mot de passe sont requis.";
        }
    });
