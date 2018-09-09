<?php

require_once '../logic/Pais.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objPais = new Pais();
    $resultado = $objPais->cargarDatos();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

