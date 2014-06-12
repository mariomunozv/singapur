<?php

@include "inc/_accesoRecurso.php";
@include "inc/_bitacoraClase.php";
@include "inc/_comentario.php";

@include "inc/_cursoCapacitacion.php";
@include "inc/_detalleColegioProyecto.php";
@include "inc/_detalleUsuarioProyectoPerfil.php";

@include "inc/_empleadoKlein.php";

@include "inc/_evento.php";
@include "inc/_glosario.php";
@include "inc/_inscripcionCursoCapacitacion.php";
@include "inc/_jornada.php";
@include "inc/_mensaje.php";
@include "inc/_mensajeTema.php";
@include "inc/_notificacion.php";
@include "inc/_palabra.php";
@include "inc/_perfil.php";
@include "inc/_profesor.php";
@include "inc/_publicacion.php";
@include "inc/_recurso.php";
@include "inc/_seccionBitacora.php";
@include "inc/_tema.php";
@include "inc/_usuario.php";
@include "inc/_conlegio.php";


// Ej: ordenar($alumnosCurso,array("idPerfil"=>"ASC","nombreCompleto"=>"ASC"));
function ordenar(&$aTabla,$aCampos) {
$aSalida=array();
foreach($aCampos as $sCampo=>$sOrden) {
if($sOrden=='ASC') {
$s1='>';
$s2='<';
} else {
$s1='<';
$s2='>';
}
$aSalida[]=<<<HERE
if(array_key_exists('$sCampo',\$a)) {
if(\$a['$sCampo'] $s1 \$b['$sCampo']) {
return 1;
} elseif (\$a['$sCampo'] $s2 \$b['$sCampo']) {
return -1;
}
}
HERE;
}
$aSalida[]='return 0;';
uasort($aTabla, create_function('$a, $b', implode("\n",$aSalida)));
}


if(false === function_exists('lcfirst'))
{
    /**
     * Make a string's first character lowercase
     *
     * @param string $str
     * @return string the resulting string.
     */
    function lcfirst( $str ) {
        $str[0] = strtolower($str[0]);
        return (string)$str;
    }
}

function agregaLista($nuevoDestinatario){
	$listaDest = @$_SESSION["listaDestinatarios"];
	$esta = 0;
	for ($i=0;$i<count($listaDest);$i++){
		if ($listaDest[$i]==$nuevoDestinatario)
			$esta=1;
	}
	if ($esta==0) {
		$listaDest[]=$nuevoDestinatario;
		$_SESSION["listaDestinatarios"]= $listaDest;
	}
}


function sacaLista($nuevoDestinatario){
	$nuevoDestinatario = $nuevoDestinatario*-1;
	$listaDest = @$_SESSION["listaDestinatarios"];
	$listaDestFin = array();
	for ($i=0;$i<count($listaDest);$i++){
		if ($listaDest[$i]!=$nuevoDestinatario){
			$listaDestFin[]=$listaDest[$i];
		}
	}
	$_SESSION["listaDestinatarios"]= $listaDestFin;	
}


function fechaConFormato($fecha){
	$timestamp = strtotime($fecha);
	$fecha_con_formato = date("d/m/Y (H:i)",$timestamp);	
    return $fecha_con_formato;
} 


function cambiaf_a_normal($fecha){
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
	echo $lafecha;
    return;
} 


function alerta($mensaje){
	?><script language="javascript">
	alert("<?php echo $mensaje; ?>");
	</script><?php
}


function dirigirse_a($pagina){
	?><script language="javascript">
	location.href='<?php echo $pagina; ?>';
	</script><?php
}

function dirigirse_despues($pagina,$tiempo){
	?><script language="javascript">
	setTimeout("location.href='<?php echo $pagina; ?>'",<?php echo $tiempo; ?>);
	</script><?php
}



function mailfrom($fromaddress, $toaddress, $subject, $body, $headers) { 
	 $fp = popen('/usr/sbin/sendmail -t -f '.$fromaddress.' '.$toaddress,"w"); 
	 if(!$fp) return false; 
	 fputs($fp,"From:".$fromaddress."\r\n"); 
	 fputs($fp, "To: $toaddress\r\n"); 
	 fputs($fp, "Subject: ".$subject."\r\n"); 
	 fputs($fp, $headers."\r\n"); 
	 fputs($fp, $body); 
	 fputs($fp, "\r\n"); 
	 pclose($fp); 
	 return true; 
 }


	
function getAtributo($nombre_id,$id,$atrib,$tabla){
	$sql = "SELECT * FROM ".$tabla." WHERE ".$nombre_id." = ".$id;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return ($row[$atrib]);
}		


function getNombreAtributoDeTabla($id,$tabla){

	$sql = "SELECT nombre".$tabla." FROM ".lcfirst($tabla)." WHERE id".$tabla. " = ".$id;
	$ident = mysql_query($sql);
	$i =0;
	$row = mysql_fetch_array($ident);
	return ($row["nombre".$tabla]);
	
}

function getIdNombreTabla($tabla){

	$sql = "SELECT id".$tabla.", nombre".$tabla." FROM ".lcfirst($tabla)." ORDER BY nombre".$tabla." ASC";
	$ident = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($ident)) {
	
			$arreglo[$i] = array(
	
			"id".$tabla => $row["id".$tabla],
			"nombre".$tabla => $row["nombre".$tabla]
			);	
		$i++;
		}

	return ($arreglo);
	
}


