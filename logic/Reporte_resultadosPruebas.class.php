<?php

require_once '../data/Conexion.class.php';

class Reporte_resultadosPruebas extends Conexion {

    public function listar($cod_prueba) {
        try {
            $sql = "
                    select 
                        codigo_prueba,
                        nombre_prueba
                    from 
                        prueba
                    where 
                        codigo_puesto_laboral = :p_cod_puest 
                    order by 
                            1
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_puest", $cod_prueba);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    public function aprobados($p_cod_prueba) {
        try {
            $sql = "
                    select 
                        p.codigo_promedio_prueba,
                        c.doc_id,
                        c.nombre,
                        c.apellidos
                    from 
                        candidato c inner join promedio_prueba p
                    on
                        (c.doc_id = p.doc_id)
                    where 
                        p.codigo_prueba = :p_cod_prueba and
                        estado_promedio = 'Correcto'
                    order by 
                            1
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_prueba", $p_cod_prueba);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
