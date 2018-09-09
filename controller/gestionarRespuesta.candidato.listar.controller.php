<?php
try {
    require_once '../logic/Respuesta_candidato.class.php';
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
    $objRespuesta_candidato = new Respuesta_candidato();
    $resultado = $objRespuesta_candidato->listar($codPrueba);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}






