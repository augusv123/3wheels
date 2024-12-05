DELIMITER //

CREATE PROCEDURE RESERVAS_ACTUALIZAR_V2(
    IN p_ID INT,
    IN p_nombre VARCHAR(50),
    IN p_dni INT,
    IN p_correo VARCHAR(50),
    IN p_telefono VARCHAR(20),
    IN p_localidad VARCHAR(50),
    IN p_edad INT,
    IN p_fecha_retiro VARCHAR(10),
    IN p_fecha_entrega VARCHAR(10),
    IN p_hora_retiro VARCHAR(5),
    IN p_hora_entrega VARCHAR(5),
    IN p_lugar VARCHAR(50),
    IN p_medio_pago INT,
    IN p_precio DECIMAL(10,0),
    IN p_modelo VARCHAR(50),
    IN p_mismo_lugar BIT,
    IN p_cobertura BIT,
    IN p_silla BIT,
    IN p_patente VARCHAR(50),
    IN p_observaciones VARCHAR(255),
    IN p_estado INT
)
BEGIN
DECLARE v_cliente_id INT;

-- Buscar cliente por DNI
SELECT id INTO v_cliente_id
FROM clientes
WHERE dni = p_dni;

-- Si el cliente existe, actualizar sus datos
IF v_cliente_id IS NOT NULL THEN
    UPDATE clientes
    SET nombre = p_nombre,
        correo = p_correo,
        telefono = p_telefono,
        localidad = p_localidad,
        edad = p_edad
    WHERE id = v_cliente_id;
END IF;
-- Si el cliente no existe, crear un nuevo registro y obtener el ID
IF v_cliente_id IS NULL THEN
    SET v_cliente_id = (SELECT IFNULL(MAX(ID), 0) + 1 FROM CLIENTES);
    INSERT INTO clientes (ID,NOMBRE, DNI, CORREO, TELEFONO, LOCALIDAD, EDAD)
    VALUES (v_cliente_id, p_nombre, p_dni, p_correo, p_telefono, p_localidad, p_edad);
    
END IF;

-- Actualizar la reserva por el ID dado
UPDATE reservas
SET modelo = p_modelo,
    patente = p_patente,
    fecha_retiro = p_fecha_retiro,
    fecha_entrega = p_fecha_entrega,
    hora_retiro = p_hora_retiro,
    hora_entrega = p_hora_entrega,
    observaciones = p_observaciones,
    medio_pago = p_medio_pago,
    lugar = p_lugar,
    id_cliente = v_cliente_id,
    estado = p_estado,
    mismo_lugar = p_mismo_lugar,
    precio = p_precio,
    cobertura = p_cobertura,
    silla = p_silla
WHERE id = p_ID;
END //

DELIMITER ;
