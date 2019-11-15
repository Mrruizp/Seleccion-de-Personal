<?php

try {

    require_once '../logic/GestionarExperienciaLaboral.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_cod_puesto"])          ||
             empty($_POST["p_cod_puesto"])          ||
            !isset($_POST["p_cod_formacion"])       ||
             empty($_POST["p_cod_formacion"])       ||
            !isset($_POST["p_duracion"])            ||
             empty($_POST["p_duracion"])            ||
            !isset($_POST["p_nombre_Experiencia"])  ||
             empty($_POST["p_nombre_Experiencia"])  ||            
            !isset($_POST["p_tipo_ope"])            ||
             empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

    $codigoPuestoLaboral        = $_POST["p_cod_puesto"];
    $codigoFormacionLaboral     = $_POST["p_cod_formacion"];
    $duracionExperienciaLaboral = $_POST["p_duracion"];
    $nombreExperienciaLaboral   = $_POST["p_nombre_Experiencia"];
    
    $tipoOperacion              = $_POST["p_tipo_ope"];

    $objGestionarExperienciaLaboral = new GestionarExperienciaLaboral();

    if ($tipoOperacion == "agregar") {
        $objGestionarExperienciaLaboral->setCodigo_puesto_laboral($codigoPuestoLaboral);
        $objGestionarExperienciaLaboral->setCodigo_formacion_laboral($codigoFormacionLaboral);
        $objGestionarExperienciaLaboral->setDuracion_experiencia_laboral($duracionExperienciaLaboral);
        $objGestionarExperienciaLaboral->setNombre_experiencia_laboral($nombreExperienciaLaboral);
        $resultado = $objGestionarExperienciaLaboral->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_cod_exp"]) ||
                empty($_POST["p_cod_exp"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_cod_exp"];
        $objGestionarExperienciaLaboral->setCodigo_puesto_laboral($codigoPuestoLaboral);
        $objGestionarExperienciaLaboral->setCodigo_formacion_laboral($codigoFormacionLaboral);
        $objGestionarExperienciaLaboral->setDuracion_experiencia_laboral($duracionExperienciaLaboral);
        $objGestionarExperienciaLaboral->setNombre_experiencia_laboral($nombreExperienciaLaboral);
        $resultado = $objGestionarExperienciaLaboral->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
