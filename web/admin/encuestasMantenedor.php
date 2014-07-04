<?php
ini_set("display_errors","on");
include ("_head.php");
require("inc/config.php");




//$menu = "ini";
//require("_menu.php"); 
//$navegacion = "Inicio*inicio.php";
//require("_navegacion.php");
 


?>


<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<script language="javascript">

function crearFormulario(){
	var division = document.getElementById("contenido");
	AJAXPOST("formularioCrear.php","",division);
}

function crearSeccion(){
	var division = document.getElementById("contenido");
	AJAXPOST("seccionCrear.php","",division);
}

function crearEnunciado(){
	var division = document.getElementById("contenido");
	AJAXPOST("enunciadoCrear.php","",division);
}

function crearAlternativas(){
	var division = document.getElementById("contenido");
	AJAXPOST("enunciadoAlternativasCrear.php","",division);
}

function crearRelacionEnunciadoSeccion(){
	var division = document.getElementById("contenido");
	AJAXPOST("enunciadosAsociar.php","",division);
}

</script>



<div id="wrap" style="width:900px; margin: 0 auto;" align="center">
<div id="top" align="center" style="width:auto;"><img src="../img/header.jpg"></div>
<div align="center" style="margin-top: 0 auto;">
<ul style=" background-color:#000033; color:#FFFFFF; list-style:none; margin-top: 0px; padding-top:10px; padding-bottom:5px">
<li style="display:inline; font-size:12px; text-transform:uppercase;"><a style="text-decoration:none; color:#FFFFFF" href="javascript:crearFormulario();"><strong>Crear Formulario</strong></a></li>
<li style="display:inline; margin-left:40px; font-size:12px; text-transform:uppercase"><a style="text-decoration:none; color:#FFFFFF" href="javascript:crearSeccion();"><strong>Crear Sección</strong></a></li>
<li style="display:inline; margin-left:40px; font-size:12px; text-transform:uppercase"><a style="text-decoration:none; color:#FFFFFF" href="javascript:crearEnunciado();"><strong>Crear Enunciados</strong></a></li>
<li style="display:inline; margin-left:40px; font-size:12px; text-transform:uppercase"><a style="text-decoration:none; color:#FFFFFF" href="javascript:crearAlternativas();"><strong>Crear Alternativas</strong></a></li>
<li style="display:inline; margin-left:40px; font-size:12px; text-transform:uppercase"><a style="text-decoration:none; color:#FFFFFF" href="javascript:crearRelacionEnunciadoSeccion();"><strong>Relacionar Enunciados con Seccion</strong></a></li>
</ul>
</div>

<div id="contenido"></div>

<script language="javascript" >
crearFormulario();
</script>
</body>
</html>