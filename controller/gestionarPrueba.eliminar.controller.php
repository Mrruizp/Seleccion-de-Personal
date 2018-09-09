<?php

try {
    require_once '../logic/GestionarPrueba.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_prueba"]) ||
            empty($_POST["p_codigo_prueba"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codPuesto= $_POST["p_codigo_prueba"];
    
    $objGestionarPrueba = new GestionarPrueba();
    $objGestionarPrueba->setCodigo_prueba($codPuesto);
    $resultado = $objGestionarPrueba->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


