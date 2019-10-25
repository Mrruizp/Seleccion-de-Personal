<?php

try {
    require_once '../logic/Experiencia.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_experiencia_candidato"]) ||
            empty($_POST["p_cod_experiencia_candidato"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codExp = $_POST["p_cod_experiencia_candidato"];
    
    $objExperiencia = new Experiencia();
    $objExperiencia->setCodigo_experiencia_candidato($codExp);
    $resultado = $objExperiencia->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


