<?php 
include('app/header.php');
$data=sp('MIN_ALQUILER_OBTENER()');
?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
              <div class="col-10"><h3> Minimo de dias para reserva</h3> </div>
              <div class="col-2">
              
              <button type="button" class="btn btn-primary pull-right" style="color:white ;" onclick="window.location.href='mindia.php?t=0'">Nuevo</button>  </div>
            </div>
            
        </div>
        <div class="card-body">
            <div class="dataTable-container">
                <table class="table table-striped dataTable-table" id="table1">
                    <thead>
                        <tr>
                            <th data-sortable="" style="width: 50px;"><a href="#" class="dataTable-sorter">ID</a></th>
                            <th data-sortable="" ><a href="#" class="dataTable-sorter">Nombre</a></th>
                            <th data-sortable="" ><a href="#" class="dataTable-sorter">Valor</a></th>
                            <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">Desde</a></th>
                            <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">Hasta</a></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $regMinDias){ 
                        
                        $id= $regMinDias["id"];
                        ?>
                        <tr onclick="window.location.href='mindia.php?t=<?php echo $id ?>'">
                            <td><?php echo $regMinDias["id"] ?></td>
                            <td><?php echo $regMinDias["nombre"] ?></td>
                            <td><?php echo $regMinDias["valor"] ?></td>
                            <td><?php echo  date_format(date_create($regMinDias["desde"]), 'd-m-Y') ?></td>
                            <td><?php echo  date_format(date_create($regMinDias["hasta"]), 'd-m-Y') ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include('app/footer.php');?>