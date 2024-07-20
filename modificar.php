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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idModi = $_POST["id"];
    $nombres_Modi = $_POST["nombres"];
    $apellidos_Modi = $_POST["apellidos"];
    $edad_Modi = $_POST["edad"];
    $dni_Modi = $_POST["dni"];
    $celular_Modi = $_POST["celular"];
    $cargo_Modi = $_POST["cargo"];
    $email_Modi = $_POST["email"];
    $contraseña_Modi = $_POST["contraseña"];
    $confirmar_contraseña_Modi = $_POST["confirmar_contraseña"];

    $query_modi = "UPDATE `personal` SET `nombres` = '$nombres_Modi', `apellidos` = '$apellidos_Modi', `edad` = '$edad_Modi', `dni` = '$dni_Modi', `celular` = '$celular_Modi', `cargo` = '$cargo_Modi', `email` = '$email_Modi',`contraseña` = '$contraseña_Modi', `confirmar_contraseña` = '$confirmar_contraseña_Modi', WHERE `personal`.`id_trabajadores` = $idModi;";

    $result_modi = $conn->query($query_modi);

    header("Location: añadir.php");
}

?>