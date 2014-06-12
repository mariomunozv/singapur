<?php 
require("inc/incluidos.php");
//require ("hd.php");

$idUsuario = $_SESSION["sesionIdUsuario"];
$idProyecto = 1;
$idCategoria = $_POST["idCategoria"];
$todoDeCurso = getDatosCategoria($idCategoria); //Función en _tema.php
$idCurso = $todoDeCurso['idCursoCapacitacion'];
$tituloTema = $_REQUEST['tituloTema'];
$mensajeInicialTema = $_REQUEST['mensajeForo'];
$estadoTema = 1;

if (guardarTema($idCurso, $idUsuario, $idProyecto, $idCategoria, $tituloTema,$mensajeInicialTema,$estadoTema) > 0){?>
<script language="javascript">
	var categoria = <?php echo $idCategoria ?>;
	window.location.href ="foroCategoria.php?idCategoria="+categoria;
</script>
<?php }?>

