<?php

try {
    require_once '../logic/GestionarConvocatoria.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_cod_cron"]) ||
            empty($_POST["p_cod_cron"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codCron = $_POST["p_cod_cron"];
    
    $objCron = new GestionarConvocatoria();
    $resultado = $objCron->leerDatosCronograma($codCron);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


