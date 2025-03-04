<?php include('app/header.php');
require_once('./tcpdf/tcpdf.php');
include_once('PDFGenerator.php');
setlocale(LC_MONETARY, "es_RA");
$lugares_de_retiro = sp('VerTodosLosLugaresRetiro()');
function formatearFecha($fechaString) {
    // Crear un objeto DateTime a partir de la cadena
    $fecha = DateTime::createFromFormat('Y-m-d', $fechaString);
    
    // Formatear la fecha en el formato deseado
    return $fecha->format('d/m/Y');
}
try {

    $entrega = "";
    $retiro = "";
    $cantidad = "";

    if (!empty($_POST["fechaRetiro"])) {

        $retiro = htmlspecialchars($_POST["fechaRetiro"]);
        $entrega = htmlspecialchars($_POST["fechaEntrega"]);

        $date1 = new DateTime($retiro);
        $date2 = new DateTime($entrega);
        $interval = $date1->diff($date2);

        $horaRetiro = htmlspecialchars($_POST["selHoraRetiro"]);
        $horaEntrega = htmlspecialchars($_POST["selHoraEntrega"]);

        $horasExcedentes = (strtotime($horaEntrega) - strtotime($horaRetiro)) / 3600;


        $cantidad = $interval->days;

        if ($horasExcedentes > 5) {
            $cantidad = $cantidad + 1;
        }
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['form_type']) && $_POST['form_type'] === 'generate_pdfs') {
        // Recupera y decodifica el JSON de autos
        $autos = json_decode($_POST['autos_json'], true);
        
        // Verifica si la decodificación fue exitosa
        if ($autos !== null) {
            // Crea la instancia de PDFGenerator y genera los PDFs
            $pdfGenerator = new PDFGenerator();
            $pdfGenerator->generatePDFs($autos);
            echo "PDFs generados exitosamente.";
        } else {
            echo "Error al decodificar los datos de los autos.";
        }
    }
}

