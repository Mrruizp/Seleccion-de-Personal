<?php

try {

    require_once '../logic/GestionarConvocatoria.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_nom"]) ||
            empty($_POST["p_nom"]) ||
            !isset($_POST["p_est"]) ||
            empty($_POST["p_est"]) ||
            
//            !isset($_POST["p_fec1"]) ||
//            empty($_POST["p_fec1"]) ||
//            
//            !isset($_POST["p_fec2"]) ||
//            empty($_POST["p_fec2"]) ||
//            
//            !isset($_POST["p_fec3"]) ||
//            empty($_POST["p_fec3"]) ||
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) 
        {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

    $nombre_convocatoria = $_POST["p_nom"];
    $estado = $_POST["p_est"];
//    $fecha_cronograma1 = $_POST["p_fec1"];
//    $fecha_cronograma2 = $_POST["p_fec2"];
//    $fecha_cronograma3 = $_POST["p_fec3"];
    $tipoOperacion = $_POST["p_tipo_ope"];

    $objGestionarConv = new GestionarConvocatoria();

    if ($tipoOperacion == "agregar") {
        $objGestionarConv->setNombre_convocatoria($nombre_convocatoria);
        $objGestionarConv->setEstado($estado);
//        $objGestionarConv->setFecha_cronograma1($fecha_cronograma1);
//        $objGestionarConv->setFecha_cronograma2($fecha_cronograma2);
//        $objGestionarConv->setFecha_cronograma3($fecha_cronograma3);
        $resultado = $objGestionarConv->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_cod_conv"]) ||
                empty($_POST["p_cod_conv"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_cod_conv"];
        $objGestionarConv->setCodigo_convocatoria($codigo);
        $objGestionarConv->setNombre_convocatoria($nombre_convocatoria);
        $objGestionarConv->setEstado($estado);
//        $objGestionarConvocatoria->setFecha_cronograma1($fecha_cronograma1);
//        $objGestionarConvocatoria->setFecha_cronograma2($fecha_cronograma2);
//        $objGestionarConvocatoria->setFecha_cronograma3($fecha_cronograma3);
        $resultado = $objGestionarConv->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
