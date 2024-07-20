document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registroForm');

    form.addEventListener('submit', function (event) {
        const contraseña = document.getElementById('contraseña').value;
        const confirmarContraseña = document.getElementById('confirmar_contraseña').value;

        if (contraseña !== confirmarContraseña) {
            alert('Las contraseñas no coinciden.');
            event.preventDefault(); // Evitar que se envíe el formulario
        }

        const nombres = document.getElementById('nombres').value;
        const apellidos = document.getElementById('apellidos').value;
        const dni = document.getElementById('dni').value;
        const celular = document.getElementById('celular').value;

        if (!/^[A-Za-z\s]{2,50}$/.test(nombres)) {
            alert('Nombres inválidos.');
            event.preventDefault();
        }

        if (!/^[A-Za-z\sñÑ]{2,50}$/.test(apellidos)) {
            alert('Apellidos inválidos.');
            event.preventDefault();
        }

        if (!/^\d{8}$/.test(dni)) {
            alert('DNI inválido. Debe tener 8 dígitos.');
            event.preventDefault();
        }

        if (!/^\d{9}$/.test(celular)) {
            alert('Número de celular inválido. Debe tener 9 dígitos.');
            event.preventDefault();
        }

        // Encriptar la contraseña con MD5
        const encryptedPassword = CryptoJS.MD5(contraseña).toString();
        const encryptedConfirmPassword = CryptoJS.MD5(confirmarContraseña).toString();

        // Reemplazar el valor de los campos de contraseña con la contraseña encriptada
        document.getElementById('contraseña').value = encryptedPassword;
        document.getElementById('confirmar_contraseña').value = encryptedConfirmPassword;
    });

    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

    togglePassword.addEventListener('click', function () {
        const passwordField = document.getElementById('contraseña');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', function () {
        const confirmPasswordField = document.getElementById('confirmar_contraseña');
        const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordField.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
});