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
	$navegacion = "Home*mural.php?idCurso=$idCurso,Informes*#";
	require("_navegacion.php");


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
   
        <div id="cajaCentralFondo" >
        
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
				Informe de Evaluaciones
                </p>
            </div>
            
            <div id="textoJornada">
				<i>Aun no hay informes disponibles</i>
            <br><br>

            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
		<br>
        <div id="cajaCentralFondo" >
        
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                Pauta de Observaci&#243;n de Clases  
                </p>
            </div>
            
            <div id="textoJornada">
            (Copiado de otra seccion del sitio) En esta secci&#243;n usted encontrar&#225; disponible los informes que se emitir&#225;n desde Centro Felix Klein respecto a la implementaci&#243;n en aula de M&#233;todo Singapur, de acuerdo a la informaci&#243;n recogida a trav&#233;s de las Pautas de Observaci&#243;n de Clases. 
              <br><br>

              <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onclick="window.open('observacionClases.php','_self')" value="Ingresar/Ver Pautas" />
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