<!doctype html>
<html lang="en">
    <head>
        <title>Busca Empleado</title>
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
            <span class="text-light"><h1><center>BUSCAR EMPLEADOS</center></h1></span>
            <br>
            </div>
        </div>
            <div class="card-body">
            <hr>
            <form action="" method="POST" id="formbusqueda" autocomplete="off">
                <div class="input-group mb-2">
                    <div class="input-group">
                        <input type="text" maxlength="8" name="sede" id="ndocumentos" class="form-control" placeholder="Buscar Persona">
                        <br>
                        <button type="button" class="btn btn-success" name="buscar" id="buscar">Buscar</button>
                        <br>
                        <hr>
                    </div>
                        <small id="status">No hay busquedas activas</small>
                </div>
                <hr>
                <div class="mb-3">
                    <label for="">ID:</label>
                    <input type="text" name="idempleado" id="idempleado" class="form-control" disabled>
                </div>

                <div class="mb-3">
                    <label for="">Sede:</label>
                    <input type="text" name="sede" id="sede" class="form-control" disabled>
                </div>

                <div class="mb-3">
                    <label for="">Apellidos:</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" disabled>
                </div>
                
                <div class="mb-3">
                    <label for="">Nombres:</label>
                    <input type="text" name="nombres" id="nombres" class="form-control" disabled>
                </div>
                
                <div class="mb-3">
                    <label for="">Fecha Nacimiento:</label>
                    <input type="text" name="fechaNac" id="fechaNac" class="form-control" disabled>
                </div>
                
                <div class="mb-3">
                    <label for="">Telefono:</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" disabled>
                </div>
                <br>
                <hr>
                <br>
                <div class="mb-3 text-end">
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

        function BuscarDNI(){
            const ndocumentos =$("#ndocumentos").value

            if(ndocumentos !=""){
                const parameters = new FormData()

                parameters.append("operacion","search")
                parameters.append("ndocumentos",ndocumentos)
                $("#status").innerHTML="Buscando por favor espere...."
                fetch(`../controllers/Empleado.controller.php`,{
                    method:"POST",
                    body: parameters,

                })
                    .then(respuesta => respuesta.json())
                    .then(datos=>{

                        if(!datos){
                            $("#status").innerHTML="No se encontro la persona"
                            $("#formbusqueda").reset()
                            $("#ndocumentos").focus()
                        }else{
                            $("#status").innerHTML="Persona encontrada"
                            $("#idempleado").value=datos.idempleado
                            $("#sede").value=datos.sede
                            $("#apellidos").value=datos.apellidos
                            $("#nombres").value=datos.nombres
                            $("#ndocumentos").value=datos.ndocumentos
                            $("#fechaNac").value=datos.fechaNac
                            $("#telefono").value=datos.telefono
                        }
                    })
                    .catch(e=> {
                        console.error(e)
                    })

            }
        }
        $("#ndocumentos").addEventListener("Keypress",(event)=>{
            if(event.keyCode ==13){
                BuscarDNI()
            }
        })

        $("#buscar").addEventListener("click", BuscarDNI)
    })
</script>

</body>
</html>
