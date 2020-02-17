<?php

try {

    require_once '../logic/GestionarConvocatoria.class.php';
    require_once '../util/functions/Helper.class.php';

    if
        (
            !isset($_POST["p_fecha"]) ||
            empty($_POST["p_fecha"]) ||
            
            !isset($_POST["p_cod_conv"]) ||
            empty($_POST["p_cod_conv"]) ||
            
            !isset($_POST["p_cod_etapa"]) ||
            empty($_POST["p_cod_etapa"]) ||
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
        ) 
    {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

    $fecha = $_POST["p_fecha"];
    $codigo_convocatoria = $_POST["p_cod_conv"];
    $codigo_etapa = $_POST["p_cod_etapa"];
    $tipoOperacion = $_POST["p_tipo_ope"];
    
    

    $objCrono = new GestionarConvocatoria();

    if ($tipoOperacion == "agregar") {
        
        $objCrono->setFecha($fecha);
        $objCrono->setCodigo_convocatoria($codigo_convocatoria);
        $objCrono->setCodigo_etapa($codigo_etapa);
        $resultado = $objCrono->agregarCronograma();
        
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_cod_cron"]) ||
                empty($_POST["p_cod_cron"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_cod_cron"];
        $objCrono->setCodigo_cronograma($codigo);
        $objCrono->setFecha($fecha);
        $objCrono->setCodigo_convocatoria($codigo_convocatoria);
        $objCrono->setCodigo_etapa($codigo_etapa);
//        $objGestionarConvocatoria->setFecha_cronograma1($fecha_cronograma1);
//        $objGestionarConvocatoria->setFecha_cronograma2($fecha_cronograma2);
//        $objGestionarConvocatoria->setFecha_cronograma3($fecha_cronograma3);
        $resultado = $objCrono->editarCronograma();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
