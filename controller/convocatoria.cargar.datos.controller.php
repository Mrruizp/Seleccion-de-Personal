<?php

require_once '../logic/Convocatoria.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objConvocatoria = new Convocatoria();
    $resultado = $objConvocatoria->cargarDatos();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

