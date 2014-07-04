<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<link href='suim/style.css' rel='stylesheet' type='text/css' />
<link href="css/custom-theme/jquery-ui-1.8rc3.custom.css" type="text/css" rel="stylesheet" />	
<link href="css/botones.css" rel="stylesheet" type="text/css" />
<link href="css/tabla.css" rel="stylesheet" type="text/css" />
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<!--<link href="css/ecuaciones.css" rel="stylesheet" type="text/css" />	-->

  


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>  
<script type="text/javascript" src="js/main.js"></script> 
<!--<script type="text/javascript" src="js/pngfix.js"></script>  --> 
<!--<script type="text/javascript" src="js/tag.js"></script> -->
<!--<script type="text/javascript" src="js/jquery.tablesorter.js"></script> -->
<!--<script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>   -->
<!--<script type="text/javascript" src="js/validarut.js"></script>-->
<!--<script src="js/jquery-1.6.2.js"></script>-->
<!--<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>-->
<!--<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>-->
<script src="js/jquery.collapse.js"></script>

<!--<script type="text/javascript" src="js/jquery-ui-1.8rc3.custom.min.js"></script>-->


<!--<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>-->
<!--<script type="text/javascript" src="js/jquery.jqupload.min.js"></script>-->
<!--<script type="text/javascript" src="js/mensajes.js"></script> -->


<script src='suim/application.js' type='text/javascript'></script>
<script src='suim/suim.js' type='text/javascript'></script>
<script src='suim/symbols.js' type='text/javascript'></script>

<script>document.documentElement.className = "js";</script>

<script language="javascript">
var MsjTipico = "<center><img src='img/loading.gif' alt='Cargando'><br>Cargando</center>";

function val_obligatorio(campo){
	jQuery("#"+campo).removeClass("alertar");
	var valor = document.getElementById(campo+"").value + ""; 
	if(valor == ""){
		jQuery("#"+campo).addClass("alertar");
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
</script>


<title>Método Singapur - Centro Felix Klein</title> 
</head>