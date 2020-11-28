<?php

try {
    $email = $_POST["txtEmail"];
    $clave = $_POST["txtClave"];

    require_once '../logic/Sesion.class.php';
    require_once '../util/functions/Helper.class.php';
    /* Obtener los datos ingresados en el formulario */


    $objSesion = new Sesion();
    $objSesion->setEmail($email);
    $objSesion->setClave($clave);

    $resultado = $objSesion->iniciarSesion();

    //echo $resultado;

    switch ($resultado) {

        case "CI": //Contraseña incorrecta
            Helper::mensaje("La Contraseña es incorrecta", "e", "../view/index.php", 5);
            break;
        
        case "IN": //usuario inactivo
            Helper::mensaje("El usuario esta inactivo. Consulte con su administrador", "a", "../view/index.php", 5);
            break;
        
        case "NE": //usuario no existe
            Helper::mensaje("El usuario no existe", "e", "../view/index.php", 5);
            break;
//        Helper::mensaje("Usuario inactivo", "a", "../view/index.php", 3);
        default:// SI
                    Helper::mensaje("Verificación de Usuario y Contraseña CORRECTA!<br/> Iniciando sesión ...", "s", "../view/menu.principal.view.php", 3);
                    //header("location:../view/menu.principal.view.php");
            break;
    }

} catch (Exception $exc) {
    echo $exc->getMessage();
}


