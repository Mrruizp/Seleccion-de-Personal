<?php

require_once '../data/Conexion.class.php';

class registrateUsuario extends Conexion {
    private $codigousuario;
    private $Dni;
    private $Nombres;
    private $Apellidos;
    private $Direccion;
    private $estado_civil;
    private $txtDepartamento;
    private $txtProvincia;
    private $txtEmail;
    private $txtTelefono;
    private $sexo;
    private $edad;
    private $hijo;
    //private $cuenta;
    private $contrasenia;
    
    
    public function getCodigousuario() {
        return $this->codigousuario;
    }

    public function getDni() {
        return $this->Dni;
    }

    public function getNombres() {
        return $this->Nombres;
    }

    public function getApellidos() {
        return $this->Apellidos;
    }

    public function getDireccion() {
        return $this->Direccion;
    }

    public function getEstado_civil() {
        return $this->estado_civil;
    }

    public function getTxtDepartamento() {
        return $this->txtDepartamento;
    }

    public function getTxtProvincia() {
        return $this->txtProvincia;
    }

    public function getTxtEmail() {
        return $this->txtEmail;
    }

    public function getTxtTelefono() {
        return $this->txtTelefono;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getHijo() {
        return $this->hijo;
    }

    public function getContrasenia() {
        return $this->contrasenia;
    }

    public function setCodigousuario($codigousuario) {
        $this->codigousuario = $codigousuario;
    }

    public function setDni($Dni) {
        $this->Dni = $Dni;
    }

    public function setNombres($Nombres) {
        $this->Nombres = $Nombres;
    }

    public function setApellidos($Apellidos) {
        $this->Apellidos = $Apellidos;
    }

    public function setDireccion($Direccion) {
        $this->Direccion = $Direccion;
    }

    public function setEstado_civil($estado_civil) {
        $this->estado_civil = $estado_civil;
    }

    public function setTxtDepartamento($txtDepartamento) {
        $this->txtDepartamento = $txtDepartamento;
    }

    public function setTxtProvincia($txtProvincia) {
        $this->txtProvincia = $txtProvincia;
    }

    public function setTxtEmail($txtEmail) {
        $this->txtEmail = $txtEmail;
    }

    public function setTxtTelefono($txtTelefono) {
        $this->txtTelefono = $txtTelefono;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function setHijo($hijo) {
        $this->hijo = $hijo;
    }

    public function setContrasenia($contrasenia) {
        $this->contrasenia = $contrasenia;
    }

    
//    public function listar() {
//        try {
//            $sql = "
//                    select
//                            l.codigo_laboratorio,
//                            l.nombre,
//                            coalesce(p.nombre,'--no asignado--') as pais
//                    from 
//                            laboratorio l left join pais p on ( l.codigo_pais = p.codigo_pais )
//                    order by 
//                            2
//                ";
//            $sentencia = $this->dblink->prepare($sql);
//            $sentencia->execute();
//            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
//            return $resultado;
//        } catch (Exception $exc) {
//            throw $exc;
//        }
//    }
    
    public function agregar() {
        $this->dblink->beginTransaction();
        
        try {
            $sql = "select * from f_generar_correlativo('usuario') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            
            if ($sentencia->rowCount()){
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigousuario($nuevoCodigo);
                
                /*Insertar en la tabla candidato*/
//                $sql = "
//                    insert into laboratorio(codigo_laboratorio,nombre,codigo_pais) 
//                    values(:p_cod_lab, :p_nomb, :p_codigo_pais)
//                    ";
                
                $sql = "select * from fn_registrarCandidato 
                                                (
                                                :p_cod_usuario,
                                                :p_doc_ident,
                                                :p_nombres,
                                                :p_apellidos,
                                                :p_direccion,
                                                :p_telefono, 
                                                :p_hijo, 
                                                :p_departamento, 
                                                :p_ciudad,
                                                :p_estado_civil, 
                                                :p_sexo, 
                                                :p_edad, 
                                                :p_email,
                                                :p_contrasenia
                                                );";
                $sentencia = $this->dblink->prepare($sql);
                // $sentencia->bindParam(":p_codigoCandidato", $this->getCodigoCandidato());
                $sentencia->bindParam(":p_cod_usuario", $this->getCodigousuario());
                $sentencia->bindParam(":p_doc_ident", $this->getDni());
                $sentencia->bindParam(":p_nombres", $this->getNombres());
                $sentencia->bindParam(":p_apellidos", $this->getApellidos());
                $sentencia->bindParam(":p_direccion", $this->getDireccion());
                $sentencia->bindParam(":p_estado_civil", $this->getEstado_civil());
                $sentencia->bindParam(":p_departamento", $this->getTxtDepartamento());
                $sentencia->bindParam(":p_ciudad", $this->getTxtProvincia());
                $sentencia->bindParam(":p_email", $this->getTxtEmail());
                $sentencia->bindParam(":p_telefono", $this->getTxtTelefono());
                $sentencia->bindParam(":p_sexo", $this->getSexo());
                $sentencia->bindParam(":p_edad", $this->getEdad());
                $sentencia->bindParam(":p_hijo", $this->getHijo());
                // $sentencia->bindParam(":p_trabaja_actualmente", $this->getDispLaboral());
                // $sentencia->bindParam(":p_cambio_residencia", $this->getCambio_residencia());
                // $sentencia->bindParam(":p_cuenta", $this->getCuenta());
                $sentencia->bindParam(":p_contrasenia", $this->getContrasenia());
                $sentencia->execute();
                /*Insertar en la tabla laboratorio*/
                
                /*Actualizar el correlativo*/
                $sql = "update correlativo set numero = numero + 1 
                        where tabla='usuario'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /*Actualizar el correlativo*/
                $this->dblink->commit();
                return true;
                
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla usuario");
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }
    
//    public function leerDatos($p_codigoLaboratorio) {
//        try {
//            $sql = "
//                    select * from laboratorio 
//                    where codigo_laboratorio = :p_cod_lab
//                ";
//            $sentencia = $this->dblink->prepare($sql);
//            $sentencia->bindParam(":p_cod_lab", $p_codigoLaboratorio);
//            $sentencia->execute();
//            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
//            return $resultado;
//        } catch (Exception $exc) {
//            throw $exc;
//        }
//    }
//    
//    public function editar() {
//        try {
//            $sql = "
//                update 
//                    laboratorio 
//                set 
//                    nombre = :p_nom_lab,
//                    codigo_pais = :p_cod_pais
//                where
//                    codigo_laboratorio = :p_cod_lab
//                ";
//            $sentencia = $this->dblink->prepare($sql);
//            $sentencia->bindParam(":p_nom_lab", $this->getNombre());
//            $sentencia->bindParam(":p_cod_pais", $this->getCodigoPais());
//            $sentencia->bindParam(":p_cod_lab", $this->getCodigoLaboratorio());
//            $sentencia->execute();
//            return true;
//            
//        } catch (Exception $exc) {
//            throw $exc;
//        }
//        return false;
//    }
//    
//    public function eliminar() {
//        try {
//            $sql = "
//                delete from 
//                    laboratorio 
//                where
//                    codigo_laboratorio = :p_cod_lab
//                ";
//            $sentencia = $this->dblink->prepare($sql);
//            $sentencia->bindParam(":p_cod_lab", $this->getCodigoLaboratorio());
//            $sentencia->execute();
//            return true;
//            
//        } catch (Exception $exc) {
//            throw $exc;
//        }
//        return false;
//    }
    
    
    


}
