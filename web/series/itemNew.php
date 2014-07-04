<?php
session_start();
include "../inc/conecta.php";
include "../inc/_funciones.php";
//include "sesion/sesion.php";
Conectarse_seg();

$idLista = $_SESSION["idLista"];
function getItem($idItem){
	$sql = "select * from item WHERE idItem = ".$idItem;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$item=array("idItem"=> $row["idItem"],
					"enunciadoItem"=> html_entity_decode(htmlentities($row["enunciadoItem"])),
					"esAbiertoItem"=> $row["esAbiertoItem"],
					"fondoItem"=> $row["fondoItem"]	,
					"cantidadRespuestasItem"=> $row["cantidadRespuestasItem"],
					"puntajeItem"=> $row["puntajeItem"],
					"respuestaCorrectaItem"=> $row["respuestaCorrectaItem"]
					);
	return($item);
}


function getNumIntentosActividad($lista,$usuario){

	$sql = "select count(*) from  pautaItem where idLista= ".$lista." and  idUsuario=".$usuario;
	$res = mysql_query($sql);

	$intentos = 0;

	while($row=mysql_fetch_row($res)){
  		$intentos = $row[0];
	}

	return $intentos;

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


$idUsuario = $_SESSION["sesionIdUsuario"];
$lista = $_SESSION["listaResolucion"];


$j = $_SESSION["indice"];
//echo $j."indice";
$idItem = $lista[$j]["idItem"];


//$intento = $_SESSION["intento"];
$item = getItem($idItem);
//print_r($item);
$imagen = $item["fondoItem"];


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
    <script src="../js/jquery-1.9.1.js"></script>
<link href="../css/custom-theme/jquery-ui-1.8rc3.custom.css" type="text/css" rel="stylesheet" />
<!-- <link href="../css/ecuaciones.css" rel="stylesheet" type="text/css" /> -->
   <style type="text/css">
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



	<script type="text/javascript" src="../js/jquery.numeric.js"></script>


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

var enviado = false;
function validaItem(abierto){
	if (!enviado) {
		enviado = true;
		//alert(document.getElementById("respuesta0").value);
		if (abierto == 1){
					// var cantidad = document.getElementById("cantidadRespuestasItem").value;
					// var resp_0 = document.getElementById("respuesta0").value;
					// var contesta = document.getElementById("contestoAlgo").value;

					//alert(contesta);
					//if( cantidad == 1 && resp_0 == ""){
				// 	if( contesta == ""){
				// 	alert("Debe ingresar un valor para responder");
				// 	//resp_0.focus();
				// }else{

					document.form.submit();

					// }

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
				enviado = false;
				alert("Debes seleccionar una alternativa");
			}
			// document.form.action = "pregunta_guarda.php";

			//document.form.submit();
		}
	}

}



setTimeout(addSeg, 0);
var segundos = <?php echo $_SESSION["tiempo"];?>;

function addSeg() {
	document.getElementById("tiempo").value = segundos;
	if (segundos < 40*60){
		document.getElementById("spanreloj").innerHTML = formatTime(segundos);
		setTimeout(addSeg, 1000);
		segundos = segundos + 1;
	}else{
		window.location = "finNew.php";
	}
};

var formatTime = function(segundos) {
	var minutos = parseInt(segundos/60);
	var seg = segundos - (minutos * 60);
	if (seg < 10) {
		seg = "0" + seg;
	}
	if (minutos < 10) {
		minutos = "0" + minutos;
	}
	updateTimeSession(segundos);
	return minutos + ":" + seg;
};

var updateTimeSession = function (segundos) {
	$.ajax({
	  url: 'timeSession.php',
	  type: 'POST',
	  data: {tiempo: segundos},
	  complete: function(xhr, textStatus) {
	    //called when complete
	  },
	  success: function(data, textStatus, xhr) {
	    //console.log("Cambiada la sesion");
	  },
	  error: function(xhr, textStatus, errorThrown) {
	    //console.log("el terrible error");
	    //called when there is an error
	  }
	});
}
</script>

</head>

