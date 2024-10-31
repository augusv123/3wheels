<?php 
include('app/header.php');
$data=sp('VerTodosLosLugaresRetiro()');
?>
<section class="section">
    <div class="card">
    <div class="card-header">
            <div class="row">
              <div class="col-10"><h3> Lugar de retiro</h3> </div>
              <div class="col-2">
              
              <button type="button" class="btn btn-primary pull-right" style="color:white ;" onclick="window.location.href='lugar_de_retiro.php?t=0'">Nuevo</button>  </div>
            </div>
            
        </div>
        <div class="card-body">
            <div class="dataTable-container">
                <table class="table table-striped dataTable-table" id="table1">
                    <thead>
                        <tr>
                            <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">ID</a></th>
                            <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">Nombre</a></th>
                            <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">Costo</a></th>
          
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $fd){?>
                        <tr onclick="window.location.href='lugar_de_retiro.php?t=<?php echo $fd["ID"] ?>'">
                        <td><?php echo $fd["ID"] ?></td>
                        <td><?php echo $fd["NOMBRE_LUGAR"] ?></td>
                        <td><?php echo $fd["COSTO"] ?></td>
                        </tr>
                    <?php }; ?>
                    </tbody>
                </table>
            </div>
            <div class="dataTable-bottom"></div>
        </div>
    </div>
</section>
<?php include('app/footer.php');?>