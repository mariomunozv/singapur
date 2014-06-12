<?php
session_start();
include "../inc/conecta.php";
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

</script>


<title>Nueva publicacion</title>

<form action="publicacionGuarda.php" method="post">

Tipo de recurso:
<br>
<select name="idTipoRecurso">
	<?php armaSelect($arregloTipoRecurso,"TipoRecurso"); ?>
</select>

<br>
<br>

Nombre del recurso a publicar:
<br>
<input name="nombreRecurso" id="nombreRecurso" type="text" size="80">
<br>
URL/ID a publicar:
<br>
<input name="urlRecurso" id="urlRecurso" type="text" size="80">
<br>
<br>

Curso:
<br>
<select name="idCursoCapacitacion[]" size="10" multiple="multiple" class="campos" id="idCursoCapacitacion" onchange="eligeJornada()">
	<?php armaSelectIdAtributo($arregloCursoCapacitacion,"CursoCapacitacion","nombreCorto"); ?>
</select>

<br>
<br>

Jornada:
<br>
<select name="idJornada[]" size="10" multiple="multiple" id="idJornada">
	<?php //armaSelect($arregloJornada,"Jornada"); ?>
</select>

<br>
<br>

Perfil:
<br>
<select name="idPerfil">
	<?php armaSelect($arregloPerfil,"Perfil"); ?>
</select>

<input name="Enviar" type="submit" value="Enviar"/>

</form>
