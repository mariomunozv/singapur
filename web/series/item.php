<?php
session_start();
include "../inc/conecta.php";
include "../inc/_funciones.php";
//include "sesion/sesion.php";
Conectarse_seg(); 
function getItem($idItem){
	$sql = "select * from item WHERE idItem = ".$idItem;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$item=array("idItem"=> $row["idItem"],
					"enunciadoItem"=> $row["enunciadoItem"],
					"esAbiertoItem"=> $row["esAbiertoItem"],
					"fondoItem"=> $row["fondoItem"]	,
					"cantidadRespuestasItem"=> $row["cantidadRespuestasItem"]	,
			"puntajeItem"=> $row["puntajeItem"]	,
			"respuestaCorrectaItem"=> $row["respuestaCorrectaItem"]	
			
					
					 
					);	
	return($item);
}
 
function getRespuestaCerradaItem($idItem){
	$sql = "select * from item WHERE idItem = ".$idItem;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$etiquetaCorrecta = getCorrecta($idItem);
	return($etiquetaCorrecta);
}

function getCorrecta($idItem){
	$sql = "SELECT * FROM alternativaItem";
	$sql.= " WHERE idItem = ".$idItem." and esCorrectaAlternativaItem = 1";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$alternativaCorrecta= array( "idAlternativaItem" =>$row["idAlternativaItem"],
								"nombreAlternativaItem" => $row["nombreAlternativaItem"]);				  
	
	return($alternativaCorrecta);
}

function getAlternativas($idItem){
	$sql = "select * from alternativaItem WHERE idItem = ".$idItem;
	$res = mysql_query($sql);
	//echo $sql;
	$i =0;
	$alternativas = array();
	while ($row = mysql_fetch_array($res)) {
		$alternativas[$i]=array("idAlternativaItem"=> $row["idAlternativaItem"],
								"nombreAlternativaItem"=> $row["nombreAlternativaItem"],
								"esCorrectaAlternativaItem"=> $row["esCorrectaAlternativaItem"]		,
								"imagenAlternativaItem"=> $row["imagenAlternativaItem"]		,
								"esImagenAlternativaItem"=> $row["esImagenAlternativaItem"]		
								);
	$i++;	
	}
	return($alternativas);
}

function muestraInputFraccion($i){
	echo "
		<table border='0' id='tablaFraccion'>
			<tr>
				<td>
					<input name='Entero".$i."' id='Entero".$i."' title='Parte Entera' type='text' size='1' class='numeroEntero' onkeyup='javascript:checkNumber(this);' onchange='contesta()' />
				</td>
				<td>
					<table>
						<tr>
							<td>
								<input name='respuesta".$i."' id='respuesta".$i."' type='text' title='Numerador' size='3' class='numeroFraccion' onkeyup='javascript:checkNumber(this);' onchange='contesta()'/>
							</td>
						</tr>
						<tr>
							<td>
								<hr />
							</td>
						</tr>
						<tr>
							<td>
								<input name='Denominador".$i."' id='Denominador".$i."' title='Denominador' type='text' size='3' class='numeroFraccion' onkeyup='javascript:checkNumber(this);' onchange='contesta()'/>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>";
}	
	
	
function imprimeCodigoFlash2($datos){
	
	/*
	echo '
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="'.$ancho.'" height="'.$alto.'" id="FlashID" title="'.$titulo.'">
	  <param name="movie" value="'.$archivo.'">
	  <param name="quality" value="high">
	  <param name="wmode" value="transparent">
	  <embed src="'.$archivo.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="'.$ancho.'" height="'.$alto.'"></embed>
	</object>
	';
	*/
	
	echo '
	
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="370" height="370" id="prueba2" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="../fondos/'.$datos.'" />


<param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="../fondos/'.$datos.'"  quality="high" bgcolor="#ffffff" width="370" height="370" name="prueba2" align="middle" swLiveConnect="true" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>';
	
}


$idUsuario = $_SESSION["sesionIdUsuario"];
$lista = $_SESSION["listaResolucion"];


