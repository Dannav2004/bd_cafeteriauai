<?php
include 'conex.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_POST['username'];
    $email = $_POST['email']; // o $_POST['username'] si inicias sesión con username
    $password = $_POST['password'];

    // Consulta SQL para obtener el regis///tro del usuario por email o username
    $query = "SELECT * FROM inicio WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $email); // Enlazar el parámetro dos veces para manejar email o username
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Usuario encontrado, verificar la contraseña
        $user = $result->fetch_assoc();
        if (md5($password) == $user['password']) {
            // Contraseña correcta, iniciar sesión
            session_start();
            $_SESSION['email'] = $user['email']; // o $_SESSION['username'] si inicias sesión con username
            $_SESSION['username'] = $user['username']; // Asegúrate de almacenar el username en la sesión si es necesario
            header("Location: index.html "); // Redirigir a la página de inicio después del inicio de sesión exitoso
            exit();
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta. Intenta de nuevo.";
            echo 'Contraseña ingresada: '. $password . '<br>';
            echo 'Contraseña convertida a md5: '. md5($password) . '<br>';
            echo 'Contraseña bd: '. $user["password"]. '<br>';
            echo 'Comprobación de condicional'. md5($password) == $user['password'];
        }
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado. Verifica tus credenciales.";
    }

    $stmt->close(); // Cerrar la consulta preparada
}
$conn->close(); // Cerrar la conexión a la base de datos
?>
