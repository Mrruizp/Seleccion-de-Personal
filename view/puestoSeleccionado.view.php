<?php
require_once 'validar.datos.sesion.view.php';

//Creando y asignando un valor a la variable $_POST["dniUsuarioSesion"];
$codigo_puesto = $_GET["id"];
//
require_once '../controller/puestoSeleccionado.leer.datos.controller.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="../images/logo vicsac_completo.png">
        <title> RR. HH. | Postulacion</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include_once 'estilos.view.php'; ?>
    </head>
    <style>
        #modal{
            padding: 0 0 0 220px;  
            width: 80% !important;
        }
    </style>
    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php include_once './menu-arriba.admin.view.php'; ?>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <?php include_once './menu-izquierda.admin.view.php'; ?>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <ol class="breadcrumb">
                        <li><a href="menu.principal.view.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Puesto de Trabajo</li>
                        <!--<li class="active">User profile</li>-->
                    </ol>
        <!--            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><img src="../images/actualizar_2.png"> Actualizar Información</button>-->
                </section> <br/> 
                <div class="pad margin no-print">
                    <div class="callout callout-info" style="margin-bottom: 0!important;">
                        <h4><i class="fa fa-info"></i> 
                            Sobre el aviso:
                        </h4>
                        <p>   
                            Para que uste pueda postular correctamente, 
                            debe registrar su <strong>hoja de vida</strong>, que se encuentra en 
                            el menú izquierdo.
                        </p>
                    </div>
                </div>
                <!-- Main content -->
                <section class="invoice">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <h2 class="page-header">
                                    <i class="fa fa-newspaper-o"></i> 
                                    <h2 class="text-center" style="color: #428bca">
                                        <strong>
                                            <?php echo $resultado["nombre_puesto"]; ?>
                                        </strong>
                                    </h2>
                                    <small class="pull-right text-danger"> Hoy: <?php echo date('d-m-y'); ?></small>
                                </h2>

                                <!-- /.box-header -->
                                <!-- form start enctype="multipart/form-data" -->
                                <!--<form role="form" enctype="multipart/form-data" action="../controller/perfil.usuario.actualizar.foto.datos.controller.php" method="post">-->
                                <div class="box-body col-md-offset-1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">DESCRIPCIÓN</label>
                                                <ul>
                                                    Por encargo de nuestro cliente, nos encontramos en la búsqueda y selección de un <?php echo $resultado["nombre_puesto"]; ?>.
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">OBJETIVO(s)</label>
                                                <ul>
                                                    <?php echo $resultado["objetivo_puesto"]; ?>.
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">CONDICIONES LABORALES </label>
                                                <ul>
                                                    <?php echo $resultado["condiciones_trabajo"]; ?>.
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">RELACIONES INTERNAS</label>
                                                <ul>
                                                    <?php echo $resultado["relaciones_sociales_internas"]; ?>.
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">RELACIONES EXTERNAS</label>
                                                <ul>
                                                    <?php echo $resultado["relaciones_sociales_externas"]; ?>.
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">RESPONSABILIDADES</label>
                                                <ul>
                                                    <?php echo $resultado["responsabilidades"]; ?>.
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">OBSERVACIONES FINALES</label>
                                                <ul>
                                                    <?php echo $resultado["observaciones_finales"]; ?>.
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">HORARIO</label>
                                                <ul>
                                                    <?php echo $resultado["horario_trabajo"]; ?>.
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">EXPERIENCIA COMO:</label>

                                                <?php
// conexion a la base de datos
                                                $dbconn = pg_connect("host=localhost port=5433 dbname=seleccionpersonal_bd_v2 user=postgres password=")
                                                        or die('NO HAY CONEXION: ' . pg_last_error());

//consulta sencilla
                                                $query = "select
                                                                experiencia_requerida,
                                                                duracion
                                                          from
                                                                experiencia_requerida 
                                                          where
                                                                codigo_puesto_laboral = $codigo_puesto;";
                                                $result = pg_query($query) or die('Query failed: ' . pg_last_error());

                                                $rows = pg_numrows($result);
//                                echo "<h1>cantidad de rows $rows </h1>";

                                                echo "<table border = 0 class=table table-bordered table-striped>\n";
