<?php 

session_start();
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('admin/app/database.php');
require '../vendor/autoload.php'; // Asegúrate de tener el autoload de Composer
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if($_SERVER['REQUEST_METHOD'] === 'GET') {

}

$edades = array("MENOR DE 25 AÑOS","MENOR DE 25 AÑOS");
// $lugar=array("Obelisco (Av. 9 de Julio y Av. Corrientes)","Aeroparque (Aeropuerto Jorge Newbery)","Buquebus","Dot Baires Shopping","Unicenter Shopping","Tortugas Open Mall","Shopping Palmas del Pilar","Shopping Paseo Champagnat","R. Caamaño 1103, Villa Rosa, Buenos Aires");

// $lugar=array("Obelisco (Av. 9 de Julio y Av. Corrientes)","Aeroparque (Aeropuerto Jorge Newbery)","Buquebus","Dot Baires Shopping","Unicenter Shopping","Tortugas Open Mall","Shopping Palmas del Pilar","Shopping Paseo Champagnat","R. Caamaño 1103, Villa Rosa, Buenos Aires");
$lugares_de_retiro = sp('VerTodosLosLugaresRetiro()');
// Initialize variables for the desired location
$lugar_nombre = null;
$lugar_costo = null;

// Loop through the result to find the location with ID 3
foreach ($lugares_de_retiro as $lugar) {
    if ($lugar['ID'] == $_SESSION["lugarRetiro"]) {
        $lugar_nombre = $lugar['NOMBRE_LUGAR'];  // Store the name of the location
        $lugar_costo = $lugar['COSTO'];          // Store the cost of the location
        break;                                   // Exit the loop once the location is found
    }
}


$medioDePago=array("","Efectivo","Efectivo y tarjeta","Tarjeta de débito","Depósito bancario","Mercadopago","Transferencia");



function cleanText($texto){
    return preg_replace('([^A-Za-z0-9@áéíóúÁÉÍÓÚ. ])', '', $texto);
}

$error="";

