<?php include('app/header.php');?>

<?php

$tipo=1;
$tipoTitulo="Reservas en trámite";
$valor="";
$pagina=0;

if(!empty($_GET["t"]))
{ $tipo=htmlspecialchars($_GET["t"]);}

switch ($tipo) {
    case 1:
        $data=sp('RESERVAS_CONSULTAR_TRAMITE()');
        break;
    case 2:
        $data=sp('RESERVAS_CONSULTAR_RETIRAR()');
        $tipoTitulo="Autos a retirar";
        break;
    case 3:
        $data=sp('RESERVAS_CONSULTAR_ENTREGAR()');
        $tipoTitulo="Autos a entregar";
        break;
    case 5:
        $data=sp('RESERVAS_CONSULTAR_ESTADO(5)');
        $tipoTitulo="Reservas canceladas";
        break;
    case 6:
        $data=sp('RESERVAS_CONSULTAR_ESTADO(6)');
        $tipoTitulo="Autos en taller";
        break;
    case 7:
        $data=sp('RESERVAS_CONSULTAR_ESTADO(4)');
        $tipoTitulo="Reservas finalizadas";
        break;
    case 8:

        if(isset($_GET["p"]))$pagina=$_GET["p"]-1;
        if(isset($_GET["b"]))$valor=$_GET["b"];

        $cantidadConsulta=sp('RESERVAS_FILTRAR_CANTIDAD("'.$valor.'")');
        $cantidad=($cantidadConsulta[0]["CANTIDAD"]/10);
        if(fmod($cantidadConsulta[0]["CANTIDAD"],10)>0)$cantidad++;
        
        $data=sp('RESERVAS_FILTRAR_V2("'.$valor.'",'.($pagina*10).')');
        
        $tipoTitulo="Reservas";
        break;

}

