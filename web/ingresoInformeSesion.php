<?php 
require("inc/incluidos.php");
require ("hd.php");
require("inc/_asistenciaSesion.php");
?>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="./css/seccion-cajas.css" />
<body>
<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Informes de Sesi&#243;n*informesSesion.php,Ingreso Informe*#";
	require("_navegacion.php");
?>
	
	<div id="lateralIzq">
	    <?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
		<?php require("menuright.php"); ?>
    </div><!--lateralDer-->
    
	<div id="columnaCentro">
        <?php require("recargarInformeSesion.php"); ?>
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
</div><!--principal--> 
</body>
</html>