<?php

require_once '../logic/GestionarFormacionLaboral.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objGestionarFormacionLaboral = new GestionarFormacionLaboral();
    $resultado = $objGestionarFormacionLaboral->listar();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

