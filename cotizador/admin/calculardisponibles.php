<?php
session_start();
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('./app/database.php');

if(isset($_POST['txtRetiro']) && isset($_POST['txtEntrega'] )) {
$autos=sp("RESERVAS_DISPONIBILIDAD('".$_POST["txtRetiro"]."','".$_POST["txtEntrega"]."')");
$_SESSION['autos_disponibles'] = 'asdads';

$date1 = new DateTime($_POST["txtRetiro"]);
$date2 = new DateTime($_POST["txtEntrega"]);
$interval = $date1->diff($date2);

$horaRetiro=$_POST["txtHoraRetiro"];
$horaEntrega=$_POST["txtHoraEntrega"];

$horasExcedentes=(strtotime($horaEntrega)-strtotime($horaRetiro))/3600;

$cantidad=$interval->days;

if($horasExcedentes>5){
  $cantidad=$cantidad+1;
}
$indice=0;

foreach($autos as $auto)
{
    $cotizacion=sp("RESERVAS_COTIZAR_V3(".$cantidad.",'".$auto["MODELO"]."','".$_POST["txtRetiro"]."')");

    $precioTotal="0";


    if(count($cotizacion)>0){
        $precioTotal= $cotizacion[0]["PRECIO"];
    };                  

    $autos[$indice]["PRECIO"]=$precioTotal * $cantidad;
    $autos[$indice]["PRECIO_DIA"]=$precioTotal;
    $indice= $indice+1;
}

// var_dump($_SESSION['autos_disponibles']);
// die();
    echo json_encode($autos);
}
else {
    echo json_encode([]);
}

?>