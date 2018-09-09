<?php

try {
    require_once '../logic/Venta.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_tipo_comprobante"]) ||
            empty($_POST["p_codigo_tipo_comprobante"]) ||
                    
            !isset($_POST["p_numero_serie"]) ||
            empty($_POST["p_numero_serie"]) ||
            
            !isset($_POST["p_numero_documento"]) ||
            empty($_POST["p_numero_documento"]) 
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codigo_tipo_comprobante    = $_POST["p_codigo_tipo_comprobante"];
    $numero_serie               = $_POST["p_numero_serie"];
    $numero_documento           = $_POST["p_numero_documento"];
    
    
    $objVenta = new Venta();
    $resultado = $objVenta->anularVenta( $codigo_tipo_comprobante, $numero_serie, $numero_documento );
    
    if ($resultado["res"]==1){
        Helper::imprimeJSON(200, "La venta ha sido anulada correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


