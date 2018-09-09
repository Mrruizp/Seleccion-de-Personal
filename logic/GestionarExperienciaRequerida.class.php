<?php

require_once '../data/Conexion.class.php';

class GestionarExperienciaRequerida extends Conexion {

    private $codigo_puesto_laboral;
    private $codigo_experiencia_requerida;
    private $experiencia_requerida;
    private $duracion;

    public function getCodigo_puesto_laboral() {
        return $this->codigo_puesto_laboral;
    }

    public function getCodigo_experiencia_requerida() {
        return $this->codigo_experiencia_requerida;
    }

    public function getExperiencia_requerida() {
        return $this->experiencia_requerida;
    }

    public function getDuracion() {
        return $this->duracion;
    }

    public function setCodigo_puesto_laboral($codigo_puesto_laboral) {
        $this->codigo_puesto_laboral = $codigo_puesto_laboral;
    }

    public function setCodigo_experiencia_requerida($codigo_experiencia_requerida) {
        $this->codigo_experiencia_requerida = $codigo_experiencia_requerida;
    }

    public function setExperiencia_requerida($experiencia_requerida) {
        $this->experiencia_requerida = $experiencia_requerida;
    }

    public function setDuracion($duracion) {
        $this->duracion = $duracion;
    }

    public function listar() {
        try {
            $sql = "
                    SELECT 
                        codigo_experiencia_requerida, 
                        experiencia_requerida, 
                        duracion, 
                        codigo_puesto_laboral
                    FROM experiencia_requerida
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

    public function agregar() {
        $this->dblink->beginTransaction();

        try {
            $sql = "select * from f_generar_correlativo('experiencia_requerida') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigo_experiencia_requerida($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                    insert into experiencia_requerida(
                                                    codigo_experiencia_requerida,
                                                    experiencia_requerida,
                                                    duracion,
                                                    codigo_puesto_laboral
                                                    ) 
                    values(:p_cod_req, :p_nomb_req, :p_dur, :p_codigo_puesto)
                    ";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cod_req", $this->getCodigo_experiencia_requerida());
                $sentencia->bindParam(":p_nomb_req", $this->getExperiencia_requerida());
                $sentencia->bindParam(":p_dur", $this->getDuracion());
                $sentencia->bindParam(":p_codigo_puesto", $this->getCodigo_puesto_laboral());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='experiencia_requerida'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla experiencia_requerida");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function leerDatos($p_codigoExpReq) {
        try {
            $sql = "
                    select * from experiencia_requerida 
                    where codigo_experiencia_requerida = :p_cod_req
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_req", $p_codigoExpReq);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function editar() {
        try {
            $sql = "
                UPDATE 
                    experiencia_requerida
                SET 
                    experiencia_requerida = :p_nomb_req, 
                    duracion = :p_dur, 
                    codigo_puesto_laboral = :p_codigo_puesto
                where
                    codigo_experiencia_requerida = :p_cod_req
                ";
            $sentencia = $this->dblink->prepare($sql);

            $sentencia->bindParam(":p_nomb_req", $this->getExperiencia_requerida());
            $sentencia->bindParam(":p_dur", $this->getDuracion());
            $sentencia->bindParam(":p_codigo_puesto", $this->getCodigo_puesto_laboral());
            $sentencia->bindParam(":p_cod_req", $this->getCodigo_experiencia_requerida());
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
                    experiencia_requerida 
                where
                    codigo_experiencia_requerida = :p_cod_req
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_req", $this->getCodigo_experiencia_requerida());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
