<?php

try {
    require_once '../logic/Prueba.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_prueba"]) ||
            empty($_POST["p_cod_prueba"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codPrueba = $_POST["p_cod_prueba"];
//    echo '<pre>';
//    echo print_r($codPrueba);
//    echo '</pre>';
    $objListarEvaluacionExamen = new Prueba();
    $resultado = $objListarEvaluacionExamen->listarEvaluacionExamenPregunta($codPrueba);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


