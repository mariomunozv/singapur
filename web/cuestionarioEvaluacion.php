<?php
ini_set("display_errors","ON");
//include "inc/conectav10.php";
//include "inc/funciones.php";
require("inc/incluidos.php");
require("hd.php");

$idUsuario = $_SESSION["sesionIdUsuario"];
//$nombreColegio =  $_SESSION["colegio"];
//$idFormulario = $_SESSION["idFormulario"]
$idFormulario = $_REQUEST["idFormulario"];
$_SESSION["idFormulario"] = $idFormulario;

function getNombreFormulario($idFormulario)
{
	$sql = "SELECT * FROM formulario where idFormulario = ".$idFormulario;
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$datos[$i] = array(
			"nombreFormulario"=> $row["nombreFormulario"]
			);
		$i++;
	}
	return($datos);
}


function creaPauta($idFormulario,$idUsuario){
	$sql_insert = "INSERT INTO `pauta` ( `idFormulario` , `idUsuario` , `idPauta` , `fechaRespuestaPauta`  )";
	$sql_insert .=" VALUES (";
   	$sql_insert .=" '$idFormulario', '$idUsuario', '',NOW( )";
	$sql_insert .=" )";					   
	//echo $sql_insert;
	$res_insert = mysql_query($sql_insert);
	$idPauta = mysql_insert_id();
	return ($idPauta);
}


function getSeccionesFormulario($idFormulario){
	$sql = "SELECT * FROM seccionFormulario  WHERE idFormulario = '$idFormulario' AND idSeccionFormulario <> 25 ORDER BY idSeccionFormulario ASC";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idSeccionFormulario"=> $row["idSeccionFormulario"],
			"tituloSeccionFormulario"=> $row["tituloSeccionFormulario"]
			);
		$i++;
	}
	return($arreglo);
}

function getItemSeccion($idSeccion){
		
	$sql = "SELECT * FROM detalleSeccionEnunciado  WHERE  idSeccionFormulario  = '$idSeccion' ORDER BY idSeccionFormulario ASC";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idEnunciado"=> $row["idEnunciado"]
		);
		$i++;
	}
	return($arreglo);
}	


function getTodosItem(){
	$sql = "SELECT * FROM detalleSeccionEnunciado  WHERE  idSeccionFormulario  = '4'  ORDER BY idEnunciado ASC";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idEnunciado"=> $row["idEnunciado"]
		);
		$i++;
	}
	return($arreglo);
}

function getAlternativas($idItem){
	$sql = "select * from alternativa a join etiqueta b on a.idEtiqueta = b.idEtiqueta WHERE a.idEnunciado = ".$idItem;
	$res = mysql_query($sql);
	//echo $sql;
	$i =0;
	$alternativas = array();
	while ($row = mysql_fetch_array($res)) {
		$alternativas[$i]=array("idEtiqueta"=> $row["idEtiqueta"],
								"nombreEtiqueta"=> $row["nombreEtiqueta"]
								);
	$i++;	
	}
	return($alternativas);
}

function getEnunciadosDeSeccion($idSeccion)
{
	$sql = "SELECT * FROM enunciado WHERE idEnunciado IN (";
	$sql .="SELECT idEnunciado 	FROM detalleSeccionEnunciado WHERE idSeccionFormulario = $idSeccion)";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idEnunciado"=> $row["idEnunciado"],
			"textoEnunciado" => $row["textoEnunciado"],
			"esAbiertaEnunciado" => $row["esAbiertaEnunciado"],
			"tipoInputEnunciado" => $row["tipoInputEnunciado"]
		);
		$i++;
	}
	
	return($arreglo);
}

function getEnunciadosTodos()
{
	$sql = "SELECT * FROM enunciado WHERE idEnunciado IN (";
	$sql .="SELECT idEnunciado 	FROM detalleSeccionEnunciado)";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idEnunciado"=> $row["idEnunciado"],
			"textoEnunciado" => $row["textoEnunciado"],
			"esAbiertaEnunciado" => $row["esAbiertaEnunciado"]
		);
		$i++;
	}
	return($arreglo);
}

$enunciados = getTodosItem();
$secciones = getSeccionesFormulario($idFormulario);
$frm = getNombreFormulario($idFormulario);
//$idPauta = creaPauta($idFormulario,$idUsuario);

$_SESSION["sesionIdUsuario"] = $idUsuario;
$_SESSION["indice"] = 0;

?>

<body>	
<div id="principal">

<div id="top">
<img src="img/header.jpg"> 
</div>


