$(document).ready(function () {
    //Esto se ejecuta cuando carga la página
    //alert("ha cargado la página");
    cargarComboConvocatoria("#cboConvocatoria", "seleccione");
    cargarComboPuesto("#cboPuesto", "seleccione");
    listar();
    listarExperiencia();
});


function listar() {
    $.post
            (
                    "../controller/GestionarPuesto.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th>CODIGO CONVOCATORIA</th>';
            html += '<th>CODIGO PUESTO</th>';
            html += '<th>NOMBRE DEL PUESTO</th>';
            html += '<th>VACANTES</th>';
            html += '<th style="text-align: center">OPCIONES</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center">' + item.codigo_convocatoria + '</td>';
                html += '<td>' + item.codigo_puesto_laboral + '</td>';
                html += '<td>' + item.nombre_puesto + '</td>';
                html += '<td>' + item.vacante + '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="leerDatos(' + item.codigo_puesto_laboral + ')"><i class="fa fa-pencil"></i></button>';
                html += '&nbsp;&nbsp;';
                html += '<button type="button" class="btn btn-danger btn-xs" onclick="eliminar(' + item.codigo_puesto_laboral + ')"><i class="fa fa-close"></i></button>';
                html += '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listado").html(html);


            $('#tabla-listado').dataTable({
                "aaSorting": [[1, "asc"]]
            });



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}



$("#frmgrabar").submit(function (event) {
    event.preventDefault();

    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar los datos ingresados?",
        showCancelButton: true,
        confirmButtonColor: '#3d9205',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/pregunta.png"
    },
            function (isConfirm) {

                if (isConfirm) { //el usuario hizo clic en el boton SI     
                    //procedo a grabar
                    //Llamar al controlador para grabar los datos

                    //var codLab = ($("#txtTipoOperacion").val()==="agregar")? 

                    var codPues = "";
                    if ($("#txtTipoOperacion").val() === "agregar") {
                        codPues = "0";
                    } else {
                        codPues = $("#txtCodigo").val();
                    }

                    $.post(
                            "../controller/gestionarPuesto.agregar.editar.controller.php",
                            {
                                p_nombre_puesto: $("#txtPuesto").val(),
                                p_edad: $("#txtEdad").val(),
                                p_sexo: $("#cboSexo").val(),
                                p_objetivo_puesto: $("#txtObjetivo").val(),
                                p_funciones_puesto: $("#txtFunciones").val(),
                                p_horario_trabajo: $("#txtHorario").val(),
                                p_condiciones_trabajo: $("#txtCondiciones").val(),
                                p_relaciones_sociales_internas: $("#txtInternas").val(),
                                p_relaciones_sociales_externas: $("#txtExternas").val(),
                                p_responsabilidades: $("#txtResponsabilidades").val(),
                                p_equipo_de_trabajo: $("#txtEquipo").val(),
                                p_observaciones_finales: $("#txtObservaciones").val(),
                                p_sueldo: $("#txtSueldo").val(),
                                p_tipo_jornada: $("#cboJornada").val(),
                                p_codigo_departamento: $("#cboArea").val(),
                                p_codigo_convocatoria: $("#cboConvocatoria").val(),
                                p_vacante: $("#txtVacantes").val(),
                                p_tipo_ope: $("#txtTipoOperacion").val(),
                                p_codigo_puesto_laboral: codPues
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");
                            $("#btncerrar").click(); //Cerrar la ventana 
                            listar(); //actualizar la lista
                        } else {
                            swal("Mensaje del sistema", resultado, "warning");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });

});


$("#btnagregar").click(function () {
    $("#txtTipoOperacion").val("agregar");
    $("#txtPuesto").val(""),
    $("#txtEdad").val(""),
    $("#cboSexo").val(""),
    $("#txtObjetivo").val(""),
    $("#txtFunciones").val(""),
    $("#txtHorario").val(""),
    $("#txtCondiciones").val(""),
    $("#txtInternas").val(""),
    $("#txtExternas").val(""),
    $("#txtResponsabilidades").val(""),
    $("#txtEquipo").val(""),
    $("#txtObservaciones").val(""),
    $("#txtSueldo").val(""),
    $("#cboJornada").val(""),
    $("#cboArea").val(""),
    $("#cboConvocatoria").val(""),
    $("#txtVacantes").val(""),
$("#titulomodal").html("Agregar nuevo puesto de trabajo");
});


$("#myModal").on("shown.bs.modal", function () {
    $("#txtPuesto").focus();
});


function leerDatos(codPues) {
    $.post
            (
                    "../controller/gestionarPuesto.leer.datos.controller.php",
                    {
                        p_codigo_puesto_laboral: codPues
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("editar");
            $("#txtCodigo").val(jsonResultado.datos.codigo_puesto_laboral);
            $("#txtPuesto").val(jsonResultado.datos.nombre_puesto);
            $("#txtVacantes").val( jsonResultado.datos.vacante );
            $("#cboConvocatoria").val(jsonResultado.datos.codigo_convocatoria);
            $("#txtEdad").val(jsonResultado.datos.edad);
            $("#cboSexo").val(jsonResultado.datos.sexo);
            $("#txtObjetivo").val(jsonResultado.datos.objetivo_puesto);
            $("#txtFunciones").val(jsonResultado.datos.funciones_puesto);
            $("#txtHorario").val(jsonResultado.datos.horario_trabajo);
            $("#txtCondiciones").val(jsonResultado.datos.condiciones_trabajo);
            $("#txtInternas").val(jsonResultado.datos.relaciones_sociales_internas);
            $("#txtExternas").val(jsonResultado.datos.relaciones_sociales_externas);
            $("#txtResponsabilidades").val(jsonResultado.datos.responsabilidades);
            $("#txtEquipo").val(jsonResultado.datos.equipo_de_trabajo);
            $("#txtObservaciones").val(jsonResultado.datos.observaciones_finales);
            $("#txtSueldo").val(jsonResultado.datos.sueldo);
            $("#cboJornada").val(jsonResultado.datos.tipo_jornada);
            $("#cboArea").val(jsonResultado.datos.codigo_departamento);
            $("#titulomodal").html("Modificar datos del puesto de trabajo");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}


function eliminar(codPues) {
    swal({
        title: "Confirme",
        text: "¿Esta seguro de eliminar el registro seleccionado?",
        showCancelButton: true,
        confirmButtonColor: '#d93f1f',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/eliminar2.png"
    },
            function (isConfirm) {
                if (isConfirm) {
                    $.post(
                            "../controller/gestionarPuesto.eliminar.controller.php",
                            {
                                p_codigo_puesto_laboral: codPues
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;
                        if (datosJSON.estado === 200) { //ok
                            listar();
                            swal("Exito", datosJSON.mensaje, "success");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });

}
function listarExperiencia() {
    $.post
            (
                    "../controller/gestionarExperienciaRequerida.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado2" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th style="text-align: center">CODIGO PUESTO</th>';
            html += '<th style="text-align: center">CODIGO EXPERIENCIA</th>';
            html += '<th style="text-align: center">NOMBRE DE LA EXPERIENCIA</th>';
            html += '<th style="text-align: center">DURACIÓN</th>';
            html += '<th style="text-align: center">OPCIONES</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center">' + item.codigo_puesto_laboral + '</td>';
                html += '<td align="center">' + item.codigo_experiencia_requerida + '</td>';
                html += '<td align="justify">' + item.experiencia_requerida + '</td>';
                html += '<td align="center">' + item.duracion + '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal2" onclick="leerDatosExperiencia(' + item.codigo_experiencia_requerida + ')"><i class="fa fa-pencil"></i></button>';
                html += '&nbsp;&nbsp;';
                html += '<button type="button" class="btn btn-danger btn-xs" onclick="eliminarExperiencia(' + item.codigo_experiencia_requerida + ')"><i class="fa fa-close"></i></button>';
                html += '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listado2").html(html);


            $('#tabla-listado2').dataTable({
                "aaSorting": [[1, "asc"]]
            });



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}
$("#frmgrabar2").submit(function (event) {
    event.preventDefault();

    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar los datos ingresados?",
        showCancelButton: true,
        confirmButtonColor: '#3d9205',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/pregunta.png"
    },
            function (isConfirm) {

                if (isConfirm) { //el usuario hizo clic en el boton SI     
                    //procedo a grabar
                    //Llamar al controlador para grabar los datos

                    //var codLab = ($("#txtTipoOperacion").val()==="agregar")? 

                    var codReq = "";
                    if ($("#txtTipoOperacion").val() === "agregar") {
                        codReq = "0";
                    } else {
                        codReq = $("#txtCodigo").val();
                    }

                    $.post(
                            "../controller/gestionarExperienciaRequerida.agregar.editar.controller.php",
                            {
                                p_codigo_puesto: $("#cboPuesto").val(),
                                p_nomb_req: $("#cboExperiencia").val(),
                                p_dur: $("#cboDuracion").val(),
                                p_tipo_ope: $("#txtTipoOperacion").val(),
                                p_cod_req: codReq
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");
                            $("#btncerrar2").click(); //Cerrar la ventana 
                            listarExperiencia()(); //actualizar la lista
                        } else {
                            swal("Mensaje del sistema", resultado, "warning");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });

});


$("#btnagregar2").click(function () {
    $("#txtTipoOperacion").val("agregar");
    $("#cboPuesto").val("");
    $("#cboExperiencia").val("");
    $("#cboDuracion").val("");
    $("#titulomodal2").html("Agregar nueva experiencia");
});


$("#myModal2").on("shown.bs.modal", function () {
    $("#txtFecha").focus();
});
function leerDatosExperiencia(codReq) {
    $.post
            (
                    "../controller/gestionarExperienciaRequerida.leer.datos.controller.php",
                    {
                        p_cod_req: codReq
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
           
            $("#txtTipoOperacion").val("editar");
            $("#txtCodigo").val(jsonResultado.datos.codigo_experiencia_requerida);
            $("#cboPuesto").val(jsonResultado.datos.codigo_puesto_laboral);
            $("#cboExperiencia").val(jsonResultado.datos.experiencia_requerida);
            $("#cboDuracion").val(jsonResultado.datos.duracion);
            $("#titulomodal2").html("Modificar datos de experiencia");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}
function eliminarExperiencia(codReq) {
    swal({
        title: "Confirme",
        text: "¿Esta seguro de eliminar el registro seleccionado?",
        showCancelButton: true,
        confirmButtonColor: '#d93f1f',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/eliminar2.png"
    },
            function (isConfirm) {
                if (isConfirm) {
                    $.post(
                            "../controller/gestionarExperienciaRequerida.eliminar.controller.php",
                            {
                                p_cod_req: codReq
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;
                        if (datosJSON.estado === 200) { //ok
                            listarExperiencia();
                            swal("Exito", datosJSON.mensaje, "success");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });

}
