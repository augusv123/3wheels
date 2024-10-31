<?php 

//Datos del explorador del contacto
$HostCliente = gethostbyaddr($_SERVER[REMOTE_ADDR]);
$IPCliente= $_SERVER[REMOTE_ADDR];
$BrowserCliente= $_SERVER[HTTP_USER_AGENT];
$ReferidoCliente= $_SERVER[HTTP_REFERER];

$primer = explode('tag=', $ReferidoCliente);
$TagsCliente= $primer[1];


//Datos que completo el contacto
$Name=DatosLimpitos($_POST['Name']);
$Tel=DatosLimpitos($_POST['Tel']);
$Asunto=DatosLimpitos($_POST['Asunto']);
$Asunto = utf8_decode($Asunto);


//Datos para controlar campos
$REQ_Name=1;
$REQ_Tel=1;





$SeguimosBien="OK";


//Estos controles van al prioncipio antes de hacer nada, es todo lo que devuelve el MAL
//Controlo los campos para saber si tienen que estar llenos...
if ($REQ_Name AND $Name=='') $SeguimosBien='Name';
if ($REQ_Tel AND $Tel=='') $SeguimosBien='Tel';



//Controlo telefono
if ($Tel<>""){
	if (strlen($Tel)<7 OR strlen($Tel)>15) $SeguimosBien='Tel';//Corto o largo
	if (ctype_alpha($Tel)) $SeguimosBien='Tel'; //todo letras
}




if ($SeguimosBien<>'OK'){
	echo $SeguimosBien;
	exit;
}





//Datos para el envio info@3wheels.com.ar
$LandingEmailPosta="info@3wheels.com.ar"; //Emails cliente separados por COMAS sin espacios
$LandingEmailOculto=""; //Emails nuestros separados por COMAS sin espacios
$TextoArriba="";
$TextoAbajo="";




//Hago el envio del email
$mensaje = "<html><body><div id='mail_content' style='font-family: font-family: Georgia,\"Times New Roman\",Times,serif; font-size: 15px; color: #444'><h3 style='font-size: 17px; line-height: 18px; font-weight: 700; margin: 0; background-color: #C0B5A7; color: #FFF; padding: 10px ; border-top: 1px solid grey; border-bottom: 1px solid grey;'>" . $Asunto . "</h3><br /><div>"; 
foreach($_POST as $nombresillo => $valorsillo) {
	$linea = '';
	$nombresillo=trim(str_replace('_'," ",$nombresillo));
	if ($nombresillo<>"Asunto") $linea = '<div style="padding:5px;border-bottom:1px solid #ddd"><span> '.$nombresillo.': </span><span style="font-size:1.1em;font-weight:700">'.$valorsillo.'</span></div>';
	$mensaje .= $linea; 
}

$mensaje .= "</div><br /></div></body></html>"; 



// Cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: '.$LandingEmailPosta."\r\n";
$cabeceras .= 'From: Formulario 3W <info@3wheels.com.ar>' . "\r\n";
$cabeceras .= 'Bcc: '.$LandingEmailOculto."\r\n";

// Enviarlo
mail($LandingEmailPosta, $Asunto, $mensaje, $cabeceras);


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