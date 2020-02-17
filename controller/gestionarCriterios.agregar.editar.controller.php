<?php

try {
    
    require_once '../logic/gestionarCriterios.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_prueb"]) ||
            empty($_POST["p_cod_prueb"]) ||
            
            !isset($_POST["p_min"]) ||
            empty($_POST["p_min"]) ||
            
            !isset($_POST["p_max"]) ||
            empty($_POST["p_max"]) ||
            
            !isset($_POST["p_val"]) ||
            empty($_POST["p_val"]) ||
            
            !isset($_POST["p_est"]) ||
            empty($_POST["p_est"]) ||
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
            
        )
    {
            //Helper::imprimeJSON(500, "Falta completar datos Holis", "");
            //exit();
    }
    
    $codigo_prueba = $_POST["p_cod_prueb"];
    $min = $_POST["p_min"];
    $max = $_POST["p_max"];
    $val = $_POST["p_val"];
    $est = $_POST["p_est"];
    
    $tipoOperacion = $_POST["p_tipo_ope"];
    
    $objgestionarCriterios = new gestionarCriterios();
    
    if ($tipoOperacion == "agregar"){
        $objgestionarCriterios->setCodigo_prueba($codigo_prueba);
        $objgestionarCriterios->setMin($min);
        $objgestionarCriterios->setMax($max);
        $objgestionarCriterios->setVal($val);
        $objgestionarCriterios->setEst($est);
        
        $resultado = $objgestionarCriterios->agregar();
        if ($resultado){
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }else{ //Editar
        
        if  (
                !isset($_POST["p_cod_crit"]) ||
                empty($_POST["p_cod_crit"]) 

            )
        {
                Helper::imprimeJSON(500, "Falta completar datos para editar", "");
                exit();
        }
        
        $codigo = $_POST["p_cod_crit"];
        $objgestionarCriterios->setCodigo_criterio($codigo);
        $objgestionarCriterios->setCodigo_prueba($codigo_prueba);
        $objgestionarCriterios->setMin($min);
        $objgestionarCriterios->setMax($max);
        $objgestionarCriterios->setVal($val);
        $objgestionarCriterios->setEst($est);
        $resultado = $objgestionarCriterios->editar();
        if ($resultado){
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
