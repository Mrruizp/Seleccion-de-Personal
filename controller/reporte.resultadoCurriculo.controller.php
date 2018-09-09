<?php

require_once '../logic/Reporte_resultadoCurriculo.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objReporte_resultadoCurriculo = new Reporte_resultadoCurriculo();
    $resultado = $objReporte_resultadoCurriculo->listar();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

