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
    $fecha_nacimiento_Modi = $_POST["fecha_nacimiento"];
    $edad_Modi = $_POST["edad"];
    $dni_Modi = $_POST["dni"];
    $carrera_profesional_Modi = $_POST["carrera_profesional"];
    $ciclo_Modi = $_POST["ciclo"];
    $email_Modi = $_POST["email"];
    $contraseña_Modi = $_POST["contraseña"];
    $confirmar_contraseña_Modi = $_POST["confirmar_contraseña"];

    $query_modi = "UPDATE `registro` SET `nombres` = '$nombres_Modi', `apellidos` = '$apellidos_Modi', `fecha_nacimiento` = '$fecha_nacimiento_Modi', `edad` = '$edad_Modi', `dni` = '$dni_Modi', `carrera_profesional` = '$carrera_profesional_Modi', `ciclo` = '$ciclo_Modi', `email` = '$email_Modi', `contraseña` = '$contraseña_Modi', `confirmar_contraseña` = '$confirmar_contraseña_Modi' WHERE `registro`.`id_estudiantes` = $idModi;";

    $result_modi = $conn->query($query_modi);

    header("Location: conexion.php");
}

?>