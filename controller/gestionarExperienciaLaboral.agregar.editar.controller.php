<?php

try {

    require_once '../logic/GestionarExperienciaLaboral.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_nomb_for"])      ||
             empty($_POST["p_nomb_for"])      ||
            !isset($_POST["p_nomb_exp"])      ||
             empty($_POST["p_nomb_exp"])      ||
            !isset($_POST["p_codigo_puesto"]) ||
             empty($_POST["p_codigo_puesto"]) ||
            !isset($_POST["p_tipo_ope"])      ||
             empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

    $nombreFormacionLaboral     = $_POST["p_nomb_for"];
    $nombreExperienciaLaboral   = $_POST["p_nomb_exp"];
    $codigo_puesto_laboral      = $_POST["p_codigo_puesto"];
    $tipoOperacion              = $_POST["p_tipo_ope"];

    $objGestionarExperienciaLaboral = new GestionarExperienciaLaboral();

    if ($tipoOperacion == "agregar") {
      //  $objGestionarExperienciaLaboral->setCodigo_formacion_laboral($nombreFormacionLaboral);
        $objGestionarExperienciaLaboral->setNombre_formacion_laboral($nombreFormacionLaboral);
        $objGestionarExperienciaLaboral->setNombre_experiencia_laboral($nombreExperienciaLaboral);
        $objGestionarExperienciaLaboral->setCodigo_puesto_laboral($codigo_puesto_laboral);
        $resultado = $objGestionarExperienciaLaboral->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_cod_for"]) ||
                empty($_POST["p_cod_for"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_cod_for"];
        $objGestionarExperienciaLaboral->setCodigo_formacion_laboral($codigo);
        $objGestionarExperienciaLaboral->setNombre_formacion_laboral($nombreFormacionLaboral);
        $objGestionarExperienciaLaboral->setNombre_experiencia_laboral($nombreExperienciaLaboral);
        $objGestionarExperienciaLaboral->setCodigo_puesto_laboral($codigo_puesto_laboral);
        $resultado = $objGestionarExperienciaLaboral->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
