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
                    <h3>Experiencia Laboral</h3>
                    <ol class="breadcrumb">
                        <li><a href="menu.principal.view.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Experiencia Laboral</li>
                        <!--<li class="active">User profile</li>-->
                    </ol>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><i class="fa fa-plus"> AGREGAR </i></button>
                    <!--<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><img src="../images/actualizar_2.png"> AGREGAR </button>-->
                </section>  
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning">
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
                                                    <p class="text-bold">
                                                        <input type="hidden" value="" id="txtTipoOperacion" name="txtTipoOperacion">
                                                        Código 
                                                    </p><input type="text" 
                                                               name="txtCodigo" 
                                                               id="txtCodigo" 
                                                               class="form-control input-sm" 
                                                               readonly="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <p class="text-bold">
                                                        Empresa<span>*</span>
                                                    </p>
                                                    <input type="text" 
                                                           name="txtEmpresa" 
                                                           id="txtEmpresa" 
                                                           maxlength="100"
                                                           required=""
                                                           class="form-control input-sm">
                                                </div>
                                                <div class="col-xs-6">
                                                    <p class="text-bold">
                                                        Rubro de la empresa<span>*</span>
                                                    </p>
                                                    <select size="1" class="form-control input-sm" id="txtRubro" name="txtRubro"> 
                                                        <option>-</option>
                                                        <option value="Agricultura / Pesca / Ganadería">Agricultura / Pesca / Ganadería</option>
                                                        <option value="Construcción / obras">Construcción / obras</option>
                                                        <option value="Educación">Educación</option>
                                                        <option value="Energía / Minería">Energía / Minería</option>
                                                        <option value="Entretenimiento / Deportes">Entretenimiento / Deportes</option>
                                                        <option value="Fabricación">Fabricación</option>
                                                        <option value="Finanzas / Banca">Finanzas / Banca</option>
                                                        <option value="Gobierno / No Lucro">Gobierno / No Lucro</option>
                                                        <option value="Hostelería / Turismo">Hostelería / Turismo</option>
                                                        <option value="Informática / Hardware">Informática / Hardware</option>
                                                        <option value="Informática / Software">Informática / Software</option>
                                                        <option value="Internet">Internet</option>
                                                        <option value="Legal / Asesoría">Legal / Asesoría</option>
                                                        <option value="Materias Primas">Materias Primas</option>
                                                        <option value="Medios de Comunicación">Medios de Comunicación</option>
                                                        <option value="Publicidad / RRPP">Publicidad / RRPP</option>
                                                        <option value="RRHH / Personal">RRHH / Personal</option>
                                                        <option value="Salud / Medicina">Salud / Medicina</option>
                                                        <option value="Servicios Profesionales">Servicios Profesionales</option>
                                                        <option value="Telecomunicaciones">Telecomunicaciones</option>
                                                        <option value="Transporte / Logística">Transporte / Logística</option>
                                                        <option value="Venta al consumidor">Venta al consumidor</option>
                                                        <option value="Venta al por mayor">Venta al por mayor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <p class="text-bold">
                                                        Cargo<span>*</span>
                                                    </p>
                                                    <select size="1" class="form-control input-sm" id="txtPuesto" name="txtPuesto"> 
                                                        <option>-</option>
                                                        <option value="Abogado especialista en constructoras">Abogado especialista en constructoras</option>
                                                        <option value="Administrador">Administrador</option>
                                                        <option value="Arquitecto especializado en puentes">Arquitecto especializado en puentes</option>
                                                        <option value="Arquitecto especializado en casas">Arquitecto especializado en casas</option>
                                                        <option value="Arquitecto especializado en interiores">Arquitecto especializado en interiores</option>
                                                        <option value="Asistente de costo y presupuesto">Asistente de costo y presupuesto</option>
                                                        <option value="Asistente de logística">Asistente de logística</option>
                                                        <option value="Consulta y atención de reclamos">Consulta y atención de reclamos</option>
                                                        <option value="Contador">Contador</option>
                                                        <option value="Ingeniero civil especialista en cálidad">Ingeniero civil especialista en cálidad</option>
                                                        <option value="Ingeniero civil especialista en carreteras">Ingeniero civil especialista en carreteras</option>
                                                        <option value="Ingeniero civil especialista en suelos">Ingeniero civil especialista en suelos</option>
                                                        <option value="Ingeniero civil especialista en medio ambiente">Ingeniero civil especialista en medio ambiente</option>
                                                        <option value="Ingeniero civil especialista en puentes">Ingeniero civil especialista en puentes</option>
                                                        <option value="Ingeniero civil especialista en obras">Ingeniero civil especialista en obras</option>
                                                        <option value="Ingeniero de software">Ingeniero de software</option>
                                                        <option value="Ingeniero especialista en estructuras">Ingeniero especialista en estructuras</option>
                                                        <option value="Ingeniero hidráulico">Ingeniero hidráulico</option>
                                                        <option value="Jefe de Logística">Jefe de Logística</option>
                                                        <option value="Jefe de obra">Jefe de obra</option>
                                                        <option value="Jefe de proyectos">Jefe de proyectos</option>
                                                        <option value="Jefe de proyectos de software">Jefe de proyectos de software</option>
                                                        <option value="Obrero constructor">Obrero constructor</option>
                                                        <option value="Obrero mesclador de cemento">Obrero mesclador de cemento</option>
                                                        <option value="Prácticante de ingeniería civil">Prácticante de ingeniería civil</option>
                                                        <option value="Prácticante de ingeniería de software">Prácticante de ingeniería de software</option>
                                                        <option value="prácticante programador android">prácticante programador android</option>
                                                        <option value="prácticante programador de escritorio">prácticante programador de escritorio</option>
                                                        <option value="prácticante programador web">prácticante programador web</option>
                                                        <option value="Programador android">Programador android</option>
                                                        <option value="Programador de escritorio">Programador de escritorio</option>
                                                        <option value="Programador web">Programador web</option>
                                                        <option value="secretaria">secretaria</option>
                                                        <option value="Técnico en computadoras">Técnico en computadoras</option>
                                                        <option value="Técnico en maquinarías de construcción">Técnico en maquinarías de construcción</option>
                                                        <option value="Técnico hidráulico">Técnico hidráulico</option>
                                                        <option value="Topógrafo">Topógrafo</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p class="text-bold">
                                                        Lugar del puesto<span>*</span>
                                                    </p>
                                                    <select size="1" class="form-control input-sm" id="txtLugar" name="txtLugar"> 
                                                        <option>-</option>
                                                        <option value="Campo">Campo</option>
                                                        <option value="Oficina">Oficina</option>
                                                        <option value="Ambos">Ambos</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <p class="text-bold">
                                                        Funciones del puesto<span>*</span> 
                                                    </p>
                                                    <textarea  type="text" 
                                                               name="txtFunciones" 
                                                               id="txtFunciones" 
                                                               rows="6"
                                                               maxlength="500"
                                                               placeholder="máx. 500 carácteres"
                                                               required=""
                                                               class="form-control input-sm"></textarea>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p class="text-bold">
                                                        Motivo de cese<span>*</span> 
                                                    </p>
                                                    <textarea type="text" 
                                                              name="txtCese" 
                                                              id="txtCese" 
                                                              maxlength="500"
                                                              rows="6"
                                                              placeholder="máx. 500 carácteres"
                                                              required=""
                                                              class="form-control input-sm"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <p class="text-bold">
                                                        Área del puesto<span>*</span> 
                                                    </p>
                                                    <input type="text" 
                                                           name="txtArea" 
                                                           id="txtArea" 
                                                           required=""
                                                           class="form-control input-sm">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                <!--                                    <div class="col-xs-3">
                                                                                        <p class="text-bold">
                                                                                            Desde<span>*</span> 
                                                                                        </p>
                                                                                        <input type="date" name="txtFecha1" 
                                                                                                            id="txtFecha1" 
                                                                                                            class="form-control input-sm" style="width:170px;" value="<?php echo date('Y-m-d'); ?>">
                                                                                    </div>-->
                                                Duración
                                                <select required="" name="cboDuracion" id="cboDuracion" class="form-control input-sm">
                                                    <option> - </option>
                                                    <option value="Menor a 1 ano">menor a 1 año</option>
                                                    <option value="de 1 a 2 anos">de 1 a 2 años</option>
                                                    <option value="de 2 a 3 anos">de 2 a 3 años</option>
                                                    <option value="de 3 a 4 anos">de 3 a 4 años</option>
                                                    <option value="más de 4 anos">más de 4 años</option>

                                                </select>
                                            </div>
                                            </div>
                                            <!--                                <div class="row">
                                                                                <div class="col-xs-3">
                                                                                    <p class="text-bold">
                                                                                        Hasta<span>*</span> 
                                                                                    </p>
                                                                                    <input type="date" name="txtFecha2" 
                                                                                                        id="txtFecha2" 
                                                                                                        class="form-control input-sm" style="width:170px;" value="<?php echo date('Y-m-d'); ?>">
                                                                                </div>
                                                                            </div>-->
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
        <script src="js/datos.experiencia.js" type="text/javascript"></script>
    </body>
</html>