<?php 
require("inc/incluidos.php");
require ("hd.php");
?>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="./css/seccion-cajas.css" />
<body>
<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Informes*informes.php,Visita Escuela*#";
	require("_navegacion.php");
$idPerfil = $_SESSION["sesionPerfilUsuario"];  

?>
	
	<div id="lateralIzq">
	    <?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
		<?php require("menuright.php"); ?>
    </div><!--lateralDer-->
    
    
	<div id="columnaCentro">
        <p class="titulo_curso">Informes de Actividades: </p>
        <hr />
        <br />
  	 	<div id="textoBienvenida">
       	  <p class="textoBienvenida">
            La pauta observacion de clases permitir� tener un registro a las respecto a la 
            observaciones que realizan los asesores de las clases que los docentes realizan 
            en la implementaci�n en aula del M�todo Singapur            
			</p><br />
        </div><!--textoBienvenida-->
        
        <?php 
    	
		$idPerfil = $_SESSION["sesionPerfilUsuario"];  

		if ($idPerfil == $coordinador_general || $idPerfil == $relator_tutor ||$idPerfil == $asesor ){   ?>
        <div id="cajaCentralFondo" >
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
				Llenar Visitas Escuela
                </p>
            </div>
            
              <div id="textoJornada">
               Se pueden llenar las visitas escuela
              <br><br>
			 <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('llenarVisitaEscuela.php','_self')" value="Ingresar visita escuela" />
              </div>
            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
		<br>
        <div id="cajaCentralFondo" >
		<?php } 
        if ($idPerfil==$coordinador_general ||$idPerfil==$relator_tutor || $idPerfil==$asesor ||$idPerfil==$directivo || $idPerfil==$utp){ ?>
        <div id="cajaCentralTop">
                <p class="titulo_jornada">
				Ver Visitas Escuela
                </p>
            </div>
            
              <div id="textoJornada">
               Lista de visitas ingresadas
              <br><br>
			 <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('informes/informeVisitaEscuela.php','_self')" value="Ver visita escuela" />
              </div>
            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
         <?php } ?>   
        </div> <!--cajaCentralFondo-->
        
		<br>
        
        <br />
    </div> <!--columnaCentro-->

	<?php 
    	

		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>