<?php
require_once('./tcpdf/tcpdf.php');

class PDFGenerator {
    public function generatePDFs($disponibles) {
        ob_start(); 
        $pdf = new TCPDF();
        $pdf->AddPage();
        $html = '';
        foreach ($disponibles as $auto) {
            // Inicializa TCPDF para cada auto

            // Captura el HTML de la tarjeta de cada auto
            $html .= '
            <div class="card border my-3">
                <div class="card-body py-4 px-0">
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex align-items-left">
                                <div class="ms-3 name">
                                    <h5 class="font-bold">' . htmlspecialchars($auto["MODELO"]) . '</h5>
                                    <h6 class="text-muted mb-0">' . htmlspecialchars($auto["MARCA"]) . ' - Total $' . htmlspecialchars($auto["PRECIO"]) . ' - ' . htmlspecialchars($auto["CANTIDAD"]) . ' dias</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <img class="img-fluid" src="' . htmlspecialchars($auto["IMAGEN"]) . '" width="150" alt="">
                        </div>
                    </div>
                </div>
            </div>';

        }
        // Añade el HTML al PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Define el nombre del archivo usando el modelo del auto
        $fileName = 'cotizacion_' . $auto["MODELO"] . '.pdf';
        ob_end_clean();
        // Guarda cada PDF individualmente
        $pdf->Output($fileName, 'D'); 
    }
}
