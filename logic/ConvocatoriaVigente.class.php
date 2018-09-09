<?php

require_once '../data/Conexion.class.php';

class ConvocatoriaVigente extends Conexion {
//    private $codigoLaboratorio;
//    private $nombre;
//    private $codigoPais;
//    
//    public function getCodigoPais() {
//        return $this->codigoPais;
//    }
//
//    public function setCodigoPais($codigoPais) {
//        $this->codigoPais = $codigoPais;
//    }
//
//        
//    
//    public function getCodigoLaboratorio() {
//        return $this->codigoLaboratorio;
//    }
//
//    public function getNombre() {
//        return $this->nombre;
//    }
//
//    public function setCodigoLaboratorio($codigoLaboratorio) {
//        $this->codigoLaboratorio = $codigoLaboratorio;
//    }
//
//    public function setNombre($nombre) {
//        $this->nombre = $nombre;
//    }
    
    public function listar() {
        try {
            $sql = "
                    select 
                        codigo_convocatoria,
                        nombre_convocatoria,
                        estado
                    from
                        convocatoria
                    where
                        estado = 'VIGENTE'
                    order by 
                            2
                ";
//            $sql = "
//                    select
//                            l.codigo_laboratorio,
//                            l.nombre,
//                            coalesce(p.nombre,'--no asignado--') as pais
//                    from 
//                            laboratorio l left join pais p on ( l.codigo_pais = p.codigo_pais )
//                    order by 
//                            2
//                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
//    public function agregar() {
//        $this->dblink->beginTransaction();
//        
//        try {
//            $sql = "select * from f_generar_correlativo('laboratorio') as nc";
//            $sentencia = $this->dblink->prepare($sql);
//            $sentencia->execute();
//            
//            if ($sentencia->rowCount()){
//                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
//                $nuevoCodigo = $resultado["nc"];
//                $this->setCodigoLaboratorio($nuevoCodigo);
//                
//                /*Insertar en la tabla laboratorio*/
//                $sql = "
//                    insert into laboratorio(codigo_laboratorio,nombre,codigo_pais) 
//                    values(:p_cod_lab, :p_nomb, :p_codigo_pais)
//                    ";
//                
////                insert into laboratorio
////                                           (
////                                             doc_ID,nombre,apellidos,direccion,celular,hijos,
////                                             departamento_nacimiento,ciudad_nacimiento,estado_civil,
////                                             sexo,edad,email,Disposicion_laboral_id) 
////                    values(:p_cod_lab, :p_nomb, :p_codigo_pais)
//                $sentencia = $this->dblink->prepare($sql);
//                $sentencia->bindParam(":p_cod_lab", $this->getCodigoLaboratorio());
//                $sentencia->bindParam(":p_nomb", $this->getNombre());
//                $sentencia->bindParam(":p_codigo_pais", $this->getCodigoPais());
//                $sentencia->execute();
//                /*Insertar en la tabla laboratorio*/
//                
//                /*Actualizar el correlativo*/
//                $sql = "update correlativo set numero = numero + 1 
//                    where tabla='laboratorio'";
//                $sentencia = $this->dblink->prepare($sql);
//                $sentencia->execute();
//                /*Actualizar el correlativo*/
//                $this->dblink->commit();
//                return true;
//                
//            }else{
//                throw new Exception("No se ha configurado el correlativo para la tabla laboratorio");
//            }
//            
//        } catch (Exception $exc) {
//            $this->dblink->rollBack();
//            throw $exc;
//        }
//        
//        return false;
//    }
//    
//    public function leerDatos($p_codigoLaboratorio) {
//        try {
//            $sql = "
//                    select * from laboratorio 
//                    where codigo_laboratorio = :p_cod_lab
//                ";
//            $sentencia = $this->dblink->prepare($sql);
//            $sentencia->bindParam(":p_cod_lab", $p_codigoLaboratorio);
//            $sentencia->execute();
//            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
//            return $resultado;
//        } catch (Exception $exc) {
//            throw $exc;
//        }
//    }
//    
//    public function editar() {
//        try {
//            $sql = "
//                update 
//                    laboratorio 
//                set 
//                    nombre = :p_nom_lab,
//                    codigo_pais = :p_cod_pais
//                where
//                    codigo_laboratorio = :p_cod_lab
//                ";
//            $sentencia = $this->dblink->prepare($sql);
//            $sentencia->bindParam(":p_nom_lab", $this->getNombre());
//            $sentencia->bindParam(":p_cod_pais", $this->getCodigoPais());
//            $sentencia->bindParam(":p_cod_lab", $this->getCodigoLaboratorio());
//            $sentencia->execute();
//            return true;
//            
//        } catch (Exception $exc) {
//            throw $exc;
//        }
//        return false;
//    }
//    
//    public function eliminar() {
//        try {
//            $sql = "
//                delete from 
//                    laboratorio 
//                where
//                    codigo_laboratorio = :p_cod_lab
//                ";
//            $sentencia = $this->dblink->prepare($sql);
//            $sentencia->bindParam(":p_cod_lab", $this->getCodigoLaboratorio());
//            $sentencia->execute();
//            return true;
//            
//        } catch (Exception $exc) {
//            throw $exc;
//        }
//        return false;
//    }
    
    
    


}
