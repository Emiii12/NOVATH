<?php
include("../../Administrativo/php/conexion.php");

session_start();

if (isset($_SESSION['user_id'])) {
    $sentenciaSQL = $conexion->prepare("SELECT id, email, contrasena, nombre, apellido, descuento_acumulativo, administrador, super_admin FROM usuario WHERE id=:id");
    $sentenciaSQL->bindParam(':id', $_SESSION['user_id']);
    $sentenciaSQL->execute();
    $cuenta = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($cuenta) > 0) {
        $user = $cuenta;
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        session_destroy();
        exit;
    }
}

$sentenciaSQL = $conexion->prepare("SELECT id, cod_entrada, id_evento, id_usuario, cantidad_entradas, precio_total FROM compra");
$sentenciaSQL->execute();
$comprobantes = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
    <?php foreach ($comprobantes as $comprobante) : ?>
        <h1 class="text-center">Número de compra: <?php echo $comprobante['id']; ?></h1>
        <h1 class="text-center">Código de entrada: <?php echo $comprobante['cod_entrada']; ?></h1>
        <h1 class="text-center">Código de evento: <?php echo $comprobante['id_evento']; ?></h1>
        <h1 class="text-center">ID del comprador: <?php echo $comprobante['id_usuario']; ?></h1>
        <hr> <!-- Línea separadora entre comprobantes -->
    <?php endforeach; ?>
        <h1 class="text-center">Cantidad de entradas: <?php echo $comprobante['cantidad_entradas']; ?></h1>
        <h1 class="text-center">Precio Total: <?php echo $comprobante['precio_total']; ?></h1>
</div>
