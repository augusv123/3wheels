SELECT DISTINCT(MODELO), '' AS PRECIO, MARCA, MODELO, IMAGEN, MINIATURA_1, MINIATURA_2, MINIATURA_3, PATENTE 
FROM AUTOS 
WHERE PATENTE NOT IN (
    SELECT PATENTE 
    FROM RESERVAS 
    WHERE 
    (pRetiro BETWEEN fecha_retiro AND fecha_entrega)
    OR
    (pEntrega BETWEEN fecha_retiro AND fecha_entrega)
    OR
    (fecha_retiro BETWEEN pRetiro AND pEntrega)
    OR
    (fecha_entrega BETWEEN pRetiro AND pEntrega)
)