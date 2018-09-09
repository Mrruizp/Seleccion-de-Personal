<?php

try {
    require_once '../logic/GestionarPregunta.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_pregunta"]) ||
            empty($_POST["p_codigo_pregunta"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codPreg = $_POST["p_codigo_pregunta"];
    
    $objGestionarPregunta = new GestionarPregunta();
    $resultado = $objGestionarPregunta->leerDatos($codPreg);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


