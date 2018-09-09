<?php

require_once '../data/Conexion.class.php';

class gestionarCriterios extends Conexion {

    private $codigo_prueba;
    private $codigo_criterio;
    private $min;
    private $max;
    private $val;
    private $est;

    public function getCodigo_prueba() {
        return $this->codigo_prueba;
    }

    public function getCodigo_criterio() {
        return $this->codigo_criterio;
    }

    public function getMin() {
        return $this->min;
    }

    public function getMax() {
        return $this->max;
    }

    public function getVal() {
        return $this->val;
    }

    public function getEst() {
        return $this->est;
    }

    public function setCodigo_prueba($codigo_prueba) {
        $this->codigo_prueba = $codigo_prueba;
    }

    public function setCodigo_criterio($codigo_criterio) {
        $this->codigo_criterio = $codigo_criterio;
    }

    public function setMin($min) {
        $this->min = $min;
    }

    public function setMax($max) {
        $this->max = $max;
    }

    public function setVal($val) {
        $this->val = $val;
    }

    public function setEst($est) {
        $this->est = $est;
    }

    public function listar() {
        try {
            $sql = "
                    SELECT 
                        codigo_ponderacion_deseable, 
                        ponderacion_deseable_minimo, 
                        ponderacion_deseable_maximo, 
                        valoracion, 
                        estado, 
                        codigo_prueba
                    FROM 
                        ponderacion_deseable
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
            $sql = "select * from f_generar_correlativo('ponderacion_deseable') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigo_criterio($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                    INSERT INTO ponderacion_deseable(
                            codigo_ponderacion_deseable, 
                            ponderacion_deseable_minimo,
                            ponderacion_deseable_maximo, 
                            valoracion, 
                            estado, 
                            codigo_prueba)
                    VALUES (:p_cod_crit, :p_min, :p_max, 
                            :p_val, :p_est, :p_cod_prueb);
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cod_prueb", $this->getCodigo_prueba());
                $sentencia->bindParam(":p_cod_crit", $this->getCodigo_criterio());
                $sentencia->bindParam(":p_min", $this->getMin());
                $sentencia->bindParam(":p_max", $this->getMax());
                $sentencia->bindParam(":p_val", $this->getVal());
                $sentencia->bindParam(":p_est", $this->getEst());
//                $sentencia->bindParam(":p_codigo_criterio", $this->getCodigoPais());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='ponderacion_deseable'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla ponderacion_deseable");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function leerDatos($p_codigoCriterio) {
        try {
            $sql = "
                    select * from ponderacion_deseable 
                    where codigo_ponderacion_deseable = :p_cod_crit
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_crit", $p_codigoCriterio);
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
                update ponderacion_deseable
                SET 
                    ponderacion_deseable_minimo = :p_min, 
                    ponderacion_deseable_maximo = :p_max, 
                    valoracion = :p_val, 
                    estado = :p_est, 
                    codigo_prueba = :p_cod_prueb
                where
                    codigo_ponderacion_deseable = :p_cod_crit
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_prueb", $this->getCodigo_prueba());
            $sentencia->bindParam(":p_cod_crit", $this->getCodigo_criterio());
            $sentencia->bindParam(":p_min", $this->getMin());
            $sentencia->bindParam(":p_max", $this->getMax());
            $sentencia->bindParam(":p_val", $this->getVal());
            $sentencia->bindParam(":p_est", $this->getEst());
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
                    ponderacion_deseable 
                where
                    codigo_ponderacion_deseable = :p_cod_crit
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_crit", $this->getCodigo_criterio());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
