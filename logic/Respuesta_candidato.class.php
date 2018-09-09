<?php

require_once '../data/Conexion.class.php';
session_name("seleccion_personal_v2");
session_start();

//require_once '../logic/Sesion.class.php';
//$DOC = $_SESSION["s_doc_id"];
class Respuesta_candidato extends Conexion {

    private $codigo_respuesta_candidato;
    private $respuesta;
    private $codPregunta;
    private $numPregunta;

    public function getCodigo_respuesta_candidato() {
        return $this->codigo_respuesta_candidato;
    }

    public function getRespuesta() {
        return $this->respuesta;
    }

    public function getCodPregunta() {
        return $this->codPregunta;
    }

    public function getNumPregunta() {
        return $this->numPregunta;
    }

    public function setCodigo_respuesta_candidato($codigo_respuesta_candidato) {
        $this->codigo_respuesta_candidato = $codigo_respuesta_candidato;
    }

    public function setRespuesta($respuesta) {
        $this->respuesta = $respuesta;
    }

    public function setCodPregunta($codPregunta) {
        $this->codPregunta = $codPregunta;
    }

    public function setNumPregunta($numPregunta) {
        $this->numPregunta = $numPregunta;
    }

    public function listar($p_codigoPrueba) {

        try {
            $sql = "
                    SELECT 
                           u.codigo_prueba,
                           r.codigo_pregunta, 
                           r.respuesta_candidato, 
                           r.doc_id,
                           r.numero_pregunta 
                    FROM 
                        pregunta p inner join respuesta_candidato r  
                    ON 
			(p.codigo_pregunta = r.codigo_pregunta) inner join prueba u
		    ON 
			(p.codigo_prueba = u.codigo_prueba)
                    where 
                        doc_id = '$_SESSION[s_doc_id]'and
			u.codigo_prueba =  :p_cod_prueba 
                    order by 1
                ";
//            $sql = "
//                    select * from estudio_candidato 
//                    where doc_id = '$_SESSION[s_doc_id]'
//                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_prueba", $p_codigoPrueba);
//            $sentencia->bindParam(":p_id", $_SESSION["s_doc_id"]);
//            $sentencia->bindParam(":p_fecha2", $p_fecha2);
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
            $sql = "select * from f_generar_correlativo('respuesta_candidato') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigo_respuesta_candidato($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                         select * from fn_CalificarPreguntas(
				    '$_SESSION[s_doc_id]',
				    :p_respuesta,
                                    :p_cod_respuesta_candidato,
                                    :p_codigo_pregunta,
                                    :p_numero_pregunta
			   );
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cod_respuesta_candidato", $this->getCodigo_respuesta_candidato());
                $sentencia->bindParam(":p_respuesta", $this->getRespuesta());
                $sentencia->bindParam(":p_codigo_pregunta", $this->getCodPregunta());
                $sentencia->bindParam(":p_numero_pregunta", $this->getNumPregunta());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='respuesta_candidato'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
//                /*Actualizar el correlativo*/
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla respuesta_candidato");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function leerDatos($p_codigoEstudio) {
        try {
            $sql = "
                    select * from estudio_candidato 
                    where codigo_estudio_candidato = :p_cod_est
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_est", $p_codigoEstudio);
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
                update 
                    estudio_candidato 
                set 
                    institucion_educativa = :p_institucion_educativa,
                    titulo_estudio = :p_titulo_estudio,
                    grado_estudio = :p_grado_estudio,
                    fecha_inicio = :p_fecha_inicio,
                    fecha_fin = :p_fecha_fin
                where
                    codigo_estudio_candidato = :p_codigo_estudio
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_respuesta_candidato", $this->getCodigo_respuesta_candidato());
            $sentencia->bindParam(":p_respuesta", $this->getRespuesta());
            $sentencia->bindParam(":p_numero_pregunta", $this->getNumPregunta());
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
                    estudio_candidato 
                where
                    codigo_estudio_candidato = :p_cod_est
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_est", $this->getCodigo_estudio());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
