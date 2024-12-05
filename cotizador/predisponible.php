<?php

session_start();
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('admin/app/database.php');

$estado = sp('COTIZADOR_ESTADO()');

$lugares_de_retiro = sp('VerTodosLosLugaresRetiro()');


if ($estado[0]["valor"] == "0") {
  header("Location: https://3wheels.com.ar/");
  die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  // sp_exec("COTIZACIONES_INICIO_REGISTAR('" . $_POST["txtCorreo"] . "','" . $_SERVER['HTTP_USER_AGENT'] . "')");

  $date1 = new DateTime($_POST["txtRetiro"]);
  $date2 = new DateTime($_POST["txtEntrega"]);
  $interval = $date1->diff($date2);

  $horaRetiro = $_POST["txtRetiroHora"];
  $horaEntrega = $_POST["txtEntregaHora"];

  $horasExcedentes = (strtotime($horaEntrega) - strtotime($horaRetiro)) / 3600;

  $cantidad = $interval->days;

  if ($horasExcedentes > 5) {
    $cantidad = $cantidad + 1;
  }

  $disponibles = sp("RESERVAS_DISPONIBILIDAD('" . $_POST["txtRetiro"] . "','" . $_POST["txtEntrega"] . "')");

  if (count($disponibles) == 0) {
    echo "No hay autos disponibles para las fechas seleccionadas";
  };

  $indice = 0;

  $lugar_nombre = null;
  $lugar_costo = null;

  // Loop through the result to find the location with ID 3
  if (isset($_POST["txtLugar"])) {
    foreach ($lugares_de_retiro as $lugar) {
      if ($lugar['ID'] == $_POST["txtLugar"]) {
        $lugar_nombre = $lugar['NOMBRE_LUGAR'];  // Store the name of the location
        $lugar_costo = $lugar['COSTO'];          // Store the cost of the location
        break;                                   // Exit the loop once the location is found
      }
    }
  }

  foreach ($disponibles as $auto) {
    $cotizacion = sp("RESERVAS_COTIZAR_V3(" . $cantidad . ",'" . $auto["MODELO"] . "','" . $_POST["txtRetiro"] . "')");

    $precioTotal = "0";
    $precioTotalPromo = "0";

    if (count($cotizacion) > 0) {
      $precioTotal = $cotizacion[0]["PRECIO"];
      $precioTotal += $lugar_costo;
      if($cotizacion[0]["PRECIO_PROMO"]){
 
        $precioTotalPromo = $cotizacion[0]["PRECIO_PROMO"];
        $precioTotalPromo += $lugar_costo;
      }
    };


    $disponibles[$indice]["PRECIO"] = $precioTotal;
    $disponibles[$indice]["PRECIO_PROMO"] = $precioTotalPromo;
    $indice = $indice + 1;
  }

  $_SESSION["disponibles"] = $disponibles;
  $_SESSION["fechaDesde"] = $_POST["txtRetiro"];
  $_SESSION["horaDesde"] = $_POST["txtRetiroHora"];

  $_SESSION["fechaHasta"] = $_POST["txtEntrega"];
  $_SESSION["horaHasta"] = $_POST["txtEntregaHora"];

  $_SESSION["cantidad"] = $cantidad;
  $_SESSION["lugarRetiro"] = $_POST["txtLugar"];

  // $_SESSION["correo"] = $_POST["txtCorreo"];

  //  $_SESSION["LD"]=$_POST["chkLD"];  

  header("Location: disponibles.php");

  die();
}

