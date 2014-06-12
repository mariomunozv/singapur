<?php 

require("inc/config.php");

require("_head.php"); 
$menu = "jor"; 
require("_menu.php"); 
$navegacion = "Jornadas*jornada.php";
require("_navegacion.php");


?>

<script language="javascript">

function new_jornada(){
	var division = document.getElementById("jornada_nuevo");
	AJAXPOST("jornadaNuevo.php","",division);
} 

function list_jornadas(){
	var division = document.getElementById("jornada_lista");
	AJAXPOST("jornadaListado.php","",division);
}

function edit_jornada(idJornada){
	var division = document.getElementById("jornada_nuevo");
	var a = "idJornada="+idJornada;
	AJAXPOST("jornadaEditar.php",a,division);
} 

function estado_jornada(idJornada,visible){
	var division = document.getElementById("jornada_lista");
	var a = "idJornada="+idJornada+"&visible="+visible;
	AJAXPOST("jornadaListado.php",a,division);
} 

function actualizar_jornada(idCurso){
	var division = document.getElementById("jornada_nuevo");
    var a = $(".campos").fieldSerialize();
	AJAXPOST("jornadaActualizar.php",a,division);
	lista_jornada_Curso(idCurso);
}

class_activo('boton_jornada','activo');

</script><p>
<span class="titulo_form">Jornadas</span>

<br />
<br />


<a class="button" href="javascript:new_jornada();">
<span><?php echo "Nueva Jornada"; ?></span>
</a>




<br />
<br />
<div id="jornada_nuevo"></div>
<div id="jornada_lista"></div>

<script language="javascript">list_jornadas();</script>