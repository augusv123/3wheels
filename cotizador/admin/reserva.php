<?php include('app/header.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $argumentos='';
    $argumentos.=$_POST['txtId'].",";
    $argumentos.="'".$_POST['txtFechaRetiro']."',";
    $argumentos.="'".$_POST['txtFechaEntrega']."',";
    $argumentos.="'".$_POST['txtHoraRetiro']."',";
    $argumentos.="'".$_POST['txtHoraEntrega']."',";
    $argumentos.=$_POST['txtLugar'].",";
    $argumentos.=$_POST['txtEstado'].",";
    $argumentos.=$_POST['txtMediosDePago'].",";
    $argumentos.="'',"; //Accesorios
    $argumentos.=$_POST['txtPrecio'].",";
    $argumentos.="'".$_POST['txtModelo']."',";
    $argumentos.="'".$_POST['txtPatente']."',";
    $argumentos.="'".$_POST['txtObservaciones']."'";
    sp_exec('RESERVAS_ACTUALIZAR('.$argumentos.')');
    header("Location: reserva.php?r=".$_POST['txtId']);
    die();
}else{
    if(!empty($_GET["r"])){
        $data=sp('RESERVAS_OBTENER('.$_GET["r"].')');
        $reserva=$data[0];
        $autos=sp('AUTOS_CONSULTAR_X_MODELO("'.$reserva["MODELO"].'","'.$reserva["FECHA_RETIRO"].'","'.$reserva["FECHA_ENTREGA"].'")');

        $data=sp('TARIFARIO_CALCULAR('.$reserva[0].')');
        $cotizacion=$data;
        
         

    }
}

?>

