<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/NOVATH-LOGO.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style-common.css">
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img class="novath-titulo" srcset="../img/NOVATH.png" width="180" alt="NOVATH">
                <img class="novath-icono" src="../img/NOVATH-LOGO.png" width="50" alt="NOVATH">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if (!empty($user)): ?>
                <div class="collapse navbar-collapse" id="navbar-toggler"> 
                    <ul class="navbar-nav d-flex align-items-center justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="../html/preguntas-ayuda.php">
                                <button type="button" class="btn btn-outline-light">Ayuda y Guía</button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/logout.php">
                                <button type="button" class="btn btn-outline-light">Cerrar Sesión</button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../html/vista-usuario.php">
                                <i class="bi bi-person-circle" style="font-size: 45px; color: #a7bfe1"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="collapse navbar-collapse" id="navbar-toggler"> 
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../html/preguntas-ayuda.php">
                                <button type="button" class="btn btn-outline-light">Ayuda y Guía</button>
                            </a>
                        </li>
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