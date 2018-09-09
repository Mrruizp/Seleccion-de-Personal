<?php

try {

    require_once '../logic/GestionarExperienciaRequerida.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_nomb_req"]) ||
            empty($_POST["p_nomb_req"]) ||
            !isset($_POST["p_dur"]) ||
            empty($_POST["p_dur"]) ||
            !isset($_POST["p_codigo_puesto"]) ||
            empty($_POST["p_codigo_puesto"]) ||
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

    $experiencia_requerida = $_POST["p_nomb_req"];
    $duracion = $_POST["p_dur"];
    $codigo_puesto_laboral = $_POST["p_codigo_puesto"];
    $tipoOperacion = $_POST["p_tipo_ope"];

    $objGestionarExperienciaRequerida = new GestionarExperienciaRequerida();

    if ($tipoOperacion == "agregar") {
        $objGestionarExperienciaRequerida->setExperiencia_requerida($experiencia_requerida);
        $objGestionarExperienciaRequerida->setDuracion($duracion);
        $objGestionarExperienciaRequerida->setCodigo_puesto_laboral($codigo_puesto_laboral);
        $resultado = $objGestionarExperienciaRequerida->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_cod_req"]) ||
                empty($_POST["p_cod_req"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_cod_req"];
        $objGestionarExperienciaRequerida->setCodigo_experiencia_requerida($codigo);
        $objGestionarExperienciaRequerida->setExperiencia_requerida($experiencia_requerida);
        $objGestionarExperienciaRequerida->setDuracion($duracion);
        $objGestionarExperienciaRequerida->setCodigo_puesto_laboral($codigo_puesto_laboral);
        $resultado = $objGestionarExperienciaRequerida->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
