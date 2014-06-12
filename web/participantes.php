<?php 
require("inc/incluidos.php");
//echo $_SESSION["sesionIdCurso"];
require ("hd.php");

?>

<body onLoad="toggleDisplay(document.getElementById('theTable'));">	
<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Participantes*#";	
	require("_navegacion.php");
	$nombreCurso = getNombreCortoCurso($_SESSION["sesionIdCurso"]);
?>

    <div id="lateralIzq">
    <?php 
		require("menuleft.php"); 
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
    <?php 		require("menuright.php"); ?>
    </div><!--lateralDer-->
    
    
    
    
    
	<div id="columnaCentro">
    
    	<div id="notificaciones" align="center">
		<?php 
            require("alumnosCurso.php");
        
        ?>	
        </div>
			
    </div> <!--columnaCentro-->


	<?php 
    	
		require("pie.php");
		
    ?> 
</div>
</body>
</html>
