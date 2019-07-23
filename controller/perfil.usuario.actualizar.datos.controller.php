<?php

require_once '../util/functions/Helper.class.php';


/*
  echo '<pre>';
  echo 'Datos que llegan por POST';
  print_r($_POST);
  echo 'Datos que llegan por FILES';
  print_r($_FILES);
  echo '</pre>';
 */
//echo '<pre>';
//echo 'Datos que llegan por POST';
//print_r($_POST);
//echo '</pre>';
$dni = $_POST["txtDNI"];
$nombre = $_POST['txtNombres'];
$apellidos = $_POST['txtApellidos'];
$direccion = $_POST['txtDireccion'];
$celular = $_POST['txtTelefono'];
$hijos = $_POST['txtHijos'];
$departamento_nacimiento = $_POST['txtDepartamento'];
$ciudad_nacimiento = $_POST['txtCiudad'];
$estado_civil = $_POST['txtEstado_Civil'];
$sexo = $_POST['txtSexo'];
$edad = $_POST['txtEdad'];
$email = $_POST['txtEmail'];
//echo $dni;


$dbconn = pg_connect("host=localhost port=5432 dbname=seleccionpersonal_bd_v2 user=postgres password=1234")
        or die('NO HAY CONEXION: ' . pg_last_error());
$iddd = $dni;

//consulta sencilla

$query = "update candidato
                               set 
                                    doc_id = '$dni',
                                    nombre = '$nombre',
                                    apellidos = '$apellidos',
                                    direccion = '$direccion',
                                    telefono = '$celular',
                                    hijos = '$hijos',
                                    departamento_nacimiento = '$departamento_nacimiento',
                                    ciudad_nacimiento = '$ciudad_nacimiento',
                                    estado_civil = '$estado_civil',
                                    sexo = '$sexo',
                                    edad = '$edad',
                                    email = '$email'
                               where
                                       doc_id ='$dni';";


$result = pg_query($dbconn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$cmdtuples = pg_affected_rows($result);
Helper::mensaje("Se ha actualizado los datos", "s", "../view/perfil.usuario.admin.view.php", 4);


// Free resultset liberar los datos
pg_free_result($result);

// Closing connection cerrar la conexión
pg_close($dbconn);



if ($_FILES["fotoUsuario"]["name"] != "") {
    $tipo_archivo = $_FILES["fotoUsuario"]["type"];
    $direccion_subida = "../view/fotos/";

    $nombre_archivo_subir = $direccion_subida . $dni . ".png";

    /*
      if ($tipo_archivo == "image/png"){
      $nombre_archivo_subir = $direccion_subida . $dni . ".png";
      }else{
      $nombre_archivo_subir = $direccion_subida . $dni . ".jpg";
      }
     */

    $resultado_subida = move_uploaded_file($_FILES["fotoUsuario"]["tmp_name"], $nombre_archivo_subir);
    //$resultado_subida = true o false
    if ($resultado_subida) { //true
        Helper::mensaje("Se ha actualizado la foto del usuario", "s", "../view/principalAdmin.view.php", 5);
    }

    //if ($tipo_archivo)
} else {
    Helper::mensaje("No ha seleccionado la foto", "i");
}
        
