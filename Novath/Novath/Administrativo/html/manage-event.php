<?php include("../template/header.php")?>
<head>
    <title>Agregar Evento | NOVATH ADMIN</title>
    <link rel="stylesheet" href="../css/style-manage-event.css">
</head>

    <br><br><br><br>

    <main>
        <h1 class="titulo-pagina text-center">EVENTOS</h1>
        <div class="container">
            <div class="row">
                <!-- <div class="col col-xl-4 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header text-center">
                            DATOS DEL EVENTO
                        </div>
                        <div class="card-body card-body-form">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="txtID">ID</label>
                                    <input type="text" class="form-control" name="txtID" id="txtID" value="" required readonly>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtNombreArtista">Artista</label>
                                    <input type="text" class="form-control" value="" name="txtNombreArtista" id="txtNombreArtista" placeholder="Nombre del artista" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtNombreEvento">Evento</label>
                                    <input type="text" class="form-control" value="" name="txtNombreEvento" id="txtNombreEvento" placeholder="Nombre del evento" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtFechaEvento">Fecha</label>
                                    <input type="date" class="form-control" value="" name="txtFechaEvento" id="txtFechaEvento" placeholder="Fecha del evento" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtHoraEvento">Horario</label>
                                    <input type="time" class="form-control" value="" name="txtHoraEvento" id="txtHoraEvento" placeholder="Hora del evento"  required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtDescripcion">Descripcion</label>
                                    <textarea class="form-control" name="txtDescripcion" id="txtDescripcion" rows="3" required></textarea>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtEntrada">Entradas En Venta</label>
                                    <input type="text" class="form-control" value="" name="txtEntrada" id="txtEntrada" placeholder="Cantidad de entradas" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtPrecio">Precio</label>
                                    <input type="text" class="form-control" value="" name="txtPrecio" id="txtPrecio" placeholder="Precio de entradas" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtImgEvento">Imagen</label>
                                    <br/>
                                        <img src="../../img/#" width="50">
                                    <input type="file" class="form-control form-file" name="txtImgEvento" id="txtImgEvento">
                                </div>
                                <br>
                                <div id="grupo-boton" class="botones d-grid gap-2 d-flex" role="group" aria-label="">
                                    <button type="submit" name="accion" value="Agregar" class="boton-card-eventos btn  w-50">Agregar</button>
                                    <button type="submit" name="accion" value="Modificar" class="boton-card-eventos btn  w-50">Modificar</button>
                                    <button type="submit" name="accion" value="Cancelar" class="boton-card-eventos btn  w-50">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
    
                <div class="grupo-saltos">
                    <br><br><br>
                </div>

                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12">

                    <div class="d-flex flex-column gap-3">
                        <a class="boton-filtro-evento btn w-100" data-bs-toggle="collapse" href="#collapseLink" role="button" aria-expanded="false" aria-controls="collapseLink">Agregar eventos</a>
                        <div class="collapse" id="collapseLink">
                            <div class="card">
                                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-header text-center">
                                        DATOS DEL EVENTO
                                    </div>
                                    <div class="card-body card-body-form">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="d-flex justify-between p-1">
                                                <div class="row g-3 me-1 w-50">
                                                    <div class="form-group">
                                                        <label for="txtID">ID</label>
                                                        <input type="text" class="form-control" name="txtID" id="txtID" value="" required readonly>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label for="txtNombreArtista">Artista</label>
                                                        <input type="text" class="form-control" value="" name="txtNombreArtista" id="txtNombreArtista" placeholder="Nombre del artista" required>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label for="txtNombreEvento">Evento</label>
                                                        <input type="text" class="form-control" value="" name="txtNombreEvento" id="txtNombreEvento" placeholder="Nombre del evento" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="txtDescripcion">Descripcion</label>
                                                        <textarea class="form-control" name="txtDescripcion" id="txtDescripcion" rows="1" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="row g-3 ms-1 w-50">
                                                    <div class="d-flex justify-between d-grid gap-2">
                                                        <div class="form-group w-50 mb-3">
                                                            <label for="txtFechaEvento">Fecha</label>
                                                            <input type="date" class="form-control w-100" value="" name="txtFechaEvento" id="txtFechaEvento" placeholder="Fecha del evento" required>
                                                        </div>
                                                        <div class="form-group w-50 mb-3">
                                                            <label for="txtHoraEvento">Horario</label>
                                                            <input type="time" class="form-control w-100" value="" name="txtHoraEvento" id="txtHoraEvento" placeholder="Hora del evento" required>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label for="txtEntrada">Entradas En Venta</label>
                                                        <input type="text" class="form-control" value="" name="txtEntrada" id="txtEntrada" placeholder="Cantidad de entradas" required>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label for="txtPrecio">Precio</label>
                                                        <input type="text" class="form-control" value="" name="txtPrecio" id="txtPrecio" placeholder="Precio de entradas" required>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label for="txtImgEvento">Imagen</label>
                                                            <img src="../../img/#" width="50">
                                                        <input type="file" class="form-control form-file" name="txtImgEvento" id="txtImgEvento">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="grupo-boton" class="botones d-grid gap-2 d-flex" role="group" aria-label="">
                                                <button type="submit" name="accion" value="Agregar" class="boton-card-eventos btn  w-50">Agregar</button>
                                                <button type="submit" name="accion" value="Modificar" class="boton-card-eventos btn  w-50">Modificar</button>
                                                <button type="submit" name="accion" value="Cancelar" class="boton-card-eventos btn  w-50">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="boton-filtro-evento btn w-100" data-bs-toggle="collapse" href="#collapseBusqueda" role="button" aria-expanded="false" aria-controls="collapseBusqueda">
                            Buscar o Filtrar
                        </a>
                        <div class="collapse" id="collapseBusqueda">
                            <div class="card card-body">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita quas libero possimus corrupti delectus mollitia magni, totam excepturi enim obcaecati animi, dolorum sunt officia, optio nam vitae natus laboriosam nihil.
                            </div>
                        </div>
                    </div>
                    
                    

                    <!-- BÚSQUEDA Y FILTROS -->
                    
                    <br>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="fila-tabla" scope="col">ID</th>
                                <th class="fila-tabla" scope="col">Artista</th>
                                <th class="fila-tabla" scope="col">Nombre</th>
                                <th class="fila-tabla" scope="col">Fecha</th>
                                <th class="fila-tabla" scope="col">Hora</th>
                                <th class="fila-tabla" scope="col">Entradas</th>
                                <th class="fila-tabla" scope="col">Imagen</th>
                                <th class="fila-tabla" scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="filas-siguientes" data-titulo="ID: ">1</td>
                                <td class="filas-siguientes" data-titulo="ARTISTA: ">LOS INCOMPARABLES VOLUMEN 2 DESDE MAYO AAAA</td>
                                <td class="filas-siguientes" data-titulo="EVENTO: ">ejemplo</td>
                                <td class="filas-siguientes" data-titulo="FECHA: ">ejemplo</td>
                                <td class="filas-siguientes" data-titulo="HORA: ">ejemplo</td>
                                <td class="filas-siguientes" data-titulo="ENTRADAS: ">ejemplo</td>
                                <td class="filas-siguientes" data-titulo="IMAGEN: ">
                                    <img src="../../img/#" width="50">
                                </td>
                                <td class="botones-tabla filas-siguientes text-center">
                                    <form method="POST">
                                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $evento['id_evento'] ?>">
                                        <input type="submit" name="accion" value="Seleccionar" class="boton-card-eventos btn ">
                                        <input type="submit" name="accion" value="Borrar" class="boton-card-eventos btn ">
                                        <a href="detalle-evento.html" class="boton-card-eventos btn ">Ver</a>
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
        const botones = document.querySelectorAll('.boton-filtro-evento');

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