<?php 
//session_start();
ini_set('display_errors','On');
require("inc/config.php");
require("inc/funcionesAdmin.php");
require("_head.php");
$menu = "ini";
require("_menu.php"); 

$rbdColegio = $_REQUEST["rbdColegio"];
$idNivel = $_REQUEST["idNivel"];
$anoCursoColegio = $_REQUEST["anoCursoColegio"];
$letraCursoColegio = $_REQUEST["letraCursoColegio"];
$colegio = getDatosColegio($rbdColegio);

$nombreNivel = getNivel($idNivel);


$navegacion = "Inicio*inicio.php,Escuela: ".$colegio["nombreColegio"]."*escuelaDetalle.php?rbdColegio=".$rbdColegio.",".$nombreNivel." ".$letraCursoColegio."*#";
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

	$(function() {
		$( "#datepicker" ).datepicker();
		$('#datepicker').datepicker('option', {dateFormat: 'yy-mm-dd'});

	});


	function save_a(){
	 // CAMPOS
	 if(val_obligatorio("nombreAlumno") == false){ return; }
	 if(val_obligatorio("apellidoPaternoAlumno") == false){ return; }
	 if(val_obligatorio("apellidoMaternoAlumno") == false){ return; }
	 if(val_obligatorio("sexoAlumno") == false){ return; }
	 if(val_obligatorio("datepicker") == false){ return; }
	 if(val_obligatorio("emailAlumno") == false){ return; }
	 if(val_obligatorio("tipoAlumno") == false){ return; }
	 if(val_obligatorio("estadoAlumno") == false){ return; }
     if(confirm("¿Seguro de guardar este alumno?")){

 	var division = document.getElementById("lugar_de_carga2");
 	var a = $(".campos").fieldSerialize();
	 AJAXPOST("cargaMasivaAlumnos.php",a,division);
	 mostrar_alumnosCurso();
 	}
} 
</script>

<script language="javascript">
function newAlumno(){
	var division = document.getElementById("lugar_de_carga");
	AJAXPOST("alumnoNuevo.php","rbdColegio=<?php echo $rbdColegio;?>&idNivel=<?php echo $idNivel;?>&anoCursoColegio=<?php echo $anoCursoColegio;?>&letraCursoColegio=<?php echo $letraCursoColegio;?>",division);
} 

function cargaMasiva(){
	var division = document.getElementById("lugar_de_carga");
	 var a = $(".campos").fieldSerialize();
	AJAXPOST("uploadAlumnosCurso.php",a+"&rbdColegio=<?php echo $rbdColegio;?>&idNivel=<?php echo $idNivel;?>&anoCursoColegio=<?php echo $anoCursoColegio;?>&letraCursoColegio=<?php echo $letraCursoColegio;?>",division);
}  

function editAlumno(usuario){
	 
	var division = document.getElementById("lugar_de_carga");
	AJAXPOST("alumnoEditar.php","rbdColegio=<?php echo $rbdColegio;?>&usuario="+usuario,division);
} 
function mostrar_alumnosCurso(){
	var division = document.getElementById("listado_alumnos");
	AJAXPOST("alumnoListado.php","rbdColegio=<?php echo $rbdColegio;?>&idNivel=<?php echo $idNivel;?>&anoCursoColegio=<?php echo $anoCursoColegio;?>&letraCursoColegio=<?php echo $letraCursoColegio;?>&",division);
	
} 



function cancelar(){
	if(confirm("Cancelar esta operación?")){ location.href="cursoDetalle.php?rbdColegio=<?php echo $rbdColegio;?>&idNivel=<?php echo $idNivel;?>&anoCursoColegio=<?php echo $anoCursoColegio;?>&letraCursoColegio=<?php echo $letraCursoColegio;?>"; }  
}
</script><p>
<span class="titulo_form"><h2>Administración <?php echo $nombreNivel." ".$letraCursoColegio;?></h2></span>

    


<div id="lugar_de_carga2"></div>  

	<div id="lugar_de_carga"></div>  


	<div id="listado_alumnos"></div>            



<script language="javascript">

	mostrar_alumnosCurso();
	
</script> 
<?php require("_pie.php"); ?>
