<?php 
include('app/header.php');
$data=sp('VerTodosFactoresDias()');
?>
<section class="section">
    <div class="card">
    <div class="card-header">
            <div class="row">
              <div class="col-10"><h3> Factor dias</h3> </div>
              <div class="col-2">
              
              <button type="button" class="btn btn-primary pull-right" style="color:white ;" onclick="window.location.href='factor_dia.php?t=0'">Nuevo</button>  </div>
            </div>
            
        </div>
        <div class="card-body">
            <div class="dataTable-container">
                <table class="table table-striped dataTable-table" id="table1">
                    <thead>
                        <tr>
                            <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">Factor</a></th>
                            <th data-sortable="" style="width: 200px;"><a href="#" class="dataTable-sorter">Dia</a></th>
          
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $fd){?>
                        <tr onclick="window.location.href='factor_dia.php?t=<?php echo $fd["DIAS"] ?>'">
                        <td><?php echo $fd["FACTOR"] ?></td>
                        <td><?php echo $fd["DIAS"] ?></td>
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