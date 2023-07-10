<?php

include("../../Administrativo/php/conexion.php");

$txtNombre = !empty($_POST['txtNombre']) ? $_POST['txtNombre'] : "";
$txtApellido = !empty($_POST['txtApellido']) ? $_POST['txtApellido'] : "";
$txtEmail = !empty($_POST['txtEmail']) ? $_POST['txtEmail'] : "";
$txtContrasena = !empty($_POST['txtContrasena']) ? $_POST['txtContrasena'] : "";
$txtTelefono = !empty($_POST['txtTelefono']) ? $_POST['txtTelefono'] : "";

$message = "Has creado tu cuenta";

if( !empty($txtEmail) && (!empty($txtApellido)) && (!empty($txtEmail)) && (!empty($txtContrasena)) && (!empty($txtTelefono)) ) {
    $sentenciaSQL = $conexion->prepare("INSERT INTO usuario (nombre, apellido, email, contrasena, telefono, descuento_acumulativo, suspension, administrador, super_admin) VALUES (:nombre, :apellido, :email, :contrasena, :telefono, '0', '0', '0', '0')");
    $sentenciaSQL->bindParam(':nombre', $txtNombre);
    $sentenciaSQL->bindParam(':apellido', $txtApellido);
    $sentenciaSQL->bindParam(':email', $txtEmail);
    $txtContrasena = password_hash(($txtContrasena), PASSWORD_BCRYPT);
    $sentenciaSQL->bindParam(':contrasena', $txtContrasena);
    $sentenciaSQL->bindParam(':telefono', $txtTelefono);
    $sentenciaSQL->execute();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | NOVATH</title>
    <link rel="stylesheet" href="../css/style-register.css">
    <link rel="shortcut icon" href="../img/NOVATH-LOGO.png" />
</head>
<body>

    <?php if( !empty($message) ) :  ?>
        <p><?= $message ?></p>   
    <?php endif; ?>

    <header>
        <a href="../index.php"><span><ion-icon name="chevron-back-outline"></ion-icon></span></a>
    </header>

    <div class="contenedor">
        <div class="campo-login">
            <img class="logo-contenedor" src="../img/NOVATH.png" alt="NOVATH">
            <h2>Registráte</h2>
            <form method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="txtNombre" id="txtNombre" required>
                    <label for="txtNombre">Nombre</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="txtApellido" id="txtApellido" required>
                    <label for="txtApellido">Apellido</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="txtEmail" id="txtEmail" required>
                    <label for="txtEmail">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="txtContrasena" id="txtContrasena" required>
                    <label for="txtContrasena">Contraseña</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="call"></ion-icon></span>
                    <input type="tel" name="txtTelefono" id="txtTelefono" required>
                    <label for="txtTelefono">Teléfono</label>
                </div>
                <button class="btn-login">Continuar</button>
                <div class="register-link">
                    <p>¿Ya ténes una cuenta? <a href="login.php"><b>Iniciá Sesión acá</b></a></p>
                </div>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>