<?php

require_once '../logic/Venta.class.php';
require_once '../util/functions/Helper.class.php';

if (! isset($_POST["p_datos_formulario"]) ){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

$datosFormulario = $_POST["p_datos_formulario"];
$datosJSONDetalle = $_POST["p_datosJSONDetalle"];

//echo $datosFormulario;

//Convertir todos los datos que llegan concatenados en array
parse_str($datosFormulario, $datosFormularioArray);

//print_r($datosFormularioArray);
//exit;


try {
    $objVenta = new Venta();
    $objVenta->setCodigoTipoComprobante( $datosFormularioArray["cbotipocomp"]);
    $objVenta->setNumeroSerie( $datosFormularioArray["cboserie"]);
    $objVenta->setCodigoCliente( $datosFormularioArray["txtcodigocliente"]);
    $objVenta->setFechaVenta( $datosFormularioArray["txtfec"]);
    $objVenta->setPorcentajeIgv( $datosFormularioArray["txtigv"]);
    $objVenta->setSubTotal( $datosFormularioArray["txtimportesubtotal"]);
    $objVenta->setIgv( $datosFormularioArray["txtimporteigv"]);
    $objVenta->setTotal( $datosFormularioArray["txtimporteneto"]);
    $objVenta->setCodigoUsuario( $datosFormularioArray["txtcodusu"] ); //Pendiente de cambiar
    $objVenta->setDetalleVenta( $datosJSONDetalle ); 
    
    $resultado = $objVenta->registrarVenta();
    
    if ($resultado["nc"] > 0){
        Helper::imprimeJSON(200, "La venta ha sido registrada correctamente", $resultado);
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}





