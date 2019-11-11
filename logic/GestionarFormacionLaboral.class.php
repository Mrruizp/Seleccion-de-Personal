<?php

require_once '../data/Conexion.class.php';

class GestionarFormacionLaboral extends Conexion {

    private $codigo_formacion_laboral;
    private $nombre_formacion_laboral;

    public function getCodigo_formacion_laboral() {
        return $this->codigo_formacion_laboral;
    }

    public function getNombre_formacion_laboral() {
        return $this->nombre_formacion_laboral;
    }

    public function setCodigo_formacion_laboral($codigo_formacion_laboral) {
        $this->codigo_formacion_laboral = $codigo_formacion_laboral;
    }

    public function setNombre_formacion_laboral($nombre_formacion_laboral) {
        $this->nombre_formacion_laboral = $nombre_formacion_laboral;
    }

    
    public function listar() {
        try {
            $sql = "
                    SELECT 
                        codigo_formacion_laboral, 
                        nombre_formacion_laboral
                    FROM 
                        formacion_laboral
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
            $sql = "select * from f_generar_correlativo('formacion_laboral') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigo_formacion_laboral($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                       
                      insert into formacion_laboral
                                (
                                    codigo_formacion_laboral, 
                                    nombre_formacion_laboral
                                )
                      values
                            (
                                :p_cod_for,
                                :p_nomb_for
                            );
                    
                    ";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cod_for", $this->getCodigo_formacion_laboral());
                $sentencia->bindParam(":p_nomb_for", $this->getNombre_formacion_laboral());
               // $sentencia->bindParam(":p_nomb_exp", $this->getNombre_experiencia_laboral());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='formacion_laboral'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla formacion_laboral");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function leerDatos($p_codigoFormacion) { 
        try {
            $sql = "
                
                    SELECT 
                        codigo_formacion_laboral,
                        nombre_formacion_laboral
                    FROM 
                        formacion_laboral
                    where 
                        codigo_formacion_laboral = :p_cod_for
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_for", $p_codigoFormacion);
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
                    formacion_laboral
                SET 
                    nombre_formacion_laboral = :p_nomb_for
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
                    formacion_laboral
                WHERE
                    codigo_formacion_laboral = :p_cod_req;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_req", $this->getCodigo_formacion_laboral());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
