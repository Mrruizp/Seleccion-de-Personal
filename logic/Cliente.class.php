<?php

require_once '../data/Conexion.class.php';

class Cliente extends Conexion {
    
    public function cargarDatosCliente($nombre) {
        try {
            $sql = "
		select 
		    codigo_cliente, 
		    (apellido_paterno || ' ' || apellido_materno || ', ' || nombres) as nombre, 
		    direccion,
		    telefono
		from 
		    cliente 
		where 
		    lower(apellido_paterno || ' ' || apellido_materno || ' ' || nombres) like :p_nombre";
            
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
}
