DELIMITER $$

CREATE PROCEDURE reservas_por_estado(IN estado_param VARCHAR(50))
BEGIN
    SELECT 
        *
    FROM 
        reservas
    LEFT JOIN 
        clientes
    ON 
        reservas.id_cliente = clientes.id
    WHERE 
        reservas.estado = estado_param;
END$$

DELIMITER ;