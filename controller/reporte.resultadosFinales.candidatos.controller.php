<?php

try {
    require_once '../logic/Reporte_resultadosFinales.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_puest"]) ||
            empty($_POST["p_cod_puest"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codPrueba = $_POST["p_cod_puest"];
    
    $objReporte_resultadosFinales = new Reporte_resultadosFinales();
    $resultado = $objReporte_resultadosFinales->listar($codPrueba);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


