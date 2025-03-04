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




?>


<!doctype html>
<html class="no-js" lang="es">

<head>
  <title>3Wheels | Rent a Car</title>
  <meta name="keywords" content="alquiler de autos para empresas, renta de autos a empresas,alquiler vehiculos, Alquiler autos en Nordelta, Alquiler autos Martínez, Alquiler autos en aeroparque, alquiler autos en tigre, alquiler autos en pilar, alquiler autos en san isidro, alquiler autos en capital federal, alquiler de autos zona norte, alquiler de autos, Alquiler de autos en buenos aires, rent a car, alquiler de vehículos, rentas de carros, renta de vehiculos, renta de autos en buenos aires">
  <meta name="description" content="Alquiler de autos en Buenos Aires, entrega a domicilio, seguro todo riesgo en todas las unidades.">
  <meta charset="utf-8">
  <meta name="author" content="NalandaDiseñoIntegral">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="apple-touch-icon" href="img/favicons/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.png">
  <link rel="stylesheet" href="css/animate.css" />
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/et-line-icons.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/extralayers.css" />
  <link rel="stylesheet" href="css/settings.css" />
  <link rel="stylesheet" href="css/magnific-popup.css" />
  <link rel="stylesheet" href="css/owl.carousel.css" />
  <link rel="stylesheet" href="css/owl.transitions.css" />
  <link rel="stylesheet" href="css/full-slider.css" />
  <link rel="stylesheet" href="css/text-effect.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
  <script src='https://www.google.com/recaptcha/api.js' async defer></script>
  <script type="text/javascript" language="javascript" defer src="dataCotizar.js"></script>

  <script type="text/javascript" language="javascript" defer src="dataPopup.js"></script>

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
    })(window, document, 'script', 'dataLayer', 'GTM-WP4H8CS');
  </script>
  <!-- End Google Tag Manager -->

</head>

