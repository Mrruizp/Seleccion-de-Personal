<?php

require_once '../logic/Estudios.class.php';
require_once '../util/functions/Helper.class.php';

//$dni = $_POST["dniUsuarioSesion"];
//$dniSesion  = $_SESSION["s_doc_id"];

try {
    $objEst = new Estudios();
    $resultado = $objEst->listar();
    Helper::imprimeJSON(200, "", $resultado);
//    echo '<pre>';
//    print_r($resultado);
//    echo '</pre>';
    } catch (Exception $exc) {
        Helper::imprimeJSON(500, $exc->getMessage(), "");
    }

