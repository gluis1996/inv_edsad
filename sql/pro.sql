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



CREATE PROCEDURE `sp_listar_historial_asignacion`(IN p_patrimonial text)
BEGIN
    SELECT 
ha.id_historial,
ha.id_detalle_asignacion,
s.nombres as nombre_sede,
ofi.nombres as nombre_oficina,
concat(eq.modelo, "  ", eq.descripcion, "  ", ma.nombre) as equipo,
usu.nombre as nombre_usuario,
em.nombres as nombre_empleado,
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
where ha.cod_patrimonial = p_patrimonial
order by ha.fecha desc;
END


///TRIGGER para detalle asignacion
DROP TRIGGER IF EXISTS `after_detalle_asignacion_delete`;
DELIMITER $$
CREATE TRIGGER `after_detalle_asignacion_delete` AFTER DELETE ON `detalle_asignacion` FOR EACH ROW BEGIN
    INSERT INTO historial_asignacion (id_detalle_asignacion, idsedes, idoficinas, idequipos, idusuario, idempleado, cod_patrimonial, vida_util, estado, fecha_asignacion, accion)
    VALUES (OLD.id_detalle_asignacion, OLD.idsedes, OLD.idoficinas, OLD.idequipos, OLD.idusuario, OLD.idempleado, OLD.cod_patrimonial, OLD.vida_util, 'eliminado', OLD.fecha_asignacion, 'DELETE');
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_detalle_asignacion_insert`;
DELIMITER $$
CREATE TRIGGER `after_detalle_asignacion_insert` AFTER INSERT ON `detalle_asignacion` FOR EACH ROW BEGIN
    INSERT INTO historial_asignacion (id_detalle_asignacion, idsedes, idoficinas, idequipos, idusuario, idempleado, cod_patrimonial, vida_util, estado, fecha_asignacion, accion)
    VALUES (NEW.id_detalle_asignacion, NEW.idsedes, NEW.idoficinas, NEW.idequipos, NEW.idusuario, NEW.idempleado, NEW.cod_patrimonial, NEW.vida_util, NEW.estado, NEW.fecha_asignacion, 'INSERT');
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_detalle_asignacion_update`;
DELIMITER $$
CREATE TRIGGER `after_detalle_asignacion_update` AFTER UPDATE ON `detalle_asignacion` FOR EACH ROW BEGIN
    INSERT INTO historial_asignacion (id_detalle_asignacion, idsedes, idoficinas, idequipos, idusuario, idempleado, cod_patrimonial, vida_util, estado, fecha_asignacion, accion)
    VALUES (OLD.id_detalle_asignacion, OLD.idsedes, OLD.idoficinas, OLD.idequipos, OLD.idusuario, OLD.idempleado, OLD.cod_patrimonial, OLD.vida_util, 'actualizado', OLD.fecha_asignacion, 'UPDATE');
END
$$
DELIMITER ;




//////////////////////////

DELIMITER $$
CREATE PROCEDURE sp_listar_detalle_adquisicion()
BEGIN
    select 
da.id_detalle_aquisicion as id,
a.id_area_usuaria as area_id,
a.nombres as area_nombre,
b.idbeneficiario as idbeneficiario,
b.nombre as beneficiario_nombre,
eq.idequipos as equipo_id,
concat(m.nombre,' ',eq.modelo,' ',eq.descripcion) as equipo,
me.idmeta as meta_id,
me.nombre as meta_nombre,
da.anio_aquisicion as año,
da.cantidad as cantidad
from detalle_adquisicion da
inner join a_usuaria a on da.id_area_usuaria= a.id_area_usuaria
inner join beneficiario b on b.idbeneficiario=da.idbeneficiario
inner join equipos eq on eq.idequipos=da.idequipos
inner join marca m on m.idmarca=eq.idmarca
inner  join meta me on me.idmeta=da.idmeta;
END$$
DELIMITER ;
