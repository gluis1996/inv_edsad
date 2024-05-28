

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarEmpleado`(
    IN empleado_nombre TEXT
)
BEGIN
    -- Verificar si alguno de los campos está vacío
    IF empleado_nombre  IS NULL OR empleado_nombre  = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo marca está vacío';
	ELSE
            -- Si todos los campos están llenos y la fecha es válida, realizar la inserción
		INSERT INTO empleados (nombres) VALUES (empleado_nombre);
        
	END IF;
END
------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE insertar_beneficiario (
    IN p_nombre VARCHAR(100)
)
BEGIN
    -- Verificar si el campo nombre está vacío o nulo
    IF p_nombre IS NULL OR p_nombre = '' THEN SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El campo nombre no puede estar vacío';
    ELSE
        -- Insertar el registro si el campo es válido
        INSERT INTO beneficiario (nombre) VALUES (p_nombre);
    END IF;
END //
DELIMITER ;

---------------------------------------------------------DF

DELIMITER //
CREATE PROCEDURE insertar_usuario (
    IN p_nombre TEXT,
    IN p_user TEXT,
    IN p_contraseña TEXT
)
BEGIN
    -- Verificar si algún campo está vacío o nulo
    IF p_nombre IS NULL OR p_nombre = '' OR
       p_user IS NULL OR p_user = '' OR
       p_contraseña IS NULL OR p_contraseña = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Ningún campo puede estar vacío';
    ELSE
        -- Insertar el registro si los campos son válidos
        INSERT INTO usuario (nombre, user, contraseña)
        VALUES (p_nombre, p_user, p_contraseña);
    END IF;
END //
DELIMITER ;

-------------------------------------------------------------------
DELIMITER //
CREATE PROCEDURE obtener_oficinas_y_sedes()
BEGIN
    SELECT 
        o.idoficinas,
        o.nombres AS nombre_oficina,
        s.nombres AS nombre_sede
    FROM 
        oficina o
    INNER JOIN 
        sede s ON s.idsedes = o.idsedes;
END 
// DELIMITER ;
------------------------------------------------------------------------
DELIMITER //

CREATE PROCEDURE insertar_meta (
    IN p_nombre VARCHAR(255)
)
BEGIN
    -- Verificar si el campo está vacío o nulo
    IF p_nombre IS NULL OR p_nombre = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo nombre no puede estar vacío';
    ELSE
        -- Insertar el registro si el campo es válido
        INSERT INTO meta (nombre) VALUES (p_nombre);
    END IF;
END //

DELIMITER ;
------------------------------------------------------------------------
DELIMITER //
CREATE PROCEDURE insertar_oficina (
    IN p_nombres TEXT,
    IN p_idsedes INT
)
BEGIN
    -- Verificar si los campos nombres e idsedes están vacíos o nulos
    IF p_nombres IS NULL OR p_nombres = '' OR
       p_idsedes IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Los campos nombres e idsedes no pueden estar vacíos';
    ELSE
        -- Insertar el registro si los campos son válidos
        INSERT INTO oficina (nombres, idsedes) VALUES (p_nombres, p_idsedes);
    END IF;
END 
//DELIMITER ;
------------------------------------------------------------------------------
DELIMITER //
CREATE PROCEDURE insertar_sede (
    IN p_nombres TEXT
)
BEGIN
    -- Verificar si el campo nombres está vacío o nulo
    IF p_nombres IS NULL OR p_nombres = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo nombres no puede estar vacío';
    ELSE
        -- Insertar el registro si el campo es válido
        INSERT INTO sede (nombres) VALUES (p_nombres);
    END IF;
END 
// DELIMITER ;
------------------------------------------------------------------------
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_equipos_asignados_empleados`(
    IN empleado_id INT
)
BEGIN
    select 
e.idempleado, 
e.nombres as nombre_empleado, 
e.nombres as nombre_equipo, 
da.id_detalle_asignacion,
da.cod_patrimonial as cod_patrimonial, 
s.nombres as nombre_sede, 
o.nombres as nombre_oficina
from detalle_asignacion da
inner join empleados e on e.idempleado = da.idempleado 
inner join equipos eq on eq.idequipos = da.idequipos
inner join sede s on s.idsedes = da.idsedes
inner join oficina o on o.idoficinas = da.idsedes
where e.idempleado = empleado_id;
END
---------------------------------------------------------------------------------
DELIMITER //
CREATE PROCEDURE sp_insertar_a_usuaria (
    IN p_nombres TEXT
)
BEGIN
    -- Verificar si el campo nombres está vacío o nulo
    IF p_nombres IS NULL OR p_nombres = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo nombres no puede estar vacío';
    ELSE
        -- Insertar el registro si el campo es válido
        INSERT INTO a_usuaria (nombres) VALUES (p_nombres);
    END IF;
END 
// DELIMITER ;
------------------------------------------------------------------------


