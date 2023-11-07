<?php include("../template/header.php")?>
<head>
    <title>Agregar Evento | NOVATH ADMIN</title>
    <link rel="stylesheet" href="../css/style-manage-event.css">
</head>

    <br><br><br>

    <main>
        <h1 class="title-page text-center m-4">EVENTOS</h1>
        <div class="container">
            <div class="row">

                <div class="col col-12">

                    <div class="d-flex flex-column mb-3">
                        <a class="button-accordion btn w-100 mb-3" data-bs-toggle="collapse" href="#collapseLink" role="button" aria-expanded="false" aria-controls="collapseLink">Agregar eventos</a>
                        <div class="collapse" id="collapseLink">
                            <div class="card card-form">
                                <div class="card-header text-center">
                                    DATOS DEL EVENTO
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-row d-flex d-grid gap-3 p-1 mb-4">
                                            <div class="form-group col-xl-6 col-md-6">
                                                <label for="txtID">ID</label>
                                                <input type="text" class="form-control" name="txtID" id="txtID" value="" required readonly>
                                            </div>
                                            <div class="form-group col-xl-6 col-md-6">
                                                <label for="txtNombreEvento">Evento</label>
                                                <input type="text" class="form-control" value="" name="txtNombreEvento" id="txtNombreEvento" placeholder="Nombre del evento" required>
                                            </div>
                                        </div>
                                        <div class="form-row d-flex d-grid gap-3 mb-4">
                                            <div class="form-group col-xl-6 col-md-6">
                                                <label for="txtNombreArtista">Artista</label>
                                                <input type="text" class="form-control" value="" name="txtNombreArtista" id="txtNombreArtista" placeholder="Nombre del artista" required>
                                            </div>
                                            <div class="form-group col-xl-6 col-md-6">
                                                <label for="txtDescripcion">Descripcion</label>
                                                <textarea class="form-control" name="txtDescripcion" id="txtDescripcion" rows="1" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row d-flex d-grid gap-1 mb-4">
                                            <div class="form-group col-xl-3 col-md-3">
                                                <label for="txtFechaEvento">Fecha</label>
                                                <input type="date" class="form-control w-100" value="" name="txtFechaEvento" id="txtFechaEvento" placeholder="Fecha del evento" required>
                                            </div>
                                            <div class="form-group col-xl-3 col-md-3">
                                                <label for="txtHoraEvento">Horario</label>
                                                <input type="time" class="form-control w-100" value="" name="txtHoraEvento" id="txtHoraEvento" placeholder="Hora del evento" required>
                                            </div>
                                            <div class="form-group col-xl-3 col-md-3">
                                                <label for="txtEntrada">Entradas En Venta</label>
                                                <input type="text" class="form-control" value="" name="txtEntrada" id="txtEntrada" placeholder="Cantidad de entradas" required>
                                            </div>
                                            <div class="form-group col-xl-3 col-md-3">
                                                <label for="txtPrecio">Precio</label>
                                                <input type="text" class="form-control" value="" name="txtPrecio" id="txtPrecio" placeholder="Precio de entradas" required>
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="txtImgEvento">Imagen</label>
                                                <img src="../../img/#" width="50">
                                            <input type="file" class="form-control form-file" name="txtImgEvento" id="txtImgEvento">
                                        </div>
                                        
                                        <div id="grupo-button" class="buttons-form d-grid gap-2 d-flex" role="group" aria-label="">
                                            <button type="submit" name="accion" value="Agregar" class="button-card btn  w-50">Agregar</button>
                                            <button type="submit" name="accion" value="Modificar" class="button-card btn  w-50">Modificar</button>
                                            <button type="submit" name="accion" value="Cancelar" class="button-card btn  w-50">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <a class="button-accordion btn w-100" data-bs-toggle="collapse" href="#collapseBusqueda" role="button" aria-expanded="false" aria-controls="collapseBusqueda">Buscar o Filtrar</a>
                        <div class="collapse" id="collapseBusqueda">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="class-title">Buscador</h4>
                                    <form id="form2" name="form2" method="POST" action="">
                                        <div class="row col-xl-12">
                                        <div class="mb-3">
                                                <div class="form-group col-12 mb-3">
                                                    <label for="txtBuscar">Evento y/o artista a buscar</label>
                                                    <input type="text" class="form-control" name="txtBuscar" id="txtBuscar">
                                                </div>
                                                <h4 class="card-title">Filtro de búsqueda</h4>
                                                <div class="col-12 d-flex d-grid gap-2 mb-3">
                                                    <div class="form-group flex-grow-1">
                                                        <label for="txtPrecioDesde">Precio desde:</label>
                                                        <input type="number" class="form-control" id="txtPrecioDesde" name="txtPrecioDesde" value="">
                                                    </div>
                                                    <div class="form-group flex-grow-1">
                                                        <label for="txtPrecioHasta">Precio hasta:</label>
                                                        <input type="number" class="form-control" id="txtPrecioHasta" name="txtPrecioHasta" value="">
                                                    </div>
                                                    <div class="form-group flex-grow-1">
                                                        <label for="txtFiltrarFecha">Fecha:</label>
                                                        <input type="date" class="form-control" id="txtFiltrarFecha" name="txtFiltrarFecha" value="">
                                                    </div>
                                                </div>
                                                <h4 class="card-title">Ordenar por:</h4>
                                                <div class="d-flex justify-between col-12 mb-3">
                                                    <div class="form-group col-12">
                                                        Selecciona el orden
                                                        <select class="form-control" name="orden" id="orden" id="assigned-tutor-filter">
                                                            <option value="Elije un orden"></option>
                                                            <option value="1">Ordenar por nombre</option>
                                                            <option value="2">Ordenar por artista</option>
                                                            <option value="3">Ordenar por precio de menor a mayor</option>
                                                            <option value="4">Ordenar por precio de mayor a menor</option>
                                                            <option value="5">Ordenar por fecha de antiguo</option>
                                                            <option value="6">Ordenar por fecha de antiguo</option>
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
                    
                    

                    <!-- BÚSQUEDA Y FILTROS -->
                    
                    <br>
                    <table class="table table-general">
                        <thead class="thead-light">
                            <tr>
                                <th class="row-table" scope="col">ID</th>
                                <th class="row-table" scope="col">Artista</th>
                                <th class="row-table" scope="col">Nombre</th>
                                <th class="row-table" scope="col">Fecha</th>
                                <th class="row-table" scope="col">Hora</th>
                                <th class="row-table" scope="col">Entradas</th>
                                <th class="row-table" scope="col">Imagen</th>
                                <th class="row-table" scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="rows-next" data-titulo="ID: ">1</td>
                                <td class="rows-next" data-titulo="ARTISTA: ">LOS INCOMPARABLES VOLUMEN 2 DESDE MAYO AAAA</td>
                                <td class="rows-next" data-titulo="EVENTO: ">ejemplo</td>
                                <td class="rows-next" data-titulo="FECHA: ">ejemplo</td>
                                <td class="rows-next" data-titulo="HORA: ">ejemplo</td>
                                <td class="rows-next" data-titulo="ENTRADAS: ">ejemplo</td>
                                <td class="rows-next" data-titulo="IMAGEN: ">
                                    <img src="../../img/#" width="50">
                                </td>
                                <td class="buttons-table-group rows-next text-center">
                                    <form method="POST">
                                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $evento['id_evento'] ?>">
                                        <input type="submit" name="accion" value="Seleccionar" class="button-table btn ">
                                        <input type="submit" name="accion" value="Borrar" class="button-table btn ">
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <script>
        const botones = document.querySelectorAll('.button-accordion');

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
    </script>

<!--
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("seccion-filtro-busqueda").classList.remove("show");
        });
    </script>
    -->
</body>
</html>