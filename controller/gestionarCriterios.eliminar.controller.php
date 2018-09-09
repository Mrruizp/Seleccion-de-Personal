<?php

try {
    require_once '../logic/gestionarCriterios.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_crit"]) ||
            empty($_POST["p_cod_crit"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codCrit = $_POST["p_cod_crit"];
    
    $gestionarCriterios = new gestionarCriterios();
    $gestionarCriterios->setCodigo_criterio($codCrit);
    $resultado = $gestionarCriterios->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


