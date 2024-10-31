var myParam = location.search.split('error=')[1];
if (myParam){alert("Ocurrio un error intente nuevamente");}


function objetoAjax(){
	var xmlhttp = false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


function enviarDatosCotizar(){

  
	Nombre = "";
	Localidad = "";
	Telefono = "";
	Email = "";
	FechaDesde = "";
	FechaHasta = "";
	HoraDesde = "";
	HoraHasta = "";
	PuntoRetiro = "";
        RecibirRespuesta="";

        if(document.formularioCotizar.Comunicar1.checked)RecibirRespuesta='Télefono';
        if(document.formularioCotizar.Comunicar2.checked)RecibirRespuesta='Whatsapp';
        if(document.formularioCotizar.Comunicar3.checked)RecibirRespuesta='Email';
	

	if (document.formularioCotizar.Nombre  != null){Nombre = document.formularioCotizar.Nombre.value;}
	if (document.formularioCotizar.Localidad  != null){Localidad = document.formularioCotizar.Localidad.value;}
	if (document.formularioCotizar.Telefono  != null){Telefono = document.formularioCotizar.Telefono.value;}
	if (document.formularioCotizar.Email  != null){Email = document.formularioCotizar.Email.value;}
	if (document.formularioCotizar.Edad  != null){Edad = document.formularioCotizar.Edad.value;}
	if (document.formularioCotizar.FechaDesde  != null){FechaDesde = document.formularioCotizar.FechaDesde.value;}
	if (document.formularioCotizar.FechaHasta  != null){FechaHasta = document.formularioCotizar.FechaHasta.value;}
	if (document.formularioCotizar.HoraDesde  != null){HoraDesde = document.formularioCotizar.HoraDesde.value;}
	if (document.formularioCotizar.HoraHasta  != null){HoraHasta = document.formularioCotizar.HoraHasta.value;}
	if (document.formularioCotizar.PuntoRetiro  != null){PuntoRetiro = document.formularioCotizar.PuntoRetiro.value;}



	LinkGracias = document.formularioCotizar.LinkGracias.value;
	AsuntoEmail = document.formularioCotizar.AsuntoEmail.value;
	

    var Adicionales = document.getElementsByName('Adicionales[]');
    var len = Adicionales.length;
    for (var i=0; i<len; i++) {
    	if (Adicionales[i].checked){Adicionales2 = Adicionales2 + " - " + Adicionales[i].value;}
    }


	ajax1 = objetoAjax();


    ajax1.onreadystatechange  = function() {  if(ajax1.readyState  == 4) {

         	//alert("Received:"  + ajax1.responseText); 
	if (ajax1.responseText.trim() == 'OK') {setTimeout(function() {window.location.href = LinkGracias;}, 1000);} else {alert("Por favor complete el campo - "  + ajax1.responseText);}


              //if(ajax1.status  == 200) 
                  //alert("Received:"  + ajax1.responseText); 
              //else
                 //alert("Error code " + ajax1.status);
         }
    }; 

	ajax1.open("POST", "insertCotizar.php", true);
	ajax1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 
   datosEnviar="Nombre="+Nombre+"&Localidad="+Localidad+"&Email="+Email+"&Telefono="+Telefono+"&FechaDesde="+FechaDesde+"&FechaHasta="+FechaHasta+"&HoraDesde="+HoraDesde+"&HoraHasta="+HoraHasta+"&PuntoRetiro="+PuntoRetiro+"&AsuntoEmail="+AsuntoEmail+"&RecibirRespuesta="+RecibirRespuesta;

ajax1.send(datosEnviar);

}