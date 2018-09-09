<?php

try {
    
    require_once '../logic/Experiencia.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_rubro_empresa"]) ||
            empty($_POST["p_rubro_empresa"]) ||

            !isset($_POST["p_empresa"]) ||
            empty($_POST["p_empresa"]) ||
            
            !isset($_POST["p_puesto"]) ||
            empty($_POST["p_puesto"]) ||
            
            !isset($_POST["p_lugar"]) ||
            empty($_POST["p_lugar"]) ||
            
            !isset($_POST["p_descripcion_laboral"]) ||
            empty($_POST["p_descripcion_laboral"]) ||
            
            !isset($_POST["p_motivo_cambio"]) ||
            empty($_POST["p_motivo_cambio"]) ||
            
            !isset($_POST["p_area"]) ||
            empty($_POST["p_area"]) ||
            
            !isset($_POST["p_duracion"]) ||
            empty($_POST["p_duracion"]) ||
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $Rubro_empresa            = $_POST["p_rubro_empresa"];
    $Empresa                  = $_POST["p_empresa"];
    $Puesto                   = $_POST["p_puesto"];
    $Lugar                    = $_POST["p_lugar"];
    $Descripcion_laboral      = $_POST["p_descripcion_laboral"];
    $Motivo_cambio            = $_POST["p_motivo_cambio"];
    $Area                     = $_POST["p_area"];
    $duracion                 = $_POST["p_duracion"];
    $tipoOperacion            = $_POST["p_tipo_ope"];
    
    $objExperiencia = new Experiencia();
    
    if ($tipoOperacion == "agregar"){
        $objExperiencia->setRubro_empresa($Rubro_empresa);
        $objExperiencia->setEmpresa($Empresa);
        $objExperiencia->setPuesto($Puesto);
        $objExperiencia->setLugar($Lugar);
        $objExperiencia->setDescripcion_laboral($Descripcion_laboral);
        $objExperiencia->setMotivo_cambio($Motivo_cambio);
        $objExperiencia->setArea($Area);
        $objExperiencia->setDuracion($duracion);
        $resultado = $objExperiencia->agregar();
        if ($resultado){
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }else{ //Editar
        
        if  (
                !isset($_POST["p_cod_experiencia_laboral"]) ||
                empty($_POST["p_cod_experiencia_laboral"]) 

            )
        {
                Helper::imprimeJSON(500, "Falta completar datos para editar", "");
                exit();
        }
        
        $codigo = $_POST["p_cod_experiencia_laboral"];
        $objExperiencia->setCodigo_experiencia_laboral($codigo);
        $objExperiencia->setRubro_empresa($Rubro_empresa);
        $objExperiencia->setEmpresa($Empresa);
        $objExperiencia->setPuesto($Puesto);
        $objExperiencia->setLugar($Lugar);
        $objExperiencia->setDescripcion_laboral($Descripcion_laboral);
        $objExperiencia->setMotivo_cambio($Motivo_cambio);
        $objExperiencia->setArea($Area);
        $objExperiencia->setDuracion($duracion);
        $resultado = $objExperiencia->editar();
        if ($resultado){
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
