<?php

try {
    
    require_once '../logic/Laboratorio.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_nom_lab"]) ||
            empty($_POST["p_nom_lab"]) ||
            
            !isset($_POST["p_cod_pais"]) ||
            empty($_POST["p_cod_pais"]) ||
                       
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $nombre = $_POST["p_nom_lab"];
    $codigoPais = $_POST["p_cod_pais"];
    $tipoOperacion = $_POST["p_tipo_ope"];
    
    $objLab = new Laboratorio();
    
    if ($tipoOperacion == "agregar"){
        $objLab->setNombre($nombre);
        $objLab->setCodigoPais($codigoPais);
        $resultado = $objLab->agregar();
        if ($resultado){
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }else{ //Editar
        
        if  (
                !isset($_POST["p_cod_lab"]) ||
                empty($_POST["p_cod_lab"]) 

            )
        {
                Helper::imprimeJSON(500, "Falta completar datos para editar", "");
                exit();
        }
        
        $codigo = $_POST["p_cod_lab"];
        $objLab->setCodigoLaboratorio($codigo);
        $objLab->setNombre($nombre);
        $objLab->setCodigoPais($codigoPais);
        $resultado = $objLab->editar();
        if ($resultado){
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
