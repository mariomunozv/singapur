<?php 
require("inc/incluidos.php");
ini_set("display_errors","on");

function comparar_fechas_mysql($a, $b){
	$a_v=explode("-",$a);
	$anyo_a = $a_v[0];
	$mes_a = $a_v[1];
	$dia_a = $a_v[2];

	$b_v=explode("-",$b);
	$anyo_b = $b_v[0];
	$mes_b = $b_v[1];
	$dia_b = $b_v[2];

	if($anyo_a > $anyo_b)
		return 1;
	else{
		if($anyo_a < $anyo_b)
			return -1;
		else{
			if($mes_a > $mes_b)
				return 1;
			else{
				if($mes_a < $mes_b)
					return -1;
				else{
					if($dia_a > $dia_b)
						return 1;
					else{
						if($dia_a < $dia_b)
							return -1;
						else
							return 0;
						}
					}
				}
			}
		}
	}
	
$flag = $_REQUEST["flag"];
$idTema = $_REQUEST["idForo"];
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"];
$abierto = 0; // 0 = cerrado, 1 = abierto
/* Registra Acceso a un Foro */
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 11, 'NULL');
$idPerfil = getIdPerfilUsuario($idUsuario);


if (isset($_REQUEST["idNotificacion"])){
	$idNotificacion = $_REQUEST["idNotificacion"];
	actualizaEstadoNotificacion($idNotificacion);
}




function muestraRespuestas($idTema,$orden){
	$fechaTema = getFechaTerminoTema($idTema);
	$fechaNow = date("Y-m-d");
	if(comparar_fechas_mysql($fechaTema,$fechaNow) == 1){ // paso el tiempo
		$abierto = 1; // abierto
	}else{
		$abierto = 0; // cerrado
	}
	$respuestasTema = getRespuestasTemaOrden($idTema,$orden);
	if ($respuestasTema[0]["contenidoMensajeTema"] == "No existen respuestas en este Foro."){?>
	<br />
		<table width="550" cellpadding="1" cellspacing="1" bgcolor="#FFF">
			<tr align="center">
			<td>No hay respuestas en este foro.</td>
			</tr>
		</table>
			<?php }else{
		$i = 0;
					foreach ($respuestasTema as $value[$i]) {
							
							$datosProfesor = getNombreFotoUsuarioProfesor($value[$i]["idUsuario"]);
							// print_r($datosProfesor);
							?>
						<a name="mensaje_<?php echo $value[$i]["idMensajeTema"];?>"></a>
						<table width="550" border="0" cellpadding="0" cellspacing="3">
                            
							<tr>
                              	<td></td>
								<td width="30">
							       	<img src="<?php echo "subir/fotos_perfil/th_".$datosProfesor["imagenUsuario"];?>" onerror="this.src='subir/fotos_perfil/nophotoMini.jpg'"  width="50" height="46" />
								</td>
                                
								<td width="515" height="46" class="style7">
                                	<span class="right style6 style10 style14">
								  		&nbsp; El 
										<?php echo fechaConFormato($value[$i]["fechaMensajeTema"]);?>
								  		<br />
                                        <strong>
                                        &nbsp;
										<?php echo "<a style='text-decoration:none' href='verPerfil.php?idUsuario=".$value[$i]["idUsuario"]."'>".getNombreUsuario($value[$i]["idUsuario"])."</a>"; ?>	
								  		</strong>
                                        <?php 
										echo " escribió:";
										?>
									</span>
								</td>
                                
							</tr>
							
                            <tr align="justify">
                            	<td></td>
                                <?php
								
								$colorMensaje = "#CCF2D9";
	
								$perfilUsuario = getIdPerfilUsuario($value[$i]["idUsuario"]);
								if ( $perfilUsuario == 9){
									$colorMensaje = "#92D050";
								}
								?>
								<td style="padding:10px;" colspan="2" bgcolor="<?php echo $colorMensaje; ?>">
									<?php echo nl2br($value[$i]["contenidoMensajeTema"]);?>
                            	</td>
                                <!-- Solo se puede comentar si el tema está abierto"; -->
                                <?php if($abierto>0){?> 
	                            <td><a href="#mensaje_<?php echo $value[$i]["idMensajeTema"];?>" onClick="javascript:nuevoComentario(<?php echo $value[$i]["idMensajeTema"];?>)">Comentar</a></td>
                                <?php }else{
									echo "<td></td>";
								}?>
							</tr>
                            <?php
							/* Ciclo Comentarios */
							$comentarios = getComentariosMensaje($value[$i]["idMensajeTema"]);
							if ($comentarios[0]){
								foreach ($comentarios as $comentario){
									
									$colorComentario = "#DFEFFC";
									
									$perfilUsuario = getIdPerfilUsuario($comentario["idUsuario"]);
									if ( $perfilUsuario == 9){
										$colorComentario = "#92D050";
									}
							
									
									$datosComentario = getNombreFotoUsuario($comentario["idUsuario"]);
									?>
                                    <tr align="justify" title="<?php echo fechaConFormato($comentario["fechaComentario"]); ?>">
                                        <td></td>
                                        <td></td>
                                        <td style="padding:2px; border-width:1px; border-style:dotted; background-color:<?php echo $colorComentario; ?>">
                                        <img src="img/coment.gif" width="16" height="16" />
                                       	<strong>
										<?php
										echo "<a style='text-decoration:none' href='verPerfil.php?idUsuario=".$comentario["idUsuario"]."'>".$datosComentario["nombre"]." ".$datosComentario["apellidoPaterno"]."</a>: ";
										?>
                                        </strong>
                                        <?php
										echo " ".$comentario["textoComentario"];
										
										?>
                                        </td>                                
                                    </tr>
                                    <?php		
								}
								
							
								//print_r($comentarios);
							}
								
							?>   
                            
                        <tr align="justify">
                            	<td></td>
								<td></td>
                                <td>
                                	<div id="nuevoComentario_<?php echo $value[$i]["idMensajeTema"];?>"></div> 
                                </td>                                
							</tr>
                        
						</table>
                        
						
							<?php 
							 $i++;   
					}
			}

	}
