<?php
require ("hd.php");
require("inc/incluidos.php");

ini_set('display_errors','On');
ini_set('sendmail_path', '/usr/sbin/sendmail');  


/*** Metodo booleano que env�a un correo, cuando recbe una notificaci�n en la plataforma
$usuario = Recibe el nombre del usuario al que se le notificar�
$destinatario = Recibe el correo donde ser� enviado el mail
$mensaje = Recibe el mensaje que se le quiere comunicar al usuario
return true si el mensaje fue enviado
***/
/*
function notificacionCorreo($usuario,$destinatario,$mensaje)
{
	$asunto = "Notificaci�n de M�todo Singapur";
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
	<td><h3>$mensaje. <a href='http://www.grupoklein.cl/sitio'>Dir�gete al sitio</a> para saber m�s</h3></td>
	</tr>

	<tr> 
	<td align='center'><p>Este mensaje fue generado de forma autom�tica, por lo que agradecemos que no lo responda</td>
	</tr>
	
	<tr> 
		<td align='center' style='background-color:#004600; color:#FFFFFF'>Avda. Schatchtebeck N� 4 (Z�calo Biblioteca Central) � Estaci�n Central � Santiago � Chile � Tel�fono (562) 718 20 84 � www.centrofelixklein.cl </td>
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


if(notificacionCorreo("notificacion@grupoklein.cl","the.white.tiger@gmail.com","Se ha realizado una publicaci�n en el foro"))
{
	echo "El correo fue enviado";
}
else
{
	echo "El mensaje no se pudo enviar";
}


/*echo "hola";


if(notificacionCorreo("JP","jp.ruzc@gmail.com","Se ha realizado una publicaci�n en el foro"))
{
	echo "El correo fue enviado";
}
else
{
	echo "El mensaje no se pudo enviar";
}*/

?>
