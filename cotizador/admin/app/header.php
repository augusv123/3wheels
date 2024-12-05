<?php
session_start();
set_time_limit(180);
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}


include('database.php');

function cleanText($texto)
{
    return preg_replace('([^A-Za-z0-9 ])', '', $texto);
}


if (!isset($_SESSION["usuario"])) {
    header("Location: https://3wheels.com.ar/cotizador/admin/login.php");
    die();
}

$reservasTotales = sp('RESERVAS_TOTALES()');
$totales = $reservasTotales[0];
$estados = array("Sin estado", "En Trámite", "Reservado", "Retirado", "Entregado", "Cancelado", "Taller");
$edades = array("MENOR DE 25 AÑOS", "MENOR DE 25 AÑOS");
$lugar = array("", "Obelisco (Av. 9 de Julio y Av. Corrientes)", "Aeroparque (Aeropuerto Jorge Newbery)", "Buquebus", "Dot Baires Shopping", "Unicenter Shopping", "Tortugas Open Mall", "Shopping Palmas del Pilar", "Shopping Paseo Champagnat", "R. Caamaño 1103, Villa Rosa, Buenos Aires");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizador</title>
    <meta name="robots" content="noindex" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <!-- <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css"> -->
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- html2pdf.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


    <style>
        body {

            overflow-y: scroll;
        }

        .tarjeta:hover {
            background-color: #f3f3f3;
            cursor: pointer;
            border-radius: 10px;
        }

        h3 {
            margin: 0px;
        }

        .filaReserva:hover {

            cursor: pointer;
            background-color: #e2e3e5;
            color: black !important;

        }

        @media only screen and (max-width: 600px) {

            #accesosDirectos,
            #cabeceraClientes {
                display: none;
            }

        }
    </style>


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
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active ">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="https://3wheels.com.ar/img/logo1.png" alt="Logo" style="height: 2rem;" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">


                        <li class="sidebar-item  has-sub  <?php if (str_contains($_SERVER['PHP_SELF'], 'reservas')) {
                                                                echo "active";
                                                            } ?>">
                            <a href="reservas.php" class="sidebar-link">
                                <i class="bi bi-calendar3"></i>
                                <span>Reservas</span>
                            </a>
                            <ul class="submenu" style="display: block;">
                                <li class="submenu-item ">
                                    <a href="reservas.php?t=8">Buscador</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="nueva-reserva.php?t=5">Nueva</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="reservas.php?t=5">Cancelados</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="reservas.php?t=7">Entregados</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="reservas.php?t=6">Taller (<?php echo $totales["reparacion"] ?>) </a>
                                </li>
                            </ul>
                        </li>





                        <li
                            class="sidebar-item <?php if (str_contains($_SERVER['PHP_SELF'], 'clientes')) {
                                                    echo "active";
                                                } ?> ">
                            <a href="clientes.php" class='sidebar-link'>
                                <i class="bi bi-person-fill"></i>
                                <span>Clientes</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php if (str_contains($_SERVER['PHP_SELF'], 'tarifarios')) {
                                                    echo "active";
                                                } ?> ">
                            <a href="tarifarios.php" class='sidebar-link'>
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                <span>Tarifarios</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php if (str_contains($_SERVER['PHP_SELF'], 'mindiasreserva')) {
                                                    echo "active";
                                                } ?> ">
                            <a href="mindiasreserva.php" class='sidebar-link'>
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                <span>Minimo dias reserva</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php if (str_contains($_SERVER['PHP_SELF'], 'factor_dias')) {
                                                    echo "active";
                                                } ?> ">
                            <a href="factor_dias.php" class='sidebar-link'>
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                <span>Factor dias</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php if (str_contains($_SERVER['PHP_SELF'], 'lugares_de_retiro')) {
                                                    echo "active";
                                                } ?> ">
                            <a href="lugares_de_retiro.php" class='sidebar-link'>
                                <i class="bi bi-geo"></i>
                                <span>Lugares de retiro</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php if (str_contains($_SERVER['PHP_SELF'], 'cotizador.php')) {
                                                    echo "active";
                                                } ?> ">
                            <a href="cotizador.php" class='sidebar-link'>
                                <i class="bi bi-calculator"></i>
                                <span>Cotizador</span>
                            </a>
                        </li>
                        <li class="sidebar-item  <?php if (str_contains($_SERVER['PHP_SELF'], 'formulario.php')) {
                                                        echo "active";
                                                    } ?>">
                            <a href="formulario.php" class='sidebar-link'>
                                <i class="bi bi-calculator"></i>
                                <span>Cotizador Web</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub  
                        <?php if (str_contains($_SERVER['PHP_SELF'], 'datospersonales')) {
                            echo "active";
                        } ?>">
                            <a href="reservas.php" class="sidebar-link">
                                <i class="bi bi-clipboard-data"></i>
                                <span>Datos de contacto</span>
                            </a>
                            <ul class="submenu" style="display: block;">
                                <li class="submenu-item ">
                                    <a href="datospersonales.php">Formulario Nuevo XLSX</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="datospersonalesOld.php">Archivos viejos VCF</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item <?php if (str_contains($_SERVER['PHP_SELF'], 'autos')) {
                                                    echo "active";
                                                } ?> ">
                            <a href="autos.php" class='sidebar-link'>
                                <i class="bi bi-cone-striped"></i>
                                <span>Autos</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php if (str_contains($_SERVER['PHP_SELF'], 'Configuracion')) {
                                                    echo "active";
                                                } ?> ">
                            <a href="configuracion.php" class='sidebar-link'>
                                <i class="bi bi-gear"></i>
                                <span>Configuracion</span>
                            </a>
                        </li>




                        <li class="sidebar-item <?php if (str_contains($_SERVER['PHP_SELF'], 'activar')) {
                                                    echo "active";
                                                } ?> ">
                            <a href="activar.php" class='sidebar-link'>
                                <i class="bi bi-bullseye"></i>
                                <span>Activar</span>
                            </a>
                        </li>


                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>


            <div class="page-content">
                <div class="row" id="accesosDirectos">
                    <div class="col-xs-12 col-lg-3 col-md-6" onclick="javascript:location.href='reservas?t=1'">
                        <div class="card">
                            <div class="card-body px-3 py-4-5 tarjeta">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Reservas en trámite</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo $totales["tramite"] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-6" onclick="javascript:location.href='reservas?t=2'">
                        <div class="card">
                            <div class="card-body px-3 py-4-5 tarjeta">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldUpload"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Retiros</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo $totales["reservados"] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-6" onclick="javascript:location.href='reservas?t=3'">
                        <div class="card">
                            <div class="card-body px-3 py-4-5 tarjeta">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldDownload"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Entregas</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo $totales["entregar"] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-6 " onclick="javascript:location.href='calendario.php'">
                        <div class="card">
                            <div class="card-body px-3 py-4-5 tarjeta">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldCalendar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Calendario</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo $totales["reservados"] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>