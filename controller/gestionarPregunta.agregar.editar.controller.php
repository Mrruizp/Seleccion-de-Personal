<?php

try {

    require_once '../logic/GestionarPregunta.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_nombre_pregunta"]) ||
            empty($_POST["p_nombre_pregunta"]) ||
            
            !isset($_POST["p_puntaje_correcto"]) ||
            empty($_POST["p_puntaje_correcto"]) ||
            
            !isset($_POST["p_puntaje_incorrecto"]) ||
            empty($_POST["p_puntaje_incorrecto"]) ||
            
            !isset($_POST["p_respuesta"]) ||
            empty($_POST["p_respuesta"]) ||
            
            !isset($_POST["p_codigo_prueba"]) ||
            empty($_POST["p_codigo_prueba"]) ||
            
            !isset($_POST["p_numero_prueba"]) ||
            empty($_POST["p_numero_prueba"]) ||
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

    $nombre_pregunta = $_POST["p_nombre_pregunta"];
    $puntaje_correcto = $_POST["p_puntaje_correcto"];
    $puntaje_incorrecto = $_POST["p_puntaje_incorrecto"];
    $respuesta = $_POST["p_respuesta"];
//    $estado = $_POST["p_estado"];
    $codigo_prueba = $_POST["p_codigo_prueba"];
    $numero_pregunta = $_POST["p_numero_prueba"];
    $tipoOperacion = $_POST["p_tipo_ope"];

    $objGestionarPregunta = new GestionarPregunta();

    if ($tipoOperacion == "agregar") {
        $objGestionarPregunta->setNombre_pregunta($nombre_pregunta);
        $objGestionarPregunta->setPuntaje_correcto($puntaje_correcto);
        $objGestionarPregunta->setPuntaje_incorrecto($puntaje_incorrecto);
        $objGestionarPregunta->setRespuesta($respuesta);
        $objGestionarPregunta->setCodigo_prueba($codigo_prueba);
        $objGestionarPregunta->setNumero_pregunta($numero_pregunta);
        $resultado = $objGestionarPregunta->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_pregunta"]) ||
                empty($_POST["p_codigo_pregunta"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_pregunta"];
        $objGestionarPregunta->setCodigo_pregunta($codigo);
        $objGestionarPregunta->setNombre_pregunta($nombre_pregunta);
        $objGestionarPregunta->setPuntaje_correcto($puntaje_correcto);
        $objGestionarPregunta->setPuntaje_incorrecto($puntaje_incorrecto);
        $objGestionarPregunta->setRespuesta($respuesta);
        $objGestionarPregunta->setCodigo_prueba($codigo_prueba);
        $objGestionarPregunta->setNumero_pregunta($numero_pregunta);
        $resultado = $objGestionarPregunta->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
