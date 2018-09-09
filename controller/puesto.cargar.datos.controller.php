<?php

require_once '../logic/Puesto.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objPuesto = new Puesto();
    $resultado = $objPuesto->cargarDatos();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

