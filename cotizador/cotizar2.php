<?php 
session_start();
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('admin/app/database.php');

if(!isset($_SESSION["disponibles"])){

  header("Location: formulario.php");
  die();
}

$disponibles=$_SESSION["disponibles"];

$_SESSION["tiempo"]=time();



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


<script> (function(i,s,o,g,r,a,m){ i['GoogleAnalyticsObject']=r; i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)}, i[r].l=1*new Date(); a=s.createElement(o),m=s.getElementsByTagName(o)[0]; a.async=1; a.src=g; m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-127899392-1', 'auto'); ga('send', 'pageview'); </script> 
<!-- Google Tag Manager --> 
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PKGSW3C');</script> 
<!-- End Google Tag Manager -->
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
      <div class="col-md-2 pull-left"><a class="logo-light" href="index.html"><img alt="" src="img/logo1.png" class="logo" /></a><a class="logo-dark" href="index.html"><img alt="" src="img/logo1.png" class="logo" /></a></div>
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
          <li><a href="index.html">Inicio</a></li>
          <li>Autos disponibles</li>
        </ul>
        <!-- end page title --> 
      </div>
     
    </div>
  </div>
</section>
<!-- about section --> 

<!-- content section -->

<section class="wow fadeIn xs-no-padding-bottom bg-gray">

 
<?php if (isset($_SESSION["disponibles"])) { foreach($disponibles as $disponible){ ?>
        
        <div class="container">
        <div class="row padding-three border-top border-left2 border-right bg-white"> 
          <!-- left part -->
          <div class="col-md-5 col-sm-6"> 
            <!-- jobs opening position -->
            <div class="clearfix"> 
              <!-- product images -->
              <div class="col-md-7 col-sm-12 col-xs-6 zoom-gallery sm-margin-bottom-ten"> <a href="<?php echo $disponible["IMAGEN"] ?>"><img src="<?php echo $disponible["IMAGEN"] ?>" alt=""></a>
                <div class="products-thumb text-center"> <a href="<?php echo $disponible["MINIATURA_1"] ?>"><img src="<?php echo $disponible["MINIATURA_2"] ?>" alt=""></a> <a href="<?php echo $disponible["MINIATURA_1"] ?>"><img src="<?php echo $disponible["MINIATURA_2"] ?>" alt=""></a> </div>
              </div>
              <!-- end product images -->
              <div class="col-md-5 col-sm-12 margen2"> 
                
                <!-- product name --> 
                <span class="product-name-details text-uppercase font-weight-600 letter-spacing-2 black-text"><?php echo $disponible["MARCA"]."<br>".$disponible["MODELO"]?> </span> 
                <!-- end product name --> 
                <!-- product stock -->
           
                <!-- end product stock -->
            
                <p class=""></p>
              
                  <div class="col-lg-3 col-md-5 col-xs-2 no-padding-left text-center"> <img src="https://www.3wheels.com.ar/cotizador/img/ico-maleta-grande.png" alt="Maletas Grandes"><br>1</div>
                    <div class="col-lg-3 col-md-5 col-xs-2 no-padding-left text-center"> <img src="https://www.3wheels.com.ar/cotizador/img/ico-maleta-chica.png" alt="Maletas Chicas"><br>
                1</div>
                    <div class="col-lg-3 col-md-5 col-xs-2 no-padding-left text-center"> <img src="https://www.3wheels.com.ar/cotizador/img/ico-AC.png" alt="Aire Acondicionado"><br>
                SI</div>
                    <div class="col-lg-3 col-md-5 col-xs-2 no-padding-left text-center"> <img src="https://www.3wheels.com.ar/cotizador/img/ico-cambios.png" alt="Caja de Cambios"><br>
                MT</div>
                 
                  
             
            
              </div>
            </div>
            <!-- end jobs opening position --> 
            
          </div>
          <!-- end left part --> 
          <!-- right part -->
          <div class="col-md-7 col-sm-6 border-left2"> 
            <!-- jobs opening position -->
            <div class="clearfix">
              <div class="col-md-7 col-sm-12 position-relative"> 
                <!-- product rating -->
                 <div class="row margin-bottom-seven">
                     <div class="col-md-4 col-xs-4">
                    <img src="https://www.3wheels.com.ar/cotizador/img/logo-cotizador.png" alt="" width="75" height="46">
                    
                     </div>
                  
                  <div class="col-md-8 col-xs-8">
                      
                      
                      <div class="col-md-2 rating no-margin no-margin-top">
                    
                    <h2 class="font-weight-600">4.2</h2>
                     </div>
                  
                    <div class="col-md-7 col-sm-12 position-relative">
                    <i class="fa fa-star pink-text"></i><i class="fa fa-star pink-text"></i><i class="fa fa-star pink-text"></i><i class="fa fa-star pink-text"></i><i class="fa fa-star-o pink-text"></i><br><span class="rating-text text-uppercase">excelente</span>
                    
                     </div>	 </div>	  
            
                 </div>
                <!-- end product rating -->
               
                
                  
                   <p class="margen3"></p>
                  <div class="row margin-top margin-bottom-seven">
                    <div class="col-md-12 no-margin-left no-margin-right">
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
              
                <div class="col-md-5 col-sm-12 text-right">
                    
                    <div class="row margin-bottom-seven">
                    <div class="col-md-12">
                        <p class="font-weight-400 no-margin pink-text">Precio total c/<strong>tarjeta de crédito</strong></p>
                        <h2 class="font-weight-600"><?php 
                        
                            $precioTotal="Consultar";

                            if(floatval($disponible["PRECIO"])>0){

                              echo "$ ".number_format($disponible["PRECIO"], 0, ',', '.') ;

                            }else{

                                echo $precioTotal;

                            }
                        
                          
                           
                           
                           ?></h2>
        
                        <span class="text-xs black-text">(hasta 6 cuotas sin interés)</span>
                    
                     </div>		  
            
                 </div>
                    
                    
                    
                    <div class="row margin-bottom-three">
                    <div class="col-md-12">
                      <span class="onsale onsale-style-2" style="margin-left: -50px;">15% DTO</span>	
                        <p class="font-weight-400 no-margin pink-text">Precio total <strong>contado efectivo</strong></p>
                        <h2 class="font-weight-600"><?php 
                        
                        if(floatval($disponible["PRECIO"])>0){

                          echo "$ ".number_format(  $disponible["PRECIO"] *0.85, 0, ',', '.') ;

                        }else{

                            echo $precioTotal;

                        }
                        
                        ?></h2>
                        
                        <span class="text-xs black-text">abona al retirar el vehículo</span>
                    
                     </div>		  
            
                 </div>
                    <div class="row margin-bottom-seven">
                    <div class="col-md-12">

                    <form method="POST" name="frmDisponibles" action="confirmar.php">
                        <a href="javascript:continuar('<?php echo $disponible["MODELO"]?>')" class="btn btn-round btn-black btn-small margin-four no-margin-bottom">Seleccionar</a>
                        <input type="hidden" value="" name="modelo" >
                        </form>
                     </div>		  
                 </div>
              </div>
            </div>
            <!-- end jobs opening position --> 
            
          </div>
          <!-- end right part --> 
        </div>
        
          <div class="row padding-one border-bottom border-left2 border-right bg-white">
                        <!-- related products slider -->
                      <div class="col-md-11 col-sm-8 dividers-header double-line text-left">
                            <div class="subheader bg-white">
                                <p class="letter-spacing-1 font-weight-600 margin-two pink-text text-uppercase">Incluído en el Precio</p>
                            </div>
                        </div>
              <div id="shop-products1" class="owl-carousel owl-theme dark-pagination owl-no-pagination owl-prev-next-simple " style="opacity: 1; display: block;">
                                <!-- shop item -->
                                <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 3940px; left: 0px; display: block;"><div class="owl-item" style="width: 394px;"><div class="item">
                                    <div class="home-product text-center position-relative overflow-hidden">
                               <img src="https://www.3wheels.com.ar/cotizador/img/ico-adicional.png" alt="">
                                        <span class="product-name">Conductor adicional <strong>sin cargo</strong></span>
                                    </div>
                                </div></div><div class="owl-item" style="width: 394px;"><div class="item">
                                    <div class="home-product text-center position-relative overflow-hidden">
                               <img src="https://www.3wheels.com.ar/cotizador/img/ico-seguro-vehiculo.png" alt="">
                                        <span class="product-name">seguro automovil <strong>incluido</strong></span>
                                    </div>
                                </div></div><div class="owl-item" style="width: 394px;"><div class="item">
                                    <div class="home-product text-center position-relative overflow-hidden">
                               <img src="https://www.3wheels.com.ar/cotizador/img/ico-terceror.png" alt="">
                                        <span class="product-name">seguro a terceros <strong>incluido</strong></span>
                                    </div>
                                </div></div><div class="owl-item" style="width: 394px;"><div class="item">
                                    <div class="home-product text-center position-relative overflow-hidden">
                               <img src="https://www.3wheels.com.ar/cotizador/img/ico-personas-transportadas.png" alt="">
                                        <span class="product-name">seguro personas transportadas <strong>incluido</strong></span>
                                    </div>
                                </div></div><div class="owl-item" style="width: 394px;"><div class="item">
                                    <div class="home-product text-center position-relative overflow-hidden">
                               <img src="https://www.3wheels.com.ar/cotizador/img/ico-km-ilimitado.png" alt="">
                                        <span class="product-name">kilometraje  <strong>ilimitado</strong></span>
                                    </div>
                                </div></div></div></div>
                              
                                
                                
                        <div class="owl-controls clickable"><div class="owl-pagination"><div class="owl-page active"><span class=""></span></div><div class="owl-page"><span class=""></span></div></div><div class="owl-buttons"><div class="owl-prev"><i class="fa fa-angle-left"></i></div><div class="owl-next"><i class="fa fa-angle-right"></i></div></div></div></div>
                        <!-- end related products slider -->
                    </div>
      </div>
        
        <br><br>
        
        <?php }; };?>
      




        </section>
	
	
	
	
<!-- end content section --> 

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
        <div class="col-md-6 col-sm-6 col-xs-12 footer-logo text-right xs-text-center"> <a href="index.html"><img src="img/logo-pie.png" alt="" /></a> </div>
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
<!-- GetButton.io widget -->
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



    function continuar(modelo)
       {
         document.forms.frmDisponibles.modelo.value=modelo;
         document.forms.frmDisponibles.submit();
       }
</script>
<!-- /GetButton.io widget -->
</body>
</html>