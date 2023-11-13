<?php

$txtID = !empty($_POST['txtID']) ? $_POST['txtID'] : "";
$txtNombreArtista = !empty($_POST['txtNombreArtista']) ? $_POST['txtNombreArtista'] : "";
$txtNombreEvento = !empty($_POST['txtNombreEvento']) ? $_POST['txtNombreEvento'] : "";
$txtFechaEvento = !empty($_POST['txtFechaEvento']) ? $_POST['txtFechaEvento'] : "";
$txtHoraEvento = !empty($_POST['txtHoraEvento']) ? $_POST['txtHoraEvento'] : "";
$txtEntrada = !empty($_POST['txtEntrada']) ? $_POST['txtEntrada'] : "";
$txtPrecio = !empty($_POST['txtPrecio']) ? $_POST['txtPrecio'] : "";
$txtImgEvento = !empty($_FILES['txtImgEvento']['name']) ? $_FILES['txtImgEvento']['name'] : "";
$txtDescripcion = !empty($_POST['txtDescripcion']) ? $_POST['txtDescripcion'] : "";
$accion = !empty($_POST['accion']) ? $_POST['accion'] : "";

include("../php/conexion.php");
include('../php/verificarSesion.php');
$user = verificarSesion($conexion);

switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO evento (artista, nombre_evento, fecha, horario, descripcion, imagen) VALUES (:nombreArtista, :nombreEvento, :fechaEvento, :horaEvento, :descripcion, :imgEvento)");
        $sentenciaSQL->bindParam(':nombreArtista', $txtNombreArtista);
        $sentenciaSQL->bindParam(':nombreEvento', $txtNombreEvento);
        $sentenciaSQL->bindParam(':fechaEvento', $txtFechaEvento);
        $sentenciaSQL->bindParam(':horaEvento', $txtHoraEvento);
        $sentenciaSQL->bindParam(':descripcion', $txtDescripcion);

        $fechaImagen = new DateTime();
        $nombreImagen = !empty($txtImgEvento) ? $fechaImagen->getTimestamp()."_".$_FILES["txtImgEvento"]["name"] : "imagen.jpg";

        $tmpImagen = $_FILES["txtImgEvento"]["tmp_name"];

        if (!empty($tmpImagen)) {
            move_uploaded_file($tmpImagen, "../../img/" . $nombreImagen);
        }

        $txtImgEvento = $nombreImagen;
        $sentenciaSQL->bindParam(':imgEvento', $txtImgEvento);
        $sentenciaSQL->execute();

        $idEvento = $conexion->lastInsertId();

        // Insertar txtPrecio en la tabla entrada
        $sentenciaEntrada = $conexion->prepare("INSERT INTO entrada (id_evento, precio) VALUES (:idEvento, :precio)");
        $sentenciaEntrada->bindParam(':idEvento', $idEvento);
        $sentenciaEntrada->bindParam(':precio', $txtPrecio);
        
        $cantidadEntradas = !empty($_POST['txtEntrada']) ? $_POST['txtEntrada'] : 0;

        for ($i = 0; $i < $cantidadEntradas; $i++) {
            $sentenciaEntrada->execute();
        }

        header("Location:manage-event.php");
        break;

    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE evento SET artista=:artista WHERE id_evento=:id");
        $sentenciaSQL->bindParam(':artista', $txtNombreArtista);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        if (!empty($txtNombreEvento)) {
            $sentenciaSQL = $conexion->prepare("UPDATE evento SET nombre_evento=:nombreEvento WHERE id_evento=:id");
            $sentenciaSQL->bindParam(':nombreEvento', $txtNombreEvento);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }

        if (!empty($txtFechaEvento)) {
            $sentenciaSQL = $conexion->prepare("UPDATE evento SET fecha=:fechaEvento WHERE id_evento=:id");
            $sentenciaSQL->bindParam(':fechaEvento', $txtFechaEvento);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }

        if (!empty($txtHoraEvento)) {
            $sentenciaSQL = $conexion->prepare("UPDATE evento SET horario=:horaEvento WHERE id_evento=:id");
            $sentenciaSQL->bindParam(':horaEvento', $txtHoraEvento);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }

        if (!empty($txtPrecio)) {
            $sentenciaSQL = $conexion->prepare("UPDATE entrada SET precio=:precioEntrada WHERE id_evento=:id");
            $sentenciaSQL->bindParam(':precioEntrada', $txtPrecio);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }

        if (!empty($txtDescripcion)) {
            $sentenciaSQL = $conexion->prepare("UPDATE evento SET descripcion=:descripcion WHERE id_evento=:id");
            $sentenciaSQL->bindParam(':descripcion', $txtDescripcion);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }

        if (!empty($txtImgEvento)) {
            $fechaImagen = new DateTime();
            $nombreImagen = !empty($txtImgEvento) ? $fechaImagen->getTimestamp()."_".$_FILES["txtImgEvento"]["name"] : "imagen.jpg";

            $tmpImagen = $_FILES["txtImgEvento"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../../img/" . $nombreImagen);

            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM evento WHERE id_evento=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $evento = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

            if (isset($evento["imagen"]) && ($evento["imagen"] != "imagen.jpg")) {
                $imagenBorrar = $evento["imagen"];
                if (file_exists("../../img/" . $imagenBorrar)) {
                    unlink("../../img/" . $imagenBorrar);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE evento SET imagen=:imgEvento WHERE id_evento=:id");
            $sentenciaSQL->bindParam(':imgEvento', $nombreImagen);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }

        header("Location:manage-event.php");
        break;

    case "Cancelar":
        header("Location:manage-event.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT e.artista, e.nombre_evento, e.fecha, e.horario, e.descripcion, e.imagen, en.precio, COUNT(en.id_evento) as cantidad_entradas FROM evento e INNER JOIN entrada en ON e.id_evento = en.id_evento WHERE e.id_evento=:id");

        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $evento = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        
        $evento = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

        if ($evento) {
            $txtNombreArtista = $evento['artista'];
            $txtNombreEvento = $evento['nombre_evento'];
            $txtFechaEvento = $evento['fecha'];
            $txtHoraEvento = $evento['horario'];
            $txtDescripcion = $evento['descripcion'];
            $txtImgEvento = $evento['imagen'];
            $txtPrecio = $evento['precio'];
            $txtEntrada = $evento['cantidad_entradas'];
        } else {
            echo '
            <script>
                alert("Evento no encontrado");
                window.location = "manage-event.php";
            </script>
            ';
        }

        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM evento WHERE id_evento=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $evento = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

        if (isset($evento["imagen"]) && ($evento["imagen"] != "imagen.jpg")) {
            $imagenBorrar = $evento["imagen"];
            if (file_exists("../../img/" . $imagenBorrar)) {
                unlink("../../img/" . $imagenBorrar);
            }
        }

        $sentenciaSQLBorrarEntradas = $conexion->prepare("DELETE FROM entrada WHERE id_evento=:id");
        $sentenciaSQLBorrarEntradas->bindParam(':id', $txtID);
        $sentenciaSQLBorrarEntradas->execute();

        $sentenciaSQL = $conexion->prepare("DELETE FROM evento WHERE id_evento=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        header("Location:manage-event.php");
        break;
}

$sentenciaSQL = $conexion->prepare(" SELECT e.id_evento, e.artista, e.nombre_evento, e.fecha, e.horario, e.imagen, COALESCE(precio, 0) AS precio, COALESCE(cantidad_entradas, 0) AS cantidad_entradas FROM evento e LEFT JOIN (SELECT id_evento, precio, COUNT(id_evento) as cantidad_entradas FROM entrada GROUP BY id_evento) entradas ON e.id_evento = entradas.id_evento");

$sentenciaSQL->execute();
$listaEventos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>



<?php include("../template/header.php")?>
<head>
    <title>Agregar Evento | NOVATH ADMIN</title>
    <link rel="stylesheet" href="../css/style-manage-event.css">
</head>

    <br><br><br>

    <main>
        <h1 class="title-page text-center m-4">EVENTOS</h1>
        <div class="container">
            <div class="row">

                <div class="col col-12">

                    <div class="d-flex flex-column mb-3">
                        <a class="button-accordion btn w-100 mb-3" data-bs-toggle="collapse" href="#collapseLink" role="button" aria-expanded="false" aria-controls="collapseLink">Agregar eventos</a>
                        <div class="collapse" id="collapseLink">
                            <div class="card card-form">
                                <div class="card-header text-center">
                                    DATOS DEL EVENTO
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-row d-flex d-grid gap-3 p-1 mb-4">
                                            <div class="form-group col-xl-6 col-md-6">
                                                <label for="txtID">ID</label>
                                                <input type="text" class="form-control" name="txtID" id="txtID" value="<?php echo $txtID; ?>" required readonly>
                                            </div>
                                            <div class="form-group col-xl-6 col-md-6">
                                                <label for="txtNombreEvento">Evento</label>
                                                <input type="text" class="form-control" value="<?php echo $txtNombreEvento; ?>" name="txtNombreEvento" id="txtNombreEvento" placeholder="Nombre del evento" required>
                                            </div>
                                        </div>
                                        <div class="form-row d-flex d-grid gap-3 mb-4">
                                            <div class="form-group col-xl-6 col-md-6">
                                                <label for="txtNombreArtista">Artista</label>
                                                <input type="text" class="form-control" value="<?php echo $txtNombreArtista; ?>" name="txtNombreArtista" id="txtNombreArtista" placeholder="Nombre del artista" required>
                                            </div>
                                            <div class="form-group col-xl-6 col-md-6">
                                                <label for="txtDescripcion">Descripcion</label>
                                                <textarea class="form-control" name="txtDescripcion" id="txtDescripcion" rows="1" required><?php echo $txtDescripcion; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row d-flex d-grid gap-1 mb-4">
                                            <div class="form-group col-xl-3 col-md-3">
                                                <label for="txtFechaEvento">Fecha</label>
                                                <input type="date" class="form-control w-100" value="<?php echo $txtFechaEvento; ?>" name="txtFechaEvento" id="txtFechaEvento" placeholder="Fecha del evento" required>
                                            </div>
                                            <div class="form-group col-xl-3 col-md-3">
                                                <label for="txtHoraEvento">Horario</label>
                                                <input type="time" class="form-control w-100" value="<?php echo $txtHoraEvento; ?>" name="txtHoraEvento" id="txtHoraEvento" placeholder="Hora del evento" required>
                                            </div>
                                            <div class="form-group col-xl-3 col-md-3">
                                                <label for="txtEntrada">Entradas En Venta</label>
                                                <input type="text" class="form-control" value="<?php echo $txtEntrada; ?>" name="txtEntrada" id="txtEntrada" placeholder="Cantidad de entradas" required>
                                            </div>
                                            <div class="form-group col-xl-3 col-md-3">
                                                <label for="txtPrecio">Precio</label>
                                                <input type="text" class="form-control" value="<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Precio de entradas" required>
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="txtImgEvento">Imagen</label>
                                                <?php if($txtImgEvento!="") { ?>
                                                    <img src="../../img/<?php echo $txtImgEvento; ?>" width="50">
                                                <?php } ?>
                                            <input type="file" class="form-control form-file" name="txtImgEvento" id="txtImgEvento">
                                        </div>
                                        
                                        <div id="grupo-button" class="buttons-form d-grid gap-2 d-flex" role="group" aria-label="">
                                            <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="button-card btn  w-50">Agregar</button>
                                            <button type="submit" name="accion" <?php echo ($accion=="Seleccionar"); ?> value="Modificar" class="button-card btn  w-50">Modificar</button>
                                            <button type="submit" name="accion" <?php echo ($accion=="Seleccionar"); ?> value="Cancelar" class="button-card btn  w-50">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    

                    <!-- BÚSQUEDA Y FILTROS -->
                    
                    <table class="table table-general">
                        <thead class="thead-light">
                            <tr>
                                <th class="row-table" scope="col">ID</th>
                                <th class="row-table" scope="col">Artista</th>
                                <th class="row-table" scope="col">Nombre</th>
                                <th class="row-table" scope="col">Fecha</th>
                                <th class="row-table" scope="col">Hora</th>
                                <th class="row-table" scope="col">Entradas</th>
                                <th class="row-table" scope="col">Precio</th>
                                <th class="row-table" scope="col">Imagen</th>
                                <th class="row-table" scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listaEventos as $evento) { ?>
                            <tr>
                                <td class="rows-next" data-titulo="ID: "><?php echo $evento['id_evento'] ?></td>
                                <td class="rows-next" data-titulo="ARTISTA: "><?php echo $evento['artista'] ?></td>
                                <td class="rows-next" data-titulo="EVENTO: "><?php echo $evento['nombre_evento'] ?></td>
                                <td class="rows-next" data-titulo="FECHA: "><?php echo $evento['fecha'] ?></td>
                                <td class="rows-next" data-titulo="HORA: "><?php echo $evento['horario'] ?></td>
                                <td class="rows-next" data-titulo="ENTRADAS: "><?php echo $evento['cantidad_entradas'] ?></td>
                                <td class="rows-next" data-titulo="PRECIO: "><?php echo $evento['precio'] ?></td>
                                <td class="rows-next" data-titulo="IMAGEN: ">
                                    <img src="../../img/<?php echo $evento['imagen'] ?>" width="50">    
                                </td>
                                <td class="buttons-table-group rows-next text-center">
                                    <form method="POST">
                                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $evento['id_evento'] ?>">
                                        <input type="submit" name="accion" value="Seleccionar" class="button-table btn">
                                        <input type="submit" name="accion" value="Borrar" class="button-table btn">
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

<!--
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("seccion-filtro-busqueda").classList.remove("show");
        });
    </script>
    -->
</body>
</html>