<?php

require_once '../data/Conexion.class.php';

class Serie extends Conexion {

    public function cargarDatos( $p_cod_tip ) {
        try {
            $sql = "
                    select numero_serie
                    from serie_comprobante
                    where codigo_tipo_comprobante = :p_cod_tip
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_tip", $p_cod_tip);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    
    public function obtenerNumeroComprobante($p_tip_com, $p_serie){
        try {
            $sql = "select * from f_correlativo_comprobante(:p_tip_com, :p_serie) as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_tip_com", $p_tip_com);
            $sentencia->bindParam(":p_serie", $p_serie);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
}
