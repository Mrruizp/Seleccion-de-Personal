<?php

require_once '../data/Conexion.class.php';

class GestionarConvocatoria extends Conexion {

    private $codigo_convocatoria;
    private $codigo_cronograma;
    private $nombre_convocatoria;
    private $estado;
    private $codigo_etapa;
    private $fecha;

    public function getCodigo_convocatoria() {
        return $this->codigo_convocatoria;
    }

    public function getCodigo_cronograma() {
        return $this->codigo_cronograma;
    }

    public function getNombre_convocatoria() {
        return $this->nombre_convocatoria;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCodigo_etapa() {
        return $this->codigo_etapa;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setCodigo_convocatoria($codigo_convocatoria) {
        $this->codigo_convocatoria = $codigo_convocatoria;
    }

    public function setCodigo_cronograma($codigo_cronograma) {
        $this->codigo_cronograma = $codigo_cronograma;
    }

    public function setNombre_convocatoria($nombre_convocatoria) {
        $this->nombre_convocatoria = $nombre_convocatoria;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setCodigo_etapa($codigo_etapa) {
        $this->codigo_etapa = $codigo_etapa;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    
        
    public function listar() {
        try {
            $sql = "
                    select
                            codigo_convocatoria,
                            nombre_convocatoria,
                            estado
                    from 
                            convocatoria
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
    public function listarCronograma() {
        try {
            $sql = "
                    select 
                        c.codigo_cronograma,
                        c.codigo_convocatoria,
                        c.fecha_cronograma,
                        e.nombre_etapa
                    from 
                        cronograma c inner join etapa e
                    on
                        (c.codigo_etapa = e.codigo_etapa)
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
            $sql = "select * from f_generar_correlativo('convocatoria') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigo_convocatoria($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                    insert into convocatoria
                                            (
                                            codigo_convocatoria, 
                                            nombre_convocatoria, 
                                            estado
                                            )
                    values(
                            :p_cod_conv,
                            :p_nom,
                            :p_est
                            );
                    ";

//                insert into laboratorio
//                                           (
//                                             doc_ID,nombre,apellidos,direccion,celular,hijos,
//                                             departamento_nacimiento,ciudad_nacimiento,estado_civil,
//                                             sexo,edad,email,Disposicion_laboral_id) 
//                    values(:p_cod_lab, :p_nomb, :p_codigo_pais)
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cod_conv", $this->getCodigo_convocatoria());
                $sentencia->bindParam(":p_nom", $this->getNombre_convocatoria());
                $sentencia->bindParam(":p_est", $this->getEstado());
//                $sentencia->bindParam(":p_fec1", $this->getFecha_cronograma1());
//                $sentencia->bindParam(":p_fec2", $this->getFecha_cronograma2());
//                $sentencia->bindParam(":p_fec3", $this->getFecha_cronograma3());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='convocatoria'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla convocatoria");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }
    public function agregarCronograma() {
        $this->dblink->beginTransaction();

        try {
            $sql = "select * from f_generar_correlativo('cronograma') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigo_cronograma($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                    insert into cronograma
                                            (
                                            codigo_cronograma,
                                            fecha_cronograma, 
                                            codigo_convocatoria,
                                            codigo_etapa
                                            )
                    values(
                            :p_cod_cron,
                            :p_fecha,
                            :p_cod_conv,
                            :p_cod_etapa
                            );
                    ";

//                insert into laboratorio
//                                           (
//                                             doc_ID,nombre,apellidos,direccion,celular,hijos,
//                                             departamento_nacimiento,ciudad_nacimiento,estado_civil,
//                                             sexo,edad,email,Disposicion_laboral_id) 
//                    values(:p_cod_lab, :p_nomb, :p_codigo_pais)
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cod_cron", $this->getCodigo_cronograma());
                $sentencia->bindParam(":p_fecha", $this->getFecha());
                $sentencia->bindParam(":p_cod_conv", $this->getCodigo_convocatoria());
                $sentencia->bindParam(":p_cod_etapa", $this->getCodigo_etapa());
//                $sentencia->bindParam(":p_fec1", $this->getFecha_cronograma1());
//                $sentencia->bindParam(":p_fec2", $this->getFecha_cronograma2());
//                $sentencia->bindParam(":p_fec3", $this->getFecha_cronograma3());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='cronograma'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla cronograma");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function leerDatos($p_codigoConvocatoria) {
        try {
            $sql = "
                    select 
                            *
                    from 
                            convocatoria 
                    where 
                            codigo_convocatoria = :p_cod_conv
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_conv", $p_codigoConvocatoria);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    public function leerDatosCronograma($codCron) {
        try {
            $sql = "
                    select * from cronograma 
                    where codigo_cronograma = :p_cod_cron
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_cron", $codCron);
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
                    convocatoria 
                set 
                    nombre_convocatoria = :p_nom,
                    estado = :p_est
                where
                    codigo_convocatoria = :p_cod_conv
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_nom", $this->getNombre_convocatoria());
            $sentencia->bindParam(":p_est", $this->getEstado());
            $sentencia->bindParam(":p_cod_conv", $this->getCodigo_convocatoria());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }
    public function editarCronograma() {
        try {
            $sql = "
                update 
                    cronograma 
                set 
                    fecha_cronograma = :p_fecha,
                    codigo_convocatoria = :p_cod_conv,
                    codigo_etapa = :p_cod_etapa
                where
                    codigo_cronograma = :p_cod_cron
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_cron", $this->getCodigo_cronograma());
            $sentencia->bindParam(":p_fecha", $this->getFecha());
            $sentencia->bindParam(":p_cod_conv", $this->getCodigo_convocatoria());
            $sentencia->bindParam(":p_cod_etapa", $this->getCodigo_etapa());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

    public function eliminarCronograma() {
        try {
            $sql = "
                delete from 
                    cronograma 
                where
                    codigo_cronograma = :p_cod_cron
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_cron", $this->getCodigo_cronograma());
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
                    convocatoria 
                where
                    codigo_convocatoria = :p_cod_conv
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_conv", $this->getCodigo_convocatoria());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
