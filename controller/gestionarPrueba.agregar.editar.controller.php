<?php

try {

    require_once '../logic/GestionarPrueba.class.php';
    require_once '../util/functions/Helper.class.php';
//    echo '<pre>';
//    echo $_POST;
//    echo '</pre>';
    if
    (
            !isset($_POST["p_nombre_prueba"]) ||
            empty($_POST["p_nombre_prueba"]) ||
            
            !isset($_POST["p_instruccion"]) ||
            empty($_POST["p_instruccion"]) ||
            
            !isset($_POST["p_duracion"]) ||
            empty($_POST["p_duracion"]) ||
            
            !isset($_POST["p_codigo_tipo_prueba"]) ||
            empty($_POST["p_codigo_tipo_prueba"]) ||
            
            !isset($_POST["p_codigo_puesto_laboral"]) ||
            empty($_POST["p_codigo_puesto_laboral"]) ||
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
    $nombre_prueb = $_POST["p_nombre_prueba"];
    $instruccion = $_POST["p_instruccion"];
    $duracion = $_POST["p_duracion"];
    $codigo_tipo_prueba = $_POST["p_codigo_tipo_prueba"];
    $codigo_puesto_labora = $_POST["p_codigo_puesto_laboral"];
    $tipoOperacion = $_POST["p_tipo_ope"];

    $objGestionarPrueba = new GestionarPrueba();

    if ($tipoOperacion == "agregar") {
        $objGestionarPrueba->setNombre_prueba($nombre_prueb);
        $objGestionarPrueba->setInstruccion($instruccion);
        $objGestionarPrueba->setDuracion($duracion);
        $objGestionarPrueba->setCodigo_tipo_prueba($codigo_tipo_prueba);
        $objGestionarPrueba->setCodigo_puesto_laboral($codigo_puesto_labora);
        $resultado = $objGestionarPrueba->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_prueba"]) ||
                empty($_POST["p_codigo_prueba"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_prueba"];
        $objGestionarPrueba->setCodigo_prueba($codigo);
        $objGestionarPrueba->setNombre_prueba($nombre_prueb);
        $objGestionarPrueba->setInstruccion($instruccion);
        $objGestionarPrueba->setDuracion($duracion);
        $objGestionarPrueba->setCodigo_tipo_prueba($codigo_tipo_prueba);
        $objGestionarPrueba->setCodigo_puesto_laboral($codigo_puesto_labora);
        $resultado = $objGestionarPrueba->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
