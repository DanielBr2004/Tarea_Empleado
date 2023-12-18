<?php

require_once '../models/empleados.php';

if(isset($_POST['operacion'])){
    $empleado = new Empleado();

    if($_POST['operacion']=='search'){

        $respuesta=$empleado->search(["ndocumentos"=>$_POST['ndocumentos']]);
        sleep(3);
        echo json_encode($respuesta);
        }

    if ($_POST['operacion']=='add'){

        $datosrecibidos=[
            "idsede"            =>$_POST["idsede"],
            "apellidos"         =>$_POST["apellidos"],
            "nombres"           =>$_POST["nombres"],
            "ndocumentos"       =>$_POST["ndocumentos"],
            "fechaNac"          =>$_POST["fechaNac"],
            "telefono"          =>$_POST["telefono"]
        ];
        $idobtenido= $empleado->add($datosrecibidos);
        echo json_encode($idobtenido);
    }
} 





?>