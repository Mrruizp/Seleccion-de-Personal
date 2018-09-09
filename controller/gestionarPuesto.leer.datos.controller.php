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
    $resultado = $objGestionarPuesto->leerDatos($codPues);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


