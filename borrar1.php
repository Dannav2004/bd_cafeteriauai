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

$id = $_GET["id"];

// $query = "UPDATE `registro` SET `borrado` = '1' WHERE `registro`.`id_estudiantes` = $id";
$query = "DELETE FROM `registro` WHERE `registro`.`id_estudiantes` = $id";

$result = $conn->query($query);

header("Location: conexion.php");