function obtenerValor($nombre){
  global $error;
  if(isset($_POST[$nombre])){
    if(trim($_POST[$nombre]=='')){
      $error.="Falta valor ".$nombre." <br>";
    }
    return cleanText($_POST[$nombre]);
  }else{
    $error.="Variable ".$nombre." no seteada<br>";
    return '';
  }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION["reserva"])) {


  $minutes = (time() - $_SESSION['tiempo']) / 60;

  // echo "minutos : ".$minutes."  - ".$_SESSION['tiempo'];

  
  if($minutes > 5){

    header("Location: formulario.php");
   
    die();

  }

  
  $descuentoSP=  sp("CONFIGURACION_OBTENER_DESCUENTO_EFECTIVO()")[0]["VALOR"];
  $valorSillaBebe = SP('OBTENER_CONFIGURACION_POR_NOMBRE("VALOR_SILLA_BEBE")');
  $coberturaPremium = SP('OBTENER_CONFIGURACION_POR_NOMBRE("COBERTURA_PREMIUM")');
  $valorSillaBebe = isset($valorSillaBebe[0]['VALOR']) ? $valorSillaBebe[0]['VALOR'] : 0;
  $coberturaPremium = isset($coberturaPremium[0]['VALOR']) ? $coberturaPremium[0]['VALOR'] : 0;
  $reserva=$_SESSION["reserva"];
  
  $reserva["PRECIO"] +=  $lugar_costo;

  $argumentos="";
  $argumentos.="'".obtenerValor("txtNombre")."',";
  $argumentos.=obtenerValor("txtDni").",";
  $argumentos.="'".obtenerValor("txtCorreo")."',";
  $argumentos.="'".obtenerValor("txtTelefono")."',";
  $argumentos.="'".obtenerValor("txtLocalidad")."',";
  $argumentos.=obtenerValor("txtEdad").",";
  $argumentos.="'".$_SESSION["fechaDesde"]."',";
  $argumentos.="'".$_SESSION["fechaHasta"]."',";
  $argumentos.="'".$_SESSION["horaDesde"]."',";
  $argumentos.="'".$_SESSION["horaHasta"]."',";
  $argumentos.=$_SESSION["lugarRetiro"].",";
  $argumentos.=obtenerValor("hddMedioPago").",";
  $argumentos.="'".$reserva["PRECIO"]."',";
  $argumentos.="'".$reserva["MODELO"]."',";
  $argumentos.=$_SESSION["lugarRetiro"];
  
//   $medioDePago =obtenerValor("hddMedioPago");
//   $medioDePagoElegido = 'Efectivo';
 
//   switch ($medioDePago) {
//     case '0':
//         $medioDePagoElegido = "No se selecciono medio de pago.";
//         break;
//   case '1':
//     $medioDePagoElegido = "Efectivo.";
//     break;
//     case '2':
//         $medioDePagoElegido = "Efectivo y tarjeta";
//         break;
//     case '3':
//         $medioDePagoElegido = "Tarjeta de débito";
//         break;
//     case '4':
//         $medioDePagoElegido = "Depósito bancario";
//         break;
//     case '5':
//         $medioDePagoElegido = "Mercadopago";
//         break;
//     case '6':
//         $medioDePagoElegido = "Transferencia";
//         break;
//     default:
//         $medioDePagoElegido = "Efectivo.";
//         break;
// }
  $Nombre ="'".obtenerValor("txtNombre")."',";
  $Email ="'".obtenerValor("txtCorreo")."',";
  $Telefono ="'".obtenerValor("txtTelefono")."',";
  $Localidad ="'".obtenerValor("txtLocalidad")."',";
  $PuntoRetiro =$_SESSION["lugarRetiro"].",";

  $Cobertura = obtenerValor("txtCobertura");
  $Sillabebe = obtenerValor("txtSilla");


  

  if($Sillabebe == 1){
    $Sillabebe = "Incluida";
  }
  else {
    $Sillabebe = "No incluida";
  }
  if($Cobertura == "1"){
    $Cobertura = "Incluida";
  }
  else{ 
    $Cobertura = "No incluida";
  }

 

  $Totaldopcionales = obtenerValor("totaldopcionales");

  
//   try{

//     $archivo=fopen('DatosPersonalesCotizador.vcf', 'a') or die("can't open file");

//     $vcard="BEGIN:VCARD\n";
//     $vcard.="VERSION:3.0\n";
//     $vcard.="N:".$Nombre."\n";
//     $vcard.="EMAIL;TYPE=INTERNET;TYPE=HOME:".$Email."\n";
//     $vcard.="TEL;TYPE=home:".$Telefono."\n";
//     $vcard.="ADR;TYPE=home:;;".$Localidad.";;;;\n";
//     $vcard.="ADR;TYPE=work:;;".$PuntoRetiro.";;;;\n";
//     $vcard.="CATEGORIES:A Revisar\n";
//     $vcard.="BDAY:".date("Y/m/d")."\n";
//     fwrite($archivo,$vcard);
//     fclose($archivo);

//  } catch (Exception $e) {
 
//      echo 'Caught exception: ',  $e->getMessage(), "\n";
//      exit;
 
//  }

 try {
  // Ruta al archivo Excel existente
  $fileName = 'DatosPersonalesCotizador.xlsx';

  // Comprobar si el archivo ya existe
  if (file_exists($fileName)) {
    // Cargar el archivo Excel existente
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileName);
    $sheet = $spreadsheet->getActiveSheet();
  } else {
    // Si el archivo no existe, crear uno nuevo
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Definir los encabezados de las columnas solo si el archivo es nuevo
    $sheet->setCellValue('A1', 'Nombre');
    $sheet->setCellValue('B1', 'Email');
    $sheet->setCellValue('C1', 'Teléfono');
    $sheet->setCellValue('D1', 'Localidad');
    $sheet->setCellValue('E1', 'Punto de Retiro');
    $sheet->setCellValue('F1', 'Auto');
    $sheet->setCellValue('G1', 'Fecha de Creación');
  }

  // Obtener la siguiente fila vacía
  $lastRow = $sheet->getHighestRow() + 1; // Conseguir la siguiente fila vacía

  // Datos del contacto
  $nombre = $Nombre; // Reemplaza con el valor real
  $email = $Email; // Reemplaza con el valor real
  $telefono = $Telefono; // Reemplaza con el valor real
  $localidad = $Localidad; // Reemplaza con el valor real
  $puntoRetiro = $PuntoRetiro; // Reemplaza con el valor real

  // Insertar datos en la nueva fila
  $sheet->setCellValue('A' . $lastRow, obtenerValor("txtNombre"));
  $sheet->setCellValue('B' . $lastRow, obtenerValor("txtCorreo"));
  $sheet->setCellValue('C' . $lastRow, obtenerValor("txtTelefono"));
  $sheet->setCellValue('D' . $lastRow, obtenerValor("txtLocalidad"));
  $sheet->setCellValue('E' . $lastRow, $lugar_nombre);
  $sheet->setCellValue('F' . $lastRow, $reserva["MODELO"]);
  $sheet->setCellValue('G' . $lastRow, date("Y-m-d"));

  // Guardar el archivo Excel con los nuevos datos
  $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
  $writer->save($fileName);

  echo "Archivo Excel actualizado exitosamente: $fileName";

} catch (Exception $e) {
  echo 'Se produjo una excepción: ', $e->getMessage();
  exit;
}


  if($error==""){

    try {
        $logReserva='';
        $hayExcendente=false;
        $cantidad=$_SESSION["cantidad"];

        $horaRetiro=htmlspecialchars($_SESSION["horaDesde"]);
        $horaEntrega=htmlspecialchars($_SESSION["horaHasta"]);
    
        $horasExcedentes=(strtotime($horaEntrega)-strtotime($horaRetiro))/3600;
      

        $resultado=sp('RESERVAS_INSERTAR('.$argumentos.')');
  
        $cotizacion=sp("RESERVAS_COTIZAR_V3(".$_SESSION["cantidad"].",'".$reserva["MODELO"]."','".$_SESSION["fechaDesde"]."')");
        $cotizacion[0]["PRECIO"] += $lugar_costo;
        $precioCotizacion = $cotizacion[0]["PRECIO"] + $lugar_costo;
        $precioCotizacionPromo = $cotizacion[0]["PRECIO_PROMO"] + $lugar_costo;
        $precioCotizacionAAbonar = ($precioCotizacionPromo < $precioCotizacion) ? $precioCotizacionPromo : $precioCotizacion;
        $totalOpcionales = 0;
        if ($Sillabebe == "Incluida") {
            $totalOpcionales += $cantidad * $valorSillaBebe;
        }
        if ($Cobertura == "Incluida") {
            $totalOpcionales +=  $coberturaPremium * $precioCotizacionAAbonar ;

        }
        $precioCotizacionAAbonar += $totalOpcionales;
        $decuentoEFT = 0;
        if (obtenerValor("hddMedioPago") == 1) {
            $descuentoEfectivo = $precioCotizacionAAbonar * $descuentoSP / 100;
        } else {
            $descuentoEfectivo = 0;
        }

        $precioCotizacionAAbonar = $precioCotizacionAAbonar - $descuentoEfectivo;


        // if($horasExcedentes>5){
        //   $cantidad=$cantidad-1;
        //   $hayExcendente=true;
     
        //   $valorUnitario=$cotizacion[0]["PRECIO"]/$_SESSION["cantidad"];

        // }

        $consultar=true;

        if(floatval($reserva["PRECIO"])>0)$consultar=false;

        if(!$consultar){   


            $cantidadCotizacion=$_SESSION["cantidad"];
            $precioCotizacion=$cotizacion[0]["PRECIO"];
        //   if($hayExcendente){
        //     $precioCotizacion=$cotizacion[0]["PRECIO"]-$valorUnitario;
        //     $cantidadCotizacion=$cantidad-1; 
        //   }


          sp_exec('COTIZACIONES_REGISTRAR('.$resultado[0][0].',"RESERVA",'.$precioCotizacion.','. $cantidadCotizacion.')');
          $logReserva.="COTIZACION REGISTRADA|";

          if($hayExcendente){
            sp_exec('COTIZACIONES_REGISTRAR('.$resultado[0][0].',"EXCEDENTE",'.$valorUnitario.',1)');
            $logReserva.="EXCEDENTE REGISTRADA|";
          }
        
          if(obtenerValor("hddMedioPago")==1){
            $descuento=sp('COTIZACIONES_OBTENER_DESCUENTO('.$reserva["PRECIO"].')');
            sp_exec('COTIZACIONES_REGISTRAR('.$resultado[0][0].',"DESCUENTO",'.$descuento[0][0].',1)');
            $logReserva.="DESCUENTO REGISTRADO|";
          }
        
          if(isset($_POST["chkED"])){
            sp_exec('COTIZACIONES_REGISTRAR('.$resultado[0][0].',"ENTREGA DOMICILIO",0,'.$cantidad.')');
            $logReserva.="ED REGISTRADA|";
          }
          
          if(isset($_POST["chkCobertura"])){
            sp_exec('COTIZACIONES_REGISTRAR('.$resultado[0][0].',"COBERTURA",'.$_POST["chkCobertura"].','.$cantidad.')');
            $logReserva.="COBERTURA REGISTRADA|";
          }
          
          if(isset($_POST["chkSillaBebe"])){
            sp_exec('COTIZACIONES_REGISTRAR('.$resultado[0][0].',"SILLA BEBE",'.$_POST["chkSillaBebe"].','.$cantidad.')');
            $logReserva.="SILLA REGISTRADA|";
          }
        }
        
        $mensaje= "<h1 style='font-size: 18px;'> ¡Gracias por consultarnos!  En breve nos estaremos comunicando vía WhatsApp o correo electrónico. </h1>";
        $mensaje.="<table style='width:500px'>";
        $mensaje.="<tr><td colspan='2'><img src='https://3wheels.com.ar/cotizador/img/logomail.png' alt='Description of Image' /></td></tr>";
        $mensaje.="<tr><td colspan='2'><h3><b>Detalle de la cotización</b></h3></td></tr>";
        $mensaje.="<tr><td><b>Modelo</b></td><td>".$reserva["MODELO"]."</td></tr>";
        $mensaje.="<tr><td><b>Desde</b></td><td>".date_format(date_create($_SESSION["fechaDesde"]),"d/m/Y")." - ".$_SESSION["horaDesde"]." hs.</td></tr>";
        $mensaje.="<tr><td><b>Hasta</b></td><td>".date_format(date_create($_SESSION["fechaHasta"]),"d/m/Y")." - ".$_SESSION["horaHasta"]." hs.</td></tr>";
        $mensaje.="<tr><td><b>Lugar</b></td><td>".$lugar_nombre."</td></tr>";
        $mensaje.="<tr><td><b>Cobertura</b></td><td>".$Cobertura."</td></tr>";
        $mensaje.="<tr><td><b>Silla de bebe</b></td><td>".$Sillabebe."</td></tr>";
        // $mensaje.="<tr><td><b>Total opcionales</b></td><td>".$Totaldopcionales."</td></tr>";
        $mensaje.="</table><br><br>";

        $data=sp('TARIFARIO_CALCULAR('.$resultado[0][0].')');
        $cotizacion=$data;
                                                    
        $total=0;

        if(!$consultar){
            $mensaje.="<table style='width:500px; box-sizing: border-box; border-collapse: collapse; border-spacing: 0px;'>";
            $mensaje.="<tr style='text-align: left;'><td style='border: solid 1px #000000;'><b>ITEM</b></td>";
            $mensaje.="<td style='text-align: right; border: solid 1px #000000;'><b>PRECIO UNITARIO</b></td>";
            $mensaje.="<td style='text-align: center; border: solid 1px #000000;'><b>CANTIDAD</b></td>";
            $mensaje.="<td style='text-align: right; border: solid 1px #000000;'><b>SUBTOTAL</b></td></tr>";

            $mensaje.="<tr><td style='text-align:left; border: solid 1px #000000;'>Precio Cotización</td>";
            $mensaje.="<td style='text-align:right; border: solid 1px #000000'>$ ".number_format($precioCotizacion / $cantidad, 0, ',', '.')."</td>";
            $mensaje.="<td style='text-align:center; border: solid 1px #000000'>".$cantidad."</td>";
            $mensaje.="<td style='text-align:right; border: solid 1px #000000'>$ ".number_format($precioCotizacion, 0, ',', '.')."</td></tr>";
            if ($precioCotizacionPromo < $precioCotizacion && $precioCotizacionPromo > 0) {
              $diferenciaPromo = $precioCotizacion - $precioCotizacionPromo;
              // $mensaje.="<tr><td style='text-align:left; border: solid 1px #000000;'>Precio Promo</td>";
              // $mensaje.="<td style='text-align:right; border: solid 1px #000000'>$ ".number_format($precioCotizacionPromo / $cantidad, 0, ',', '.')."</td>";
              // $mensaje.="<td style='text-align:center; border: solid 1px #000000'>".$cantidad."</td>";
              // $mensaje.="<td style='text-align:right; border: solid 1px #000000'>$ ".number_format($precioCotizacionPromo, 0, ',', '.')."</td></tr>";
              $mensaje.="<tr><td style='text-align:left; border: solid 1px #000000;'>Descuento Promo</td>";
              $mensaje.="<td style='text-align:right; border: solid 1px #000000'>$ - ".number_format($diferenciaPromo / $cantidad, 0, ',', '.')."</td>";
              $mensaje.="<td style='text-align:center; border: solid 1px #000000'>".$cantidad."</td>";
              $mensaje.="<td style='text-align:right; border: solid 1px #000000'>$ - ".number_format($diferenciaPromo, 0, ',', '.')."</td></tr>";
            }

            if ($totalOpcionales > 0) {
              $mensaje.="<tr><td style='text-align:left; border: solid 1px #000000;'>Total Opcionales</td>";
              $mensaje.="<td style='text-align:right; border: solid 1px #000000'>$ ".number_format($totalOpcionales, 0, ',', '.')."</td>";
              $mensaje.="<td style='text-align:center; border: solid 1px #000000'>".$cantidad."</td>";
              $mensaje.="<td style='text-align:right; border: solid 1px #000000'>$ ".number_format($totalOpcionales, 0, ',', '.')."</td></tr>";
            }
            if ($descuentoEfectivo > 0) {
              $mensaje.="<tr><td style='text-align:left; border: solid 1px #000000;'>Descuento en Efectivo</td>";
              $mensaje.="<td style='text-align:right; border: solid 1px #000000'>$ - ".number_format($descuentoEfectivo / $cantidad, 0, ',', '.')."</td>";
              $mensaje.="<td style='text-align:center; border: solid 1px #000000'>1</td>";
              $mensaje.="<td style='text-align:right; border: solid 1px #000000'> $ -".number_format($descuentoEfectivo, 0, ',', '.')."</td></tr>";
            }

            $mensaje.="<tr><td colspan='3' style='text-align: right; border: solid 1px #000000'><b>TOTAL A ABONAR</b></td>";
            $mensaje.="<td style='text-align: right; border: solid 1px #000000;' ><b>$ ".number_format($precioCotizacionAAbonar, 2, ',', '.')."</b></td></tr>";
            $mensaje.="</table>";
        }

        $mensaje.="<table style='width:500px'>";
        $mensaje.="<br><br><br><br><br>";
        $mensaje.="<tr><td colspan='2'><h3><b>Datos personales</b></h3></td></tr>";
        $mensaje.="<tr><td><b>Nombre</b></td><td>".obtenerValor("txtNombre")."</td></tr>";
        //$mensaje.="<tr><td><b>DNI</b></td><td>".obtenerValor("txtDni")."</td></tr>";
        $mensaje.="<tr><td><b>Telefono</b></td><td>".obtenerValor("txtTelefono")."</td></tr>";
        $mensaje.="<tr><td><b>Correo</b></td><td>".obtenerValor("txtCorreo")."</td></tr>";
        //$mensaje.="<tr><td><b>Correo</b></td><td>".obtenerValor("txtLocalidad")."</td></tr>";
        $mensaje.="<tr><td><b>Medio de pago</b></td><td>".$medioDePago[obtenerValor("hddMedioPago")]."</td></tr>";
        $mensaje.="</table>";
        // $mensaje.="<span>Forma de pago elegida: ".medioDePagoElegido."</span>";
        $mensaje.="<br><br><br><span>Tenés un descuento por Promoción Vigente!!!</span><br>";

        $mensaje.="<span style='text-decoration: underline;'>Incluye:</span>
        <ul>
          <li>Seguro todo riesgo  
          </li>
          <li>
            Conductor adicional sin cargo  
          </li>
          <li>
            Kilometraje ilimitado  
          </li>
        </ul>
        <span style='text-decoration: underline;'>Debe presentar:</span>
        <ul>
          <li>Foto DNI </li>
          <li>Foto licencia de conducir </li>
          <li>Tarjeta de crédito  </li>
          <li>Resumen de tarjeta de crédito donde se vea el saldo disponible </li>
          <li>Mayor de 25 años </li>
        </ul>";
        $mensaje.="Precio promocional por tiempo Limitado. Apúrate a Reservar!";
        $mensaje.=" <div style='display: flex;
        align-items: center;'>
          Si desea, puede contactarnos aquí:   
          <div style='width: 25px; margin-left: 30px;'> 
            <a size='50' href='https://wa.me/5491122919281'
           target='_blank' color='#4dc247' id='' direction='column' order='whatsapp' class='sc-q8c6tt-0 hCwaxi'>
           <img style='width : 30px; height: 30px;' src='https://3wheels.com.ar/cotizador/img/whatsapplogo.png' alt='Description of Image' />
           </a>
          </div>   
        </div>";
  
        $mensaje.= "      <table>
        <tr>  
          <td>
          <span style='color: #5c7f89;'>Saludos</span>
          </td>
        </tr>
        <tr>
        <td>
        <a href='www.3wheels.com.ar' style='color: #5c7f89;' target='_blank' >www.3wheels.com.ar </a>
        </td>
      </tr>
      <tr>
      <td>
      <span>Cel: 11-2291-9281 <a style='color: #5c7f89;' href='mailto:info@3wheels.com.ar' >info@3wheels.com.ar</a> </span>
      </td>
    </tr>
    <tr>
    <td>
    <span>Casa Central: Shopping vía Pilar Local 5. Sucursales.</span>
    </td>
  </tr>
        </table>" ;
        // $mensaje.=" <span style='color: #5c7f89;'>Saludos</span>";
        // $mensaje.=" <a href='www.3wheels.com.ar' style='color: #5c7f89;' target='_blank' >www.3wheels.com.ar </a>";
        // $mensaje.=" <span>Cel: 11-2291-9281 <a style='color: #5c7f89;' href='mailto:info@3wheels.com.ar' >info@3wheels.com.ar</a> </span>";
        // $mensaje.=" <span>Casa Central: Shopping vía Pilar Local 5. Sucursales.</span>";



        if($consultar){
          $mensaje.="<h2>Precios a consultar.Nos pondremos en contacto a la brevedad.</h2>";
        }
        // $AsuntoEmail="3Wheels - Solicitud de reserva - #".$resultado[0][0];
        $AsuntoEmail="3Wheels - Solicitud de cotización ";


        $cabeceras  = 'MIME-Version: 1.0'."\r\n";
        $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $cabeceras .= 'From: 3Wheels <info@3wheels.com>'."\r\n";
      
        $mailEnviado=mail(obtenerValor("txtCorreo"), $AsuntoEmail, $mensaje, $cabeceras);
        $mailEnviado=mail('info@3wheels.com.ar', $AsuntoEmail, $mensaje, $cabeceras);

        if($mailEnviado){
          $logReserva.="Mail enviado|";
        }else{
          $logReserva.="Mail no enviado|";
        }
    }
    catch(Exception $e){
      // var_dump($e);
      // sp_exec('LOG_REGISTRAR(2,"'.$e->getMessage().'","'.$resultado[0][0].'","'.$argumentos.'")');
    }
    finally{
      // sp_exec('LOG_REGISTRAR(1,"'.$logReserva.'","'.$resultado[0][0].'","'.$argumentos.'")');
      session_destroy();
    }

  }else{
 
    die();
    $resultado=$error;
    sp_exec('LOG_REGISTRAR(2,"'.$error.'","Validacion reserva","'.$argumentos.'")');
  }
 // $_SESSION["LD"]=$_POST["chkLD"];  
}
else{

  session_destroy();
  header("Location: index.php?c=1");
  die();


}
?>

