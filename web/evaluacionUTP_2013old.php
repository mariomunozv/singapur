<?php 
ini_set("display_errors","on");
require("inc/incluidos.php");
require ("hd.php");
$idUsuario = $_SESSION["sesionIdUsuario"];
?>
<meta charset="iso-8859-1">
<body>
<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Home*mural.php?idCurso=$idCurso,Evaluacion*#";
	require("_navegacion.php");


?>
	
	<div id="lateralIzq">
   		<?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
		<?php require("menuright.php"); ?>
    </div><!--lateralDer-->
    
	<div id="columnaCentro">
	<p class="titulo_curso">Evaluaci&oacute;n de aprendizajes</p>
    <hr /><br />
	<?php //if(usuarioNoRA($idUsuario)){ //En clase _usuario.php ?>
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
                            <td width="50">5&ordm;</td>
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
                            <td width="50">5&ordm;</td>
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
                            <td width="50">5&ordm;</td>
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
			
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>