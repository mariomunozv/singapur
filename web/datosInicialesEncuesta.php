<?php 
ini_set("display_errors","On");
//include "inc/conectav10.php";
//include "inc/funciones.php";
require("inc/incluidos.php");
require("inc/_pauta.php");
require("hd.php");




$idUsuario =  $_SESSION["sesionIdUsuario"];
//$_SESSION["listaItem"] = 1;
//$_SESSION["indice"] = 1;
$idFormulario = $_GET["formulario"];
$_SESSION["idFormulario"] = $idFormulario;


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
		
	$sql = "SELECT * FROM seccionFormulario  WHERE idFormulario = '$idFormulario' AND tituloSeccionFormulario <> 'Datos' ORDER BY idSeccionFormulario ASC";
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

function getItemSeccion($idSeccion)
{
	$sql = "SELECT * FROM detalleSeccionEnunciado  WHERE  idSeccionFormulario  = '$idSeccion' ORDER BY idEnunciado  ASC";
	//echo $sql;
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


//Primero se traen todas las secciones de un formulario, que no sean la sección que tiene los encabezados de la encuesta.
$secciones = getSeccionesFormulario($idFormulario);

//Por cada sección, se acomulan los enunciados en un array que luego será enviado
$enunciados = array(); //se declara el array de enunciados que será llenado en caada iteración que se haga por sección
foreach($secciones as $seccion)
{
	$enunlista = getItemSeccion($seccion['idSeccionFormulario']); 
	$enunciados = array_merge($enunciados,$enunlista); //se une los enunciados existentes, con los de la siguiente sección
}


if(existePauta($idUsuario,$idFormulario))
{?>
	<script language="javascript">alert("Usted ya contestó la encuesta")</script>>
<?php 
	dirigirse_a("home.php");
}else{	
	$idPauta = creaPauta($idFormulario,$idUsuario);
}
$rutUsuario = $_SESSION["sesionRutUsuario"];
$_SESSION["sesionIdUsuario"] = $idUsuario;
$_SESSION["idPauta"] = $idPauta;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pensar Sin Límites</title>
<style type="text/css">
<!--
.style1 {color: 0}
.style4 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: large;
	color: #000033;
	font-weight: bold;
}

a {
	font-family: Georgia, Times New Roman, Times, serif;
	font-size: x-small;
	color: #FFFFFF;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #CCCCCC;
}
a:hover {
	text-decoration: none;
	color: #6297BF;
}
a:active {
	text-decoration: none;
}
.style6 {
	font-size: small;
	color: #FFFFFF;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.style7 {font-size: x-small}
-->
</style>

<style type="text/css">
<!--
body {
	background-image: url(img/bg.jpg);
	background-repeat: repeat;
}
.style8 {font-size: medium}
.style9 {color: #666600}
.style10 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000033;
}
.style5 {	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: x-small;
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/main.js"></script> 
<script language="javascript">
var MsjTipico = "<center><img src='img/loading.gif' alt='Cargando'><br>Cargando</center>";

function cargarDatosIniciales(){
	var division = document.getElementById("datos");
	<?php 
		switch($idFormulario)
		{
			case 1:
				echo "AJAXPOST('datosInicialDirector.php','',division)";
				break;
				
			case 2:
				echo "AJAXPOST('datosInicialEstudiante.php','',division)";
				break;
				
			case 3:
				echo "AJAXPOST('datosInicialUTP.php','',division)";
				break;
				
			case 26:
				echo "AJAXPOST('datosInicialDocente.php','',division)";
				break;
				
			default:
				echo "no carga nada";
				break;
		}
	?>
}
</script>

</head>

<body>
<form id="form" name="form" method="post" action="guarda.php">
<table width="923" border="10" align="center" cellpadding="0" cellspacing="0" bordercolor="#004600">
  <tr>
    <td width="901" align="center" valign="top"><div align="center">
      
	  <table width="901" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="981" align="left" valign="top"><span class="style1"><img src="img/header.jpg" width="950" height="170"></span></td>
        </tr>
        <tr>
          <td align="center" valign="top" bgcolor="#004600"><table width="90%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
            <span class="style1"></span></td>
        </tr>
				
        <tr>
          <td align="center" valign="top" bgcolor="#FFFFFF">
		  	<div id="datos"></div>
		  </td>
        </tr>
        <tr>
          <td align="center" valign="bottom" bgcolor="#004600"><div align="center" class="style6 style7"><img src="img/trans.gif" width="10" height="18" />Avda. Schatchtebeck N&ordm; 4 (Z&oacute;calo Biblioteca Central) &bull; Estaci&oacute;n Central &bull; Santiago &bull; Chile &bull; Tel&eacute;fono (562) 718 20 84 &bull; www.centrofelixklein.cl</div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
</form>


<script language="javascript">
	cargarDatosIniciales();
</script>

</body>
</html>
				  