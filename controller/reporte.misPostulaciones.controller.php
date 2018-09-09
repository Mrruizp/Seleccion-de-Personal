<?php

require_once '../logic/Reporte_misPostulaciones.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objReporte_misPostulaciones = new Reporte_misPostulaciones();
    $resultado = $objReporte_misPostulaciones->listar();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

