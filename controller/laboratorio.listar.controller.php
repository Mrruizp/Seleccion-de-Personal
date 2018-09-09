<?php

require_once '../logic/Laboratorio.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objLab = new Laboratorio();
    $resultado = $objLab->listar();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

