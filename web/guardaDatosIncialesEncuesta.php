<?php 
ini_set("display_errors","On");
require("inc/incluidos.php");
require("hd.php");


/*
function dirigirse_a($pagina){
	?><script language="javascript">
	location.href='<?php echo $pagina; ?>';
	</script><?php
}
*/
function getSeleccionada($respuesta){
	$sql = "select * from etiqueta WHERE idEtiqueta = ".$respuesta;
	//echo $sql;
	$res = mysql_query($sql);
	@$row = mysql_fetch_array($res);
	$valorSeleccionada = $row["nombreEtiqueta"];
	return($valorSeleccionada);
}

function setRespuesta($idEnunciado,$idFormulario,$idUsuario,$idPauta,$opcionSeleccionada,$valorSeleccionada){
	
	$sql_insert = "INSERT INTO `respuesta` ( `idEnunciado` , `idFormulario` , `idUsuario` , `idPauta` , `idRespuesta` ,  `opcionSeleccionada` ,`valorSeleccionada`   )";
	$sql_insert .= " VALUES ( '$idEnunciado', '$idFormulario', '$idUsuario', '$idPauta','','$opcionSeleccionada', '$valorSeleccionada')";
	$res = mysql_query($sql_insert);
	//echo $sql_insert; 
}


$idUsuario = $_SESSION["sesionIdUsuario"];
$idPauta = $_SESSION["idPauta"];
$idFormulario = $_SESSION["idFormulario"];
$tipoCuestionario = $_REQUEST["tipoCuestionario"];
$j = $_SESSION["indice"];


$int = @$_POST["int"];
switch($tipoCuestionario)
{
	/*
	case "director":
		$respuesta1 = @$_REQUEST["nombre"];
		$respuesta2 = @$_REQUEST["colegio"];
		$respuesta3 = @$_REQUEST["rbd"];
		$respuesta4 = @$_REQUEST["tiempo"];
		
		setRespuesta(688,$idFormulario,$idUsuario,$idPauta,$respuesta1,$respuesta1);
		setRespuesta(689,$idFormulario,$idUsuario,$idPauta,$respuesta2,$respuesta2);
		setRespuesta(690,$idFormulario,$idUsuario,$idPauta,$respuesta3,$respuesta3);
		setRespuesta(691,$idFormulario,$idUsuario,$idPauta,$respuesta4,$respuesta4);
		dirigirse_a("item.php");
	break;
	
	case "estudiante":
		$respuesta1 = @$_REQUEST["colegio"];
		$respuesta2 = @$_REQUEST["curso"];
		$respuesta3 = @$_REQUEST["letra"];
		$respuesta4 = @$_REQUEST["edad"];
		$respuesta5 = @$_REQUEST["sexo"];
		
		setRespuesta(692,$idFormulario,$idUsuario,$idPauta,$respuesta1,$respuesta1);
		setRespuesta(693,$idFormulario,$idUsuario,$idPauta,$respuesta2,$respuesta2);
		setRespuesta(694,$idFormulario,$idUsuario,$idPauta,$respuesta3,$respuesta3);
		setRespuesta(695,$idFormulario,$idUsuario,$idPauta,$respuesta4,$respuesta4);
		setRespuesta(696,$idFormulario,$idUsuario,$idPauta,$respuesta5,$respuesta5);
		dirigirse_a("item.php");
	break;
	
	case "utp":
		$respuesta1 = @$_REQUEST["nombre"];
		$respuesta2 = @$_REQUEST["colegio"];
		$respuesta3 = @$_REQUEST["rbd"];
		$respuesta4 = @$_REQUEST["tiempo"];
		
		setRespuesta(688,$idFormulario,$idUsuario,$idPauta,$respuesta1,$respuesta1);
		setRespuesta(689,$idFormulario,$idUsuario,$idPauta,$respuesta2,$respuesta2);
		setRespuesta(690,$idFormulario,$idUsuario,$idPauta,$respuesta3,$respuesta3);
		setRespuesta(691,$idFormulario,$idUsuario,$idPauta,$respuesta4,$respuesta4);
		dirigirse_a("item.php");
	break;
	
	*/
	case "docente":
		$respuesta1 = @$_REQUEST["nombre"];
		$respuesta2 = @$_REQUEST["colegio"];
		$respuesta3 = @$_REQUEST["curso"];
		$respuesta4 = @$_REQUEST["relator"];
		$respuesta5 = @$_REQUEST["xp"];
		
		setRespuesta(48,$idFormulario,$idUsuario,$idPauta,$respuesta1,$respuesta1);
		setRespuesta(49,$idFormulario,$idUsuario,$idPauta,$respuesta2,$respuesta2);
		setRespuesta(50,$idFormulario,$idUsuario,$idPauta,$respuesta3,$respuesta3);
		setRespuesta(51,$idFormulario,$idUsuario,$idPauta,$respuesta4,$respuesta4);
		setRespuesta(52,$idFormulario,$idUsuario,$idPauta,$respuesta5,$respuesta5);
		dirigirse_a("cuestionarioEvaluacion.php?idFormulario=$idFormulario");
	break;
	
	default:
		dirigirse_a("www.google.cl");
	break;
	

}
		 
// FIN EVALUA FIN DE LA LISTA
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Matematic</title>
<style type="text/css">
<!--
.style1 {color: 0}
.style4 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: large;
	color: #000033;
	font-weight: bold;
}
-->
</style>
<style type="text/css">
<!--
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
	color: #FFFF00;
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
.style10 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: x-small; color: #000033; }
.style5 {	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: x-small;
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style></head>

<body>
<form id="form1" name="form1" method="post" action="02.html">
<table width="923" border="10" align="center" cellpadding="0" cellspacing="0" bordercolor="#032359">
  <tr>
    <td width="901" align="center" valign="top"><div align="center">
      <table width="901" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="981" align="left" valign="top"><span class="style1"><img src="img/header.jpg" alt="" width="900" height="170" /></span></td>
        </tr>
        <tr>
          <td align="center" valign="top" bgcolor="#032359"><table width="90%" border="0" cellspacing="2" cellpadding="2">
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
          <td align="center" valign="top" bgcolor="#FFFFFF"><table border="0" cellpadding="2" cellspacing="6" bgcolor="#FFFFFF">
            <tr>
              <td width="875" align="left" valign="top">&nbsp;</td>
            </tr> 
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="bottom" bgcolor="#032359"><div align="center" class="style6 style7"><img src="img/trans.gif" width="10" height="18" />Avda. Schatchtebeck N&ordm; 4 (Z&oacute;calo Biblioteca Central) &bull; Estaci&oacute;n Central &bull; Santiago &bull; Chile &bull; Tel&eacute;fono (562) 718 20 84 &bull; www.centrofelixklein.cl</div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
</form>
</body>
</html>
