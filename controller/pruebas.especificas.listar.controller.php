<?php

try {
    require_once '../logic/Prueba.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_pues"]) ||
            empty($_POST["p_cod_pues"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codPues = $_POST["p_cod_pues"];
    
    $objPrueba = new Prueba();
    $resultado = $objPrueba->listar($codPues);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


