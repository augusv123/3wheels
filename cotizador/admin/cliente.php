<?php include('app/header.php');

$argumentos='';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $argumentos.=$_POST['txtId'].",";
    $argumentos.="'".$_POST['txtNombre']."',";
    $argumentos.=$_POST['txtDni'].",";
    $argumentos.="'".$_POST['txtLocalidad']."',";
    $argumentos.="'".$_POST['txtCorreo']."',";
    $argumentos.="'".$_POST['txtTelefono']."',";
    $argumentos.="'".$_POST['txtEdad']."'";
    sp_exec('CLIENTES_ACTUALIZAR('.$argumentos.')');
}

if(!empty($_GET["c"])){
    $data=sp('CLIENTES_OBTENER('.$_GET["c"].')');
    $cliente=$data[0];
}
else{
    header("Location: http://c1920289.ferozo.com/chikung/clientes.php");
    die();
}
?>
<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" method="POST">
                        <div class="row">
                            <div class=" col-12"><h3 style="margin-bottom: 1rem; ">Cliente</h3> </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Nombre</label>
                                    <input type="text" class="form-control" placeholder="" value="<?php echo $cliente["NOMBRE"] ?>" name="txtNombre">
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Localidad</label>
                                    <input type="text" class="form-control" placeholder="" value="<?php echo $cliente["LOCALIDAD"] ?>" name="txtLocalidad">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Teléfono</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="" value="<?php echo $cliente["TELEFONO"] ?>" name="txtTelefono">
                                        <button class="btn btn-secondary" type="button" id="button-addon1">
                                            <svg class="svg-inline--fa fa-phone fa-w-16 fa-fw select-all" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Correo</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="" value="<?php echo $cliente["CORREO"] ?>" name="txtCorreo">
                                        <button class="btn btn-secondary" type="button" id="button-addon1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
                                            <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">DNI</label>
                                    <input type="text" class="form-control" placeholder="" value="<?php echo $cliente["DNI"] ?>" name="txtDni">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Edad</label>
                                    <select  class="form-select" name="txtEdad" >
                                    <option value="0" <?php if($cliente["EDAD"]=="0")echo "selected"; ?> >Menor de 25 años</option>
                                    <option value="1" <?php if($cliente["EDAD"]=="1")echo "selected"; ?> >Mayor de 25 años</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Actualizar</button>
                                <button type="button" class="btn btn-secondary me-1 mb-1" onclick="javascript:window.location.href='<?php if(isset($_SERVER['HTTP_REFERER'])){echo $_SERVER['HTTP_REFERER'];}else{echo 'clientes.php';} ?>';">Cerrar</button>
                            </div>
                        </div>
                       <input type="hidden" value="<?php echo $cliente["ID"] ?>" name="txtId">
                     </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('app/footer.php');?>