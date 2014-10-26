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
	$navegacion = "Home*curso.php?idCurso=$idCurso,Informes de Sesi&#243;n*#";
	require("_navegacion.php");


?>
	
	<div id="lateralIzq">
	    <?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
		<?php require("menuright.php"); ?>
    </div><!--lateralDer-->
    
    
	<div id="columnaCentro">
     
		
        <p class="titulo_curso">Informes de Sesi&#243;n: </p>
        <hr />
        <br />
        <p>A continuaci&#243;n podr&aacute; reportar las sesiones del curso B-Learning adem&aacute;s de realizar un seguimiento del desarrollo del curso en la modalidad presencial:</p>
        <?php if($idPerfil == 5 || $idPerfil ==  9 || $idPerfil ==  20 ){ ?>
        <div id="cajaCentralFondo" ><!-- 1 -->
            
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
				Ingreso de Informaci&#243;n:
                </p>
            </div>
            <div id="textoJornada">
				A continuaci&oacute;n podr&aacute; ingresar la asistencia de la sesi&oacute;n presencial:
            <br>
             <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('ingresoAsistenciaSesion.php','_self')" value="Ingresar asistencia de sesi&oacute;n" />
            </div>

            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
        </div> <!--cajaCentralFondo-->
        <?php } ?>
        <?php if($idPerfil == 5 || $idPerfil ==  9){ ?>
        <div id="cajaCentralFondo" ><!-- 2 -->
            
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                Ingreso de Informaci&#243;n:
                </p>
            </div>
            <div id="textoJornada">
                Como relator del curso presencial podr&aacute; reportar los contenidos y desarrollo de cada sesi&oacute;n a continuaci&oacute;n:
            <br>
             <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('ingresoInformeSesion.php','_self')" value="Ingresar informe de la sesi&oacute;n" />
            </div>

            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
        <?php } ?>
        <?php if($idPerfil == 5 || $idPerfil ==  9 || $idPerfil ==  20 || $idPerfil == 23 ){ ?>
        <div id="cajaCentralFondo" ><!-- 3 -->
            
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                Ver Informe
                </p>
            </div>
            <div id="textoJornada">
                Aqu&iacute; podr&aacute; informarse del desarrollo del curso a trav&eacute;s de todas las sesiones, adem&aacute;s de un resumen general: 
            <br>
             <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('llenarVisitaEscuela.php','_self')" value="Ver informe de sesiones" />
            </div>

            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
        <?php } ?>
		<br>
        
        <br />
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>