<?php
ini_set('display_errors','On');

session_start();
include "../inc/conecta.php";
include "../inc/_funciones.php";
include "../inc/_jornada.php";
Conectarse_seg(); 

$idJornada = $_REQUEST["idJornada"];
$jornada = getJornadaByID($idJornada);
$tipoJornada = $jornada["tipoJornada"];
echo "es de tipo: ".$tipoJornada;

function marcaTipoJornada($tipoJornada, $tj){
	$pos = strpos($tipoJornada, $tj);
	if ($pos === false) {
		echo "";
	} else {
		echo " selected";
	}
}

?>
<title>Editar Jornada</title>

<table class="tablesorter">
<tr>
	<th colspan="2" align="center"><h2>Editar Jornada</h2></th>
</tr>
<tr>
	<td>Tipo Jornada:</td>
	<td>
		<select name="tipoJornada" id="tipoJornada">
        	<option value="">Seleecionar un tipo</option>
            <option value="0" <?php marcaTipoJornada($tipoJornada,"0") ?> >Home</option>
            <option value="1" <?php marcaTipoJornada($tipoJornada,"1") ?> >Mural</option>
            <option value="2" <?php marcaTipoJornada($tipoJornada,"2") ?> >Recurso</option>
		</select>
	</td>
</tr>
<tr>
	<td>Jornada:</td>
	<td><input name="nombreJornada" id="nombreJornada" type="text" size="50" value="<?php echo $jornada["nombreJornada"] ?>" class="campos"/> <input type="hidden" name="idJornada" id="idJornada" value="<?php echo $jornada["idJornada"]?>" class="campos"/></td>
</tr>
<tr>
	<td>Curso:</td>
	<td><input name="cursoJornada" id="cursoJornada" type="text" readonly="true" size="50" value="<?php echo $jornada["nombreCortoCursoCapacitacion"] ?>" class="campos"/></td>
</tr>
<tr>
	<td>Módulo (nº):</td>
	<td><input name="moduloJornada" id="moduloJornada" type="text" size="5" value="<?php echo $jornada["moduloJornada"] ?>" class="campos"/></td>
</tr>

<tr>
<td>Descripcion:</td>
<td><textarea id="descripcionJornada" name="descripcionJornada" cols="80" rows="5" class="campos"><?php echo $jornada["descripcionJornada"] ?></textarea></td>
</tr>
<tr>
	<td>Visible</td>
	<?php if($jornada["visibleJornada"]==1) { ?>
	<td><input name="visibleJornada" id="visibleJornada" type="checkbox" checked  class="campos"/></td>
	<?php }else{ ?>
	<td><input name="visibleJornada" id="visibleJornada" type="checkbox" class="campos"/></td>
	<?php } ?>
</tr>
<tr>
<td colspan="2" align="center">
	<input name="send" type="button" value="Actualizar" onclick="javascript:actualizar_jornada(<?php echo $jornada["idCursoCapacitacion"]?>);"/> 
	<input name="cancel" type="button" value="Cancelar" onclick="window.location.reload(true);"/>
</td>
</tr>
</table>
