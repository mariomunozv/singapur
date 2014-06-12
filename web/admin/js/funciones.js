function val_obligatorio(campo){
	$("#"+campo).removeClass("alertar");
	var valor = document.getElementById(campo+"").value + ""; 
	if(valor == ""){
		$("#"+campo).addClass("alertar");
		alert("Indique todos los campos obligatorios.");
		document.getElementById(campo+"").focus();
		return false;
	}
	return true;
}


function simbolos(a){

	do{
		a = a.replace('+','%2B');
		a = a.replace('%u2013','-');
	}
	while(a.indexOf('+') >= 0 || a.indexOf('%u2013') >= 0);

	return a;

}