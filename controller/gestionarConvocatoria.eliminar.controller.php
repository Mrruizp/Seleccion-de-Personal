<?php

try {
    require_once '../logic/GestionarConvocatoria.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_conv"]) ||
            empty($_POST["p_cod_conv"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codConv = $_POST["p_cod_conv"];
    
    $objGestionarConvocatoria = new GestionarConvocatoria();
    $objGestionarConvocatoria->setCodigo_convocatoria($codConv);
    $resultado = $objGestionarConvocatoria->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


