<?php

require_once '../data/Conexion.class.php';

class DatosPersonales extends Conexion {
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
//            $sql = "select * from f_generar_correlativo('laboratorio') as nc";
//            $sentencia = $this->dblink->prepare($sql);
//            $sentencia->execute();
//            
//            if ($sentencia->rowCount()){
//                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
//                $nuevoCodigo = $resultado["nc"];
//                $this->setCodigoLaboratorio($nuevoCodigo);
                
                /*Insertar en la tabla laboratorio*/
                $sql = "
                    insert into candidato
                                    (
                                    doc_id,nombre,apellidos,direccion,telefono,hijos,
                                    departamento_nacimiento,ciudad_nacimiento,estado_civil,
                                    sexo,edad,email
                                    )
                    values(
                            :p_doc_id,:p_nombre,:p_apellidos,:p_direccion,p_celular,:p_hijos,
                            :p_departamento_nacimiento,:p_ciudad_nacimiento,:p_estado_civil,
                            :p_sexo,:p_edad,:p_email

                            );
                    ";
                
//                insert into laboratorio
//                                           (
//                                             doc_ID,nombre,apellidos,direccion,celular,hijos,
//                                             departamento_nacimiento,ciudad_nacimiento,estado_civil,
//                                             sexo,edad,email,Disposicion_laboral_id) 
//                    values(:p_cod_lab, :p_nomb, :p_codigo_pais)
                $sentencia = $this->dblink->prepare($sql);
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
                $sentencia->execute();
                /*Insertar en la tabla laboratorio*/
                
                /*Actualizar el correlativo*/
//                $sql = "update correlativo set numero = numero + 1 
//                    where tabla='laboratorio'";
//                $sentencia = $this->dblink->prepare($sql);
//                $sentencia->execute();
//                /*Actualizar el correlativo*/
                $this->dblink->commit();
                return true;
                
//            }else{
//                throw new Exception("No se ha configurado el correlativo para la tabla laboratorio");
//            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }
    
    public function leerDatos($p_codigoCandidato) {
        try {
            $sql = "
                    select * from candidato 
                    where doc_id = :p_doc_id
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_doc_id", $p_codigoCandidato);
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
                    candidato 
                set 
                    doc_id = :p_doc_ident,
                    nombre = :p_nombres,
                    apellidos = :p_apellidos,
                    direccion = :p_direccion,
                    telefono = :p_telefono,
                    hijos = :p_hijo,
                    departamento_nacimiento = :p_departamento,
                    ciudad_nacimiento = :p_ciudad,
                    estado_civil = :p_estado_civil,
                    sexo = :p_sexo,
                    edad = :p_edad,
                    email = :p_email
                where
                    doc_id = :p_doc_ident
                ";
            $sentencia = $this->dblink->prepare($sql);
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
                    laboratorio 
                where
                    codigo_laboratorio = :p_cod_lab
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod_lab", $this->getCodigoLaboratorio());
            $sentencia->execute();
            return true;
            
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }
    
    
    


}
