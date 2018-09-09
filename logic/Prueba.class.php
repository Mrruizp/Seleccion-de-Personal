<?php

require_once '../data/Conexion.class.php';

class Prueba extends Conexion {

    private $cod_prueba;
    private $cod_calificacion_prueba;

    public function getCod_prueba() {
        return $this->cod_prueba;
    }

    public function getCod_calificacion_prueba() {
        return $this->cod_calificacion_prueba;
    }

    public function setCod_prueba($cod_prueba) {
        $this->cod_prueba = $cod_prueba;
    }

    public function setCod_calificacion_prueba($cod_calificacion_prueba) {
        $this->cod_calificacion_prueba = $cod_calificacion_prueba;
    }

    public function listar($p_codigoPuesto) {

        try {
            $sql = "
                    select
                            distinct p.codigo_prueba,
                            --count(c.codigo_pregunta)as num_respuestas,
                            p.nombre_prueba, 
                            p.instruccion
                    from
                            prueba p left join pregunta r
                    on
                            (p.codigo_prueba = r.codigo_prueba)left join respuesta_candidato c
                    on 
                            r.codigo_pregunta = c.codigo_pregunta
                    where
                            codigo_tipo_prueba = 1 and
                            codigo_puesto_laboral = :p_cod_pues 
                    order by 1 
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

    public function listarConocimiento($p_codigoPuesto) {
//        codigo_cronograma,
//                        fecha_cronograma, 
//                        codigo_etapa,
//                        codigo_convocatoria
        try {
            $sql = "
                    SELECT 
                        distinct p.codigo_prueba,
                        count(c.codigo_pregunta)as num_respuestas,
                        p.nombre_prueba, 
                        p.instruccion, 
                        p.duracion,
                        r.promedio
                        
                   FROM 
                         prueba p left join promedio_prueba r
                   on
                         p.codigo_prueba = r.codigo_prueba left join pregunta b
                   on 
			p.codigo_prueba = b.codigo_prueba left join respuesta_candidato c
		  on 
			b.codigo_pregunta = c.codigo_pregunta
                    where
                        codigo_tipo_prueba = 3 and 
                        codigo_puesto_laboral = :p_cod_pues 
                 GROUP BY p.codigo_prueba,p.nombre_prueba, 
                        p.instruccion, 
                        p.duracion,
                        r.promedio
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

    public function listarEvaluacionExamen($p_codigoPrueba) {
//        codigo_cronograma,
//                        fecha_cronograma, 
//                        codigo_etapa,
//                        codigo_convocatoria
        try {
            $sql = "
                   SELECT 
                        distinct 
                        p.codigo_prueba, 
                        p.nombre_prueba, 
                        p.instruccion,
                        duracion
                   FROM 
                         prueba p inner join pregunta r
                   on
                         p.codigo_prueba = r.codigo_prueba
                    where
                        p.codigo_prueba = :p_cod_prueba
                    order by 
                            1
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_prueba", $p_codigoPrueba);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarEvaluacionExamenPregunta($p_codigoPrueba) {
        session_name("seleccion_personal_v2");
        session_start();
        try {
            $sql = "
                      SELECT 
                            codigo_pregunta,
                            numero_pregunta,
                            nombre_pregunta 
                    FROM 
                            puesto_laboral p inner join prueba r
                    on
                            (p.codigo_puesto_laboral = r.codigo_puesto_laboral)inner join pregunta e
                    on
                            (r.codigo_prueba = e.codigo_prueba)inner join postulacion o
                    on
                            (o.codigo_puesto_laboral = o.codigo_puesto_laboral)
                    where
                            o.doc_id = '$_SESSION[s_doc_id]' and
                            e.codigo_prueba = :p_cod_prueba
                    order by 1
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_prueba", $p_codigoPrueba);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarDatos() {
        try {
            $sql = "select 
                            codigo_prueba
                    from 
                            prueba
                    order by 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function calificarPrueba() {
        session_name("seleccion_personal_v2");
        session_start();
        $this->dblink->beginTransaction();

        try {
            $sql = "select * from f_generar_correlativo('promedio_prueba') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCod_calificacion_prueba($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                        select * from fn_CalificarPrueba(
                                                        '$_SESSION[s_doc_id]',
                                                        :p_cod_prueba,
                                                        :p_cod_calificacion_prueba
                                                       );
                    ";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cod_calificacion_prueba", $this->getCod_calificacion_prueba());
                $sentencia->bindParam(":p_cod_prueba", $this->getCod_prueba());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='promedio_prueba'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla promedio_prueba");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

}
