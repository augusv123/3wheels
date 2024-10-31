<?php include('app/header.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
   if($_POST['txtEstado']=="0"){

      sp_exec('COTIZADOR_ACTIVAR()');


   }else{

    sp_exec('COTIZADOR_DESACTIVAR()');
   }
}


    $estado=sp('COTIZADOR_ESTADO()');

 


?>

<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" method="POST" name="frmReserva">
                        <div class="row">
                          
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1" >
                               <?php 
                                
                                if($estado[0]["valor"]=="0"){

                                    echo "Activar";
                                }else{

                                    echo "Desactivar";
                                 
                               }
                                ?>
                            
                               </button>
                                <button type="button" class="btn btn-secondary me-1 mb-1" onclick="javascript:window.location.href='reservas.php';">Cerrar</button>
                            </div>
                        </div>
                        <input type="hidden" name="txtEstado" value="<?php echo $estado[0]["valor"]?>" />
                     
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>






<?php include('app/footer.php'); ?>