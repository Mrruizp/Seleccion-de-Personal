<?php

try {

    require_once '../logic/GestionarFormacionLaboral.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_nomb_for"])      ||
             empty($_POST["p_nomb_for"])      ||
            !isset($_POST["p_tipo_ope"])      ||
             empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

    $nombreFormacionLaboral     = $_POST["p_nomb_for"];
    $tipoOperacion              = $_POST["p_tipo_ope"];

    $objGestionarFormacionLaboral = new GestionarFormacionLaboral();

    if ($tipoOperacion == "agregar") {
        $objGestionarFormacionLaboral->setNombre_formacion_laboral($nombreFormacionLaboral);
        $resultado = $objGestionarFormacionLaboral->agregar();
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
        $objGestionarFormacionLaboral->setCodigo_formacion_laboral($codigo);
        $objGestionarFormacionLaboral->setNombre_formacion_laboral($nombreFormacionLaboral);
        $resultado = $objGestionarFormacionLaboral->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
