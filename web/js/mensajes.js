
function muestraListadoParaMensaje(){  
	var division = document.getElementById("listadoParaMensaje");
	AJAXPOST("mensajesListado.php","",division);  
}


function nuevoMensaje(idUsuarioDestino){  
	var division = document.getElementById("nuevoMensaje");
	AJAXPOST("nuevoMensajeMasivo.php","idUsuarioDestino="+idUsuarioDestino,division);  
}

function responderMensaje(idMensaje){  
	var division = document.getElementById("nuevoMensaje");
	AJAXPOST("nuevoMensajeMasivo.php","idMensaje="+idMensaje,division);  
} 

function agregarDestinatario(idUsuarioDestino){	
	var division = document.getElementById("destinatarios");
	AJAXPOST("destinatarios.php","idUsuario="+idUsuarioDestino,division);  
}

function mostrarDestinatarios(){
	var division = document.getElementById("destinatarios");
	AJAXPOST("destinatarios.php","",division);  
}

function mostrarRecibidos(){
	var division = document.getElementById("bandeja");
	AJAXPOST("mensajesRecibidos.php","",division);  
}

function mostrarEnviados(){
	var division = document.getElementById("bandeja");
	AJAXPOST("mensajesEnviados.php","",division);  
}

function sacarDestinatario(idUsuarioDestino){
	var division = document.getElementById("destinatarios");
	AJAXPOST("destinatarios.php","idUsuario=-"+idUsuarioDestino,division);
}

function enviarMsj(){
	//if(val_obligatorio("para") == false){ return; }  
	if(val_obligatorio("asunto") == false){ return; }  
	if(val_obligatorio("mensaje2") == false){ return; } 
	if(confirm("¿Enviar ahora?")){
		var a = $(".campos").fieldSerialize(); 
		var division = document.getElementById("nuevoMensaje");
		AJAXPOST("enviaMensaje.php",a,division);  
	}
}

