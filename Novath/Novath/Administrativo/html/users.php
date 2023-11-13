<?php 
include("../php/conexion.php");
include('../php/verificarSesion.php');
$user = verificarSesion($conexion);

$txtID = !empty($_POST['txtID']) ? $_POST['txtID'] : "";
$accion = !empty($_POST['accion']) ? $_POST['accion'] : "";

if ($accion == "Borrar") {
    $sentenciaSQL = $conexion->prepare("DELETE FROM usuario WHERE id=:id");
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
}

if ($accion == "Cambiar Suspensión") {
    $sentenciaSQL = $conexion->prepare("SELECT id, suspension FROM usuario WHERE id = :id");
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
    $usuario = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    $nuevoEstadoSuspension = $usuario['suspension'] == 1 ? 0 : 1;
    $sentenciaSQL = $conexion->prepare("UPDATE usuario SET suspension = :suspension WHERE id = :id");
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->bindParam(':suspension', $nuevoEstadoSuspension);
    $sentenciaSQL->execute();
}

$sentenciaSQL = $conexion->prepare("SELECT id, nombre, apellido, email, telefono, descuento_acumulativo, CASE WHEN suspension = 1 THEN 'Suspendido' ELSE 'No suspendido' END AS estado_suspension FROM usuario WHERE administrador='0' AND super_admin='0'");
$sentenciaSQL->execute();
$listaUsuario = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../template/header.php")?>
<head>
    <title>Gestión Usuarios | NOVATH ADMIN</title>
    <link rel="stylesheet" href="../css/style-user.css">
</head>

    <br><br><br>

    <main>
        <h1 class="title-page text-center m-4">USUARIOS</h1>
        <div class="container">
            <div class="row">
                <div class="col col-12">
                    <table class="table table-general">
                        <thead class="thead-light">
                            <tr>
                                <th class="row-table" scope="col">ID</th>
                                <th class="row-table" scope="col">Nombre</th>
                                <th class="row-table" scope="col">Apellido</th>
                                <th class="row-table" scope="col">Teléfono</th>
                                <th class="row-table" scope="col">Email</th>
                                <th class="row-table" scope="col">Descuento Acumulativo</th>
                                <th class="row-table" scope="col">Suspensión</th>
                                <th class="row-table" scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listaUsuario as $usuario) { ?>
                                <tr>
                                    <td class="rows-next" data-titulo="ID: "><?php echo $usuario['id'] ?></td>
                                    <td class="rows-next" data-titulo="NOMBRE: "><?php echo $usuario['nombre'] ?></td>
                                    <td class="rows-next" data-titulo="APELLIDO: "><?php echo $usuario['apellido'] ?></td>
                                    <td class="rows-next" data-titulo="TELÉFONO: "><?php echo $usuario['telefono'] ?></td>
                                    <td class="rows-next" data-titulo="EMAIL: "><?php echo $usuario['email'] ?></td>
                                    <td class="rows-next" data-titulo="EMAIL: "><?php echo $usuario['descuento_acumulativo'] ?></td>
                                    <td class="rows-next" data-titulo="EMAIL: "><?php echo $usuario['estado_suspension'] ?></td>
                                    <td class="buttons-table-group rows-next text-center">
                                        <form method="POST">
                                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $usuario['id'] ?>">
                                            <input type="submit" name="accion" value="Borrar" class="button-table btn">
                                            <input type="submit" name="accion" value="Cambiar Suspensión" class="button-table btn">
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
