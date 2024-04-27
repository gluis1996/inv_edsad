<?php
require_once "conexion.php";
require_once ('../Model/dto/onu.php');
class radius{

private $variable; 
public function __construct(onu $onu) {
    $this->variable = $onu;
}

    
public function buscargrupo() {
    try {
        $sql = "SELECT *FROM datos where vlan = ? and datos = ?";
        $stmmp = conexion::conectar()->prepare($sql);
        $stmmp->bindParam(1,$this->variable->vlan,PDO::PARAM_STR);
        $stmmp->bindParam(2,$this->variable->upload_speed_profile_name,PDO::PARAM_STR);
        $stmmp->execute();
        return $stmmp-> fetchAll();
    } catch (PDOException $e) {
        return "Erroe en consulta de color ".$e->getMessage();
    }
}

public static function buscar_mac($username) {
    try {
        $sql = "SELECT * FROM abn_sn where username = ?";
        $stmmp = conexion::conectar()->prepare($sql);
        $stmmp->bindParam(1,$username,PDO::PARAM_STR);
        $stmmp->execute();
        return $stmmp-> fetchAll();
    } catch (PDOException $e) {
        return "Erroe en consulta de color ".$e->getMessage();
    }
}

public static function buscar_perfil($grupo) {
    try {
        $sql = "SELECT *FROM radgroupreply where groupname = ?";
        $stmmp = conexion::conexionradius()->prepare($sql);
        $stmmp->bindParam(1,$grupo,PDO::PARAM_STR);
        $stmmp->execute();
        return $stmmp-> fetchAll();
    } catch (PDOException $e) {
        return "Erroe en consulta de color ".$e->getMessage();
    }
}


public static function buscar_userinfo($username) {
    try {
        $sql = "SELECT username FROM userinfo WHERE SUBSTRING_INDEX(username, '@', 1) = ?;";
        $stmmp = conexion::conexionradius()->prepare($sql);
        $stmmp->bindParam(1,$username,PDO::PARAM_STR);
        $stmmp->execute();
        return $stmmp-> fetchAll();
    } catch (PDOException $e) {
        return "Erroe en consulta de color ".$e->getMessage();
    }
}


public static function registrar_userinfo($userinfo){
    try {
        $sql = "INSERT INTO userinfo (username,creationdate,creationby,updatedate) VALUES (?,?,?,?)";
        $stmmp = conexion::conexionradius()->prepare($sql);
        $stmmp->bindParam(1,$userinfo['username'],PDO::PARAM_STR);
        $stmmp->bindParam(2,$userinfo['creationdate'],PDO::PARAM_STR);
        $stmmp->bindParam(3,$userinfo['creationby'],PDO::PARAM_STR);
        $stmmp->bindParam(4,$userinfo['updatedate'],PDO::PARAM_STR);
        
        if ($stmmp->execute()) {
            return 'ok';
        }
    }  catch (PDOException $e) {
        return "Erroe en consulta ".$e->getMessage();
    }
}

public static function registrar_radcheck($radcheck){
    try {
        $sql = "INSERT INTO radcheck (username,attribute,op,value) VALUES (?,?,?,?)";
        $stmmp = conexion::conexionradius()->prepare($sql);
        $stmmp->bindParam(1,$radcheck['username'],PDO::PARAM_STR);
        $stmmp->bindParam(2,$radcheck['attribute'],PDO::PARAM_STR);
        $stmmp->bindParam(3,$radcheck['op'],PDO::PARAM_STR);
        $stmmp->bindParam(4,$radcheck['value'],PDO::PARAM_STR);
        if ($stmmp->execute()) {
            return 'ok';
        }
    }  catch (PDOException $e) {
        return "Erroe en consulta ".$e->getMessage();
    }
}

public static function registrar_radusergroup($radusergroup){
    try {
        $sql = "INSERT INTO radusergroup (username,groupname,priority) VALUES (?,?,?)";
        $stmmp = conexion::conexionradius()->prepare($sql);
        $stmmp->bindParam(1,$radusergroup['username'],PDO::PARAM_STR);
        $stmmp->bindParam(2,$radusergroup['groupname'],PDO::PARAM_STR);
        $stmmp->bindParam(3,$radusergroup['priority'],PDO::PARAM_STR);
        if ($stmmp->execute()) {
            return 'ok';
        }
    }  catch (PDOException $e) {
        return "Erroe en consulta ".$e->getMessage();
    }
}


public static function listar_radgroupreply(){
    try {
        //listado noc
        $sql = "SELECT * FROM radgroupreply;";
        $stmmp = conexion::conexionradius()->prepare($sql);
        $stmmp->execute();
        return $stmmp-> fetchAll();
    } catch (PDOException $e) {
        return "Erroe en consulta de color ".$e->getMessage();
    }

}

public static function buscar_radcheck($usermane){
    try {
        //$sql = "SELECT * FROM radius.radcheck where SUBSTRING_INDEX(username, '@', 1) = ? OR value = ?;";
        $sql = "SELECT 
                    rc.id as id, 
                    rc.username as username,  
                    rc.value as value,
                    (
                        SELECT 
                            GROUP_CONCAT(DISTINCT rug.groupname) AS groupname
                        FROM radusergroup rug
                        WHERE rug.username = rc.username
                            AND rug.groupname != 'daloRADIUS-Disabled-Users'
                        GROUP BY rug.username
                    ) as plan,
                    (
                    SELECT 
                        CASE 
                            WHEN SUM(CASE WHEN groupname = 'daloRADIUS-Disabled-Users' THEN 1 ELSE 0 END) > 0 THEN 'cortado' 
                            ELSE 'activo' 
                        END AS estado
                    FROM radusergroup rug
                    WHERE rug.username = rc.username
                    GROUP BY username
                    )as estado
                FROM radcheck rc
                where SUBSTRING_INDEX(username, '@', 1) = ? OR value = ?;";
        $stm = conexion::conexionradius()->prepare($sql);
        $stm->bindParam(1,$usermane,PDO::PARAM_STR);
        $stm->bindParam(2,$usermane,PDO::PARAM_STR);
        $stm->execute();
        return $stm->fetchAll();
    } catch (PDOException $e) {
        return 'Error -> '.$e;
    }
}





public static function listar_radcheck(){
    try {
        $sql = "SELECT
                    rc.id as id, 
                    rc.username as username,  
                    rc.value as value,
                    (
                        SELECT 
                            GROUP_CONCAT(DISTINCT rug.groupname) AS groupname
                        FROM radusergroup rug
                        WHERE rug.username = rc.username
                            AND rug.groupname != 'daloRADIUS-Disabled-Users'
                        GROUP BY rug.username
                    ) as plan,
                    (
                    SELECT 
                        CASE 
                            WHEN SUM(CASE WHEN groupname = 'daloRADIUS-Disabled-Users' THEN 1 ELSE 0 END) > 0 THEN 'cortado' 
                            ELSE 'activo' 
                        END AS estado
                    FROM radusergroup rug
                    WHERE rug.username = rc.username
                    GROUP BY username
                    )as estado
                FROM radcheck rc LIMIT 50; ";
        $stm = conexion::conexionradius()->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    } catch (PDOException $e) {
        return 'Error -> '.$e;
    }
}


public static function delete_username($tabla, $username){
    try {
        $sql = "DELETE FROM $tabla WHERE username = ?;";
        $stm = conexion::conexionradius()->prepare($sql);
        $stm->bindParam(1,$username,PDO::PARAM_STR);
        if ($stm->execute()) {
            return 'ok';
        }
    } catch (PDOException $e) {
        return 'Error -> '.$e;
    }
}


public static function buscar_raddacct($username) {
    try {
        $sql = "SELECT * FROM radacct WHERE username = ? order by  acctstarttime desc;";
        $stm = conexion::conexionradius()->prepare($sql);
        $stm->bindParam(1,$username,PDO::PARAM_STR);
        $stm->execute();
        return $stm->fetchAll();
    } catch (PDOException $e) {
        return 'Error -> '.$e;
    }
}

public static function buscar_raddacct_ultima_conexion($username) {
    try {
        $sql = "SELECT username,  nasportid, acctstarttime, nasipaddress FROM radius.radacct where username like ? ORDER BY acctstarttime DESC limit 1;";
        $stm = conexion::conexionradius()->prepare($sql);
        $stm->bindParam(1,$username,PDO::PARAM_STR);
        $stm->execute();
        return $stm->fetchAll();
    } catch (PDOException $e) {
        return 'Error -> '.$e;
    }
}


public static function listar_toda_raddacct_ultima_conexion() {
    try {
        $sql = "SELECT ra.username, ra.nasportid, MAX(ra.acctstarttime) AS acctstarttime, ra.nasipaddress 
                FROM radius.radacct ra
                INNER JOIN (
                    SELECT username, MAX(acctstarttime) AS max_acctstarttime
                    FROM radius.radacct
                    GROUP BY username
                ) max_dates ON ra.username = max_dates.username AND ra.acctstarttime = max_dates.max_acctstarttime
                GROUP BY ra.username, ra.nasipaddress, ra.nasportid, acctstarttime
                LIMIT 50000;
                ";
        $stm = conexion::conexionradius()->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    } catch (PDOException $e) {
        return 'Error -> '.$e;
    }
}


public static function update_radgroupreply($groupname,$username){
    try {
        $sql = "UPDATE `radius`.`radusergroup` SET groupname = ?, priority = 1  WHERE username = ?;";
        $stm = conexion::conexionradius()->prepare($sql);
        $stm->bindParam(1,$groupname,PDO::PARAM_STR);
        $stm->bindParam(2,$username,PDO::PARAM_STR);
        if ($stm->execute()) {
            return 'ok';
        }
    } catch (PDOException $e) {
        return 'Error -> '.$e;
    }
}

public static function update_radcheck($value,$id){
    try {
        $sql = "UPDATE radius.radcheck SET value =? WHERE id = ?;";
        $stm = conexion::conexionradius()->prepare($sql);
        $stm->bindParam(1,$value,PDO::PARAM_STR);
        $stm->bindParam(2,$id,PDO::PARAM_STR);
        if ($stm->execute()) {
            return 'ok';
        }
    } catch (PDOException $e) {
        return 'Error -> '.$e;
    }
}


public static function buscar_por_abonado($usermane){
    try {
        $sql = "SELECT 
                rc.id as id, 
                rc.username as username,  
                rc.value as value,
                    (
                        SELECT 
                            GROUP_CONCAT(DISTINCT rug.groupname) AS groupname
                        FROM radusergroup rug
                        WHERE rug.username = rc.username
                            AND rug.groupname != 'daloRADIUS-Disabled-Users'
                        GROUP BY rug.username
                    ) as plan,
                    (
                    SELECT 
                        CASE 
                            WHEN SUM(CASE WHEN groupname = 'daloRADIUS-Disabled-Users' THEN 1 ELSE 0 END) > 0 THEN 'cortado' 
                            ELSE 'activo' 
                        END AS estado
                    FROM radusergroup rug
                    WHERE rug.username = rc.username
                    GROUP BY username
                    )as estado
                FROM radcheck rc
                WHERE SUBSTRING_INDEX(rc.username, '@', 1) IN ($usermane);";
        $stm = conexion::conexionradius()->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    } catch (PDOException $e) {
        return 'Error -> '.$e;
    }
}

public static function buscar_por_abonado_por_mac($usermane){
    try {
        $sql = "SELECT 
                rc.id as id, 
                rc.username as username,  
                rc.value as value,
                    (
                        SELECT 
                            GROUP_CONCAT(DISTINCT rug.groupname) AS groupname
                        FROM radusergroup rug
                        WHERE rug.username = rc.username
                            AND rug.groupname != 'daloRADIUS-Disabled-Users'
                        GROUP BY rug.username
                    ) as plan,
                    (
                    SELECT 
                        CASE 
                            WHEN SUM(CASE WHEN groupname = 'daloRADIUS-Disabled-Users' THEN 1 ELSE 0 END) > 0 THEN 'cortado' 
                            ELSE 'activo' 
                        END AS estado
                    FROM radusergroup rug
                    WHERE rug.username = rc.username
                    GROUP BY username
                    )as estado
                FROM radcheck rc
                WHERE value IN ($usermane);";
        $stm = conexion::conexionradius()->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    } catch (PDOException $e) {
        return 'Error -> '.$e;
    }
}


public static function buscar_por_abonado_por_nodo($usermane){
    try {
        $sql = "SELECT 
                    rc.id as id, 
                    rc.username as username,  
                    rc.value as value,
                    (
                        SELECT 
                            GROUP_CONCAT(DISTINCT rug.groupname) AS groupname
                        FROM radusergroup rug
                        WHERE rug.username = rc.username
                            AND rug.groupname != 'daloRADIUS-Disabled-Users'
                        GROUP BY rug.username
                    ) as plan,
                    (
                    SELECT 
                        CASE 
                            WHEN SUM(CASE WHEN groupname = 'daloRADIUS-Disabled-Users' THEN 1 ELSE 0 END) > 0 THEN 'cortado' 
                            ELSE 'activo' 
                        END AS estado
                    FROM radusergroup rug
                    WHERE rug.username = rc.username
                    GROUP BY username
                    )as estado
                FROM radcheck rc
                WHERE SUBSTRING_INDEX(rc.username, '@', -1) IN ($usermane);";
        $stm = conexion::conexionradius()->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    } catch (PDOException $e) {
        return 'Error -> '.$e;
    }
}








}