$j = $_SESSION["indice"];
//echo $j."indice";
$idItem = $lista[$j]["idItem"];


//$intento = $_SESSION["intento"];



	$item = getItem($idItem);
	//print_r($item);
	$datos = $item["fondoItem"];
	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  	<title>Item</title>
  	<meta name="description" content="" />
  	<meta name="keywords" content="" />
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />	

	<!-- stylesheets -->
  
    <link rel="stylesheet" href="css/estilo.css" type="text/css" >
<link href="../css/custom-theme/jquery-ui-1.8rc3.custom.css" type="text/css" rel="stylesheet" />
<link href="../css/ecuaciones.css" rel="stylesheet" type="text/css" />	


<script type="text/javascript" src="../js/validNum.js"></script>
   
    
   

<script type="text/javascript">
   			
function contesta(){
	
	document.getElementById("contestoAlgo").value = "1";
}			
			
function omiteItem(){
  
  if((confirm("Esta seguro que desea omitir esta pregunta?"))){
	 document.form.respuesta.value = "omite"; 
	 document.form.omite.value = 1; 
	 document.form.submit();
  }else{
	document.form.respuesta.focus();
  }
}
   
   
function validaItem(abierto){
 
//alert(document.getElementById("respuesta0").value);
if (abierto == 1){
			var cantidad = document.getElementById("cantidadRespuestasItem").value;
			var resp_0 = document.getElementById("respuesta0").value;
			var contesta = document.getElementById("contestoAlgo").value;
			
			//alert(contesta);
			//if( cantidad == 1 && resp_0 == ""){
			if( contesta == ""){
			alert("Debe ingresar un valor para responder");
			//resp_0.focus();
		}else{
			
			document.form.submit();
			
			}
		
	}else{
		var i;
		var no=0;
		
		
		for (i=0;i<document.form.respuesta.length;i++){
				if (document.form.respuesta[i].checked == true){
					//alert(document.form.radio1[0].checked);
					no = 1;
				}
			
			//alert(document.form.radio1[0].checked);
		}
		if (no == 1){
			//alert("Gracias por contestar");
			//revisaRespuesta(abierto);
			document.form.submit();
			
			}else{
			 alert("Debes seleccionar una alternativa");
			}
// document.form.action = "pregunta_guarda.php";

//document.form.submit();
	}
}


</script>

</head>

