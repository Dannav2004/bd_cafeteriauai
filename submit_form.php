<?php
// Datos de la conexión a la base de datos
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

// Preparar y vincular
$stmt = $conn->prepare("INSERT INTO ventas (fecha_compra, nombre_cliente, nombre_producto, cantidad, precio, vendedor) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssids", $fecha_compra, $nombre_cliente, $nombre_producto, $cantidad, $precio, $vendedor);

// Establecer parámetros y ejecutar
$fecha_compra = $_POST['dia_compra'];
$nombre_cliente = $_POST['nombre_cliente'];
$nombre_producto = $_POST['nombre_producto'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$vendedor = $_POST['vendedor'];

if ($stmt->execute()) {
    // Obtener el ID generado automáticamente por la base de datos
    $venta_id = $stmt->insert_id;

    // Cerrar la declaración preparada
    $stmt->close();

    // Cerrar la conexión
    $conn->close();

    // Redirigir a la página de comprobante de pago
    header("Location: comprobante_pago.php?id=" . $venta_id);
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
