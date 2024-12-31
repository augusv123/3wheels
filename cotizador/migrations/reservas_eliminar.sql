DELIMITER //

CREATE PROCEDURE RESERVAS_ELIMINAR(
    IN p_id_reserva INT
)
BEGIN
    -- Eliminar el registro de la tabla RESERVAS basado en el ID de la reserva
    DELETE FROM RESERVAS WHERE ID = p_id_reserva;
END //

DELIMITER ;