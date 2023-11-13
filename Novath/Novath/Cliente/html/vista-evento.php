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

<?php include("../template/header.php"); ?>
<head>
    <link rel="stylesheet" href="../css/style-index.css">
    <link rel="stylesheet" href="../css/style-vista-evento.css">
    <title><?php echo $nombre_evento; ?></title>
</head>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <img src="../../img/<?php echo $imagen; ?>" class="card-img-top" alt="Evento">
                    <div class="card-body">
                        <h5 class="card-title title-event mb-3"><b><?php echo $nombre_evento; ?></b></h5>
                        <p class="card-text text-uppercase"><?php echo $artista; ?></p>
                        <p class="card-text"><b>Fecha:</b> <?php echo $fecha; ?></p>
                        <p class="card-text"><b>Horario:</b> <?php echo $horario; ?></p>
                        <p class="card-text"><?php echo $descripcion; ?></p>
                        <a href="detalle-compra.php?id=<?php echo $evento['id_evento']; ?>" class="btn boton-card btn-outline-dark w-100">COMPRAR ENTRADAS</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("../template/footer.php"); ?>