function getIdNombreTablaCondicion($tabla,$condicion){

	$sql = "SELECT id".$tabla.", nombre".$tabla." FROM ".lcfirst($tabla)." WHERE ".$condicion." ORDER BY nombre".$tabla." ASC";
	//echo $sql;
	$ident = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($ident)) {
	
			$arreglo[$i] = array(
	
			"id".$tabla => $row["id".$tabla],
			"nombre".$tabla => $row["nombre".$tabla]
			);	
		$i++;
		}

	return ($arreglo);
	
}

function getIdAtributoTabla($tabla,$nombreAtributo){

	$sql = "SELECT id".$tabla.", ".$nombreAtributo.$tabla." FROM ".lcfirst($tabla)." ORDER BY nombre".$tabla." ASC";
	$ident = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($ident)) {
	
			$arreglo[$i] = array(
	
			"id".$tabla => $row["id".$tabla],
			"".$nombreAtributo.$tabla => $row["".$nombreAtributo.$tabla]
			);	
		$i++;
		}

	return ($arreglo);
	
}

function getIdAtributoTablaActivo($tabla,$nombreAtributo){

	$sql = "SELECT id".$tabla.", ".$nombreAtributo.$tabla." FROM ".lcfirst($tabla)." WHERE estado".$tabla." = 1 ORDER BY ".$nombreAtributo.$tabla." ASC";
	$ident = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($ident)) {
	
			$arreglo[$i] = array(
	
			"id".$tabla => $row["id".$tabla],
			"".$nombreAtributo.$tabla => $row["".$nombreAtributo.$tabla]
			);	
		$i++;
		}

	return ($arreglo);
	
}

function armaSelect($arreglo,$tabla){
	echo '<option value=""></option>';
	foreach($arreglo as $elemento){
		echo '<option value="'.$elemento["id".$tabla].'">'.$elemento["nombre".$tabla].'</option>';		
	}
	
}


function armaSelectIdAtributo($arreglo,$tabla,$nombreAtributo){
	echo '<option value=""></option>';
	foreach($arreglo as $elemento){
		echo '<option value="'.$elemento["id".$tabla].'">'.$elemento["".$nombreAtributo.$tabla].'</option>';		
	}
}

function boton($texto,$js){
	echo '<button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="'.$js.'">		
        <span class="ui-button-text">'.$texto.'</span>
    </button>';

}

function info($texto){
	echo '<div class="ui-state-highlight ui-corner-all" style="padding: 0pt 0.7em; margin-top: 20px;"> 
			<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: 0.3em;"></span>'.$texto.'</p>
		</div>';	
}

/*** Metodo booleano que envía un correo, cuando recbe una notificación en la plataforma
$usuario = Recibe el nombre del usuario al que se le notificará
$destinatario = Recibe el correo donde será enviado el mail
$mensaje = Recibe el mensaje que se le quiere comunicar al usuario
return true si el mensaje fue enviado
***/
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


function getRegion($idComuna)
{
	$sql = "SELECT nombreRegion FROM region
	WHERE idRegion in (
	SELECT idRegion FROM provincia
	WHERE idProvincia in (
	SELECT idProvincia FROM comuna
	WHERE idComuna = ".$idComuna."))";
	//echo $sql;
	$res = mysql_query($sql);
	$region = mysql_fetch_row($res);
	return $region[0];
}

function downloadFile( $fullPath ){
/* 
Ejecutar el siguiente codigo de "Directory Traversal Prevention" antes de llamar esta funcion
en la pagina.

$directory = $path_parts["dirname"];

$root = explode ( DIRECTORY_SEPARATOR, realpath ( dirname ( __FILE__ ) ) );

if (! is_dir ( $directory )) {
	die ( "Ubicación invalida." );
}

$request = explode ( DIRECTORY_SEPARATOR, realpath ( $directory ) );

empty ( $request [0] ) ? array_shift ( $request ) : $request;
empty ( $root [0] ) ? array_shift ( $root ) : $root;

if (count ( array_diff_assoc ( $root, $request ) ) > 0) {
	die ( "Ubicación invalida." );
} 

*/


  // Must be fresh start
  if( headers_sent() )
    die('Headers Sent');

  // Required for some browsers
  if(ini_get('zlib.output_compression'))
    ini_set('zlib.output_compression', 'Off');

  // File Exists?
  if( file_exists($fullPath) ){
   
    // Parse Info / Get Extension
    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);

    $ext = strtolower($path_parts["extension"]);
   
    // Determine Content Type
    switch ($ext) {
      case "pdf": $ctype="application/pdf"; break;
      case "zip": $ctype="application/zip"; break;
	  case "rar": $ctype="application/x-rar-compressed";break;
      case "doc": $ctype="application/msword"; break;
	  case "docx": $ctype="application/msword"; break;
      case "xls": $ctype="application/vnd.ms-excel"; break;
	  case "xlsx": $ctype="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"; break;
	  //case "xlsx": $ctype="application/vnd.oasis.opendocument.spreadsheet"; break;
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
	  case "pptx": $ctype="application/vnd.ms-powerpoint"; break;
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
	  case "jpeg": $ctype="image/jpg"; break;
      case "jpg": $ctype="image/jpg"; break;
	  case "mp3": $ctype="audio/mpeg3"; break;
	  case "wmv": $ctype="video/x-ms-wmv";break;
	  case "exe": $ctype="application/exe"; break;
      default:  die ( "Archivo invalido." ); //$ctype="application/force-download";
    }

    header("Pragma: public"); // required
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); // required for certain browsers
    header("Content-Type: $ctype");
    header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$fsize);
    ob_clean();
    flush();
    readfile( $fullPath );

  } else
    die('No existe el archivo');

}


?>