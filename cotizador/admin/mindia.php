<?php 
include('app/header.php');

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



        // $esValido=sp("MIN_ALQUILER_VALIDAR('".$_POST['txtDesde']."','".$_POST['txtHasta']."')");

        // if($esValido[0]["cantidad"]!="0"){
 
        //    $mensaje="Las fechas no son válidas, se superponen con otro calendario.";
        // }else{

        //     $argumentos.="'".$_POST['txtNombre']."',";
        //     $argumentos.="'".$_POST['txtDesde']."',";
        //     $argumentos.="'".$_POST['txtHasta']."'";
           
        //     $valorDevuelto= sp('MIN_ALQUILER_INSERTAR('.$argumentos.')');
        //    $identificador= $valorDevuelto[0][0];



        // };
    
       


        $argumentos.="'".$_POST['txtNombre']."',";
        $argumentos.="'".$_POST['txtValor']."',";
        $argumentos.="'".$_POST['txtDesde']."',";
        $argumentos.="'".$_POST['txtHasta']."'";
        $valorDevuelto= sp('MIN_ALQUILER_INSERTAR('.$argumentos.')');
       $identificador= $valorDevuelto[0][0];
    



    }else{

        $argumentos.=$_POST['txtId'].",";
        $argumentos.="'".$_POST['txtNombre']."',";
        $argumentos.="'".$_POST['txtValor']."',";
        $argumentos.="'".$_POST['txtDesde']."',";
        $argumentos.="'".$_POST['txtHasta']."'";
       
        sp_exec('MIN_ALQUILER_ACTUALIZAR('.$argumentos.')');
        header("Location: https://wwww.3wheels.com.ar/cotizador/admin/mindiasreserva.php");
        // header("Location: /3wheels/cotizador/admin/mindiasreserva.php");
        die();

    }


   
    // if($mensaje==""){

    // //     foreach($modelos as $modelo){

    // //         sp_exec( "PRECIOS_ACTUALIZAR( ".$identificador.",'".$modelo["MODELO"]."',".$_POST[underscore($modelo["MODELO"])].")" );
   
    // //    }
   
   
    //     if($_GET["t"]=="0"){
    //       header("Location: https://wwww.3wheels.com.ar/cotizador/admin/mindia?t=".$identificador);
    //       die();
   
    //     }


    // }


   


}

if(!empty($_GET["t"])){
    
    if($_GET["t"]!="0"){
        $MIN_ALQUILER=sp('MIN_ALQUILER_OBTENER_POR_ID('.$_GET["t"].')');
        $data=sp('PRECIOS_CONSULTAR('.$_GET["t"].')');
       
         $nombre=$MIN_ALQUILER[0]["nombre"];
         $desde=$MIN_ALQUILER[0]["desde"];
         $hasta=$MIN_ALQUILER[0]["hasta"];
         $valor=$MIN_ALQUILER[0]["valor"];
    }
   
 

 
}
/*
else{
    header("Location: https://wwww.3wheels.com.ar/cotizador/admin/MIN_ALQUILER.php");
    die();
}
*/








?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h3> Crear nuevo minimo de dias para alquiler</h3>
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


<div class="col-lg-12">



<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country-floating">Nombre</label>
                                    <input type="text" class="form-control" placeholder="" value="<?php echo $nombre ?>" name="txtNombre">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country-floating">Valor</label>
                                    <input type="number" class="form-control" placeholder="" value="<?php echo $valor ?>" name="txtValor">
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