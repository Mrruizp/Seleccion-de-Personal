<?php

require_once '../logic/Serie.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $obj = new Serie();
    if 
        (
            !isset($_POST["p_tip_com"]) ||
            empty($_POST["p_tip_com"]) ||
            
            !isset($_POST["p_serie"]) ||
            empty($_POST["p_serie"])
                    
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $p_tip_com = $_POST["p_tip_com"];
    $p_serie = $_POST["p_serie"];
    
    $resultado = $obj->obtenerNumeroComprobante($p_tip_com, $p_serie);
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

