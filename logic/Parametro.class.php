<?php

require_once '../data/Conexion.class.php';

class Parametro extends Conexion {
    
    public function obtenerValorParametro($p_cod_par){
        try {
            $sql = "select valor_parametro from parametro where codigo_parametro = :p_cod_par";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_par", $p_cod_par);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}
