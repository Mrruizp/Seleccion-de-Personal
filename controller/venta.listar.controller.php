<?php

require_once '../logic/Venta.class.php';
require_once '../util/functions/Helper.class.php';

try {
    
    if 
        (
            !isset($_POST["p_fecha1"]) ||
            empty($_POST["p_fecha1"]) ||
            
            !isset($_POST["p_fecha2"]) ||
            empty($_POST["p_fecha2"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta enviar parametros", "");
            exit();
    }
    
    $fecha1 = $_POST["p_fecha1"];
    $fecha2 = $_POST["p_fecha2"];
    
    $objVenta = new Venta();
    $resultado = $objVenta->listar( $fecha1, $fecha2 );
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

