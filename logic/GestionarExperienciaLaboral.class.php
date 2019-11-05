<?php

require_once '../data/Conexion.class.php';

class GestionarExperienciaLaboral extends Conexion {

    private $codigo_puesto_laboral;
    private $codigo_formacion_laboral;
    private $nombre_formacion_laboral;
    private $nombre_experiencia_laboral;

    public function getCodigo_puesto_laboral() {
        return $this->codigo_puesto_laboral;
    }

    public function getCodigo_formacion_laboral() {
        return $this->codigo_formacion_laboral;
    }

    public function getNombre_formacion_laboral() {
        return $this->nombre_formacion_laboral;
    }

    public function getNombre_experiencia_laboral() {
        return $this->nombre_experiencia_laboral;
    }

    public function setCodigo_puesto_laboral($codigo_puesto_laboral) {
        $this->codigo_puesto_laboral = $codigo_puesto_laboral;
    }

    public function setCodigo_formacion_laboral($codigo_formacion_laboral) {
        $this->codigo_formacion_laboral = $codigo_formacion_laboral;
    }

    public function setNombre_formacion_laboral($nombre_formacion_laboral) {
        $this->nombre_formacion_laboral = $nombre_formacion_laboral;
    }

    public function setNombre_experiencia_laboral($nombre_experiencia_laboral) {
        $this->nombre_experiencia_laboral = $nombre_experiencia_laboral;
    }

    public function listar() {
        try {
            $sql = "
                    SELECT 
                        e.codigo_puesto_laboral,
                        f.codigo_formacion_laboral,
                        f.nombre_formacion_laboral, 
                        e.nombre_experiencia_laboral
                    FROM 
                        experiencia_laboral e inner join formacion_laboral f 
                    ON
                        e.codigo_formacion_laboral = f.codigo_formacion_laboral
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
            $sql = "select * from f_generar_correlativo('formacion_laboral') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigo_formacion_laboral($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                    
                      select * from fn_registrarFormacionExperiencia 
                                                (
                                                    :p_codigo_puesto,
                                                    :p_cod_for,
                                                    :p_nomb_for,
                                                    :p_nomb_exp
                                                );
                    ";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_puesto", $this->getCodigo_puesto_laboral());
                $sentencia->bindParam(":p_cod_for", $this->getCodigo_formacion_laboral());
                $sentencia->bindParam(":p_nomb_for", $this->getNombre_formacion_laboral());
                $sentencia->bindParam(":p_nomb_exp", $this->getNombre_experiencia_laboral());
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
                
                    select 
                        *
                    from 
                        formacion_laboral f inner join experiencia_laboral e
                    on 
                        f.codigo_formacion_laboral = e.codigo_formacion_laboral
                    where f.codigo_formacion_laboral = :p_cod_for;
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
                
                select * from fn_actualizarFormacionExperiencia
					(
	 
                                            :p_codigo_puesto,
                                            :p_cod_for,
                                            :p_nomb_for,
                                            :p_nomb_exp
	 
					 );
                ";
            $sentencia = $this->dblink->prepare($sql);

            $sentencia->bindParam(":p_codigo_puesto", $this->getCodigo_puesto_laboral());
            $sentencia->bindParam(":p_cod_for", $this->getCodigo_formacion_laboral());
            $sentencia->bindParam(":p_nomb_for", $this->getNombre_formacion_laboral());
            $sentencia->bindParam(":p_nomb_exp", $this->getNombre_experiencia_laboral());
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
                select * from fn_eliminarFormacionExperiencia
					(
                                            :p_cod_req
	 
					 );
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
