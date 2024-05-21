DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE insertar_equipo(
    IN p_modelo TEXT,
    IN p_descripcion TEXT,
    IN p_fecha_registro DATE,
    IN p_idmarca INT
)
BEGIN
    -- Verificar si alguno de los campos está vacío
    IF p_modelo IS NULL OR p_modelo = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo modelo está vacío';
    ELSEIF p_descripcion IS NULL OR p_descripcion = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo descripcion está vacío';
    ELSEIF p_fecha_registro IS NULL OR p_fecha_registro = '0000-00-00' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error: La fecha de registro no es válida';
    ELSEIF p_idmarca IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo idmarca está vacío';
    ELSE
        -- Si todos los campos están llenos y la fecha es válida, realizar la inserción
        INSERT INTO `equipos_informaticos`.`equipos` (
            `modelo`,
            `descripcion`,
            `fecha_registro`,
            `idmarca`
        ) VALUES (
            p_modelo, p_descripcion, p_fecha_registro, p_idmarca
        );
    END IF;
END$$
DELIMITER ;


