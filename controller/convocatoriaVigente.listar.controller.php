<?php

require_once '../logic/ConvocatoriaVigente.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objConvV = new ConvocatoriaVigente();
    $resultado = $objConvV->listar();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

