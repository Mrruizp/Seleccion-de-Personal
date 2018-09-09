<?php

require_once '../logic/GestionarExperienciaRequerida.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objGestionarExperienciaRequerida = new GestionarExperienciaRequerida();
    $resultado = $objGestionarExperienciaRequerida->listar();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

