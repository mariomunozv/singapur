<?php
require ("hd.php");
require("inc/incluidos.php");

ini_set('display_errors','On');
ini_set('sendmail_path', '/usr/sbin/sendmail');  


/*** Metodo booleano que envía un correo, cuando recbe una notificación en la plataforma
$usuario = Recibe el nombre del usuario al que se le notificará
$destinatario = Recibe el correo donde será enviado el mail
$mensaje = Recibe el mensaje que se le quiere comunicar al usuario
return true si el mensaje fue enviado
***/
/*
function notificacionCorreo($usuario,$destinatario,$mensaje)
{
	$asunto = "Notificación de Método Singapur";
	$remitente = "notificacion@grupoklein.cl";
	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$cuerpo = " 
	<html>
	<body>
	<table align='center'>
	<tr> 
	<td style='background-color:#004600; color:#FFFFFF'><img src='http://www.grupoklein.cl/sitio/img/header.jpg' /></td>
	</tr>
	
	<tr> 
	<td><h2>$usuario : </h2></td>
	</tr>
	
	<tr> 
	<td><h3>$mensaje. <a href='http://www.grupoklein.cl/sitio'>Dirígete al sitio</a> para saber más</h3></td>
	</tr>

	<tr> 
	<td align='center'><p>Este mensaje fue generado de forma automática, por lo que agradecemos que no lo responda</td>
	</tr>
	
	<tr> 
		<td align='center' style='background-color:#004600; color:#FFFFFF'>Avda. Schatchtebeck Nº 4 (Zócalo Biblioteca Central) • Estación Central • Santiago • Chile • Teléfono (562) 718 20 84 • www.centrofelixklein.cl </td>
	</tr>
		
	</table>
	</body>
	</html>
	";
	
	if (mailfrom($remitente,$destinatario,$asunto,$cuerpo, $headers))
	{
		return true;
	}
	else
	{
		return false;
	}
}


if(notificacionCorreo("notificacion@grupoklein.cl","the.white.tiger@gmail.com","Se ha realizado una publicación en el foro"))
{
	echo "El correo fue enviado";
}
else
{
	echo "El mensaje no se pudo enviar";
}


/*echo "hola";


if(notificacionCorreo("JP","jp.ruzc@gmail.com","Se ha realizado una publicación en el foro"))
{
	echo "El correo fue enviado";
}
else
{
	echo "El mensaje no se pudo enviar";
}*/

?>
