<?php
    require_once 'validar.datos.sesion.view.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Farmacia | Ventas</title>
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
            <h1>
              Registro de ventas<br>
            </h1>
            
            <form id="frm-lista" class="form-inline">
                <small>
                    <div class="row">
                        <div class="col-xs-12">
                            Desde: <input type="date" name="txtFecha1" id="txtFecha1" class="form-control" style="width:170px;" value="<?php echo date('Y-m-d'); ?>">
                            Hasta: <input type="date" name="txtFecha2" id="txtFecha2" class="form-control" style="width:170px;" value="<?php echo date('Y-m-d'); ?>">
                            <button type="button" class="btn btn-info btn-sm" id="btnFiltrar"><i class="fa fa-filter"></i> Filtrar</button>
                            <button type="button" class="btn btn-success btn-sm" id="btnagregar"><i class="fa fa-copy"></i> Nueva venta</button>
                        </div>
                    </div>
                </small>
            </form>
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
    
    <script src="js/venta.js" type="text/javascript"></script>
    
</body>
</html>