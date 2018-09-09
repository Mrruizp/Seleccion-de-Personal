<?php

require_once '../data/Conexion.class.php';

class Reporte_resultadoCurriculo extends Conexion {

//    private $codigoLaboratorio;
//    private $nombre;
//    private $codigoPais;
//    
//    public function getCodigoPais() {
//        return $this->codigoPais;
//    }
//
//    public function setCodigoPais($codigoPais) {
//        $this->codigoPais = $codigoPais;
//    }
//
//        
//    
//    public function getCodigoLaboratorio() {
//        return $this->codigoLaboratorio;
//    }
//
//    public function getNombre() {
//        return $this->nombre;
//    }
//
//    public function setCodigoLaboratorio($codigoLaboratorio) {
//        $this->codigoLaboratorio = $codigoLaboratorio;
//    }
//
//    public function setNombre($nombre) {
//        $this->nombre = $nombre;
//    }

    public function listar() {
        try {
            $sql = "
                    select 
                            codigo_puesto_laboral,
                            nombre_convocatoria,
                            nombre_puesto,
                            estado
                    from
                            convocatoria c inner join puesto_laboral p 
                    on 
                            (c.codigo_convocatoria = p.codigo_convocatoria)
                    order by 
                            2
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
