<?php 
session_start();
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('app/database.php');

if(!isset($_SESSION["disponibles"])){

  header("Location: formulario.php");
  die();
}

$disponibles=$_SESSION["disponibles"];

$_SESSION["tiempo"]=time();



?>



<html class=" js " lang="es" style="height: auto;"><head>
    <title>3Wheels | Rent a Car   <?php echo $_SESSION["LD"] ?></title>
    <meta name="keywords" content="alquiler, autos, renta, rent, car, pilar, zona norte, turismo, viajes, vacaciones, fatima, polo, golf,">
    <meta name="description" content="Alquiler de autos en Pilar, entrega a domicilio, seguro todo riesgo en todas las unidades.">
    <meta charset="utf-8">
    <meta name="author" content="NalandaDiseñoIntegral">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1">
    <!-- favicon -->
    <link rel="shortcut icon" href="https://www.3wheels.com.ar/cotizador/img/favicon.ico">
    <link rel="apple-touch-icon" href="https://www.3wheels.com.ar/cotizador/img/favicons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://www.3wheels.com.ar/cotizador/img/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="https://www.3wheels.com.ar/cotizador/img/favicons/apple-touch-icon-114x114.png">
    <!-- animation -->
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/animate.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/bootstrap.css">
    <!-- et line icon -->
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/et-line-icons.css">
    <!-- font-awesome icon -->
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/font-awesome.min.css">
    <!-- revolution slider -->
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/extralayers.css">
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/settings.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/magnific-popup.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/owl.carousel.css">
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/owl.transitions.css">
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/full-slider.css">
    <!-- text animation -->
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/text-effect.css">
    <!-- common -->
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/style.css">
    <!-- responsive -->
    <link rel="stylesheet" href="https://www.3wheels.com.ar/cotizador/css/responsive.css">
    <!--[if IE]>
                <link rel="stylesheet" href="css/style-ie.css" />
            <![endif]--> 
    <!--[if IE]>
                <script src="js/html5shiv.js"></script>
            <![endif]--> 
    
    

    <!-- End Google Tag Manager -->
    <style id="fit-vids-style">.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style><script src="chrome-extension://mooikfkahbdckldjjndioackbalphokd/assets/prompt.js"></script><style data-styled="active" data-styled-version="5.1.1"></style><!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-802895878"></script> 
