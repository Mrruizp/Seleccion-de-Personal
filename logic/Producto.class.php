<?php

require_once '../data/Conexion.class.php';

class Producto extends Conexion {
    
    public function cargarDatosProducto($nombre) {
        try {
            $sql = "
                select
                        codigo_producto,
                        nombre,
                        precio_venta,
                        stock,
                        presentacion
                from
                        producto
                where
                        lower(nombre) like :p_nombre";
            
            $sentencia = $this->dblink->prepare($sql);
            $nombre = '%'.strtolower($nombre).'%';
            $sentencia->bindParam(":p_nombre", $nombre);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
            
    }
    
    public function obtenerUnidadMedida($p_cod_pro) {
        try {
            $sql = "
                select
                        abreviatura,
                        'E' as tipo
                from 
                        unidad_medida
                where
                        codigo_unidad_medida in 
                        (
                                select codigo_unidad_medida  from producto where codigo_producto = :p_cod_pro

                        )



                UNION ALL


                select
                        abreviatura,
                        'F' as tipo
                from 
                        unidad_medida
                where
                        codigo_unidad_medida in 
                        (
                                select codigo_unidad_fraccion from producto where codigo_producto = :p_cod_pro and fraccionable='1'

                        )
                ";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_pro", $p_cod_pro);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
}
