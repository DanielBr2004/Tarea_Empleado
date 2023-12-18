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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </head>

    <body>

    <div class="container">
        <div class="card mt-2">
            <div class="card-header bg-primary">
                <br>
                <span class="text-light"><h1><center>ESTADISTICAS DE EMPLEADOS POR SEDE</center></h1></span>
                <br>
            </div>
            <div class="card-body">
            <div style="width: 80%; margin: auto;">
                <canvas id="graficoCiudades"></canvas>
            </div>
            <div class="mb-3 text-end">
                    <a href="../views/Menu_Empleado.php" class="btn btn-primary">regresar</a>
            </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener datos desde el servidor
            fetch('../controllers/grafico.controller.php')
            .then(response => response.json())
            .then(data => {
                // Configurar los datos para Chart.js
                var ctx = document.getElementById('graficoCiudades').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(item => item.sede),
                        datasets: [{
                            label: 'Cantidad de Personas por Ciudad',
                            data: data.map(item => item.sede),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
    </body>
</html>
