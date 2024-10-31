<?php 
include('app/header.php');

$modelos=sp('AUTOS_OBTENER_MODELOs()');
$argumentos='';
$nombre='';
$desde='';
$hasta='';
$ID=$_GET["t"];
$mensaje='';



function underscore($text){
     return  str_replace( ' ' ,'_',strval($text));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $identificador=$_POST['txtId'];

    if($_POST['txtId']=="0"){



        $esValido=sp("TARIFARIOS_VALIDAR('".$_POST['txtDesde']."','".$_POST['txtHasta']."')");

        if($esValido[0]["cantidad"]!="0"){
 
           $mensaje="Las fechas no son válidas, se superponen con otro calendario.";
        }else{

            $argumentos.="'".$_POST['txtNombre']."',";
            $argumentos.="'".$_POST['txtDesde']."',";
            $argumentos.="'".$_POST['txtHasta']."'";
           
            $valorDevuelto= sp('TARIFARIOS_INSERTAR('.$argumentos.')');
           $identificador= $valorDevuelto[0][0];



        };
    
       


    



    }else{

        $argumentos.=$_POST['txtId'].",";
        $argumentos.="'".$_POST['txtNombre']."',";
        $argumentos.="'".$_POST['txtDesde']."',";
        $argumentos.="'".$_POST['txtHasta']."'";
       
        sp_exec('TARIFARIOS_ACTUALIZAR('.$argumentos.')');


    }


   
    if($mensaje==""){

        foreach($modelos as $modelo){

            sp_exec( "PRECIOS_ACTUALIZAR( ".$identificador.",'".$modelo["MODELO"]."',".$_POST[underscore($modelo["MODELO"])].")" );
   
       }
   
   
        if($_GET["t"]=="0"){
           header("Location: https://3wheels.com.ar/cotizador/admin/tarifario?t=".$identificador);
           die();
   
        }


    }


   


}

if(!empty($_GET["t"])){
    
    if($_GET["t"]!="0"){
        $tarifarios=sp('TARIFARIOS_OBTENER('.$_GET["t"].')');
        $data=sp('PRECIOS_CONSULTAR('.$_GET["t"].')');
       
         $nombre=$tarifarios[0]["NOMBRE"];
         $desde=$tarifarios[0]["DESDE"];
         $hasta=$tarifarios[0]["HASTA"];
    }
   
 

 
}
/*
else{
    header("Location: https://wwww.3wheels.com.ar/cotizador/admin/tarifarios.php");
    die();
}
*/








?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h3> Tarifario</h3>
            <?php 
             if($mensaje!=""){

              ?>
   <span style="color:red ;"> <?php echo $mensaje ?>  </span>            

<?php
             }
            
            
            ?>
        </div>
        <div class="card-body">
        <form class="form" method="POST">
<div class="row">


<div class="col-lg-5">



<div class="row">
<div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Nombre</label>
                                    <input type="text" class="form-control" placeholder="" value="<?php echo $nombre ?>" name="txtNombre">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="country-floating">Desde</label>
                                    <input type="date" class="form-control" placeholder="" value="<?php echo $desde ?>"  name="txtDesde">
                                </div>
                            </div>
                            <div class=" col-6">
                                <div class="form-group">
                                    <label for="country-floating">Hasta</label>
                                    <input type="date" class="form-control" placeholder="" value="<?php echo $hasta ?>"  name="txtHasta">
                                </div>
                            </div>
                       




</div>








</div>
<div class="col-lg-1"></div>

<div class="col-lg-6">




<div class="dataTable-container">
                <table class="table  dataTable-table" id="table1">
                    <thead>
                        <tr>
                            <th data-sortable="" style="width: 200px;border-bottom:transparent !important;"><a href="#" class="dataTable-sorter">MODELO</a></th>
                            <th data-sortable="" style="border-bottom:transparent !important;" ><a href="#" class="dataTable-sorter">PRECIO BASE</a></th>
                          
                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                      foreach($modelos as $modelo){

                      
                         $precio=0; 

                         if($_GET["t"]!="0"){

                            foreach($data as $tarifa){ 
                            
                                if($tarifa["MODELO"]==$modelo["MODELO"]){
                                     $precio=$tarifa["PRECIO"];
                                }
                         }


                         }
                       
                               ?>
                        <tr style="border: 0px solid transparent;">
                            <td><?php echo $modelo["MODELO"] ?></td>
                            <td><input name="<?php echo underscore($modelo["MODELO"]) ?>" type="text" value=" <?php echo $precio ?>" class="form-control ml-2" /> </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>



</div>

<div class="col-12 d-flex justify-content-end py-4">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Actualizar</button>
                                <button type="button" class="btn btn-secondary me-1 mb-1" onclick="javascript:window.location.href='<?php if(isset($_SERVER['HTTP_REFERER'])){echo $_SERVER['HTTP_REFERER'];}else{echo 'clientes.php';} ?>';">Cerrar</button>
                            </div>
</div>

<input type="hidden" value="<?php echo $_GET["t"] ?>" name="txtId">

</form>


        </div>
    </div>
</section>
<?php include('app/footer.php');?>