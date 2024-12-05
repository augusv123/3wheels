<?php 
include('app/header.php');
$data=sp('ObtenerConfiguracion()');
function underscore($text){
    return  str_replace( ' ' ,'_',strval($text));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        // $argumentos.=$_POST['txtId'].",";
        // $argumentos.="'".$_POST['txtNombre']."',";
        // $argumentos.="'".$_POST['txtDesde']."',";
        // $argumentos.="'".$_POST['txtHasta']."'";
       
        // sp_exec('TARIFARIOS_ACTUALIZAR('.$argumentos.')');
   
        foreach ($_POST as $parametro => $valor) {
            $valor = trim($valor);
        
            sp_exec("ACTUALIZAR_CONFIGURACION('$parametro', '$valor')");
        }
        $data=sp('ObtenerConfiguracion()');
    

}
?>
<section class="section">
    <div class="card">
    <div class="card-header">
            <div class="row">
              <div class="col-10"><h3> Configuracion</h3> </div>
              <div class="col-2">
              
              <!-- <button type="button" class="btn btn-primary pull-right" style="color:white ;" onclick="window.location.href='factor_dia.php?t=0'">Nuevo</button>  </div> -->
            </div>
            
        </div>
        <div class="card-body">
            <div class="dataTable-container">
                <form class="form" method="POST">
                <table class="table  dataTable-table" id="table1">
                    <thead>
                        <tr>
                            <th data-sortable="" style="width: 200px;border-bottom:transparent !important;"><a href="#" class="dataTable-sorter">PARAMETRO</a></th>
                            <th data-sortable="" style="border-bottom:transparent !important;" ><a href="#" class="dataTable-sorter">VALOR</a></th>
                          
                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php 

                      foreach($data as $dc){
                        if($dc["PARAMETRO"] !="ACTIVO"){

                               ?>
                        <tr style="border: 0px solid transparent;">
                            <td><?php echo $dc["PARAMETRO"] ?></td>
                            <td><input name="<?php echo underscore($dc["PARAMETRO"]) ?>" type="text" value=" <?php echo $dc["VALOR"] ?>" class="form-control ml-2" /> </td>
                          
                    
                        </tr>
                    <?php } } ?>
                    </tbody>
                </table>
                <div class="col-12 d-flex justify-content-end py-4">

                    <button type="submit" class="btn btn-primary me-1 mb-1">Actualizar</button>
                </div>
            </div>

            <div class="dataTable-bottom"></div>
        </div>
    </div>
</section>
<?php include('app/footer.php');?>