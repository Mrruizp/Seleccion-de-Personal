<?php

require_once '../logic/ConvocatoriaConcluida.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objConvC = new ConvocatoriaConcluida();
    $resultado = $objConvC->listar();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

