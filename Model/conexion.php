<?php 

class conexion {

    static public function conectar(){
        try {
            $link = new PDO("mysql:host=192.168.10.51;dbname=integracionesolt","integracion","integracion");      
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            return $link;
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }

    static public function conexionradius(){
        try {
            $link2 = new PDO("mysql:host=localhost:3307;dbname=radius","radius","T#t#r$0&");      
            $link2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            return $link2;
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }

}
