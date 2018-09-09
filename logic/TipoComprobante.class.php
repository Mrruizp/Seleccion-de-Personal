<?php

require_once '../data/Conexion.class.php';

class TipoComprobante extends Conexion {
   private $codigoTipoComprobante;
   private $descripcion;
   
   public function getCodigoTipoComprobante() {
       return $this->codigoTipoComprobante;
   }

   public function getDescripcion() {
       return $this->descripcion;
   }

   public function setCodigoTipoComprobante($codigoTipoComprobante) {
       $this->codigoTipoComprobante = $codigoTipoComprobante;
   }

   public function setDescripcion($descripcion) {
       $this->descripcion = $descripcion;
   }

   public function cargarDatos() {
       try {
            $sql = "select * from tipo_comprobante order by 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
}
