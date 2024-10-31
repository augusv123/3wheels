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


function enviarDatosPopup(){


  
	Name = "";
	Tel = "";
	
  

	if (document.formularioPopup.Name  != null){Name = document.formularioPopup.Name.value;}
	if (document.formularioPopup.Tel  != null){Tel = document.formularioPopup.Tel.value;}
	



	Gracias = document.formularioPopup.Gracias.value;
	Asunto = document.formularioPopup.Asunto.value;
	

    var Adicionales = document.getElementsByName('Adicionales[]');
    var len = Adicionales.length;
    for (var i=0; i<len; i++) {
    	if (Adicionales[i].checked){Adicionales2 = Adicionales2 + " - " + Adicionales[i].value;}
    }


	ajax1 = objetoAjax();


    ajax1.onreadystatechange  = function() {  if(ajax1.readyState  == 4) {

         	//alert("Received:"  + ajax1.responseText); 
	if (ajax1.responseText.trim() == 'OK') {setTimeout(function() {window.location.href = Gracias;}, 1000);} else {alert("Por favor complete el campo - "  + ajax1.responseText);}


              //if(ajax1.status  == 200) 
                  //alert("Received:"  + ajax1.responseText); 
              //else
                 //alert("Error code " + ajax1.status);
         }
    }; 

	ajax1.open("POST", "insertPopup.php", true);
	ajax1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 
   datosEnviar="Name="+Name+"&Tel="+Tel+"&Asunto="+Asunto;

ajax1.send(datosEnviar);

}