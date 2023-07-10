<?php

$txtID = !empty($_POST['txtID']) ? $_POST['txtID'] : "";
$txtNombreArtista = !empty($_POST['txtNombreArtista']) ? $_POST['txtNombreArtista'] : "";
$txtNombreEvento = !empty($_POST['txtNombreEvento']) ? $_POST['txtNombreEvento'] : "";
$txtFechaEvento = !empty($_POST['txtFechaEvento']) ? $_POST['txtFechaEvento'] : "";
$txtHoraEvento = !empty($_POST['txtHoraEvento']) ? $_POST['txtHoraEvento'] : "";
$txtImgEvento = !empty($_FILES['txtImgEvento']['name']) ? $_FILES['txtImgEvento']['name'] : "";
$txtDescripcion = !empty($_POST['txtDescripcion']) ? $_POST['txtDescripcion'] : "";
$accion = !empty($_POST['accion']) ? $_POST['accion'] : "";

include("../php/conexion.php");

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
        $sentenciaSQL = $conexion->prepare("SELECT artista, nombre_evento, fecha, horario, descripcion, imagen FROM evento WHERE id_evento=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $evento = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombreArtista = $evento['artista'];
        $txtNombreEvento = $evento['nombre_evento'];
        $txtFechaEvento = $evento['fecha'];
        $txtHoraEvento = $evento['horario'];
        $txtDescripcion = $evento['descripcion'];
        $txtImgEvento = $evento['imagen'];

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

        

        $sentenciaSQL = $conexion->prepare("DELETE FROM evento WHERE id_evento=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        header("Location:manage-event.php");
        break;
}

session_start();

if( isset($_SESSION['user_id'])) {
    $sentenciaSQL = $conexion->prepare("SELECT id, email, contrasena, nombre, apellido, administrador, super_admin FROM usuario WHERE id=:id AND administrador='1'");
    $sentenciaSQL->bindParam(':id', $_SESSION['user_id']);
    $sentenciaSQL->execute();
    $cuenta = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    // Verificar si se obtuvo un resultado válido antes de asignar a $user
    if($cuenta !== false && count($cuenta) > 0) {
        $user = $cuenta;
    } else {
        echo '
            <script>
                alert("No tienes los permisos necesarios. Vuelve a iniciar seisón.");
                window.location = "../index.php";
            </script>
        ';
        //header("Location: ../index.php");
        session_destroy();
        die();
    }
} else {
    echo '
            <script>
                alert("Inicia sesión antes de ingresar");
                window.location = "../index.php";
            </script>
        ';
    //header("Location: ../index.php");
    die();
}

$sentenciaSQL = $conexion->prepare("SELECT id_evento, artista, nombre_evento, fecha, horario, imagen FROM evento");
$sentenciaSQL->execute();
$listaEventos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <link rel="shortcut icon" href="../img/NOVATH-LOGO.png" />
    <title>Agregar Evento | NOVATH ADMIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style-inicio-admin.css">
    <link rel="stylesheet" href="../css/style-manage-event.css">
</head>
<body>
    

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="inicio-admin.php">
                <img class="novath-titulo" src="../img/NOVATH.png" width="180" alt="NOVATH-ADMIN">
                <img class="novath-icono" src="../img/NOVATH-LOGO.png" width="50" alt="NOVATH">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-toggler">
                <ul class="navbar-nav">
                    <?php if (!empty($user)): ?>
                        <?php if ($user['super_admin']): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="register-account-admin.php">Crear nuevo usuario</a>
                            </li>
                        <?php elseif ($user['administrador']): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="manage-event.php">Eventos</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/logout.php">Cerrar sesión</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <br><br>

    <main>
        <h1 class="titulo-pagina text-center">EVENTOS</h1>
        <div class="container">
            <div class="row">
                <div class="col col-xl-4 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header text-center">
                            DATOS DEL EVENTO
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="txtID">ID</label>
                                    <input type="text" class="form-control" name="txtID" id="txtID" value="<?php echo $txtID; ?>" required readonly>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtNombreArtista">Artista</label>
                                    <input type="text" class="form-control" value="<?php echo $txtNombreArtista; ?>" name="txtNombreArtista" id="txtNombreArtista" placeholder="Nombre del artista" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtNombreEvento">Evento</label>
                                    <input type="text" class="form-control" value="<?php echo $txtNombreEvento; ?>" name="txtNombreEvento" id="txtNombreEvento" placeholder="Nombre del evento" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtFechaEvento">Fecha</label>
                                    <input type="date" class="form-control" value="<?php echo $txtFechaEvento; ?>" name="txtFechaEvento" id="txtFechaEvento" placeholder="Fecha del evento" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtHoraEvento">Horario</label>
                                    <input type="time" class="form-control" value="<?php echo $txtHoraEvento; ?>" name="txtHoraEvento" id="txtHoraEvento" placeholder="Hora del evento"  required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtDescripcion">Descripcion</label>
                                    <textarea class="form-control" name="txtDescripcion" id="txtDescripcion" rows="3" required><?php echo $txtDescripcion; ?></textarea>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtImgEvento">Imagen</label>
                                    <br/>
                                    <?php if($txtImgEvento!="") { ?>
                                        <img src="../../img/<?php echo $txtImgEvento; ?>" width="50">
                                    <?php } ?>
                                    <input type="file" class="form-control form-file" name="txtImgEvento" id="txtImgEvento">
                                </div>
                                <br>
                                <div id="grupo-boton" class="botones d-grid gap-2 d-flex" role="group" aria-label="">
                                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="boton-card-eventos btn btn-outline-dark w-50">Agregar</button>
                                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="boton-card-eventos btn btn-outline-dark w-50">Modificar</button>
                                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="boton-card-eventos btn btn-outline-dark w-50">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
                

                <div class="col col-xl-8 col-lg-12 col-md-12 col-sm-12">
                    <div class="grupo-saltos">
                        <br><br><br>
                    </div>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="fila-tabla" scope="col">ID</th>
                                <th class="fila-tabla" scope="col">Artista</th>
                                <th class="fila-tabla" scope="col">Nombre</th>
                                <th class="fila-tabla" scope="col">Fecha</th>
                                <th class="fila-tabla" scope="col">Hora</th>
                                <th class="fila-tabla" scope="col">Imagen</th>
                                <th class="fila-tabla" scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($listaEventos as $evento) { ?>
                            <tr>
                                <td class="filas-siguientes"><?php echo $evento['id_evento'] ?></td>
                                <td class="filas-siguientes"><?php echo $evento['artista'] ?></td>
                                <td class="filas-siguientes"><?php echo $evento['nombre_evento'] ?></td>
                                <td class="filas-siguientes"><?php echo $evento['fecha'] ?></td>
                                <td class="filas-siguientes"><?php echo $evento['horario'] ?></td>
                                <td class="filas-siguientes">
                                    <img src="../../img/<?php echo $evento['imagen'] ?>" width="50">
                                </td>

                                <td class="filas-siguientes">
                                    <form method="POST">
                                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $evento['id_evento'] ?>">
                                        <input type="submit" name="accion" value="Seleccionar" class="boton-card-eventos btn btn-outline-dark">
                                        <input type="submit" name="accion" value="Borrar" class="boton-card-eventos btn btn-outline-dark">
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