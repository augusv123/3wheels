<?php 
include('app/header.php');


$argumentos='';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $argumentos.=$_POST['txtId'].",";
    $argumentos.="'".$_POST['txtNombre']."',";
    $argumentos.=$_POST['txtDesde'].",";
    $argumentos.="'".$_POST['txtHasta']."',";
   
    sp_exec('TARIFARIOS_ACTUALIZAR('.$argumentos.')');
}

if(!empty($_GET["t"])){
    $tarifarios=sp('TARIFARIOS_OBTENER('.$_GET["t"].')');

    var_dump($tarifarios);

    $data=sp('PRECIOS_CONSULTAR('.$_GET["t"].')');

 
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
        </div>
        <div class="card-body">
<div class="row">


<div class="col-lg-6">


<form class="form" method="POST">
<div class="row">
<div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Nombre</label>
                                    <input type="text" class="form-control" placeholder="" value="<?php echo $tarifarios[0]["NOMBRE"] ?>" name="txtNombre">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="country-floating">Desde</label>
                                    <input type="date" class="form-control" placeholder="" name="txtNombre">
                                </div>
                            </div>
                            <div class=" col-6">
                                <div class="form-group">
                                    <label for="country-floating">Hasta</label>
                                    <input type="date" class="form-control" placeholder=""  name="txtNombre">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Actualizar</button>
                                <button type="button" class="btn btn-secondary me-1 mb-1" onclick="javascript:window.location.href='<?php if(isset($_SERVER['HTTP_REFERER'])){echo $_SERVER['HTTP_REFERER'];}else{echo 'clientes.php';} ?>';">Cerrar</button>
                            </div>





</div>




</form>



</div>

<div class="col-lg-6">




<div class="dataTable-container">
                <table class="table table-striped dataTable-table" id="table1">
                    <thead>
                        <tr>
                            <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">MODELO</a></th>
                            <th data-sortable="" ><a href="#" class="dataTable-sorter">PRECIO BASE</a></th>
                          
                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $tarifa){ ?>
                        <tr>
                            <td><?php echo $tarifa["MODELO"] ?></td>
                            <td>$ <?php echo $tarifa["PRECIO"] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>



</div>


</div>






        </div>
    </div>
</section>
<?php include('app/footer.php');?>