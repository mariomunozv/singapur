<?php 
ini_set("display_errors","on");
require("inc/incluidos.php");
require ("hd.php");
$idUsuario = $_SESSION["sesionIdUsuario"];
$idPerfil = $_SESSION["sesionPerfilUsuario"];
$rbdColegio = getRbdUsuario($idUsuario);
?>
<meta charset="iso-8859-1">
<body>
<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Home*mural.php?idCurso=$idCurso,Evaluacion*evaluacionHome.php,Instrumentos para la Observaci&oacute;n de Clases*#";
	require("_navegacion.php");


?>
	
	<div id="lateralIzq">
   		<?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
		<?php require("menuright.php"); ?>
    </div><!--lateralDer-->
    
	<div id="columnaCentro">
	<p class="titulo_curso">Evaluaciones de proceso</p>
    <hr /><br />
	<?php //if($idPerfil > 1){ //En clase _usuario.php ?>
		<div id="cajaCentralFondo" >
        	<div id="cajaCentralTop">
            	<p class="titulo_jornada">
                	Evaluaci&oacute;n 1
                </p>
            </div>

            <ul >
                <li>
                    <ul >
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Prueba	</td>
                            <td width="50"><a href="subir/docs/1_Basico PIMS 1.pdf">1&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/2_Basico PIMS 1.pdf">2&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/3_Basico PIMS 1.pdf">3&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/4_Basico PIMS 1.pdf">4&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/5_Basico PIMS 1.pdf">5&ordm;</a></td>
                          </tr>
                        </table>
                        </li>
                        
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Pauta correcci&oacute;n</td>
                            <td width="50"><a href="subir/docs/PC Prueba intermedia 1 1_Basico 2013.pdf">1&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/PC Prueba intermedia 1 2_Basico 2013.pdf">2&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/PC Prueba intermedia 1 3_Basico 2013.pdf">3&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/PC Prueba intermedia 1 4_Basico 2013.pdf">4&ordm;</a> -</td>                            
                            <td width="50"><a href="subir/docs/PC Prueba intermedia 1 5_Basico 2013.pdf">5&ordm;</a></td>
                          </tr>
                        </table> 
                        </li>
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Protocolo aplicaci&oacute;n</td>
                            <td width="50"><a href="subir/docs/1_Basico Orientaciones Aplicacion.pdf">1&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/2_Basico Orientaciones Aplicacion.pdf">2&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/3_Basico Orientaciones Aplicacion.pdf">3&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/4_Basico Orientaciones Aplicacion.pdf">4&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/5_Basico Orientaciones Aplicacion.pdf">5&ordm;</a></td>
                          </tr>
                        </table> 
                        </li>
                        
                    </ul>
                </li>
            </ul>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
