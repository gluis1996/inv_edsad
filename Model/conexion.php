<?php 

class conexion {

    static public function conectar(){
        try {
            $link = new PDO("mysql:host=localhost;dbname=bienes_informaticos","root","");      
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            return $link;
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }


}
