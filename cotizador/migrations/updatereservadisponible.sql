select DISTINCT(MODELO), '' AS PRECIO, MARCA, MODELO, IMAGEN, MINIATURA_1, MINIATURA_2,MINIATURA_3, PATENTE from AUTOS where patente not in (
select patente 
from RESERVAS 
where 
(pRetiro>=fecha_retiro and pRetiro<=fecha_entrega)
or
(pEntrega>=fecha_retiro and pEntrega<=fecha_entrega)
    )