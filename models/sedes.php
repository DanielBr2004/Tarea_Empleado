<?php
require 'conexion.php';

class Sedes extends Conexion{

    private $pdo;

    public function __CONSTRUCT()
    {
        $this->pdo=parent::getConexion();
    }

    public function getAll()
    {
        try
        {
            $consulta=$this->pdo->prepare("CALL spu_sedes_listar()");
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $e){
            die($e->getMessage());
        }
        {

        }
    }
}


?>