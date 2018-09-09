<?php

require_once '../util/functions/Helper.class.php';
require_once '../logic/puestoSeleccionado.class.php';


//Haciendo lectura de la variable $_POST["dniUsuarioSesion"] que viene del archivo perfil.usuario.view.php
//$dni = $_POST["dniUsuarioSesion"];
$p_puesto_id = $_GET["id"];

try {
    $objpuestoSeleccionado = new puestoSeleccionado();
    $resultado = $objpuestoSeleccionado->leerDatos($p_puesto_id);
//    
//    echo '<pre>';
//    print_r($resultado);
//    echo '</pre>';
    
} catch (Exception $exc) {
    Helper::mensaje($exc->getMessage(), "e");
}

