<?php include("../template/header.php")?>
<head>
    <title>Gestión Usuarios Admin | NOVATH ADMIN</title>
</head>


    <br><br><br><br>

    <main>
        <h1 class="titulo-pagina text-center">ADMINISTRADORES</h1>
        <div class="container">
            <div class="row">
                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="grupo-saltos">
                        <br><br><br>
                    </div>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="fila-tabla" scope="col">ID</th>
                                <th class="fila-tabla" scope="col">Nombre</th>
                                <th class="fila-tabla" scope="col">Apellido</th>
                                <th class="fila-tabla" scope="col">DNI</th>
                                <th class="fila-tabla" scope="col">Fecha de Nacimiento</th>
                                <th class="fila-tabla" scope="col">Dirección</th>
                                <th class="fila-tabla" scope="col">Teléfono</th>
                                <th class="fila-tabla" scope="col">Email</th>
                                <th class="fila-tabla" scope="col">Contraseña</th>
                                <th class="fila-tabla" scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="filas-siguientes">1</td>
                                <td class="filas-siguientes">ejemplo</td>
                                <td class="filas-siguientes">ejemplo</td>
                                <td class="filas-siguientes">ejemplo</td>
                                <td class="filas-siguientes">ejemplo</td>
                                <td class="filas-siguientes">ejemplo</td>
                                <td class="filas-siguientes">ejemplo</td>
                                <td class="filas-siguientes">ejemplo</td>
                                <td class="filas-siguientes">ejemplo</td>
                                <td class="filas-siguientes text-center">
                                    <form method="POST">
                                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $evento['id_evento'] ?>">
                                        <input type="submit" name="accion" value="Borrar Cuenta" class="boton-card-eventos btn btn-outline-dark">
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


</body>
</html>