<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-802895878'); </script> </head>
    <body class="">
    <!-- Google Tag Manager (noscript) -->
    <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PKGSW3C"
    height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) --> 
    
    <!-- navigation panel -->
    <nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav nav-border-bottom bg-white shrink-nav" role="navigation">
      <div class="container">
        <div class="row"> 
          <!-- logo -->
          <div class="col-md-2 pull-left"><a class="logo-light" href="https://www.3wheels.com.ar/cotizador/index.html"><img alt="" src="https://www.3wheels.com.ar/cotizador/img/logo1.png" class="logo"></a><a class="logo-dark" href="index.html"><img alt="" src="img/logo1.png" class="logo"></a></div>
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
                <li class="dropdown panel"><a href="index.html">Inicio </a> </li>
                <!-- end menu item --> 
                
                <!-- menu item -->
                <li class="dropdown panel simple-dropdown"><a href="#collapse7" class="dropdown-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-hover="dropdown">Cotizador <i class="fa fa-angle-down"></i></a> 
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
                <li class="dropdown panel"><a href="faq.html">FAQ </a> </li>
                <li class="dropdown panel"><a href="promos.html">Promos </a> </li>
                <li class="dropdown panel"><a href="aquiler-empresas.html">Alquiler a empresas </a> </li>
                <li class="dropdown panel"><a href="contacto.html">Contacto </a> </li>
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
    <section class="page-title parallax3 parallax-fix page-title-large page-title-shop" style="background: url(&quot;img/RentaCarPilar.jpg&quot;) 50% -32px;">
      <div class="opacity-light bg-dark-gray"></div>
      
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 wow fadeIn margin-three breadcrumb text-uppercase animated" style="visibility: visible; animation-name: fadeIn;"> 
            
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


  
    
    <section class="wow fadeIn xs-no-padding-bottom bg-gray animated" style="visibility: visible; animation-name: fadeIn;" id="mensaje">
     
        
 
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
                                <!-- end shop item -->
                                <!-- shop item -->
                                
                                <!-- end shop item -->
                  
                   <!-- shop item -->
                                
                                <!-- end shop item -->
                  
                   <!-- shop item -->
                                
                                <!-- end shop item -->
                  
                  <!-- shop item -->
                                
                                <!-- end shop item -->
                                
                                
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
              <h6 class="black-text margin-two no-margin-bottom"><a href="https://api.whatsapp.com/send?phone=5491122919281">+54 911 22919281</a></h6>
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
            <div class="col-md-6 col-sm-6 col-xs-12 copyright text-left letter-spacing-1 xs-text-center xs-margin-bottom-one"> © 2019 3wheels. Todos los derechos reservados.</div>
            <!-- end copyright --> 
            <!-- logo -->
            <div class="col-md-6 col-sm-6 col-xs-12 footer-logo text-right xs-text-center"> <a href="index.html"><img src="img/logo-pie.png" alt=""></a> </div>
            <!-- end logo --> 
          </div>
        </div>
      </div>
      <!-- scroll to top --> 
      <a href="javascript:;" class="scrollToTop" style="display: block;"><i class="fa fa-angle-up"></i></a> 
      <!-- scroll to top End... --> 
    </footer>
    <!-- end footer --> 
    <!-- javascript libraries --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/jquery.min.js"></script> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/modernizr.js"></script> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/bootstrap.js"></script> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/bootstrap-hover-dropdown.js"></script> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/jquery.easing.1.3.js"></script> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/skrollr.min.js"></script> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/smooth-scroll.js"></script> 
    <!-- animation --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/wow.min.js"></script> 
    <!-- page scroll --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/page-scroll.js"></script> 
    <!-- easy piechart--> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/jquery.easypiechart.js"></script> 
    <!-- parallax --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/jquery.parallax-1.1.3.js"></script> 
    <!--portfolio with shorting tab --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/jquery.isotope.min.js"></script> 
    <!-- owl slider  --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/owl.carousel.min.js"></script> 
    <!-- magnific popup  --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/jquery.magnific-popup.min.js"></script> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/popup-gallery.js"></script> 
    <!-- text effect  --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/text-effect.js"></script> 
    <!-- revolution slider  --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/jquery.tools.min.js"></script> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/jquery.revolution.js"></script> 
    <!-- counter  --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/counter.js"></script> 
    <!-- fit videos  --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/jquery.fitvids.js"></script> 
    <!-- imagesloaded  --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/imagesloaded.pkgd.min.js"></script> 
    <!-- setting --> 
    <script type="text/javascript" defer="" src="https://www.3wheels.com.ar/cotizador/js/main.js"></script> 
    <!-- GetButton.io widget -->
    <script type="text/javascript">

       function continuar(modelo)
       {
         document.forms.frmDisponibles.modelo.value=modelo;
         document.forms.frmDisponibles.submit();
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
    </script>
    <!-- /GetButton.io widget -->
    
    
    <div id="gb-widget-1866" style="bottom: 21px; right: 23px; opacity: 1; transition: opacity 0.5s ease 0s; box-sizing: border-box; direction: ltr; position: fixed !important; z-index: 16000160 !important;"><div><div class="q8c6tt-2 jxPOhn"><a href="https://wa.me/5491122919281" target="_blank" class="sc-1s18q3d-1 sc-8eqc3y-1 dxiAcZ"><div class="sc-8eqc3y-0 fXBuHm">¿Tenés dudas? Comunicate con un asistente ahora.</div></a><a href="https://wa.me/5491122919281" target="_blank" color="#4dc247" id="" class="q8c6tt-0 jlzTty"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="width: 100%; height: 100%; fill: rgb(255, 255, 255); stroke: none;"><path d="M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z"></path></svg></a></div><a type="link" href="http://getbutton.io/?utm_campaign=multy_widget&amp;utm_medium=widget&amp;utm_source=www.3wheels.com.ar" class="sc-7dvmpp-1 dfBDQI">GetButton</a></div></div></body><svg><rect width="100" height="50" x="100"></rect></svg></html>