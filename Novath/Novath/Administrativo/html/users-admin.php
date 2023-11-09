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
                    <div class="d-flex flex-column mb-3">
                        <a class="button-accordion btn w-100" data-bs-toggle="collapse" href="#collapseBusqueda" role="button" aria-expanded="false" aria-controls="collapseBusqueda">Buscar o Filtrar</a>
                        <div class="collapse" id="collapseBusqueda">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="class-title">Buscador</h4>
                                    <form id="form2" name="form2" method="POST" action="">
                                        <div class="row col-xl-12">
                                            <div class="mb-3">
                                                <div class="form-group col-12 mb-3">
                                                    <label for="txtBuscar">Buscar por nombre, apellido, email...</label>
                                                    <input type="text" class="form-control" name="txtBuscar" id="txtBuscar">
                                                </div>
                                                <h4 class="card-title">Ordenar por:</h4>
                                                <div class="d-flex justify-between col-12 mb-3">
                                                    <div class="form-group col-12">
                                                        Selecciona el orden
                                                        <select class="form-control" name="orden" id="orden" id="assigned-tutor-filter">
                                                            <option value="Elije un orden"></option>
                                                            <option value="1">Ordenar por nombre</option>
                                                            <option value="2">Ordenar por apellido</option>
                                                            <option value="3">Ordenar por DNI</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="container-button-filter d-flex justify-content-end">
                                                    <input type="submit" class="button-card btn" value="Ver">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>


                    
                    <table class="table table-general">
                        <thead class="thead-light">
                            <tr>
                                <th class="row-table" scope="col">ID</th>
                                <th class="row-table" scope="col">Nombre</th>
                                <th class="row-table" scope="col">Apellido</th>
                                <th class="row-table" scope="col">DNI</th>
                                <th class="row-table" scope="col">Fecha de Nacimiento</th>
                                <th class="row-table" scope="col">Dirección</th>
                                <th class="row-table" scope="col">Teléfono</th>
                                <th class="row-table" scope="col">Email</th>
                                <th class="row-table" scope="col">Contraseña</th>
                                <th class="row-table" scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="rows-next">1</td>
                                <td class="rows-next">ejemplo</td>
                                <td class="rows-next">ejemplo</td>
                                <td class="rows-next">ejemplo</td>
                                <td class="rows-next">ejemplo</td>
                                <td class="rows-next">ejemplo</td>
                                <td class="rows-next">ejemplo</td>
                                <td class="rows-next">ejemplo</td>
                                <td class="rows-next">ejemplo</td>
                                <td class="buttons-table-group rows-next text-center">
                                    <form method="POST">
                                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $evento['id_evento'] ?>">
                                        <input type="submit" name="accion" value="Borrar Cuenta" class="button-table btn">
                                    </form>
                                </td>
                            </tr>
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