<!doctype html>
<html class="no-js" lang="es">
<head>
<title>3Wheels | Rent a Car</title>
<meta name="keywords" content="alquiler, autos, renta, rent, car, pilar, zona norte, turismo, viajes, vacaciones, fatima, polo, golf,">
<meta name="description" content="Alquiler de autos en Pilar, entrega a domicilio, seguro todo riesgo en todas las unidades.">
<meta charset="utf-8">
<meta name="author" content="NalandaDiseñoIntegral">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
<!-- favicon -->
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.png">
<!-- animation -->
<link rel="stylesheet" href="css/animate.css" />
<!-- bootstrap -->
<link rel="stylesheet" href="css/bootstrap.css" />
<!-- et line icon -->
<link rel="stylesheet" href="css/et-line-icons.css" />
<!-- font-awesome icon -->
<link rel="stylesheet" href="css/font-awesome.min.css" />
<!-- revolution slider -->
<link rel="stylesheet" href="css/extralayers.css" />
<link rel="stylesheet" href="css/settings.css" />
<!-- magnific popup -->
<link rel="stylesheet" href="css/magnific-popup.css" />
<!-- owl carousel -->
<link rel="stylesheet" href="css/owl.carousel.css" />
<link rel="stylesheet" href="css/owl.transitions.css" />
<link rel="stylesheet" href="css/full-slider.css" />
<!-- text animation -->
<link rel="stylesheet" href="css/text-effect.css" />
<!-- common -->
<link rel="stylesheet" href="css/style.css" />
<!-- responsive -->
<link rel="stylesheet" href="css/responsive.css" />
<!--[if IE]>
            <link rel="stylesheet" href="css/style-ie.css" />
        <![endif]-->
