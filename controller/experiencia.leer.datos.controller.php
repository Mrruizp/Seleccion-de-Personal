<?php

try {
    require_once '../logic/Experiencia.class.php';
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
    
//    $codEst = $_POST["p_cod_est"];
    $codExp = $_POST["p_cod_exp"];
    
    $objExperiencia = new Experiencia();
    $resultado = $objExperiencia->leerDatos($codExp);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


