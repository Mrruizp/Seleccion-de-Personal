<?php

try {
    
    require_once '../logic/Prueba.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_prueba"]) ||
            empty($_POST["p_cod_prueba"])||
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codPrueba = $_POST["p_cod_prueba"];
    $tipoOperacion = $_POST["p_tipo_ope"];
    
    $objPrueba = new Prueba();
    
    if ($tipoOperacion == "agregar"){
        $objPrueba->setCod_prueba($codPrueba);
        $resultado = $objPrueba->calificarPrueba();
        if ($resultado){
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
    else{ //Editar
        
        if  (
                !isset($_POST["p_cod_calificacion_prueba"]) ||
                empty($_POST["p_cod_calificacion_prueba"]) 

            )
        {
                Helper::imprimeJSON(500, "Falta completar datos para editar", "");
                exit();
        }
        
        $codigo = $_POST["p_cod_calificacion_prueba"];
        $objPrueba->setCod_calificacion_prueba($codigo);
        $objPrueba->setCod_prueba($cod_prueba);
        $resultado = $objPrueba->editar();
        if ($resultado){
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
  //  Helper::imprimeJSON(500, $exc->getMessage(), "");
    Helper::imprimeJSON(200, "EXAMEN YA CALIFICADO", "");
}


