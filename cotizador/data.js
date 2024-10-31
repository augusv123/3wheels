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
	Telefono = "";
	Email = "";
	Mensaje = "";



	if (document.formulario.Nombre  != null){Nombre = document.formulario.Nombre.value;}
	if (document.formulario.Telefono  != null){Telefono = document.formulario.Telefono.value;}
	if (document.formulario.Email  != null){Email = document.formulario.Email.value;}
	if (document.formulario.Mensaje  != null){Mensaje = document.formulario.Mensaje.value;}

	LinkGracias = document.formulario.LinkGracias.value;
	AsuntoEmail = document.formulario.AsuntoEmail.value;
	


	ajax1 = objetoAjax();


    ajax1.onreadystatechange  = function()
    { 
         if(ajax1.readyState  == 4)
         {

         	//alert("Received:"  + ajax1.responseText); 
	if (ajax1.responseText.trim() == 'OK') {setTimeout(function() {window.location.href = LinkGracias;}, 1000);} else {alert("Por favor complete el campo - "  + ajax1.responseText);}


              //if(ajax1.status  == 200) 
                  //alert("Received:"  + ajax1.responseText); 
              //else
                 //alert("Error code " + ajax1.status);
         }
    }; 

	ajax1.open("POST", "insert.php", true);
	ajax1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	ajax1.send("Nombre="+Nombre+"&Email="+Email+"&Telefono="+Telefono+"&Mensaje="+Mensaje+"&AsuntoEmail="+AsuntoEmail);

}
