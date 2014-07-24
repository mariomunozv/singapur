<?
session_start();
include "../inc/conecta.php";
//include "../inc/_funciones.php";
include "../inc/funciones.php";
Conectarse_seg(); 

$arregloTipoRecurso = getIdNombreTabla("TipoRecurso");
$arregloCursoCapacitacion = getIdAtributoTablaActivo("CursoCapacitacion","nombreCorto");
$arregloJornada = getIdNombreTabla("Jornada");
$arregloPerfil= getIdNombreTabla("Perfil");

?>

<script language="javascript">

function eligeJornada(){
	var division = document.getElementById("idJornada"); 
	var a = $(".campos").fieldSerialize(); 
	AJAXPOST("publicacionNuevo_selectJornada.php",a,division);
	

}

function cambiaURL(combo){
	var idRecurso = document.getElementById("urlRecurso");
	var urlArchivo = document.getElementById("userfile");

	alert(combo.selectedIndex)
	
	var x=combo.selectedIndex;
	var y=combo.options;
	var textoOpcionCombo = y[x].text;
	
	if (textoOpcionCombo == "Archivos"){
		idRecurso.disabled = true
		urlArchivo.disabled = false
	}else{
		urlArchivo.disabled = true
		idRecurso.disabled = false
	}
}
</script>


<title>Nueva publicacion</title>

<form action="publicacionGuarda.php" method="POST" enctype="multipart/form-data">

Tipo de recurso:
<br>
<select name="idTipoRecurso" onchange="cambiaURL(this)">
	<? armaSelect($arregloTipoRecurso,"TipoRecurso"); ?>
</select>

<br>
<br>

Nombre del recurso a publicar:
<br>
<input name="nombreRecurso" id="nombreRecurso" type="text" size="80">
<br>
ID objeto/Archivo a publicar:
<br>
<input name="urlRecurso" id="urlRecurso" type="text" size="20">
<input name="userfile" id="userfile" type="file" >
<br>
<br>

Curso:
<br>
<select name="idCursoCapacitacion[]" size="10" multiple="multiple" class="campos" id="idCursoCapacitacion" onchange="eligeJornada()"  >
	<? armaSelectIdAtributo($arregloCursoCapacitacion,"CursoCapacitacion","nombreCorto"); ?>
</select>

<br>
<br> 

Jornada:
<br>
<select name="idJornada[]" size="10" multiple="multiple" id="idJornada">
	<? //armaSelect($arregloJornada,"Jornada"); ?>
</select>

<br>
<br>

Perfil:
<br>
<select name="idPerfil">
	<? armaSelect($arregloPerfil,"Perfil"); ?>
</select>

Notificar
<input name="notificarPublicacion" type="checkbox" value="1"  /><!--checked-->
<br>
<br>

<input name="Enviar" type="submit" value="Enviar"/>

</form>
