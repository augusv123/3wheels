<?php 
include('app/header.php');
$data=sp('AUTOS_CONSULTAR()');
?>
<section class="section">
    <div class="card">
    <div class="card-header">
            <div class="row">
              <div class="col-10"><h3> Autos</h3> </div>
              <div class="col-2">
              
              <button type="button" class="btn btn-primary pull-right" style="color:white ;" onclick="window.location.href='auto.php?t=0'">Nuevo</button>  </div>
            </div>
            
        </div>
        <div class="card-body">
            <div class="dataTable-container">
                <table class="table table-striped dataTable-table" id="table1">
                    <thead>
                        <tr>
                            <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">Marca</a></th>
                            <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">Modelo</a></th>
                            <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">Patente</a></th>
                            <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">Categoria</a></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $auto){?>
                        <tr onclick="window.location.href='auto.php?t=<?php echo $auto["PATENTE"] ?>'">
                        <td><?php echo $auto["MARCA"] ?></td>
                        <td><?php echo $auto["MODELO"] ?></td>
                        <td><?php echo $auto["PATENTE"] ?></td>
                        <td><?php echo $auto["CATEGORIA"] ?></td>
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