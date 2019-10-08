<?php
require_once 'validar.datos.sesion.view.php';
//      $dniSesion= $_SESSION["s_doc_id"] ;
//require_once '../logic/Sesion.class.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="../images/logo vicsac_completo.png">
        <title> RR. HH. | Gestionar Criterios de selección</title>
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
                    <h3></h3>
                    <ol class="breadcrumb">
                        <li><a href="menu.principal.view.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Criterios de Selección</li>
                        <!--<li class="active">User profile</li>-->
                    </ol>

<!--<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><img src="../images/actualizar_2.png"> AGREGAR </button>-->
                </section>  
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <section class="content-header">
                                    <h3>Criterios</h3>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><i class="fa fa-plus"> Agregar nuevo criterio </i></button>
                                </section>
                                <div class="box-body">
                                    <div id="listado"></div>
                                </div>
                            </div>
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
                                            <h4 class="modal-title" id="titulomodal">Crear Prueba</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <p>
                                                        <input type="hidden" value="" id="txtTipoOperacion" name="txtTipoOperacion">
                                                        Código <input type="text" 
                                                                      name="txtCodigo" 
                                                                      id="txtCodigo" 
                                                                      class="form-control input-sm text-bold" 
                                                                      readonly="">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <p>
                                                        Código Prueba
                                                        <select required="" name="cboPruebaa" id="cboPruebaa" class="form-control input-sm">

                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <p>
                                                        Mínimo <input type="number" 
                                                                      name="txtMinimo" 
                                                                      id="txtMinimo" 
                                                                      class="form-control input-sm text-bold">
                                                    </p>
                                                </div>
                                                <div class="col-xs-3">
                                                    <p>
                                                        Máximo <input type="number" 
                                                                      name="txtMaximo" 
                                                                      id="txtMaximo" 
                                                                      class="form-control input-sm text-bold">
                                                    </p>
                                                </div>
                                                <div class="col-xs-3">
                                                    <p>
                                                        Valoración <select required="" name="cboValoracion" id="cboValoracion" class="form-control input-sm">
                                                            <option>-</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-xs-3">
                                                    <p>
                                                        Estado <select required="" name="cboEstado" id="cboEstado" class="form-control input-sm">
                                                            <option>-</option>
                                                            <option value="Correcto">Correcto</option>
                                                            <option value="Incorrecto">Incorrecto</option>
                                                        </select>
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-warning" aria-hidden="true"><i class="fa fa-save"></i> Grabar</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar"><i class="fa fa-close"></i> Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </small>
                    <!-- FIN del formulario modal -->

                </section>

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
<!--        <script>
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
        </script>  -->

         <!--<script src="js/convocatoria.js" type="text/javascript"></script>-->
        <script src="js/prueba.js" type="text/javascript"></script>
<!--        <script src="js/puesto.js" type="text/javascript"></script>-->
        <script src="js/gestionar.criterio.admin.js" type="text/javascript"></script>
    </body>
</html>