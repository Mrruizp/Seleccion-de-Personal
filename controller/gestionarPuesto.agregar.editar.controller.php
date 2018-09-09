<?php

try {

    require_once '../logic/GestionarPuesto.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_nombre_puesto"]) ||
            empty($_POST["p_nombre_puesto"]) ||
            
            !isset($_POST["p_edad"]) ||
            empty($_POST["p_edad"]) ||
            
            !isset($_POST["p_sexo"]) ||
            empty($_POST["p_sexo"]) ||
            
            !isset($_POST["p_objetivo_puesto"]) ||
            empty($_POST["p_objetivo_puesto"]) ||
            
            !isset($_POST["p_funciones_puesto"]) ||
            empty($_POST["p_funciones_puesto"]) ||
            
            !isset($_POST["p_horario_trabajo"]) ||
            empty($_POST["p_horario_trabajo"]) ||
            
            !isset($_POST["p_condiciones_trabajo"]) ||
            empty($_POST["p_condiciones_trabajo"]) ||
            
            !isset($_POST["p_relaciones_sociales_internas"]) ||
            empty($_POST["p_relaciones_sociales_internas"]) ||
            
            !isset($_POST["p_relaciones_sociales_externas"]) ||
            empty($_POST["p_relaciones_sociales_externas"]) ||
            
            !isset($_POST["p_responsabilidades"]) ||
            empty($_POST["p_responsabilidades"]) ||
            
            !isset($_POST["p_equipo_de_trabajo"]) ||
            empty($_POST["p_equipo_de_trabajo"]) ||
            
            !isset($_POST["p_observaciones_finales"]) ||
            empty($_POST["p_observaciones_finales"]) ||
            
            !isset($_POST["p_sueldo"]) ||
            empty($_POST["p_sueldo"]) ||
            
            !isset($_POST["p_tipo_jornada"]) ||
            empty($_POST["p_tipo_jornada"]) ||
            
            !isset($_POST["p_codigo_departamento"]) ||
            empty($_POST["p_codigo_departamento"]) ||
            
            !isset($_POST["p_codigo_convocatoria"]) ||
            empty($_POST["p_codigo_convocatoria"]) ||
            
            !isset($_POST["p_vacante"]) ||
            empty($_POST["p_vacante"]) ||
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
     $nombre_puesto = $_POST["p_nombre_puesto"];
     $edad = $_POST["p_edad"];
     $sexo = $_POST["p_sexo"];
     $objetivo_puesto = $_POST["p_objetivo_puesto"];
     $funciones_puesto = $_POST["p_funciones_puesto"];
     $horario_trabajo = $_POST["p_horario_trabajo"];
     $condiciones_trabajo = $_POST["p_condiciones_trabajo"];
     $relaciones_sociales_internas = $_POST["p_relaciones_sociales_internas"];
     $relaciones_sociales_externas = $_POST["p_relaciones_sociales_externas"];
     $responsabilidades = $_POST["p_responsabilidades"];
     $equipo_de_trabajo = $_POST["p_equipo_de_trabajo"];
     $observaciones_finales = $_POST["p_observaciones_finales"];
     $sueldo = $_POST["p_sueldo"];
     $tipo_jornada = $_POST["p_tipo_jornada"];
     $codigo_departamento = $_POST["p_codigo_departamento"];
     $codigo_convocatoria = $_POST["p_codigo_convocatoria"];
     $vacante = $_POST["p_vacante"];
    $tipoOperacion = $_POST["p_tipo_ope"];

    $objGestionarPuesto = new GestionarPuesto();

    if ($tipoOperacion == "agregar") {
        $objGestionarPuesto->setNombre_puesto($nombre_puesto);
        $objGestionarPuesto->setEdad($edad);
        $objGestionarPuesto->setSexo($sexo);
        $objGestionarPuesto->setObjetivo_puesto($objetivo_puesto);
        $objGestionarPuesto->setFunciones_puesto($funciones_puesto);
        $objGestionarPuesto->setHorario_trabajo($horario_trabajo);
        $objGestionarPuesto->setCondiciones_trabajo($condiciones_trabajo);
        $objGestionarPuesto->setRelaciones_sociales_internas($relaciones_sociales_internas);
        $objGestionarPuesto->setRelaciones_sociales_externas($relaciones_sociales_externas);
        $objGestionarPuesto->setResponsabilidades($responsabilidades);
        $objGestionarPuesto->setEquipo_de_trabajo($equipo_de_trabajo);
        $objGestionarPuesto->setObservaciones_finales($observaciones_finales);
        $objGestionarPuesto->setSueldo($sueldo);
        $objGestionarPuesto->setTipo_jornada($tipo_jornada);
        $objGestionarPuesto->setCodigo_departamento($codigo_departamento);
        $objGestionarPuesto->setCodigo_convocatoria($codigo_convocatoria);
        $objGestionarPuesto->setVacante($vacante);
        $resultado = $objGestionarPuesto->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_puesto_laboral"]) ||
                empty($_POST["p_codigo_puesto_laboral"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_puesto_laboral"];
        $objGestionarPuesto->setCodigo_puesto_laboral($codigo);
        $objGestionarPuesto->setNombre_puesto($nombre_puesto);
        $objGestionarPuesto->setEdad($edad);
        $objGestionarPuesto->setSexo($sexo);
        $objGestionarPuesto->setObjetivo_puesto($objetivo_puesto);
        $objGestionarPuesto->setFunciones_puesto($funciones_puesto);
        $objGestionarPuesto->setHorario_trabajo($horario_trabajo);
        $objGestionarPuesto->setCondiciones_trabajo($condiciones_trabajo);
        $objGestionarPuesto->setRelaciones_sociales_internas($relaciones_sociales_internas);
        $objGestionarPuesto->setRelaciones_sociales_externas($relaciones_sociales_externas);
        $objGestionarPuesto->setResponsabilidades($responsabilidades);
        $objGestionarPuesto->setEquipo_de_trabajo($equipo_de_trabajo);
        $objGestionarPuesto->setObservaciones_finales($observaciones_finales);
        $objGestionarPuesto->setSueldo($sueldo);
        $objGestionarPuesto->setTipo_jornada($tipo_jornada);
        $objGestionarPuesto->setCodigo_departamento($codigo_departamento);
        $objGestionarPuesto->setCodigo_convocatoria($codigo_convocatoria);
        $objGestionarPuesto->setVacante($vacante);
        $resultado = $objGestionarPuesto->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
