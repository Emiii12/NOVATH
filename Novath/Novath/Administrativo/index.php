<?php
session_start();

require("php/conexion.php");

$txtEmail = !empty($_POST['txtEmail']) ? $_POST['txtEmail'] : "";
$txtContrasena = !empty($_POST['txtContrasena']) ? $_POST['txtContrasena'] : "";

if ((!empty($txtEmail)) && (!empty($txtContrasena))) {
    $records = $conexion->prepare('SELECT id, email, contrasena, administrador, super_admin FROM usuario WHERE email=:email');
    $records->bindParam(':email', $txtEmail);
    $records->execute();
    $user = $records->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($txtContrasena, $user['contrasena'])) {
        if ($user['administrador'] || $user['super_admin']) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: html/inicio-admin.php');
            exit();
        } else {
            $message = 'Acceso denegado. No tienes los permisos necesarios.';
        }
    } else {
        $message = 'Usuario o contraseña incorrectos.';
    }
}
/*
    if ($results && $sentenciaSQL->rowCount() > 0 && password_verify($txtContrasena, $results['contrasena'])) {
        $_SESSION['user_id'] = $results['id'];
        header('Location: html/inicio-admin.php');
        exit;
    } else {
        $message = 'Los datos no concuerdan';
    }
*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión | NOVATH</title>
    <link rel="stylesheet" href="css/style-index-admin.css">
    <link rel="shortcut icon" href="img/NOVATH-LOGO.png" />
</head>
<body>

    <?php if (!empty($message)) :  ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <div class="contenedor">
        <div class="campo-login">
            <img class="logo-contenedor" src="img/NOVATH-claro.png" alt="NOVATH">
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
                <button class="btn-login" type="submit">Iniciar</button>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>