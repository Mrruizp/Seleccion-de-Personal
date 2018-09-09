<?php

require_once '../data/Conexion.class.php';
session_name("seleccion_personal_v2");
 session_start();
class Postulacion extends Conexion {
    private $codigoPostulacion;
    private $codigoPuesto;
    
    public function getCodigoPostulacion() {
        return $this->codigoPostulacion;
    }

    public function getCodigoPuesto() {
        return $this->codigoPuesto;
    }

    public function setCodigoPostulacion($codigoPostulacion) {
        $this->codigoPostulacion = $codigoPostulacion;
    }

    public function setCodigoPuesto($codigoPuesto) {
        $this->codigoPuesto = $codigoPuesto;
    }

    
        
    public function listar() {
        try {
            $sql = "
                    select
                            l.codigo_laboratorio,
                            l.nombre,
                            coalesce(p.nombre,'--no asignado--') as pais
                    from 
                            laboratorio l left join pais p on ( l.codigo_pais = p.codigo_pais )
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
            $sql = "select * from f_generar_correlativo('postulacion') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            
            if ($sentencia->rowCount()){
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigoPostulacion($nuevoCodigo);
                
                /*Insertar en la tabla laboratorio*/
                $sql = "
                    select * from fn_FiltroCurriculo(
				    :p_cod_post,
                                    '$_SESSION[s_doc_id]',
                                    :p_codigo_puesto
                                   
			   );
                    ";
                
//                insert into laboratorio
//                                           (
//                                             doc_ID,nombre,apellidos,direccion,celular,hijos,
//                                             departamento_nacimiento,ciudad_nacimiento,estado_civil,
//                                             sexo,edad,email,Disposicion_laboral_id) 
//                    values(:p_cod_lab, :p_nomb, :p_codigo_pais)
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cod_post", $this->getCodigoPostulacion());
                $sentencia->bindParam(":p_codigo_puesto", $this->getCodigoPuesto());
                $sentencia->execute();
                /*Insertar en la tabla laboratorio*/
                
                /*Actualizar el correlativo*/
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='postulacion'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /*Actualizar el correlativo*/
                $this->dblink->commit();
                return true;
                
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla postulacion");
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }
    
    public function leerDatos($p_codigoLaboratorio) {
        try {
            $sql = "
                    select * from laboratorio 
                    where codigo_laboratorio = :p_cod_lab
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_lab", $p_codigoLaboratorio);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    


}