<!--[if IE]>
            <script src="js/html5shiv.js"></script>
        <![endif]-->

<script  type="text/javascript" language="javascript" defer src="data.js"></script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PKGSW3C');</script>
<!-- End Google Tag Manager -->
<!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-802895878"></script> 
<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-802895878'); </script> 

<!-- Event snippet for Formulario completado conversion page --> <script> gtag('event', 'conversion', {'send_to': 'AW-802895878/V2s4CJTLt7kYEIbw7P4C'}); </script>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PKGSW3C"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- navigation panel -->
<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav nav-border-bottom bg-white" role="navigation">
  <div class="container">
    <div class="row"> 
      <!-- logo -->
      <div class="col-md-2 pull-left"><a class="logo-light" href="index.php"><img alt="" src="img/logo1.png" class="logo" /></a><a class="logo-dark" href="/"><img alt="" src="img/logo1.png" class="logo" /></a></div>
      <!-- end logo --> 
      
      <!-- toggle navigation -->
      <div class="navbar-header col-sm-10 col-xs-2 pull-right">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <!-- toggle navigation end --> 
      <!-- main menu -->
      <div class="col-md-10 accordion-menu text-right">
                        <div class="navbar-collapse collapse">
                            <ul id="accordion" class="nav navbar-nav navbar-right panel-group">
                                <!-- menu item -->
                                <li class="dropdown panel"><a href="index.html" >Inicio </a> </li>
                                <!-- end menu item -->
                                                        
                                <!-- menu item -->
                                <li class="dropdown panel simple-dropdown"><a href="#collapse7" class="dropdown-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-hover="dropdown">Flota <i class="fa fa-angle-down"></i></a>
                                    <!-- sub menu single -->
                                    <!-- sub menu item  -->
                                    <ul id="collapse7" class="dropdown-menu panel-collapse collapse" role="menu">
                                         <li><a href="categoria-a.html">Categoria A</a></li>
                                        <li><a href="categoria-b.html">Categoria B</a></li>
                                        <li><a href="categoria-c.html">Categoria C</a></li>
                                        
                                    </ul>
                                    <!-- end sub menu item  -->
                                    <!-- end sub menu single -->
                                </li>
                                <!-- end menu item -->  
                                <li class="dropdown panel"><a href="faq.html" >FAQ </a> </li>
                                  <li class="dropdown panel"><a href="promos.html" >Promos </a> </li>
                                <li class="dropdown panel"><a href="aquiler-empresas.html" >Alquiler a empresas </a> </li>
                                  <li class="dropdown panel"><a href="contacto.html" >Contacto </a> </li>
                                 <div class=top-cart>
