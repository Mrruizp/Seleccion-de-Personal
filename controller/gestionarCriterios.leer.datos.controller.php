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
    $resultado = $gestionarCriterios->leerDatos($codCrit);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


