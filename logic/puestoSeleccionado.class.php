<?php

require_once '../data/Conexion.class.php';

class puestoSeleccionado extends Conexion {
    
    public function leerDatos($codigo_puesto) {
        try {
            $sql = "
                    select
                            *
                    from
                            puesto_laboral 
                    where
                            codigo_puesto_laboral = :p_puesto_id

                ";
//            $sql = "
//                    select
//                            *
//                    from
//                            puesto_laboral p inner join experiencia_requerida e
//                    on
//                        (p.codigo_puesto_laboral = e.codigo_puesto_laboral)
//                    where
//                            p.codigo_puesto_laboral = :p_puesto_id
//
//                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_puesto_id", $codigo_puesto);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
}
