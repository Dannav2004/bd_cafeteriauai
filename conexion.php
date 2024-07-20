<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cafeteria_uai";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if (isset($_POST['ENVIAR'])) {
    // Obtener datos del formulario y limpiarlos
    $nombres = $conn->real_escape_string($_POST['nombres']);
    $apellidos = $conn->real_escape_string($_POST['apellidos']);
    $fecha_nacimiento = $conn->real_escape_string($_POST['fecha_nacimiento']);
    $edad = $conn->real_escape_string($_POST['edad']);
    $dni = $conn->real_escape_string($_POST['dni']);
    $carrera_profesional = $conn->real_escape_string($_POST['carrera_profesional']);
    $ciclo = $conn->real_escape_string($_POST['ciclo']);
    $email = $conn->real_escape_string($_POST['email']);
    $contraseña = $conn->real_escape_string($_POST['contraseña']);
    $confirmar_contraseña = $conn->real_escape_string($_POST['confirmar_contraseña']);

    // Verificar que las contraseñas coincidan
    if ($contraseña !== $confirmar_contraseña) {
        die("Las contraseñas no coinciden.");
    }

    // Encriptar contraseña y confirmar_contraseña utilizando MD5
    $contraseña_encriptada = md5($contraseña);
    $confirmar_contraseña_encriptada = md5($confirmar_contraseña);

    // Subir imagen
    if (isset($_FILES["imagen"])) {
        $file = $_FILES["imagen"];
        $filename = $file["name"];
        $mimetype = $file["type"];
        $allowed_types = array("image/jpg", "image/jpeg", "image/png", "image/webp");

        if (!in_array($mimetype, $allowed_types)) {
            header("Location: conexion.php");
            die("Tipo de archivo no permitido");
        }

        if (!is_dir("fotos")) {
            mkdir("fotos", 0777);
        }

        if ($filename != "") {
            $filepath = "fotos/" . $filename;
            move_uploaded_file($file["tmp_name"], $filepath);

            // Insertar datos en la base de datos
            $sql = "INSERT INTO registro (nombres, apellidos, fecha_nacimiento, edad, dni, carrera_profesional, ciclo, email, contraseña, confirmar_contraseña, imagen)  VALUES ('$nombres', '$apellidos', '$fecha_nacimiento', '$edad', '$dni', '$carrera_profesional', '$ciclo', '$email', '$contraseña_encriptada', '$confirmar_contraseña_encriptada', '$filename')";

            if ($conn->query($sql) === TRUE) {
                //echo "Nuevo registro creado correctamente";
                header("Location: registro_compra.html");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                echo '<h1>Error: ' . $sql . '<br>' . $conn->error.'</h1>';
                // header("Location: registro_compra.html");
            }
        }
    }
}

// Consulta SQL para obtener todos los registros de la tabla personal
$sql_select = "SELECT * FROM registro";
$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Registros</title>
    <style>
        h2 {
            text-align: center;
            font-size: 50px;
            color: palevioletred;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            text-align: center;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: darksalmon;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            border: 1px solid #4f4f4f;
            border-radius: 8px;
            transition: all 0.2s ease-in;
            position: relative;
            overflow: hidden;
            font-size: 19px;
            cursor: pointer;
            color: black;
            z-index: 1;
            width: 10%;
            text-align: center;
            margin-left: 650px;
        }

        .btn:before {
            content: "";
            position: absolute;
            left: 100%;
            transform: translateX(-50%) scaleY(1) scaleX(1.25);
            top: 100%;
            width: 140%;
            height: 180%;
            background-color: pink;
            border-radius: 50%;
            display: block;
            transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
            z-index: -1;
        }

        .btn:after {
            content: "";
            position: absolute;
            left: 55%;
            transform: translateX(-50%) scaleY(1) scaleX(1.45);
            top: 180%;
            width: 160%;
            height: 190%;
            background-color: palevioletred;
            border-radius: 50%;
            display: block;
            transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
            z-index: -1;
        }

        .btn:hover {
            color: #ffffff;
            border: 1px solid palevioletred;
        }

        .btn:hover:before {
            top: -35%;
            background-color: pink;
            transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
        }

        .btn:hover:after {
            top: -45%;
            background-color: palevioletred;
            transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
        }

        body {
            background-image: url(fondo4.jpg);
            background-size: cover;
        }

        .search-container {
            text-align: center;
            margin: 20px;
        }

        .search-container input {
            padding: 10px;
            width: 50%;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <h2>Tabla de Registros</h2>
    <div class="search-container">
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Buscar en la tabla...">
    </div>
    <table id="registroTable">
        <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Fecha de Nacimiento</th>
            <th>Edad</th>
            <th>DNI</th>
            <th>Carrera Profesional</th>
            <th>Ciclo</th>
            <th>Email</th>
            <th>Contraseña</th>
            <th>Confirmar Contraseña</th>
            <th>Imagen</th>
            <th>Opciones</th>
        </tr>
        <?php
        // Iterar sobre los resultados y mostrar cada registro en la tabla
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row["id_estudiantes"];
                $imagen = $row["imagen"];
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['nombres']) . "</td>";
                echo "<td>" . htmlspecialchars($row['apellidos']) . "</td>";
                echo "<td>" . htmlspecialchars($row['fecha_nacimiento']) . "</td>";
                echo "<td>" . htmlspecialchars($row['edad']) . "</td>";
                echo "<td>" . htmlspecialchars($row['dni']) . "</td>";
                echo "<td>" . htmlspecialchars($row['carrera_profesional']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ciclo']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['contraseña']) . "</td>";
                echo "<td>" . htmlspecialchars($row['confirmar_contraseña']) . "</td>";
                echo "<td><img src='fotos/$imagen' width='70px'></td>";
                echo "<td><a href='form_modificar1.php?id=$id'>Modificar</a> /// <a href='borrar1.php?id=$id'>Borrar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='12'>No hay registros encontrados</td></tr>";
        }
        ?>
    </table>

    <div class="btn">
        <a href="index.html">Regresar</a>
    </div>
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toLowerCase();
            table = document.getElementById("registroTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }
    </script>
</body>

</html>

<?php
// Cerrar conexión
$conn->close();
?>
