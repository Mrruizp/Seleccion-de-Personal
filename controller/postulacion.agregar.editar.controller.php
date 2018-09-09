<?php

try {
    
    require_once '../logic/Postulacion.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_puesto"]) ||
            empty($_POST["p_codigo_puesto"]) ||                       
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codigoPuesto = $_POST["p_codigo_puesto"];
    $tipoOperacion = $_POST["p_tipo_ope"];
    
    $objPostulacion = new Postulacion();
    
    if ($tipoOperacion == "agregar"){
        $objPostulacion->setCodigoPuesto($codigoPuesto);
        $resultado = $objPostulacion->agregar();
        if ($resultado){
            Helper::imprimeJSON(200, "Usted ha postulado correctamente", "");
//            header ("Location: ../view/puestoSeleccionado.view.php"); 
        }
    }
//    else{ //Editar
//        
//        if  (
//                !isset($_POST["p_cod_lab"]) ||
//                empty($_POST["p_cod_lab"]) 
//
//            )
//        {
//                Helper::imprimeJSON(500, "Falta completar datos para editar", "");
//                exit();
//        }
//        
//        $codigo = $_POST["p_cod_lab"];
//        $objLab->setCodigoLaboratorio($codigo);
//        $objLab->setNombre($nombre);
//        $objLab->setCodigoPais($codigoPais);
//        $resultado = $objLab->editar();
//        if ($resultado){
//            Helper::imprimeJSON(200, "Agregado correctamente", "");
//        }
//    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, "USTED YA HA POSTULADO", "");
//    Helper::imprimeJSON($estado, $mensaje, $datos);
}
