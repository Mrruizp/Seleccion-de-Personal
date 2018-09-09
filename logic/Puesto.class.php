<?php

require_once '../data/Conexion.class.php';

class Puesto extends Conexion {

    public function leerDatos($p_codigoPuesto) {
//        codigo_cronograma,
//                        fecha_cronograma, 
//                        codigo_etapa,
//                        codigo_convocatoria
        try {
            $sql = "
                    select 
                            codigo_puesto_laboral,
                            nombre_puesto,
                            tipo_jornada,
                            sueldo
                    from
                            puesto_laboral
                    where
                            codigo_convocatoria = :p_cod_pues
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

    public function editar() {
        try {
            $sql = "
                update 
                    laboratorio 
                set 
                    nombre = :p_nom_lab,
                    codigo_pais = :p_cod_pais
                where
                    codigo_laboratorio = :p_cod_lab
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_nom_lab", $this->getNombre());
            $sentencia->bindParam(":p_cod_pais", $this->getCodigoPais());
            $sentencia->bindParam(":p_cod_lab", $this->getCodigoLaboratorio());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

    public function eliminar() {
        try {
            $sql = "
                delete from 
                    laboratorio 
                where
                    codigo_laboratorio = :p_cod_lab
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_lab", $this->getCodigoLaboratorio());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

    public function cargarDatos() {
        try {
            $sql = "select 
                            p.codigo_puesto_laboral
                    from 
                            puesto_laboral p inner join convocatoria c
                    on
                            (p.codigo_convocatoria = c.codigo_convocatoria)
                    where 
                            c.estado = 'VIGENTE' or
                            c.estado = 'NO PUBLICADO'";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
