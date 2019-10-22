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
                                                <p>DESCRIPCIÓN:</p>
                                                <ul>
                                                    Por encargo de nuestro cliente, nos encontramos en la búsqueda y selección de un <?php echo $resultado["nombre_puesto"]; ?>.
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p>OBJETIVO(s):</p>
                                                <ul>
                                                    <?php echo $resultado["objetivo_puesto"]; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p>FUNCIONES(s):</p>
                                                <ul>
                                                    <?php echo $resultado["funciones_puesto"]; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p>HORARIO
                                                
                                                    <?php echo $resultado["horario_trabajo"]; ?>
                                                
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p>CONDICIONES LABORALES:</p>
                                                <ul>
                                                    <?php echo $resultado["condiciones_trabajo"]; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p>RELACIONES INTERNAS:</p>
                                                <ul>
                                                    <?php echo $resultado["relaciones_sociales_internas"]; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p>RELACIONES EXTERNAS:</p>
                                                <ul>
                                                    <?php echo $resultado["relaciones_sociales_externas"]; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p>RESPONSABILIDADES:</p>
                                                <ul>
                                                    <?php echo $resultado["responsabilidades"]; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p>OBSERVACIONES FINALES:</p>
                                                <ul>
                                                    <?php echo $resultado["observaciones_finales"]; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p>EXPERIENCIA COMO:</p>
                                                <ul>
                                                    <?php echo $resultado["experiencia_requerida"]; ?>
                                                    <?php echo $resultado["duracion"]; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="row col-md-offset-4">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <?php
                                                if ($s_cargo == 'CANDIDATO') 
                                                    {
                                                        echo "<button type='button' class='btn btn-warning btn-ms col-md-6' aria-hidden='true' data-toggle='modal' data-target='#myModal' id='btnagregar'>Postular</button>";
                                                    }
                                            ?>
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