<?php 

include("../php/conexion.php");
include('../php/verificarSesion.php');
$user = verificarSesion($conexion);

$txtID = !empty($_POST['txtID']) ? $_POST['txtID'] : "";
$accion = !empty($_POST['accion']) ? $_POST['accion'] : "";

if($accion == "Borrar") {
    $sentenciaSQL=$conexion->prepare("DELETE FROM usuario WHERE id=:id");
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
}

$sentenciaSQL = $conexion->prepare(" SELECT id, nombre, apellido, dni, email, telefono FROM usuario WHERE administrador='1'");

$sentenciaSQL->execute();
$listaUsusario = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../template/header.php")?>
<head>
    <title>Gestión Usuarios Admin | NOVATH ADMIN</title>
    <link rel="stylesheet" href="../css/style-user-admin.css">
</head>

    <br><br><br>

    <main>
        <h1 class="title-page text-center m-4">ADMINISTRADORES</h1>
        <div class="container">
            <div class="row">
                <div class="col col-12">
                    <table class="table table-general">
                        <thead class="thead-light">
                            <tr>
                                <th class="row-table" scope="col">ID</th>
                                <th class="row-table" scope="col">Nombre</th>
                                <th class="row-table" scope="col">Apellido</th>
                                <th class="row-table" scope="col">DNI</th>
                                <th class="row-table" scope="col">Teléfono</th>
                                <th class="row-table" scope="col">Email</th>
                                <th class="row-table" scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listaUsusario as $usuario) { ?>
                            <tr>
                                <td class="rows-next" data-titulo="ID: "><?php echo $usuario['id'] ?></td>
                                <td class="rows-next" data-titulo="NOMBRE: "><?php echo $usuario['nombre'] ?></td>
                                <td class="rows-next" data-titulo="APELLIDO: "><?php echo $usuario['apellido'] ?></td>
                                <td class="rows-next" data-titulo="DNI: "><?php echo $usuario['dni'] ?></td>
                                <td class="rows-next" data-titulo="TELÉFONO: "><?php echo $usuario['telefono'] ?></td>
                                <td class="rows-next" data-titulo="EMAIL: "><?php echo $usuario['email'] ?></td>
                                <td class="buttons-table-group rows-next text-center">
                                    <form method="POST">
                                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $usuario['id'] ?>">
                                        <input type="submit" name="accion" value="Borrar" class="button-table btn">
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

<!-- 
    <script>
        const botones = document.querySelectorAll('.boton-filter-event');

        botones.forEach((boton) => {
            boton.addEventListener('click', () => {
                // Ocultar todos los colapsos
                const colapsos = document.querySelectorAll('.collapse');
                colapsos.forEach((colapso) => {
                    colapso.classList.remove('show');
                });

                // Mostrar el colapso asociado al botón actual
                const targetId = boton.getAttribute('data-target').substring(1); // Eliminar el "#" del ID
                const targetColapso = document.getElementById(targetId);
                targetColapso.classList.add('show');
            });
        });
    </script> -->

<!--
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("seccion-filtro-busqueda").classList.remove("show");
        });
    </script>
    -->
</body>
</html>
