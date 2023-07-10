<?php
include("../../Administrativo/php/conexion.php");

// Verificar si se recibió un ID de evento válido en la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_evento = $_GET['id'];
    
    // Consulta para obtener la información del evento específico
    $sentenciaSQL = $conexion->prepare("SELECT id_evento, artista, nombre_evento, fecha, horario, imagen, descripcion FROM evento WHERE id_evento = :id");
    $sentenciaSQL->bindParam(':id', $id_evento, PDO::PARAM_INT);
    $sentenciaSQL->execute();
    $evento = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró el evento
    if ($evento) {
        // Obtener los datos del evento
        $artista = $evento['artista'];
        $nombre_evento = $evento['nombre_evento'];
        $fecha = $evento['fecha'];
        $horario = $evento['horario'];
        $imagen = $evento['imagen'];
        $descripcion = $evento['descripcion'];
    } else {
        // Si no se encontró el evento
        echo "Evento no encontrado";
        exit();
    }
} else {
    // Si no se recibió un ID de evento válido
    echo "ID de evento inválido";
    exit();
}

session_start();

if( isset($_SESSION['user_id'])) {
    $sentenciaSQL = $conexion->prepare("SELECT id, email, contrasena, nombre, apellido, administrador, super_admin FROM usuario WHERE id=:id");
    $sentenciaSQL->bindParam(':id', $_SESSION['user_id']);
    $sentenciaSQL->execute();
    $cuenta = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if(count($cuenta) > 0) {
        $user = $cuenta;
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        session_destroy();
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nombre_evento; ?> - NOVATH</title>
    <link rel="shortcut icon" href="../img/NOVATH-LOGO.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style-index.css">
    <link rel="stylesheet" href="../css/style-vista-evento.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img class="novath-titulo" src="../img/NOVATH.png" width="180" alt="NOVATH">
                <img class="novath-icono" src="../img/NOVATH-LOGO.png" width="50" alt="NOVATH">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if (!empty($user)): ?>
                <div class="collapse navbar-collapse" id="navbar-toggler"> 
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../php/logout.php">
                                <button type="button" class="btn btn-outline-light">Cerrar Sesión</button>
                            </a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="#">
                                <i class="bi bi-person-circle" style="font-size: 45px; color: #a7bfe1"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="collapse navbar-collapse" id="navbar-toggler"> 
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../html/login.php">
                                <button type="button" class="btn btn-outline-light">Iniciar Sesión</button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../html/register.php">
                                <button type="button" class="btn btn-outline-light">Registrarse</button>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <img src="../../img/<?php echo $imagen; ?>" class="card-img-top" alt="Evento">
                    <div class="card-body">
                        <h5 class="card-title"><b><?php echo $nombre_evento; ?></b></h5>
                        <p class="card-text text-uppercase"><?php echo $artista; ?></p>
                        <p class="card-text">Fecha: <?php echo $fecha; ?></p>
                        <p class="card-text">Horario: <?php echo $horario; ?></p>
                        <p class="card-text">Descripción: <?php echo $descripcion; ?></p>
                        <a href="detalle-compra.php?id=<?php echo $evento['id_evento']; ?>" class="btn boton-card btn-outline-dark w-100">COMPRAR ENTRADAS</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-transparent text-center border-top" style="border-color: #a7bfe1;">
        <div class="container p-4 pb-0">
            <section class="mb-4" id="seccion-contacto">
                <a class="boton-footer btn btn-outline-light btn-floating m-1 rounded-circle" href="https://www.instagram.com/novath011/" role="button" target="_blank">
                    <i class="bi bi-instagram" style="font-size: 24px;"></i>
                </a>
                <a class="boton-footer btn btn-outline-light btn-floating m-1 rounded-circle" href="https://www.youtube.com/channel/UC8yeaYyXegshGcQ4eifyu-w" role="button" target="_blank">
                    <i class="bi bi-youtube" style="font-size: 24px;"></i>
                </a>
                <a class="boton-footer btn btn-outline-light btn-floating m-1 rounded-circle" href="https://twitter.com/Novath01" role="button" target="_blank">
                    <i class="bi bi-google" style="font-size: 24px;"></i>
                </a>
                <a class="boton-footer btn btn-outline-light btn-floating m-1 rounded-circle" href="https://www.twitch.tv/novath01" role="button" target="_blank">
                    <i class="bi bi-twitch" style="font-size: 24px;"></i>
                </a>
            </section>
        </div>
        <div class="text-center p-3" style="color: #a7bfe1;">
            © 2023 NOVATH.com
        </div>
    </footer>
</body>
</html>
