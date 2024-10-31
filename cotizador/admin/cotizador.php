<?php include('app/header.php');
setlocale(LC_MONETARY,"es_RA");
try {

 $entrega="";
 $retiro="";
 $cantidad="";

 if(!empty($_POST["fechaRetiro"])){

   $retiro=htmlspecialchars($_POST["fechaRetiro"]);
   $entrega=htmlspecialchars($_POST["fechaEntrega"]);
 
   $date1 = new DateTime($retiro);
   $date2 = new DateTime($entrega);
   $interval = $date1->diff($date2);

   $horaRetiro=htmlspecialchars($_POST["selHoraRetiro"]);
   $horaEntrega=htmlspecialchars($_POST["selHoraEntrega"]);

    $horasExcedentes=(strtotime($horaEntrega)-strtotime($horaRetiro))/3600;


   $cantidad=$interval->days+1;

   if($horasExcedentes>5){
     $cantidad=$cantidad+1;
   }


 }

}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}

?>

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 >Cotizador</h3>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST">
                            <div class="row">
                               
                              <div class="col-md-6 col-12">
<div class="row">
                                <div class="col-6 ">
                                    <div class="form-group">
                                        <label for="city-column">Fecha retiro</label>
                                        <input type="date"  class="form-control" placeholder="" name="fechaRetiro" id="txtDate" value="<?php echo $retiro; ?>">
                                    </div>
                                </div>

<div class="col-2 ">
                                    <div class="form-group">
                                        <label for="city-column">Hora retiro</label>
                                        <select class="form-select" name="selHoraRetiro" id="selHoraRetiro">
                                            <option value="08:00" >08:00</option>
                                            <option value="08:30">08:30</option>
                                            <option value="09:00">09:00</option>
                                            <option value="09:30">09:30</option>
                                            <option value="10:00">10:00</option>
                                            <option value="10:30">10:30</option>
                                            <option value="11:00">11:00</option>
                                            <option value="11:30">11:30</option>
                                            <option value="12:00">12:00</option>
                                            <option value="12:30">12:30</option>
                                            <option value="13:00">13:00</option>
                                            <option value="13:30">13:30</option>
                                            <option value="14:00">14:00</option>
                                            <option value="14:30">14:30</option>
                                            <option value="15:00">15:00</option>
                                            <option value="15:30">15:30</option>
                                            <option value="16:00">16:00</option>
                                            <option value="16:30">16:30</option>
                                            <option value="17:00">17:00</option>
                                            <option value="17:30">17:30</option>
                                            <option value="18:00">18:00</option>
                                            <option value="18:30">18:30</option>
                                            <option value="19:00">19:00</option>
                                        </select>
                                    </div>
                                </div>
</div>
<div class="row">
<div class="col-6 ">
                                    <div class="form-group">
                                        <label for="city-column">Fecha entrega</label>
                                        <input type="date"  class="form-control" placeholder="" name="fechaEntrega" id="txtDate" value="<?php echo $entrega; ?>">
                                    </div>
                                </div>

<div class="col-2 ">
                                    <div class="form-group">
                                        <label for="city-column">Hora entrega</label>
                                           <select class="form-select" name="selHoraEntrega" id="selHoraEntrega">
                                             <option value="08:00" >08:00</option>
                                            <option value="08:30">08:30</option>
                                            <option value="09:00">09:00</option>
                                            <option value="09:30">09:30</option>
                                            <option value="10:00">10:00</option>
                                            <option value="10:30">10:30</option>
                                            <option value="11:00">11:00</option>
                                            <option value="11:30">11:30</option>
                                            <option value="12:00">12:00</option>
                                            <option value="12:30">12:30</option>
                                            <option value="13:00">13:00</option>
                                            <option value="13:30">13:30</option>
                                            <option value="14:00">14:00</option>
                                            <option value="14:30">14:30</option>
                                            <option value="15:00">15:00</option>
                                            <option value="15:30">15:30</option>
                                            <option value="16:00">16:00</option>
                                            <option value="16:30">16:30</option>
                                            <option value="17:00">17:00</option>
                                            <option value="17:30">17:30</option>
                                            <option value="18:00">18:00</option>
                                            <option value="18:30">18:30</option>
                                            <option value="19:00">19:00</option>
                                        </select>
                                    </div>
                                </div>
                                 </div>
                            </div>
                            <div class="col-md-6 col-12" style="height:50vh;overflow:hidden;overflow-y:scroll">
                            <div style="padding:10px; position: sticky;top:0px;z-index:400;background-color:white;border-bottom:1px solid gray "><h4>Disponibles</h4></div>
                         
<?php
if($entrega!=""){
 $disponibles=sp("RESERVAS_DISPONIBILIDAD('".$entrega."','".$retiro."')");

 if(count($disponibles)==0){ echo "No hay autos disponibles para las fechas seleccionadas";};

 foreach($disponibles as $auto)
 {

  $cotizacion=sp("RESERVAS_COTIZAR(".$cantidad.",'".$auto["MODELO"]."')");

  $precioTotal="Consultar";

  if(count($cotizacion)>0)
  {
    $precioTotal= "$ ".number_format($cotizacion[0]["TOTAL"], 2, ',', '.') ;
  };
 
?> 

    <div class="card">
                <div class="card-body py-4 px-0">
                    <div class="d-flex align-items-left">
                      
                        <div class="ms-3 name">
                            <h5 class="font-bold"><?php echo $auto["MODELO"] ?></h5>
                            <h6 class="text-muted mb-0"><?php echo $auto["MARCA"]." - Total ".$precioTotal." - ".$cantidad." dias"; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
<?php
 }
}

?>


                            </div>



                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Cotizar</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>


                            </div>
                        </form>







                    </div>
                </div>
            </div>
        </div>



    </div>
</section>



<script>
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;


    document.getElementById("txtDate").setAttribute('min', maxDate);

    document.getElementById("selHoraRetiro").value = "<?php echo $horaRetiro ?>";
    document.getElementById("selHoraEntrega").value = "<?php echo $horaEntrega ?>";

</script>



<?php include('app/footer.php');?>