<body>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WP4H8CS"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav nav-white nav-border-bottom" role="navigation">
    <div class="container">
      <div class="row">
        <div class="col-md-2 pull-left"><a class="logo-light" href="index.php"><img alt="" src="img/logo-pie.png" class="logo" /></a><a class="logo-dark" href="index.php"><img alt="" src="img/logo1.png" class="logo" /></a></div>
        <div class="navbar-header col-sm-10 col-xs-2 pull-right">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="col-md-10 accordion-menu text-right">
          <div class="navbar-collapse collapse">
            <ul id="accordion" class="nav navbar-nav navbar-right panel-group">
              <li class="dropdown panel"><a href="index.php">Inicio </a> </li>
              <li class="dropdown panel simple-dropdown"><a href="#collapse7" class="dropdown-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-hover="dropdown">Flota <i class="fa fa-angle-down"></i></a>
                <ul id="collapse7" class="dropdown-menu panel-collapse collapse" role="menu">
                  <li><a href="categoria-a.html">Categoria A</a></li>
                  <li><a href="categoria-b.html">Categoria B</a></li>
                  <li><a href="categoria-c.html">Categoria C</a></li>
                  <li><a href="categoria-d.html">Categoria D</a></li>

                </ul>
              </li>
              <li class="dropdown panel"><a href="faq.html">FAQ </a> </li>
              <li class="dropdown panel"><a href="promos.html">Promos </a> </li>
              <li class="dropdown panel"><a href="aquiler-empresas.html">Alquiler a empresas </a> </li>
              <li class="dropdown panel"><a href="contacto.html">Contacto </a> </li>
              <div class="top-cart"> <a href="tel://5491122919281" style="font-size:20px"> <i class="fa fa-phone"></i> </a> <a href="https://api.whatsapp.com/send?phone=5491122919281" style="font-size:20px; color:#92bee2"> <i class="fa fa-whatsapp"></i> +54 911 22919281 </a> </div>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <section class="parallax1 parallax-fix full-screen no-padding">
    <div class="slider-overlay bg-slider"></div>
    <img class="parallax-background-img" src="img/kwid-journey.jpg" alt="" />
    <div class="container full-screen position-relative">
      <div class="slider-typography ocultar-div">
        <div class="slider-text-middle-main">
          <div class="slider-text-middle slider-text-middle2"> <span class="cd-headline slide animation2 white-text text-uppercase"> <span class="cd-words-wrapper text-left"> <b class="is-visible">Alquiler de vehículos <br>
                  en Bs. As.</b> <b>Un Servicio de excelencia,<br>
                  Entrega a domicilio</b> <b>Automóviles nuevos<br>
                  Cotizá online</b> </span> </span><br>
            <br>
            <a href="contacto.html" class="largeredbtn inner-link">Contactanos</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xs-12 about-tab-right pull-right">
        <!-- <div class="col-md-12 col-xs-12 cotizador">
          <div class="col-md-5 col-xs-12"> <a href="aquiler-empresas.html" class="highlight-button-dark btn btn-small button xs-margin-bottom-five">OFERTA EMPRESAS</a></div>
          <div class="col-md-7 col-xs-12 padding-one"> <span class="font-weight-700 black-text" style="font-size:13px"><a href="aquiler-empresas.html" style="color:#333">Alquileres de 1 mes o más click aquí ></a></span></div>
        </div> -->
        <p class="text-med margin-one margin-bottom white-text"> <strong>COTIZAR</strong></p>
        <div class="separator-line bg-yellow no-margin-lr margin-two"></div>
        <div>
          <div class="tab-style1 white-text">
            <!-- tab content section -->
            <div class="tab-content">
              <!-- tab content -->
              <div class="tab-pane med-text fade in active" id="tab_sec1">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                  <form method="post" name="formularioCotizar" id="formularioCotizar" action="predisponible.php" onsubmit="checkForm(event, this);">
                      <div class="margin-one" style="color:#5aa5e6"> <span class="margin-one xs-margin-bottom-one"><strong>Lugar de entrega y devolución del vehículo:</strong></span> </div>
                      <!-- <div class="radio"> 
                      <label>
                        <input name="Lugar-devolucion" type="checkbox" id="Lugar-devolucion" checked="checked">
                      </label>
                      <span style="">&nbsp;&nbsp;Mismo lugar de devolución</span> 
                    </div> -->
                      <div class="row">
                        <div class="col-md-12">
                          <!-- <select id="txtLugar" name="txtLugar" required style="max-width: 100%;">
                            <option value="">Seleccione...</option>
          
                            <option value="3">Dot Baires Shopping</option>
                            <option value="4">Unicenter Shopping</option>
                            <option value="5">Tortugas Open Mall</option>
                            <option value="6">Shopping Palmas del Pilar</option>
                            <option value="7">Shopping Paseo Champagnat</option>
                            <option selected value="8">Caamaño 1103 Via Pilar. Buenos Aires. Oficina Central</option>

                          </select> -->

                          <?php
                          // Fetch all locations
                          ?>

                          <select id="txtLugar" name="txtLugar" required style="max-width: 100%;">
                            <option value="">Seleccione lugar de retiro...</option>
                            <?php
                            // Loop through the result and create <option> tags
                            foreach ($lugares_de_retiro as $lugar) {
                              // Check if the current option should be selected
                              $selected = ($lugar['ID'] == 1) ? 'selected' : '';
                              echo '<option value="' . $lugar['ID'] . '" ' . $selected . '>' . $lugar['NOMBRE_LUGAR'] . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div> </div>


                      <div class="row padding-one">
                        <!-- <div class="col-md-12 col-sm-12">
                        <div> <span class="margin-two xs-margin-bottom-two" style="color:#5aa5e6"><strong>Correo electrónico</strong></span> </div>
                        <div class="row">
                          <div class="col-md-12 ">
                            <input  type="email" id="email" name="txtCorreo" placeholder="Correo electrónico" required />
                          </div>
                        </div> 
                        </div>  -->
                      </div>
                      <div class="row padding-one">
                        <div class="col-md-12 col-sm-12">
                          <div> <span class="margin-two xs-margin-bottom-two" style="color:#5aa5e6"><strong>Fecha entrega & hora:</strong></span> </div>
                          <div class="row">
                            <div class="col-md-5 ">
                              <input type="date" id="FechaDesde" name="txtRetiro" placeholder="Desde" required />
                            </div>
                            <div class="col-md-5 ">
                              <select class="form-select" name="txtRetiroHora" id="txtEntregaHoraDisponibilidad">
                                <option value="08:00">08:00</option>
                                <option value="08:30">08:30</option>
                                <option value="09:00">09:00</option>
                                <option value="09:30">09:30</option>
                                <option value="10:00">10:00</option>
                                <option value="10:30">10:30</option>
                                <option value="11:00">11:00</option>
                                <option value="11:30">11:30</option>
                                <option value="12:00">12:00</option>
                                <option value="12:30">12:30</option>
                                <option value="13:00">13:00</option>
                                <option value="13:30">13:30</option>
                                <option value="14:00">14:00</option>
                                <option value="14:30">14:30</option>
                                <option value="15:00">15:00</option>
                                <option value="15:30">15:30</option>
                                <option value="16:00">16:00</option>
                                <option value="16:30">16:30</option>
                                <option value="17:00">17:00</option>
                                <option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                              </select>
                            </div>
                          </div>
                          <div> <span class="margin-two xs-margin-bottom-two" style="color:#5aa5e6"><strong>Fecha devolución & hora:</strong></span> </div>
                          <div class="row">
                            <div class="col-md-5 ">
                              <input type="date" id="FechaDesde" name="txtEntrega" placeholder="Hasta" required />
                            </div>
                            <div class="col-md-5 ">
                              <select class="form-select" name="txtEntregaHora" id="txtEntregaHoraDisponibilidad" required>
                                <option value="08:00">08:00</option>
                                <option value="08:30">08:30</option>
                                <option value="09:00">09:00</option>
                                <option value="09:30">09:30</option>
                                <option value="10:00">10:00</option>
                                <option value="10:30">10:30</option>
                                <option value="11:00">11:00</option>
                                <option value="11:30">11:30</option>
                                <option value="12:00">12:00</option>
                                <option value="12:30">12:30</option>
                                <option value="13:00">13:00</option>
                                <option value="13:30">13:30</option>
                                <option value="14:00">14:00</option>
                                <option value="14:30">14:30</option>
                                <option value="15:00">15:00</option>
                                <option value="15:30">15:30</option>
                                <option value="16:00">16:00</option>
                                <option value="16:30">16:30</option>
                                <option value="17:00">17:00</option>
                                <option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                              </select>
                            </div>
                          </div>

                          <div class="row padding-three">
                            <div class="col-md-12 col-xs-12">
                              <div class="col-md-3 col-xs-3 text-center"> <i class="icon-pricetags small-icon white-text"></i> <br><span class="font-weight-700 white-text" style="font-size:13px">Mejor Precio</span></div>

                              <div class="col-md-4 col-xs-4 text-center"> <i class="icon-key small-icon white-text" style="color:F24100"></i> <br><span class="font-weight-700 white-text" style="font-size:13px">Automóviles nuevos</span></div>

                              <div class="col-md-5 col-xs-5 text-center"> <i class="icon-chat small-icon white-text"></i><br> <span class="font-weight-700 white-text" style="font-size:13px">Atención Personalizada</span></div>




                            </div>
                          </div>
                          <div class="text-small center-col margin-two margin-bottom text-left">
                            <button type="submit" class="highlight-button-dark btn btn-small button xs-margin-bottom-five" style="margin-right: 20px" onclick="javascript:enviar()" value="Continuar">Continuar</button>
                            <!-- <a href="https://previaje.gob.ar/" target="_blank"><img src="img/previaje.png" alt="" style="width:157px !important;" /></a> -->
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="tour-package" class="padding-two sm-padding-top-nine sm-padding-bottom-nine">
    <div class="container-fluid">
      <div class="row padding-two">
        <div class="col-md-12 col-sm-12 text-center center-col">
          <h3><span class="section-title text-uppercase"><strong>Promociones en alquiler mensual</strong></span></h3>
          <div class="separator-line bg-orange margin-two"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- destinations items -->
          <div class="col-md-4 col-sm-6 margin-two no-margin-top sm-margin-bottom-four xs-no-padding">
            <div class="cover-background best-hotels-img" style="background-image: url(img/RenaultKwid2021.jpg);">
              <div class="col-md-6 col-sm-9 text-center best-hotels-text bg-alquiler pull-right"> <span class="text-uppercase font-weight-600 display-block black-text margin-ten no-margin-bottom letter-spacing-2">Renault Kwid <br>
                </span> <span class="text-xs black-text">*Pago contado efectivo.</span> <a href="contacto.html" class="btn btn-black btn-small margin-four no-margin-bottom">Reservar</a> </div>
              <div class="destinations-offer bg-orange text-center font-weight-600 text-uppercase white-text text-large no-letter-spacing">25% off</div>
            </div>
          </div>
          <!-- end destinations items -->
          <!-- destinations items -->
          <div class="col-md-4 col-sm-6 margin-two no-margin-top sm-margin-bottom-four xs-no-padding">
            <div class="cover-background best-hotels-img" style="background-image: url(img/Volkswagen-gol-trend-2021.jpg);">
              <div class="col-md-6 col-sm-9 text-center best-hotels-text bg-alquiler pull-right"> <span class="text-uppercase font-weight-600 display-block black-text margin-ten no-margin-bottom letter-spacing-2">Volkswagen Gol Trendline <br>
                </span> <span class="text-xs black-text">*Pago contado efectivo.</span> <a href="contacto.html" class="btn btn-black btn-small margin-four no-margin-bottom">Reservar</a> </div>
              <div class="destinations-offer bg-orange text-center font-weight-600 text-uppercase white-text text-large no-letter-spacing">25% off</div>
            </div>
          </div>
          <!-- end destinations items -->
          <!-- destinations items -->
          <div class="col-md-4 col-sm-6 margin-two no-margin-top sm-margin-bottom-four xs-no-padding">
            <div class="cover-background best-hotels-img" style="background-image: url(img/fiat-cronos-imagen-2021.jpg);">
              <div class="col-md-6 col-sm-9 text-center best-hotels-text bg-alquiler pull-right"> <span class="text-uppercase font-weight-600 display-block black-text margin-ten no-margin-bottom letter-spacing-2">Fiat Cronos <br>
                </span> <span class="text-xs black-text">*Pago contado efectivo.</span> <a href="contacto.html" class="btn btn-black btn-small margin-four no-margin-bottom">Reservar</a> </div>
              <div class="destinations-offer bg-orange text-center font-weight-600 text-uppercase white-text text-large no-letter-spacing">25% off</div>
            </div>
          </div>
          <!-- end destinations items -->

        </div>
      </div>
    </div>
  </section>
  <section class="no-padding margin-two img-mobile">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center"> <a href="https://api.whatsapp.com/send?phone=5491122919281" target="_blank"><img src="img/banner-invertir.jpg" alt=""></a> </div>
      </div>
    </div>
  </section>
  <section class="no-padding margin-two img-desktop">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center"> <a href="https://api.whatsapp.com/send?phone=5491122919281" target="_blank"><img src="img/1000x600.jpg" alt=""></a> </div>
      </div>
    </div>
  </section>

  <!-- <section class="no-padding margin-three img-desktop">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center"> <a href="contacto.html" target="_self"><img src="img/600x950.jpg" alt=""></a> </div>
      </div>
    </div>
  </section> -->
  <section class="no-padding-bottom wow fadeIn margin-three">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-10 text-center left-col">
          <h3 class="section-title">Contáctenos: </h3>
          <h3 class="section-title"><a href="mailto:info@3wheels.com.ar">info@3wheels.com.ar</a></h3>
          <h1 class="black-text no-margin-top margin-bottom"> <a href="tel://5491122919281"><i class="fa fa-phone"></i></a><a href="https://api.whatsapp.com/send?phone=5491122919281" style="color:#92bee2"><i class="fa fa-whatsapp"></i> +54 911 22919281</a></h1>
        </div>
      </div>
      <!-- <div class="row no-padding">
        <div class="col-md-12 text-center"> <a href="https://previaje.gob.ar" target="_blank"><img src="img/previaje.jpg" alt="Formamos parte del Programa Previaje"></a> </div>
      </div> -->
    </div>
  </section>
  <section id="blog" class="wow fadeIn bg-gray padding-five">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h3 class="section-title">Nuestra Flota</h3>
          <br>
          <br>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-6 wow fadeInUp" style="padding-bottom: 15px;" data-wow-duration="300ms">
          <div class="blog-post">
            <div class="blog-post-images"><img src="img/RenaultKwid.jpg" alt=""></div>
            <div class=""> <span class="post-title">categorÍA &quot;A&quot;</span>
              <ul class="flat-list flat-list-icon">
                <li><i class="fa fa-check"></i>5 Puertas.</li>
                <li><i class="fa fa-check"></i>Aire acondicionado.</li>
                <li><i class="fa fa-check"></i>Dirección Eléctriconica.</li>
                <li><i class="fa fa-check"></i>Airbag conductor y pasajero.</li>
                <li><i class="fa fa-check"></i>Frenos ABS.</li>
                <li><i class="fa fa-check"></i>Anclajes ISOFIX traseros para silla de bebés.</li>
                <li><i class="fa fa-check"></i>Radio con Bluetooth, USB y AUX.</li>
                <li><i class="fa fa-check"></i>Toma 12v.</li>
                <li><i class="fa fa-check"></i>Alza cristales delanteros electricos.</li>
                <p></p>
                <p></p>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12 text-left wow fadeInUp" data-wow-duration="1200ms"> <a class="btn btn-black btn-small margin-four no-margin-bottom" href="categoria-a.html">cotizar</a></div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow fadeInUp" style="padding-bottom: 15px;" data-wow-duration="600ms">
          <div class="blog-post">
            <div class="blog-post-images"><img src="img/ToyotaEtios.jpg" alt=""></div>
            <div class=""> <span class="post-title">CATEGORÍA &quot;b&quot;</span>
              <ul class="flat-list flat-list-icon">
                <li><i class="fa fa-check"></i>5 Puertas.</li>
                <li><i class="fa fa-check"></i>Aire acondicionado.</li>
                <li><i class="fa fa-check"></i>Dirección Eléctriconica.</li>
                <li><i class="fa fa-check"></i>Airbag conductor y pasajero.</li>
                <li><i class="fa fa-check"></i>Frenos ABS.</li>
                <li><i class="fa fa-check"></i>Anclajes ISOFIX traseros para silla de bebés.</li>
                <li><i class="fa fa-check"></i>Radio con Bluetooth, USB y AUX.</li>
                <li><i class="fa fa-check"></i>Toma 12v.</li>
                <li><i class="fa fa-check"></i>Alza cristales delanteros electricos.</li>
                <li><i class="fa fa-check"></i>Asiento trasero con respaldo rebatible.</li>
                <p></p>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12 text-left wow fadeInUp" data-wow-duration="1200ms"> <a class="btn btn-black btn-small margin-four no-margin-bottom" href="categoria-b.html">Cotizar</a> </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow fadeInUp" style="padding-bottom: 15px;" data-wow-duration="900ms">
          <div class="blog-post">
            <div class="blog-post-images"><img src="img/FiatCronos.jpg" alt=""></div>
            <div class=""> <span class="post-title">CATEGORÍA &quot;C&quot;</span>
              <ul class="flat-list flat-list-icon">
                <li><i class="fa fa-check"></i>5 Puertas.</li>
                <li><i class="fa fa-check"></i>Aire acondicionado.</li>
                <li><i class="fa fa-check"></i>Dirección Eléctriconica.</li>
                <li><i class="fa fa-check"></i>Airbag conductor y pasajero.</li>
                <li><i class="fa fa-check"></i>Frenos ABS.</li>
                <li><i class="fa fa-check"></i>Anclajes ISOFIX traseros para silla de bebés.</li>
                <li><i class="fa fa-check"></i>Equipo de audio multimedia con CD, AUX, Bluetooth, USB, y conectividad a celulares.</li>
                <li><i class="fa fa-check"></i>Toma 12v.</li>
                <li><i class="fa fa-check"></i>Alza cristales delanteros electricos.</li>
                <li><i class="fa fa-check"></i>Asiento trasero con respaldo rebatible.</li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12 text-left wow fadeInUp" data-wow-duration="1200ms"> <a class="btn btn-black btn-small margin-four no-margin-bottom" href="categoria-c.html">Cotizar</a> </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow fadeInUp" style="padding-bottom: 15px;" data-wow-duration="900ms">
          <div class="blog-post">
            <div class="blog-post-images"><img src="img/kangoo.jpeg" alt=""></div>
            <div class=""> <span class="post-title">CATEGORÍA &quot;D&quot;</span>
              <ul class="flat-list flat-list-icon">
                <li><i class="fa fa-check"></i>Doble puerta lateral.</li>
                <li><i class="fa fa-check"></i>Capacidad 5 personas.</li>
                <li><i class="fa fa-check"></i>Aire acondicionado.</li>
                <li><i class="fa fa-check"></i>Dirección asistida.</li>
                <li><i class="fa fa-check"></i>Alza cristales delanteros.</li>
                <li><i class="fa fa-check"></i>Asiento trasero rebatible para mayor espacio en el furgón.</li>
                <li><i class="fa fa-check"></i>Air bags conductor y acompañante.</li>
                <li><i class="fa fa-check"></i>Frenos ABS.</li>
                <li><i class="fa fa-check"></i>Radio Blutooth .</li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12 text-left wow fadeInUp" data-wow-duration="1200ms"> <a class="btn btn-black btn-small margin-four no-margin-bottom" href="categoria-c.html">Cotizar</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="padding-bottom margin-two">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center"> <img src="img/banner-julio.jpg" alt=""> </div>
      </div>
    </div>
  </section>
  <section class="parallax1 parallax-fix spa-our-packages xs-onepage-section" style="background: url(img/RentaCarPilar.jpg) 50% -11px;">
    <div class="opacity-full bg-promo"></div>
    <div class="container">
      <div class="row padding-two sm-text-center">
        <div class="col-md-12 no-padding text-center">
          <h3 class="white-text">CONSULTÁ NUESTRAS PROMOCIONES PARA ESTE MES</h3>
          <br>
          <a class="highlight-button btn btn-medium button xs-margin-bottom-five xs-no-margin-right" href="promos.html">COnsultar ahora</a>
        </div>
      </div>
    </div>
  </section>
  <section class="wow fadeIn no-padding">
    <div class="container-fuild">
      <div class="row no-margin">
        <div id="canvas1" class="col-md-12 col-sm-6 no-padding contact-map map">
          <iframe id="map_canvas1" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3290.674208965493!2d-58.83340658430321!3d-34.43502965610009!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bc9c2868394341%3A0x64a3055401da2f83!2sR.+Caama%C3%B1o+1103%2C+B1631BUW+Villa+Rosa%2C+Buenos+Aires!5e0!3m2!1ses!2sar!4v1554775268043!5m2!1ses!2sar"></iframe>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="bg-white">
      <div class="container">
        <div class="row margin-four">
          <div class="col-md-4 col-sm-4 text-center"><i class="icon-phone small-icon black-text"></i>
            <h6 class="black-text margin-two no-margin-bottom"><a href="https://api.whatsapp.com/send?phone=5491122919281">+54 911 22919281</a></h6>
          </div>
          <div class="col-md-4 col-sm-4 text-center"><i class="icon-map-pin small-icon black-text"></i>
            <h6 class="black-text margin-two no-margin-bottom">R. Caamaño 1103, Villa Rosa, Buenos Aires.</h6>
          </div>
          <div class="col-md-4 col-sm-4 text-center"><i class="icon-envelope small-icon black-text"></i>
            <h6 class="margin-two no-margin-bottom"><a href="mailto:info@3wheels.com.ar" class="black-text">info@3wheels.com.ar</a></h6>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid bg-dark-gray footer-bottom">
      <div class="container">
        <div class="row margin-three">
          <div class="col-md-6 col-sm-6 col-xs-12 copyright text-left letter-spacing-1 xs-text-center xs-margin-bottom-one"> &copy; 2019 3wheels. Todos los derechos reservados.</div>
          <div class="col-md-6 col-sm-6 col-xs-12 footer-logo text-right xs-text-center"> <a href="index.php"><img src="img/logo-pie.png" alt="" /></a> </div>
        </div>
      </div>
    </div>
    <a href="javascript:;" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
  </footer>
  <!-- <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <p class="no-margin-bottom"><img src="img/icono.png" style="margin-right:10px; margin-bottom:10px; float: left;" /><strong style="font-weight: 700; color:#5aa5e6; font-size:18px">Dejanos tus datos<br>
              y te llamamos!</strong></p>
        </div>
        <div class="modal-body" style="text-align:left">
          <div class="row">
            <div class="col-md-12 col-sm-12"> </div>
            <div class="col-md-12 col-sm-12 center-col">
              <form method="post" name="formularioPopup" id="formularioPopup" onsubmit="enviarDatosPopup(); return false;">
                <input type="text" class="form-control" name="Name" id="Name" required placeholder="Ingrese su Nombre" size="40">
                <input type="text" class="form-control" name="Tel" id="Tel" placeholder="Teléfono" size="40" required>
                <input name="Gracias" id="Gracias" type="hidden" value="gracias.html">
                <input name="Asunto" id="Asunto" type="hidden" value="Contacto Popup 3Wheels">
                <button type="submit" class="btn btn-black btn-small margin-four no-margin-bottom">Enviar</button>
              </form>
              <br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <script src="js/jquery.min.js"></script>
  <script src="js/modernizr.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap-hover-dropdown.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/skrollr.min.js"></script>
  <script src="js/smooth-scroll.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/page-scroll.js"></script>
  <script src="js/jquery.easypiechart.js"></script>
  <script src="js/jquery.parallax-1.1.3.js"></script>
  <script src="js/jquery.isotope.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/popup-gallery.js"></script>
  <script src="js/text-effect.js"></script>
  <script src="js/jquery.tools.min.js"></script>
  <script src="js/jquery.revolution.js"></script>
  <script src="js/counter.js"></script>
  <script src="js/jquery.fitvids.js"></script>
  <script src="js/imagesloaded.pkgd.min.js"></script>
  <script src="js/main.js"></script>
  <script>
    $(window).load(function() {
      $('#myModal').modal('show');
    });
  </script>
  <!-- GetButton.io widget -->
  <script type="text/javascript">
    function enviar() {
      if (document.getElementById('g-recaptcha-response').value.trim() != '') {

        document.forms.frmCotizar.submit();
      } else {

        alert('Verifique que no es un robot');
      }
    }



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


    var DateDiff = {

      inDays: function(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();

        return Math.floor((t2 - t1) / (24 * 3600 * 1000));
      },

      inWeeks: function(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();

        return parseInt((t2 - t1) / (24 * 3600 * 1000 * 7));
      },

      inMonths: function(d1, d2) {
        var d1Y = d1.getFullYear();
        var d2Y = d2.getFullYear();
        var d1M = d1.getMonth();
        var d2M = d2.getMonth();

        return (d2M + 12 * d2Y) - (d1M + 12 * d1Y);
      },

      inYears: function(d1, d2) {
        return d2.getFullYear() - d1.getFullYear();
      }
    }

    document.getElementsByName("txtEntrega")[0].setAttribute('min', new Date().toISOString().split("T")[0])
    document.getElementsByName("txtRetiro")[0].setAttribute('min', new Date().toISOString().split("T")[0])

    async function checkForm(event, form) {
    // Evita el envío del formulario por defecto
    event.preventDefault();
      
    // Obtener las fechas de los campos de entrada
    var retiro = new Date(document.getElementsByName("txtRetiro")[0].value);
    var entrega = new Date(document.getElementsByName("txtEntrega")[0].value);

    // Calcular los días de diferencia
    var dias = DateDiff.inDays(retiro, entrega);

    // Validar que el día hasta sea posterior al día desde
    if (dias < 0) {
      alert("El día hasta debe ser posterior al día desde");
      return false; // Detener el envío
    }

    // Llamada AJAX para obtener el mínimo de días
    try {
      const response = await fetch('consultarminimodedias.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'txtDesde=' + encodeURIComponent(document.getElementsByName("txtRetiro")[0].value) +
          '&txtHasta=' + encodeURIComponent(document.getElementsByName("txtEntrega")[0].value) +
          '&noredirect=' + encodeURIComponent(true)
      });

      const data = await response.json();
      console.log(data, 'data')
      var minDias = data.min_dias;

      // Verificar si los días son menores que el mínimo
      if (dias < minDias) {
        alert("La cotización tiene que ser de mínimo " + minDias + " días.");
        return false; // Detener el envío
      }
      else {
        form.submit();

      }

      // Si todo está bien, permitir el envío manual del formulario

    } catch (error) {
      console.error('Error:', error);
      alert("Ocurrió un error al verificar los días mínimos.");
      return false; // Detener el envío
    }
  }
  </script>
  <!-- /GetButton.io widget -->
</body>

</html>