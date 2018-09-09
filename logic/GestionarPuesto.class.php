<?php

require_once '../data/Conexion.class.php';

class GestionarPuesto extends Conexion {

    private $codigo_puesto_laboral;
    private $nombre_puesto;
    private $edad;
    private $sexo;
    private $objetivo_puesto;
    private $funciones_puesto;
    private $horario_trabajo;
    private $condiciones_trabajo;
    private $relaciones_sociales_internas;
    private $relaciones_sociales_externas;
    private $responsabilidades;
    private $equipo_de_trabajo;
    private $observaciones_finales;
    private $sueldo;
    private $tipo_jornada;
    private $codigo_departamento;
    private $codigo_convocatoria;
    private $vacante;

    public function getCodigo_puesto_laboral() {
        return $this->codigo_puesto_laboral;
    }

    public function getNombre_puesto() {
        return $this->nombre_puesto;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getObjetivo_puesto() {
        return $this->objetivo_puesto;
    }

    public function getFunciones_puesto() {
        return $this->funciones_puesto;
    }

    public function getHorario_trabajo() {
        return $this->horario_trabajo;
    }

    public function getCondiciones_trabajo() {
        return $this->condiciones_trabajo;
    }

    public function getRelaciones_sociales_internas() {
        return $this->relaciones_sociales_internas;
    }

    public function getRelaciones_sociales_externas() {
        return $this->relaciones_sociales_externas;
    }

    public function getResponsabilidades() {
        return $this->responsabilidades;
    }

    public function getEquipo_de_trabajo() {
        return $this->equipo_de_trabajo;
    }

    public function getObservaciones_finales() {
        return $this->observaciones_finales;
    }

    public function getSueldo() {
        return $this->sueldo;
    }

    public function getTipo_jornada() {
        return $this->tipo_jornada;
    }

    public function getCodigo_departamento() {
        return $this->codigo_departamento;
    }

    public function getCodigo_convocatoria() {
        return $this->codigo_convocatoria;
    }

    public function getVacante() {
        return $this->vacante;
    }

    public function setCodigo_puesto_laboral($codigo_puesto_laboral) {
        $this->codigo_puesto_laboral = $codigo_puesto_laboral;
    }

    public function setNombre_puesto($nombre_puesto) {
        $this->nombre_puesto = $nombre_puesto;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setObjetivo_puesto($objetivo_puesto) {
        $this->objetivo_puesto = $objetivo_puesto;
    }

    public function setFunciones_puesto($funciones_puesto) {
        $this->funciones_puesto = $funciones_puesto;
    }

    public function setHorario_trabajo($horario_trabajo) {
        $this->horario_trabajo = $horario_trabajo;
    }

    public function setCondiciones_trabajo($condiciones_trabajo) {
        $this->condiciones_trabajo = $condiciones_trabajo;
    }

    public function setRelaciones_sociales_internas($relaciones_sociales_internas) {
        $this->relaciones_sociales_internas = $relaciones_sociales_internas;
    }

    public function setRelaciones_sociales_externas($relaciones_sociales_externas) {
        $this->relaciones_sociales_externas = $relaciones_sociales_externas;
    }

    public function setResponsabilidades($responsabilidades) {
        $this->responsabilidades = $responsabilidades;
    }

    public function setEquipo_de_trabajo($equipo_de_trabajo) {
        $this->equipo_de_trabajo = $equipo_de_trabajo;
    }

    public function setObservaciones_finales($observaciones_finales) {
        $this->observaciones_finales = $observaciones_finales;
    }

    public function setSueldo($sueldo) {
        $this->sueldo = $sueldo;
    }

    public function setTipo_jornada($tipo_jornada) {
        $this->tipo_jornada = $tipo_jornada;
    }

    public function setCodigo_departamento($codigo_departamento) {
        $this->codigo_departamento = $codigo_departamento;
    }

    public function setCodigo_convocatoria($codigo_convocatoria) {
        $this->codigo_convocatoria = $codigo_convocatoria;
    }

    public function setVacante($vacante) {
        $this->vacante = $vacante;
    }

    public function listar() {
        try {
            $sql = "
                    select 
                            codigo_puesto_laboral,
                            nombre_puesto,
                            codigo_convocatoria,
                            vacante
                   from 
                           puesto_laboral
                    order by 
                            2
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function agregar() {
        $this->dblink->beginTransaction();

        try {
            $sql = "select * from f_generar_correlativo('puesto_laboral') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigo_puesto_laboral($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                    INSERT INTO puesto_laboral(
                                            codigo_puesto_laboral, 
                                            nombre_puesto, 
                                            edad, 
                                            sexo, 
                                            objetivo_puesto, 
                                            funciones_puesto, 
                                            horario_trabajo, 
                                            condiciones_trabajo, 
                                            relaciones_sociales_internas, 
                                            relaciones_sociales_externas, 
                                            responsabilidades, 
                                            equipo_de_trabajo, 
                                            observaciones_finales, 
                                            sueldo, 
                                            tipo_jornada,
                                            codigo_departamento,
                                            codigo_convocatoria, 
                                            vacante
                                            )
                    VALUES (
                            :p_codigo_puesto_laboral, 
                            :p_nombre_puesto, 
                            :p_edad, 
                            :p_sexo, 
                            :p_objetivo_puesto, 
                            :p_funciones_puesto, 
                            :p_horario_trabajo, 
                            :p_condiciones_trabajo, 
                            :p_relaciones_sociales_internas, 
                            :p_relaciones_sociales_externas, 
                            :p_responsabilidades, 
                            :p_equipo_de_trabajo, 
                            :p_observaciones_finales, 
                            :p_sueldo, 
                            :p_tipo_jornada, 
                            :p_codigo_departamento,
                            :p_codigo_convocatoria, 
                            :p_vacante
                            );

                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_puesto_laboral", $this->getCodigo_puesto_laboral());
                $sentencia->bindParam(":p_nombre_puesto", $this->getNombre_puesto());
                $sentencia->bindParam(":p_edad", $this->getEdad());
                $sentencia->bindParam(":p_sexo", $this->getSexo());
                $sentencia->bindParam(":p_objetivo_puesto", $this->getObjetivo_puesto());
                $sentencia->bindParam(":p_funciones_puesto", $this->getFunciones_puesto());
                $sentencia->bindParam(":p_horario_trabajo", $this->getHorario_trabajo());
                $sentencia->bindParam(":p_condiciones_trabajo", $this->getCondiciones_trabajo());
                $sentencia->bindParam(":p_relaciones_sociales_internas", $this->getRelaciones_sociales_internas());
                $sentencia->bindParam(":p_relaciones_sociales_externas", $this->getRelaciones_sociales_externas());
                $sentencia->bindParam(":p_responsabilidades", $this->getResponsabilidades());
                $sentencia->bindParam(":p_equipo_de_trabajo", $this->getEquipo_de_trabajo());
                $sentencia->bindParam(":p_observaciones_finales", $this->getObservaciones_finales());
                $sentencia->bindParam(":p_sueldo", $this->getSueldo());
                $sentencia->bindParam(":p_tipo_jornada", $this->getTipo_jornada());
                $sentencia->bindParam(":p_codigo_departamento", $this->getCodigo_departamento());
                $sentencia->bindParam(":p_codigo_convocatoria", $this->getCodigo_convocatoria());
                $sentencia->bindParam(":p_vacante", $this->getVacante());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='puesto_laboral'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla puesto_laboral");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function leerDatos($p_codigoPuesto) {
        try {
            $sql = "
                    select * from puesto_laboral 
                    where codigo_puesto_laboral = :p_codigo_puesto_laboral
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_puesto_laboral", $p_codigoPuesto);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function editar() {
        try {
            $sql = "
                update 
                    puesto_laboral 
                set  
                    nombre_puesto = :p_nombre_puesto, 
                    edad = :p_edad, 
                    sexo = :p_sexo, 
                    objetivo_puesto = :p_objetivo_puesto, 
                    funciones_puesto = :p_funciones_puesto, 
                    horario_trabajo = :p_horario_trabajo, 
                    condiciones_trabajo = :p_condiciones_trabajo, 
                    relaciones_sociales_internas = :p_relaciones_sociales_internas, 
                    relaciones_sociales_externas = :p_relaciones_sociales_externas, 
                    responsabilidades = :p_responsabilidades, 
                    equipo_de_trabajo = :p_equipo_de_trabajo, 
                    observaciones_finales = :p_observaciones_finales, 
                    sueldo = :p_sueldo, 
                    tipo_jornada = :p_tipo_jornada, 
                    codigo_departamento = :p_codigo_departamento, 
                    codigo_convocatoria = :p_codigo_convocatoria, 
                    vacante = :p_vacante
                where
                    codigo_puesto_laboral = :p_codigo_puesto_laboral
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_nombre_puesto", $this->getNombre_puesto());
            $sentencia->bindParam(":p_edad", $this->getEdad());
            $sentencia->bindParam(":p_sexo", $this->getSexo());
            $sentencia->bindParam(":p_objetivo_puesto", $this->getObjetivo_puesto());
            $sentencia->bindParam(":p_funciones_puesto", $this->getFunciones_puesto());
            $sentencia->bindParam(":p_horario_trabajo", $this->getHorario_trabajo());
            $sentencia->bindParam(":p_condiciones_trabajo", $this->getCondiciones_trabajo());
            $sentencia->bindParam(":p_relaciones_sociales_internas", $this->getRelaciones_sociales_internas());
            $sentencia->bindParam(":p_relaciones_sociales_externas", $this->getRelaciones_sociales_externas());
            $sentencia->bindParam(":p_responsabilidades", $this->getResponsabilidades());
            $sentencia->bindParam(":p_equipo_de_trabajo", $this->getEquipo_de_trabajo());
            $sentencia->bindParam(":p_observaciones_finales", $this->getObservaciones_finales());
            $sentencia->bindParam(":p_sueldo", $this->getSueldo());
            $sentencia->bindParam(":p_tipo_jornada", $this->getTipo_jornada());
            $sentencia->bindParam(":p_codigo_departamento", $this->getCodigo_departamento());
            $sentencia->bindParam(":p_codigo_convocatoria", $this->getCodigo_convocatoria());
            $sentencia->bindParam(":p_vacante", $this->getVacante());
            $sentencia->bindParam(":p_codigo_puesto_laboral", $this->getCodigo_puesto_laboral());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

    public function eliminar() {
        try {
            $sql = "
                delete from 
                    puesto_laboral 
                where
                    codigo_puesto_laboral = :p_codigo_puesto_laboral
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_puesto_laboral", $this->getCodigo_puesto_laboral());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
