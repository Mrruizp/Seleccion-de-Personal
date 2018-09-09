<?php

require_once '../logic/GestionarConvocatoria.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objGestionarConvocatoria = new GestionarConvocatoria();
    $resultado = $objGestionarConvocatoria->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

