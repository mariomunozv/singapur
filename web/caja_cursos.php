<?php 
$idCurso = $_SESSION["sesionIdCurso"];
?>
<script language="javascript">
function cambiaCurso(idCurso){
	if(idCurso != 28){
		window.location.href="curso.php?idCurso="+idCurso;
	}else{
		window.location.href="mural.php?idCurso="+idCurso;
	}
}
</script>


<?php $cursosUsuario = getCursosUsuario($_SESSION["sesionIdUsuario"]);?>
<div class="titulo_div">Selecci&oacute;n de Secci&oacute;n</div>

<div class="info_div">
<p>Escoja la secci&oacute;n de su curso a la cual desea acceder</p><br/>
<select name="cambiaCurso" id="cambiaCurso" onchange="cambiaCurso(this.value)" style="width:100%">
<?php foreach ($cursosUsuario as $datosCurso){ 
	if($datosCurso["idCursoCapacitacion"] == $idCurso)
	{ ?>
		<option value="<?php echo $datosCurso["idCursoCapacitacion"]?>" selected="selected"><?php echo $datosCurso["nombreCortoCursoCapacitacion"];?></option>
<?php }else { ?>
	<option value="<?php echo $datosCurso["idCursoCapacitacion"]?>"><?php echo $datosCurso["nombreCortoCursoCapacitacion"];?></option>
<?php }} ?>
</select>
</div>