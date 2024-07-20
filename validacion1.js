document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registroForm');

    form.addEventListener('submit', function (event) {
        const contraseña = document.getElementById('contraseña').value;
        const confirmarContraseña = document.getElementById('confirmar_contraseña').value;

        if (contraseña !== confirmarContraseña) {
            alert('Las contraseñas no coinciden.');
            event.preventDefault(); // Evitar que se envíe el formulario
            return;
        }

        const nombres = document.getElementById('nombres').value;
        const apellidos = document.getElementById('apellidos').value;
        const dni = document.getElementById('dni').value;

        if (!/^[A-Za-z\s]{2,50}$/.test(nombres)) {
            alert('Nombres inválidos.');
            event.preventDefault();
            return;
        }

        if (!/^[A-Za-z\sñÑ]{2,50}$/.test(apellidos)) {
            alert('Apellidos inválidos.');
            event.preventDefault();
            return;
        }

        if (!/^\d{8}$/.test(dni)) {
            alert('DNI inválido. Debe tener 8 dígitos.');
            event.preventDefault();
            return;
        }

        // Encriptar las contraseñas usando MD5
        const contraseñaEncriptada = CryptoJS.MD5(contraseña).toString();
        const confirmarContraseñaEncriptada = CryptoJS.MD5(confirmarContraseña).toString();

        // Crear campos ocultos para enviar las contraseñas encriptadas
        const contraseñaField = document.createElement('input');
        contraseñaField.type = 'hidden';
        contraseñaField.name = 'contraseña';
        contraseñaField.value = contraseñaEncriptada;
        form.appendChild(contraseñaField);

        const confirmarContraseñaField = document.createElement('input');
        confirmarContraseñaField.type = 'hidden';
        confirmarContraseñaField.name = 'confirmar_contraseña';
        confirmarContraseñaField.value = confirmarContraseñaEncriptada;
        form.appendChild(confirmarContraseñaField);

        // Evitar que las contraseñas sin encriptar sean enviadas
        document.getElementById('contraseña').remove();
        document.getElementById('confirmar_contraseña').remove();
    });
});
