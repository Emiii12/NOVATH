<?php

include("../php/conexion.php");

$txtNombre = !empty($_POST['txtNombre']) ? $_POST['txtNombre'] : "";
$txtApellido = !empty($_POST['txtApellido']) ? $_POST['txtApellido'] : "";
$txtEmail = !empty($_POST['txtEmail']) ? $_POST['txtEmail'] : "";
$txtDni = !empty($_POST['txtDni']) ? $_POST['txtDni'] : "";
$txtContrasena = !empty($_POST['txtContrasena']) ? $_POST['txtContrasena'] : "";
$txtTelefono = !empty($_POST['txtTelefono']) ? $_POST['txtTelefono'] : "";

$message;

if( !empty($txtEmail) && (!empty($txtApellido)) && (!empty($txtEmail)) && (!empty($txtContrasena)) && (!empty($txtTelefono)) ) {
    $sentenciaSQL = $conexion->prepare("INSERT INTO usuario (nombre, apellido, email, dni, contrasena, telefono, descuento_acumulativo, suspension, administrador, super_admin) VALUES (:nombre, :apellido, :email, :dni, :contrasena, :telefono, '0', '0', '1', '0')");
    $sentenciaSQL->bindParam(':nombre', $txtNombre);
    $sentenciaSQL->bindParam(':apellido', $txtApellido);
    $sentenciaSQL->bindParam(':email', $txtEmail);
    $sentenciaSQL->bindParam(':dni', $txtDni);
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
    <title>Registro | NOVATH ADMIN</title>
    <link rel="stylesheet" href="../css/style-register-admin.css">
    <link rel="shortcut icon" href="../img/NOVATH-LOGO.png" />
</head>
<body>

    

    <header>
        <a href="start-admin.php"><span><ion-icon name="chevron-back-outline"></ion-icon></span></a>
    </header>

    <div class="container-main">
        <div class="register-sector">
            <img class="logo-container" src="../img/NOVATH-claro.png" alt="NOVATH">
            <form method="POST">
                <h2>Registrar Admin</h2>
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
                    <span class="icon"><ion-icon name="card"></ion-icon></span>
                    <input type="text" name="txtDni" id="txtDni" required>
                    <label for="txtDni">DNI</label>
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
                <button class="btn-register">Registrar</button>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>