<?php
    require_once '../logic/Producto.class.php';
    $obj = new Producto();
    
    /*Obtiene el valor de busqueda*/
    $valorBusqueda = $_GET["term"];
    $resultado = $obj->cargarDatosProducto($valorBusqueda);

    /*Variable para elaborar el resultado que se imprime en formato JSON*/
    $datos = array();
    for ($i = 0; $i < count($resultado); $i++) {
        $registro = array
                (
                    "label" => $resultado[$i]["nombre"],
                    "value" => array
                        (
                            "codigo" => $resultado[$i]["codigo_producto"],
                            "nombre" => $resultado[$i]["nombre"],
                            "precio" => $resultado[$i]["precio_venta"],
                            "stock" => $resultado[$i]["stock"],
                            "presentacion" => $resultado[$i]["presentacion"]
                
                        
                        )
                );

        $datos[$i] = $registro;
    }

    header('Content-Type: application/json');
    echo json_encode($datos);
    
    


    