  <?php
  session_start();
  ob_start();
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  include('admin/app/database.php');

  if (!isset($_SESSION["disponibles"])) {

    header("Location: index.php");
    die();
  }

  $disponibles = $_SESSION["disponibles"];

  $_SESSION["tiempo"] = time();



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

    <style>
      .mt-1 {
        margin-top: 10px;
      }
      .on-sale-flex {
        background: #5aa5e6;
      color: #fff;
      font-size: 12px;
      text-transform: uppercase;
      font-weight: 600;
      padding: 2px 12px;
      margin-right: 10px;
      }
      @media (max-width: 768px) {
        .text-md-right {
          text-align: right;
        }
     
      }
      .text-alerta{ 
        font-size: 20px !important;
      }
      .icon-alerta{ 
        font-size: 60px;
      }

      @media (max-width: 900px) {
        .text-alerta {
          font-size: 14px !important;
        }
        .icon-alerta{ 
        font-size: 50px;
      }

      }
    </style>

    <script>
      (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o), m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
      ga('create', 'UA-127899392-1', 'auto');
      ga('send', 'pageview');
    </script>
    <!-- Google Tag Manager -->
    <script>
      (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
          'gtm.start': new Date().getTime(),
          event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s),
          dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', 'GTM-PKGSW3C');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-802895878"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'AW-802895878');
    </script>
  </head>

  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
      <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PKGSW3C" height="0" width="0" style="display:none;visibility:hidden"></iframe>
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
                <li class="dropdown panel"><a href="index.php">Inicio </a> </li>
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
    <section class="page-title parallax3 parallax-fix page-title-large page-title-shop">
      <div class="opacity-light bg-dark-gray"></div>
      <img class="parallax-background-img" src="img/RentaCarPilar.jpg" alt="" />
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 wow fadeIn margin-three breadcrumb text-uppercase">
            <h1 class="white-text">COTIZACIÓN ONLINE</h1>
            <ul>
              <li><a href="index.php">Inicio</a></li>
              <li>Autos disponibles</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  <!-- about section -->
