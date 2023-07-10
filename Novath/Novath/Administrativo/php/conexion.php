<?php 
$host = "localhost";
$bd = "Novath";
$usuario = "root";
$contrasena = "";

try {
    $conexion = new PDO("mysql:host=$host;port=PUERTO;dbname=$bd", $usuario, $contrasena);
    /*
    if($conexion) { 
        echo "Conectado... a sistema";
    }
    */
    
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>