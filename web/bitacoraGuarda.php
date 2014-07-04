<?php
ini_set("display_errors","on");
session_start();
include "inc/conecta.php";
//include "inc/funciones.php";
include "inc/_bitacora.php";
include "sesion/sesion.php";
include "inc/_seccionBitacora.php";
$conecta = Conectarse_seg();
$idUsuarioIngresa = $_SESSION["sesionIdUsuario"];
$profesor = $_REQUEST["profesor"];
$idPadre = $_REQUEST["idPadre"];
$idCursoColegio = $_REQUEST['cursoColegio'];
$idSeccionBitacora = $_REQUEST['seccion'];
$fechaInicioBitacora = $_REQUEST['fInicio'];
$fechaFinBitacora = $_REQUEST['fTermino'];
$tiempoBitacora =$_REQUEST['horas'];
$nombreSeccion = getNombreSeccionBitacora($idSeccionBitacora);
$parte = getParteByCapitulo($idSeccionBitacora);
$capitulo = getCapituloBySeccion($idSeccionBitacora);

if(insertaBitacoraProfe($idUsuarioIngresa,$profesor,$idCursoColegio,$idSeccionBitacora,$nombreSeccion,$fechaInicioBitacora,$fechaFinBitacora,$tiempoBitacora)>0){?>
<script language="javascript">
	traeCapitulos('<?php echo $profesor ?>','<?php echo $parte ?>');
	muestraBitacorasSeccion('<?php echo $profesor ?>','<?php echo $capitulo ?>');
	muestraCapitulosCompletos('<?php echo $profesor ?>','<?php echo $idCursoColegio ?>');
</script>
<?php }else{
	echo "No se pudo inserta una bitácora";
}
?>