<table width="800" align="center" class="tablesorter">
<tr>
<th colspan="5"><h1><?php echo $frm[0]['nombreFormulario']; ?></h1></th>
</tr>
</table>	
<?php
foreach ($secciones as $seccion)
{
	if($seccion['idSeccionFormulario'] != 25){ ?>
		<table class="tablesorter" width="30%">
        	<tr>
            	<th width="80%"><h2><?php echo $seccion['tituloSeccionFormulario']?></h2></th>
				<th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
					<?php } $seccionEnunciado = getEnunciadosDeSeccion($seccion['idSeccionFormulario']);
					foreach ($seccionEnunciado as $pregunta)
					{ 
						if($pregunta['esAbiertaEnunciado'] == 0 && $pregunta['tipoInputEnunciado'] == "Radio")
						{?>
							<tr align='left'>
                            <?php if($pregunta['idEnunciado'] == 81)
							{
								echo "<td colspan='5'>".$pregunta['textoEnunciado']."</td>";
							}else{
								echo "<td>".$pregunta['textoEnunciado']."</td>";
							}
						}
						else if($pregunta['esAbiertaEnunciado'] == 0 && $pregunta['tipoInputEnunciado'] == "Check")
						{?>
							<tr align='left'>
							<td colspan="5"><?php echo $pregunta['textoEnunciado']?></td>
						<?php }
						else
						{?>
			  			    <tr align='left'>
							<td colspan="5"><?php echo $pregunta['textoEnunciado']?></td>
						<?php }
						if($pregunta['esAbiertaEnunciado'] == 0 && $pregunta['tipoInputEnunciado'] == "Radio")
						{
							$nomID = $pregunta['idEnunciado'];
							$alternativas = getAlternativas($nomID);
							$valores = 1;
							if($nomID == 81)
							{
								echo "<tr><td colspan='5'>";
								foreach ($alternativas as $alternativa){
									echo "<input type='radio' name='resp_$nomID' id='resp_$nomID' class='campos' value='$valores'>".$alternativa['nombreEtiqueta']."<br>";
									$valores++;
								}
								echo "</td></tr>";
							}else{
								foreach ($alternativas as $alternativa)
								{
									echo "<td align='center'><input type='radio' name='resp_$nomID' id='resp_$nomID' class='campos' value='$valores'></td>";
									$valores++;
								}
							}
						}
						else if($pregunta['esAbiertaEnunciado'] == 0 && $pregunta['tipoInputEnunciado'] == "Check")
						{?>
							<tr><td colspan="5" align="left">
                            <?php
							$alternativas = getAlternativas($pregunta['idEnunciado']);
							foreach ($alternativas as $alternativa)
							{

								$nomID = $pregunta['idEnunciado'];
								echo "<input type='checkbox' name='resp_".$nomID."[]' id='resp_$nomID' class='campos' value='".$alternativa['nombreEtiqueta']."'> ".$alternativa['nombreEtiqueta']."<br>";
							}
							?></td></tr><?php
						}
						else
						{?>
			  <tr>
								<td align='left' colspan='5'><textarea rows='5' cols='105' class="campos" name="resp_<?php echo $pregunta['idEnunciado']?>" id="resp_<?php echo $pregunta['idEnunciado']?>"></textarea></td>
			  </tr>
					<?php }
			echo "</tr>";
			}
		}
		echo "</tr>";
	?>
	<tr><td colspan="5"><input type="button" name="Enviar" id="Enviar" value="Finalizar Encuesta" onClick="javascript:enviarRespuestas();"></td></tr>
</table>
<?php require("pie.php"); ?>
</div>

<script language="javascript">

function validaRadios()
{
	<?php
	$i = 0;
	foreach ($secciones as $seccion)
	{
		if($i > 0)
		{
			$seccionEnunciado = getEnunciadosDeSeccion($seccion['idSeccionFormulario']);
			foreach ($seccionEnunciado as $pregunta)
			{
				if($pregunta['esAbiertaEnunciado'] == 0 && $pregunta['tipoInputEnunciado'] == "Radio")
				{
				?>
					var radio = document.getElementsByName("resp_"+<?php echo $pregunta["idEnunciado"];?>);
					var alerta = 0;

					for(var con=0; con < radio.length; con++)
					{

 					    if(radio[con].checked)
						{
							alerta++;
						}//if(!radio.checked)
					}//for(var con=0; con < radio.length; con++)
					if(alerta == 0)
					{
						alert("Debe completar todos los campos de la encuesta");
						radio[1].focus();
						return;
					}
				<?php}//if($pregunta["esAbiertaEnunciado"] == 0)
			}
	}
	$i++;
	}
	?>
	return true;
}

function validaTextAreas()
{
	<?php
	$i = 0;
	foreach ($secciones as $seccion)
	{
//		if($i > 0)
//		{
			$seccionEnunciado = getEnunciadosDeSeccion($seccion['idSeccionFormulario']);
			foreach ($seccionEnunciado as $pregunta)
			{
				if($pregunta["esAbiertaEnunciado"] == 1)
				{
				?>
					if(val_obligatorio("resp_<?php echo $pregunta["idEnunciado"];?>") == false){ return; } // CAMPOS

				<?php }//if($pregunta["esAbiertaEnunciado"] == 1)
			}
//		}
		$i++;
	}
	?>	
	return true;
}

/*
function validaDatos()
{
	if(val_obligatorio("RBD") == false){ return; } // CAMPOS
	if(val_obligatorio("Fecha de Aplicación") == false){ return; } // CAMPOS
	if(val_obligatorio("Entrevistador") == false){ return; } // CAMPOS
	return true;
}
*/

function enviarRespuestas()
{
	//if(validaDatos() &&	validaRadios() && validaTextAreas())
	if(validaRadios() && validaTextAreas())
	{
		var division = document.getElementById("finalizacion");
		var a = $(".campos").fieldSerialize();
		AJAXPOST("guardaCuestionarioEvaluacion.php",a,division);
	}
}

</script>
<div id="finalizacion"></div>
</body>
</html>