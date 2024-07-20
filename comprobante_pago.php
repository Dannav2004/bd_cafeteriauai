<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .comprobante {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .comprobante h2 {
            color: #8d15e9;
            text-align: center;
            font-size: 25px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            margin-top: 30px;
        }

        .comprobante .detalle {
            margin-bottom: 50px;
            margin-top: 30px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        .comprobante .detalle p {
            margin: 8px 0;
        }

        .comprobante .detalle p strong {
            margin-right: 10px;
            font-weight: bold;
        }

        .comprobante .detalle p:last-child {
            margin-bottom: 0;
        }

        .comprobante .footer {
            margin-top: 30px;
            text-align: center;
            margin-right: 300px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        .comprobante .footer a {
            color: #8d15e9;
            text-decoration: none;
            font-weight: bold;
            color:darkmagenta;
        }

        .comprobante .footer a:hover {
            text-decoration: none;
        }
        .comprobante .btn {
            margin-top: -17px;
            text-align: center;
            margin-left: 300px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        .comprobante .btn a {
            color: #8d15e9;
            text-decoration: none;
            font-weight: bold;
            color:darkviolet;
        }

        .comprobante .btn a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="comprobante">
        <?php
        // Verificar si se ha proporcionado un ID válido en la URL
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $venta_id = $_GET['id'];

            // Consultar la base de datos para obtener los detalles de la venta
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

            // Consultar la base de datos para obtener los detalles de la venta
            $sql = "SELECT id, fecha_compra, nombre_cliente, nombre_producto, cantidad, precio, vendedor FROM ventas WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $venta_id);
            $stmt->execute();
            $stmt->bind_result($id, $fecha_compra, $nombre_cliente, $nombre_producto, $cantidad, $precio, $vendedor);

            if ($stmt->fetch()) {
                // Mostrar los detalles de la venta
                echo "<h2>DETALLE DE LA COMPRA</h2>";
                echo "<div class='detalle'>";
                echo "<p><strong>ID de Compra:</strong> " . $id . "</p>";
                echo "<p><strong>Fecha de Compra:</strong> " . $fecha_compra . "</p>";
                echo "<p><strong>Nombre del Cliente:</strong> " . $nombre_cliente . "</p>";
                echo "<p><strong>Nombre del Producto:</strong> " . $nombre_producto . "</p>";
                echo "<p><strong>Cantidad Comprada:</strong> " . $cantidad . "</p>";
                echo "<p><strong>Precio Unitario:</strong> S/ " . number_format($precio, 2) . "</p>";
                echo "<p><strong>Nombre del Vendedor:</strong> " . $vendedor . "</p>";
                echo "</div>";
            } else {
                echo "<p>No se encontraron detalles de la compra.</p>";
            }

            // Cerrar la conexión
            $stmt->close();
            $conn->close();

        } else {
            echo "<p>ID de compra no válido.</p>";
        }
        ?>
        <div class="footer">
            <a href="javascript:window.print()">IMPRIMIR COMPROBANTE</a>
        </div>
        <div class="btn">
            <a href="registro_compra.html">VOLVER AL FORMULARIO</a> 
        </div>
    </div>
</body>

</html>