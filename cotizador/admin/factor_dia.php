<?php 
include('app/header.php');

$mensaje="";
$dias="0";
$factor="";
$argumentos="";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $identificador=$_POST['txtId'];

    if($_POST['txtId']=="0"){



            $argumentos="'".$_POST['FACTOR']."',";
            $argumentos.="'".$_POST['DIAS']."',";
    
           
            sp("AgregarFactorDia(" . $_POST['FACTOR'] . "," . $_POST['DIAS'] . ")");
            header("Location: https://3wheels.com.ar/cotizador/admin/factor_dias");
            die();

    }else{

        $argumentos.="'".$_POST['DIAS']."',";
        $argumentos="'".$_POST['FACTOR']."',";
       
        sp("ActualizarFactorDia(" . $_POST['DIAS'] . "," . $_POST['FACTOR'] . ")");
        header("Location: https://3wheels.com.ar/cotizador/admin/factor_dias");

    }

    if($mensaje==""){
        if($_GET["t"]=="0"){
           header("Location: https://3wheels.com.ar/cotizador/admin/factor_dias");
           die();
        }
    }
}

if(!empty($_GET["t"])){
    
    if($_GET["t"]!="0"){
        $factordias=sp('ObtenerFactorPorDias("'.$_GET["t"].'")');
       
         $dias=$factordias[0]["DIAS"];
         $factor=$factordias[0]["FACTOR"];
       
         

    }
 
}

?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h3> Factor dia</h3>
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
                                        <td style="width:200px">FACTOR</td>
                                        <td><input required name="FACTOR" type="text" value="<?php echo $factor=="0"? "": $factor; ?>"  class="form-control ml-2" /> </td>
                                    </tr>
                                    <tr style="border: 0px solid transparent;">
                                        <td>DIAS</td>
                                        <td><input required name="DIAS" type="text" value="<?php echo $dias ?>" class="form-control ml-2" /> </td>
                                    </tr>
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end py-4">
                        <button type="submit" class="btn btn-primary me-1 mb-1"><?php echo $dias=="0"? "Guardar": "Actualizar"; ?></button>
                        <button type="button" class="btn btn-secondary me-1 mb-1" onclick="javascript:window.location.href='factor_dias.php';">Cerrar</button>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $_GET["t"] ?>" name="txtId">
            </form>
        </div>
    </div>
</section>

<?php include('app/footer.php');?>