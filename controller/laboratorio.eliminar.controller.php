<?php

try {
    require_once '../logic/Laboratorio.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_lab"]) ||
            empty($_POST["p_cod_lab"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codLab = $_POST["p_cod_lab"];
    
    $objLab = new Laboratorio();
    $objLab->setCodigoLaboratorio($codLab);
    $resultado = $objLab->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