<a href="tel://5491122919281" style="font-size:20px">
<i class="fa fa-phone"></i>
</a>
<a href="https://api.whatsapp.com/send?phone=5491122919281" style="font-size:20px; color:#92bee2">
<i class="fa fa-whatsapp"></i>
+54 911 22919281
</a>
</div>
                        
                           
                                
                                
                                
                                
                                
                            </ul>
                        </div>
                    </div>
      <!-- end main menu --> 
    </div>
  </div>
</nav>
<!-- end navigation panel --> 
<!-- Slide -->
   <!-- head section -->
        <section class="page-title parallax3 parallax-fix page-title-large">
            <div class="opacity-light bg-black"></div>
            <img class="parallax-background-img" src="img/faq.jpg" alt="" />
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-center animated fadeInUp">
                       
                        <!-- page title -->
                        <h3 class="white-text">CONTACTO</h3>
                         <div class="separator-line bg-white margin-top margin-two"></div>
                        <!-- end page title -->
                        <!-- page title tagline -->
                       
                      <!-- end title tagline -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end head section -->
        
        <br>
        <section id="contact-form" class="wow fadeIn">
            <div class="container">
                <div class="row">
                  <div class="col-md-8 col-sm-6 center-col text-center">
                        <span class="title-large text-uppercase letter-spacing-1 font-weight-600 black-text">Formulario Enviado</span>
                    <div class="separator-line bg-yellow margin-top margin-two"></div><br>

                      <p class="no-margin-bottom">Te enviaremos un mail. Si no lo puedes ver revisa la casilla de &quot;spam&quot;. <br>
                      Tu reserva está casi terminada, nos pondremos en contacto con vos o comunícate con nosotros al whatsapp: <a href="https://api.whatsapp.com/send?phone=5491122919281" style="font-size:20px; color:#92bee2">