<body OnContextMenu="return false">
<!-- Panel -->
<?php //include("barra.php");?>
<div id="todo">
<div id="top">&nbsp;</div>
	<div id="contenido">
    	
  <table border="0" height="100%" cellpadding="0" cellspacing="0" width="100%">
  
		<td  valign="top"  width="100%"><table width="980" border="0">
		  <tr>
		    <td width="974"><table border="0" cellpadding="0" cellspacing="0" width="100%">
		      <tr>
		        <td valign="top"><table border="0,5" cellpadding="0" cellspacing="0" bordercolor="#666666" width="100%">
		          <tr>
		            <td width="929"  valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		          
                      <tr>
                                    
		                <td class="enunciadoProblema" id="enunciado">
                        <div id="textoEnunciado">
					<?php echo $item["enunciadoItem"];?>
		               	</div>               
                        </td>
		                
                        </tr>
		              </table></td>
		            </tr>
		          <tr>
		            <td>
                     <table width="100%" border="0" cellpadding="0" cellspacing="1" bordercolor="#000000">
		              <tr>
                    <?php //$datos = $item;?>
		                <td rowspan="5"  valign="top" bgcolor="#FFFFFF" id="fondo"><?php imprimeCodigoFlash2($datos);?></td>
		                <td align="center" bgcolor="#FFFFFF">
                        
                        <table border="0" cellpadding="0" cellspacing="0">
                       
                        <form autocomplete="off" name="form" method="post" action="guardaItem.php">
                        <input type="hidden" id="indice" name="indice" value="<?php  echo $j;?>" />
                        <input type="hidden"  id="cantidadRespuestasItem" name="cantidadRespuestasItem" value="<?php  echo $item["cantidadRespuestasItem"];?>" />
                        <input type="hidden" id"esAbierto" name="esAbierto" value="<?php  echo $item["esAbiertoItem"];?>" />

                      
                       
                     
                       
                       
                         <?php 
						 
						 if($item["cantidadRespuestasItem"] > 1){
								  $letras = array("A","B","C","D","E","F","G","H","I","J");	 
							 }else{
								  $letras = array(""); 
								}
						
						
						
								////////////// ITEM ABIERTO (DEBE INGRESAR VALOR) /////////////////
			
						 if ($item["esAbiertoItem"] == 1){
							 
								////////////// ITEM ABIERTO (DEBE INGRESAR VALOR) /////////////////
				
							 $tipoRespuestas = explode(";",$item["respuestaCorrectaItem"]);

							 ?>

					<?php for ($i=0;$i<$item["cantidadRespuestasItem"];$i++){
						$tipoR = explode("*",$tipoRespuestas[$i]);
						
						
						?> 
                          <input type="hidden"  name="tipoR<?php echo $i;?>" value="<?php  echo $tipoR[0];?>" />	
                         <input type="hidden" id="contestoAlgo"  name="contestoAlgo" />                          
		                  <tr>
		                    <td align="left" valign="top" background="img/x4.jpg"><img src="img/x1.jpg" width="14" height="11"></td>
		                    <td valign="top" background="img/x3a.jpg"><img src="img/x3a.jpg" width="1" height="11"></td>
		                    <td valign="top" background="img/x3b.jpg"><img src="img/x3b.jpg" width="1" height="11"></td>
		                    <td colspan="2" valign="top" background="img/x3.jpg"><img src="img/x3.jpg" width="1" height="11"></td>
		                    <td align="right" valign="top" background="img/x5.jpg"><img src="img/x2.jpg" width="14" height="11"></td>
		                    </tr>

		                  <tr>
		                    <td background="img/x4.jpg">&nbsp;</td>
		                    <td  valign="middle" bgcolor="#80D305" class="textoRespuesta"><img src="img/transparent.gif"  height="10">Respuesta <?php echo $letras[$i]?>:  &nbsp;&nbsp;&nbsp;</td>
		                    <td bgcolor="#41B200">&nbsp;</td>
		                    <td bgcolor="#F3F3F3"><img src="img/transparent.gif" width="5" height="25"></td>
		                    <td width="160" bgcolor="#F3F3F3">
							<?php if ($tipoR[0] == "F" || $tipoR[0] == "FI"){ 
									echo  muestraInputFraccion($i); 
								}
							?> 
                            <?php if ($tipoR[0] == "Digito"){ 
									echo '<input name="respuesta'.$i.'" type="text" title="Dígito" onkeyup="javascript:checkNumber(this);" id="respuesta'.$i.'" size="1" maxlength="1" onchange="contesta()" />'; 
								}
							?>
							<?php if ($tipoR[0] == "D" || $tipoR[0] == "DecEq" || $tipoR[0] == "DI"){ 
									echo '<input name="respuesta'.$i.'" type="text" title="Decimal" onkeyup="javascript:checkDecimal(this);" id="respuesta'.$i.'" size="10" maxlength="10" onchange="contesta()" />';
								}
							?></td>
		                    <td background="img/x5.jpg">&nbsp;</td>
		                    </tr>

		                  <tr>
		                    <td align="left" valign="bottom" background="img/x4.jpg"><img src="img/x6.jpg" width="14" height="14"></td>
		                    <td valign="top" background="img/x8a.jpg"><img src="img/x8a.jpg" width="1" height="14"></td>
		                    <td valign="top" background="img/x8b.jpg"><img src="img/x8b.jpg" width="1" height="14"></td>
		                    <td colspan="2" valign="top" background="img/x8.jpg"><img src="img/x8.jpg" width="1" height="14"></td>
		                    <td align="right" valign="bottom" background="img/x5.jpg"><img src="img/x7.jpg" width="14" height="14"></td>
		                    </tr>
                            
                            
                          <?php }?>  

                         <?php	 }else{
   	 								$respuestaCerrada = getRespuestaCerradaItem($idItem);
									$valorCorrecta = $respuestaCerrada["idAlternativaItem"];
									$opcionCorrecta = $respuestaCerrada["nombreAlternativaItem"];
								 $alternativas = getAlternativas($idItem); 
								
								 shuffle($alternativas);
								 $i = 1;
								 foreach ($alternativas as $alternativa){	 
								 
								 ?>
                            
								 			  <tr>
										<td align="left" valign="top" background="img/x4.jpg"><img src="img/x1.jpg" width="14" height="11"></td>
										<td valign="top" background="img/x3a.jpg"><img src="img/x3a.jpg" width="1" height="11"></td>
										<td valign="top" background="img/x3b.jpg"><img src="img/x3b.jpg" width="1" height="11"></td>
										<td colspan="3" valign="top" background="img/x3.jpg"><img src="img/x3.jpg" width="1" height="11"></td>
										<td align="right" valign="top" background="img/x5.jpg"><img src="img/x2.jpg" width="14" height="11"></td>
										</tr>
									   
									  <tr>
										<td background="img/x4.jpg">&nbsp;</td>
										<td align="left" valign="middle" bgcolor="#80D305"><img src="img/transparent.gif" width="5" height="10">
										  
                                          
                                         
										<input type="radio" name="respuesta" id="respuesta<?php echo $i; ?>" value="<?php echo $alternativa["idAlternativaItem"];?>" class="crirHiddenJS">
                                        
									    </td>
										<td bgcolor="#41B200">&nbsp;</td>
										<td bgcolor="#F3F3F3"><img src="img/transparent.gif" width="5"></td>
										
                                        <!-- Aquí va el texto de la alternativa-->
                                         <?php if(strlen($alternativa["nombreAlternativaItem"]) > 400){
											$ancho = 500;
										}else{
											$ancho = 270;
											}?>
                                        
                                        <td id="alternativa" title="Click para seleccionar la alternativa" width="<?php echo $ancho;?>" class="alternativa" bgcolor="#F3F3F3" height="40" onclick="check=document.getElementById('respuesta<?php echo $i; ?>');
											check.checked=(check.checked==true)?true:true;">
										<?php 
										echo $alternativa["nombreAlternativaItem"]; 
										$i++;
										?>
                                        </td>
                                        
										<td bgcolor="#F3F3F3"></td>
										<td background="img/x5.jpg">&nbsp;</td>
									  </tr>
									  <tr>
										<td align="left" valign="bottom" background="img/x4.jpg"><img src="img/x6.jpg" width="14" height="14"></td>
										<td valign="top" background="img/x8a.jpg"><img src="img/x8a.jpg" width="1" height="14"></td>
										<td valign="top" background="img/x8b.jpg"><img src="img/x8b.jpg" width="1" height="14"></td>
										<td colspan="3" valign="top" background="img/x8.jpg"><img src="img/x8.jpg" width="1" height="14"></td>
										<td align="right" valign="bottom" background="img/x5.jpg"><img src="img/x7.jpg" width="14" height="14"></td>
									  </tr>
                                      <tr><td>&nbsp;</td>
                                      </tr>
                                      
								 <?php } 
							  }
							  
							  ?>     
                        	    </form>
                                  
						
                       
                            <tr>
                            <td colspan="6" align="center" valign="middle" width="300">
                         
                            

                            </a>
                            </td>
                            </tr>              
						
							
							
									
		                  </table>
                          
                       </td>
		                </tr>
		             
		          
		                 
		             
		              <tr>
		                <td align="right" valign="middle" >
                         
                            
                       
                            <?php boton("Responder","validaItem(".$item["esAbiertoItem"].");");?>
		                 
                        </td>
		                </tr>
		              </table></td>
		            </tr>
		          </table></td>
	          </tr>
	        </table></td> 
	      </tr>
	    </table></td>
	</tr>
</table>
    </div>
<div id="bottom">&nbsp;</div>
</div>
<span style="visibility:hidden" id="spanreloj"></span>


</body>
</html>
