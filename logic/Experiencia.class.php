<?php

require_once '../data/Conexion.class.php';
 session_name("seleccion_personal_v2");
 session_start();
//require_once '../logic/Sesion.class.php';
//$DOC = $_SESSION["s_doc_id"];
class Experiencia extends Conexion {
    
    private $codigo_experiencia_laboral;
    private $rubro_empresa;
    private $empresa;
    private $puesto;
    private $lugar;
    private $descripcion_laboral;
    private $motivo_cambio;
    private $area;
    private $duracion;
    // private $fecha_fin;
    
    public function getCodigo_experiencia_laboral() {
        return $this->codigo_experiencia_laboral;
    }

    public function getRubro_empresa() {
        return $this->rubro_empresa;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function getPuesto() {
        return $this->puesto;
    }

    public function getLugar() {
        return $this->lugar;
    }

    public function getDescripcion_laboral() {
        return $this->descripcion_laboral;
    }

    public function getMotivo_cambio() {
        return $this->motivo_cambio;
    }

    public function getArea() {
        return $this->area;
    }

    public function getDuracion() {
        return $this->duracion;
    }

    public function setCodigo_experiencia_laboral($codigo_experiencia_laboral) {
        $this->codigo_experiencia_laboral = $codigo_experiencia_laboral;
    }

    public function setRubro_empresa($rubro_empresa) {
        $this->rubro_empresa = $rubro_empresa;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    public function setPuesto($puesto) {
        $this->puesto = $puesto;
    }

    public function setLugar($lugar) {
        $this->lugar = $lugar;
    }

    public function setDescripcion_laboral($descripcion_laboral) {
        $this->descripcion_laboral = $descripcion_laboral;
    }

    public function setMotivo_cambio($motivo_cambio) {
        $this->motivo_cambio = $motivo_cambio;
    }

    public function setArea($area) {
        $this->area = $area;
    }

    public function setDuracion($duracion) {
        $this->duracion = $duracion;
    }

    public function listar() {
       
        try {
            $sql = "
                    select 
                        codigo_experiencia_laboral,
                        rubro_empresa,
                        empresa,
                        puesto,
                        lugar,
                        descripcion_laboral,
                        motivo_cambio,
                        area,
                        duracion
                    from 
                        experiencia_laboral 
                    where doc_id = '$_SESSION[s_doc_id]'    
                ";
//            $sql = "
//                    select * from estudio_candidato 
//                    where doc_id = '$_SESSION[s_doc_id]'
//                ";
            $sentencia = $this->dblink->prepare($sql);
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
            $sql = "select * from f_generar_correlativo('experiencia_laboral') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            
            if ($sentencia->rowCount()){
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigo_experiencia_laboral($nuevoCodigo);
                
                /*Insertar en la tabla laboratorio*/
                $sql = "
                    insert into experiencia_laboral
                            (
                                codigo_experiencia_laboral,
                                rubro_empresa,
                                empresa,
                                puesto,
                                lugar,
                                descripcion_laboral,
                                motivo_cambio,
                                area,
                                duracion,
                                doc_id
                            )
                    values(
                            :p_cod_experiencia_laboral,
                            :p_rubro_empresa,
                            :p_empresa,
                            :p_puesto,
                            :p_lugar,
                            :p_descripcion_laboral,
                            :p_motivo_cambio,
                            :p_area,
                            :p_duracion,
                            '$_SESSION[s_doc_id]'
                           );
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cod_experiencia_laboral", $this->getCodigo_experiencia_laboral());
                $sentencia->bindParam(":p_rubro_empresa", $this->getRubro_empresa());
                $sentencia->bindParam(":p_empresa", $this->getEmpresa());
                $sentencia->bindParam(":p_puesto", $this->getPuesto());
                $sentencia->bindParam(":p_lugar", $this->getLugar());
                $sentencia->bindParam(":p_descripcion_laboral", $this->getDescripcion_laboral());
                $sentencia->bindParam(":p_motivo_cambio", $this->getMotivo_cambio());
                $sentencia->bindParam(":p_area", $this->getArea());
                $sentencia->bindParam(":p_duracion", $this->getDuracion());
                // $sentencia->bindParam(":p_fecha_fin", $this->getFecha_fin());
//                $sentencia->bindParam(":p_doc_id", $this->getCodigo_estudio());
                $sentencia->execute();
                /*Insertar en la tabla laboratorio*/
                
                /*Actualizar el correlativo*/
                $sql = "update correlativo set numero = numero + 1 
                        where tabla='experiencia_laboral'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
//                /*Actualizar el correlativo*/
                $this->dblink->commit();
                return true;
                
            }else{
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
                    select * from experiencia_laboral 
                    where codigo_experiencia_laboral = :p_cod_exp
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
                update 
                    experiencia_laboral 
                set 
                    empresa = :p_empresa,
                    rubro_empresa = :p_rubro_empresa,
                    puesto = :p_puesto,
                    lugar = :p_lugar,
                    descripcion_laboral = :p_descripcion_laboral,
                    motivo_cambio = :p_motivo_cambio,
                    area = :p_area,
                    duracion = :p_duracion
                where 
                    codigo_experiencia_laboral = :p_cod_experiencia_laboral
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_experiencia_laboral", $this->getCodigo_experiencia_laboral());
            $sentencia->bindParam(":p_rubro_empresa", $this->getRubro_empresa());
            $sentencia->bindParam(":p_empresa", $this->getEmpresa());
            $sentencia->bindParam(":p_puesto", $this->getPuesto());
            $sentencia->bindParam(":p_lugar", $this->getLugar());
            $sentencia->bindParam(":p_descripcion_laboral", $this->getDescripcion_laboral());
            $sentencia->bindParam(":p_motivo_cambio", $this->getMotivo_cambio());
            $sentencia->bindParam(":p_area", $this->getArea());
            $sentencia->bindParam(":p_duracion", $this->getDuracion());
            //$sentencia->bindParam(":p_fecha_fin", $this->getFecha_fin());
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
                    experiencia_laboral 
                where
                    codigo_experiencia_laboral = :p_cod_experiencia_laboral
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_experiencia_laboral", $this->getCodigo_experiencia_laboral());
            $sentencia->execute();
            return true;
            
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }
    
    
    


}
