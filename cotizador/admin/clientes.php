<?php include('app/header.php');

$pagina=0;
$valor="";

if(isset($_GET["p"])){$pagina=$_GET["p"]-1;}

if(isset($_GET["b"])){$valor=$_GET["b"];}

$cantidadConsulta=sp('CLIENTES_FILTRAR_CANTIDAD("'.$valor.'")');
$cantidad=($cantidadConsulta[0]["CANTIDAD"]/50);
$cantidadPaginas=fmod($cantidad,50);
if($cantidadPaginas>0){$cantidad++;}

$data=sp('CLIENTES_FILTRAR("'.$valor.'",'.($pagina*50).')');

?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9 ">
                    <h3> Clientes (<?php echo $cantidadConsulta[0]["CANTIDAD"]; ?>)</h3>
                </div>
                <div class="col-md-3 ">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control shadow-none" placeholder="" id="txtBuscar" value="<?php echo $valor ?>">
                        <button class="btn btn-outline-secondary " type="button"  onclick="javascript:call(1);" id="button-addon2">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="dataTable-container">
                <table class="table table-striped dataTable-table" id="table1">
                    <thead>
                        <tr> 
                            <td style="border: solid 0px ;color:#435ebe; font-weight:700">
                                <div class="container-fluid">
                                    <div class="row" id="cabeceraClientes">
                                        <div class="col-lg-4 col-md-12" >Nombre</div>
                                        <div class="col-lg-4 col-md-12" >Correo</div>
                                        <div class="col-lg-2 col-md-12" >Teléfono</div>
                                        <div class="col-lg-2 col-md-12 ">DNI</td></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </thead>             
                    <tbody>
                        <?php foreach( $data as $cliente){ ?>
                        <tr class="filaReserva" onclick="javascript:window.location.href='cliente.php?c=<?php echo $cliente['ID'] ?>'" >
                            <td>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12" style="text-overflow:ellipsis;white-space: nowrap;"><?php echo $cliente["NOMBRE"] ?></div>
                                        <div class="col-lg-4 col-md-12" style="text-overflow:ellipsis;white-space: nowrap;"><?php echo $cliente["CORREO"] ?></div>
                                        <div class="col-lg-2 col-md-12"style="text-overflow:ellipsis;white-space: nowrap;">   <?php echo $cliente["TELEFONO"] ?></div>
                                        <div class="col-lg-2 col-md-12 " style="text-overflow:ellipsis;white-space: nowrap;"><?php echo $cliente["DNI"] ?></td></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="dataTable-bottom"><ul class="pagination pagination-primary float-end dataTable-pagination">
                <li class="page-item pager"><a href="javascript:call(1)" class="page-link" data-page="1" >‹</a></li>
                    <select  class="form-select" id="selPagina"  >
                        <?php for($i=1;$i<=$cantidadPaginas;$i++){  ?> 
                        <option value="0" <?php if(($pagina+1)==$i)echo "selected"; ?> ><?php echo $i; ?></option>
                        <?php } ?> 
                    </select>   
                <li class="page-item pager"><a href="javascript:call(<?php echo $cantidad; ?>)" class="page-link" data-page="2">›</a></li></ul>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
                                    $('#selPagina').on('change', function () {                
                                                            var s = $("#selPagina option:selected").text();                             
                                                            call(s);                                   
                                                        });           
                                })

    function call(pagina){
        url='clientes?p='+pagina;
        valor=document.getElementById("txtBuscar").value;
        if(valor.trim()!='')url+='&b='+valor;
        window.location.href=url;
    }

    $("#txtBuscar").focus();

    $(document).keyup(function (e) {
        if ($("#txtBuscar").is(":focus") && (e.keyCode == 13)) {
            call(1);    }
    });
</script>
<?php include('app/footer.php');?>