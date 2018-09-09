<?php

require_once '../data/Conexion.class.php';

class ExperienciaPuesto extends Conexion {
    
    public function leerDatos($p_codigoPuesto) {
//        codigo_cronograma,
//                        fecha_cronograma, 
//                        codigo_etapa,
//                        codigo_convocatoria
        try {
            $sql = "
                    select 
                            codigo_experiencia_requerida,
                            experiencia_requerida,
                            duracion 
                    from
                            experiencia_requerida
                    where
                            codigo_puesto_laboral = :p_cod_pues
                    order by 
                            1
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_pues", $p_codigoPuesto);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    
    


}
