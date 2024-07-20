<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url(fondoi.jpg);
            background-color: #f8f9fa;
            height: 150vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        h1 {
            font-size: 3.5em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.5em;
        }

        button {
            position: fixed;
            top: 20px;
            right: 40px;
            font-size: 12px;
            background-color: darkviolet;
            color: #ffffff;
            border: none;
            cursor: pointer;
            width: 90px;
            padding: 5px;
            border-radius: 5px;
            z-index: 1000; /* Asegura que el botón esté por encima del carrusel */
        }

        button:hover {
            background-color: #9932CC;
        }

        .carousel-item img {
            width: 100%;
            height: 600px;
            object-fit: cover;
            border-radius: 20px;
        }
        .carousel {
            width: 90%;
            max-height: 800px;
            overflow: hidden;
            border-radius: 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 40px;
            margin-right: 200px;
            background-color: palevioletred;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 19px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: darksalmon;
        }
        .btni {
            display: inline-block;
            padding: 12px 24px;
            margin-top: -53px;
            margin-left: 200px;
            background-color: palevioletred;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 19px;
            text-decoration: none;
        }

        .btni:hover {
            background-color: darksalmon;
            text-decoration: none;
            color: black;
        }

    </style>
</head>

<body>

    <?php
    // Configurar la zona horaria para Perú
    date_default_timezone_set('America/Lima');

    // Obtener la hora actual
    $hora = date("H");
    $hora_actual = date("h:i A");

    // Determinar el saludo según la hora del día
    if ($hora < 12) {
        $saludo = "Buenos días";
    } elseif ($hora < 18) {
        $saludo = "Buenas tardes";
    } else {
        $saludo = "Buenas noches";
    }
    ?>

    <div class="container">
        <h1><?php echo $saludo; ?>, Bienvenido(a) estudiante a la Comunidad UAI</h1>
        <p>Hora actual: <?php echo $hora_actual; ?></p>
    </div>

    <button onclick="window.location.href='index.html'">Inicio</button>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="imagen1.jpg" class="d-block w-100" alt="Primera imagen">
            </div>
            <div class="carousel-item">
                <img src="imagen2.jpg" class="d-block w-100" alt="Segunda imagen">
            </div>
            <div class="carousel-item">
                <img src="imagen3.jpg" class="d-block w-100" alt="Tercera imagen">
            </div>
            <div class="carousel-item">
                <img src="imagen4.jpg" class="d-block w-100" alt="Cuarta imagen">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <a href="conexion.php" class="btn">Ver Registros</a>
    <a href="registro_compra.html" class="btni">Comprar</a>

</body>

</html>