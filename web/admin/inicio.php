<?php 
//session_start();
require_once("inc/config.php");
//require_once("inc/sesionAdmin.php");
require("_head.php");
$menu = "ini";
require("_menu.php"); 
$navegacion = "Inicio*inicio.php";
//require("_navegacion.php");

//include "../inc/_funciones.php";

?>
<script language="javascript">
function mostrar_escuelas(){
	var division = document.getElementById("listado_escuelas");
	AJAXPOST("escuelaListado.php","",division);
	
} 

function new_(){
	var division = document.getElementById("lugar_de_carga");
	AJAXPOST("escuelaNuevo.php","",division);
} 


class_activo('boton_inicio','activo');

</script>






<form name="form" action="" method="POST" enctype="multipart/form-data">
	<div id="lugar_de_carga"></div>  
	</form>
   <div id="listado_escuelas"></div>   
    
  <script language="javascript">
	mostrar_escuelas();
</script>  
   
<?php //require("_pie.php"); ?>
