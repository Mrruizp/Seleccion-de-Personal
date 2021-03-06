<?php
require_once 'validar.datos.sesion.view.php';
$_POST["s_usuario"] = $dniSesion;


require_once '../controller/perfil.usuario.leer.datos.controller.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="../images/logo vicsac_completo.png">
        <title> RR. HH. | Inicio</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include_once 'estilos.view.php'; ?>
    </head>

    <body class="hold-transition skin-blue-light sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php include_once './menu-arriba.admin.view.php'; ?>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <?php include_once 'menu-izquierda.admin.view.php'; ?>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Bienvenido 
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="menu.principal.view.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <!--        <li><a href="#">Examples</a></li>
                                <li class="active">User profile</li>-->
                    </ol>
                    <button type="button" style="display: none" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><i class="fa fa-copy"></i> Agregar nuevo laboratorio</button>
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
                                                    <div class="box box-primary">
                                                        <div class="box-body">
                                                            <div id="listado"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <p>
                                                        <input type="hidden" value="" id="txtTipoOperacion" name="txtTipoOperacion">
                                                        <input type="hidden" 
                                                               name="txtCodigo" 
                                                               id="txtCodigo" 
                                                               class="form-control input-sm text-bold" 
                                                               readonly="">
                                                    </p>
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
                            <div class="box box-primary">
                                <!-- Smart Wizard -->
                                <section class="">
                                    <!-- title row -->
                                    <div class="text-center">
                                        <div class="col-md-11 col-sm-11 col-xs-12">

                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <br/><br/>
                                    <!-- info row -->
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="x_title">
                                                <header class="text-center">
                                                    <label>
                                                        <img src="../images/logo_1.jpg" class="img-container">
                                                    </label>        
                                                    <label>
                                                        <h1><b>LA SELECCIÓN DE PERSONAL</b></h1>
                                                        <b>
                                                            Guía práctica para directivos y mandos<br/>
                                                            de las empresas.<br/><br/> 
                                                        </b>  
                                                    </label>
                                                </header>
                                                <br/>
                                                <section class="text-center"> 
                                                    <header>
                                                        <span class="section">

                                                        </span>
                                                    </header>
                                                </section>    
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <!-- /page content -->

                            <!-- footer content -->

                        </div>  
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="fotos/<?php echo $fotoUsuario; ?>" alt="User profile picture">
                                    <h3 class="profile-username text-center"><?php echo $resultado["nombre"] . ' ' . $resultado["apellidos"]; ?></h3>

                                    <p class="text-muted text-center"><?php echo $resultado["descripcion"]; ?></p>

                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>DNI</b> <a class="pull-right"><?php echo $resultado["doc_id"]; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>EMAIL</b> <a class="pull-right"><?php echo $resultado["email"]; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>TELÉFONO</b> <a class="pull-right"><?php echo $resultado["telefono"]; ?></a>
                                        </li>
                                    </ul>
                                    <a href="perfil.usuario.admin.view.php" class="btn btn-primary btn-block"><b>Editar</b></b></a>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- About Me Box -->
                            <!--          <div class="box box-primary">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">Estudios</h3>
                                        </div>
                                         /.box-header 
                                        <div class="box-body">
                                          <strong><i class="fa fa-graduation-cap margin-r-5"></i> Centro de Estudios</strong>
                            
                                          <p class="text-muted">
                                            B.S. in Computer Science from the University of Tennessee at Knoxville
                                          </p>
                            
                                          <hr>
                            
                                          <strong><i class="fa fa-map-marker margin-r-5"></i> Localidad</strong>
                            
                                          <p class="text-muted">Malibu, California</p>
                            
                                          <hr>
                            
                                          <strong><i class="fa fa-pencil margin-r-5"></i> Experiencia Laboral</strong>
                            
                                          <a href="perfil.usuario.view.php" class="btn btn-warning btn-block"><b>Mejora tu perfil profesional</b></b></a>
                            
                                          <hr>
                            
                                          <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                            
                                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                                        </div>
                                         /.box-body 
                                      </div>-->
                            <!-- /.box -->
                        </div>  
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#activity" data-toggle="tab">VIGENTE</a></li>
                                    <li><a href="#timeline" data-toggle="tab">CONCLUIDO</a></li>
                                    <li><a href="#resultadoCv" data-toggle="tab">RESULTADO CV</a></li>
                                    <li><a href="#resultadoPruebas" data-toggle="tab">RESULTADO DE PRUEBAS</a></li>
                                    <li><a href="#resultadosFinal" data-toggle="tab">RESULTADOS FINAL</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <!-- Post -->
                                        <div class="post">
                                            <div class="user-block">
                                                <span class="">
                                                    <a href="#">CONVOCATORIAS</a>
                                                </span>
                                            <!--<span class="description">Shared publicly - 7:30 PM today</span>-->
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box box-primary">
                                                        <div class="box-body">
                                                            <div id="listadoV"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.post -->
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="timeline">
                                        <div class="post">
                                            <div class="user-block">
                                                <span class="">
                                                    <a href="#">CONVOCATORIAS</a>
                                                </span>
                                            <!--<span class="description">Shared publicly - 7:30 PM today</span>-->
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box box-primary">
                                                        <div class="box-body">
                                                            <div id="listadoC"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="resultadoCv">
                                        <div class="post">
                                            <div class="user-block">
                                                <span class="">
                                                    <a href="#">CANDIDATOS APTOS Y NO APTOS PARA EVALUACIÓN</a>
                                                </span>
                                            <!--<span class="description">Shared publicly - 7:30 PM today</span>-->
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box box-primary">
                                                        <div class="box-body">
                                                            <div id="listadoCv"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="resultadoPruebas">
                                        <div class="post">
                                            <div class="user-block">
                                                <span class="">
                                                    <a href="#">LISTA DE PRUEBAS CON CANDIDATOS APROBADOS</a>
                                                </span>
                                            <!--<span class="description">Shared publicly - 7:30 PM today</span>-->
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box box-primary">
                                                        <div class="box-body">
                                                            <div id="listadoResulPruebas"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="resultadosFinal">
                                        <div class="post">
                                            <div class="user-block">
                                                <span class="">
                                                    <a href="#">RESULTADOS FINALES</a>
                                                </span>
                                            <!--<span class="description">Shared publicly - 7:30 PM today</span>-->
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box box-primary">
                                                        <div class="box-body">
                                                            <div id="listadoResulFinal"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </section>
                <section class="content">
                    <small>
                        <div class="modal fade" id="myModalA" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="titulomodal2">Título de la ventana</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="box box-primary">
                                                    <div class="box-body">
                                                        <div id="listadoP"></div>
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
                    </small>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <!-- /.content-wrapper -->

            <?php include_once 'pie.view.php'; ?>

            <!-- Control Sidebar -->
            <?php // include_once 'opciones-derecha.view.php'; ?>
            <!-- /.control-sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?php include_once 'scripts.view.php'; ?>
        <script src="js/convocatoriaVigente.js" type="text/javascript"></script>
        <script src="js/convocatoriaConcluida.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoCurriculo.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoPruebas.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoFinal.js" type="text/javascript"></script>
    </body>
</html>