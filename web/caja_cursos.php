<?php 
$idCurso = $_SESSION["sesionIdCurso"];
$idPerfil = $_SESSION["sesionPerfilUsuario"];
?>
<script language="javascript">
function cambiaCurso(idCurso){
	var tipoCurso = $("#cambiaCurso option:selected").attr("meta-tipo");
	var tipoPerfil= "<?php echo $idPerfil; ?>";
//REDIRECCIONES
//RESTO      => HOME
//   => CURSO
//DIRECTIVO  => BITACORA
	if(tipoPerfil == 21){
		window.location.href="informeBitacorasCurso.php?idCurso="+idCurso;
	}else{
		window.location.href="curso.php?idCurso="+idCurso;
	}
		
}
</script>


<?php 
	//echo "<h1>-".$_SESSION["sesionIdUsuario"]."-</h1>";
	$cursosUsuario = getCursosUsuario($_SESSION["sesionIdUsuario"]);
	
	//if ( count($cursosUsuario)<=1 ||(count($cursosUsuario)==1 && $idCurso == 28)){}else{
?>
<div class="titulo_div">Selecci&oacute;n de Secci&oacute;n</div>


<div class="info_div">
	<p>Escoja la secci&oacute;n de su curso a la cual desea acceder</p><br/>
	<select name="cambiaCurso" id="cambiaCurso" onchange="cambiaCurso(this.value)" style="width:100%">
	<?php foreach ($cursosUsuario as $datosCurso){ 
		if($datosCurso["idCursoCapacitacion"] == $idCurso)
		{ ?>
			<option value="<?php echo $datosCurso["idCursoCapacitacion"]?>" meta-tipo="<?php echo $datosCurso["tipoCursoCapacitacion"]?>" selected="selected"><?php echo $datosCurso["nombreCortoCursoCapacitacion"];?></option>
	<?php }else { ?>
		<option value="<?php echo $datosCurso["idCursoCapacitacion"]?>" meta-tipo="<?php echo $datosCurso["tipoCursoCapacitacion"]?>" ><?php echo $datosCurso["nombreCortoCursoCapacitacion"];?></option>
	<?php }} ?>
	</select>
</div>
<?php //} ?>