<?php 
//session_start();
require("inc/config.php");



require("_head.php");
$menu = "ini";
require("_menu.php"); 
$navegacion = "Inicio*inicio.php";
require("_navegacion.php");
 


/*if($_REQUEST["modo"] == "aceptar"){
	$sql = "update evaluacion set eva_decision = 'A', eva_recepcionado = '".date("Y-m-d")."' where eva_id = '".$_REQUEST["eva"]."' ";
	$res = mysql_query($sql);
}
if($_REQUEST["modo"] == "rechazar"){
	$sql = "update evaluacion set eva_decision = 'R', eva_recepcionado = '".date("Y-m-d")."' where eva_id = '".$_REQUEST["eva"]."' ";
	$res = mysql_query($sql);
}*/
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
   
<?php require("_pie.php"); ?>
