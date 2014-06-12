<?php
ini_set("Display_Errors","On");
require("inc/incluidos.php");
require("hd.php");

function eliminaDatosUsuarioPrueba()
{
	$sql = "DELETE FROM pauta WHERE idUsuario = 809 AND idFormulario = 26";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	if(mysql_affected_rows()>0)
	{
		return true;
	} else {
		return false;
	}
}

if(eliminaDatosUsuarioPrueba())
{
	dirigirse_a("encuesta.php");
}
else
{
	echo "llamar al 83455269";
}


?>