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

    <div class="contenedor">
        <div class="campo-login">
            <img class="logo-contenedor" src="img/NOVATH-claro.png" alt="NOVATH">
            <h2>Iniciá Sesión</h2>
            <form method="POST">
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
                <button class="btn-login" type="submit">Iniciar</button>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>