<?php 
ini_set("Display_Errors","On");
require("inc/incluidos.php");
require ("hd.php");?>

<body>

<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Mensajes*#";	
	require("_navegacion.php");
?>
    <div id="lateralIzq">
    	<?php require("menuleft.php");?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
	    <?php require("menuright.php");?>
    </div><!--lateralDer-->    
    
    
	<div id="columnaCentro">
     
        <p class="titulo_curso">Mensajes <?php echo $_SESSION["sesionNombreUsuario"]; ?></p>
        <hr />
        <br />

       	<p align="right">
        	<?php 
			boton("Nuevo Mensaje","muestraListadoParaMensaje()");
			?>
		</p>
       
       <!--Aqui se cargan las cosas-->
        <div id="nuevoMensaje"></div>
        
        <div id="listadoParaMensaje"></div>
		
        <div id="bandeja"></div>

        <br />
        <br />

	</div>  <!--columnaCentro-->
 
 <?php 
    	
	require("pie.php");
	
?> 
  </div>
</body>
<script type="text/javascript">
	
		<?php 
		if ($_REQUEST["mostrar"] == "recibidos"){
		?>
			mostrarRecibidos();
		<?php 
		}
		
		if ($_REQUEST["mostrar"] == "enviados"){
		?>
			mostrarEnviados();
		<?php
		}	
		?>
	
	
</script>
</html>
