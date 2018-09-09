<?php

require_once '../data/Conexion.class.php';

class Reporte_resultadosFinales extends Conexion {

    public function listar($codPrueba) {
        try {
            $sql = "
                    select
                            c.doc_id,
                            nombre,
                            apellidos
                    from
                            candidato c inner join promedio_prueba p 
                    on
                            (p.doc_id = c.doc_id)inner join prueba r
                    on
                            (p.codigo_prueba = r.codigo_prueba)inner join puesto_laboral l
                    on
                            (r.codigo_puesto_laboral = l.codigo_puesto_laboral)
                    where
                            p.estado_promedio = 'Correcto' and
                            l.codigo_puesto_laboral = :p_cod_puest
                    order by 
                            1;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_puest", $codPrueba);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}
