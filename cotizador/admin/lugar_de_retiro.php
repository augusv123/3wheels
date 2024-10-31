<?php 
include('app/header.php');

$mensaje="";
$nombre_lugar="";

$argumentos="";
$pID = 0;
$ID = 0;
$costo = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $identificador=$_POST['ID'];

    if($_POST['ID']=="0"){

            sp("InsertarLugarRetiro('" . $_POST['NOMBRE_LUGAR'] . "'," . $_POST['COSTO'] . ")");
            header("Location: https://3wheels.com.ar/cotizador/admin/lugares_de_retiro");
            $mensaje="Lugar agregado con exito!.";

    }else{

       
        sp("ActualizarLugarRetiro(" . $_POST['ID'] . ", '" . $_POST['NOMBRE_LUGAR'] . "', " . $_POST['COSTO'] . ")");

        header("Location: https://3wheels.com.ar/cotizador/admin/lugares_de_retiro");
        $mensaje="Lugar actualizado con exito!.";
        // https://3wheels.com.ar/cotizador/admin/factor_dias

    }

    if($mensaje==""){
        if($_GET["t"]=="0"){
           header("Location: https://3wheels.com.ar/cotizador/admin/lugares_de_retiro");
           die();
        }
    }
}

if(!empty($_GET["t"])){
    
    if($_GET["t"]!="0"){
        $lugares=sp('ObtenerLugarRetiroPorID("'.$_GET["t"].'")');
       
         $nombre_lugar=$lugares[0]["NOMBRE_LUGAR"];
         $costo=$lugares[0]["COSTO"];
       
         

    }
 
}

?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h3> Lugar de retiro</h3>
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
                                        <td>Nombre del lugar</td>
                                        <td><input required name="NOMBRE_LUGAR" type="text" value="<?php echo $nombre_lugar ?>" class="form-control ml-2" /> </td>
                                    </tr>
                                    <tr style="border: 0px solid transparent;">
                                        <td>Costo</td>
                                        <td><input required name="COSTO" type="number" value="<?php echo $costo ?>" class="form-control ml-2" /> </td>
                                    </tr>
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end py-4">
                        <button type="submit" class="btn btn-primary me-1 mb-1"><?php echo $ID=="0"? "Guardar": "Actualizar"; ?></button>
                        <button type="button" class="btn btn-secondary me-1 mb-1" onclick="javascript:window.location.href='lugares_de_retiro.php';">Cerrar</button>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $_GET["t"] ?>" name="ID">
            </form>
        </div>
    </div>
</section>

<?php include('app/footer.php');?>