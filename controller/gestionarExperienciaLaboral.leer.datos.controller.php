<?php

try {
    require_once '../logic/GestionarExperienciaLaboral.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_exp"]) ||
            empty($_POST["p_cod_exp"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codExp = $_POST["p_cod_exp"];
    
    
    $objGestionarExperienciaLaboral = new GestionarExperienciaLaboral();
    $resultado = $objGestionarExperienciaLaboral->leerDatos($codExp);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