<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" method="POST" name="frmReserva">
                        <div class="row">
                            <div class="col-12 pb-3" style="display: flex;flex-direction:row;justify-content:space-between">
                                
                            <div>                            <h3 style="margin:0px;">Reserva - # <?php echo $reserva[0] ?></h3> 
                            <small ><b><?php echo date("d-m-Y  H:i",strtotime($reserva['FECHA'])); ?> </b> </small>
                            </div>

                      

                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Patente</label>
                                    <select  class="form-select"  name="txtPatente">
                                    <option value="0"  >Seleccione...</option>
                                        <?PHP 
                                            if(count($autos)>0){
                                           foreach($autos as $auto){ ?>
                                                <option value="<?php echo $auto['PATENTE']  ?>"      ><?php echo $auto['PATENTE']." - ".$auto['MARCA']." - ".$auto['MODELO'];  ?></option>
                                        <?PHP } }
                                        
                                        if($reserva['PATENTE'] !=""){
                                        ?>

                                        <option value="<?php echo $reserva['PATENTE']  ?>"  <?php echo "selected"; ?>    ><?php echo $reserva['PATENTE']." - ".$reserva['MODELO'];  ?></option>
                                        
                                        <?php }    ?>
                                    </select>
                                </div>
                            </div>  
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Modelo</label>
                                    <input type="text" class="form-control" name="" readonly value="<?php echo $reserva["MODELO"] ?>" name="country-floating" >
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Estado</label>
                                    <select  class="form-select" name="txtEstado" >
                                        <option value="1" <?php if($reserva["ESTADO"]==1)echo "selected"; ?> >En Trámite</option>
                                        <option value="2" <?php if($reserva["ESTADO"]==2)echo "selected"; ?> >Reservado</option>
                                        <option value="3" <?php if($reserva["ESTADO"]==3)echo "selected"; ?> >Retirado</option>
                                        <option value="4" <?php if($reserva["ESTADO"]==4)echo "selected"; ?>>Entregado</option>
                                        <option value="5" <?php if($reserva["ESTADO"]==5)echo "selected"; ?>>Cancelado</option>
                                        <option value="6" <?php if($reserva["ESTADO"]==6)echo "selected"; ?>>Taller</option>
                                    </select>
                                </div>
                            </div>
                         
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Lugar</label>
                                    <select  class="form-select" name="txtLugar" >
                                        <option value="1" <?php if($reserva["LUGAR"]==1)echo "selected"; ?> >Obelisco (Av. 9 de Julio y Av. Corrientes)</option>
                                        <option value="2" <?php if($reserva["LUGAR"]==2)echo "selected"; ?>  >Aeroparque (Aeropuerto Jorge Newbery)</option>
                                        <option value="3" <?php if($reserva["LUGAR"]==3)echo "selected"; ?> >Buquebus</option>
                                        <option value="4" <?php if($reserva["LUGAR"]==4)echo "selected"; ?>  >Dot Baires Shopping</option>
                                        <option value="5" <?php if($reserva["LUGAR"]==5)echo "selected"; ?> >Unicenter Shopping</option>
                                        <option value="6" <?php if($reserva["LUGAR"]==6)echo "selected"; ?> >Tortugas Open Mall</option>
                                        <option value="7" <?php if($reserva["LUGAR"]==7)echo "selected"; ?> >Shopping Palmas del Pilar</option>
                                        <option value="8" <?php if($reserva["LUGAR"]==8)echo "selected"; ?> >Shopping Paseo Champagnat</option>
                                        <option value="9" <?php if($reserva["LUGAR"]==9)echo "selected"; ?>>R. Caamaño 1103, Villa Rosa, Buenos Aires</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Precio total</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="txtPrecio" class="form-control" placeholder="" value="<?php echo number_format(sp("RESERVAS_OBTENER_PRECIO(".$reserva["ID"].")")[0]["total"], 0, ',', '.') ?>" aria-describedby="button-addon1">
                                        <button class="btn btn-secondary" type="button" id="button-addon1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">...</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Medio de pago</label>
                                    <select  class="form-control" name="txtMediosDePago" >
                                        <option value="1" <?php if($reserva["MEDIO_PAGO"]==1)echo "selected"; ?> >Efectivo</option>
                                        <option value="2" <?php if($reserva["MEDIO_PAGO"]==2)echo "selected"; ?> >Efectivo y tarjeta</option>
                                        <option value="3" <?php if($reserva["MEDIO_PAGO"]==3)echo "selected"; ?> >Tarjeta de débito</option>
                                        <option value="4" <?php if($reserva["MEDIO_PAGO"]==4)echo "selected"; ?>>Depósito bancario</option>
                                        <option value="5" <?php if($reserva["MEDIO_PAGO"]==5)echo "selected"; ?>>Mercadopago</option>
                                        <option value="6" <?php if($reserva["MEDIO_PAGO"]==6)echo "selected"; ?>>Visa</option>
                                        <option value="7" <?php if($reserva["MEDIO_PAGO"]==6)echo "selected"; ?>>Mastercard</option>
                                        <option value="8" <?php if($reserva["MEDIO_PAGO"]==6)echo "selected"; ?>>AMEX</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Retiro</label>
                                    <input type="date" class="form-control" name="txtFechaRetiro" value="<?php echo $reserva["FECHA_RETIRO"] ?>" name="country-floating" >
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Hora</label>
                                    <select  class="form-select" name="txtHoraRetiro" >
                                        <option value="08:00" <?php if($reserva["HORA_RETIRO"]=="08:00")echo "selected"; ?>  >08:00</option>
                                        <option value="08:30" <?php if($reserva["HORA_RETIRO"]=="08:30")echo "selected"; ?> >08:30</option>
                                        <option value="09:00" <?php if($reserva["HORA_RETIRO"]=="09:00")echo "selected"; ?>  >09:00</option>
                                        <option value="09:30" <?php if($reserva["HORA_RETIRO"]=="09:30")echo "selected"; ?> >09:30</option>
                                        <option value="10:00" <?php if($reserva["HORA_RETIRO"]=="10:30")echo "selected"; ?>  >10:00</option>
                                        <option value="10:30" <?php if($reserva["HORA_RETIRO"]=="10:00")echo "selected"; ?> >10:30</option>
                                        <option value="11:00" <?php if($reserva["HORA_RETIRO"]=="11:00")echo "selected"; ?> >11:00</option>
                                        <option value="11:30" <?php if($reserva["HORA_RETIRO"]=="11:30")echo "selected"; ?> >11:30</option>
                                        <option value="12:00" <?php if($reserva["HORA_RETIRO"]=="12:00")echo "selected"; ?> >12:00</option>
                                        <option value="12:30" <?php if($reserva["HORA_RETIRO"]=="12:30")echo "selected"; ?>>12:30</option>
                                        <option value="13:00" <?php if($reserva["HORA_RETIRO"]=="13:00")echo "selected"; ?>>13:00</option>
                                        <option value="13:30" <?php if($reserva["HORA_RETIRO"]=="13:30")echo "selected"; ?>>13:30</option>
                                        <option value="14:00" <?php if($reserva["HORA_RETIRO"]=="14:00")echo "selected"; ?>>14:00</option>
                                        <option value="14:30" <?php if($reserva["HORA_RETIRO"]=="14:30")echo "selected"; ?>>14:30</option>
                                        <option value="15:00" <?php if($reserva["HORA_RETIRO"]=="15:00")echo "selected"; ?>>15:00</option>
                                        <option value="15:30" <?php if($reserva["HORA_RETIRO"]=="15:30")echo "selected"; ?>>15:30</option>
                                        <option value="16:00" <?php if($reserva["HORA_RETIRO"]=="16:00")echo "selected"; ?>>16:00</option>
                                        <option value="16:30" <?php if($reserva["HORA_RETIRO"]=="16:30")echo "selected"; ?>>16:30</option>
                                        <option value="17:00" <?php if($reserva["HORA_RETIRO"]=="17:00")echo "selected"; ?>>17:00</option>
                                        <option value="17:30" <?php if($reserva["HORA_RETIRO"]=="17:30")echo "selected"; ?>>17:30</option>
                                        <option value="18:00" <?php if($reserva["HORA_RETIRO"]=="18:00")echo "selected"; ?>>18:00</option>
                                        <option value="18:30" <?php if($reserva["HORA_RETIRO"]=="18:30")echo "selected"; ?>>18:30</option>
                                        <option value="19:00" <?php if($reserva["HORA_RETIRO"]=="19:00")echo "selected"; ?>>19:00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Entrega</label>
                                    <input type="date" class="form-control" name="txtFechaEntrega"  value="<?php echo $reserva["FECHA_ENTREGA"] ?>" name="country-floating" >
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Hora</label>
                                    <select  class="form-select" name="txtHoraEntrega" >
                                    <option value="08:00" <?php if($reserva["HORA_ENTREGA"]=="08:00")echo "selected"; ?>  >08:00</option>
                                        <option value="08:30" <?php if($reserva["HORA_ENTREGA"]=="08:30")echo "selected"; ?> >08:30</option>
                                        <option value="09:00" <?php if($reserva["HORA_ENTREGA"]=="09:00")echo "selected"; ?>  >09:00</option>
                                        <option value="09:30" <?php if($reserva["HORA_ENTREGA"]=="09:30")echo "selected"; ?> >09:30</option>
                                        <option value="10:00" <?php if($reserva["HORA_ENTREGA"]=="10:30")echo "selected"; ?>  >10:00</option>
                                        <option value="10:30" <?php if($reserva["HORA_ENTREGA"]=="10:00")echo "selected"; ?> >10:30</option>
                                        <option value="11:00" <?php if($reserva["HORA_ENTREGA"]=="11:00")echo "selected"; ?> >11:00</option>
                                        <option value="11:30" <?php if($reserva["HORA_ENTREGA"]=="11:30")echo "selected"; ?> >11:30</option>
                                        <option value="12:00" <?php if($reserva["HORA_ENTREGA"]=="12:00")echo "selected"; ?> >12:00</option>
                                        <option value="12:30" <?php if($reserva["HORA_ENTREGA"]=="12:30")echo "selected"; ?>>12:30</option>
                                        <option value="13:00" <?php if($reserva["HORA_ENTREGA"]=="13:00")echo "selected"; ?>>13:00</option>
                                        <option value="13:30" <?php if($reserva["HORA_ENTREGA"]=="13:30")echo "selected"; ?>>13:30</option>
                                        <option value="14:00" <?php if($reserva["HORA_ENTREGA"]=="14:00")echo "selected"; ?>>14:00</option>
                                        <option value="14:30" <?php if($reserva["HORA_ENTREGA"]=="14:30")echo "selected"; ?>>14:30</option>
                                        <option value="15:00" <?php if($reserva["HORA_ENTREGA"]=="15:00")echo "selected"; ?>>15:00</option>
                                        <option value="15:30" <?php if($reserva["HORA_ENTREGA"]=="15:30")echo "selected"; ?>>15:30</option>
                                        <option value="16:00" <?php if($reserva["HORA_ENTREGA"]=="16:00")echo "selected"; ?>>16:00</option>
                                        <option value="16:30" <?php if($reserva["HORA_ENTREGA"]=="16:30")echo "selected"; ?>>16:30</option>
                                        <option value="17:00" <?php if($reserva["HORA_ENTREGA"]=="17:00")echo "selected"; ?>>17:00</option>
                                        <option value="17:30" <?php if($reserva["HORA_ENTREGA"]=="17:30")echo "selected"; ?>>17:30</option>
                                        <option value="18:00" <?php if($reserva["HORA_ENTREGA"]=="18:00")echo "selected"; ?>>18:00</option>
                                        <option value="18:30" <?php if($reserva["HORA_ENTREGA"]=="18:30")echo "selected"; ?>>18:30</option>
                                        <option value="19:00" <?php if($reserva["HORA_ENTREGA"]=="19:00")echo "selected"; ?>>19:00</option>
                                    </select>
                                </div>
                            </div>
                            <div class=" col-12">
                                <h3 style="margin-bottom: 1rem;margin-top:2rem; ">Cliente</h3>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Nombre</label>
                                    <input type="text" class="form-control" placeholder="" value="<?php echo $reserva["NOMBRE"] ?>" aria-describedby="button-addon1">
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Localidad</label>
                                    <input type="text" class="form-control" placeholder="" value="<?php echo $reserva["LOCALIDAD"] ?>" aria-describedby="button-addon1">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Teléfono</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="" value="<?php echo $reserva["TELEFONO"] ?>" aria-describedby="button-addon1">
                                        <button class="btn btn-secondary" type="button" id="button-addon1" onclick="window.open('tel:<?php echo $reserva['TELEFONO'] ?>');">
                                            <svg class="svg-inline--fa fa-phone fa-w-16 fa-fw select-all" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Correo</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="" value="<?php echo $reserva["CORREO"] ?>" aria-describedby="button-addon1" >
                                            <button class="btn btn-secondary" type="button" id="button-addon1" onclick="window.open('mailto:<?php echo $reserva['CORREO'] ?>');">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
                                            <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">DNI</label>
                                    <input type="text" class="form-control" placeholder="" value="<?php echo $reserva["DNI"] ?>" aria-describedby="button-addon1">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Edad</label>
                                    <select  class="form-select" name="txtEdad" >
                                        <option value="0" <?php if($reserva["EDAD"]=="0")echo "selected"; ?>  >Menor de 25 años</option>
                                        <option value="1" <?php if($reserva["EDAD"]=="1")echo "selected"; ?> >Mayor de 25 años</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email-id-column">Observaciones</label>
                                    <textarea  class="form-control"  value="" name="txtObservaciones"  ><?php echo $reserva["OBSERVACIONES"] ?></textarea>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary me-1 mb-1" onclick="javascript:actualizar()">Actualizar</button>
                                <button type="button" class="btn btn-secondary me-1 mb-1" onclick="javascript:window.location.href='reservas.php';">Cerrar</button>
                            </div>
                        </div>
                        <input type="hidden" name="txtId" value="<?php echo $reserva[0] ?>" />
                        <input type="hidden" name="txtModelo" value="<?php echo $reserva["MODELO"] ?>" />
                        <input type="hidden" id="txtMensaje" value="<?php echo $mensaje ?>" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-lg  modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3  id="exampleModalCenterTitle">Detalle de cotización</h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <table  width="100%" class="cotable">
                    <tr style="text-align: left; background-color: #8a8585;color:white">
                        <td style="padding:10px;">ITEM</td>
                        <td style="text-align: right; padding:5px;">VALOR UNITARIO</td>
                        <td style="text-align: center;padding:5px;">CANTIDAD</td>
                        <td style="text-align: right;padding:5px;" >SUBTOTAL</td>
                    </tr>
                <?PHP 
                $total=0;

                foreach($cotizacion as $item){ ?>
                    <tr >
                        <td style="text-align: left;padding:5px;"><?php echo $item["ITEM"] ?></td>
                        <td style="text-align: right;padding:5px;"><?php echo "$ ".number_format($item["VALOR_UNITARIO"], 0, ',', '.') ?></td>
                        <td style="text-align: center;padding:5px;"><?php echo $item["CANTIDAD"] ?></td>
                        <td style="text-align: right;padding:5px;" ><?php  $subTotal=($item["VALOR_UNITARIO"]);$total+=$subTotal;echo "$ ".number_format($subTotal, 0, ',', '.'); ?></td>
                    </tr>
                <?php } ?>
                    <tr>
                        <td colspan="3" style="text-align: left;padding:10px;">TOTAL</td><td style="text-align: right;padding:5px"><b><?php echo "$ ".number_format($total, 0, ',', '.') ?></b></td>
                    </tr>
                <table>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Cerrar</span>
                </button>
            </div>
        </div>
    </div>
</div>


<script>

errores='';

function validar(control,mensaje){if(control.value.trim()=='')errores+=mensaje+"\n"};

function actualizar(){
    form=document.forms.frmReserva;

    validar(form.txtPrecio,"Completar precio");

    if(form.txtPatente.value=='0' && form.txtEstado.value!=1)errores+="Debe seleccionar una vehiculo para los estados distinto a En trámite \n";
    if(errores!=''){
    alert(errores);
    errores='';
    }else{
    form.submit();}
 
}



</script>


<?php include('app/footer.php');?>