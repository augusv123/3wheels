<?php 

function sp($sp){

  $usuario = "root";
  $password = "";
  $servidor = "localhost";
  $basededatos = "horaci15_cotizador";
  $conexion = mysqli_connect( $servidor, $usuario, $password  ) or die ("Error al conectar con la base de datos - 00");
  $db = mysqli_select_db( $conexion, $basededatos ) or die ( "Error al conectar con la base de datos - 01" );
  $consulta ="call ".$sp;
  $resultado = mysqli_query( $conexion, $consulta );

  logueo($resultado,$conexion,$sp);

  $data = array();

  while ($row = mysqli_fetch_array($resultado)){
    $data[] = $row;
  }

  mysqli_free_result($resultado); 
  mysqli_close( $conexion );
  
  return $data;
}

function sp_exec($sp){

  $usuario = "root";
  $password = "";
  $servidor = "localhost";
  $basededatos = "horaci15_cotizador";
    $conexion = mysqli_connect( $servidor, $usuario, $password  ) or die ("Error al conectar con la base de datos - 00");
    $db = mysqli_select_db( $conexion, $basededatos ) or die ( "Error al conectar con la base de datos - 01" );
    $consulta ="call ".$sp;
    $resultado=mysqli_query( $conexion, $consulta );
    
    logueo($resultado,$conexion,$sp);

    mysqli_close( $conexion );
    
    return $resultado;
  }


  function logueo($resultado,$conexion, $sp){

    $tipo="info-";
    if(!$resultado)$tipo="error-";
    $date = date('m/d/Y h:i:s a', time());
    $txt = $tipo.$date." -".mysqli_error($conexion)."  ".$sp;
    $myfile = file_put_contents('logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);

  }
  
?>