<!-- Seccion ultimos disponibles -->
<?php if (isset($_SESSION["disponibles"]) && count($_SESSION["disponibles"]) > 0) { ?>
<section class="page-title parallax3 parallax-fix  page-title-shop" style="padding: 10px;">
      <div class="opacity-light bg-dark-gray"></div>
      <!-- <img class="parallax-background-img" src="img/RentaCarPilar.jpg" alt="" /> -->
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 wow fadeIn margin-three breadcrumb text-uppercase">
            <h3 class="white-text text-center text-alerta">Apúrese a reservar! <br><br> Quedan pocas unidades disponibles para las fechas seleccionadas.</h3>

          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- content section -->

    <section class="wow fadeIn xs-no-padding-bottom bg-gray xs-no-padding-top">
      <div class="container">
        <div class="row padding-two">
          <div class="col-12">
            <a href="javascript:window.history.back();" class="btn btn-primary btn-round btn-small margin-four no-margin-bottom btn-volver">
              <i class="fa fa-angle-left mr-2"></i>
              Volver</a>
          </div>
        </div>
      </div>

      <?php if (isset($_SESSION["disponibles"]) && count($_SESSION["disponibles"]) > 0) {
        // var_dump($disponibles);
        // die();
        // floatval($disponible["PRECIO"])
        // Custom sorting function to compare "PRECIO" property of objects
        function sortByPrecio($a, $b)
        {
          return $a["PRECIO"] - $b["PRECIO"];
        }

        // Sort the array using the custom sorting function
        usort($disponibles, 'sortByPrecio');
        $contador = 0;
        foreach ($disponibles as $disponible) {

          $contador++;
      ?>

          <div class="container">
            <div class="row padding-three border-top border-left2 border-right bg-white">
              <!-- left part -->
              <div class="col-md-5 col-sm-6">
                <!-- jobs opening position -->
                <div class="clearfix">
                  <!-- product images -->
                  <div class="ocultar-div col-md-7 col-sm-12 col-xs-12 zoom-gallery zoom-gallery-<?php echo $contador; ?> sm-margin-bottom-ten"> <a class="d-md-flex justify-md-content-center w-100" href="<?php echo $disponible["IMAGEN"] ?>"><img src="<?php echo $disponible["IMAGEN"] ?>" alt=""></a>
                    <div class="products-thumb text-center">
                      <a class="ocul" href="<?php echo $disponible["MINIATURA_1"] ?>"><img src="<?php echo $disponible["MINIATURA_1"] ?>" alt=""></a>
                      <a class="ocul" href="<?php echo $disponible["MINIATURA_2"] ?>"><img src="<?php echo $disponible["MINIATURA_2"] ?>" alt=""></a>
                    </div>
            
                  <?php if (floatval($disponible["PRECIO_PROMO"]) > 0 && floatval($disponible["PRECIO_PROMO"]) < floatval($disponible["PRECIO"])) { ?>
                    <div style="position: absolute; top: 10px; right: 10px; background-color: red; color: white; padding: 1px 5px; font-weight: bold; font-size: 12px">
                    OFERTA!
                    </div>
                  <?php } ?>
                  </div>
                  <div class="col-12 no-ocultar-div">
                    <div class=" owl-theme dark-pagination owl-no-pagination owl-prev-next-simple owl-carousel2" style="height: auto;">

                      <div class="d-flex justify-content-center">
                        <div class="previous-btn"><i class="fa fa-angle-left"></i></div>
                        <img src="<?php echo $disponible["IMAGEN"] ?>" class="img-fluid" alt="">
                        <div class="next-btn"><i class="fa fa-angle-right"></i></div>
                      </div>
                      <div class="d-flex justify-content-center">
                        <div class="previous-btn"><i class="fa fa-angle-left"></i></div>
                        <img src="<?php echo $disponible["MINIATURA_1"] ?>" class="img-fluid" alt="">
                        <div class="next-btn"><i class="fa fa-angle-right"></i></div>
                      </div>
                      <div class="d-flex justify-content-center">
                        <div class="previous-btn"><i class="fa fa-angle-left"></i></div>
                        <img src="<?php echo $disponible["MINIATURA_2"] ?>" class="img-fluid" alt="">
                        <div class="next-btn"><i class="fa fa-angle-right"></i></div>
                      </div>

                    </div>
                  </div>
                  <!-- end product images -->
                  <div class="col-md-5 col-sm-12 col-xs-12 margen2">
                    <!-- product name -->
                    <div class="clearfix">
                      <span class="product-name-details text-uppercase font-weight-600 letter-spacing-2 black-text">
                        <?php echo $disponible["MARCA"] . "<br>" . $disponible["MODELO"] ?>
                      </span>
                      <!-- end product name -->
                      <!-- end product stock -->
                      <p class=""></p>

                      <div class="col-lg-3 col-md-5 col-xs-2 no-padding-left text-center"> <img src="img/ico-maleta-grande.png" alt="Maletas Grandes" /><br>
                        <?php

                        switch ($disponible["MODELO"]) {
                          case "Prisma":
                            echo "2";
                            break;

                          case "Cronos":
                            echo "2";
                            break;

                          case "H1 Premium":
                            echo "6";
                            break;

                            case "Spin":
                              echo "3";
                              break;

                          default:
                            echo "1";;
                            break;
                        }
                        ?>


                      </div>
                      <div class="col-lg-3 col-md-5 col-xs-2 no-padding-left text-center"> <img src="img/ico-maleta-chica.png" alt="Maletas Chicas" /><br>
                        <?php

                        switch ($disponible["MODELO"]) {
                          case "Kwid":
                            echo "1";
                            break;

                          case "H1 Premium":
                            echo "4";
                            break;

                            case "Spin":
                              echo "3";
                              break;
                          

                          default:
                            echo "2";;
                            break;
                        }
                        ?>



                      </div>
                      <div class="col-lg-3 col-md-5 col-xs-2 no-padding-left text-center"> <img src="img/ico-AC.png" alt="Aire Acondicionado" /><br>
                        SI</div>
                      <div class="col-lg-3 col-md-5 col-xs-2 no-padding-left text-center"> <img src="img/ico-cambios.png" alt="Caja de Cambios" /><br>
                        <?php echo ($disponible["MODELO"] == 'Spin' || $disponible["MODELO"] == 'H1 Premium') ? 'AT' : 'MT'; ?></div>

                        <?php
                        if($disponible["MODELO"] == 'H1 Premium' || $disponible["MODELO"] == 'Spin'){
                        ?>

                    


                        <div class="col-lg-3 mt-1 col-md-5 col-xs-2 no-padding-left text-center"> 
                          <img width="20" src="img/people.png" alt="capacidad" />
                        <br>
                        <?php echo ($disponible["MODELO"] == 'Spin') ? '7' : '12'; ?>
                        </div>
                        <div class="col-lg-3 mt-1 col-md-5 col-xs-2 no-padding-left text-center"> 
                          <img width="20" src="img/airbag.png" alt="airbag" />
                        <br>
                        SI
                        </div>

                        <div class="col-lg-3 mt-1 col-md-5 col-xs-2 no-padding-left text-center"> 
                          <img width="20" src="img/car-steering-wheel.png" alt="direccion" />
                        <br>
                        HD
                        </div>

                        <div class="col-lg-3 mt-1 col-md-5 col-xs-2 no-padding-left text-center"> 
                          <img width="20" src="img/car.png" alt="abs" />
                        <br>
                        SI
                        </div>


                        <?php
                  
                        }
                        ?>


                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-7 col-sm-6 border-left2">
                <div class="clearfix">
                  <div class="col-md-7 col-sm-12 position-relative">
                    <div class="row margin-bottom-seven d-md-none">

                      <div class="col-md-12 no-margin-left no-margin-right">
                        <div class="img-container">
                          <img src="https://www.3wheels.com.ar/cotizador/img/logo1.png" alt="">
                        </div>
                      </div>
                    </div>

                    <p class="margen3"></p>
                    <div class="row margin-top margin-bottom-seven">
                      <div class="col-md-12 no-margin-left no-margin-right">
                        <a class="btn-primary btn btn-very-small button btn-round xs-margin-bottom-five" href="#">Mejor Precio</a>
                        <a class="btn-success btn btn-very-small button btn-round xs-margin-bottom-five" href="#">Oferta de hoy</a>
                        <a class="btn-danger btn btn-very-small button btn-round sm-margin-top-three xs-no-margin" href="#">Imperdible</a>
                      </div>
                    </div>
                    <div class="row margin-top d-md-none">
                      <div class="col-md-10 text-xs">
                        <!-- <p style="color:#2142a0"><strong>¿Tenés dudas?</strong> Hacé <strong>Click</strong> en el logo de Whatsapp para comunicarte con nosotros. </p> -->
                        <p style="color:#2142a0"><strong> Abona al retirar el vehículo</strong> </p>
                      
                      </div>
                    </div>
                    <div class="row margin-top margin-bottom-seven">
                      <div class="col-md-12 text-md-right" style="display : flex; flex-direction : column;" >
                        <p class="font-weight-400 no-margin pink-text">Cantidad de días seleccionados:

                        </p>
                        <h2 class="font-weight-600" style="margin-left : 7px;">
                          <?php
                          if (isset($_SESSION["cantidad"])) {
                            echo $_SESSION["cantidad"];
                          }
                          ?>
                        </h2>
                      </div>
                      
                    </div>
                  </div>
                  <div class="col-md-5 col-sm-12 text-right">
                    <div class="row margin-bottom-seven">
                      <div class="col-md-12 text-md-left d-flex justify-content-end flex-column align-items-end" style="flex-direction: column; align-items: end;">
                        <p class="font-weight-400 no-margin pink-text text-right">Precio total c/<strong>tarjeta de crédito</strong></p>
                          <div class="d-flex flex-row justify-content-end">

                          <h2 class="font-weight-600" <?php if (floatval($disponible["PRECIO_PROMO"]) > 0 && floatval($disponible["PRECIO_PROMO"]) < floatval($disponible["PRECIO"])) echo 'style="text-decoration: line-through; font-size: 18px; margin-right: 20px;"'; ?>><?php

                                        $precioTotal = "Consultar";
                                        if (floatval($disponible["PRECIO"]) > 0) {
                                        echo "$ " . number_format($disponible["PRECIO"], 0, ',', '.');
                                        } else if(floatval($disponible["PRECIO"]) <= 0 && floatval($disponible["PRECIO_PROMO"]) <= 0){ 
                                        echo $precioTotal;
                                        }
                                        
                                        ?></h2>
                                        <h2 class="font-weight-600"> 
                                        <?php
                                        if (floatval($disponible["PRECIO_PROMO"]) > 0 && floatval($disponible["PRECIO_PROMO"]) < floatval($disponible["PRECIO"])) {
                                        echo "$ " . number_format($disponible["PRECIO_PROMO"], 0, ',', '.');
                                        }
                                        ?>
                                        </h2>
                                        </div>

                        </div>
                    </div>
                    
                      <div class="row margin-bottom-three">
                      <div class="col-md-12 text-md-left">
                
                      
                        <p class="font-weight-400 no-margin pink-text text-right">Precio total 
                        <strong>contado efectivo</strong></p>
                        <div class="d-flex justify-content-end align-items-center" style="justify-content: end;
      margin-top: 10px;
      margin-bottom: 40px;
  ">
                        <span class='on-sale-flex  ' >15% DTO</span>

                          
                          <h2 class="font-weight-600"><?php
    
                                        if (floatval($disponible["PRECIO_PROMO"]) > 0 && floatval($disponible["PRECIO_PROMO"]) < floatval($disponible["PRECIO"])) {
                                          echo "$ " . number_format($disponible["PRECIO_PROMO"] * 0.85, 0, ',', '.');
                                        } elseif (floatval($disponible["PRECIO"]) > 0) {
                                          echo "$ " . number_format($disponible["PRECIO"] * 0.85, 0, ',', '.');
                                        } else {
                                          echo $precioTotal;
                                        }
    
                                        ?>
    
                          </h2>
                        </div>
                      </div>
                      </div>
                
                        
                    <div class="row margin-bottom-seven margin-md-3">
                      <div class="col-md-12 text-md-left">
                        <form class="w-md-100" method="POST" name="frmDisponibles" action="confirmar">
                          <a href="javascript:continuar('<?php echo $disponible["MODELO"] ?>')" class="btn btn-round btn-black btn-small margin-four no-margin-bottom w-md-100 text-md-center">Seleccionar</a>
                          <input type="hidden" value="" name="modelo">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row padding-one border-bottom border-left2 border-right bg-white">
              <div class="col-md-11 col-sm-8 dividers-header double-line text-left">
                <div class="subheader bg-white">
                  <p class="letter-spacing-1 font-weight-600 margin-two pink-text text-uppercase">Incluído en el Precio</p>
                </div>
              </div>
              <div class="owl-carousel ocultar-div owl-theme dark-pagination owl-no-pagination owl-prev-next-simple " style="opacity: 1; display: block;">
                <div class="owl-wrapper-outer">
                  <div class="owl-wrapper" style="width: 3940px; left: 0px; display: block;">
                    <div class="owl-item" style="width: 394px;">
                      <div class="item">
                        <div class="home-product text-center position-relative overflow-hidden">
                          <img src="https://www.3wheels.com.ar/cotizador/img/ico-adicional.png" alt="">
                          <span class="product-name">Conductor adicional <strong>sin cargo</strong></span>
                        </div>
                      </div>
                    </div>
                    <div class="owl-item" style="width: 394px;">
                      <div class="item">
                        <div class="home-product text-center position-relative overflow-hidden">
                          <img src="https://www.3wheels.com.ar/cotizador/img/ico-seguro-vehiculo.png" alt="">

                          <span class="product-name">seguro automovil <strong>incluido</strong></span>
                        </div>
                      </div>
                    </div>
                    <div class="owl-item" style="width: 394px;">
                      <div class="item">
                        <div class="home-product text-center position-relative overflow-hidden">
                          <img src="https://www.3wheels.com.ar/cotizador/img/ico-terceror.png" alt="">
                          <span class="product-name">seguro a terceros <strong>incluido</strong></span>
                        </div>
                      </div>
                    </div>
                    <div class="owl-item" style="width: 394px;">
                      <div class="item">
                        <div class="home-product text-center position-relative overflow-hidden">
                          <img src="https://www.3wheels.com.ar/cotizador/img/ico-personas-transportadas.png" alt="">
                          <span class="product-name">seguro personas transportadas <strong>incluido</strong></span>
                        </div>
                      </div>
                    </div>
                    <div class="owl-item" style="width: 394px;">
                      <div class="item">
                        <div class="home-product text-center position-relative overflow-hidden">
                          <img src="https://www.3wheels.com.ar/cotizador/img/ico-km-ilimitado.png" alt="">
                          <span class="product-name">kilometraje <strong>ilimitado</strong></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="owl-carousel2 no-ocultar-div owl-theme dark-pagination owl-no-pagination owl-prev-next-simple " style="opacity: 1; display: block;">
                <div class="home-product text-center position-relative overflow-hidden">
                  <div class="owl-prev"><i class="fa fa-angle-left"></i></div>
                  <img src="https://www.3wheels.com.ar/cotizador/img/ico-adicional.png" alt="">
                  <span class="product-name">Conductor adicional <strong>sin cargo</strong></span>
                  <div class="owl-next"><i class="fa fa-angle-right"></i></div>
                </div>
                <div class="home-product text-center position-relative overflow-hidden">
                  <div class="owl-prev"><i class="fa fa-angle-left"></i></div>
                  <img src="https://www.3wheels.com.ar/cotizador/img/ico-seguro-vehiculo.png" alt="">
                  <span class="product-name">seguro automovil <strong>incluido</strong></span>
                  <div class="owl-next"><i class="fa fa-angle-right"></i></div>
                </div>


                <div class="home-product text-center position-relative overflow-hidden">
                  <div class="owl-prev"><i class="fa fa-angle-left"></i></div>
                  <img src="https://www.3wheels.com.ar/cotizador/img/ico-terceror.png" alt="">
                  <span class="product-name">seguro a terceros <strong>incluido</strong></span>
                  <div class="owl-next"><i class="fa fa-angle-right"></i></div>
                </div>


                <div class="home-product text-center position-relative overflow-hidden">
                  <div class="owl-prev"><i class="fa fa-angle-left"></i></div>
                  <img src="https://www.3wheels.com.ar/cotizador/img/ico-personas-transportadas.png" alt="">
                  <span class="product-name">seguro personas transportadas <strong>incluido</strong></span>
                  <div class="owl-next"><i class="fa fa-angle-right"></i></div>
                </div>

                <div class="home-product text-center position-relative overflow-hidden">
                  <div class="owl-prev"><i class="fa fa-angle-left"></i></div>
                  <img src="https://www.3wheels.com.ar/cotizador/img/ico-km-ilimitado.png" alt="">
                  <span class="product-name">kilometraje <strong>ilimitado</strong></span>
                  <div class="owl-next"><i class="fa fa-angle-right"></i></div>

                </div>



              </div>


              <!-- 
                <div class="owl-controls clickable">
                  <div class="owl-pagination">
                    <div class="owl-page active"><span class=""></span></div>
                    <div class="owl-page"><span class=""></span></div>
                  </div>

                  <div class="owl-buttons">
                    <div class="owl-prev"><i class="fa fa-angle-left"></i></div>
                    <div class="owl-next"><i class="fa fa-angle-right"></i></div>
                  </div>
                </div> -->

            </div>
            <!-- end related products slider -->
          </div>
          </div>

          <br><br>

      <?php };
      }; ?>
      <?php
      if (!isset($_SESSION["disponibles"]) || count($_SESSION["disponibles"]) <= 0) {    
      ?>
        <div class="p-5 px-0 text-center">
          <div class="p-5 alert alert-warning text-center" role="alert">
            <i class="fa fa-exclamation-triangle fa-3x mb-5 icon-alerta" style="margin-bottom: 50px; margin-top: 50px;" aria-hidden="true"></i>
            <h4 class="alert-heading mt-5 text-alerta" style="margin-bottom: 50px;">Lamentablemente ya no quedan unidades disponibles para las fechas seleccionadas.</h4>
          </div>
        </div>
      <?php
        }
      ?>



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
              <h6 class="black-text margin-two no-margin-bottom">R. Caamaño 1103, Villa Rosa, Buenos Aires.</h6>
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
    <script type="text/javascript" defer src="./js/owl.carousel.min.js"></script>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" defer src="js/main.js?v1"></script>

    <!-- GetButton.io widget -->
    <script type="text/javascript">
      (function() {
        var options = {
          whatsapp: "+5491122919281", // WhatsApp number
          call_to_action: "¿Tenés dudas? Comunicate con un asistente ahora.", // Call to action
          position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol,
          host = "getbutton.io",
          url = proto + "//static." + host;
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url + '/widget-send-button/js/init.js';
        s.onload = function() {
          WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
      })();



      function continuar(modelo) {
        document.forms.frmDisponibles.modelo.value = modelo;
        document.forms.frmDisponibles.submit();
      }
      window.addEventListener('wheel', {
        passive: false
      })
      $(document).ready(function() {
        $(".owl-carousel2").owlCarousel({
          loop: true
        });
      });
    </script>
    <!-- /GetButton.io widget -->
  </body>

  </html>