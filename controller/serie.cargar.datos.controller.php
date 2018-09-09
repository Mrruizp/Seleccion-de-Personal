<?php

require_once '../logic/Serie.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $obj = new Serie();
    if 
        (
            !isset($_POST["p_cod_tip"]) ||
            empty($_POST["p_cod_tip"])
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $p_cod_tip = $_POST["p_cod_tip"];
    $resultado = $obj->cargarDatos($p_cod_tip);
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

