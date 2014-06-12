<?php 
ini_set("display_errors","on");
require("inc/config.php");
//require("inc/sesionAdmin.php");
require("_head.php"); 
$menu = "pub"; 
require("_menu.php"); 
$navegacion = "Actividades*actividades.php";
require("_navegacion.php");

include "../inc/_funciones.php";

?>

<script language="javascript">

class_activo('boton_actividad','activo');

$("#detalle").click(function () {
	  $("#nuevo").hide("fast");
      $("#paginas").hide("fast");
    });  


function new_actividad(){
	var division = document.getElementById("nuevo");
	AJAXPOST("actividadesNuevo.php","",division);
} 

function list_actividades(){
	var division = document.getElementById("actividades");
	AJAXPOST("actividadesListar.php","",division);
}

function detalle_actividad(idActividad){
	resumenActividad(idActividad)
	var division = document.getElementById("actividades_pagina");
	var a = "idActividad="+idActividad;
	AJAXPOST("actividadesPaginasListar.php",a,division);
}

function listaPaginas(idActividadPagina){
	resumenActividadPagina(idActividadPagina);
	var division = document.getElementById("paginas");
	var a = "idActividadPagina="+idActividadPagina;
	AJAXPOST("actividadesPaginaContenidoListar.php",a,division);
}
	
function resumenActividad(idActividad){
	var division = document.getElementById("actividades");
	var a = "idActividad="+idActividad;
	AJAXPOST("actividadesResumen.php",a,division);
}

function resumenActividadPagina(idActividadPagina){
	var division = document.getElementById("actividades_pagina");
	var a = "idActividadPagina="+idActividadPagina;
	AJAXPOST("actividadesPaginaResumen.php",a,division);
}

function edit_actividad(idActividad){
	var division = document.getElementById("nuevo");
	var a = "idActividad="+idActividad;
	AJAXPOST("actividadesNuevo.php",a,division);
} 

function edit_actividadPagina(idActividad,idActividadPagina){
	var division = document.getElementById("nuevo");
	var a =  "idActividad="+idActividad+"&idActividadPagina="+idActividadPagina;
	AJAXPOST("actividadesPaginaNuevo.php",a,division);
} 

function edit_contenido(idContenidoPagina,idActividadPagina){
	var division = document.getElementById("nuevo");
	var a =  "idContenidoPagina="+idContenidoPagina+"&idActividadPagina="+idActividadPagina;
	AJAXPOST("actividadesPaginaContenidoNuevo.php",a,division);
} 

function new_pagina(idActividad){
	var division = document.getElementById("nuevo");
	var a = "idActividad="+idActividad;
	AJAXPOST("actividadesPaginaNuevo.php",a,division);
} 

function new_contenido(idActividadPagina){
	var division = document.getElementById("nuevo");
	var a = "idActividadPagina="+idActividadPagina;
	AJAXPOST("actividadesPaginaContenidoNuevo.php",a,division);
} 

</script><p>
<span class="titulo_form">Actividades</span>

<div id="nuevo"></div>
<div id="actividades"></div>
<div id="actividades_pagina"></div>
<div id="paginas"></div>

<script language="javascript">list_actividades();</script>

