<?php

try {
    
    require_once '../logic/Estudios.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_institucion_educativa"]) ||
            empty($_POST["p_institucion_educativa"]) ||
            
            !isset($_POST["p_titulo_estudios"]) ||
            empty($_POST["p_titulo_estudios"]) ||
            
            !isset($_POST["p_grado_estudio"]) ||
            empty($_POST["p_grado_estudio"]) ||
            
            !isset($_POST["p_fecha_inicio"]) ||
            empty($_POST["p_fecha_inicio"]) ||
            
            !isset($_POST["p_fecha_fin"]) ||
            empty($_POST["p_fecha_fin"]) 
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $Institucion    = $_POST["p_institucion_educativa"];
    $Titulo         = $_POST["p_titulo_estudios"];
    $Grado          = $_POST["p_grado_estudio"];
    $Fecha_I        = $_POST["p_fecha_inicio"];
    $Fecha_F        = $_POST["p_fecha_fin"];
    $tipoOperacion  = $_POST["p_tipo_ope"];
    
    $objEstudio = new Estudios();
    
    if ($tipoOperacion == "agregar"){
        $objEstudio->setInstitucion_educativa($Institucion);
        $objEstudio->setTitulo_estudio($Titulo);
        $objEstudio->setGrado_estudio($Grado);
        $objEstudio->setFecha_inicio($Fecha_I);
        $objEstudio->setFecha_fin($Fecha_F);
        $resultado = $objEstudio->agregar();
        if ($resultado){
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }else{ //Editar
        
        if  (
                !isset($_POST["p_codigo_estudio"]) ||
                empty($_POST["p_codigo_estudio"]) 

            )
        {
                Helper::imprimeJSON(500, "Falta completar datos para editar", "");
                exit();
        }
        
        $codigo = $_POST["p_codigo_estudio"];
        $objEstudio->setCodigo_estudio($codigo);
        $objEstudio->setInstitucion_educativa($Institucion);
        $objEstudio->setTitulo_estudio($Titulo);
        $objEstudio->setGrado_estudio($Grado);
        $objEstudio->setFecha_inicio($Fecha_I);
        $objEstudio->setFecha_fin($Fecha_F);
        $resultado = $objEstudio->editar();
        if ($resultado){
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
