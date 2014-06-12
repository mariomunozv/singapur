<?php 
require("inc/incluidos.php");
require ("hd.php");

/* Registra Lectura de mensaje */
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 4, 'NULL');
$idPerfil = getIdPerfilUsuario($idUsuario);

/* Se actualiza la notificacion en caso de ver el mensaje a traves de las notificaciones */
if (isset($_REQUEST["idNotificacion"])){
	$idNotificacion = $_REQUEST["idNotificacion"];
	actualizaEstadoNotificacion($idNotificacion);
}

	$_SESSION["listaDestinatarios"]=array();
	$datosMensaje = getMensaje($_REQUEST["idMensaje"]);
	
	//$idCurso=$_SESSION["sesionIdCurso"];
	
	if($idUsuario == $datosMensaje["paraMensaje"]){ // solo si el usuario actual es el receptor original del mensaje
	
		/* Se cambia el estado del mensaje, (leido = 1) */
		actualizaEstadoMensaje($_REQUEST["idMensaje"]);
	}
	
	
	/* Se registra el acceso de lectura de un mensaje */
	registraAcceso($idUsuario, 4, 'NULL');
	
	$datosDeUsuario = getNombreFotoUsuarioProfesor($datosMensaje["deMensaje"]);
$datosU = getDatosGenerico($datosMensaje["deMensaje"]);
?>

<body>
<div id="principal">
<?php require("topMenu.php"); ?>
	
    <div id="lateralIzq">
    <?php 
		require("caja_misCursos.php");
		require("caja_glosarioPalabra.php");
		require("caja_mensajes.php");
	
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
    <?php 
		require("caja_bienvenida.php");
		require("caja_eventosProximos.php");
		
	?>
    </div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
    	
        <h2><?php echo $datosMensaje["asuntoMensaje"]; ?></h2>
        <table width="100%" border="0" cellspacing="2">
            <tr>
                <td width="50">
                	<img src="<?php echo "subir/fotos_perfil/th_".$datosU["imagenUsuario"];?>" />
				</td>
                
                <td>
                	<div align="left">
                    	<strong>
						<?php

							$texto_de = $datosU["nombreParaMostrar"];
						
							echo $texto_de;
						?> 
                        </strong> dice: 
					</div>
				</td>
                
                <td>
                	<div align="right">
						<?php echo fechaConFormato($datosMensaje["fechaMensaje"]); ?>
                    </div>
				</td>
            </tr>
            
            <tr>
                <td colspan="3">
                <br />
				<?php echo $datosMensaje["contenidoMensaje"]; ?>
                </td>
			</tr>
            
			<tr>
                <td colspan="3">&nbsp;</td>
            </tr>
        </table>
        
        <p align="right">
       	 	<?php 
			boton("Volver","history.go(-1)");
			boton("Responder","responderMensaje(".$_REQUEST["idMensaje"].")");
			?>
        </p>
        
        <div id="nuevoMensaje"></div>
        <br>
			
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
</div><!--principal-->
</body>
</html>
