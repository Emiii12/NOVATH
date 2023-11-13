<?php
session_start();

function verificarSesion($conexion) {
    if (isset($_SESSION['user_id'])) {
        $sentenciaSQL = $conexion->prepare("SELECT id, email, contrasena, nombre, apellido, administrador, super_admin FROM usuario WHERE id=:id AND (super_admin='1' OR administrador='1')");
        $sentenciaSQL->bindParam(':id', $_SESSION['user_id']);
        $sentenciaSQL->execute();
        $cuenta = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

        if ($cuenta !== false && count($cuenta) > 0) {
            return $cuenta;
        } else {
            echo '
                <script>
                    alert("No tienes los permisos necesarios. Vuelve a iniciar sesión.");
                    window.location = "../index.php";
                </script>
            ';
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
        die();
    }
}
?>

