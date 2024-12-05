DELIMITER //

CREATE PROCEDURE RESERVAS_FILTRAR_V2(
    IN pTexto VARCHAR(50),
    IN pPagina INT
)
BEGIN
    SELECT RESERVAS.* , CLIENTES.NOMBRE, CLIENTES.CORREO, CLIENTES.TELEFONO, CLIENTES.LOCALIDAD, CLIENTES.DNI
    FROM RESERVAS
    LEFT JOIN CLIENTES ON RESERVAS.ID_CLIENTE = CLIENTES.ID
    where 
    PATENTE like concat('%', pTexto,'%') or
    MODELO like concat('%', pTexto,'%') OR
    LUGAR like concat('%', pTexto,'%') OR
    DATE_FORMAT(FECHA_ENTREGA, "%d-%m-%Y") like concat('%', pTexto,'%') OR
    DATE_FORMAT(FECHA_RETIRO, "%d-%m-%Y") like concat('%', pTexto,'%') 
    limit pPagina,10;
END //

DELIMITER ;




