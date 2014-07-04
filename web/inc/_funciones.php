<?php



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


function cambiaf_a_normal2($fecha){
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


function getIdNombreTablaCondicionado($tabla, $atributoCondicion){

	$sql = "SELECT id".$tabla.", nombre".$tabla." FROM ".lcfirst($tabla)." WHERE ".$atributoCondicion." ORDER BY nombre".$tabla." ASC";
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


function getIdNombreTablaSinOrden($tabla){

	$sql = "SELECT id".$tabla.", nombre".$tabla." FROM ".lcfirst($tabla);
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

	$sql = "SELECT id".$tabla.", ".$nombreAtributo.$tabla." FROM ".lcfirst($tabla)." ORDER BY ".$nombreAtributo.$tabla." ASC";
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


function getIdValorTabla($tabla, $condicion){

	$sql = "SELECT id".$tabla.", valor".$tabla." FROM ".lcfirst($tabla)." WHERE idVariableDidactica = '$condicion' ORDER BY valorInstanciaVariableDidactica ASC";
	//echo $sql;
	$ident = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($ident)) {
	
			$arreglo[$i] = array(
	
			"id".$tabla => $row["id".$tabla],
			"nombre".$tabla => $row["valor".$tabla]
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

function armaSelectNombreAtributo($arreglo,$tabla,$nombreAtributo){
	echo '<option value=""></option>';
	foreach($arreglo as $elemento){
		echo '<option value="'.$elemento["id".$tabla].'">'.$elemento[$nombreAtributo.$tabla].'</option>';		
	}
	
}

function armaSelectActual($arreglo,$tabla,$idActual){
	echo '<option value=""></option>';
	foreach($arreglo as $elemento){
		if($elemento["id".$tabla] == $idActual){
			echo '<option selected value="'.$elemento["id".$tabla].'">'.$elemento["nombre".$tabla].'</option>';	
		}else
			echo '<option value="'.$elemento["id".$tabla].'">'.$elemento["nombre".$tabla].'</option>';		
	}
	
}

function armaSelectActual2($arreglo,$tabla,$idActual1,$idActual2){
	echo '<option value=""></option>';
	foreach($arreglo as $elemento){
		if($elemento["id".$tabla] == $idActual1 || $elemento["id".$tabla] == $idActual2){
			echo '<option selected value="'.$elemento["id".$tabla].'">'.$elemento["nombre".$tabla].'</option>';	
		}else
			echo '<option value="'.$elemento["id".$tabla].'">'.$elemento["nombre".$tabla].'</option>';		
	}
	
}

function armaSelectActualNombreTipo($arreglo,$tabla,$idActual){
	echo '<option value=""></option>';
	foreach($arreglo as $elemento){
		if($elemento["id".$tabla] == $idActual){
			echo '<option selected value="'.$elemento["id".$tabla].'">'.$elemento["nombre".$tabla].' ('.$elemento["tipo".$tabla].')</option>';	
		}else
			echo '<option value="'.$elemento["id".$tabla].'">'.$elemento["nombre".$tabla].' ('.$elemento["tipo".$tabla].')</option>';		
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






	
?>