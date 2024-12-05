BEGIN

if exists(select * from PRECIOS where ID_TARIFARIO=pId and MODELO=pModelo) then
begin
update PRECIOS set PRECIO=pPrecio, PRECIO_PROMO=pPrecioPromo where ID_TARIFARIO=pId and MODELO=pModelo;
end;
else
begin
insert into PRECIOS values (pPrecio, pId,pModelo,pPrecioPromo);
end;
end if;

END