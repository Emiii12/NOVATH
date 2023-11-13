<?php
require("../../Administrativo/php/conexion.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$sentenciaSQL = $conexion->prepare("SELECT nombre, apellido, email, contrasena, telefono, descuento_acumulativo, administrador, super_admin FROM usuario WHERE id = :id");
$sentenciaSQL->bindParam(':id', $_SESSION['user_id']);
$sentenciaSQL->execute();
$cuenta = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

if (count($cuenta) > 0) {
    $user = $cuenta;
} else {
    header("Location: ../index.php");
    exit();
}
?>

<?php include("../template/header.php"); ?>
<head>
    <link rel="stylesheet" href="../css/style-index.css">
    <link rel="stylesheet" href="../css/style-vista-evento.css">
    <link rel="stylesheet" href="../css/style-vista-usuario.css">
    <title><?php echo $user['nombre'] . ' ' . $user['apellido']; ?></title>
</head>

    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title title-event mb-3 text-center"><b><?php echo $user['nombre'] . ' ' . $user['apellido']; ?></b></h5>
                <p class="card-text text-uppercase"><b>Datos Personales:</b></p>
                <p class="card-text"><b>Email:</b> <?php echo $user['email']; ?></p>
                <p class="card-text"><b>Telefono:</b> <?php echo $user['telefono']; ?></p>
                <p class="card-text text-uppercase"><b>Descuento acumulativo:</b></p>
                <p class="card-text"><b>Su descuento acumulativo es de:</b> <?php echo $user['descuento_acumulativo']; ?></p>
            </div>
        </div>
    </div>

<?php include("../template/footer.php"); ?>