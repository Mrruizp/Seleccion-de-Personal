<?php

require_once '../data/Conexion.class.php';

class GestionarPrueba extends Conexion {

    private $codigo_prueba;
    private $nombre_prueba;
    private $instruccion;
    private $duracion;
    private $codigo_tipo_prueba;
    private $codigo_puesto_laboral;

    public function getCodigo_prueba() {
        return $this->codigo_prueba;
    }

    public function getNombre_prueba() {
        return $this->nombre_prueba;
    }

    public function getInstruccion() {
        return $this->instruccion;
    }

    public function getDuracion() {
        return $this->duracion;
    }

    public function getCodigo_tipo_prueba() {
        return $this->codigo_tipo_prueba;
    }

    public function getCodigo_puesto_laboral() {
        return $this->codigo_puesto_laboral;
    }

    public function setCodigo_prueba($codigo_prueba) {
        $this->codigo_prueba = $codigo_prueba;
    }

    public function setNombre_prueba($nombre_prueba) {
        $this->nombre_prueba = $nombre_prueba;
    }

    public function setInstruccion($instruccion) {
        $this->instruccion = $instruccion;
    }

    public function setDuracion($duracion) {
        $this->duracion = $duracion;
    }

    public function setCodigo_tipo_prueba($codigo_tipo_prueba) {
        $this->codigo_tipo_prueba = $codigo_tipo_prueba;
    }

    public function setCodigo_puesto_laboral($codigo_puesto_laboral) {
        $this->codigo_puesto_laboral = $codigo_puesto_laboral;
    }

    public function listar() {
        try {
            $sql = "
                    select
                            p.codigo_prueba,
                            p.nombre_prueba,
                            p.instruccion,
                            p.duracion,
                            t.nombre_tipo_prueba,
                            p.codigo_puesto_laboral
                    from
                            prueba p inner join tipo_prueba t
                    on
                            (p.codigo_tipo_prueba = t.codigo_tipo_prueba)
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
            $sql = "select * from f_generar_correlativo('prueba') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigo_prueba($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                    INSERT INTO prueba(
                            codigo_prueba, nombre_prueba, instruccion, duracion, codigo_tipo_prueba, 
                            codigo_puesto_laboral)
                    VALUES (:p_codigo_prueba, :p_nombre_prueba, :p_instruccion, :p_duracion, :p_codigo_tipo_prueba, :p_codigo_puesto_laboral);
                    ";

//                insert into laboratorio
//                                           (
//                                             doc_ID,nombre,apellidos,direccion,celular,hijos,
//                                             departamento_nacimiento,ciudad_nacimiento,estado_civil,
//                                             sexo,edad,email,Disposicion_laboral_id) 
//                    values(:p_cod_lab, :p_nomb, :p_codigo_pais)
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_prueba", $this->getCodigo_prueba());
                $sentencia->bindParam(":p_nombre_prueba", $this->getNombre_prueba());
                $sentencia->bindParam(":p_instruccion", $this->getInstruccion());
                $sentencia->bindParam(":p_duracion", $this->getDuracion());
                $sentencia->bindParam(":p_codigo_tipo_prueba", $this->getCodigo_tipo_prueba());
                $sentencia->bindParam(":p_codigo_puesto_laboral", $this->getCodigo_puesto_laboral());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='prueba'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla prueba");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function leerDatos($p_codigoPrueba) {
        try {
            $sql = "
                    select * from prueba 
                    where codigo_prueba = :p_codigo_prueba
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_prueba", $p_codigoPrueba);
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
                    prueba 
                set  
                    nombre_prueba         = :p_nombre_prueba, 
                    instruccion           = :p_instruccion, 
                    duracion              = :p_duracion, 
                    codigo_tipo_prueba    = :p_codigo_tipo_prueba, 
                    codigo_puesto_laboral = :p_codigo_puesto_laboral
                where
                    codigo_prueba = :p_codigo_prueba
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_prueba", $this->getCodigo_prueba());
            $sentencia->bindParam(":p_nombre_prueba", $this->getNombre_prueba());
            $sentencia->bindParam(":p_instruccion", $this->getInstruccion());
            $sentencia->bindParam(":p_duracion", $this->getDuracion());
            $sentencia->bindParam(":p_codigo_tipo_prueba", $this->getCodigo_tipo_prueba());
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
                    prueba 
                where
                    codigo_prueba = :p_codigo_prueba
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_prueba", $this->getCodigo_prueba());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
