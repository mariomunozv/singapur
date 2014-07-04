<?php
session_start();
include "../inc/conecta.php";
include "../inc/funciones.php";
//include "sesion/sesion.php";
Conectarse_seg();
function getItem($idItem){
	$sql = "select * from item WHERE idItem = ".$idItem;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$item=array("idItem"=> $row["idItem"],
					"enunciadoItem"=> html_entity_decode(htmlentities($row["enunciadoItem"])),
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



function getAlternativas($idItem){
	$sql = "select * from alternativaItem WHERE idItem = ".$idItem;
	$res = mysql_query($sql);
	//echo $sql;
	$i =0;
	$alternativas = array();
	while ($row = mysql_fetch_array($res)) {
		$alternativas[$i]=array("idAlternativaItem"=> $row["idAlternativaItem"],
								"nombreAlternativaItem"=> html_entity_decode(htmlentities($row["nombreAlternativaItem"])),
								"esCorrectaAlternativaItem"=> $row["esCorrectaAlternativaItem"]		,
								"imagenAlternativaItem"=> $row["imagenAlternativaItem"]		,
								"esImagenAlternativaItem"=> $row["esImagenAlternativaItem"],
								"tipoCampo"=> $row["tipoCampo"],
								"funcionEvaluadora"=> $row["funcionEvaluadora"],
								"entero"=> $row["entero"],
								"entero2"=> $row["entero2"],
								"numerador"=> $row["numerador"],
								"numerador2"=> $row["numerador2"],
								"denominador"=> $row["denominador"],
								"denominador2"=> $row["denominador2"]
								);
	$i++;
	}
	return($alternativas);
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
$idItem = $_REQUEST["idItem"];
$item = getItem($_REQUEST["idItem"]);
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<!-- <link href="../css/ecuaciones.css" rel="stylesheet" type="text/css" /> -->
   <style type="text/css">
		/*.fraction, .ftop, .fbottom {
		    padding: 0 5px;
		}

		.fraction {
		    display: inline-block;
		    text-align: center;
		}

		.fbottom{
		    border-top: 1px solid #000;
		    display: block;
		}*/

		.fraction {
		    display: inline-block;
		    position: relative;
		    vertical-align: middle;
		    letter-spacing: 0.001em;
		    text-align: center;
		    font-size: 12px;
		    }
		.fraction > span {
		    display: block;
		    padding: 0.1em;
		    }
		.fraction span.fbottom {border-top: thin solid black;}
		.fraction span.bar {display: none;}
   </style>





</head>

<body>
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
		                <td rowspan="5"  valign="top" bgcolor="#FFFFFF" id="fondo"><img src="<?php echo $datos;?>"/></td>
		                <td align="center" bgcolor="#FFFFFF">

                        <table border="0" cellpadding="0" cellspacing="0" width="500">

                         <?php

						 if($item["cantidadRespuestasItem"] > 1){
							 $letras = array("A","B","C","D","E","F","G","H","I","J");
							 }else{
								  $letras = array("");
								}

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





									</td>
										<td bgcolor="#41B200">&nbsp;</td>
										<td bgcolor="#F3F3F3"><img src="img/transparent.gif" width="5"></td>

                                        <!-- Aquí va el texto de la alternativa-->
                                        <?php if(strlen($alternativa["nombreAlternativaItem"]) > 400){
											$ancho = 550;
										}else{
											$ancho = 270;
											}?>

                                        <td id="alternativa" width="<?php echo $ancho;?>" class="alternativa" bgcolor="#F3F3F3" height="40" onclick="check=document.getElementById('respuesta<?php echo $i; ?>');
											check.checked=(check.checked==true)?true:true;">

											<table>
												<tr>
													<td rowspan="3">
													<?php
													echo $alternativa["nombreAlternativaItem"];

													if ($alternativa["tipoCampo"] == "normal") {
														echo ' <input type="text" disabled>';
													}
													if ($alternativa["tipoCampo"] == "numerico") {
														echo ' <input type="text" size="5" disabled class="integer">';
													}
													if ($alternativa["tipoCampo"] == "fraccion") {
														echo '</td><td><input type="text" size="5" disabled></td></tr>
															<tr><td><hr noshade Size="3"></td></tr>
															<tr><td><input type="text" size="5" disabled>';
													}
													if ($alternativa["tipoCampo"] == "numeroMixto") {
														echo '</td><td rowspan="3"><input type="text" size="5" disabled></td><td><input type="text" size="5" disabled></td></tr>
															<tr><td><hr noshade Size="3"></td></tr>
															<tr><td><input type="text" size="5"  disabled>';
													}
													$i++;
													?>
													</td>
												</tr>
											</table>
                                        </td>

										<td bgcolor="#F3F3F3"></td>
										<td background="img/x5.jpg">&nbsp;</td>
									  </tr>
									  <tr>
										<td width="10px" align="left" valign="bottom" background="img/x4.jpg"><img src="img/x6.jpg" width="14" height="14"></td>
										<td valign="top" background="img/x8a.jpg"><img src="img/x8a.jpg" width="1" height="14"></td>
										<td valign="top" background="img/x8b.jpg"><img src="img/x8b.jpg" width="1" height="14"></td>
										<td colspan="3" valign="top" background="img/x8.jpg"><img src="img/x8.jpg" width="1" height="14"></td>
										<td width="10px" align="right" valign="bottom" background="img/x5.jpg"><img src="img/x7.jpg" width="14" height="14"></td>
									  </tr>
                                      <tr><td>&nbsp;</td>
                                      </tr>

								 <?php
							  }

							  ?>




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

</div>

<script type="text/javascript">
	$('.fraction').each(function(key, value) {
	    var split = $(this).html().split("/")
	    if( split.length == 2 ){
	        $(this).html('<span class="ftop">'+split[0]+'</span><span class="fbottom">'+split[1]+'</span>')
	    }
	});
</script>





</body>
</html>
