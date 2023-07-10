<?php
session_start();

require("../../Administrativo/php/conexion.php");

$txtEmail = !empty($_POST['txtEmail']) ? $_POST['txtEmail'] : "";
$txtContrasena = !empty($_POST['txtContrasena']) ? $_POST['txtContrasena'] : "";

$message;

if ((!empty($txtEmail)) && (!empty($txtContrasena))) {
    $sentenciaSQL = $conexion->prepare('SELECT id, email, contrasena, administrador, super_admin FROM usuario WHERE email=:email');
    $sentenciaSQL->bindParam(':email', $txtEmail);
    $sentenciaSQL->execute();
    $user = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($txtContrasena, $user['contrasena'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../index.php');
        exit();
    } else {
        $message = 'Usuario o contraseña incorrectos.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión | NOVATH</title>
    <link rel="stylesheet" href="../css/style-login.css">
    <link rel="shortcut icon" href="../img/NOVATH-LOGO.png" />
</head>
<body>

    <?php if (!empty($message)) :  ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <header>
        <a href="../index.php"><span><ion-icon name="chevron-back-outline"></ion-icon></span></a>
    </header>

    <div class="contenedor">
        <div class="campo-login">
            <img class="logo-contenedor" src="../img/NOVATH.png" alt="NOVATH">
            <h2>Iniciá Sesión</h2>
            <form method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="txtEmail" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="txtContrasena" required>
                    <label>Contraseña</label>
                </div>
                <button class="btn-login">Continuar</button>
                <div class="register-link">
                    <p>¿No ténes una cuenta? <a href="register.php"><b>Registrate acá</b></a></p>
                </div>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>