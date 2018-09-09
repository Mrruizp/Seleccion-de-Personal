<?php

require_once '../data/Conexion.class.php';

class Convocatoria extends Conexion {
    private $codigoPais;
    
    public function getCodigoPais() {
        return $this->codigoPais;
    }

    public function setCodigoPais($codigoPais) {
        $this->codigoPais = $codigoPais;
    }

    
    public function cargarDatos() {
        try {
            $sql = "select 
                        * 
                    from 
                        convocatoria 
                    where 
                        estado = 'VIGENTE' or 
                        estado = 'NO PUBLICADO'
                    order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    
}
