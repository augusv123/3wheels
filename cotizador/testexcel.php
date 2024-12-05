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
try {
  // Crear el objeto Spreadsheet
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();

  // Definir los encabezados de las columnas
  $sheet->setCellValue('A1', 'Nombre');
  $sheet->setCellValue('B1', 'Email');
  $sheet->setCellValue('C1', 'Teléfono');
  $sheet->setCellValue('D1', 'Localidad');
  $sheet->setCellValue('E1', 'Punto de Retiro');
  $sheet->setCellValue('F1', 'Categoría');
  $sheet->setCellValue('G1', 'Fecha de Creación');

  // Datos del contacto
  $nombre = $Nombre; // Reemplaza con el valor real
  $email = $Email; // Reemplaza con el valor real
  $telefono = $Telefono; // Reemplaza con el valor real
  $localidad = $Localidad; // Reemplaza con el valor real
  $puntoRetiro = $PuntoRetiro; // Reemplaza con el valor real

  // Insertar datos en la fila 2
  $sheet->setCellValue('A2', $nombre);
  $sheet->setCellValue('B2', $email);
  $sheet->setCellValue('C2', $telefono);
  $sheet->setCellValue('D2', $localidad);
  $sheet->setCellValue('E2', $puntoRetiro);
  $sheet->setCellValue('F2', 'A Revisar');
  $sheet->setCellValue('G2', date("Y-m-d"));

  // Guardar el archivo Excel
  $writer = new Xlsx($spreadsheet);
  $fileName = 'DatosPersonalesCotizador.xlsx';
  $writer->save($fileName);

  echo "Archivo Excel generado exitosamente: $fileName";

} catch (Exception $e) {
  echo 'Se produjo una excepción: ', $e->getMessage();
  exit;
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
