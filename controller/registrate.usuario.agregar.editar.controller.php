<?php
    
    try {

    require_once '../logic/registrate.usuario.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_doc_ident"]) ||
            empty($_POST["p_doc_ident"]) ||
            
            !isset($_POST["p_nombres"]) ||
            empty($_POST["p_nombres"]) ||
            
            !isset($_POST["p_apellidos"]) ||
            empty($_POST["p_apellidos"]) ||
            
            !isset($_POST["p_direccion"]) ||
            empty($_POST["p_direccion"]) ||
            
            !isset($_POST["p_estado_civil"]) ||
            empty($_POST["p_estado_civil"]) ||
            
            !isset($_POST["p_departamento"]) ||
            empty($_POST["p_departamento"]) ||
            
            !isset($_POST["p_ciudad"]) ||
            empty($_POST["p_ciudad"]) ||
            
            !isset($_POST["p_email"]) ||
            empty($_POST["p_email"]) ||
            
            !isset($_POST["p_telefono"]) ||
            empty($_POST["p_telefono"]) ||
            
            !isset($_POST["p_sexo"]) ||
            empty($_POST["p_sexo"]) ||
            
            !isset($_POST["p_edad"]) ||
            empty($_POST["p_edad"]) ||
            
            !isset($_POST["p_hijo"]) ||
            empty($_POST["p_hijo"]) ||
            
            !isset($_POST["p_contrasenia"]) ||
            empty($_POST["p_contrasenia"]) ||
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) 
        {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

    $Dni                = $_POST["p_doc_ident"];
    $Nombres            = $_POST["p_nombres"];
    $Apellidos          = $_POST["p_apellidos"];
    $Direccion          = $_POST["p_direccion"];
    $estado_civil       = $_POST["p_estado_civil"];
    $txtDepartamento    = $_POST["p_departamento"];
    $txtProvincia       = $_POST["p_ciudad"];
    $txtEmail           = $_POST["p_email"];
    $txtTelefono        = $_POST["p_telefono"];
    $sexo               = $_POST["p_sexo"];
    $edad               = $_POST["p_edad"];
    $hijo               = $_POST["p_hijo"];
    $contrasenia        = $_POST["p_contrasenia"];
    $tipoOperacion      = $_POST["p_tipo_ope"];

    $objRegistrarUsuario = new registrateUsuario();

    if ($tipoOperacion == "agregar") {
        $objRegistrarUsuario->setDni($Dni);
        $objRegistrarUsuario->setNombres($Nombres);
        $objRegistrarUsuario->setApellidos($Apellidos);
        $objRegistrarUsuario->setDireccion($Direccion);
        $objRegistrarUsuario->setEstado_civil($estado_civil);
        $objRegistrarUsuario->setTxtDepartamento($txtDepartamento);
        $objRegistrarUsuario->setTxtProvincia($txtProvincia);
        $objRegistrarUsuario->setTxtEmail($txtEmail);
        $objRegistrarUsuario->setTxtTelefono($txtTelefono);
        $objRegistrarUsuario->setSexo($sexo);
        $objRegistrarUsuario->setEdad($edad);
        $objRegistrarUsuario->setHijo($hijo);
        $objRegistrarUsuario->setContrasenia($contrasenia);
        $resultado = $objRegistrarUsuario->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } 
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