//                                echo "<tr><td>ID<td>CEDULA<td>NOMBRE</tr>";
//mostrar los datos
                                                for ($i = 1; $i <= $rows; $i++) {
                                                    $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                                                    echo "\t<tr>\n";
                                                    echo "\t\t<td>$line[experiencia_requerida].</td>\n";
                                                    echo "\t\t<td>$line[duracion].</td>\n";
                                                    //                                echo "\t\t<td>$line[nombre]</td>\n";
                                                    echo "\t</tr>\n";
                                                }
                                                echo "</table>\n";
                                                echo "<hr>";
// Free resultset
                                                pg_free_result($result);
// Closing connection
//                                                    pg_close($dbconn);
                                                ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->

                                <div class="row col-md-offset-4">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <?php
//                                            session_name("seleccion_personal_v2");
//                                            session_start();
                                            if ($s_cargo == 'CANDIDATO') {
                                                echo "<button type='button' class='btn btn-warning btn-ms col-md-6' aria-hidden='true' data-toggle='modal' data-target='#myModal' id='btnagregar'>Postular</button>";
                                            }
                                            pg_close($dbconn);
                                            ?>
                                            <!--                                                <button type="submit" class="btn btn-warning col-md-6"> Postular </button>-->
                                        </div>
                                    </div>



                                    <!-- INICIO del formulario modal -->
                                    <small>
                                        <form id="frmgrabar">
                                            <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="titulomodal"></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-xs-3">
                                                                    <p class="text-bold">
                                                                        <input type="hidden" value="" id="txtTipoOperacion" name="txtTipoOperacion">
                                                                        Código 
                                                                    </p><input type="text" 
                                                                               name="txtPuesto" 
                                                                               id="txtPuesto" 
                                                                               class="form-control input-sm"
                                                                               value="<?php echo $resultado["codigo_puesto_laboral"]; ?>"
                                                                               readonly="">

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <div class="text-center">
                                                                        <div class="col-lg-12">

                                                                            <div class="col-xs-12">
                                                                                <img src="../images/justicia.gif" class="img-responsive avatar-body center-block">
                                                                            </div>

                                                                            <section>
                                                                                <div class="text-center">
                                                                                    <div class="col-sm-12">
                                                                                        <span  style="color: #FF0000"><b>ADVERTENCIA</b></span>
                                                                                        <section class="left col-xs-12 well profile_view">
                                                                                            <p class="text-justify">
                                                                                                Debe tomar en cuenta que la falsedad de la información esta penado según el artículo 438º del Código Penal;
                                                                                                donde la pena es: No menor de dos ni mayor de cuatro años.
                                                                                            </p>
                                                                                        </section>
                                                                                    </div>
                                                                                </div>
                                                                            </section>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-4">
                                                                    <p class="text-bold">
                                                                        ¿Desea postular? 
                                                                    </p>
                                                                    <select aria-required="true" class="form-control input-sm" required> 
                                                                        <option></option>
                                                                        <option value="SI">Si deseo posular</option>
                                                                    </select>
                                                                </div>                                                                    
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-warning" aria-hidden="true"><i class=""></i> Postular</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar"><i class="fa fa-close"></i> Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </small>
                                    <!-- FIN del formulario modal -->
                                </div><br/><br/>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <?php include_once 'pie.view.php'; ?>

            <!-- Control Sidebar -->
            <?php include_once 'opciones-derecha.view.php'; ?>
            <!-- /.control-sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?php include_once 'scripts.view.php'; ?>
        <script>
            $(function () {

                // We can attach the `fileselect` event to all file inputs on the page
                $(document).on('change', ':file', function () {
                    var input = $(this),
                            numFiles = input.get(0).files ? input.get(0).files.length : 1,
                            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                    input.trigger('fileselect', [numFiles, label]);
                });

                // We can watch for our custom `fileselect` event like this
                $(document).ready(function () {
                    $(':file').on('fileselect', function (event, numFiles, label) {

                        var input = $(this).parents('.input-group').find(':text'),
                                log = numFiles > 1 ? numFiles + ' files selected' : label;

                        if (input.length) {
                            input.val(log);
                        } else {
                            if (log)
                                alert(log);
                        }

                    });
                });

            });
        </script>    
        <script src="js/postulacion.js" type="text/javascript"></script>
    </body>
</html>