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

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibir datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $edad = $_POST['edad'];
    $dni = $_POST['dni'];
    $carrera_profesional = $_POST['carrera_profesional'];
    $ciclo = $_POST['ciclo'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];

    // Verificar que las contraseñas coincidan
    if ($contraseña !== $confirmar_contraseña) {
        die("Las contraseñas no coinciden.");
    }

    // Encriptar contraseña y confirmar_contraseña utilizando MD5
    $contraseña_encriptada = md5($contraseña);
    $confirmar_contraseña_encriptada = md5($confirmar_contraseña);

    if (isset($_FILES["imagen"])) {
        $file = $_FILES["imagen"];
        $filename = $file["name"];
        $mimetype = $file["type"];
        $allowed_types = array("image/jpg", "image/jpeg", "image/png", "image/webp");

        if (!in_array($mimetype, $allowed_types)) {
            header("Location: añadir.php");
        }

        if (!is_dir("fotos")) {
            mkdir("fotos", 0777);
        }

        if ($filename != "") {
            move_uploaded_file($file["tmp_name"], "fotos/" . $filename);
            $sql = "INSERT INTO registro (nombres, apellidos, fecha_nacimiento, edad, dni, carrera_profesional, ciclo, email, contraseña, confirmar_contraseña, imagen)  VALUES ('$nombres', '$apellidos', '$fecha_nacimiento', '$edad', '$dni', '$carrera_profesional', '$ciclo', '$email', '$contraseña_encriptada', '$confirmar_contraseña_encriptada', '$filename')";

            if ($conn->query($sql) === TRUE) {
                header("Location: bienvenida.php");
                exit();
                //echo "Registro exitoso";
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        }
    }

    //Preparar la consulta SQL para insertar datos
    //$sql = "INSERT INTO personal (nombres, apellido_paterno, apellido_materno, edad, dni, celular, genero, cargo, estado_civil)
    //VALUES ('$nombres', '$apellido_paterno', '$apellido_materno', '$edad', '$dni', '$celular', '$genero', '$cargo', '$estado_civil')";

    // Ejecutar la consulta y verificar si fue exitosa
    //if ($conn->query($query) === TRUE) {
    //echo "Registro exitoso";
    // } else {
    // echo "Error: " . $sql . "<br>" . $conn->error;
    // }
}

// Consulta SQL para obtener todos los registros de la tabla personal
$sql_select = "SELECT * FROM personal";
$result = $conn->query($sql_select);
?>