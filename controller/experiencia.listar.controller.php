<?php

require_once '../logic/Experiencia.class.php';
require_once '../util/functions/Helper.class.php';

//$dni = $_POST["dniUsuarioSesion"];
//$dniSesion  = $_SESSION["s_doc_id"];

try {
    $objExperiencia = new Experiencia();
    $resultado = $objExperiencia->listar();
    Helper::imprimeJSON(200, "", $resultado);
//    echo '<pre>';
//    print_r($resultado);
//    echo '</pre>';
    } catch (Exception $exc) {
        Helper::imprimeJSON(500, $exc->getMessage(), "");
    }

