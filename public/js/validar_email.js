const emailInput = document.getElementById('email');
    const emailError = document.getElementById('email-error');

    // Expresión regular estricta
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Evento que se dispara cuando el usuario sale del campo de texto
    emailInput.addEventListener('blur', () => {
        // Si el campo no está vacío y no pasa la prueba del regex
        if (emailInput.value.trim() !== '' && !emailRegex.test(emailInput.value.trim())) {
            emailInput.style.borderColor = '#FF003C'; // Borde rojo neón
            emailInput.style.boxShadow = '0 0 10px rgba(255, 0, 60, 0.4)';
            emailError.style.display = 'block'; // Mostramos el texto
        } else {
            // Restauramos el estilo si todo está bien
            emailInput.style.borderColor = ''; 
            emailInput.style.boxShadow = '';
            emailError.style.display = 'none'; // Ocultamos el texto
        }
    });