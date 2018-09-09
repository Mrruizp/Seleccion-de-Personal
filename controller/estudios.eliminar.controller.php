<?php

try {
    require_once '../logic/Estudios.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_est"]) ||
            empty($_POST["p_cod_est"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codEst = $_POST["p_cod_est"];
    
    $objEst = new Estudios();
    $objEst->setCodigo_estudio($codEst);
    $resultado = $objEst->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


