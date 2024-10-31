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





function enviarDatos(){
	Nombre = "";
	Documento = "";
	Localidad = "";
	Telefono = "";
	Email = "";
	Edad = "";
	FechaDesde = "";
	FechaHasta = "";
	HoraDesde = "";
	HoraHasta = "";
	PuntoRetiro = "";
	FormaPago = "";
	AlquiloEn = "";
	Comunicar = "";
	Adicionales2 = "";
	Comentarios = "";



	if (document.formulario.Nombre  != null){Nombre = document.formulario.Nombre.value;}
	if (document.formulario.Documento  != null){Documento = document.formulario.Documento.value;}
	if (document.formulario.Localidad  != null){Localidad = document.formulario.Localidad.value;}
	if (document.formulario.Telefono  != null){Telefono = document.formulario.Telefono.value;}
	if (document.formulario.Email  != null){Email = document.formulario.Email.value;}
	if (document.formulario.Edad  != null){Edad = document.formulario.Edad.value;}
	if (document.formulario.FechaDesde  != null){FechaDesde = document.formulario.FechaDesde.value;}
	if (document.formulario.FechaHasta  != null){FechaHasta = document.formulario.FechaHasta.value;}
	if (document.formulario.HoraDesde  != null){HoraDesde = document.formulario.HoraDesde.value;}
	if (document.formulario.HoraHasta  != null){HoraHasta = document.formulario.HoraHasta.value;}
	if (document.formulario.PuntoRetiro  != null){PuntoRetiro = document.formulario.PuntoRetiro.value;}
	if (document.formulario.FormaPago  != null){FormaPago = document.formulario.FormaPago.value;}
	if (document.formulario.AlquiloEn  != null){AlquiloEn = document.formulario.AlquiloEn.value;}
	if (document.formulario.Comunicar  != null){Comunicar = document.formulario.Comunicar.value;}
	
	if (document.formulario.Comentarios  != null){Comentarios = document.formulario.Comentarios.value;}

	LinkGracias = document.formulario.LinkGracias.value;
	AsuntoEmail = document.formulario.AsuntoEmail.value;
	

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

	ajax1.open("POST", "insert2.php", true);
	ajax1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	ajax1.send("Nombre="+Nombre+"&Documento="+Documento+"&Localidad="+Localidad+"&Email="+Email+"&Telefono="+Telefono+"&Edad="+Edad+"&FechaDesde="+FechaDesde+"&FechaHasta="+FechaHasta+"&HoraDesde="+HoraDesde+"&HoraHasta="+HoraHasta+"&PuntoRetiro="+PuntoRetiro+"&FormaPago="+FormaPago+"&AlquiloEn="+AlquiloEn+"&Comunicar="+Comunicar+"&Adicionales="+Adicionales2+"&Comentarios="+Comentarios+"&AsuntoEmail="+AsuntoEmail);

}
