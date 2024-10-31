<?php 
include('app/header.php');

$mensaje="";
$patente="0";
$marca="";
$modelo="";
$imagen="";
$min1="";
$min2="";
$min3="";
$argumentos="";

function underscore($text){
     return  str_replace( ' ' ,'_',strval($text));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $identificador=$_POST['txtId'];

    if($_POST['txtId']=="0"){

        $esValido=sp("AUTOS_VALIDAR_PATENTE('".$_POST['txtId']."')");

        echo $esValido;

        if($esValido[0]["cantidad"]!="0"){
           $mensaje="Patente registrada.";
        }else{

            $argumentos="'".$_POST['txtPatente']."',";
            $argumentos.="'".$_POST['txtMarca']."',";
            $argumentos.="'".$_POST['txtModelo']."',";
            $argumentos.="'".$_POST['txtImagen']."',";
            $argumentos.="'".$_POST['txtMin1']."',";
            $argumentos.="'".$_POST['txtMin2']."',";
            $argumentos.="'".$_POST['txtMin3']."'";
           
            $valorDevuelto= sp('AUTOS_INSERTAR('.$argumentos.')');
            $identificador= $valorDevuelto[0][0];
        }

    }else{

        $argumentos="'".$_POST['txtPatente']."',";
        $argumentos.="'".$_POST['txtMarca']."',";
        $argumentos.="'".$_POST['txtModelo']."',";
        $argumentos.="'".$_POST['txtImagen']."',";
        $argumentos.="'".$_POST['txtMin1']."',";
        $argumentos.="'".$_POST['txtMin2']."',";
        $argumentos.="'".$_POST['txtMin3']."'";
       
        sp_exec('AUTOS_ACTUALIZAR('.$argumentos.')');

    }

    if($mensaje==""){
        if($_GET["t"]=="0"){
           header("Location: https://3wheels.com.ar/cotizador/admin/autos");
           die();
        }
    }
}

if(!empty($_GET["t"])){
    
    if($_GET["t"]!="0"){
        $autos=sp('AUTOS_OBTENER("'.$_GET["t"].'")');
       
         $patente=$autos[0]["PATENTE"];
         $marca=$autos[0]["MARCA"];
         $modelo=$autos[0]["MODELO"];
         $imagen=$autos[0]["IMAGEN"];
         $min1=$autos[0]["MINIATURA_1"];
         $min2=$autos[0]["MINIATURA_2"];
         $min3=$autos[0]["MINIATURA_3"];
         

    }
 
}

?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h3> Auto</h3>
            <?php if($mensaje!=""){ ?>
                <span style="color:red ;"> <?php echo $mensaje ?>  </span>            
            <?php } ?>
        </div>
        <div class="card-body">
            <form class="form" method="POST">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dataTable-container">
                            <table class="table  dataTable-table" id="table1">
                                <tbody>
                                    <tr style="border: 0px solid transparent;">
                                        <td style="width:200px">Patente</td>
                                        <td><input required name="txtPatente" type="text" value="<?php echo $patente=="0"? "": $patente; ?>"  class="form-control ml-2" /> </td>
                                    </tr>
                                    <tr style="border: 0px solid transparent;">
                                        <td>Marca</td>
                                        <td><input required name="txtMarca" type="text" value="<?php echo $marca ?>" class="form-control ml-2" /> </td>
                                    </tr>
                                    <tr style="border: 0px solid transparent;">
                                        <td>Modelo</td>
                                        <td><input required name="txtModelo" type="text"  value="<?php echo $modelo ?>" class="form-control ml-2" /> </td>
                                    </tr>
                                    <tr style="border: 0px solid transparent;">
                                        <td>Foto principal</td>
                                        <td><input required name="txtImagen" type="text" value="<?php echo $imagen ?>" class="form-control ml-2" /> </td>
                                    </tr>
                                    <tr style="border: 0px solid transparent;">
                                        <td>Miniatura 1</td>
                                        <td><input required name="txtMin1" type="text" value="<?php echo $min1 ?>" class="form-control ml-2" /> </td>
                                    </tr>
                                    <tr style="border: 0px solid transparent;">
                                        <td>Miniatura 2</td>
                                        <td><input required name="txtMin2" type="text" value="<?php echo $min2 ?>" class="form-control ml-2" /> </td>
                                    </tr>
                                    <tr style="border: 0px solid transparent;">
                                        <td>Miniatura 3</td>
                                        <td><input required name="txtMin3" type="text" value="<?php echo $min3 ?>" class="form-control ml-2" /> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end py-4">
                        <button type="submit" class="btn btn-primary me-1 mb-1"><?php echo $patente=="0"? "Guardar": "Actualizar"; ?></button>
                        <button type="button" class="btn btn-secondary me-1 mb-1" onclick="javascript:window.location.href='autos.php';">Cerrar</button>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $_GET["t"] ?>" name="txtId">
            </form>
        </div>
    </div>
</section>

<?php include('app/footer.php');?>