<i class="fa fa-whatsapp"></i>
+54 911 22919281
</a></p>
                    </div>
                    <div class="col-md-6 col-sm-6  col-md-offset-2">
                       
                             
                             
                            
                    </div>
                </div>
            </div>
        </section>
        
        
        
<!-- about section --><br><br>
    
    


<!-- end about section --><!-- features section --><!-- end features section --> 
<!-- counter section --><!-- end counter section --> 
<!-- portfolio section --><!-- end portfolio section --> 
<!-- work process section --><!-- end work process section --> 
<!-- highlight section -->

<section class="parallax1 parallax-fix spa-our-packages xs-onepage-section" style="background: url(img/RentaCarPilar.jpg) 50% -11px;">
  <div class="opacity-full bg-promo"></div>
  <div class="container">
    <div class="row padding-two sm-text-center">
      <div class="col-md-12 no-padding text-center">
        <h3 class="white-text">CONSULTÁ NUESTRAS PROMOCIONES PARA ESTE MES</h3><br>
         <a class="highlight-button btn btn-medium button xs-margin-bottom-five xs-no-margin-right" href="promos.html">COnsultar ahora</a> </div>
    </div>
  </div>
</section>

<section class="wow fadeIn no-padding">
            <div class="container-fuild">
                <div class="row no-margin">
                    <div id="canvas1" class="col-md-6 col-sm-6 no-padding contact-map map">
                        <iframe id="map_canvas1" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3290.674208965493!2d-58.83340658430321!3d-34.43502965610009!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bc9c2868394341%3A0x64a3055401da2f83!2sR.+Caama%C3%B1o+1103%2C+B1631BUW+Villa+Rosa%2C+Buenos+Aires!5e0!3m2!1ses!2sar!4v1554775268043!5m2!1ses!2sar"></iframe> </div>
                        
                        
                        <div id="canvas2" class="col-md-6 col-sm-6 no-padding contact-map map">
                        <iframe id="map_canvas2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3283.3883544968307!2d-58.37542798452648!3d-34.61962508045526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccb2b67307dc3%3A0xb9a91fdf8acb1aae!2sCarlos+Calvo+524%2C+C1102AAL+CABA!5e0!3m2!1ses!2sar!4v1555450674179!5m2!1ses!2sar"></iframe>
                        
         
                        
                    </div>
                </div>
            </div>
        </section>
