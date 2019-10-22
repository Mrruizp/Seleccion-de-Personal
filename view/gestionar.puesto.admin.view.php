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
        <title> RR. HH. | Gestionar Puesto</title>
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
                        <li class="active">Puestos de Trabajo</li>
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
                                    <h3>Puesto de Trabajo</h3>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><i class="fa fa-plus"> Agregar nuevo puesto de trabajo </i></button>
                                </section>
                                <div class="box-body">
                                    <div id="listado"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <section class="content-header">
                                    <h3>Requisitos o exigencias del Puesto</h3>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal2" id="btnagregar2"><i class="fa fa-briefcase"></i> Agregar nueva experiencia</button>
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
                                            <h4 class="modal-title" id="titulomodal">Modificar datos del puesto de trabajo</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <p>
                                                        <input type="hidden" value="" id="txtTipoOperacion" name="txtTipoOperacion">
                                                        Código <input type="text" 
                                                                      name="txtCodigo" 
                                                                      id="txtCodigo" 
                                                                      class="form-control input-sm" 
                                                                      readonly="">
                                                    </p>
                                                </div>
                                                <div class="col-xs-4">
                                                    <p>
                                                        Código Convocatoria
                                                        <select required="" name="cboConvocatoria" id="cboConvocatoria" class="form-control input-sm">

                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p>
                                                        Área
                                                        <select required="" name="cboArea" id="cboArea" class="form-control input-sm">
                                                            <option value="">-</option>
                                                            <option value="1">Administración</option>
                                                            <option value="2">Contabilidad</option>
                                                            <option value="3">Costo y Presupuesto</option>
                                                            <option value="4">Logística</option>
                                                            <option value="5">Mantenimientos de Equipos</option>
                                                            <option value="6">Legal</option>
                                                            <option value="7">Topografía</option>
                                                            <option value="8">Sistemas de Información</option>
                                                            <option value="9">Esctructuras</option>
                                                            <option value="10">Medio Ambiente</option>
                                                            <option value="11">Consulta y Atención</option>
                                                            <option value="12">Hidráulica</option>
                                                            <option value="13">Estudio de Suelos</option>
                                                            <option value="14">Proyectos</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <p>
                                                        Nombre del puesto<input type="text" 
                                                                                name="txtPuesto" 
                                                                                id="txtPuesto" 
                                                                                required=""
                                                                                class="form-control input-sm">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <p>
                                                        Vacantes<input type="number" 
                                                                       name="txtVacantes" 
                                                                       id="txtVacantes" 
                                                                       required=""
                                                                       class="form-control input-sm">
                                                    </p>
                                                </div>
                                                <div class="col-xs-3">
                                                    <p>
                                                        Edad deseable<input type="text" 
                                                                            name="txtEdad" 
                                                                            id="txtEdad" 
                                                                            required=""
                                                                            class="form-control input-sm">
                                                    </p>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p>
                                                        Sexo
                                                        <select required="" name="cboSexo" id="cboSexo" class="form-control input-sm">
                                                            <option>-</option>
                                                            <option value="H">Solo Hombres</option>
                                                            <option value="M">Solo Mujeres</option>
                                                            <option value="A">Ambos sexos</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <p>
                                                        Objetivo del puesto <textarea type="text" 
                                                                                      name="txtObjetivo" 
                                                                                      id="txtObjetivo" 
                                                                                      required=""
                                                                                      rows="2"
                                                                                      class="form-control input-sm"></textarea>
                                                    </p>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p>
                                                        Funciones del Puesto <textarea type="text" 
                                                                                       name="txtFunciones" 
                                                                                       id="txtFunciones" 
                                                                                       required=""
                                                                                       rows="2"
                                                                                       class="form-control input-sm"></textarea>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <p>
                                                        Condiciones de Trabajo <textarea type="text" 
                                                                                         name="txtCondiciones" 
                                                                                         id="txtCondiciones" 
                                                                                         required=""
                                                                                         rows="2"
                                                                                         class="form-control input-sm"></textarea>
                                                    </p>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p>
                                                        Equipo o materiales de Trabajo <textarea type="text" 
                                                                                                 name="txtEquipo" 
                                                                                                 id="txtEquipo" 
                                                                                                 required=""
                                                                                                 rows="2"
                                                                                                 class="form-control input-sm"></textarea>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <p>
                                                        Relaciones Sociales Internas del Puesto <textarea type="text" 
                                                                                                          name="txtInternas" 
                                                                                                          id="txtInternas" 
                                                                                                          required=""
                                                                                                          rows="2"
                                                                                                          class="form-control input-sm"></textarea>
                                                    </p>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p>
                                                        Relaciones Sociales Externas del Puesto <textarea type="text" 
                                                                                                          name="txtExternas" 
                                                                                                          id="txtExternas" 
                                                                                                          required=""
                                                                                                          rows="2"
                                                                                                          class="form-control input-sm"></textarea>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <p>
                                                        Responsabilidades del puesto <textarea type="text" 
                                                                                               name="txtResponsabilidades" 
                                                                                               id="txtResponsabilidades" 
                                                                                               required=""
                                                                                               rows="2"
                                                                                               class="form-control input-sm"></textarea>
                                                    </p>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p>
                                                        Observaciones finales <textarea type="text" 
                                                                                        name="txtObservaciones" 
                                                                                        id="txtObservaciones" 
                                                                                        required=""
                                                                                        rows="2"
                                                                                        class="form-control input-sm"></textarea>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <p>
                                                        Horario de trabajo<input type="text" 
                                                                                 name="txtHorario" 
                                                                                 id="txtHorario" 
                                                                                 required=""
                                                                                 class="form-control input-sm">
                                                    </p>
                                                </div>
                                                <div class="col-xs-4">
                                                    <p>
                                                        Tipo de jornada
                                                        <select required="" name="cboJornada" id="cboJornada" class="form-control input-sm">
                                                            <option>-</option>
                                                            <option value="Tiempo completo">Tiempo completo</option>
                                                            <option value="Tiempo parcial">Tiempo parcial</option>
                                                            <option value="Por horas">Por horas</option>
                                                            <option value="Beca/Prácticas">Beca/Prácticas</option>
                                                            <option value="Desde casa">Desde casa</option>

                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-xs-2">
                                                    <p>
                                                        Sueldo<input type="text" 
                                                                     name="txtSueldo" 
                                                                     id="txtSueldo" 
                                                                     required=""
                                                                     class="form-control input-sm">
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
                    <small>
                        <form id="frmgrabar2">
                            <div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="titulomodal2">Agregar nueva experiencia</h4>
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
                                                <div class="col-xs-4">
                                                    <p>
                                                        Código Puesto
                                                        <select required="" name="cboPuesto" id="cboPuesto" class="form-control input-sm">

                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-xs-7">
                                                    <p>
                                                        Formación
                                                        <select required="" name="cboExperiencia" id="cboExperiencia" class="form-control input-sm">
                                                            <option> - </option>
                                                            <option value="Abogado especialista en constructoras">Abogado especialista en constructoras</option>
                                                            <option value="Administrador">Administrador</option>
                                                            <option value="Arquitecto especializado en diseños de puentes">Arquitecto especializado en diseños de puentes</option>
                                                            <option value="Arquitecto especializado en diseño de casas">Arquitecto especializado en diseño de casas</option>
                                                            <option value="Arquitecto especializado en diseño de interiores">Arquitecto especializado en diseño de interiores</option>
                                                            <option value="Asistente de costo y presupuesto">Asistente de costo y presupuesto</option>
                                                            <option value="Asistente de logística">Asistente de logística</option>
                                                            <option value="Consulta y atención de reclamos">Consulta y atención de reclamos</option>
                                                            <option value="Contador">Contador</option>
                                                            <option value="Ingeniero civil especialista en cálidad">Ingeniero civil especialista en cálidad</option>
                                                            <option value="Ingeniero civil especialista en carreteras">Ingeniero civil especialista en carreteras</option>
                                                            <option value="Ingeniero civil especialista en estudios de suelos">Ingeniero civil especialista en estudios de suelos</option>
                                                            <option value="Ingeniero civil especialista en medio ambiente">Ingeniero civil especialista en medio ambiente</option>
                                                            <option value="Ingeniero civil especialista en puentes">Ingeniero civil especialista en puentes</option>
                                                            <option value="Ingeniero civil especialista en supervición de obras">Ingeniero civil especialista en supervición de obras</option>
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
                                                            <option value="Técnico en mantenimiento y reparaciones de pcs">Técnico en mantenimiento y reparaciones de pcs</option>
                                                            <option value="Técnico en maquinarías de construcción">Técnico en maquinarías de construcción</option>
                                                            <option value="Técnico hidráulico">Técnico hidráulico</option>
                                                            <option value="Topógrafo">Topógrafo</option>
                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-xs-11">
                                                    <p>
                                                        Detalle de la experiencia ... <textarea type="text" 
                                                                                         name="txtCondiciones" 
                                                                                         id="txtCondiciones" 
                                                                                         required=""
                                                                                         rows="10"
                                                                                         class="form-control input-sm"></textarea>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-warning" aria-hidden="true"><i class="fa fa-save"></i> Grabar</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar2"><i class="fa fa-close"></i> Cerrar</button>
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
        <script src="js/convocatoria.js" type="text/javascript"></script>
        <script src="js/puesto.js" type="text/javascript"></script>
        <script src="js/gestionar.puesto.admin.js" type="text/javascript"></script>
    </body>
</html>