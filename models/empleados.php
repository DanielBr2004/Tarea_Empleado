
<?php

require'conexion.php';

class Empleado extends Conexion{

    private $pdo;

    public function __CONSTRUCT()
    {
        $this->pdo=parent::getConexion();
    }

    public function add($data=[]){

        try{
            $consulta=$this->pdo->prepare("CALL spu_empleados_registrar(?,?,?,?,?,?)");
            $consulta->execute(
                array(
                    $data['idsede'],
                    $data['apellidos'],
                    $data['nombres'],
                    $data['ndocumentos'],
                    $data['fechaNac'],
                    $data['telefono']
                )
            );

            return $consulta->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function search($data = [])
    {
        try{
            $consulta=$this->pdo->prepare("CALL spu_empleados_listar(?)");
            $consulta->execute(
                array($data['ndocumentos'])
            );

            return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
        {

        }
    }

}
/*
$emplado = new Empleado();
$registro=$emplado->search(["ndocumentos"=>"76363997"]);
var_dump($registro);
*/

?>

