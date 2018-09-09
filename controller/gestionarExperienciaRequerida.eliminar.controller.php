<?php

try {
    require_once '../logic/GestionarExperienciaRequerida.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_req"]) ||
            empty($_POST["p_cod_req"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codReq = $_POST["p_cod_req"];
    
    $objGestionarExperienciaRequerida = new GestionarExperienciaRequerida();
    $objGestionarExperienciaRequerida->setCodigo_experiencia_requerida($codReq);
    $resultado = $objGestionarExperienciaRequerida->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


