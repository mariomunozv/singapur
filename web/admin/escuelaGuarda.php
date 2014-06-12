<?php

require("inc/config.php");



	
?> 



        
<?php





$rbdColegio = $_POST["rbdColegio"];
$idComuna = $_POST["idComuna"];
$nombreColegio = $_POST["nombreColegio"];
$direccionColegio = $_POST["direccionColegio"];
$telefonoColegio = $_POST["telefonoColegio"];
$emailColegio = $_POST["emailColegio"];
$paginaWebColegio = $_POST["paginaWebColegio"];
$matriculaColegio = $_POST["matriculaColegio"];
@$organigramaColegio = $_POST["organigramaColegio"];
@$logoColegio = $_POST["logoColegio"];

guardarEscuela($rbdColegio, $idComuna, $nombreColegio, $direccionColegio, $telefonoColegio,$emailColegio , $paginaWebColegio, $matriculaColegio,$emailColegio , $organigramaColegio, $logoColegio);
	
?>
 <script language="javascript">
	mostrar_escuelas();
</script>
            