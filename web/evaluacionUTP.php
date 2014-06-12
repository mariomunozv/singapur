<?php 
require("inc/incluidos.php");
require ("hd.php");
?>

<body>
<div id="principal">
<?php require("topMenu.php"); ?>
	
    <div id="lateralIzq">
    <?php 
		require("caja_misCursos.php");
        require("caja_glosarioPalabra.php");
        require("caja_participantes.php");
        require("caja_mensajes.php");
	
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
		<?php 
        require("caja_bienvenida.php");
        require("caja_calendario.php");
        ?>
    
    </div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
     
		
        <p class="titulo_curso">Evaluación de aprendizajes</p>
        <hr />
        <br />
        
        <div id="cajaCentralFondo" >
        
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                Evaluación 1
                </p>
            </div>

            <ul >
                <li>
                    <ul >
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Prueba	</td>
                            <td width="50"><a href="">1º</a> - </td>
                            <td width="50"><a href="">2º</a> - </td>
                            <td width="50"><a href="">3º</a> - </td>
                            <td width="50"><a href="">4º</a></td>
                          </tr>
                        </table>
                        </li>
                        
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Pauta corrección</td>
                            <td width="50"><a href="">1º</a> -</td>
                            <td width="50"><a href="">2º</a> -</td>
                            <td width="50"><a href="">3º</a> -</td>
                            <td width="50"><a href="">4º</a></td>
                          </tr>
                        </table> 
                        </li>
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Protocolo aplicación</td>
                            <td width="50"><a href="">1º</a> -</td>
                            <td width="50"><a href="">2º</a> -</td>
                            <td width="50"><a href="">3º</a> -</td>
                            <td width="50"><a href="">4º</a></td>
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
