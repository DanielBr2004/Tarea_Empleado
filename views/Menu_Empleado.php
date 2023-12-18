<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

<body>

    <div class="container">
    <div class="card mt-2">
    <div class="card-header bg-primary">
        <br>
        <span class="text-light"><h1><center>EMPLEADOS</center></h1></span>
        <br>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col mb-6">
            <a href="../views/Busca_Empleado.php" style="width: 100%;" class="btn btn-secondary">Buscar Empleado</a>
            </div>
            <div class="col mb-6">
            <a href="../views/Registar_Empleado.php" style="width: 100%;"  class="btn btn-secondary">Registra Empleado</a>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <?php include '../controllers/tabla.controller.php'; ?>
        </div>

    <div class="card-body">
    <div class="col mb-6">
            <a href="../views/Estadisticas_Sedes.php" style="width: 100%;"  class="btn btn-secondary">Ver Estadisticas de las sedes</a>
            </div>
    </div>
        </div>
    </div>
    </div>

    </div>

</body>
</html>
