<?php
require_once 'validar.datos.sesion.view.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="../images/logo vicsac_completo.png">
        <title> RR. HH. | Gestionar Convocatoria</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include_once 'estilos.view.php'; ?>
    </head>

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
                        <li class="active">Convocatoria-Cronograma</li>
                        <!--<li class="active">User profile</li>-->
                    </ol>

<!--<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><img src="../images/actualizar_2.png"> AGREGAR </button>-->
                </section> 
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <section class="content-header">
                                    <h3>Convocatoria</h3>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><i class="fa fa-bullhorn"></i> Agregar nueva convocatoria</button>
                                </section>
                                <div class="box-body">
                                    <div id="listado"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <section class="content-header">
                                    <h3>Cronograma</h3>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal2" id="btnagregar2"><i class="fa fa-calendar-o"></i> Agregar nuevo cronograma</button>
                                </section>
                                <div class="box-body">
                                    <div id="listado2"></div>
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
                                            <h4 class="modal-title" id="titulomodal">Crear Convocatoria</h4>
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
                                                <div class="col-xs-8">
                                                    <p>
                                                        Nombre de la Convocatoria <textarea type="text" 
                                                                                            name="txtNombreConvocatoria" 
                                                                                            id="txtNombreConvocatoria" 
                                                                                            rows="5"
                                                                                            required=""
                                                                                            class="form-control input-sm text-bold"></textarea>
                                                    </p>
                                                </div>
                                                <div class="col-xs-4">
                                                    <p>
                                                        Estado
                                                        <select required="" name="txtEstado" id="txtEstado" class="form-control input-sm">
                                                            <option>-</option>
                                                            <option value="VIGENTE">VIGENTE</option>
                                                            <option value="CONCLUIDO">CONCLUIDO</option>
                                                            <option value="NO PUBLICADO">NO PUBLICADO</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" aria-hidden="true"><i class="fa fa-save"></i> Grabar</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar"><i class="fa fa-close"></i> Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </small>
                    <!-- FIN del formulario modal -->
                    <!-- INICIO del formulario cronograma modal -->
                    <!--                    <div class="row">
                                            <div class="col-md-12">
                                                <div class="box box-primary">
                                                    <section class="content-header">
                                                        <h3>Cronograma</h3>
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal2" id="btnagregar2"><i class="fa fa-calendar-o"></i> Agregar nuevo cronograma</button>
                                                    </section>
                                                    <div class="box-body">
                                                        <div id="listado2"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                    <small>
                        <form id="frmgrabar2">
                            <div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="titulomodal2">Agregar nuevo cronograma</h4>
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
                                                <div class="col-xs-6">
                                                    <p>
                                                        Código Convocatoria
                                                        <select required="" name="cboConvocatoria" id="cboConvocatoria" class="form-control input-sm">

                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p>
                                                        Etapa:
                                                        <select required="" name="cboEtapa" id="cboEtapa" class="form-control input-sm">
                                                            <option>-</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-xs-12">
                                                    <p>
                                                        Fecha <input type="text" 
                                                                     name="txtFecha" 
                                                                     id="txtFecha" 
                                                                     required=""
                                                                     class="form-control input-sm text-bold">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="box box-primary">

                                                        Etapa: 1 
                                                        <div class="box-body">
                                                            En esta primera etapa se recepciona la postulación de los candidatos, para que luego el sistema evalúe el currículo y determine si está o no apto para ser sometido a evaluación.
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="box box-primary">

                                                        Etapa 2 
                                                        <div class="box-body">
                                                            En esta segunda etapa se muestra el resultado de las evaluaciones y se determina quién pasa a entrevista final realizado por la gerencia.
                                                        </div>
                                                    </div>            
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="box box-primary">

                                                        Etapa 3 
                                                        <div class="box-body">
                                                            En esta última etapa se publica el resultado de de la entrevista, dando como seleccionado al candidato idóneo al puesto de trabajo.                    
                                                        </div>
                                                    </div>            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" aria-hidden="true"><i class="fa fa-save"></i> Grabar</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar2"><i class="fa fa-close"></i> Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </small>
                    <!-- FIN del formulario cronograma modal -->

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
        <script src="js/convocatoria.js" type="text/javascript"></script>
        <script src="js/gestionarConvocatoria.js" type="text/javascript"></script>

    </body>
</html>