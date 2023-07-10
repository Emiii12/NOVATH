<?php 

session_start();

require("../php/conexion.php");

if( isset($_SESSION['user_id'])) {
    $sentenciaSQL = $conexion->prepare("SELECT id, email, contrasena, nombre, apellido, administrador, super_admin FROM usuario WHERE id=:id");
    $sentenciaSQL->bindParam(':id', $_SESSION['user_id']);
    $sentenciaSQL->execute();
    $cuenta = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    // Verificar si se obtuvo un resultado válido antes de asignar a $user
    if(count($cuenta) > 0) {
        $user = $cuenta;
    } else {
        echo '
            <script>
                alert("Inicia sesión antes de ingresar");
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/NOVATH-LOGO.png" />
    <title>NOVATH ADMIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style-inicio-admin.css">
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
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="container"> <br><br><br><br><br>
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron shadow p-3 mb-5 bg-body rounded">

                        <?php if(!empty($user)): ?>
                            <?php if ($user['super_admin']): ?>
                            <h1 class="display-3 text-center">Bienvenid@, Super-Usuario</h1>
                            <h2 class="display-3 text-center"><?= $user['nombre'] ?> <?= $user['apellido'] ?></h2>
                            <hr class="my-2">
                            <?php elseif ($user['administrador']): ?>
                            <h1 class="display-3 text-center">Bienvenid@, Administrador</h1>
                            <h2 class="display-3 text-center"><?= $user['nombre'] ?> <?= $user['apellido'] ?></h2>
                            <hr class="my-2">
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>


</body>
</html>