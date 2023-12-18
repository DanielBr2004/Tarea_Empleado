<?php

require_once '../models/sedes.php';


if(isset($_GET['operacion'])){

    $sede = new Sedes();
    if($_GET['operacion']=='listar'){
        $resultado = $sede->getAll();
        echo json_encode($resultado);
    }
}
?>