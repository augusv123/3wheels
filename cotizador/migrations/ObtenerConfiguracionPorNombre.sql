
DELIMITER //

CREATE PROCEDURE OBTENER_CONFIGURACION_POR_NOMBRE(IN pPARAMETRO VARCHAR(255))
BEGIN
    SELECT VALOR
    FROM CONFIGURACION
    WHERE PARAMETRO = pPARAMETRO;
END //

DELIMITER ;