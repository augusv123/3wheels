<?php 
include('app/header.php');

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h3>Datos de contacto del cotizador</h3>
          
        </div>
        
        <div class="card-body">

       
<?php
$directory = '../'; // Cambia a '../' si los archivos están en un nivel más arriba
// $otro_directorio = '../../'; // Especifica la otra carpeta donde buscar archivos VCF
// $vcf_files = array_merge(glob($directory . "*.vcf"), glob($otro_directorio . "*.vcf"));
// $directory = 'path/to/your/xlsx/files';
$files = glob($directory . '/*.xlsx');

if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = $directory . '/' . $file;

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }
}

echo '<div style="max-height: 400px; overflow: scroll;"><table class="table table-striped">';
foreach ($files as $file) {
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    echo '<thead><tr><th colspan="' . count($data[0]) . '">' . basename($file) . '</th></tr><tr>';
    foreach ($data[0] as $header) {
        echo '<th>' . htmlspecialchars($header) . '</th>';
    }
    echo '</tr></thead><tbody>';
    for ($i = 1; $i < count($data); $i++) {
        echo '<tr>';
        foreach ($data[$i] as $cell) {
            echo '<td>' . htmlspecialchars($cell) . '</td>';
        }
        echo '</tr>';
    }
    echo '</tbody>';
}
echo '</table></div>';
echo "<a href='$file' class='btn btn-success' download>Descargar " . basename($file) . "</a>";
 include('app/footer.php'); ?>
    </div>
    </div>
 </section>