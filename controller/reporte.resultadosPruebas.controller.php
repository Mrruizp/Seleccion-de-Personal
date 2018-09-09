<?php

try {
    require_once '../logic/Reporte_resultadosPruebas.class.php';
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
    
    $cod_prueba = $_POST["p_cod_puest"];
    
    $objReporte_resultadosPruebas = new Reporte_resultadosPruebas();
    $resultado = $objReporte_resultadosPruebas->listar($cod_prueba);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


