<?php
require_once ('conexion.php');

class modelo_oficina{

    public static function model_buscar(){

    }

    public static function model_listar(){
        try {
            $sql = "call obtener_oficinas_y_sedes();";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo Meta ".$th->getMessage();
        }
        
        
    }
    //REGISTRAR SEDE---------------
    
    public static function model_agregar_sede($data){
        try {
            $sql = "CALL insertar_sede(?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['nombre_sede'],PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo Sede ".$th->getMessage();
        }
    }

    //ELIMINAR SEDE----------------------
    public static function model_eliminar_sede($data){
        try {
            $sql = "delete from sede where idsedes=?";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['idsd'],PDO::PARAM_STR);
            
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo Sede ".$th->getMessage();
        }
    }
    ///LISTAR SEDE
    
    public static function model_listar_sede(){
        try {
            $sql = "select * from sede;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo sede ".$th->getMessage();
        }
    }


    // REGISTRAR OFICINA
    public static function model_agregar($data){
        try {
            $sql = "CALL insertar_oficina(?,?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['nombre_oficina'],PDO::PARAM_STR);
            $stmp->bindParam(2,$data['idsede'],PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo oficina ".$th->getMessage();
        }
        
    }
    //REGISTRAR AREA USUARIA
    public static function model_agregar_area_usuaria($data){
        try {
            $sql = "Call sp_insertarUsuario(?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['nombre_areaU'],PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo Oficina ".$th->getMessage();
        }
    }



    public static function model_eliminar($data){
        try {
            $sql = "delete from oficina where idoficinas=?";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['idofi'],PDO::PARAM_STR);
            
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo Oficina ".$th->getMessage();
        }
        
    }

    public static function model_listar_area_usuaria(){
        try {
            $sql = "SELECT * FROM a_usuaria;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo Oficina ".$th->getMessage();
        }   
    }

    public static function model_actualizar(){
        
    }

}
