<?php
// lista el cronograma para el usuario administrador
// http://localhost:8070/seleccionPersonal_tesis_v2/seleccionPersonal/view/gestionarConvocatoria.view.php

require_once '../logic/GestionarConvocatoria.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objGestionarConvocatoria = new GestionarConvocatoria();
    $resultado = $objGestionarConvocatoria->listarCronograma();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