if ($flag == 1){
	$orden = "ASC";
	$flag = 0;
	}else{
	$orden = "DESC";	
	$flag = 1;	
		}
?>
<?php require ("hd.php");?>

<script language="javascript">
$(function() {
	<?php /* Asi inicializas tablesorter */ ?>	   
	$("#tabla").tablesorter({ 
		headers: {  
			5: { sorter: false },
			6: { sorter: false }  // Esto es para inabilitar el filtro en una columna
		},
		widthFixed: true,
		widgets: ['zebra']}).tablesorterPager({
			container: $("#pager"),
			positionFixed: false,
			size:1 //Numero de registros tb
			});  
}); 
</script> 

<script language="javascript">
		 	var MsjTipico = "<center><img src='images/loading.gif' alt='Cargando'><br>Cargando</center>";
</script>
<script language="javascript">

function nuevoMensaje(){  
   
	var division = document.getElementById("nuevoMensaje");
	AJAXPOST("nuevoMensajeForo.php","idForo=<?php echo $_REQUEST["idForo"];?>",division);  

}

function nuevoComentario(idMensaje){  
	var division = document.getElementById("nuevoComentario_"+idMensaje);
	AJAXPOST("nuevoComentarioForo.php","idMensaje="+idMensaje,division);  

}

function enviarMsj(){
	
	if(val_obligatorio("contenidoMensajeTema") == false){ return; } 
	if(confirm("¿Enviar ahora?")){
		var a = jQuery(".campos").fieldSerialize(); 
		
		var division = document.getElementById("nuevoMensaje");
		AJAXPOST("enviaMensajeForo.php",a,division);  
	}
}

function enviarComentario(idMensaje){
	
	if(val_obligatorio("contenidoComentario") == false){ return; } 
	if(confirm("¿Enviar ahora?")){
		var a = jQuery(".campos").fieldSerialize(); 
		var division = document.getElementById("nuevoComentario_"+idMensaje);
		AJAXPOST("enviaComentarioForo.php",a,division);  
	}
}

</script>
<script language="javascript">
function val_obligatorio(campo){
	jQuery("#"+campo).removeClass("alerta_btn");
	var valor = document.getElementById(campo+"").value + ""; 
	if(valor == ""){
		jQuery("#"+campo).addClass("alerta_btn");
		alert("Indique todos los campos obligatorios.");
		document.getElementById(campo+"").focus();
		return false;
	}
	return true;
}
</script>
<link type="text/css" href="css/custom-theme/jquery-ui-1.8rc3.custom.css" rel="Stylesheet" />	

<body>

<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Foro*#";	
	require("_navegacion.php");	
?>
    <div id="lateralIzq">
	<?php 
		require("menuleft.php");
		require ("categoriaForo.php");
	?>
    
    </div>
    
     <div id="lateralDer">
    <?php 		require("menuright.php"); ?>
    </div><!--lateralDer-->

<div id="columnaCentro">
	<p class="titulo_curso">Foros de Conversación</p>
    <hr />
	<?php      
  	$datosTema = getTema($idTema);
	//print_r($datosTema);
	$fecha_actual = date("Y-m-d");
	$datosProfesor = getNombreFotoUsuarioProfesor($datosTema["idUsuario"]);		
	?>
 
    <input type="hidden" name="idTema" class="campos" id="idTema" value="<?php echo @$idTema; ?>">             
  <table class="tablesorter" width="550" border="0" cellpadding="5" cellspacing="2" bgcolor="#B1D8B1">
        <tr>
            <td bgcolor="#33CC66" >
            	<strong>
              	<?php echo $datosTema["tituloTema"];?><br /> 
				<p align="right">
                <a href="temaDetalle.php?idForo=<?php echo $idTema;?>&flag=<?php echo $flag;?>">(Invertir orden de respuestas)</a>
                </p>
                </strong>
                <br />

        </td>
            
			<td width="50" height="46">
            	<img src="<?php echo "subir/fotos_perfil/th_".$datosProfesor["imagenUsuario"];?>" onerror="this.src='/nophoto.jpg'"  width="50" height="46" />
            </td>
        </tr>
        
        <tr align="justify">
          	<td colspan="2">
			El <?php echo fechaConFormato($datosTema["fechaTema"]);?>
				<strong>
				<?php echo "<a href='verPerfil.php?idUsuario=".$datosTema['idUsuario']."'>".getNombreUsuario($datosTema["idUsuario"])."</a>"; ?>	
				 	
                </strong>
                <?php 
                echo " escribió:";
                ?><br />
<br />
			<?php echo $datosTema["mensajeInicialTema"];?>
            </td>
        </tr>
        
	</table>
    <p align="right">
	<?php 
        boton("Volver","history.go(-1)");
		if(comparar_fechas_mysql($datosTema["fechaTerminoTema"],$fecha_actual) == 1){ // paso el tiempo
    	    boton("Responder","nuevoMensaje()");
		}else{
			info("Este tema ha sido cerrado en la fecha ".fechaConFormato($datosTema["fechaTerminoTema"]));	
		}
	?>
    </p>
               
	<div id="lugar_envio"></div>
    <div id="nuevoMensaje"></div>
    
    <br />
   
	<?php muestraRespuestas($idTema,$orden); ?>
</div>    

<?php   require("pie.php");?>

</div>
</body>
</html>
