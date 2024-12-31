<?php include('app/header.php');
require '../../vendor/autoload.php'; // Asegúrate de tener el autoload de Composer
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$reserva;

$descuentoEfectivo = SP('OBTENER_CONFIGURACION_POR_NOMBRE("DESCUENTO_EFECTIVO")');
$valorSillaBebe = SP('OBTENER_CONFIGURACION_POR_NOMBRE("VALOR_SILLA_BEBE")');
$coberturaPremium = SP('OBTENER_CONFIGURACION_POR_NOMBRE("COBERTURA_PREMIUM")');
$valorSillaBebe = isset($valorSillaBebe[0]['VALOR']) ? $valorSillaBebe[0]['VALOR'] : 0;
$coberturaPremium = isset($coberturaPremium[0]['VALOR']) ? $coberturaPremium[0]['VALOR'] : 0;
$descuentoEfectivo = isset($descuentoEfectivo[0]['VALOR']) ? $descuentoEfectivo[0]['VALOR'] : 0;

$autos = sp('AUTOS_CONSULTAR()');
$autosArray = json_encode($autos);
$reserva = [];
$reserva['MODELO'] = 'Seleccione patente...';
$reserva["ESTADO"] = 0;
$reserva["LUGAR"] = 0;
$reserva["HORA_RETIRO"] = "08:00";
$reserva["HORA_ENTREGA"] = "08:00";
$reserva["NOMBRE"] = "";
$reserva["EDAD"] = "";
$reserva["LOCALIDAD"] = "";
$reserva["CORREO"] = "";
$reserva["TELEFONO"] = "";
$reserva["DNI"] = "";
$reserva["OBSERVACIONES"] = "";
$reserva["MEDIO_PAGO"] = 0;
$reserva["ESTADO"] == 3;

// $disponibles=sp("RESERVAS_DISPONIBILIDAD('".$_POST["txtRetiro"]."','".$_POST["txtEntrega"]."')");
$lugares_de_retiro = sp('VerTodosLosLugaresRetiro()');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['txtNombre'];
    $dni = isset($_POST['txtDni']) && $_POST['txtDni'] !== '' ? $_POST['txtDni'] : -1;
    $correo = $_POST['txtCorreo'];
    $telefono = $_POST['txtTelefono'];
    $localidad = $_POST['txtLocalidad'];
    $edad = $_POST['txtEdad'];
    $retiro = $_POST['txtFechaRetiro'];
    $entrega = $_POST['txtFechaEntrega'];
    $horaRetiro = $_POST['txtHoraRetiro'];
    $horaEntrega = $_POST['txtHoraEntrega'];
    $lugar = isset($_POST['txtLugar']) && $_POST['txtLugar'] !== '' ? $_POST['txtLugar'] : 1;

    $medioPago = $_POST['txtMediosDePago'] !== '' ? $_POST['txtMediosDePago'] : 1;
    $precio = $_POST['txtPrecioCalculado'];
    $modelo = $_POST['txtModelo'];
    $patente = isset($_POST['txtPatente'])  && $_POST['txtPatente'] !== '' ?   $_POST['txtPatente'] : null;
    $mismoLugar = 0;
    $cobertura = isset($_POST['txtCobertura']) ? 1 : 0;
    $silla = isset($_POST['txtSilla']) ? 1 : 0;
    $observaciones = $_POST['txtObservaciones'];
    $estado = $_POST['txtEstado'];

    if (!empty($_GET["r"])) {
        sp_exec("RESERVAS_ACTUALIZAR_V2(" . $_GET["r"] . ",'$nombre', $dni, '$correo', '$telefono', '$localidad', $edad, '$retiro', '$entrega', '$horaRetiro', '$horaEntrega', $lugar, $medioPago, $precio, '$modelo', $mismoLugar, $cobertura, $silla, '$patente', '$observaciones', $estado)");
    } else {
        sp_exec("RESERVAS_INSERTAR_V2('$nombre', $dni, '$correo', '$telefono', '$localidad', $edad, '$retiro', '$entrega', '$horaRetiro', '$horaEntrega', $lugar, $medioPago, $precio, '$modelo', $mismoLugar, $cobertura, $silla, '$patente', '$observaciones', $estado)");
    }

    try {
        // Ruta al archivo Excel existente
        $fileName = '../DatosPersonalesCotizador.xlsx';
      
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
          $sheet->setCellValue('H1', 'Edad');
          $sheet->setCellValue('H1', 'Observaciones');
        }
      
        // Obtener la siguiente fila vacía
        $lastRow = $sheet->getHighestRow() + 1; // Conseguir la siguiente fila vacía
        $lugar_nombre = '';
        foreach ($lugares_de_retiro as $lugarderetiro) {
            if ($lugarderetiro['ID'] == $lugar) {
                $lugar_nombre = $lugarderetiro['NOMBRE_LUGAR'];
                break;
            }
        }
      
        // Insertar datos en la nueva fila
        $sheet->setCellValue('A' . $lastRow, $nombre);
        $sheet->setCellValue('B' . $lastRow, $correo);
        $sheet->setCellValue('C' . $lastRow, $telefono);
        $sheet->setCellValue('D' . $lastRow, $localidad);
        $sheet->setCellValue('E' . $lastRow, $lugar_nombre);
        $sheet->setCellValue('F' . $lastRow, $modelo);
        $sheet->setCellValue('G' . $lastRow, date("Y-m-d"));
        $sheet->setCellValue('H' . $lastRow, $edad == 1 ? 'Mayor de 25 años' : 'Menor de 25 años');
        $sheet->setCellValue('I' . $lastRow, $observaciones);
        // Guardar el archivo Excel con los nuevos datos
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($fileName);
      
        echo "Archivo Excel actualizado exitosamente: $fileName";
      
      } catch (Exception $e) {
        echo 'Se produjo una excepción: ', $e->getMessage();
        exit;
      }

    header("Location: reservas.php?t=8");
} else {

    if (!empty($_GET["r"])) {
        $data = sp('RESERVAS_OBTENER(' . $_GET["r"] . ')');
        if($data){

            $reserva = $data[0];
        }
    }
}
?>

