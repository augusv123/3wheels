DELIMITER //

CREATE PROCEDURE RESERVAS_INSERTAR_V2(
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
    DECLARE v_id_cliente INT;
    DECLARE v_id_reserva INT;

    -- Buscar el ID del cliente basado en el DNI
    SELECT ID INTO v_id_cliente FROM CLIENTES WHERE DNI = p_dni;

    -- Si no se encuentra el cliente, insertar un nuevo registro en CLIENTES
    IF v_id_cliente IS NULL THEN
    -- Generar un ID de cliente que no exista
    SET v_id_cliente = (SELECT IFNULL(MAX(ID), 0) + 1 FROM CLIENTES);
        INSERT INTO CLIENTES (ID,DNI, NOMBRE, CORREO, EDAD, TELEFONO, LOCALIDAD)
        VALUES (v_id_cliente,p_dni, p_nombre, p_correo, p_edad, p_telefono, p_localidad);
        
    END IF;

    -- Generar un ID de reserva que no exista
    SET v_id_reserva = (SELECT IFNULL(MAX(ID), 0) + 1 FROM RESERVAS);

    -- Insertar el nuevo registro en RESERVAS
    INSERT INTO RESERVAS (
        ID, MODELO, PATENTE, FECHA_RETIRO, FECHA_ENTREGA, HORA_RETIRO, HORA_ENTREGA, OBSERVACIONES, MEDIO_PAGO, LUGAR, ID_CLIENTE, ESTADO, MISMO_LUGAR, PRECIO, COBERTURA, SILLA
    ) VALUES (
        v_id_reserva, p_modelo, p_patente , p_fecha_retiro, p_fecha_entrega, p_hora_retiro, p_hora_entrega, p_observaciones, p_medio_pago, p_lugar, v_id_cliente, p_estado, p_mismo_lugar, p_precio, p_cobertura, p_silla
    );
END //

DELIMITER ;
