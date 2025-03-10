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
$Documento=DatosLimpitos($_POST['Documento']);
$Localidad=DatosLimpitos($_POST['Localidad']);
$Telefono=DatosLimpitos($_POST['Telefono']);
$Email=DatosLimpitos($_POST['Email']);
$Edad=DatosLimpitos($_POST['Edad']);
$FechaDesde=DatosLimpitos($_POST['FechaDesde']);
$FechaHasta=DatosLimpitos($_POST['FechaHasta']);
$HoraDesde=DatosLimpitos($_POST['HoraDesde']);
$HoraHasta=DatosLimpitos($_POST['HoraHasta']);
$PuntoRetiro=DatosLimpitos($_POST['PuntoRetiro']);
$FormaPago=DatosLimpitos($_POST['FormaPago']);
$Comunicar=DatosLimpitos($_POST['Comunicar']);
$AlquiloEn=DatosLimpitos($_POST['AlquiloEn']);
$Comentarios=DatosLimpitos($_POST['Comentarios']);
$AsuntoEmail=DatosLimpitos($_POST['AsuntoEmail']);

$AsuntoEmail = utf8_decode($AsuntoEmail);


if(isset($_POST['Adicionales'])){
	$checkboxes = isset($_POST['Adicionales']) ? $_POST['Adicionales'] : array();
	foreach ($checkboxes as $value) {
		$Adicionales=$Adicionales." - ".$value;
	}
  
}


//Datos para controlar campos
$REQ_Nombre=1;
$REQ_Telefono=1;
$REQ_Email=1;
$REQ_Comentarios=0;




$SeguimosBien="OK";


//Estos controles van al prioncipio antes de hacer nada, es todo lo que devuelve el MAL
//Controlo los campos para saber si tienen que estar llenos...
if ($REQ_Nombre AND $Nombre=='') $SeguimosBien='Nombre';
if ($REQ_Telefono AND $Telefono=='') $SeguimosBien='Telefono';
if ($REQ_Email AND $Email=='') $SeguimosBien='Email';
if ($REQ_Comentarios AND $Comentarios=='') $SeguimosBien='Comentarios';


//Controlo telefono
if ($Telefono<>""){
	if (strlen($Telefono)<7 OR strlen($Telefono)>15) $SeguimosBien='Telefono';//Corto o largo
	if (ctype_alpha($Telefono)) $SeguimosBien='Telefono'; //todo letras
}




if ($SeguimosBien<>'OK'){
	echo $SeguimosBien;
	exit;
}





//Datos para el envio 
//Cambiar los emails segun correspondan para el tipo de envio q se debe hacer segun se alquila
$LandingEmailPosta="info@3wheels.com.ar"; //Emails cliente separados por COMAS sin espacios
if ($AlquiloEn=="Zona Norte") $LandingEmailPosta="info@3wheels.com.ar";


$LandingEmailOculto=""; //Emails nuestros separados por COMAS sin espacios
$TextoArriba="";
$TextoAbajo="";




//Hago el envio del email
$mensaje = "<html><body><div id='mail_content' style='font-family: font-family: Georgia,\"Times New Roman\",Times,serif; font-size: 15px; color: #444'><h3 style='font-size: 17px; line-height: 18px; font-weight: 700; margin: 0; background-color: #C0B5A7; color: #FFF; padding: 10px ; border-top: 1px solid grey; border-bottom: 1px solid grey;'>" . $AsuntoEmail . "</h3><br /><div>"; 
foreach($_POST as $nombresillo => $valorsillo) {
	$linea = '';
	$nombresillo=trim(str_replace('_'," ",$nombresillo));
	if ($nombresillo<>"AsuntoEmail") $linea = '<div style="padding:5px;border-bottom:1px solid #ddd"><span> '.$nombresillo.': </span><span style="font-size:1.1em;font-weight:700">'.$valorsillo.'</span></div>';
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
mail($LandingEmailPosta, $AsuntoEmail, utf8_decode($mensaje), $cabeceras);


//Sección archivo
try{

   
    $archivo=fopen('DatosPersonales.vcf', 'a') or die("can't open file");

    $vcard="BEGIN:VCARD\n";
    $vcard.="VERSION:3.0\n";
    $vcard.="N:".utf8_decode($Edad).";".utf8_decode($Nombre).";;".$Documento.";\n";
    $vcard.="EMAIL;TYPE=INTERNET;TYPE=HOME:".$Email."\n";
    $vcard.="TEL;TYPE=home:".$Telefono."\n";
    $vcard.="ADR;TYPE=home:;;".$Localidad.";;;;\n";
    $vcard.="ADR;TYPE=work:;;".$PuntoRetiro.";;;;\n";
    $vcard.="BDAY:".date("Y/m/d")."\n";
    
    
    $vcard.="END:VCARD\n";

    fwrite($archivo,$vcard);
    fclose();
 
 } catch (Exception $e) {
 
     echo 'Caught exception: ',  $e->getMessage(), "\n";
     exit;
 
 }



//Termina envio de email
echo $SeguimosBien;
exit;




function DatosLimpitos($dato) { 
    $dato = str_replace("<script>", "", $dato); 
    $dato = str_replace("</script>", "", $dato);
    $dato = str_replace("javascript", "", $dato);
    $dato = str_replace("'", "", $dato);
    $dato = str_replace('"', "", $dato);
    $dato = utf8_encode($dato);
    //$dato = addslashes(mysql_real_escape_string($dato));
    return $dato; 
} 
?>