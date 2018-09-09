<?php

require_once '../logic/gestionarCriterios.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objgestionarCriterios = new gestionarCriterios();
    $resultado = $objgestionarCriterios->listar();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

