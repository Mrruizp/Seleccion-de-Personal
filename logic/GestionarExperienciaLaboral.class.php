<?php

require_once '../data/Conexion.class.php';

class GestionarExperienciaLaboral extends Conexion {

    private $codigo_puesto_laboral;
    private $codigo_experiencia_laboral;
    private $codigo_formacion_laboral;
    private $duracion_experiencia_laboral;
    private $nombre_experiencia_laboral;   
    
    public function getCodigo_puesto_laboral() {
        return $this->codigo_puesto_laboral;
    }

    public function getCodigo_experiencia_laboral() {
        return $this->codigo_experiencia_laboral;
    }

    public function getCodigo_formacion_laboral() {
        return $this->codigo_formacion_laboral;
    }

    public function getDuracion_experiencia_laboral() {
        return $this->duracion_experiencia_laboral;
    }

    public function getNombre_experiencia_laboral() {
        return $this->nombre_experiencia_laboral;
    }

    public function setCodigo_puesto_laboral($codigo_puesto_laboral) {
        $this->codigo_puesto_laboral = $codigo_puesto_laboral;
    }

    public function setCodigo_experiencia_laboral($codigo_experiencia_laboral) {
        $this->codigo_experiencia_laboral = $codigo_experiencia_laboral;
    }

    public function setCodigo_formacion_laboral($codigo_formacion_laboral) {
        $this->codigo_formacion_laboral = $codigo_formacion_laboral;
    }

    public function setDuracion_experiencia_laboral($duracion_experiencia_laboral) {
        $this->duracion_experiencia_laboral = $duracion_experiencia_laboral;
    }

    public function setNombre_experiencia_laboral($nombre_experiencia_laboral) {
        $this->nombre_experiencia_laboral = $nombre_experiencia_laboral;
    }

    
    
    
    
    public function listar() {
        try {
            $sql = "
                    SELECT 
                        codigo_puesto_laboral,
                        codigo_formacion_laboral,
                        codigo_experiencia_laboral,
                        nombre_experiencia_laboral,
                        duracion_experiencia_laboral
                        
                    FROM 
                        experiencia_laboral
		ORDER BY
			1
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
            $sql = "select * from f_generar_correlativo('experiencia_laboral') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigo_experiencia_laboral($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                       
                      insert into experiencia_laboral
                                (
                                    codigo_experiencia_laboral, 
                                    nombre_experiencia_laboral,
                                    duracion_experiencia_laboral,
                                    codigo_puesto_laboral,
                                    codigo_formacion_laboral
                                    
                                )
                      values
                            (
                                :p_cod_exp,
                                :p_nombre_Experiencia,
                                :p_duracion,
                                :p_cod_puesto,
                                :p_cod_formacion
                            );
                    
                    ";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cod_puesto", $this->getCodigo_puesto_laboral());
                $sentencia->bindParam(":p_cod_formacion", $this->getCodigo_formacion_laboral());
                $sentencia->bindParam(":p_duracion", $this->getDuracion_experiencia_laboral());
                $sentencia->bindParam(":p_nombre_Experiencia", $this->getNombre_experiencia_laboral());
                $sentencia->bindParam(":p_cod_exp", $this->getCodigo_experiencia_laboral());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='experiencia_laboral'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla experiencia_laboral");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function leerDatos($p_codigoExperiencia) { 
        try {
            $sql = "
                
                    SELECT 
                        codigo_experiencia_laboral, 
                        nombre_experiencia_laboral,
                        duracion_experiencia_laboral,
                        codigo_puesto_laboral,
                        codigo_formacion_laboral
                    FROM 
                        experiencia_laboral
                    where 
                        codigo_experiencia_laboral = :p_cod_exp
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_exp", $p_codigoExperiencia);
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
                    experiencia_laboral
                SET 
                    nombre_experiencia_laboral = :p_nomb_for
                WHERE
                    codigo_formacion_laboral = :p_cod_for;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_for", $this->getCodigo_formacion_laboral());
            $sentencia->bindParam(":p_nomb_for", $this->getNombre_formacion_laboral());
            //$sentencia->bindParam(":p_nomb_exp", $this->getNombre_experiencia_laboral());
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
                DELETE 
                FROM
                    experiencia_laboral
                WHERE
                    codigo_experiencia_laboral = :p_cod_req;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_req", $this->getCodigo_experiencia_laboral());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
