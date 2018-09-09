<?php

require_once '../data/Conexion.class.php';

class Usuario extends Conexion {
    
    public function leerDatos($p_dni) {
        try {
            $sql = "
                    select
                            c.doc_id,
                            c.apellidos,
                            c.nombre,
                            c.direccion,
                            c.telefono,
                            c.hijos,
                            c.departamento_nacimiento,
                            c.ciudad_nacimiento,
                            c.estado_civil,
                            c.sexo,
                            c.edad,
                            c.email,
                            a.descripcion
                    from
                            candidato c inner join cargo a
                    on
			   c.codigo_cargo = a.codigo_cargo	
                    where
                            c.doc_id = :p_dni

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
}
