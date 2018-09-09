<?php

require_once '../data/Conexion.class.php';

class reporte_resultadoCurriculo_candidatos extends Conexion {
    
    public function listar($p_codigoPuesto){
        try {
            $sql = "
                    select
                        doc_id,
                        nombre,
                        fecha_postulacion,
                        estado
                    from
                        postulacion
                    where
                        codigo_puesto_laboral = :p_cod_puest
                    order by 
                            3
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_puest", $p_codigoPuesto);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}