<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" method="POST" name="frmReserva">

                        <div class="row">
                            <div class="col-12 pb-3" style="display: flex;flex-direction:row;justify-content:space-between">

                                <div>
                                    <h3 style="margin:0px;">
                                        <?php
                                        if (isset($reserva[0])) {

                                            echo 'Reserva - #' . $reserva[0];
                                        } else {
                                            echo 'Nueva Reserva';
                                        }

                                        ?></h3>
                                    <small><b><?php
                                                if (isset($reserva['FECHA'])) {
                                                    echo date("d-m-Y  H:i", strtotime($reserva['FECHA']));
                                                }
                                                ?>
                                        </b> </small>
                                </div>



                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Retiro</label>
                                    <input type="date" class="form-control" name="txtFechaRetiro" id="FechaDesde" value="<?php
                                                                                                                            if (isset($reserva["FECHA_RETIRO"])) {
                                                                                                                                echo $reserva["FECHA_RETIRO"];
                                                                                                                            } else {
                                                                                                                                echo '';
                                                                                                                            }
                                                                                                                            ?>" name="country-floating">
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Hora</label>
                                    <select class="form-select" id="txtHoraRetiro" name="txtHoraRetiro">
                                        <option value="08:00" <?php if ($reserva["HORA_RETIRO"] == "08:00") echo "selected"; ?>>08:00</option>
                                        <option value="08:30" <?php if ($reserva["HORA_RETIRO"] == "08:30") echo "selected"; ?>>08:30</option>
                                        <option value="09:00" <?php if ($reserva["HORA_RETIRO"] == "09:00") echo "selected"; ?>>09:00</option>
                                        <option value="09:30" <?php if ($reserva["HORA_RETIRO"] == "09:30") echo "selected"; ?>>09:30</option>
                                        <option value="10:00" <?php if ($reserva["HORA_RETIRO"] == "10:30") echo "selected"; ?>>10:00</option>
                                        <option value="10:30" <?php if ($reserva["HORA_RETIRO"] == "10:00") echo "selected"; ?>>10:30</option>
                                        <option value="11:00" <?php if ($reserva["HORA_RETIRO"] == "11:00") echo "selected"; ?>>11:00</option>
                                        <option value="11:30" <?php if ($reserva["HORA_RETIRO"] == "11:30") echo "selected"; ?>>11:30</option>
                                        <option value="12:00" <?php if ($reserva["HORA_RETIRO"] == "12:00") echo "selected"; ?>>12:00</option>
                                        <option value="12:30" <?php if ($reserva["HORA_RETIRO"] == "12:30") echo "selected"; ?>>12:30</option>
                                        <option value="13:00" <?php if ($reserva["HORA_RETIRO"] == "13:00") echo "selected"; ?>>13:00</option>
                                        <option value="13:30" <?php if ($reserva["HORA_RETIRO"] == "13:30") echo "selected"; ?>>13:30</option>
                                        <option value="14:00" <?php if ($reserva["HORA_RETIRO"] == "14:00") echo "selected"; ?>>14:00</option>
                                        <option value="14:30" <?php if ($reserva["HORA_RETIRO"] == "14:30") echo "selected"; ?>>14:30</option>
                                        <option value="15:00" <?php if ($reserva["HORA_RETIRO"] == "15:00") echo "selected"; ?>>15:00</option>
                                        <option value="15:30" <?php if ($reserva["HORA_RETIRO"] == "15:30") echo "selected"; ?>>15:30</option>
                                        <option value="16:00" <?php if ($reserva["HORA_RETIRO"] == "16:00") echo "selected"; ?>>16:00</option>
                                        <option value="16:30" <?php if ($reserva["HORA_RETIRO"] == "16:30") echo "selected"; ?>>16:30</option>
                                        <option value="17:00" <?php if ($reserva["HORA_RETIRO"] == "17:00") echo "selected"; ?>>17:00</option>
                                        <option value="17:30" <?php if ($reserva["HORA_RETIRO"] == "17:30") echo "selected"; ?>>17:30</option>
                                        <option value="18:00" <?php if ($reserva["HORA_RETIRO"] == "18:00") echo "selected"; ?>>18:00</option>
                                        <option value="18:30" <?php if ($reserva["HORA_RETIRO"] == "18:30") echo "selected"; ?>>18:30</option>
                                        <option value="19:00" <?php if ($reserva["HORA_RETIRO"] == "19:00") echo "selected"; ?>>19:00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-entrega">Entrega</label>
                                    <input type="date" class="form-control" id="FechaHasta" name="txtFechaEntrega" value="<?php
                                                                                                                    if (isset($reserva["FECHA_ENTREGA"])) {
                                                                                                                        echo $reserva["FECHA_ENTREGA"];
                                                                                                                    } else {
                                                                                                                        echo '';
                                                                                                                    }

                                                                                                                    ?>" name="country-floating">
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Hora</label>
                                    <select class="form-select" id="txtHoraEntrega" name="txtHoraEntrega">
                                        <option value="08:00" <?php if ($reserva["HORA_ENTREGA"] == "08:00") echo "selected"; ?>>08:00</option>
                                        <option value="08:30" <?php if ($reserva["HORA_ENTREGA"] == "08:30") echo "selected"; ?>>08:30</option>
                                        <option value="09:00" <?php if ($reserva["HORA_ENTREGA"] == "09:00") echo "selected"; ?>>09:00</option>
                                        <option value="09:30" <?php if ($reserva["HORA_ENTREGA"] == "09:30") echo "selected"; ?>>09:30</option>
                                        <option value="10:00" <?php if ($reserva["HORA_ENTREGA"] == "10:30") echo "selected"; ?>>10:00</option>
                                        <option value="10:30" <?php if ($reserva["HORA_ENTREGA"] == "10:00") echo "selected"; ?>>10:30</option>
                                        <option value="11:00" <?php if ($reserva["HORA_ENTREGA"] == "11:00") echo "selected"; ?>>11:00</option>
                                        <option value="11:30" <?php if ($reserva["HORA_ENTREGA"] == "11:30") echo "selected"; ?>>11:30</option>
                                        <option value="12:00" <?php if ($reserva["HORA_ENTREGA"] == "12:00") echo "selected"; ?>>12:00</option>
                                        <option value="12:30" <?php if ($reserva["HORA_ENTREGA"] == "12:30") echo "selected"; ?>>12:30</option>
                                        <option value="13:00" <?php if ($reserva["HORA_ENTREGA"] == "13:00") echo "selected"; ?>>13:00</option>
                                        <option value="13:30" <?php if ($reserva["HORA_ENTREGA"] == "13:30") echo "selected"; ?>>13:30</option>
                                        <option value="14:00" <?php if ($reserva["HORA_ENTREGA"] == "14:00") echo "selected"; ?>>14:00</option>
                                        <option value="14:30" <?php if ($reserva["HORA_ENTREGA"] == "14:30") echo "selected"; ?>>14:30</option>
                                        <option value="15:00" <?php if ($reserva["HORA_ENTREGA"] == "15:00") echo "selected"; ?>>15:00</option>
                                        <option value="15:30" <?php if ($reserva["HORA_ENTREGA"] == "15:30") echo "selected"; ?>>15:30</option>
                                        <option value="16:00" <?php if ($reserva["HORA_ENTREGA"] == "16:00") echo "selected"; ?>>16:00</option>
                                        <option value="16:30" <?php if ($reserva["HORA_ENTREGA"] == "16:30") echo "selected"; ?>>16:30</option>
                                        <option value="17:00" <?php if ($reserva["HORA_ENTREGA"] == "17:00") echo "selected"; ?>>17:00</option>
                                        <option value="17:30" <?php if ($reserva["HORA_ENTREGA"] == "17:30") echo "selected"; ?>>17:30</option>
                                        <option value="18:00" <?php if ($reserva["HORA_ENTREGA"] == "18:00") echo "selected"; ?>>18:00</option>
                                        <option value="18:30" <?php if ($reserva["HORA_ENTREGA"] == "18:30") echo "selected"; ?>>18:30</option>
                                        <option value="19:00" <?php if ($reserva["HORA_ENTREGA"] == "19:00") echo "selected"; ?>>19:00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Auto</label>
                                    <select class="form-select" id="patenteSelector" name="patenteSelector">

                                        <option value="0">Autos disponibles en fechas seleccionadas...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">MODELO</label>
                                    <input type="text" class="form-control" id="txtModelo" readonly value="<?php echo $reserva["MODELO"] ?>" name="txtModelo">
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">PATENTE</label>
                                    <input type="text" class="form-control" id="txtPatente" readonly value="<?php if (isset($reserva["PATENTE"])) {
                                                                                                                echo $reserva["PATENTE"];
                                                                                                            } ?>" name="txtPatente">
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Calculo de precio por dias</label>
                                    <div class="input-group mb-3">
                                        <input type="text" readonly name="txtPrecio" id="preciopordia" class="form-control" placeholder="" value="0" aria-describedby="button-addon1">
                                        <!-- <button class="btn btn-secondary" type="button" id="bottoncalcularPrecioXDia">Calcular</button> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Medio de pago</label>
                                    <select class="form-control" id="txtMediosDePago" name="txtMediosDePago">
                                        <option value="" <?php if ($reserva["MEDIO_PAGO"] == 0) echo "selected"; ?>>Seleccione medio de pago</option>

                                        <option value="1" <?php if ($reserva["MEDIO_PAGO"] == 1) echo "selected"; ?>>Efectivo</option>
                                        <option value="2" <?php if ($reserva["MEDIO_PAGO"] == 2) echo "selected"; ?>>Efectivo y tarjeta</option>
                                        <option value="3" <?php if ($reserva["MEDIO_PAGO"] == 3) echo "selected"; ?>>Tarjeta de débito</option>
                                        <option value="4" <?php if ($reserva["MEDIO_PAGO"] == 4) echo "selected"; ?>>Depósito bancario</option>
                                        <option value="5" <?php if ($reserva["MEDIO_PAGO"] == 5) echo "selected"; ?>>Mercadopago</option>
                                        <option value="6" <?php if ($reserva["MEDIO_PAGO"] == 6) echo "selected"; ?>>Visa</option>
                                        <option value="7" <?php if ($reserva["MEDIO_PAGO"] == 6) echo "selected"; ?>>Mastercard</option>
                                        <option value="8" <?php if ($reserva["MEDIO_PAGO"] == 6) echo "selected"; ?>>AMEX</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Lugar</label>
                                    <select class="form-select" name="txtLugar" id="selectorLugar">
                                        <option value="" <?php if ($reserva["LUGAR"] == 0) echo "selected"; ?>>Seleccione Lugar</option>

                                        <option value="1" <?php if ($reserva["LUGAR"] == 1) echo "selected"; ?>>Obelisco (Av. 9 de Julio y Av. Corrientes)</option>
                                        <option value="2" <?php if ($reserva["LUGAR"] == 2) echo "selected"; ?>>Aeroparque (Aeropuerto Jorge Newbery)</option>
                                        <option value="3" <?php if ($reserva["LUGAR"] == 3) echo "selected"; ?>>Buquebus</option>
                                        <option value="4" <?php if ($reserva["LUGAR"] == 4) echo "selected"; ?>>Dot Baires Shopping</option>
                                        <option value="5" <?php if ($reserva["LUGAR"] == 5) echo "selected"; ?>>Unicenter Shopping</option>
                                        <option value="6" <?php if ($reserva["LUGAR"] == 6) echo "selected"; ?>>Tortugas Open Mall</option>
                                        <option value="7" <?php if ($reserva["LUGAR"] == 7) echo "selected"; ?>>Shopping Palmas del Pilar</option>
                                        <option value="8" <?php if ($reserva["LUGAR"] == 8) echo "selected"; ?>>Shopping Paseo Champagnat</option>
                                        <option value="9" <?php if ($reserva["LUGAR"] == 9) echo "selected"; ?>>R. Caamaño 1103, Villa Rosa, Buenos Aires</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-12 d-flex flex-column justify-content-center">
                                <div class="checkbox-container">
                                    <label for="txtSilla">Silla de bebé:</label>
                                    <input type="checkbox" id="chkSillaBebe" name="txtSilla" value="1" <?php if (isset($reserva["SILLA"]) && $reserva["SILLA"] == 1) echo "checked"; ?>>
                                </div>
                                <div class="checkbox-container">
                                    <label for="txtCobertura">Cobertura premium:</label>
                                    <input type="checkbox" id="chkCobertura" name="txtCobertura" value="1" <?php if (isset($reserva["COBERTURA"]) && $reserva["COBERTURA"] == 1) echo "checked"; ?>>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Precio total</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="txtPrecioCalculado" id="preciototal" class="form-control" placeholder="" value="<?php echo isset($reserva['PRECIO']) ? $reserva['PRECIO'] : '0'; ?>" aria-describedby="button-addon1">
                                        <!-- <button class="btn btn-secondary" type="button" id="bottoncalcular">Calcular</button> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="txtEstado">Estado</label>
                                    <select class="form-select" id="txtEstado" name="txtEstado">
                                        <option value="1" <?php if (isset($reserva["ESTADO"]) && $reserva["ESTADO"] == 1) echo "selected"; ?>>Trámite</option>
                                        <option value="2" <?php if (isset($reserva["ESTADO"]) && $reserva["ESTADO"] == 2) echo "selected"; ?>>Reservados</option>
                                        <option value="3" <?php if (isset($reserva["ESTADO"]) && $reserva["ESTADO"] == 3) echo "selected"; ?>>Retirar</option>
                                        <option value="4" <?php if (isset($reserva["ESTADO"]) && $reserva["ESTADO"] == 4) echo "selected"; ?>>Entregar</option>
                                        <option value="5" <?php if (isset($reserva["ESTADO"]) && $reserva["ESTADO"] == 5) echo "selected"; ?>>Reparación</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">

                            </div>
                            <div class="col-12">
                                <h3 style="margin-bottom: 1rem;margin-top:2rem;">Cliente</h3>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Nombre</label>
                                    <input type="text" class="form-control" name="txtNombre" placeholder="" value="<?php echo isset($reserva["NOMBRE"]) ? $reserva["NOMBRE"] : '' ?>" aria-describedby="button-addon1">
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Localidad</label>
                                    <input type="text" class="form-control" name="txtLocalidad" placeholder="" value="<?php echo isset($reserva["LOCALIDAD"]) ? $reserva["LOCALIDAD"] : '' ?>" aria-describedby="button-addon1">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Teléfono</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="txtTelefono" placeholder="" value="<?php echo $reserva["TELEFONO"] ?>" aria-describedby="button-addon1">
                                        <button class="btn btn-secondary" type="button" id="button-addon1" onclick="window.open('tel:<?php echo $reserva['TELEFONO'] ?>');">
                                            <svg class="svg-inline--fa fa-phone fa-w-16 fa-fw select-all" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                <path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Correo</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="txtCorreo" placeholder="" value="<?php echo $reserva["CORREO"] ?>" aria-describedby="button-addon1">
                                        <button class="btn btn-secondary" type="button" id="button-addon1" onclick="window.open('mailto:<?php echo $reserva['CORREO'] ?>');">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
                                                <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">DNI</label>
                                    <input type="text" class="form-control" name="txtDni" placeholder="" value="<?php echo $reserva["DNI"] ?>" aria-describedby="button-addon1">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Edad</label>
                                    <select class="form-select" name="txtEdad">
                                        <option value="0" <?php if ($reserva["EDAD"] == "0") echo "selected"; ?>>Menor de 25 años</option>
                                        <option value="1" <?php if ($reserva["EDAD"] == "1") echo "selected"; ?>>Mayor de 25 años</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email-id-column">Observaciones</label>
                                    <textarea class="form-control" name="txtObservaciones"><?php echo $reserva["OBSERVACIONES"] ?></textarea>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1" onclick="javascript:actualizar()">Guardar</button>
                                <button type="button" class="btn btn-secondary me-1 mb-1" onclick="javascript:window.location.href='reservas.php';">Cerrar</button>
                            </div>
                        </div>
                        <input type="hidden" id="txtMensaje" value="<?php echo $mensaje ?>" />
                        <input type="hidden" id="txtEstado" value="<?php echo $$reserva['ESTADO'] ?>" />
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-lg  modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="exampleModalCenterTitle">Detalle de cotización</h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" class="cotable">
                    <tr style="text-align: left; background-color: #8a8585;color:white">
                        <td style="padding:10px;">ITEM</td>
                        <td style="text-align: right; padding:5px;">VALOR UNITARIO</td>
                        <td style="text-align: center;padding:5px;">CANTIDAD</td>
                        <td style="text-align: right;padding:5px;">SUBTOTAL</td>
                    </tr>
                    <?PHP
                    $total = 0;

                    foreach ($cotizacion as $item) { ?>
                        <tr>
                            <td style="text-align: left;padding:5px;"><?php echo $item["ITEM"] ?></td>
                            <td style="text-align: right;padding:5px;"><?php echo "$ " . number_format($item["VALOR_UNITARIO"], 0, ',', '.') ?></td>
                            <td style="text-align: center;padding:5px;"><?php echo $item["CANTIDAD"] ?></td>
                            <td style="text-align: right;padding:5px;"><?php $subTotal = ($item["VALOR_UNITARIO"]);
                                                                        $total += $subTotal;
                                                                        echo "$ " . number_format($subTotal, 0, ',', '.'); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3" style="text-align: left;padding:10px;">TOTAL</td>
                        <td style="text-align: right;padding:5px"><b><?php echo "$ " . number_format($total, 0, ',', '.') ?></b></td>
                    </tr>
                    <table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Cerrar</span>
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    errores = '';

    function validar(control, mensaje) {
        if (control.value.trim() == '') errores += mensaje + "\n"
    };

    function actualizar() {
        form = document.forms.frmReserva;

        validar(form.txtPrecio, "Completar precio");

        if (form.txtPatente.value == '0' && form.txtEstado.value != 1) errores += "Debe seleccionar una vehiculo para los estados distinto a En trámite \n";
        if (errores != '') {
            alert(errores);
            errores = '';
        } else {
            form.submit();
        }

    }
</script>

<script type="text/javascript">
    var fechaDesdeInput = document.getElementById('FechaDesde');
    var fechaHastaInput = document.getElementById('FechaHasta');
    var buttonCalcular = document.getElementById('bottoncalcular');
    var selectorLugar = document.getElementById('selectorLugar');
    var checkCobertura = document.getElementById('chkCobertura');
    var checkSilla = document.getElementById('chkSillaBebe');
    var autosArray = [];
    lugares_de_retiro = <?php echo json_encode($lugares_de_retiro); ?>;
    var lugarSeleccionado = lugares_de_retiro.find(lugar => lugar.ID == selectorLugar.value);;
    // Add an event listener to the input element
    fechaDesdeInput.addEventListener('input', function() {
        buscarDisponibles();
    });
    fechaHastaInput.addEventListener('input', function() {
        buscarDisponibles();
    });

    selectorLugar.addEventListener('change', function() {
        lugarSeleccionado = lugares_de_retiro.find(lugar => lugar.ID == selectorLugar.value);
        recalcularOpcionales();

    });
    var select = document.getElementById('patenteSelector');
    select.addEventListener('input', function() {
        var selectedOption = JSON.parse(this.value);
        document.getElementById('txtPatente').value = selectedOption['PATENTE'];
    });
    checkSilla.addEventListener('input', function() {
        recalcularOpcionales();
    });
    checkCobertura.addEventListener('input', function() {
        recalcularOpcionales();
    });

    function buscarDisponibles() {
        var select = document.getElementById('patenteSelector');
        select.value = "0";
        // Get the values of txtRetiro and txtEntrega inputs
        var txtRetiro = $('#FechaDesde').val();
        var txtEntrega = $('#FechaHasta').val();
        var txtHoraRetiro = $('#txtHoraRetiro').val();
        var txtHoraEntrega = $('#txtHoraEntrega').val();

        // Make an AJAX call
        $.ajax({
            type: 'POST',
            url: 'calculardisponibles.php',
            dataType: 'json', // Replace with the path to your PHP script
            data: {
                txtRetiro: txtRetiro,
                txtEntrega: txtEntrega,
                txtHoraRetiro: txtHoraRetiro,
                txtHoraEntrega: txtHoraEntrega
            },
            success: function(response) {
                // Handle the response from the server
                console.log('Response:', response);

                // Assuming the response is a JSON object containing the value of $disponibles
                var disponibles = response;
                autosArray = response;
                select.innerHTML = '';
                var defaultOption = document.createElement('option');
                defaultOption.value = "0";
                defaultOption.text = "Autos disponibles en fechas seleccionadas...";
                select.appendChild(defaultOption);

                // Loop through the array and create an option element for each object
                disponibles.forEach(function(item) {
                    var option = document.createElement('option');
                    option.text = item['PATENTE'] + " - " + item['MARCA'] + " - " + item['MODELO'];
                    option.value = JSON.stringify(item);
                    var patenteSeleccionada = <?php echo isset($reserva["PATENTE"]) ? json_encode($reserva["PATENTE"]) : 'null'; ?>;
                    if (patenteSeleccionada && item['PATENTE'] == patenteSeleccionada) {
                        option.selected = true;
                    }
                    select.appendChild(option);
                });
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error:', error);
            }
        });
    }

    document.getElementById('patenteSelector').addEventListener('change', function() {
        var selectedOption = JSON.parse(this.value);
        document.getElementById('txtModelo').value = selectedOption['MODELO'];
        document.getElementById('preciopordia').value = selectedOption['PRECIO_DIA'];
        document.getElementById('preciototal').value = selectedOption['PRECIO_DIA'];
        recalcularOpcionales();

    });
    document.getElementById('txtMediosDePago').addEventListener('change', function() {
        recalcularOpcionales();
    });

    function recalcularOpcionales() {
        descuentoEfectivo = <?php echo $descuentoEfectivo; ?>;
        cobertura = <?php echo $coberturaPremium; ?>;
        silla = <?php echo $valorSillaBebe; ?>;
        total = 0;
        const preciopordia = document.getElementById('preciopordia').value;
        totalPrecio = parseFloat(preciopordia);




        if (document.getElementById("chkSillaBebe").checked) {
            totalPrecio += silla;

        }

        if (document.getElementById("chkCobertura").checked) {
            totalPrecio += cobertura;
        }


        if (document.getElementById("txtMediosDePago").value == 1) {

            //   descuentoEfectivo=((100-descuento)/100)*precio;
            //   document.getElementById("detalleEfectivo").style.display="flex";
            //   aux=precio-descuentoEfectivo;
            //   document.getElementById("descuentoEfectivo").innerHTML=" - $ "+ format(redondearDecimales(result(aux),0));

            totalPrecio = totalPrecio - (totalPrecio * (descuentoEfectivo / 100));
        }

        total = totalPrecio;
        if (lugarSeleccionado) {

            total += parseFloat(lugarSeleccionado.COSTO);

        }
        document.getElementById('preciototal').value = total;


    }


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
</script>

<?php include('app/footer.php'); ?>