?>

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Cotizador</h3>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST">
                        <input type="hidden" name="form_type" value="cotizar">
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="row">
                                        <div class="col-6 ">
                                            <div class="form-group">
                                                <label for="city-column">Fecha retiro</label>
                                                <input type="date" class="form-control" placeholder="" name="fechaRetiro" id="txtDatedesde" value="<?php echo $retiro; ?>">
                                            </div>
                                        </div>

                                        <div class="col-6 ">
                                            <div class="form-group">
                                                <label for="city-column">Hora retiro</label>
                                                <select class="form-select" name="selHoraRetiro" id="selHoraRetiro">
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
                                    </div>
                                    <div class="row">
                                        <div class="col-6 ">
                                            <div class="form-group">
                                                <label for="city-column">Fecha entrega</label>
                                                <input type="date" class="form-control" placeholder="" name="fechaEntrega" id="txtDate" value="<?php echo $entrega; ?>">
                                            </div>
                                        </div>

                                        <div class="col-6 ">
                                            <div class="form-group">
                                                <label for="city-column">Hora entrega</label>
                                                <select class="form-select" name="selHoraEntrega" id="selHoraEntrega">
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
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city-column">Lugar de retiro</label>
                                                <select id="txtLugar" class="form-select" name="txtLugar" required style="max-width: 100%;">
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
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="requisitosTextArea"> Mensaje de cotización</label>
                                            <textarea id="requisitosTextArea" style="width: 100%; height: 200px;">
                                                Requisitos para el alquiler: <br>
                                                🔹 Las tarifas incluyen seguro (consulte también por nuestro seguro Premium), kilometraje ilimitado y conductor adicional sin cargo.<br>
                                                🔸 Los requisitos son ser mayor de 25 años, DNI, licencia de conducir, tarjeta de crédito y un comprobante de límite de crédito de la tarjeta para constatar que tenga el crédito suficiente ($1.200.000) para afrontar el pago de la garantía en caso de accidente y/o siniestro. <br> 
                                                🔹 La reserva se realiza enviando la documentación correspondiente a través de este medio o en nuestras oficinas de Shopping Via Pilar Local 38: R. Caamaño 1103 B1631 Villa Rosa, Provincia de Buenos Aires<br>
                                                ✳️ Una vez aprobada la documentación puede abonar el total del alquiler o reservar con $100.000 y abonar el resto al momento de la entrega.
                                                Desde ya agradecemos que nos haya contactado. Quedamos a disposición ante cualquier inquietud. Saludos!! 🚘
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button onclick="clearTextArea()" type="button" class="btn btn-light-secondary me-1 mb-1">Borrar Mensaje</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Cotizar</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="mi-seccion" class="col-md-12 col-12" style="height:50vh;overflow:hidden;overflow-y:scroll">
                                    <div style="padding:10px; position: sticky;top:0px;z-index:400;background-color:white;border-bottom:1px solid gray ">
                                       
                                        <h4>Cotización  </h4>
                                        <p>
                                            <?php if($entrega) { 
                                                echo 'desde: '.formatearFecha($retiro);
                                             ?>
                                        </p>
                                        <p>
                                            hasta <?php echo formatearFecha($entrega); }  ?>
                                        </p>
                                    </div>

                                    <?php
                                    if ($entrega != "") {
                                        $disponibles = sp("RESERVAS_DISPONIBILIDAD('" . $entrega . "','" . $retiro . "')");

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

                                        if (count($disponibles) == 0) {
                                            echo "No hay autos disponibles para las fechas seleccionadas";
                                        };
                                        $unique_disponibles = [];
                                        $seen_models = [];
                                      
                                        foreach ($disponibles as $auto) {
                                          if (!in_array($auto['MODELO'], $seen_models)) {
                                            $unique_disponibles[] = $auto;
                                            $seen_models[] = $auto['MODELO'];
                                          }
                                        }
                                      
                                        $disponibles = $unique_disponibles;
                                        foreach ($disponibles as $auto) {
                                            $cotizacion = sp("RESERVAS_COTIZAR_V3(" . $cantidad . ",'" . $auto["MODELO"] . "','" . $retiro . "')");

                                            $precioTotal = "0";

                                            if (count($cotizacion) > 0) {
                                                $precioTotal = $cotizacion[0]["PRECIO"];
                                                $precioTotal += $lugar_costo;
                                            };


                                            $disponibles[$indice]["PRECIO"] = $precioTotal;
                                            $disponibles[$indice]["CANTIDAD"] = $cantidad;
                                            $indice = $indice + 1;
                                    ?>
                                            <!-- Desde aca -->
                                            <div class="card border my-3">
                                                <div class="card-body py-4 px-0">
                                                    <div class="row">
                                                        <div class="col-md-8 col-12">
                                                            <div class="d-flex align-items-left">

                                                                <div class="ms-3 name">
                                                                    <h6 class="font-bold"><?php echo $auto["MARCA"]. ' - ' . $auto["MODELO"]." - " . $cantidad . " días"; ?></h6>
                                                                    <p class="text-muted mb-0"><?php echo  " - Precio con tarjeta: $" . $precioTotal  ?></p>
                                                                    <p class="text-muted mb-0"><?php echo  " - Precio transferencia bancaria: $" . ($precioTotal * 0.9)  ?></p>
                                                                    <p class="text-muted mb-0"><?php echo  " - Precio en efectivo: $" . ($precioTotal * 0.85)  ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-12 d-flex justify-content-center">
                                                            <img class="img-fluid" src="<?php echo $auto["IMAGEN"] ?>" width="150" alt="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- Hhasta aca -->

                                    <?php
                                        }
                                        ?>
                                        <div class="col-12">
                                            <p id="requisitos">
                                                Requisitos para el alquiler: <br>
                                               🔹 Las tarifas incluyen seguro (consulte también por nuestro seguro Premium), kilometraje ilimitado y conductor adicional sin cargo.<br>
                                               🔸 Los requisitos son ser mayor de 25 años, DNI, licencia de conducir, tarjeta de crédito y un comprobante de límite de crédito de la tarjeta para constatar que tenga el crédito suficiente ($1.200.000) para afrontar el pago de la garantía en caso de accidente y/o siniestro. <br> 
                                               🔹 La reserva se realiza enviando la documentación correspondiente a través de este medio o en nuestras oficinas de Shopping Via Pilar Local 38: R. Caamaño 1103 B1631 Villa Rosa, Provincia de Buenos Aires<br>
                                               ✳️ Una vez aprobada la documentación puede abonar el total del alquiler o reservar con $100.000 y abonar el resto al momento de la entrega.
                                               Desde ya agradecemos que nos haya contactado. Quedamos a disposición ante cualquier inquietud. Saludos!! 🚘
                                            </p>
                                        </div>
                                        <?php
                                        $jsonAutos = json_encode($disponibles);
                                    }

                                    ?>


                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                <button type="button" id="descargar2" onClick="generarPDF()"  class="btn btn-success mx-3">Descargar cotizacion</button>
                                <button type="button" id="descargar2" onClick="compartirPDF()"  class="btn btn-success">Compartir cotizacion
                                </button>
                                </div>


                                
                            </div>
                        </form>
           
                        <!-- <form class="form" method="POST">
                        <input type="hidden" name="form_type" value="generate_pdfs">
                            <input type="hidden" id="autos_json" name="autos_json" value='<?= $jsonAutos ?>'>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit"  class="btn btn-success">Descargar cotizacion</button>
                            </div>
                        </form> -->






                    </div>
                </div>
            </div>
        </div>



    </div>
