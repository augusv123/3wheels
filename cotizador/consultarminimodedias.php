<?php
include('admin/app/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Convertir las entradas a cadenas de texto y sanitizarlas
    $txtDesde = isset($_POST['txtDesde']) ? strval($_POST['txtDesde']) : '';
    $txtHasta = isset($_POST['txtHasta']) ? strval($_POST['txtHasta']) : '';

    // Si es necesario, puedes añadir más validaciones o controles aquí
    if (empty($txtDesde) || empty($txtHasta)) {
        echo json_encode(['error' => 'Faltan parámetros']);
        exit;
    }

    // Construir los argumentos correctamente
    $argumentos = "'" . $txtDesde . "', '" . $txtHasta . "'";

    // Ejecutar la consulta
    $consulta_min_dias = sp("MIN_ALQUILER_CONSULTAR($argumentos)");

    $min_dias = 3; // Valor por defecto

    if ($consulta_min_dias) {
        $min_dias = $consulta_min_dias[0]['valor'];
    }
    
    // Devolver el mínimo de días como JSON
    echo json_encode(['min_dias' => $min_dias]);
    exit; // Asegúrate de salir después de enviar la respuesta
}
