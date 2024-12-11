    DELIMITER $$

    CREATE PROCEDURE PRECIOS_ACTUALIZAR(
        IN pId INT,
        IN pModelo VARCHAR(255),
        IN pPrecio DECIMAL(10,2),
        IN pPrecioPromo DECIMAL(10,2)
    )
    BEGIN

        IF EXISTS (SELECT * FROM PRECIOS WHERE ID_TARIFARIO = pId AND MODELO = pModelo) THEN
            UPDATE PRECIOS 
            SET PRECIO = pPrecio, PRECIO_PROMO = pPrecioPromo 
            WHERE ID_TARIFARIO = pId AND MODELO = pModelo;
        ELSE
            INSERT INTO PRECIOS (PRECIO, ID_TARIFARIO, MODELO, PRECIO_PROMO) 
            VALUES (pPrecio, pId, pModelo, pPrecioPromo);
        END IF;

    END$$
    DELIMITER ;