<body OnContextMenu="return false">
<!-- Panel -->
<?php //include("barra.php");?>
<div id="todo">
<div id="top">&nbsp;</div>
	<div id="contenido">

  <table style="background-color: #FFF;"  border="0" height="100%" cellpadding="0" cellspacing="0" width="100%">

		<td  valign="top"  width="100%"><table width="980" border="0">
		  <tr>
		  	Intento: <?php echo getNumIntentosActividad($idLista,$idUsuario);?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Tiempo: <span id="spanreloj"><?php echo $_SESSION["tiempo"];?></span>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Pregunta: <?php echo $_SESSION["indice"] + 1;
			?>
		    <td width="974"><table border="0" cellpadding="0" cellspacing="0" width="100%">
		      <tr>
		        <td valign="top"><table border="0,5" cellpadding="0" cellspacing="0" bordercolor="#666666" width="100%">
		          <tr>
		            <td width="929"  valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

		                <td class="enunciadoProblema" id="enunciado">
                        <div align="left" id="textoEnunciado">
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
		                <td rowspan="5"  valign="top" bgcolor="#FFFFFF" id="fondo">
		                	<img src="<?phpecho $imagen;?>"/>
		                	<?php //imprimeCodigoFlash2($datos);?>
		                </td>
		                <td align="center" bgcolor="#FFFFFF">
                        <table border="0" cellpadding="0" cellspacing="0">

                    <form autocomplete="off" name="form" method="post" action="guardaItemNew.php">
                        <input type="hidden" id="indice" name="indice" value="<?php  echo $j;?>" />
                        <input type="hidden" id="tiempo" name="tiempo" value="<?php echo $_SESSION["tiempo"];?>" />
                        <input type="hidden"  id="cantidadRespuestasItem" name="cantidadRespuestasItem" value="<?php  echo $item["cantidadRespuestasItem"];?>" />
                        <input type="hidden" id"esAbierto" name="esAbierto" value="<?php  echo $item["esAbiertoItem"];?>" />


                         <?php

						 if($item["cantidadRespuestasItem"] > 1){
								  $letras = array("A","B","C","D","E","F","G","H","I","J");
							 }else{
								  $letras = array("");
								}



 								$respuestaCerrada = getRespuestaCerradaItem($idItem);
								$valorCorrecta = $respuestaCerrada["idAlternativaItem"];
								$opcionCorrecta = $respuestaCerrada["nombreAlternativaItem"];
								$alternativas = getAlternativas($idItem);
								if ($item["esAbiertoItem"] != 1){
									shuffle($alternativas);
								}
								 $i = 1;
								 $j = 0;
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
											<?php
												$abierto = 1;
												if ($item["esAbiertoItem"] != 1){
													$abierto = 0;
											?>
													<input type="radio" name="respuesta" id="respuesta<?php echo $i; ?>" value="<?php echo $alternativa["idAlternativaItem"];?>" class="crirHiddenJS">
											<?php
												}
											?>
									    </td>
										<td bgcolor="#41B200">&nbsp;</td>
										<td bgcolor="#F3F3F3"><img src="img/transparent.gif" width="5"></td>

                                        <!-- Aquí va el texto de la alternativa-->
                                         <?php if(strlen($alternativa["nombreAlternativaItem"]) > 400) {
											$ancho = 500;
										}else{
											$ancho = 270;
											}?>

                                        <td id="alternativa" title="Click para seleccionar la alternativa" width="<?php echo $ancho;?>" class="alternativa" bgcolor="#F3F3F3" height="40" onclick="check=document.getElementById('respuesta<?php echo $i; ?>');
											check.checked=(check.checked==true)?true:true;">

											<table>
												<tr>
													<td rowspan="3">
													<?php
													echo $alternativa["nombreAlternativaItem"];

													if ($alternativa["tipoCampo"] == "normal") {
														echo ' <input name="entero['.$j.']" type="text">';
													}
													if ($alternativa["tipoCampo"] == "numerico") {
														echo ' <input name="entero['.$j.']" type="text" size="5" class="numeric">';
													}
													if ($alternativa["tipoCampo"] == "fraccion") {
														echo '</td><td><input name="numerador['.$j.']" type="text" size="5" class="integer"></td></tr>
															<tr><td><hr noshade Size="3"></td></tr>
															<tr><td><input name="denominador['.$j.']" type="text" size="5" class="integer">';
													}
													if ($alternativa["tipoCampo"] == "numeroMixto") {
														echo '</td><td rowspan="3"><input type="text" name="entero['.$j.']" size="5" class="integer"></td><td><input name="numerador['.$j.']" type="text" size="5" class="integer"></td></tr>
															<tr><td><hr noshade Size="3"></td></tr>
															<tr><td><input name="denominador['.$j.']" type="text" size="5" class="integer">';
													}
													$j++;
													?>
													</td>
												</tr>
											</table>

										<?php
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

								 <?php
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
		                <td valign="middle" >

                            <br>

                            <?php boton("Responder","validaItem(".$abierto.");");?>

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

<script type="text/javascript">
	$('.fraction').each(function(key, value) {
	    var split = $(this).html().split("/")
	    if( split.length == 2 ){
	        $(this).html('<span class="ftop">'+split[0]+'</span><span class="fbottom">'+split[1]+'</span>')
	    }
	});
	$(".numeric").numeric();
	$(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });

</script>

</body>
</html>
