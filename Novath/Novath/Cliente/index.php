<?php

// session_start();

include("../Administrativo/php/conexion.php");

session_start();

if( isset($_SESSION['user_id'])) {
    $sentenciaSQL = $conexion->prepare("SELECT id, email, contrasena, nombre, apellido, administrador, super_admin FROM usuario WHERE id=:id");
    $sentenciaSQL->bindParam(':id', $_SESSION['user_id']);
    $sentenciaSQL->execute();
    $cuenta = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if($cuenta['super_admin'] == 1 || $cuenta['administrador'] == 1) {
        session_destroy();
        header("Location: index.php");
        exit;
    }

    if(count($cuenta) > 0) {
        $user = $cuenta;
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        session_destroy();
        exit;
    }
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
    <link rel="shortcut icon" href="img/NOVATH-LOGO.png" />
    <title>NOVATH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style-common.css">
    <link rel="stylesheet" href="css/style-index.css">
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img class="novath-titulo" srcset="img/NOVATH.png" width="180" alt="NOVATH">
                <img class="novath-icono" src="img/NOVATH-LOGO.png" width="50" alt="NOVATH">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if (!empty($user)): ?>
                <div class="collapse navbar-collapse" id="navbar-toggler"> 
                <ul class="navbar-nav d-flex align-items-center justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="php/logout.php">
                                <button type="button" class="btn btn-outline-light">Cerrar Sesión</button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="html/vista-usuario.php">
                                <i class="bi bi-person-circle" style="font-size: 45px; color: #a7bfe1"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="collapse navbar-collapse" id="navbar-toggler"> 
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="html/login.php">
                                <button type="button" class="btn btn-outline-light">Iniciar Sesión</button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="html/register.php">
                                <button type="button" class="btn btn-outline-light">Registrarse</button>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </nav>  





    <br><br>

    <main>
        <div class="container container-carousel mb-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" >
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://img.freepik.com/fotos-premium/lineas-movimiento-anchas-rayos-color-azul-oscuro-fondo-espacio-vacio_148157-195.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://img.freepik.com/fotos-premium/lineas-movimiento-anchas-rayos-color-gris-oscuro-fondo-espacio-vacio_148157-197.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://img.freepik.com/fotos-premium/fondo-espacio-vacio-rayos-color-gris-oscuro-amplio-movimiento_148157-320.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        


    <section>
        <h1 class="title text-center mb-5">EVENTOS</h1>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-4">

                <?php foreach($listaEventos as $evento) { ?>
                <div class="col">
                    <div class="card shadow-sm h-100 d-flex flex-column justify-content-between">
                        <img src="../img/<?php echo $evento['imagen'] ?>" alt="Prueba">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?php echo $evento['nombre_evento'] ?></h5>
                        </div>
                        <div class="card-footer">
                            <a href="html/vista-evento.php?id=<?php echo $evento['id_evento']; ?>" class="btn boton-card btn-outline-dark w-100">Más información</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
        
    </main>
                

    


    <script>
        function ajustarAlturaTarjetas() {
            const tarjetas = document.getElementsByClassName('card');
            for (let i = 0; i < tarjetas.length; i++) {
                const titulo = tarjetas[i].querySelector('.card-title');
                tarjetas[i].style.height = `${titulo.offsetHeight + 120}px`;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            ajustarAlturaTarjetas();
        });
    </script>


<?php include("template/footer.php"); ?>