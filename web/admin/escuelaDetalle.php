<?php 

require("inc/config.php");

require("inc/funcionesAdmin.php");


require("_head.php");
$menu = "ini";
require("_menu.php"); 
$rbdColegio = $_REQUEST["rbdColegio"];

$colegio = getDatosColegio($rbdColegio);
$navegacion = "Inicio*inicio.php,Escuela: ".$colegio["nombreColegio"]."*#";
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
function newCurso(){
	var division = document.getElementById("lugar_de_cargaCurso");
	AJAXPOST("cursoNuevo.php","rbdColegio=<?php echo $rbdColegio;?>",division);
} 
function newProfesor(){
	var division = document.getElementById("lugar_de_cargaProfesor");
	AJAXPOST("profesorNuevo.php","rbdColegio=<?php echo $rbdColegio;?>",division);

} 


function mostrar_datosEscuela(){
	var division = document.getElementById("datos_escuela");
	
	AJAXPOST("datosEscuela.php","rbdColegio=<?php echo $rbdColegio;?>",division);
	
} 

function mostrar_cursosEscuela(){
	var division = document.getElementById("listado_cursos");
	AJAXPOST("cursoListado.php","rbdColegio=<?php echo $rbdColegio;?>",division);
	
} 
function mostrar_profesorEscuela(){
	var division = document.getElementById("listado_profesor");
	AJAXPOST("profesorListado.php","rbdColegio=<?php echo $rbdColegio;?>",division);
	
} 

</script>
<span class="titulo_form">Adminitracion Sistema</span>
<form name="form" action="" method="POST" enctype="multipart/form-data">



<div id="lugar_de_cargaColegio"></div>  

<div id="datos_escuela"></div>  
     
<div id="lugar_de_cargaCurso"></div>  
<h2>Cursos</h2>
<div id="datos_escuela"></div>  
<a class="button" href="javascript:newCurso();"><span><div class="add"><?php echo "Nuevo Curso"; ?></div></span></a><br /><br />
<div id="listado_cursos"></div>  
<div id="lugar_de_cargaProfesor"></div>  
<h2>Profesores</h2>
<a class="button" href="javascript:newProfesor();"><span><div class="add"><?php echo "Nuevo profesor"; ?></div></span></a><br /><br />
<div id="listado_profesor"></div> 



       </form> 
       
<script language="javascript">
	mostrar_datosEscuela();
	mostrar_cursosEscuela();
	mostrar_profesorEscuela();
</script>         
<?php require("_pie.php"); ?>
