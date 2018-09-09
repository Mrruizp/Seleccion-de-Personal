<?php

require_once '../data/Conexion.class.php';

class Pais extends Conexion {
    private $codigoPais;
    private $nombre;
    
    public function getCodigoPais() {
        return $this->codigoPais;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setCodigoPais($codigoPais) {
        $this->codigoPais = $codigoPais;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function cargarDatos() {
        try {
            $sql = "select * from pais order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    
}
