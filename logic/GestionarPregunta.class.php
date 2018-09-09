<?php

require_once '../data/Conexion.class.php';

class GestionarPregunta extends Conexion {

    private $codigo_pregunta;
    private $nombre_pregunta;
    private $puntaje_correcto;
    private $puntaje_incorrecto;
    private $respuesta;
    private $codigo_prueba;
    private $numero_pregunta;
    
    public function getCodigo_pregunta() {
        return $this->codigo_pregunta;
    }

    public function getNombre_pregunta() {
        return $this->nombre_pregunta;
    }

    public function getPuntaje_correcto() {
        return $this->puntaje_correcto;
    }

    public function getPuntaje_incorrecto() {
        return $this->puntaje_incorrecto;
    }

    public function getRespuesta() {
        return $this->respuesta;
    }

    public function getCodigo_prueba() {
        return $this->codigo_prueba;
    }

    public function getNumero_pregunta() {
        return $this->numero_pregunta;
    }

    public function setCodigo_pregunta($codigo_pregunta) {
        $this->codigo_pregunta = $codigo_pregunta;
    }

    public function setNombre_pregunta($nombre_pregunta) {
        $this->nombre_pregunta = $nombre_pregunta;
    }

    public function setPuntaje_correcto($puntaje_correcto) {
        $this->puntaje_correcto = $puntaje_correcto;
    }

    public function setPuntaje_incorrecto($puntaje_incorrecto) {
        $this->puntaje_incorrecto = $puntaje_incorrecto;
    }

    public function setRespuesta($respuesta) {
        $this->respuesta = $respuesta;
    }

    public function setCodigo_prueba($codigo_prueba) {
        $this->codigo_prueba = $codigo_prueba;
    }

    public function setNumero_pregunta($numero_pregunta) {
        $this->numero_pregunta = $numero_pregunta;
    }

    public function listar() {
        try {
            $sql = "
                    SELECT 
                            codigo_pregunta, 
                            numero_pregunta,
                            nombre_pregunta, 
                            puntaje_correcto, 
                            puntaje_incorrecto, 
                            respuesta,
                            codigo_prueba
                       FROM pregunta
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
            $sql = "select * from f_generar_correlativo('pregunta') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigo_pregunta($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                    INSERT INTO pregunta(
                            codigo_pregunta, 
                            nombre_pregunta, 
                            puntaje_correcto, 
                            puntaje_incorrecto, 
                            respuesta, 
                            codigo_prueba,
                            numero_pregunta)
                    VALUES (
                        :p_codigo_pregunta, 
                        :p_nombre_pregunta, 
                        :p_puntaje_correcto, 
                        :p_puntaje_incorrecto,
                        :p_respuesta, 
                        :p_codigo_prueba,
                        :p_numero_pregunta);
                    ";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_pregunta", $this->getCodigo_pregunta());
                $sentencia->bindParam(":p_nombre_pregunta", $this->getNombre_pregunta());
                $sentencia->bindParam(":p_puntaje_correcto", $this->getPuntaje_correcto());
                $sentencia->bindParam(":p_puntaje_incorrecto", $this->getPuntaje_incorrecto());
                $sentencia->bindParam(":p_respuesta", $this->getRespuesta());
                $sentencia->bindParam(":p_codigo_prueba", $this->getCodigo_prueba());
                $sentencia->bindParam(":p_numero_pregunta", $this->getNumero_pregunta());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='pregunta'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla pregunta");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function leerDatos($p_codigoPregunta) {
        try {
            $sql = "
                    select * from pregunta 
                    where codigo_pregunta = :p_codigo_pregunta
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_pregunta", $p_codigoPregunta);
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
                UPDATE pregunta
                SET 
                    nombre_pregunta     = :p_nombre_pregunta, 
                    puntaje_correcto    = :p_puntaje_correcto, 
                    puntaje_incorrecto  = :p_puntaje_incorrecto, 
                    respuesta           = :p_respuesta, 
                    codigo_prueba       = :p_codigo_prueba,
                    numero_pregunta       = :p_numero_pregunta
                where
                    codigo_pregunta = :p_codigo_pregunta
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_pregunta", $this->getCodigo_pregunta());
            $sentencia->bindParam(":p_nombre_pregunta", $this->getNombre_pregunta());
            $sentencia->bindParam(":p_puntaje_correcto", $this->getPuntaje_correcto());
            $sentencia->bindParam(":p_puntaje_incorrecto", $this->getPuntaje_incorrecto());
            $sentencia->bindParam(":p_respuesta", $this->getRespuesta());
            $sentencia->bindParam(":p_codigo_prueba", $this->getCodigo_prueba());
            $sentencia->bindParam(":p_numero_pregunta", $this->getNumero_pregunta());
//            $id_post = $_GET["id"];
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
                    pregunta 
                where
                    codigo_pregunta = :p_codigo_pregunta
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_pregunta", $this->getCodigo_pregunta());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
