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
                    <span class="text-light"><h1><center>REGISTRO DE EMPLEADOS</center></h1></span>
                    <br>
                </div>
                <div class="card-body">
                    <form action="" method="POST" id="formRegistroEmpleado" >
                        <div class="mb-3">
                            <label for=""clas="form-label">Sede:</label>
                                <br>
                            <select select name="" id="sede" class="form-control" required>
                                <option value="">Selecicione ....</option>
                            </select>
                        </div>
                            <hr>
                        <div class="mb-3">
                            <label for=""clas="form-label">Apellidos:</label>
                            <input type="text" id="apellidos" class="form-control" required >
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for=""clas="form-label">Nombres:</label>
                            <input type="text" id="nombres" class="form-control" required >
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for=""clas="form-label">DNI:</label>
                            <input type="text" id="ndocumentos" class="form-control" required >
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for=""clas="form-label">Fecha Nacimiento:</label>
                            <input type="text" id="fechaNac" class="form-control" required >
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for=""clas="form-label">Telefono:</label>
                            <input type="text" id="telefono" class="form-control" required >
                        </div>
                        <hr>
                        <div class="mb-3 text-end">
                            <button type="submit" class="btn btn-primary" id="guardar">Guardar Datos</button>
                            <button type="button" class="btn btn-secondary">Cancelar</button>
                            <a href="../views/Menu_Empleado.php" class="btn btn-primary">regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded",()=>{

                function $(id){
                    return document.querySelector(id)
                }

                (function(){
                    fetch(`../controllers/sede.controller.php?operacion=listar`)
                    .then(respuesta =>respuesta.json())
                    .then(datos=>{
                        console.log(datos)
                        datos.forEach(element => {
                            const tagoption=document.createElement("option")
                            tagoption.value=element.idsede
                            tagoption.innerHTML=element.sede
                            $("#sede").appendChild(tagoption)
                        });
                    })
                    .catch(e=>{
                        console.error(e)
                    })
                })();

                $("#formRegistroEmpleado").addEventListener("submit",()=>{

                    event.preventDefault();

                    if(confirm("¿Desea Registrar a la persona?")){

                        const parameters = new FormData()

                        parameters.append("operacion","add")

                        parameters.append("idsede",$("#sede").value)
                        parameters.append("apellidos",$("#apellidos").value)
                        parameters.append("nombres",$("#nombres").value)
                        parameters.append("ndocumentos",$("#ndocumentos").value)
                        parameters.append("fechaNac",$("#fechaNac").value)
                        parameters.append("telefono",$("#telefono").value)

                        fetch(`../controllers/Empleado.controller.php`,{
                            method: "POST",
                            body: parameters
                        })
                        .then(respuesta => respuesta.json())
                        .then(datos=>{
                            if(datos.idempleado>0){
                            $("#formRegistroEmpleado").reset()
                                alert(`Vehiculo registrado con el ID:${datos.idempleado}`)
                            }
                            console.log(datos) //"que de vuelva la clave primaria"
                            alert("Proceso terminado correctamente")
                        })
                        .catch(e =>{
                            console.error(e)
                        })
                    }
                })
            });
        </script>
    </body>
</html>
