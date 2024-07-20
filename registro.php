<?php
include 'conex.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO inicio (username, email, password) VALUES ('$username','$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso. Redirigiendo al inicio de sesión...";
        header("refresh:2; url=indexlg.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
