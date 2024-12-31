<?php
// Ruta del archivo XML
$xmlFile = "../corporac07P2-data-model.xml";
// Ruta del archivo CSV de salida
$csvFile = "../corporac07P2-data-model.csv";

// Cargar el archivo XML
$xml = simplexml_load_file($xmlFile) or die("Error al cargar el archivo XML");

// Abrir el archivo CSV para escritura
$csvHandle = fopen($csvFile, 'w') or die("No se pudo crear el archivo CSV");

// Obtener los encabezados del XML (nombres de las etiquetas del primer elemento)
$headers = [];
foreach ($xml->children()[0] as $key => $value) {
    $headers[] = $key;
}

// Escribir los encabezados en el archivo CSV
fputcsv($csvHandle, $headers);

// Escribir los datos
foreach ($xml->children() as $element) {
    $row = [];
    foreach ($element->children() as $value) {
        $row[] = (string)$value;
    }
    fputcsv($csvHandle, $row);
}

// Cerrar el archivo CSV
fclose($csvHandle);

echo "Archivo convertido a CSV con éxito: $csvFile";
