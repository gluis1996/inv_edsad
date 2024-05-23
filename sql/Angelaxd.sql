

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
