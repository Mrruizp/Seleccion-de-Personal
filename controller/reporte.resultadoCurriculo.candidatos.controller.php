<?php

try {
    require_once '../logic/reporte_resultadoCurriculo_candidatos.class.php';
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
    
    $codPuest = $_POST["p_cod_puest"];
    
    $objReporte_resultadoCurriculo_candidatos = new reporte_resultadoCurriculo_candidatos();
    $resultado = $objReporte_resultadoCurriculo_candidatos->listar($codPuest);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


