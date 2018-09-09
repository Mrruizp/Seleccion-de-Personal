<?php

try {
    require_once '../logic/GestionarExperienciaRequerida.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_req"]) ||
            empty($_POST["p_cod_req"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codReq = $_POST["p_cod_req"];
    
    $objGestionarExperienciaRequerida = new GestionarExperienciaRequerida();
    $resultado = $objGestionarExperienciaRequerida->leerDatos($codReq);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


