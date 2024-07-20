<?php
// Conectar a la base de datos (ejemplo usando MySQLi)
$servername = "localhost";  // Nombre del servidor MySQL
$username = "root";         // Nombre de usuario de MySQL
$password = "";             // Contraseña de MySQL
$dbname = "cafeteria_uai";  // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$idModi = $_GET["id"];

$query_select = "SELECT * FROM personal WHERE id_trabajadores = '$idModi'";

$result = $conn->query($query_select);

if ($result) {
    $row = $result->fetch_assoc();

    $nombres = $row["nombres"];
    $apellidos = $row["apellidos"];
    $edad = $row["edad"];
    $dni = $row["dni"];
    $celular = $row["celular"];
    $cargo = $row["cargo"];
    $email = $row["email"];
    $contraseña = $row["contraseña"];
    $confirmar_contraseña = $row["confirmar_contraseña"];

}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Personal Cafetería UAI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="http://localhost/formulario/style.css">
</head>

<body>

    <form action="modificar.php" method="post">
        <h2>¡Hola de nuevo!</h2>
        <p>Modifica tu registro</p>

        <input type="hidden" name="id" value="<?php echo $idModi; ?>">

        <div class="input-wrapper">
            <i class="bi bi-person"></i>
            <input type="text" name="nombres" placeholder="Nombres" required value="<?php echo $nombres; ?>">
        </div>

        <div class="input-wrapper">
            <i class="bi bi-person"></i>
            <input type="text" name="apellidos" placeholder="Apellidos" required value="<?php echo $apellidos; ?>">
        </div>

        <div class="input-wrapper">
            <i class="bi bi-123"></i>
            <input type="text" name="edad" placeholder="Edad" required value="<?php echo $edad; ?>">
        </div>

        <div class="input-wrapper">
            <i class="bi bi-person-vcard"></i>
            <input type="text" name="dni" placeholder="DNI" required value="<?php echo $dni; ?>">
        </div>

        <div class="input-wrapper">
            <i class="bi bi-phone"></i>
            <input type="text" name="celular" placeholder="Celular" required value="<?php echo $celular; ?>">
        </div>

        <div class="input-wrapper">
            <i class="bi bi-people-fill"></i>
            <input type="text" name="cargo" placeholder="Cargo" required value="<?php echo $cargo; ?>">
        </div>

        <div class="input-wrapper">
            <i class="bi bi-envelope"></i>
            <input type="email" name="email" placeholder="Email" required value="<?php echo $email; ?>">
        </div>

        <div class="input-wrapper">
            <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
            <input type="password" name="contraseña" placeholder="Contraseña" required value="<?php echo $contraseña; ?>">
        </div>

        <div class="input-wrapper">
            <i class="bi bi-eye-slash toggle-password" id="toggleConfirmPassword"></i>
            <input type="password" name="confirmar_contraseña" placeholder="Confirmar Contraseña" required value="<?php echo $confirmar_contraseña; ?>">
        </div>

        <input type="submit" value="Enviar" class="btn">

    </form>

</body>

</html>