<br/>
		<div id="cajaCentralFondo" >
				<div id="cajaCentralTop">
                <p class="titulo_jornada"> Evaluaci&oacute;n 2</p>
            	</div>
	            <ul>
    	            <li>
        	            <ul>
	                        <li>
							<table border="0" cellspacing="0" cellpadding="0">
							<tr>
                                <td width="150">Prueba	</td>
                                <td width="50"><a href="subir/docs/Prueba intermedia 2_1_ Basico 2013.pdf">1&ordm;</a> - </td>
                                <td width="50"><a href="subir/docs/Prueba intermedia_ 2_ 2_ Basico 2013.pdf">2&ordm;</a> - </td>
                                <td width="50"><a href="subir/docs/Prueba intermedia_2_3_ Basico 2013.pdf">3&ordm;</a> - </td>
                                <td width="50"><a href="subir/docs/Prueba intermedia_2_4_ Basico 2013.pdf">4&ordm;</a> - </td>
                                <td width="50"><a href="subir/docs/Prueba intermedia_2_5_Basico 2013.pdf">5&ordm;</a></td>
	                          </tr>
    	                    </table>
        	                </li>
	                        <li>
    	                    <table border="0" cellspacing="0" cellpadding="0">
							<tr>
                            	<td width="150">Pauta correcci&oacute;n</td>
                                <td width="50"><a href="subir/docs/PC Prueba intermedia 2_1_Basico 2013.pdf">1&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/PC Prueba intermedia_2_2_Basico 2013.pdf">2&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/PC Prueba intermedia_2_3_Basico 2013.pdf">3&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/PC Prueba intermedia_2_4_Basico 2013.pdf">4&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/PC Prueba Intermedia_2_5_Basico 2013.pdf">5&ordm;</a></td>
							</tr>
							</table> 
                        	</li>
                        	<li>
                        	<table border="0" cellspacing="0" cellpadding="0">
                          	<tr>
                            	<td width="150">Protocolo aplicaci&oacute;n</td>
                                <td width="50"><a href="subir/docs/Orientaciones para la aplicacion 1.pdf">1&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/Orientaciones para la aplicacion 2.pdf">2&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/Orientaciones para la aplicacion 3.pdf">3&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/Orientaciones para la aplicacion 4.pdf">4&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/Orientaciones para la aplicacion 5.pdf">5&ordm;</a></td>
							</tr>
                        	</table> 
                        	</li>
                    	</ul>
                	</li>
            	</ul>
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
<br/>        
		<div id="cajaCentralFondo" >
				<div id="cajaCentralTop">
                <p class="titulo_jornada"> Evaluaci&oacute;n 3</p>
            	</div>
	            <ul>
    	            <li>
        	            <ul>
	                        <li>
							<table border="0" cellspacing="0" cellpadding="0">
							<tr>
                                <td width="150">Prueba	</td>
                                <td width="50"><a href="subir/docs/Prueba_intermedia_3_1_basico_2013.pdf">1&ordm;</a> - </td>
                                <td width="50"><a href="subir/docs/Prueba_Intermedia_3_2_basico_2013.pdf">2&ordm;</a> - </td>
                                <td width="50"><a href="subir/docs/Prueba_Intermedia_3_3_ basico 2013.pdf">3&ordm;</a> - </td>
                                <td width="50"><a href="subir/docs/Prueba Intermedia_3_4_basico_2013.pdf">4&ordm;</a> - </td>
                                <td width="50"><a href="subir/docs/Prueba_Intermedia_3_5_basico_2013.pdf">5&ordm;</a></td>
	                          </tr>
    	                    </table>
        	                </li>
	                        <li>
    	                    <table border="0" cellspacing="0" cellpadding="0">
							<tr>
                            	<td width="150">Pauta correcci&oacute;n</td>
                                <td width="50"><a href="subir/docs/PC_Prueba_intermedia_3_1_Basico_2013.pdf">1&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/PC_Prueba_intermedia_3_2_Basico_2013.pdf">2&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/PC_Prueba_intermedia_3_3_Basico_2013.pdf">3&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/PC_Prueba_intermedia_3_4_Basico_2013.pdf">4&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/PC_Prueba_intermedia_3_5_Basico_2013.pdf">5&ordm;</a></td>
							</tr>
							</table> 
                        	</li>
                        	<li>
                        	<table border="0" cellspacing="0" cellpadding="0">
                          	<tr>
                            	<td width="150">Protocolo aplicaci&oacute;n</td>
                                <td width="50"><a href="subir/docs/Orientaciones_para_la_aplicacion_prueba_intermedia_3_1_básico 2013.pdf">1&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/Orientaciones_para_la_aplicacion_prueba_intermedia_3_2_ basico 2013.pdf">2&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/Orientaciones_para_la_aplicacion_prueba_intermedia_3_3_basico 2013.pdf">3&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/Orientaciones_para_la_aplicacion_prueba_intermedia_3_4_basico_2013.pdf">4&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/Orientaciones_para_la_aplicacion_prueba_intermedia_3_5_basico_2013.pdf">5&ordm;</a></td>
							</tr>
                        	</table> 
                        	</li>
                    	</ul>
                	</li>
            	</ul>
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
<br/>        
		<div id="cajaCentralFondo" >
				<div id="cajaCentralTop">
                <p class="titulo_jornada"> Evaluaci&oacute;n 4</p>
            	</div>
	            <ul>
    	            <li>
        	            <ul>
	                        <li>
							<table border="0" cellspacing="0" cellpadding="0">
							<tr>
                                <td width="150">Prueba	</td>
                                <td width="50"><a href="subir/docs/Prueba Intermedia 4_1_basico 2013.pdf">1&ordm;</a> - </td>
                                <td width="50"><a href="subir/docs/Prueba Intermedia 4_2_basico 2013.pdf">2&ordm;</a> - </td>
                                <td width="50"><a href="subir/docs/Prueba Intermedia 4_3_basico 2013.pdf">3&ordm;</a> - </td>
                               <!-- <td width="50"><a href="subir/docs/Prueba Intermedia_3_4_basico_2013.pdf">4&ordm;</a> - </td>
                                <td width="50"><a href="subir/docs/Prueba_Intermedia_3_5_basico_2013.pdf">5&ordm;</a></td>-->
	                          </tr>
    	                    </table>
        	                </li>
	                        <li>
    	                    <table border="0" cellspacing="0" cellpadding="0">
							<tr>
                            	<td width="150">Pauta correcci&oacute;n</td>
                                <td width="50"><a href="subir/docs/PC Prueba intermedia 4  1 Basico 2013.pdf">1&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/PC Prueba intermedia 4  2 Basico 2013.pdf">2&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/PC Prueba intermedia 4  3 Basico 2013.pdf">3&ordm;</a> -</td>
                                <!--<td width="50"><a href="subir/docs/PC_Prueba_intermedia_3_4_Basico_2013.pdf">4&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/PC_Prueba_intermedia_3_5_Basico_2013.pdf">5&ordm;</a></td>-->
							</tr>
							</table> 
                        	</li>
                        	<li>
                        	<table border="0" cellspacing="0" cellpadding="0">
                          	<tr>
                            	<td width="150">Protocolo aplicaci&oacute;n</td>
                                <td width="50"><a href="subir/docs/Orientaciones para la aplicacion Prueba Intermedia 4 _1 basico 2013.pdf">1&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/Orientaciones para la aplicacion Prueba Intermedia 4 _2 basico 2013.pdf">2&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/Orientaciones para la aplicacion Prueba Intermedia 4 _3 basico 2013.pdf">3&ordm;</a> -</td>
                                <!--<td width="50"><a href="subir/docs/Orientaciones_para_la_aplicacion_prueba_intermedia_3_4_basico_2013.pdf">4&ordm;</a> -</td>
                                <td width="50"><a href="subir/docs/Orientaciones_para_la_aplicacion_prueba_intermedia_3_5_basico_2013.pdf">5&ordm;</a></td>-->
							</tr>
                        	</table> 
                        	</li>
                    	</ul>
                	</li>
            	</ul>
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->

        <?php //} ?>
        <!--
             <div id="cajaCentralFondo" >
        
            <div id="cajaCentralTop">
                <p class="titulo_jornada"> Evaluaci&oacute;n 2</p>
            </div>

            <ul >
                <li>
                    <ul >
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Prueba	</td>
                            <td width="50"><a href="subir/docs/prueba2_primerobasico_MS.pdf">1&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/prueba2_segundobasico_MS.pdf">2&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/prueba2_tercerobasico_MS.pdf">3&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/prueba2_cuartobasico_MS.pdf">4&ordm;</a></td>
                          </tr>
                        </table>
                        </li>
                        
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Pauta correcci&oacute;n</td>
                            <td width="50"><a href="subir/docs/pauta_de_correccion_prueba2_primerobasico_MS.pdf">1&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/pauta_de_correccion_prueba2_segundobasico_MS.pdf">2&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/pauta_de_correccion_prueba2_tercerobasico_MS.pdf">3&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/pauta_de_correccion_prueba2_cuartobasico_MS.pdf">4&ordm;</a></td>
                          </tr>
                        </table> 
                        </li>
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Protocolo aplicaci&oacute;n</td>
                            <td width="50"><a href="subir/docs/orientacionesaplicacion_prueba2_primerobasico_MS.pdf">1&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/orientacionesaplicacion_prueba2_segundobasico_MS.pdf">2&ordm;</a> -</td>
							<td width="50"><a href="subir/docs/orientacionesaplicacion_prueba2_tercerobasico_MS.pdf">3&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/orientacionesaplicacion_prueba2_cuartobasico_MS.pdf">4&ordm;</a></td>
                          </tr>
                        </table> 
                        </li>
                        
                    </ul>
                </li>
            </ul>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->

        <!--
         <div id="cajaCentralFondo" >
        
            <div id="cajaCentralTop">
                <p class="titulo_jornada"> Evaluaci&oacute;n 3</p>
            </div>

            <ul >
                <li>
                    <ul >
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Prueba	</td>
                            <td width="50"><a href="subir/docs/1_PRUEBA3_MS.pdf">1&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/2_PRUEBA3_MS.pdf">2&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/3_PRUEBA3_MS.pdf">3&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/4_PRUEBA3_MS.pdf">4&ordm;</a></td>
                          </tr>
                        </table>
                        </li>
                        
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Pauta correcci&oacute;n</td>
                            <td width="50"><a href="subir/docs/1_PAUTA_DE_CORRECCION_PRUEBA3_MS.pdf">1&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/2_PAUTA_CORRECCION_PRUEBA3_MS.pdf">2&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/3_PAUTA_DE_CORRECCION_PRUEBA3_MS.pdf">3&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/4_PAUTA_DE_CORRECCION_PRUEBA3_MS.pdf">4&ordm;</a></td>
                          </tr>
                        </table> 
                        </li>
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Protocolo aplicaci&oacute;n</td>
                            <td width="50"><a href="subir/docs/1_ORIENTACIONES_APLICACION_PRUEBA3_MS.pdf">1&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/2_ORIENTACION_APLICACION_PRUEBA3_MS.pdf">2&ordm;</a> -</td>
							<td width="50"><a href="subir/docs/3_ORIENTACIONES_APLICACION_PRUEBA3_MS.pdf">3&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/4_ORIENTACIONES_APLICACION_PRUEBA3_MS.pdf">4&ordm;</a></td>
                          </tr>
                        </table> 
                        </li>
                        
                    </ul>
                </li>
            </ul>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
        <!--
          <div id="cajaCentralFondo" >
        
            <div id="cajaCentralTop">
                <p class="titulo_jornada"> Evaluaci&oacute;n 4</p>
            </div>

            <ul >
                <li>
                    <ul >
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Prueba	</td>
                            <td width="50"><a href="subir/docs/1_PRUEBA4_MS.pdf">1&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/2_PRUEBA4_MS.pdf">2&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/3_PRUEBA4_MS.pdf">3&ordm;</a> - </td>
                            <td width="50"><a href="subir/docs/4_PRUEBA4_MS.pdf">4&ordm;</a></td>
                          </tr>
                        </table>
                        </li>
                        
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Pauta correcci&oacute;n</td>
                            <td width="50"><a href="subir/docs/1_PAUTA_DE_CORRECCION_PRUEBA4_MS.pdf">1&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/2_PAUTA_CORRECCION_PRUEBA4_MS.pdf">2&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/3_PAUTA_DE_CORRECCION_PRUEBA4_MS.pdf">3&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/4_PAUTA_DE_CORRECCION_PRUEBA4_MS.pdf">4&ordm;</a></td>
                          </tr>
                        </table> 
                        </li>
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Protocolo aplicaci&oacute;n</td>
                            <td width="50"><a href="subir/docs/1_ORIENTACIONES_APLICACION_PRUEBA4_MS.pdf">1&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/2_ORIENTACION_APLICACION_PRUEBA4_MS.pdf">2&ordm;</a> -</td>
							<td width="50"><a href="subir/docs/3_ORIENTACIONES_APLICACION_PRUEBA4_MS.pdf">3&ordm;</a> -</td>
                            <td width="50"><a href="subir/docs/4_ORIENTACIONES_APLICACION_PRUEBA4_MS.pdf">4&ordm;</a></td>
                          </tr>
                        </table> 
                        </li>
                        
                    </ul>
                </li>
            </ul>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->


		<br>
        <center>
            <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('evaluacionHome.php','_self')">
                <span class="ui-button-text">Volver</span>
            </button>
        </center>
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>
