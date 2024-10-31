<?php 

//Datos del explorador del contacto
$HostCliente = gethostbyaddr($_SERVER[REMOTE_ADDR]);
$IPCliente= $_SERVER[REMOTE_ADDR];
$BrowserCliente= $_SERVER[HTTP_USER_AGENT];
$ReferidoCliente= $_SERVER[HTTP_REFERER];

$primer = explode('tag=', $ReferidoCliente);
$TagsCliente= $primer[1];


//Datos que completo el contacto
$Nombre=DatosLimpitos($_POST['Nombre']);
$Telefono=DatosLimpitos($_POST['Telefono']);
$Email=DatosLimpitos($_POST['Email']);
$Mensaje=DatosLimpitos($_POST['Mensaje']);
$AsuntoEmail=DatosLimpitos($_POST['AsuntoEmail']);



//Datos para controlar campos
$REQ_Nombre=1;
$REQ_Telefono=1;
$REQ_Email=1;
$REQ_Mensaje=0;




$SeguimosBien="OK";


//Estos controles van al prioncipio antes de hacer nada, es todo lo que devuelve el MAL
//Controlo los campos para saber si tienen que estar llenos...
if ($REQ_Nombre AND $Nombre=='') $SeguimosBien='Nombre';
if ($REQ_Telefono AND $Telefono=='') $SeguimosBien='Telefono';
if ($REQ_Email AND $Email=='') $SeguimosBien='Email';
if ($REQ_Mensaje AND $Mensaje=='') $SeguimosBien='Mensaje';


//Controlo telefono
if ($Telefono<>""){
	if (strlen($Telefono)<7 OR strlen($Telefono)>15) $SeguimosBien='Telefono';//Corto o largo
	if (ctype_alpha($Telefono)) $SeguimosBien='Telefono'; //todo letras
}




if ($SeguimosBien<>'OK'){
	echo $SeguimosBien;
	exit;
}


$LandingEmailPosta="info@3wheels.com.ar"; //Emails cliente separados por COMAS sin espacios   


//Datos para el envio
$LandingEmailOculto=""; 
$TextoArriba="";
$TextoAbajo="";




//Hago el envio del email
$mensaje = "<h3 style='font-size: 17px; line-height: 18px; font-weight: 700; margin: 0; background-color: #C0B5A7; color: #FFF; padding: 10px ; border-top: 1px solid grey; border-bottom: 1px solid grey;'>" . $AsuntoEmail . "</h3><br /><div>"; 
foreach($_POST as $nombresillo => $valorsillo) {
	$linea = '';
	$nombresillo=trim(str_replace('_'," ",$nombresillo));
	if ($nombresillo<>"AsuntoEmail") $linea = '<div style="padding:5px;border-bottom:1px solid #ddd"><span> '.$nombresillo.': </span><span style="font-size:1.1em;font-weight:700">'.$valorsillo.'</span></div>';
	$mensaje .= $linea; 
}

$mensaje .= "</div><br />"; 



// Cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: '.$LandingEmailPosta."\r\n";
$cabeceras .= 'From: '.$Nombre.' <'.$Email.'>' . "\r\n";

// Enviarlo
mail($LandingEmailPosta, $AsuntoEmail, $mensaje, $cabeceras);



// Cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: '.$LandingEmailOculto."\r\n";
$cabeceras .= 'From: '.$Nombre.' <'.$Email.'>' . "\r\n";

// Enviarlo
mail($LandingEmailOculto, $AsuntoEmail, $mensaje, $cabeceras);

//Termina envio de email
echo $SeguimosBien;
exit;




function DatosLimpitos($dato) { 
    $dato = str_replace("<script>", "", $dato); 
    $dato = str_replace("</script>", "", $dato);
    $dato = str_replace("javascript", "", $dato);
    $dato = str_replace("'", "", $dato);
    $dato = str_replace('"', "", $dato);
    //$dato = addslashes(mysql_real_escape_string($dato));
    return $dato; 
} 
?>