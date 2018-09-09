<?php

require_once '../logic/GestionarPrueba.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objGestionarPrueba = new GestionarPrueba();
    $resultado = $objGestionarPrueba->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

