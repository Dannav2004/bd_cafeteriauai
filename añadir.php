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
    $edad = $_POST['edad'];
    $dni = $_POST['dni'];
    $celular = $_POST['celular'];
    $cargo = $_POST['cargo'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];

    // Verificar que las contraseñas coincidan
    if ($contraseña !== $confirmar_contraseña) {
        die("Las contraseñas no coinciden.");
    }

    // Encriptar contraseña
    $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

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
            $query = "INSERT INTO personal (nombres, apellidos, edad, dni, celular, cargo, email, contraseña, confirmar_contraseña, imagen)
            VALUES ('$nombres', '$apellidos', '$edad', '$dni', '$celular', '$cargo', '$email', '$contraseña_hash', '$contraseña_hash', '$filename')";

            if ($conn->query($query) === TRUE) {
                header("Location: bienvenida1.php");
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
            background-image: url(fondo2.jpg);
            background-size: cover;
            min-height: 150vh;
        }

        #searchInput {
            margin: 20px auto;
            display: block;
            width: 20%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-left: 1030px;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");
            searchInput.addEventListener("keyup", function () {
                const filter = searchInput.value.toLowerCase();
                const rows = document.querySelectorAll("table tbody tr");

                rows.forEach(row => {
                    const cells = row.querySelectorAll("td");
                    let matches = false;
                    cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(filter)) {
                            matches = true;
                        }
                    });
                    if (matches) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    </script>
</head>

<body>

    <h2>Tabla de Registros</h2>
    <input type="text" id="searchInput" placeholder="Buscar...">
    <table>
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Edad</th>
                <th>DNI</th>
                <th>Celular</th>
                <th>Cargo</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Confirmar contraseña</th>
                <th>Imagen</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterar sobre los resultados y mostrar cada registro en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id_trabajadores"];
                    $imagen = $row["imagen"];
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nombres']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['apellidos']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['edad']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['dni']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['celular']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cargo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contraseña']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['confirmar_contraseña']) . "</td>";
                    echo "<td><img src='fotos/$imagen' width='70px'></td>";
                    echo "<td><a href='form_modificar.php?id=$id'>Modificar</a> /// <a href='borrar.php?id=$id'>Borrar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No hay registros encontrados</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="btn">
        <a href="index.html">Regresar</a>
    </div>

</body>

</html>

<?php
// Cerrar conexión
$conn->close();
?>
