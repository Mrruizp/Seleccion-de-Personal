<?php

require_once '../logic/Producto.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $obj = new Producto();
    if 
        (
            !isset($_POST["p_cod_pro"]) ||
            empty($_POST["p_cod_pro"])
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $p_cod_pro = $_POST["p_cod_pro"];
    $resultado = $obj->obtenerUnidadMedida($p_cod_pro);
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

