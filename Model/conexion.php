<?php 

class conexion {

    static public function conectar(){
        try {
            $link = new PDO("mysql:host=localhost;dbname=equipos_informa","root","");      
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            return $link;
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }
    

    static public function conectar_incidencias(){
        try {
            $link = new PDO("mysql:host=localhost;dbname=sistemas_tikets","root","");      
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            return $link;
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }

}