<!-- end highlight section --> 
<!-- services section --><!-- end services section --> 
<!-- key person section --><!-- end key person section --> 
<!-- case study section --> 

<!-- case study section --> 
<!-- testimonial section --><!-- end testimonial section --> 

<!-- approach section --> 

<!-- end approach section --> 
<!-- new project section --> 

<!-- end new project section --> 
<!-- footer -->

        
        <footer>
            <div class=" bg-white">
                <div class="container">
                    <div class="row margin-four">
                        <!-- phone -->
                        <div class="col-md-4 col-sm-4 text-center"><i class="icon-phone small-icon black-text"></i>
                        <h6 class="black-text margin-two no-margin-bottom"><a href="https://api.whatsapp.com/send?phone=5491122919281" >+54 911 22919281</a></h6></div>
                        <!-- end phone -->
                        <!-- address -->
                        <div class="col-md-4 col-sm-4 text-center"><i class="icon-map-pin small-icon black-text"></i>
                        <h6 class="black-text margin-two no-margin-bottom">R. Caamaño 1103,  Villa Rosa, Buenos Aires.</h6></div>
                        <!-- end address -->
                        <!-- email -->
                        <div class="col-md-4 col-sm-4 text-center"><i class="icon-envelope small-icon black-text"></i>
                        <h6 class="margin-two no-margin-bottom"><a href="mailto:info@3wheels.com.ar" class="black-text">info@3wheels.com.ar</a></h6></div>
                        <!-- end email -->
                    </div>
                </div>
            </div>
            
            <div class="container-fluid bg-dark-gray footer-bottom">
                <div class="container">
                    <div class="row margin-three">
                        <!-- copyright -->
                        <div class="col-md-6 col-sm-6 col-xs-12 copyright text-left letter-spacing-1 xs-text-center xs-margin-bottom-one">
                            &copy; 2019 3wheels. Todos los derechos reservados.</div>
                        <!-- end copyright -->
                        <!-- logo -->
                        <div class="col-md-6 col-sm-6 col-xs-12 footer-logo text-right xs-text-center">
                            <a href="index.html"><img src="img/logo-pie.png" alt="" /></a>
                        </div>
                        <!-- end logo -->
                    </div>
                </div>
            </div>
            <!-- scroll to top -->
            <a href="javascript:;" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
            <!-- scroll to top End... -->
        </footer>
