<?php
require_once 'validar.datos.sesion.view.php';
//      $dniSesion= $_SESSION["s_doc_id"] ;
//require_once '../logic/Sesion.class.php';
$_POST["s_usuario"] = $dniSesion;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="../images/logo vicsac_completo.png">
        <title> RR. HH. | Estudios</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include_once 'estilos.view.php'; ?>
    </head>
    <style>
        #modal{
            padding: 0 0 0 220px;  
            width: 100% !important;
        }
    </style>
    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php include_once 'menu-arriba.admin.view.php'; ?>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <?php include_once 'menu-izquierda.admin.view.php'; ?>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h3>Mis Postulaciones</h3>
                    <ol class="breadcrumb">
                        <li><a href="menu.principal.view.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Mis Postulaciones</li>
                    </ol>

                </section>  
                <!-- Main content -->
                <section class="content">
                    <small>
                        <form id="frmgrabar">
                            <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="titulomodal">Título de la ventana</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box box-warning">
                                                        <div class="box-body">

                                                            <div id="listado"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
              <!--                              <button type="submit" class="btn btn-warning" aria-hidden="true"><i class="fa fa-save"></i> Grabar</button>-->
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar"><i class="fa fa-close"></i> Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </small>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-body">
                                    <div id="listadoMp"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-8">
                            <div class="box box-warning box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Pruebas</h3>

                                    <!--                                                            <div class="box-tools pull-right">
                                                                                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                                                                </div>-->
                                    <!-- /.box-tools -->
                                </div>
                               <br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModalCalifPruebas" id="btnagregarCalifPruebas"><i class="fa fa-pencil"> Evaluar Prueba </i></button>
                                <br/>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div id="listadoC"></div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!--                                                <div class="col-md-6">
                                                                            <div class="box box-primary">
                                                                                <div class="box-body">
                                                                                    <div id="listadoE"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                        <div class="col-md-4">
                                <div class="box box-warning box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Mis Respuestas</h3>

                                        <!--                                                            <div class="box-tools pull-right">
                                                                                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                                                                    </div>-->
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">

                                        <div id="respuestas"></div>

                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="box box-warning box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">EVALUACIÓN</h3>

                                    <!--                                                            <div class="box-tools pull-right">
                                                                                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                                                                </div>-->
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="col-xs-2 col-xs-offset-10">
                                        <p> <input type="text" 
                                                   name="timer" 
                                                   id="timer" 
                                                   class="form-control timer"
                                                   placeholder="0 sec" 
                                                   readonly="">
                                        </p>
                                    </div><br/><br/>

                                    <!--<h4 class="box-title">Información del examen</h4>-->
                                    <div id="examen"></div>
                                    <h4 class="box-title">Preguntas</h4>
                                    <div id="preguntas"></div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        
                        <small>
                            <form id="frmgrabarResp">
                                <div class="modal fade" id="myModalResp" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="titulomodal">Título de la ventana</h4>
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
                                                    <div class="col-xs-3">
                                                        <p>
                                                            Codigo Pregunta <input type="text" 
                                                                                   name="txtCodPregunta" 
                                                                                   id="txtCodPregunta" 
                                                                                   required=""
                                                                                   class="form-control input-sm text-bold">
                                                        </p>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <p>
                                                            Núm. Pregunta <input type="text" 
                                                                                 name="txtNumRespuesta" 
                                                                                 id="txtNumRespuesta" 
                                                                                 required=""
                                                                                 class="form-control input-sm text-bold">
                                                        </p>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <p>
                                                            Respuesta
                                                            <select required="" name="cboRespuesta" id="cboRespuesta" class="form-control input-sm">
                                                                <option>-</option>
                                                                <option value="a">a</option>
                                                                <option value="b">b</option>
                                                                <option value="c">c</option>
                                                                <option value="d">d</option>
                                                            </select>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-warning" aria-hidden="true"><i class="fa fa-save"></i> Grabar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal" id="btncerrarRc"><i class="fa fa-close"></i> Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </small>
                        <!-- INICIO del formulario modal -->
            <small>
                <form id="frmgrabarCalificarPrueba">
                    <div class="modal fade" id="myModalCalifPruebas" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="titulomodal">Título de la ventana</h4>
                          </div>
                          <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <p>
                                            <input type="hidden" value="" id="txtTipoOperacionn" name="txtTipoOperacionn">
                                            Código <input type="text" 
                                                          name="txtCodigo" 
                                                          id="txtCodigo" 
                                                          class="form-control input-sm text-bold" 
                                                          readonly="">
                                        </p>
                                    </div>
                                    <div class="col-xs-3">
                                        <p>
                                            Código Prueba<input type="text" 
                                                          name="txtCodPrueba" 
                                                          id="txtCodPrueba" 
                                                          required=""
                                                          class="form-control input-sm text-bold">
                                        </p>
                                    </div>
                                </div>
                          </div>
                          <div class="modal-footer">
                              <button type="submit" class="btn btn-warning" aria-hidden="true"><i class="fa fa-save"></i> Evaluar</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal" id="btncerrarCalifPruebas"><i class="fa fa-close"></i> Cerrar</button>
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
<!--        <script>
            (function () {
                $('.start-timer-btn').on('click', function(){
                    $('.timer').timer();
                });

            })();
        </script>-->
        <script src="js/reporte.misPostulaciones.js" type="text/javascript"></script>
        <!--<script src="js/gestionarRespuestaCandidato.js" type="text/javascript"></script>-->
    </body>
</html>