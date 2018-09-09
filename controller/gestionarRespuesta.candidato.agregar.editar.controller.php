<?php

try {

    require_once '../logic/Respuesta_candidato.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_respuesta"]) ||
            empty($_POST["p_respuesta"]) ||
            
            !isset($_POST["p_codigo_pregunta"]) ||
            empty($_POST["p_codigo_pregunta"]) ||
            
            !isset($_POST["p_numPregunta"]) ||
            empty($_POST["p_numPregunta"]) ||
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

    $Respuesta = $_POST["p_respuesta"];
    $codPregunta = $_POST["p_codigo_pregunta"];
    $numero_pregunta = $_POST["p_numPregunta"];
    $tipoOperacion = $_POST["p_tipo_ope"];

    $objRespuesta_candidato = new Respuesta_candidato();

    if ($tipoOperacion == "editar") { //agregar
        $objRespuesta_candidato->setRespuesta($Respuesta);
        $objRespuesta_candidato->setCodPregunta($codPregunta);
        $objRespuesta_candidato->setNumPregunta($numero_pregunta);
        $resultado = $objRespuesta_candidato->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_cod_respuesta_candidato"]) ||
                empty($_POST["p_cod_respuesta_candidato"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_cod_respuesta_candidato"];
        $objRespuesta_candidato->setCodigo_respuesta_candidato($codigo);
        $objRespuesta_candidato->setRespuesta($Respuesta);
        $objRespuesta_candidato->setNumPregunta($numero_pregunta);
        $objRespuesta_candidato->setCodPregunta($codPregunta);
        $resultado = $objRespuesta_candidato->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
