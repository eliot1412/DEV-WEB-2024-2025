
    const form = document.querySelector('form');
    const emailInput = document.getElementById('email');
    const password1Input = document.getElementById('password1');
    const password2Input = document.getElementById('password2');
    const errorMessage = document.getElementById('error-message');

    form.addEventListener('submit', function (e) {

        const email = emailInput.value.trim();
        const password1 = password1Input.value.trim();
        const password2 = password2Input.value.trim();
        let errors = 0;

        // Vérifie si les champs sont vides
        if (password1 === '' && password2 === '') {
            e.preventDefault();
            errorMessage.innerHTML="Merci de remplir votre mot de passe.";
        }
        if (password1 !== '' && password2 === '') {
            e.preventDefault();
            errorMessage.innerHTML="Merci de confirmer votre mot de passe.";
        }
        else if (password1 !== password2) {
            e.preventDefault();
            errorMessage.innerHTML="Merci de remplir le même mot de passe.";
        }
        if (password1.length < 8) {
            e.preventDefault();
            errorMessage.innerHTML="<p>Le mot de passe doit faire </p><p> 8 caractères au minimum.</p>";
        }
    });
