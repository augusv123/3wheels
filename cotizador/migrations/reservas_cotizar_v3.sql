BEGIN
    DECLARE precio INT DEFAULT 0;
    DECLARE precio_promo INT DEFAULT 0;
    DECLARE precio_total INT DEFAULT 0;
    DECLARE precio_total_promo INT DEFAULT 0;
    DECLARE pFactor FLOAT DEFAULT 1;
    DECLARE dia_actual DATE;

    SET dia_actual = pRetiro;

    -- Iterar sobre cada día en el rango
    WHILE dia_actual < DATE_ADD(pRetiro, INTERVAL pCantidad DAY) DO
        SELECT p.PRECIO, p.PRECIO_PROMO 
        INTO precio, precio_promo
        FROM TARIFARIOS t 
        INNER JOIN PRECIOS p ON t.ID = p.ID_TARIFARIO 
        WHERE t.DESDE <= dia_actual 
          AND t.HASTA >= dia_actual 
          AND p.MODELO = pModelo
        LIMIT 1;

        -- Si no se encuentran precios, inicializar en 0
        IF precio IS NULL OR precio_promo IS NULL THEN
            SET precio = 0;
            SET precio_promo = 0;
        END IF;

        -- Sumar el precio del día actual al total
        SET precio_total = precio_total + precio;

        IF precio_promo = 0 THEN
            SET precio_total_promo = precio_total_promo + precio;
        ELSE
            SET precio_total_promo = precio_total_promo + precio_promo;
        END IF;

        -- Pasar al siguiente día
        SET dia_actual = DATE_ADD(dia_actual, INTERVAL 1 DAY);
    END WHILE;

    -- Aplicar el factor de días correspondiente
    SELECT FACTOR INTO pFactor
    FROM FACTOR_DIAS
    WHERE DIAS = IF(pCantidad > 30, 30, pCantidad)
    LIMIT 1;

    IF pFactor IS NULL THEN
        SET pFactor = 1;
    END IF;

    -- Devolver el precio final
    SELECT 
        REPLACE(FORMAT((precio_total * pFactor), 0), ',', '') AS PRECIO,
        REPLACE(FORMAT((precio_total_promo * pFactor), 0), ',', '') AS PRECIO_PROMO;
END