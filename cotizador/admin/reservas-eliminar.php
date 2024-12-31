<?php
session_start();
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('./app/database.php');

if (isset($_POST["id"])) {
    $reservaId = intval($_POST["id"]);
    
    // Llamar al procedimiento almacenado para eliminar la reserva
    $resultado = sp_exec("RESERVAS_ELIMINAR($reservaId)");
    if ($resultado) {
        echo '1';
    } else {
        echo '0';
    }
} else {
    echo '0';
}
?>