?>
          <section class="section">
        <div class="card">
            <div class="card-header">
               

               <div class="row">
            <div class="col-md-9 ">
               <h3> <?php echo $tipoTitulo ?>    </h3>
               </div>

               <div class="col-md-3 ">
                                    <div class="input-group input-group-sm mb-3">
                                        
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control shadow-none" placeholder="" id="txtBuscar" value="<?php echo $valor ?>" >
                                        

  
                                        <button class="btn btn-outline-secondary " style="z-index: 5000;" type="button"  onclick="javascript:call(1);" id="button-addon2">Buscar</button>
                                       
                                    </div>
                                </div>
            

                                </div>
            </div>
            <div class="card-body">
                
                
                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="table1">
                    <thead>
                        <tr>
                        <th data-sortable="" style="width: 100px;"><a href="#" class="dataTable-sorter">ID</a></th>
                        <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">Modelo</a></th>
                            <th data-sortable="" style="width: 100px;"><a href="#" class="dataTable-sorter">Patente</a></th>
                            <th data-sortable="" style="width: 150px;"><a href="#" class="dataTable-sorter">Retiro</a></th>
                            <th data-sortable="" style="width: 150px;"><a href="#" class="dataTable-sorter">Entrega</a></th>
                            <th data-sortable="" ><a href="#" class="dataTable-sorter">Lugar</a></th>
                            <th data-sortable="" ><a href="#" class="dataTable-sorter">Precio</a></th>
                            <th data-sortable="" style="width: 150px;"><a href="#" class="dataTable-sorter">Cliente</a></th>
                            <th data-sortable="" style="width: 150px;"><a href="#" class="dataTable-sorter">Teléfono</a></th>
                            <th data-sortable="" style="width: 150px;"><a href="#" class="dataTable-sorter">CORREO</a></th>

                            <?php if($tipo==8){?>  <th data-sortable="" style="width: 100px;"><a href="#" class="dataTable-sorter">Estado</a></th>  <?php } ?>
                            <th data-sortable="" style="width: 150px;"><a href="#" class="dataTable-sorter">Eliminar</a></th>

    
                    </thead>
                    <tbody>
                        
                        <?php

                         foreach($data as $reserva)
                         {
                        

                          $retiro= date_create($reserva["FECHA_RETIRO"]);
                          $entrega= date_create($reserva["FECHA_ENTREGA"]);
                         

                         ?>
                          <tr class="filaReserva" onclick="javascript:window.location.href='nueva-reserva.php?r=<?php echo $reserva['ID'] ?>'">
                          <td><?php echo $reserva["ID"] ?></td>
                          <td><?php echo $reserva["MODELO"] ?></td>
                            <td><?php echo $reserva["PATENTE"] ?></td>
                            <td><?php echo date_format($retiro, 'd-m-Y') ?></td>
                            <td><?php echo date_format($entrega, 'd-m-Y') ?></td>
                            <td><?php echo $lugar[$reserva["LUGAR"]] ?></td>
                            <td><?php echo "$ ".number_format($reserva['PRECIO'], 0, ',', '.') ?></td>
                            <td><?php echo isset($reserva["NOMBRE"]) ? $reserva["NOMBRE"] : '' ?></td>
                            <td><?php echo isset($reserva["TELEFONO"]) ? $reserva["TELEFONO"] : '' ?></td>
                            <td><?php echo isset($reserva["CORREO"]) ? $reserva["CORREO"] : '' ?></td>
                            <!-- <td style="text-align: right;"><?php echo "$ ".number_format(sp("RESERVAS_OBTENER_PRECIO(".$reserva["ID"].")")[0]["PRECIO"], 0, ',', '.') ?></td> -->
                            <?php if($tipo==8){ echo "<td>".$estados[$reserva["ESTADO"]]."</td>";} ?>
                            <td style="text-align: center;">
                            <a style="padding: 20px;" href="javascript:void(0);" onclick="event.stopPropagation(); eliminarReserva(<?php echo $reserva['ID']; ?>)"><i class="bi bi-x-circle"></i></a>
                            </td>
                        </tr>

                         <?php
                         }

                        ?>
                        
                       
                              
                     
                            
                       </tbody>
                </table>

</div>


<?php if($tipo==8){ ?>
<div class="dataTable-bottom"><ul class="pagination pagination-primary float-end dataTable-pagination">
                    <li class="page-item pager"><a href="#" class="page-link" data-page="1">‹</a></li>
                    
                    <?php for($i=1;$i<=$cantidad;$i++){  ?> 

                    <li class="page-item <?php if($i==($pagina+1)){echo 'active';} ?>"><a href="javascript:call(<?php echo $i; ?>)" class="page-link" data-page="1"><?php echo $i; ?></a></li>
                    

                    <?php } ?> 


                    <li class="page-item pager"><a href="#" class="page-link" data-page="2">›</a></li></ul></div>

                    <?php } ?>


</div>
            </div>
        </div>

    </section>

<SCRIPT>
    function call(pagina)
{
    url='reservas?t=8&p='+pagina;
    valor=document.getElementById("txtBuscar").value;
    if(valor.trim()!='')url+='&b='+valor;
    window.location.href=url;
}

function clear()
{
    $("#txtBuscar").text("");
    $("#txtBuscar").focus();    
}

$("#txtBuscar").focus();

$(document).keyup(function (e) {

    if ($("#txtBuscar").is(":focus") && (e.keyCode == 13)) {
        call(1);    }
});

function eliminarReserva(id) {
    if (confirm("¿Está seguro que desea eliminar la reserva?")) {
        $.ajax({
            url: 'reservas-eliminar.php',
            type: 'POST',
            data: { id: id },
            success: function (data) {
                if (data.trim() == '1') {
                    
                    alert('Reserva eliminada correctamente');
                    location.reload();
                } else {
                    alert('Error al eliminar la reserva');
                }
            }
        });
    }
}

</script>
<?php include('app/footer.php');?>