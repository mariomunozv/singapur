<?php require ("inc/configErrores.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<link href="css/custom-theme/jquery-ui-1.9.2.custom.css" type="text/css" rel="stylesheet" />	
<link href="css/botones.css" rel="stylesheet" type="text/css" />
<link href="css/tabla.css" rel="stylesheet" type="text/css" />
<link href="css/ui.stepper.css" rel="stylesheet" type="text/css" />
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<!--<link rel="stylesheet" type="text/css" href="inc/shadowbox303/shadowbox.css" />

<script type="text/javascript" src="inc/shadowbox303/shadowbox.js"></script>-->
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>  
<script type="text/javascript" src="js/main.js"></script> 
<!--<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>-->
<script type="text/javascript" src="js/pngfix.js"></script>   
<script type="text/javascript" src="js/tag.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>   
<script type="text/javascript" src="js/validarut.js"></script>
<script type="text/javascript" src="js/mensajes.js"></script> 
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>		
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui.stepper.js"></script>
<script src="http://jwpsrv.com/library/3FhtlvVMEeKqQCIACusDuQ.js"></script>
<!--
<script type="text/javascript">
Shadowbox.init();
</script>
-->
<script language="javascript" type="text/javascript">
var MsjTipico = "<img src='img/loading.gif' alt='Cargando'/><br>Cargando";

function val_obligatorio(campo){
	jQuery("#"+campo).removeClass("alerta_btn");
	var valor = document.getElementById(campo+"").value + ""; 
	if(valor == ""){
		jQuery("#"+campo).addClass("alerta_btn");
		alert("Indique todos los campos obligatorios.");
		document.getElementById(campo+"").focus();
		return false;
	}
	return true;
}


  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-39776521-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();


</script>



<title>Pensar sin L&iacute;mites -</title> 
</head>