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
  
  <!-- AutoCompletar-->
  <link href="../util/plugins/autocomplete/jquery.ui.css" rel="stylesheet">
        
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <?php include_once 'menu-arriba.view.php'; ?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <?php include_once 'menu-izquierda.view.php';?>

      <!-- =============================================== -->

      
        <form id="frmgrabar">
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 class="text-bold text-black" style="font-size: 24px;">Registrar nueva venta</h1>
                    <ol class="breadcrumb">
                        <button type="button" class="btn btn-info btn-sm" id="btnregresar">Regresar</button>
			<button type="submit" class="btn btn-danger btn-sm">Registrar la venta</button>
                    </ol>
                </section>
		<small>
		    <section class="content">
                    <div class="box box-primary">
                        <div class="box-body">
                              <div class="row">
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Tipo comprobante</label>
                                        <select class="form-control input-sm" id="cbotipocomp" name="cbotipocomp" required="">
                                        </select>
                                      </div>
                                  </div>

                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Serie</label>
					    <select class="form-control input-sm" id="cboserie" name="cboserie" required="">
					    </select>
                                      </div>
                                  </div>

                                  <div class="col-xs-3">
                                      <div class="form-group">
                                        <label>Nº Comprobante</label>
                                        <input type="text" class="form-control input-sm" id="txtnrocom" name="txtnrocom" required=""/>
                                      </div>
                                  </div>

                                  <div class="col-xs-3">
                                      <div class="form-group">
                                        <label>Fecha de venta</label>
                                        <input type="date" class="form-control input-sm" id="txtfec" name="txtfec" required="" value="<?php echo date('Y-m-d'); ?>"/>
                                      </div>
                                  </div>
                              </div><!-- /row -->
                              <div class="row">
                                  <div class="col-xs-9">
                                      <div class="form-group">
                                        <label>Cliente (Digite las iniciales de los apellidos o nombres del cliente)</label>
                                        <input type="text" class="form-control input-sm" id="txtnombrecliente" required="">
                                      </div>
                                  </div>
                                  <div class="col-xs-3">
                                      <div class="form-group">
                                        <label>IGV</label>
                                        <input type="text" class="form-control input-sm" id="txtigv" name="txtigv" required="">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-1">
                                      <div class="form-group">
                                        <label>Código</label>
                                        <input type="text" class="form-control input-sm" id="txtcodigocliente" name="txtcodigocliente" readonly="">
                                      </div>
                                  </div>
                                  <div class="col-xs-5">
                                      <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" class="form-control input-sm" id="lbldireccioncliente" readonly="">
                                      </div>
                                  </div>
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Teléfono</label>
                                        <input type="text" class="form-control input-sm" id="lbltelefonocliente" readonly="">
                                      </div>
                                  </div>

                              </div>
                          <!-- /row -->
                          </div>
                    </div>
                    
                    
                    <div class="box box-primary">
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-xs-4">
                                      <div class="form-group">
                                        <label>Digite las iniciales de un producto que desea buscar</label>
                                        <input type="text" class="form-control input-sm" id="txtproducto" />
                                        <input type="hidden" id="txtcodigoproducto" />
                                        <input type="hidden" id="txtcodusu" name="txtcodusu" value="<?php echo $codigoUsuarioSesion; ?>" />
                                      </div>
                                  </div>
                                  <div class="col-xs-1">
                                      <div class="form-group">
                                        <label>Present.</label>
                                        <input type="text" class="form-control input-sm" id="txtpresentacion" readonly="" />
                                      </div>
                                  </div>
                                  <div class="col-xs-1">
                                      <div class="form-group">
                                        <label>Stock</label>
                                        <input type="text" class="form-control input-sm" id="txtstock" readonly="" />
                                      </div>
                                  </div>
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Precio</label>
                                        <input type="text" class="form-control input-sm" id="txtprecio" readonly="" />
                                      </div>
                                  </div>
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Unidad</label>
                                        <select class="form-control input-sm" id="cbounidad" name="cbounidad">
                                            
                                        </select>
                                      </div>
                                  </div>
                                  <div class="col-xs-1">
                                      <div class="form-group">
                                        <label>Cantidad</label>
                                        <input type="text" class="form-control input-sm" id="txtcantidad" />
                                      </div>
                                  </div>
                                  <div class="col-xs-1">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                        <br>
                                        <button type="button" class="btn btn-danger btn-sm" id="btnagregar">Agregar</button>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-12">
                                      <table id="tabla-listado" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>CÓDIGO</th>
                                                <th>PRODUCTO</th>
                                                <th style="text-align: right">PRECIO</th>
                                                <th style="text-align: right">CANTIDAD</th>
                                                <th style="text-align: center">UNI</th>
                                                <th style="text-align: right">IMPORTE</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody id="detalleventa">
                                            
                                        </tbody>
                                            
                                        
                                        
                                    </table>
                                  </div>
                              </div>
                          </div>
                    </div>
                    <div class="box box-primary">
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <div class="input-group">
                                        <span class="input-group-addon">SUB.TOTAL:</span>
                                        <input type="text" class="form-control text-right text-bold" id="txtimportesubtotal" name="txtimportesubtotal" readonly="" style="width: 100px; z-index: 0;" />
                                      </div>
                                  </div>
                                  <div class="col-xs-3">
                                      <div class="input-group">
                                        <span class="input-group-addon">IGV:</span>
                                        <input type="text" class="form-control text-right text-bold" id="txtimporteigv" name="txtimporteigv" readonly="" style="width: 100px; z-index: 0;"/>
                                      </div>
                                  </div>
                                  <div class="col-xs-3">
                                      <div class="input-group">
                                        <span class="input-group-addon">NETO A PAGAR:</span>
                                        <input type="text" class="form-control text-right text-bold" id="txtimporteneto" name="txtimporteneto" readonly="" style="width: 100px; z-index: 0;"/>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                    
                </section>
		</small>
            </div>
        </form>

      <?php include_once 'pie.view.php'; ?>

      <!-- Control Sidebar -->
      <?php include_once 'opciones-derecha.view.php'; ?>
      <!-- /.control-sidebar -->
      <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <?php include_once 'scripts.view.php'; ?>
    
    <!-- AutoCompletar -->
    <script src="js/unidad.medida.js" type="text/javascript"></script>
    
    <script src="../util/plugins/autocomplete/jquery.ui.autocomplete.js"></script>
    <script src="../util/plugins/autocomplete/jquery.ui.js"></script>
    <script src="js/cliente.autocompletar.js" type="text/javascript"></script>
    <script src="js/producto.autocompletar.js" type="text/javascript"></script>
    
    <script src="js/tipo.comprobante.js" type="text/javascript"></script>
    <script src="js/serie.js" type="text/javascript"></script>
    <script src="js/parametro.js" type="text/javascript"></script>
    <script src="js/venta.agregar.js" type="text/javascript"></script>
    
</body>
</html>