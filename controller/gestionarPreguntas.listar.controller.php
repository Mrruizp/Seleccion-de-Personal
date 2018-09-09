<?php

require_once '../logic/GestionarPregunta.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objGestionarPregunta = new GestionarPregunta();
    $resultado = $objGestionarPregunta->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

