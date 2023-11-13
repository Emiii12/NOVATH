<?php 

include("../php/conexion.php");
include('../php/verificarSesion.php');
$user = verificarSesion($conexion);

?>

<?php include("../template/header.php")?>
<head>
    <title>NOVATH ADMIN</title>
    <link rel="stylesheet" href="../css/style-start-admin.css">
</head>


    <main>
        <div class="container container_start-admin d-flex justify-content-center align-items-center shadow" style="height: 300px;">
            <div class="text-center">
                <?php if(!empty($user)): ?>
                    <?php if ($user['super_admin']): ?>
                        <h1 class="font-weight-bold title">Bienvenid@, Super-Admin</h1>
                        <h2 class="subtitle"><?= $user['nombre'] ?> <?= $user['apellido'] ?></h2>
                        <hr class="my-2">
                    <?php elseif ($user['administrador']): ?>
                        <h1 class="font-weight-bold title">Bienvenid@, Administrador</h1>
                        <h2 class="subtitle"><?= $user['nombre'] ?> <?= $user['apellido'] ?></h2>
                        <hr class="my-2">
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>

</body>
</html>