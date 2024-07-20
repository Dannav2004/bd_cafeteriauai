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

if (isset($_GET["id"])) {
    $idModi = $_GET["id"];
    $query_modi = "SELECT * FROM registro WHERE id_estudiantes = $idModi";
    $result_modi = $conn->query($query_modi);

    if ($result_modi->num_rows > 0) {
        $row_modi = $result_modi->fetch_assoc();
    } else {
        die("Registro no encontrado.");
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Registro</title>
    <link rel="stylesheet" href="http://localhost/cafeteriauai/styles.css">
</head>

<body>
    <form class="form" action="form_modificar1.php" method="post">
        <p class="title">Modificar Registro </p>
        <input type="hidden" name="id" value="<?php echo isset($row_modi['id_estudiantes']) ? $row_modi['id_estudiantes'] : ''; ?>">

        <div class="flex">
            <label>
                <input required="" placeholder="" type="text" class="input" name="nombres" value="<?php echo isset($row_modi['nombres']) ? $row_modi['nombres'] : ''; ?>">
                <span>Nombres</span>
            </label>

            <label>
                <input required="" placeholder="" type="text" class="input" name="apellidos" value="<?php echo isset($row_modi['apellidos']) ? $row_modi['apellidos'] : ''; ?>">
                <span>Apellidos</span>
            </label>
        </div>

        <label>
            <input required="" placeholder="" type="date" class="input" name="fecha_nacimiento" value="<?php echo isset($row_modi['fecha_nacimiento']) ? $row_modi['fecha_nacimiento'] : ''; ?>">
            <span>Fecha de Nacimiento</span>
        </label>

        <label>
            <input required="" placeholder="" type="number" class="input" name="edad" value="<?php echo isset($row_modi['edad']) ? $row_modi['edad'] : ''; ?>">
            <span>Edad</span>
        </label>

        <label>
            <input required="" placeholder="" type="text" class="input" name="dni" value="<?php echo isset($row_modi['dni']) ? $row_modi['dni'] : ''; ?>">
            <span>DNI</span>
        </label>

        <label>
            <input required="" placeholder="" type="text" class="input" name="carrera_profesional" value="<?php echo isset($row_modi['carrera_profesional']) ? $row_modi['carrera_profesional'] : ''; ?>">
            <span>Carrera profesional</span>
        </label>

        <label>
            <input required="" placeholder="" type="number" class="input" name="ciclo" value="<?php echo isset($row_modi['ciclo']) ? $row_modi['ciclo'] : ''; ?>">
            <span>Ciclo</span>
        </label>

        <label>
            <input required="" placeholder="" type="email" class="input" name="email" value="<?php echo isset($row_modi['email']) ? $row_modi['email'] : ''; ?>">
            <span>Email</span>
        </label>

        <label>
            <input required="" placeholder="" type="password" class="input" name="contraseña" value="<?php echo isset($row_modi['contraseña']) ? $row_modi['contraseña'] : ''; ?>">
            <span>Contraseña</span>
        </label>

        <label>
            <input required="" placeholder="" type="password" class="input" name="confirmar_contraseña" value="<?php echo isset($row_modi['confirmar_contraseña']) ? $row_modi['confirmar_contraseña'] : ''; ?>">
            <span>Confirmar Contraseña</span>
        </label>

        <button class="submit" name="ENVIAR">Guardar Cambios</button>
    </form>
</body>

</html>

<?php
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

    if ($conn->query($query_modi) === TRUE) {
        header("Location: conexion.php");
        exit();
    } else {
        echo "Error actualizando el registro: " . $conn->error;
    }
}

$conn->close();
?>
