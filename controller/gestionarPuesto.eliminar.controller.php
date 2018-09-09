<?php

try {
    require_once '../logic/GestionarPuesto.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_puesto_laboral"]) ||
            empty($_POST["p_codigo_puesto_laboral"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codPues = $_POST["p_codigo_puesto_laboral"];
    
    $objGestionarPuesto = new GestionarPuesto();
    $objGestionarPuesto->setCodigo_puesto_laboral($codPues);
    $resultado = $objGestionarPuesto->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


