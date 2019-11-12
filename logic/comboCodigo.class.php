<?php

require_once '../data/Conexion.class.php';

class comboCodigo extends Conexion {
    private $codigoPuesto;
    private $codigoFormacion;
    
    public function getCodigoPuesto() {
        return $this->codigoPuesto;
    }

    public function getCodigoFormacion() {
        return $this->codigoFormacion;
    }

    public function setCodigoPuesto($codigoPuesto) {
        $this->codigoPuesto = $codigoPuesto;
    }

    public function setCodigoFormacion($codigoFormacion) {
        $this->codigoFormacion = $codigoFormacion;
    }

    
    public function cargarDatos_CodigoPuesto() {
        try {
            $sql = "select 
                        codigo_puesto_laboral
                    from 
                        puesto_laboral 
                    order by 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function cargarDatos_CodigoFormacionLaboral() {
        try {
            $sql = "select 
                        codigo_formacion_laboral,
                        nombre_formacion_laboral
                    from 
                        formacion_laboral 
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
