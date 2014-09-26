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
	$navegacion = "Informes*#";
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
            La pauta observacion de clases permitirá tener un registro a las respecto a la 
            observaciones que realizan los asesores de las clases que los docentes realizan 
            en la implementación en aula del Método Singapur            
			</p><br />
        </div><!--textoBienvenida-->
        <div id="cajaCentralFondo" >
        
    	<?php
		$idPerfil = $_SESSION["sesionPerfilUsuario"];  

        if ($idPerfil==9 ||$idPerfil==5 || $idPerfil==23 ||$idPerfil==21 || $idPerfil==3){ ?>
        <div id="cajaCentralFondo" >
       
        <div id="cajaCentralTop">
                <p class="titulo_jornada">
				Ver Visitas Escuela
                </p>
            </div>
            
              <div id="textoJornada">
               Lista de Visitas Ingresadas
              <br><br>
			 <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('visitaEscuela.php','_self')" value="Registro de visita a escuela" />
              </div>
            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
         <?php } ?>  
          
        </div> <!--cajaCentralFondo-->
        
		<br>
        <div id="cajaCentralFondo" >
      
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                Pauta de Observaci&#243;n de Clases  
                </p>
            </div>
            
            <div id="textoJornada">
                Pauta de Observaci&#243;n de Clases 
              <br><br>

              <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('observacionClases.php','_self')" value="Ingresar/Ver Pautas" />
              </div>
              <br />

            </div>
            
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
        <br />
    </div> <!--columnaCentro-->

	<?php 
    	

		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>