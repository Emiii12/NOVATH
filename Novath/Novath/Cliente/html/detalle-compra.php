<?php
include("../../Administrativo/php/conexion.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_evento = $_GET['id'];

    $sentenciaSQL = $conexion->prepare("SELECT id_evento, artista, nombre_evento, fecha, horario, imagen, descripcion FROM evento WHERE id_evento = :id");
    $sentenciaSQL->bindParam(':id', $id_evento, PDO::PARAM_INT);
    $sentenciaSQL->execute();
    $evento = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    if (!$evento) {
        echo "Evento no encontrado";
        exit();
    }

    $artista = $evento['artista'];
    $nombre_evento = $evento['nombre_evento'];
    $fecha = $evento['fecha'];
    $horario = $evento['horario'];
    $imagen = $evento['imagen'];
    $descripcion = $evento['descripcion'];
} else {
    echo "ID de evento inválido";
    exit();
}

session_start();

if (isset($_SESSION['user_id'])) {
    $sentenciaSQL = $conexion->prepare("SELECT id, email, contrasena, nombre, apellido, administrador, super_admin, descuento_acumulativo FROM usuario WHERE id = :id");
    $sentenciaSQL->bindParam(':id', $_SESSION['user_id']);
    $sentenciaSQL->execute();
    $cuenta = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    if ($cuenta) {
        $user = $cuenta;

        $descuentoAcumulativo = $user['descuento_acumulativo'];

        if (!empty($descuentoAcumulativo) && $descuentoAcumulativo >= 0) {
            $sentenciaSQL2 = $conexion->prepare("SELECT precio FROM entrada WHERE id_evento = :id_evento");
            $sentenciaSQL2->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
            $sentenciaSQL2->execute();
            $entradaPrecio = $sentenciaSQL2->fetch(PDO::FETCH_ASSOC);

            $precio = ($entradaPrecio && $entradaPrecio['precio'] > 0) ? $entradaPrecio['precio'] : 6000;
            $descuento = (($precio * $descuentoAcumulativo) / 100);
            $precioTotal = $precio - $descuento;

            $precio_js = $precio;
            $descuento_acumulativo_js = $user['descuento_acumulativo'];
        }
    }
}

if (isset($_SESSION['user_id'])) {
    $sentenciaSQL = $conexion->prepare("SELECT id, email, contrasena, nombre, apellido, descuento_acumulativo, suspension, administrador, super_admin FROM usuario WHERE id=:id");
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

$sentenciaSQL = $conexion->prepare("SELECT cod_entrada, id_evento, qr, butaca, precio FROM entrada");
$sentenciaSQL->execute();
$listaEntradas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$precio = 0;

if ($listaEntradas) {
    foreach ($listaEntradas as $entrada) {
        if ($entrada['id_evento'] == $id_evento) {
            $precio = $entrada['precio'];
            break;
        }
    }
}

$precio_total = 0;

if (isset($_POST['comprar'])) {
    // Verificar si el usuario tiene una suspensión indefinida
    if ($user['suspension'] == 1) {
        echo '<script>alert("No puedes comprar. Tienes la cuenta suspendida indefinidamente."); window.location = "../index.php";</script>';
        die();  // Detener la ejecución del script si hay una suspensión indefinida
    }

    $cantidad_entradas = isset($_POST['cantidad_entradas']) ? intval($_POST['cantidad_entradas']) : 0;

    $precio_total = $cantidad_entradas * $precio;

    if (isset($_POST['descuento_acumulativo']) && $_POST['descuento_acumulativo'] == 'on') {
        if ($descuentoAcumulativo > 30) {
            $descuentoAcumulativo = 30; 
        }

        $descuento = ($precio_total * $descuentoAcumulativo) / 100;
        $precio_total -= $descuento;

        // Descuento acumulativo a 0 si se utiliza
        $nuevoDescuento = 0;
    } else {
        // Sumar 3 al descuento acumulativo si no se utiliza
        $nuevoDescuento = min($descuentoAcumulativo + 3, 30);
    }

    try {
        $id_usuario = $_SESSION['user_id'];

        $insercion = $conexion->prepare("INSERT INTO compra (id_usuario, id_evento, cod_entrada, cantidad_entradas, precio_total) VALUES (:id_usuario, :id_evento, :cod_entrada, :cantidad_entradas, :precio_total)");

        $insercion->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $insercion->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
        $insercion->bindParam(':cod_entrada', $entrada['cod_entrada'], PDO::PARAM_STR);
        $insercion->bindParam(':cantidad_entradas', $cantidad_entradas, PDO::PARAM_INT);
        $insercion->bindParam(':precio_total', $precio_total, PDO::PARAM_INT);

        $insercion->execute();

        // Actualizar el descuento acumulativo en la base de datos
        $sentenciaUpdate = $conexion->prepare("UPDATE usuario SET descuento_acumulativo = :nuevoDescuento WHERE id = :userId");
        $sentenciaUpdate->bindParam(':nuevoDescuento', $nuevoDescuento, PDO::PARAM_INT);
        $sentenciaUpdate->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
        $sentenciaUpdate->execute();

        header("Location: comprobante-pago.php");

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<?php include("../template/header.php"); ?>

<head>
    <link rel="stylesheet" href="../css/style-index.css">
    <link rel="stylesheet" href="../css/style-vista-evento.css">
    <title><?php echo $nombre_evento . " - Comprar"; ?></title>
</head>

<div class="container mb-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <img src="../../img/<?php echo $imagen; ?>" class="card-img-top" alt="Evento">
                <div class="card-body">
                    <h5 class="card-title"><b><?php echo $nombre_evento; ?></b></h5>
                    <p class="card-text text-uppercase"><?php echo $artista; ?></p>
                    <br>
                    <p class="card-text text-uppercase">
                        <b>Precio: $<?php echo ($precio > 0) ? $precio : 6000; ?></b>
                    </p>
                    <form method="post">
                        <label for="cantidad_entradas" class="card-text text-uppercase">Cantidad de entradas:</label>
                        <input type="number" id="cantidad_entradas" name="cantidad_entradas" min="1" required>
                        <br>
                        <label for="descuento_acumulativo" class="card-text text-uppercase">¿Usar descuento acumulativo?</label>
                        <input type="checkbox" id="descuento_acumulativo" name="descuento_acumulativo">
                        <p class="card-text">Su descuento acumulativo es de: <?php echo $user['descuento_acumulativo']; ?></p>
                        <br>
                        <p class="card-text text-uppercase" id="precio_total">PRECIO TOTAL: $0</p>
                        <input type="submit" name="comprar" id="comprar" value="COMPRAR" class="btn boton-card btn-outline-dark w-100">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('cantidad_entradas').addEventListener('input', function() {
        actualizarPrecio();
    });

    document.getElementById('descuento_acumulativo').addEventListener('change', function() {
        actualizarPrecio();
    });

    function actualizarPrecio() {
        var cantidad = parseInt(document.getElementById('cantidad_entradas').value) || 0;
        var precioUnitario = <?php echo ($precio > 0) ? $precio : 6000; ?>;
        var descuentoAcumulativo = document.getElementById('descuento_acumulativo').checked;
        var porcentajeDescuento = <?php echo $descuento_acumulativo_js; ?>;

        var precioTotal = cantidad * precioUnitario;

        if (descuentoAcumulativo) {
            var descuento = (precioTotal * porcentajeDescuento) / 100;
            precioTotal = precioTotal - descuento;
        }

        document.getElementById('precio_total').textContent = 'PRECIO TOTAL: $' + precioTotal.toFixed(2);
    }
</script>

<?php include("../template/footer.php"); ?>