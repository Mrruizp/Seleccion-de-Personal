<?php

require_once '../data/Conexion.class.php';

class Cronograma extends Conexion {
    private $codigoConvocatoria;
    private $fechaCronograma;
    private $etada;
    public function leerDatos($p_codigoConvocatoria) {
//        codigo_cronograma,
//                        fecha_cronograma, 
//                        codigo_etapa,
//                        codigo_convocatoria
        try {
            $sql = "
                    select 
                        c.codigo_convocatoria,
                        e.codigo_etapa,
			            e.nombre_etapa,
                        c.fecha_cronograma
                    from 
                        cronograma c inner join etapa e
                    on
                        (c.codigo_etapa = e.codigo_etapa)
                    where 
                        c.codigo_convocatoria = :p_cod_conv
                    order by 
                            e.codigo_etapa asc
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_conv", $p_codigoConvocatoria);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function editar() {
        try {
            $sql = "
                update 
                    laboratorio 
                set 
                    nombre = :p_nom_lab,
                    codigo_pais = :p_cod_pais
                where
                    codigo_laboratorio = :p_cod_lab
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_nom_lab", $this->getNombre());
            $sentencia->bindParam(":p_cod_pais", $this->getCodigoPais());
            $sentencia->bindParam(":p_cod_lab", $this->getCodigoLaboratorio());
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
                    laboratorio 
                where
                    codigo_laboratorio = :p_cod_lab
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_lab", $this->getCodigoLaboratorio());
            $sentencia->execute();
            return true;
            
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }
    
    
    


}
