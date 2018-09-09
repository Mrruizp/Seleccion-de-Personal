<?php
    require_once '../logic/Cliente.class.php';
    $obj = new Cliente();
    
    /*Obtiene el valor de busqueda*/
    $valorBusqueda = $_GET["term"];
    $resultado = $obj->cargarDatosCliente($valorBusqueda);

    /*Variable para elaborar el resultado que se imprime en formato JSON*/
    $datos = array();
    for ($i = 0; $i < count($resultado); $i++) {
        $registro = array
                (
                    "label" => $resultado[$i]["nombre"],
                    "value" => array
                        (
                            "codigo" => $resultado[$i]["codigo_cliente"],
                            "nombre" => $resultado[$i]["nombre"],
                            "direccion" => $resultado[$i]["direccion"],
                            "telefono" => $resultado[$i]["telefono"]
                        )
                );

        $datos[$i] = $registro;
    }

    header('Content-Type: application/json');
    echo json_encode($datos);
    
    


    