<!-- end footer --> 
<!-- javascript libraries --> 
<script type="text/javascript" defer src="js/jquery.min.js"></script> 
<script type="text/javascript" defer src="js/modernizr.js"></script> 
<script type="text/javascript" defer src="js/bootstrap.js"></script> 
<script type="text/javascript" defer src="js/bootstrap-hover-dropdown.js"></script> 
<script type="text/javascript" defer src="js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" defer src="js/skrollr.min.js"></script> 
<script type="text/javascript" defer src="js/smooth-scroll.js"></script> 
<!-- animation --> 
<script type="text/javascript" defer src="js/wow.min.js"></script> 
<!-- page scroll --> 
<script type="text/javascript" defer src="js/page-scroll.js"></script> 
<!-- easy piechart--> 
<script type="text/javascript" defer src="js/jquery.easypiechart.js"></script> 
<!-- parallax --> 
<script type="text/javascript" defer src="js/jquery.parallax-1.1.3.js"></script> 
<!--portfolio with shorting tab --> 
<script type="text/javascript" defer src="js/jquery.isotope.min.js"></script> 
<!-- owl slider  --> 
<script type="text/javascript" defer src="js/owl.carousel.min.js"></script> 
<!-- magnific popup  --> 
<script type="text/javascript" defer src="js/jquery.magnific-popup.min.js"></script> 
<script type="text/javascript" defer src="js/popup-gallery.js"></script> 
<!-- text effect  --> 
<script type="text/javascript" defer src="js/text-effect.js"></script> 
<!-- revolution slider  --> 
<script type="text/javascript" defer src="js/jquery.tools.min.js"></script> 
<script type="text/javascript" defer src="js/jquery.revolution.js"></script> 
<!-- counter  --> 
<script type="text/javascript" defer src="js/counter.js"></script> 
<!-- fit videos  --> 
<script type="text/javascript" defer src="js/jquery.fitvids.js"></script> 
<!-- imagesloaded  --> 
<script type="text/javascript" defer src="js/imagesloaded.pkgd.min.js"></script> 
<!-- setting --> 
<script type="text/javascript" defer src="js/main.js"></script>
</body>
</html>
