<?php 
session_start();
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('admin/app/database.php');

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

$maletaGrande=array(
  'Kwid'=>1,
   'Etios'=>1,
   'Gol Trendline'=>1,
   'Cronos'=>2,
   'Prisma'=>2,
   'RENAULT CLIO'=>1
);

$maletaChica=array(
  'Kwid'=>1,
   'Etios'=>2,
   'Gol Trendline'=>1,
   'Cronos'=>2,
   'Prisma'=>2,
   'RENAULT CLIO'=>1
);


if(!isset($_SESSION["disponibles"])){
  header("Location: index.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  
  $minutes = (time() - $_SESSION['tiempo']) / 60;
  
  if($minutes > 5){
    header("Location: formulario.php");
    die();
  }
  $disponibles=$_SESSION["disponibles"];
  $reserva=null;
  foreach($disponibles as $disponible){
      if($disponible["MODELO"]==$_POST["modelo"]){
        $reserva=$disponible;
      }
  }
  $_SESSION["reserva"]=$reserva;
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
<link rel="stylesheet" href="./css/owl.carousel.css" />
<link rel="stylesheet" href="./css/owl.transitions.css" />
<link rel="stylesheet" href="css/full-slider.css" />
<!-- text animation -->
<link rel="stylesheet" href="css/text-effect.css" />
<!-- common -->
<link rel="stylesheet" href="css/style.css" />
<!-- responsive -->
<link rel="stylesheet" href="../css/responsive.css" />


<!--[if IE]>
            <link rel="stylesheet" href="css/style-ie.css" />
        <![endif]--> 
<!--[if IE]>
            <script src="js/html5shiv.js"></script>
        <![endif]--> 

<script> (function(i,s,o,g,r,a,m){ i['GoogleAnalyticsObject']=r; i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)}, i[r].l=1*new Date(); a=s.createElement(o),m=s.getElementsByTagName(o)[0]; a.async=1; a.src=g; m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-127899392-1', 'auto'); ga('send', 'pageview'); </script> 
<!-- Google Tag Manager --> 
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PKGSW3C');</script> 
<!-- End Google Tag Manager -->

<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-802895878"></script> 
<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-802895878'); </script> </head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PKGSW3C"
height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) --> 

<!-- navigation panel -->
<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav nav-border-bottom bg-white" role="navigation">
  <div class="container">
    <div class="row"> 
      <!-- logo -->
      <div class="col-md-2 pull-left"><a class="logo-light" href="index.php"><img alt="" src="img/logo1.png" class="logo" /></a><a class="logo-dark" href="index.php"><img alt="" src="img/logo1.png" class="logo" /></a></div>
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
            <li class="dropdown panel"><a href="index.php" >Inicio </a> </li>
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
            <div class="top-cart"> <a href="tel://5491122919281" style="font-size:20px"> <i class="fa fa-phone"></i> </a> <a href="https://api.whatsapp.com/send?phone=5491122919281" style="font-size:20px; color:#92bee2"> <i class="fa fa-whatsapp"></i> +54 911 22919281 </a> </div>
          </ul>
        </div>
      </div>
      <!-- end main menu --> 
    </div>
  </div>
</nav>
<!-- end navigation panel --> 
<!-- Slide -->
<section class="page-title parallax3 parallax-fix page-title-large page-title-shop">
  <div class="opacity-light bg-dark-gray"></div>
  <img class="parallax-background-img" src="img/RentaCarPilar.jpg" alt="" />
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 wow fadeIn margin-three breadcrumb text-uppercase"> 
        
        <h1 class="white-text">COTIZACIÓN ONLINE</h1>
		  
		   <ul>
          <li><a href="index.php">Inicio</a></li>
          <li>Autos y precios disponibles</li>
        </ul>
        <!-- end page title --> 
      </div>
     
    </div>
  </div>
</section>
<!-- about section --> 

<!-- content section -->

<section class="wow fadeIn xs-no-padding-bottom xs-no-padding-top bg-gray">
  <div class="container">
  <div class="row padding-two">
      <div class="col-12">
      <a   href="javascript:window.history.back();" class="btn btn-primary btn-round btn-small margin-four no-margin-bottom btn-volver">
      <i class="fa fa-angle-left mr-2"></i>  
      Volver</a>
      </div>
    </div>
  </div>
  <div class="container bg-white border-top border-bottom border-left2 border-right"> 

    <!-- COLUMNA OPCIONALES -->
    <div class="col-md-8 col-sm-6 border-right">
      <div class="row padding-three"> 
        
        <!-- COLUMNA FOTOS -->
        <div class="col-md-6 col-sm-6">
          <div class="clearfix ">
            <div class=" ocultar-div col-md-7  col-sm-12 col-xs-6 zoom-gallery sm-margin-bottom-ten"> <a href="<?php echo $reserva["IMAGEN"] ?>"><img src="<?php echo $reserva["IMAGEN"] ?>" alt=""/></a>
            <div class="products-thumb text-center"> <a href="<?php echo $reserva["MINIATURA_1"] ?>"><img src="<?php echo $reserva["MINIATURA_1"] ?>" alt=""/></a> 
            <a href="<?php echo $reserva["MINIATURA_2"] ?>"><img src="<?php echo $reserva["MINIATURA_2"] ?>" alt=""/></a><a href="<?php echo $reserva["MINIATURA_3"] ?>"><img src="<?php echo $reserva["MINIATURA_3"] ?>" alt=""/></a> </div>
          </div>
          <div class="col-12 no-ocultar-div">
                  <div class=" owl-theme dark-pagination owl-no-pagination owl-prev-next-simple owl-carousel2" style="height: auto;">

                    <div class="d-flex justify-content-center">
                      <div class="previous-btn"><i class="fa fa-angle-left"></i></div>
                      <img src="<?php echo $reserva["IMAGEN"] ?>" class="img-fluid" alt="">
                      <div class="next-btn"><i class="fa fa-angle-right"></i></div>
                    </div>
                    <div class="d-flex justify-content-center">
                      <div class="previous-btn"><i class="fa fa-angle-left"></i></div>
                      <img src="<?php echo $reserva["MINIATURA_1"] ?>" class="img-fluid" alt="">
                      <div class="next-btn"><i class="fa fa-angle-right"></i></div>
                    </div>
                    <div class="d-flex justify-content-center">
                      <div class="previous-btn"><i class="fa fa-angle-left"></i></div>
                      <img src="<?php echo $reserva["MINIATURA_2"] ?>" class="img-fluid" alt="">
                      <div class="next-btn"><i class="fa fa-angle-right"></i></div>
                    </div>

                  </div>
                </div>
            <div class="col-md-5 col-sm-12 margen2"> <span class="product-name-details text-uppercase font-weight-600 letter-spacing-2 black-text"><?php echo $reserva["MARCA"]."<br>".$reserva["MODELO"]?>  </span>
              <p class="letter-spacing-1 font-weight-600 margin-two pink-text">(o similar)</p>
             
              <div class="col-lg-3 col-md-5 col-xs-2 no-padding-left text-center"> <img src="img/ico-maleta-grande.png" alt="Maletas Grandes"/><br>
                <?php 
                
                switch($reserva["MODELO"]){
                    case "Prisma":
                    echo "2";
                    break;

                    case "Cronos":
                    echo "2";
                    break;

                    default:
                    echo "1";;
                    break;
                }
                ?>
                
                
                </div>
			    <div class="col-lg-3 col-md-5 col-xs-2 no-padding-left text-center"> <img src="img/ico-maleta-chica.png" alt="Maletas Chicas"/><br>
          <?php 
                
                switch($reserva["MODELO"]){
                    case "Kwid":
                    echo "1";
                    break;
                    
                    default:
                    echo "2";;
                    break;
                }
                ?>
        
        
        
        </div>
              <div class="col-lg-3 col-md-5 col-xs-2 no-padding-left text-center"> <img src="img/ico-AC.png" alt="Aire Acondicionado"/><br>
                SI</div>
              <div class="col-lg-3 col-md-5 col-xs-2 no-padding-left text-center"> <img src="img/ico-cambios.png" alt="Caja de Cambios"/><br>
                MT</div>
             
            </div>
          </div>
  
        </div>
        <!-- FIN COLUMNA FOTOS --> 
        
        <!-- COLUMNA PUNTUACION -->
        <div class="col-md-6 col-sm-6 border-md-left2">
          <div class="clearfix">
            <div class="col-md-12 col-sm-12 position-relative px-md-0 ">
              <div class="row margin-bottom-seven">
                <div class="col-md-12 d-md-none">
                   <!-- <img src="img/logo-cotizador.png" alt="" width="75" height="46"/>  -->
                   <img src="https://www.3wheels.com.ar/cotizador/img/logo1.png" alt="" >
                  
                  </div>
              
				   <!-- <div class="col-md-8 col-xs-8">
				  
				  
				  <div class="col-md-2 rating no-margin no-margin-top">
				
				<h2 class="font-weight-600">4.2</h2>
				 </div>
			  
				<div class="col-md-7 col-sm-12 position-relative">
				<i class="fa fa-star pink-text"></i><i class="fa fa-star pink-text"></i><i class="fa fa-star pink-text"></i><i class="fa fa-star pink-text"></i><i class="fa fa-star-o pink-text"></i><br><span class="rating-text text-uppercase">excelente</span>
				
				 </div>	
         
        
        </div>	   -->
				  
              </div>
           
				
              <p class="margen3"></p>
              <div class="row margin-top margin-bottom-seven">
				<div class="col-md-12 no-margin-left no-margin-right px-0">
					<a class="btn-primary btn btn-very-small button btn-round xs-margin-bottom-five" href="#">Mejor Precio</a>
	<a class="btn-success btn btn-very-small button btn-round xs-margin-bottom-five" href="#">Oferta de hoy</a>
						<a class="btn-danger btn btn-very-small button btn-round sm-margin-top-three xs-no-margin" href="#">Imperdible</a>
			  </div> 
			  
			  </div>
				
				<div class="row margin-top">
				<div class="col-md-10 text-xs">
					<p style="color:#2142a0"><strong>¿Tenés dudas?</strong> Hacé <strong>Click</strong> en el logo de Whatsapp para comunicarte con nosotros. </p>
			  </div> </div>
				
            </div>
          </div>
        </div>
        <!-- FIN COLUMNA PUNTUACION --> 
      </div>
      
      <!-- COLUMNA OPCIONALES -->
      <div class="row padding-three">
        <div class="col-md-11 col-sm-8 dividers-header double-line text-left">
          <div class="subheader bg-white">
            <p class="letter-spacing-1 font-weight-600 margin-two pink-text text-uppercase">opcionales</p>
          </div>
        </div>
        <div class="col-md-10 col-sm-12 col-md-offset-2 padding-two">
          <ul class="flat-list flat-list-icon">
            <li>       <input style="margin-right: 0.5rem;" name="chkCobertura" type="checkbox" id="chkCobertura" value="0.2" onclick="javascript:recalcularOpcionales()"></i><strong>Cobertura Premium:</strong> Reduce el valor de la franquicia y los cargos por daños al vehículo.</li>
              <li> <input style="margin-right: 0.5rem;" name="chkSillaBebe" type="checkbox" id="chkSillaBebe" value="3990" onclick="javascript:recalcularOpcionales()"></i><strong>Silla bebe</strong></li>
			  
			  <li><input style="margin-right: 0.5rem;" type="checkbox"> <i class="icon-map-pin" style="color:#5aa5e6"></i><strong>Entrega a Domicilio: </strong>Con cargo extra, a determinar según dirección de entrega.</li>
         
          </ul>
        </div>
        <div class="col-md-11 col-sm-8 dividers-header text-left">
           <div class="subheader bg-white">
            <p class="letter-spacing-1 font-weight-600 margin-two pink-text text-uppercase">Requisitos:</p>
          </div> </div>
			<div class="col-md-10 col-sm-12 col-md-offset-2 padding-two">
			  <ul class="flat-list flat-list-icon">
            <li><i class="fa fa-check" style="color:#5aa5e6"></i>DNI.</li>
            <li><i class="fa fa-check" style="color:#5aa5e6"></i>Licencia de conducir y la del/los conductores/es adicionales.</li>
            <li><i class="fa fa-check" style="color:#5aa5e6"></i>Tarjeta de crédito.</li>
            <li><i class="fa fa-check" style="color:#5aa5e6"></i>Comprobante del límite mensual disponible en su tarjeta de crédito.</li>
          </ul>
			</div>
		  
		   <div class="col-md-11 col-sm-8 col-md-offset-2 dividers-header text-left alert alert-success padding-three  margin-one">
			 
			 <div class="col-md-10 col-sm-8 center-col text-center">  
                            <i class="fa fa-info-circle alert-success-icon"></i>
                            <strong class="text-uppercase">Información de la cotización:</strong><br>
					
                        </div>
			  
			   <div class="col-md-6 col-sm-6">  <div class="fade in" role="alert">
						<span>Fecha y hora desde: <strong><?php echo date_format(date_create($_SESSION["fechaDesde"]),"d/m/Y")." - ".$_SESSION["horaDesde"] ?>hs.</strong></span> <br>
				  		<span>Fecha y hora hasta: <strong><?php echo date_format(date_create($_SESSION["fechaHasta"]),"d/m/Y")." - ".$_SESSION["horaHasta"] ?>hs.</strong></span> <br>

              
                           	<!-- <span>Mismo lugar de devolución: <strong> -->
                              <?php  
                              
                            //   if(isset($_SESSION["LD"]) && $_SESSION["LD"] == "LD") {
                            //     echo "Sí";
                            // } else {
                            //     echo "No";
                            // }
                          ?>
<!-- </strong></span> -->
				  		
                        </div>
			    </div>
			    <div class="col-md-6 col-sm-6">  <div class="fade in" role="alert">
                         					
				  		<span>Lugar de Retiro: <strong><?php if($lugar_nombre != null) { echo $lugar_nombre; } ?></strong></span> <br>
				   <span>Cantidad de dias: <strong><?php echo $_SESSION["cantidad"]; ?></strong></span> <br>
                        </div>
			    </div>
		 </div>  
      </div>
      <!-- FIN COLUMNA OPCIONALES --> 
    </div>
    
    <!-- COLUMNA DERECHA -->
    <div class="col-md-4 col-sm-9 text-right padding-two" style="color:#2a3874">
      <div class="row margin-bottom-three">
        <div class="col-md-12 "> <span class="price black-text title-small text-left">Resumen de Cotización:</span> </div>
      </div>
      <div class="row margin-bottom-two">
        <div class="col-md-8  col-xs-8">
          <p class="text-xs font-weight-400 no-margin text-left">Precio Alquiler </p>
        </div>
        <div class="col-md-4 col-xs-4">
        <p class="text-xs font-weight-400 no-margin text-right" id="precio"></p>
        </div>
      </div>
      <div class="row margin-bottom-two">
        <div class="col-md-8 col-xs-8">
          <p class="text-xs font-weight-400 no-margin text-left">Cantidad de días de alquiler</p>
        </div>
        <div class="col-md-4 col-xs-4">
        <p class="text-xs font-weight-400 no-margin text-right" ><?php echo $_SESSION["cantidad"]; ?></p>
        </div>
      </div>
      <div class="row margin-bottom-two">
        <div class="col-md-8 col-xs-8">
          <p class="text-xs font-weight-400 no-margin text-left">Valor Opcionales </p>
        </div>
        <div class="col-md-4 col-xs-4">
        <p class="text-xs font-weight-400 no-margin text-right" id="totalOpcionales">$0.0</p>
        </div>
      </div>

      <div class="row margin-bottom-two" id="detalleEfectivo" style="display: none;">
        <div class="col-md-8 col-xs-8">
          <p class="text-xs font-weight-400 no-margin text-left">Efectivo </p>
        </div>
        <div class="col-md-4 col-xs-4">
          <p class="text-xs font-weight-400 no-margin text-right" id="descuentoEfectivo">$0.0</p>
        </div>
      </div>

      <div class="row border-top margin-bottom-eleven ">
        <div class="col-md-8 col-sm-8 col-xs-6">
          <p class="font-weight-600 margin-two pink-text text-left">Total a abonar </p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6">
          <p class="font-weight-600 margin-two pink-text" id="totalAbonar"><?php 
          
            
          if(floatval($reserva["PRECIO"])>0){

            echo "$ ".number_format(  $reserva["PRECIO"] , 0, ',', '') ;

          }else{

              echo "Consultar.";

          }
          
           ?></p>
        </div>
      </div>
   
      
    
     
      <div class="row margin-bottom-three">
        <div class="col-md-12"> <span class="price black-text title-small text-left">Forma de Pago:</span> </div>
      </div>
      <div class="row margin-bottom-eleven">
        <div class="col-md-12">
          <p class="text-xs font-weight-400 no-margin text-left">
          <input type="radio" name="rdMedioPago" id="optEfectivo" onclick="medioDePago(this)">
            <strong> Pago Efectivo:</strong> 15% de Descuento </p>
        </div>
        <div class="col-md-12">
          <p class="text-xs font-weight-400 no-margin text-left">
          <input type="radio" name="rdMedioPago" id="optOtros" onclick="medioDePago(this)">
            <strong> Otros medios de pago </strong >
            <select name="txtMedioDePago" required id="selMedioDePago" style="display: none;" onchange="otrosMediosDePago()">
              <option value="0" >Seleccione...</option>
              <option value="2" >Efectivo y tarjeta</option>
              <option value="3" >Tarjeta de débito</option>
              <option value="4" >Depósito bancario</option>
              <option value="5" >Mercadopago</option>
              <option value="6" >Transferencia</option>
            </select> 
        </div>
      </div>
		  <div class="row margin-bottom-one">
        <div class="col-md-12"> <span class="price black-text title-small text-left" style="margin-bottom:10px">Recibirás un mail con tu cotización y los requisitos para alquilar</span> </div>
      </div>
      <div class="row margin-bottom-eleven">
        <div class="col-md-12 col-sm-12 center-col text-right">
        <form name="confirmar" method="POST" action="gracias.php" onsubmit="return checkForm(this)">
          <input type="text" class="form-control" name="txtNombre" id="Name" required placeholder="Nombre y Apellido" size="40">
          <input type="text" class="form-control"  name="txtTelefono" id="Tel"  placeholder="Teléfono" size="40" required>
          <input type="email" class="form-control"  name="txtCorreo" id="Email"  placeholder="Email" size="40" required value="<?php  if(isset($_SESSION["correo"])) { echo $_SESSION["correo"]; }  ?>">
          <button type="submit" class="btn-primary btn btn-small button btn-round xs-margin-bottom-five">Enviar</button>
          <input type="hidden" name="hddMedioPago" id="hddMedioPago">
          <input type="hidden" name="txtDni" value="0">
          <input type="hidden" name="txtEdad" value="1">
          <input type="hidden" name="txtLocalidad" value="localidad">
          <input type="hidden" name="txtSilla" id="txtSilla" value="0">
          <input type="hidden" name="txtCobertura" id="txtCobertura" value="0">
          <input type="hidden" name="totaldopcionales" id="totaldopcionales" value="$0">


        </form>
        <br>
        <div class="g-recaptcha" data-sitekey="6LeIVhsfAAAAAGBZ70fr18qZBFySZ0PCMlf4J8zh" style="display:flex;justify-content:center"></div>
        </div>
      </div>
		  <div class="row margin-bottom-three">
        <div class="col-md-12 col-sm-12 center-col text-center">
          <div class="alert alert-info" role="alert">
            <span><strong class="black-text">Tu cotización está  lista!</strong></span><br>
            <span>Nos pondremos en contacto a la brevedad para completar la documentación.</span><br>
            <span class="black-text">O comunícate para más información:</span><br> 
            <strong><span class="black-text no-margin-top margin-bottom"> 
              <a href="https://api.whatsapp.com/send?phone=5491122919281" style="color:#000000"><i class="fa fa-whatsapp" style="color: #000000"></i> +54 911 22919281</a>
            </span></strong>
            <br> 
          </div>
        </div>
		  </div>
    </div>
    <!-- FIN COLUMNA DERECHA --> 
    
  </div>
</section>

<!-- footer -->

<footer>
  <div class="bg-white">
    <div class="container">
      <div class="row margin-four"> 
        <!-- phone -->
        <div class="col-md-4 col-sm-4 text-center"><i class="icon-phone small-icon black-text"></i>
          <h6 class="black-text margin-two no-margin-bottom"><a href="https://api.whatsapp.com/send?phone=5491122919281" >+54 911 22919281</a></h6>
        </div>
        <!-- end phone --> 
        <!-- address -->
        <div class="col-md-4 col-sm-4 text-center"><i class="icon-map-pin small-icon black-text"></i>
          <h6 class="black-text margin-two no-margin-bottom">R. Caamaño 1103,  Villa Rosa, Buenos Aires.</h6>
        </div>
        <!-- end address --> 
        <!-- email -->
        <div class="col-md-4 col-sm-4 text-center"><i class="icon-envelope small-icon black-text"></i>
          <h6 class="margin-two no-margin-bottom"><a href="mailto:info@3wheels.com.ar" class="black-text">info@3wheels.com.ar</a></h6>
        </div>
        <!-- end email --> 
      </div>
    </div>
  </div>
  <div class="container-fluid bg-dark-gray footer-bottom">
    <div class="container">
      <div class="row margin-three"> 
        <!-- copyright -->
        <div class="col-md-6 col-sm-6 col-xs-12 copyright text-left letter-spacing-1 xs-text-center xs-margin-bottom-one"> &copy; 2019 3wheels. Todos los derechos reservados.</div>
        <!-- end copyright --> 
        <!-- logo -->
        <div class="col-md-6 col-sm-6 col-xs-12 footer-logo text-right xs-text-center"> <a href="index.php"><img src="img/logo-pie.png" alt="" /></a> </div>
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
<script type="text/javascript" defer src="../js/owl.carousel.min.js"></script> 
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
<!-- GetButton.io widget -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">
    (function () {


        var options = {
            whatsapp: "+5491122919281", // WhatsApp number
            call_to_action: "¿Tenés dudas? Comunicate con un asistente ahora.", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();


function redondearDecimales(numero, decimales) {

    numero=Number(numero);
    numeroRegexp = new RegExp('\\d\\.(\\d){' + decimales + ',}');   // Expresion regular para numeros con un cierto numero de decimales o mas
    if (numeroRegexp.test(numero)) {         // Ya que el numero tiene el numero de decimales requeridos o mas, se realiza el redondeo
        return Number(numero.toFixed(decimales));
    } else {
        return Number(numero.toFixed(decimales)) === 0 ? 0 : numero;  // En valores muy bajos, se comprueba si el numero es 0 (con el redondeo deseado), si no lo es se devuelve el numero otra vez.
    }
}



    const format = num => String(num).replace(/(?<!\..*)(\d)(?=(?:\d{3})+(?:\.|$))/g, '$1.');

const result = value=> String(value).toLocaleString('es-ar', {
    style: 'currency',
    currency: 'ARS',
    minimumFractionDigits: 2
});

    document.getElementById("precio").innerHTML="<?php 
    
    if(floatval($reserva["PRECIO"])>0){
      echo "$ ".number_format(  $reserva["PRECIO"] , 0, ',', '.') ;
    }else{
        echo "Consultar";
    }
    
    ?>";
    
    descuento=<?php  echo  sp("CONFIGURACION_OBTENER_DESCUENTO_EFECTIVO()")[0]["VALOR"]; ?>;
    cantidad=<?php  echo $_SESSION["cantidad"] ?>;
    precio=<?php  
    
    if(floatval($reserva["PRECIO"])>0){
      echo  $reserva["PRECIO"]  ;
    }else{
        echo "0";
    }
    ?>;

    function recalcularOpcionales(){
       descuentoEfectivo=0;
       totalPrecio=precio;
       total=0;
       cobertura=document.getElementById("chkCobertura").value;
       silla=document.getElementById("chkSillaBebe").value;


      if(document.getElementById("chkSillaBebe").checked){
        total= total+(silla*cantidad)
        document.getElementById("txtSilla").value="1";
      
      }else{
        document.getElementById("txtSilla").value="0";

      }


      if(document.getElementById("chkCobertura").checked){
        
        total= totalPrecio * cobertura + total;
        
        document.getElementById("txtCobertura").value="1";
      }else {
        document.getElementById("txtCobertura").value="0";

      }

      if(document.getElementById("optEfectivo").checked){

          descuentoEfectivo=((100-descuento)/100)*precio;
          document.getElementById("detalleEfectivo").style.display="flex";
          aux=precio-descuentoEfectivo;
          document.getElementById("descuentoEfectivo").innerHTML=" - $ "+ format(redondearDecimales(result(aux),0));
          
          totalPrecio=descuentoEfectivo;

        }else{

          document.getElementById("detalleEfectivo").style.display="none";
        }
   
        document.getElementById("totalOpcionales").innerHTML="$"+format(total);
        // document.getElementById("totalAbonar").innerHTML="$"+format(total+totalPrecio);
        document.getElementById("totalAbonar").innerHTML="$"+ format(redondearDecimales(result(total+totalPrecio),0));
        document.getElementById("totaldopcionales").value="$"+format(total+totalPrecio);
        
    }


    function checkForm(form){
      if(document.getElementById("optOtros").checked){
          if(document.getElementById("selMedioDePago").value==0){
            alert("Seleccione una medio de pago");
            return false;
          }
      }

      if(!document.getElementById("optOtros").checked && !document.getElementById("optEfectivo").checked){
            alert("Seleccione una forma de pago");
            return false;
      }

      if (document.getElementById('g-recaptcha-response').value.trim() == '') {
        alert("Confirme que no es un robot");
        return true;
      }

      form.btnEnviar.disabled = true;
      return true;
    }

    function medioDePago(opcion){

     if(opcion.id=="optOtros" && opcion.checked){
        document.getElementById("selMedioDePago").style.display="block";
        otrosMediosDePago();
     };
     
     if(opcion.id=="optEfectivo") {
      document.getElementById("selMedioDePago").style.display="none";
      document.getElementById("hddMedioPago").value="1";
     };
     recalcularOpcionales();

    }

    function otrosMediosDePago(){
      document.getElementById("hddMedioPago").value=document.getElementById("selMedioDePago").value;
    }
    function validar(){

    }







        (function () {
            var options = {
                whatsapp: "+5491122919281", // WhatsApp number
                call_to_action: "¿Tenés dudas? Comunicate con un asistente ahora.", // Call to action
                position: "right", // Position may be 'right' or 'left'
            };
            var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
            s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
            var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
        })();


        window.addEventListener('wheel', {
      passive: false
    })
    $(document).ready(function() {
      $(".owl-carousel2").owlCarousel({
        loop:true
      });
    });


    </script>




<!-- /GetButton.io widget -->
</body>
</html>
