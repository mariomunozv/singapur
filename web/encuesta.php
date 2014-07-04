<?php 
session_start();
require("inc/incluidos.php"); 
require ("hd.php");
//$idUsuario =  $_SESSION["sesionIdUsuario"];
//$nombreColegio =  $_SESSION["colegio"];


function getEncuestas()
{
	$sql = "SELECT * FROM formulario WHERE estadoFormulario = 1 AND idActividadPagina is NULL";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$formularios[$i] = array(
			"idFormulario"=> $row["idFormulario"],
			"nombreFormulario"=> $row["nombreFormulario"]
			);
		$i++;
	}
	return($formularios);
}


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
	color: #000;
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
</style></head>

<?php 
	$formularios = getEncuestas();
?>



<body>
<form id="form1" name="form1" method="post" action="guarda.php">
<table width="923" border="10" align="center" cellpadding="0" cellspacing="0" bordercolor="#004600">
  <tr>
    <td width="901" align="center" valign="top"><div align="center">
      <table width="901" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="981" align="left" valign="top"><span class="style1"><img src="img/header.jpg" width="950" height="170"> </span></td>
        </tr>
        <tr>
          <td align="center" valign="top" bgcolor="#004600">
		  <table width="90%" border="0" cellspacing="2" cellpadding="2">
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
              <td colspan="2" align="left" valign="top"><p class="style4">Encuestas de apreciación - <?php echo $_SESSION["sesionNombreUsuario"];?><br />
</p>
                  <hr  color="#004600"/>
                  </td>
            </tr>
            <tr>
              <td width="463" align="left" valign="top"><p class="style10">Selecciona la encuesta que deseas contestar</p>
                <p class="style10">&nbsp;</p>
                <p class="style10">&nbsp;</p>
                <p class="style10"></p></td>
              <td width="412" align="left" valign="top" bgcolor="#B9CAAC">
              
              <table width="78%" border="0" cellpadding="4" cellspacing="4">
                <tr>
                  <td class="style10">
				  <?php 
					  foreach($formularios as $encuesta)
					  {
						  if($encuesta['idFormulario'] != 120 && $encuesta['idFormulario'] != 121 && $encuesta['idFormulario'] != 131 && $encuesta['idFormulario'] != 132)
						  {
				   ?>						
				  	  <a href="datosInicialesEncuesta.php?formulario=<?php echo $encuesta["idFormulario"]?>" class="style4"> <?php echo $encuesta["nombreFormulario"]."<br>"; ?> </a>
					<?php 
						  }
					  }
				    ?>
						</td>
                </tr>
                <!--<tr>
                  <td><a href="02.php" class="style4">Encuesta de Gestión Estudiantes de 5º a 8º Básico</a></td>
                </tr>
                <tr>
                  <td><a href="03.php" class="style4">Encuesta a Profesores</a></td>
                </tr>-->
                <tr>
                  <td class="style10"><a href="encuestaEliminarDatos.php" class="style4">Borrar datos usuario prueba</a></td>
                </tr>
                <tr>
                  <td class="style10">&nbsp;</td>
                </tr>
                <tr>
                  <td class="style10">&nbsp;</td>
                </tr>
                <tr>
                  <td class="style10">&nbsp;</td>
                </tr>
              </table>
              </td>
            </tr> 
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="bottom" bgcolor="#004600"><div align="center" class="style6 style7"><img src="img/trans.gif" width="10" height="18" />Avda. Schatchtebeck N&ordm; 4 (Z&oacute;calo Biblioteca Central) &bull; Estaci&oacute;n Central &bull; Santiago &bull; Chile &bull; Tel&eacute;fono (562) 718 20 84 &bull; www.centrofelixklein.cl</div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
</form>
</body>
</html>
