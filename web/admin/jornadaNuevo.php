<?php
session_start();
include "../inc/conecta.php";
include "../inc/funciones.php";
Conectarse_seg(); 

$arregloTipoRecurso = getIdNombreTabla("TipoRecurso");
$arregloCursoCapacitacion = getIdAtributoTablaActivo("CursoCapacitacion","nombreCorto");
//$arregloCursoCapacitacion = getIdAtributoTabla("CursoCapacitacion","nombreCorto");
$arregloJornada = getIdNombreTabla("Jornada");
$arregloPerfil= getIdNombreTabla("Perfil");

?>
<title>Nueva Jornada</title>

<form action="jornadaGuarda.php" method="post">

<table class="tablesorter">
    <tr>
	    <th colspan="2" align="center"><h2>Creación de Jornada</h2></th>
    </tr>
    <tr>
    	<td>Tipo de publicación</td>
        <td>
        	<select name="tipoJornada" id="tipoJornada">
            	<option value="">Seleecionar un tipo</option>
            	<option value="0">Home</option>
            	<option value="1">Mural</option>
            	<option value="2">Recurso</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Nombre de la jornada a publicar:</td>
	    <td><input name="nombreJornada" id="nombreJornada" type="text" size="50"></td>
    </tr>
    <tr>
    	<td>Curso:</td>
		<td>
        <select id="idsCursos" name="idsCursos[]" multiple="multiple" size="15">
        	<?php armaSelectIdAtributo($arregloCursoCapacitacion,"CursoCapacitacion","nombreCorto"); ?>
	    </select>
        </td>
    </tr>
	<tr>
	    <td>Módulo (nº):</td>
		<td><input name="moduloJornada" id="moduloJornada" type="text" size="5"></td>
    </tr>
    <tr>
    	<td>Visible</td>
        <td><input name="visibleJornada" type="checkbox" value="1" checked /></td>
    </tr>
    <tr>
    	<td>Texto descripcion:</td>
        <td>
       	    <textarea id="descripcionJornada" name="descripcionJornada" cols="80" rows="5"></textarea>
        </td>
    </tr>
    <tr>
	    <td colspan="2"><input name="Enviar" type="submit" value="Enviar"/></td>
    </tr>
</table>
</form>
