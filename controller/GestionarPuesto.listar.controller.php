<?php

require_once '../logic/GestionarPuesto.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objGestionarPuesto = new GestionarPuesto();
    $resultado = $objGestionarPuesto->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

