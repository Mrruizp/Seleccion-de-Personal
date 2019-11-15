<?php

try {
    require_once '../logic/GestionarExperienciaLaboral.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_for"]) ||
            empty($_POST["p_cod_for"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codForm = $_POST["p_cod_for"];
    
    $objGestionarExperienciaLaboral = new GestionarExperienciaLaboral();
    $objGestionarExperienciaLaboral->setCodigo_experiencia_laboral($codForm);
    $resultado = $objGestionarExperienciaLaboral->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


