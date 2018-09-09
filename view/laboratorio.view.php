<?php
    require_once 'validar.datos.sesion.view.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Farmacia | Laboratorios</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include_once 'estilos.view.php'; ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <?php include_once 'menu-arriba.view.php'; ?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <?php include_once 'menu-izquierda.view.php';?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h3>Laboratorios</h3>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><i class="fa fa-copy"></i> Agregar nuevo laboratorio</button>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
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
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p>
                                            Nombre <input type="text" 
                                                          name="txtNombre" 
                                                          id="txtNombre" 
                                                          required=""
                                                          class="form-control input-sm text-bold">
                                        </p>
                                    </div>
                                </div>
                              
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p>
                                            País
                                            <select required="" name="cboPais" id="cboPais" class="form-control input-sm">
                                                
                                            </select>
                                        </p>
                                    </div>
                                </div>
                          </div>
                          <div class="modal-footer">
                              <button type="submit" class="btn btn-success" aria-hidden="true"><i class="fa fa-save"></i> Grabar</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal" id="btncerrar"><i class="fa fa-close"></i> Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </form>
            </small>
            <!-- FIN del formulario modal -->
            
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
    
    <script src="js/pais.js" type="text/javascript"></script>
    <script src="js/laboratorio.js" type="text/javascript"></script>
    
</body>
</html>