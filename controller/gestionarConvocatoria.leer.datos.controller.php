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
    
    $objGestionarCon = new GestionarConvocatoria();
    $resultado = $objGestionarCon->leerDatos($codConv);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


