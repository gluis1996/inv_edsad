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



DELIMITER $$
CREATE PROCEDURE sp_listar_historial_asignacion(IN p_patrimonial text)
BEGIN
    SELECT 
ha.id_historial,
ha.id_detalle_asignacion,
s.nombres,
ofi.nombres,
concat(eq.modelo, "  ", eq.descripcion, "  ", ma.nombre),
usu.nombre,
em.nombres,
ha.cod_patrimonial,
ha.vida_util,
ha.estado,
ha.fecha_asignacion,
ha.accion,
ha.fecha
FROM equipos_informaticos.historial_asignacion  ha
inner join sede s on s.idsedes = ha.idsedes
inner join oficina ofi on ofi.idoficinas=ha.idsedes
inner join equipos eq on eq.idequipos=ha.idequipos
inner join usuario usu on usu.idusuario = ha.idusuario
inner join empleados em on em.idempleado = ha.idempleado
inner join marca ma on ma. idmarca = eq.idmarca
where ha.cod_patrimonial = p_patrimonial;
END$$
DELIMITER ;


