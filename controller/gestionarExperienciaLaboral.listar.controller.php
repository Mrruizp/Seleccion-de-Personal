<?php

require_once '../logic/GestionarExperienciaLaboral.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objGestionarExperienciaLaboral = new GestionarExperienciaLaboral();
    $resultado = $objGestionarExperienciaLaboral->listar();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

