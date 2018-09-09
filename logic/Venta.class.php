<?php

require_once '../data/Conexion.class.php';


class Venta extends Conexion {
    private $codigoTipoComprobante;
    private $numeroSerie;
    private $codigoCliente;
    private $fechaVenta;
    private $porcentajeIgv;
    private $subTotal;
    private $igv;
    private $total;
    private $codigoUsuario;
    private $detalleVenta;
    
    public function getCodigoTipoComprobante() {
        return $this->codigoTipoComprobante;
    }

    public function getNumeroSerie() {
        return $this->numeroSerie;
    }

    public function getCodigoCliente() {
        return $this->codigoCliente;
    }

    public function getFechaVenta() {
        return $this->fechaVenta;
    }

    public function getPorcentajeIgv() {
        return $this->porcentajeIgv;
    }

    public function getSubTotal() {
        return $this->subTotal;
    }

    public function getIgv() {
        return $this->igv;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getCodigoUsuario() {
        return $this->codigoUsuario;
    }

    public function getDetalleVenta() {
        return $this->detalleVenta;
    }

    public function setCodigoTipoComprobante($codigoTipoComprobante) {
        $this->codigoTipoComprobante = $codigoTipoComprobante;
    }

    public function setNumeroSerie($numeroSerie) {
        $this->numeroSerie = $numeroSerie;
    }

    public function setCodigoCliente($codigoCliente) {
        $this->codigoCliente = $codigoCliente;
    }

    public function setFechaVenta($fechaVenta) {
        $this->fechaVenta = $fechaVenta;
    }

    public function setPorcentajeIgv($porcentajeIgv) {
        $this->porcentajeIgv = $porcentajeIgv;
    }

    public function setSubTotal($subTotal) {
        $this->subTotal = $subTotal;
    }

    public function setIgv($igv) {
        $this->igv = $igv;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setCodigoUsuario($codigoUsuario) {
        $this->codigoUsuario = $codigoUsuario;
    }

    public function setDetalleVenta($detalleVenta) {
        $this->detalleVenta = $detalleVenta;
    }

        
    public function listar($p_fecha1, $p_fecha2) {
        try {
            $sql = "select * from f_listar_ventas(:p_fecha1, :p_fecha2);";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha1", $p_fecha1);
            $sentencia->bindParam(":p_fecha2", $p_fecha2);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function registrarVenta(){
        try {
            $sql = "
                select f_registrar_venta
                    (
                            :p_tip_com,
                            :p_serie,
                            :p_cod_cli,
                            :p_fec_vta,
                            :p_por_igv,
                            :p_sub_tot,
                            :p_igv,
                            :p_total,
                            :p_cod_usu,
                            :p_det_vta
                    ) as nc;
                ";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_tip_com", $this->getCodigoTipoComprobante());
            $sentencia->bindParam(":p_serie", $this->getNumeroSerie());
            $sentencia->bindParam(":p_cod_cli", $this->getCodigoCliente());
            $sentencia->bindParam(":p_fec_vta", $this->getFechaVenta());
            $sentencia->bindParam(":p_por_igv", $this->getPorcentajeIgv());
            $sentencia->bindParam(":p_sub_tot", $this->getSubTotal());
            $sentencia->bindParam(":p_igv", $this->getIgv());
            $sentencia->bindParam(":p_total", $this->getTotal());
            $sentencia->bindParam(":p_cod_usu", $this->getCodigoUsuario());
            $sentencia->bindParam(":p_det_vta", $this->getDetalleVenta());
            $sentencia->execute();
            
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function anularVenta($p_codigo_tipo_comprobante, $p_numero_serie, $p_numero_documento) {
        try {
            $sql = "
                    select * from f_anular_venta(:p_codigo_tipo_comprobante, :p_numero_serie, :p_numero_documento) as res;
                ";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_tipo_comprobante", $p_codigo_tipo_comprobante);
            $sentencia->bindParam(":p_numero_serie", $p_numero_serie);
            $sentencia->bindParam(":p_numero_documento", $p_numero_documento);
            $sentencia->execute();
            
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}
