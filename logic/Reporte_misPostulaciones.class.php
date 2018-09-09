<?php

require_once '../data/Conexion.class.php';

class Reporte_misPostulaciones extends Conexion {

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
            session_name("seleccion_personal_v2");
            session_start();
            $doc = $_SESSION["s_doc_id"];
            $sql = "
                    select
                        c.codigo_convocatoria,
                        p.codigo_puesto_laboral,
                        c.nombre_convocatoria,
                        p.nombre_puesto,
                        o.fecha_postulacion,
                        o.estado

                    from
                        puesto_laboral p inner join postulacion o
                    on
                        p.codigo_puesto_laboral = o.codigo_puesto_laboral
                        inner join convocatoria c
                    on
                        p.codigo_convocatoria = c.codigo_convocatoria
                    where
                        o.doc_id = '$doc'
                    
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