</section>

<style>

</style>

<script>
    try {

    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10)
        month = '0' + month.toString();
    if (day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;


    document.getElementById("txtDate").setAttribute('min', maxDate);

    document.getElementById("selHoraRetiro").value = "<?php echo $horaRetiro ?>";
    document.getElementById("selHoraEntrega").value = "<?php echo $horaEntrega ?>";
}
catch(error){
    console.log('error')
}
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const textArea = document.getElementById("requisitosTextArea");
    const requisitosParagraph = document.getElementById("requisitos");

    // Set initial content to the paragraph
    requisitosParagraph.innerHTML = textArea.value;

    // Update paragraph content when textarea value changes
    textArea.addEventListener("input", () => {
      requisitosParagraph.innerHTML = textArea.value;
    });
});

function clearTextArea(){
    const textArea = document.getElementById("requisitosTextArea");
    const requisitosParagraph = document.getElementById("requisitos");

    requisitosParagraph.innerHTML = '';
    textArea.value = '';
}
function generarPDF() {
    const { jsPDF } = window.jspdf || {};

    if (jsPDF) {
        const element = document.getElementById('mi-seccion');
        const originalHeight = element.style.height;
        const originalOverflow = element.style.overflow;

        element.style.height = 'auto';
        element.style.overflow = 'visible';

        html2canvas(element, { scale: 2, useCORS: true }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdfWidth = 595.28; // Ancho estándar de A4 en puntos
            const pdfHeight = (canvas.height * pdfWidth) / canvas.width; // Calcular altura proporcional

            // Crear PDF con una sola página del tamaño del contenido
            const pdf = new jsPDF('p', 'pt', [pdfWidth, pdfHeight]);
            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);

            // Guardar el archivo PDF
            pdf.save("documento.pdf");

            // Restaurar el estilo original
            element.style.height = originalHeight;
            element.style.overflow = originalOverflow;
        });
    } else {
        console.error("jsPDF no se ha cargado correctamente.");
    }
}

function compartirPDF() {
    const { jsPDF } = window.jspdf || {};

    if (jsPDF) {
        const element = document.getElementById('mi-seccion');
        const originalHeight = element.style.height;
        const originalOverflow = element.style.overflow;

        element.style.height = 'auto';
        element.style.overflow = 'visible';

        html2canvas(element, { scale: 2, useCORS: true }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdfWidth = 595.28; // Ancho estándar de A4 en puntos
            const pdfHeight = (canvas.height * pdfWidth) / canvas.width; // Calcular altura proporcional

            // Crear PDF con una sola página del tamaño del contenido
            const pdf = new jsPDF('p', 'pt', [pdfWidth, pdfHeight]);
            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);

      // Generar el archivo PDF como blob
      const pdfBlob = pdf.output('blob');
            const file = new File([pdfBlob], "documento.pdf", { type: "application/pdf" });

            // Usar Web Share API
            if (navigator.share) {
                navigator
                    .share({
                        title: "Compartir PDF",
                        text: "Te comparto este documento PDF.",
                        files: [file], // Adjuntar el archivo
                    })
                    .then(() => console.log("Compartido exitosamente"))
                    .catch(err => console.error("Error al compartir:", err));
            } else {
                alert("Tu navegador no soporta compartir archivos.");
            }

            // Restaurar el estilo original
            element.style.height = originalHeight;
            element.style.overflow = originalOverflow;
        });
    } else {
        console.error("jsPDF no se ha cargado correctamente.");
    }
}

  </script>

    
<?php include('app/footer.php'); ?>