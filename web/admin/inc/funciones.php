<?php
function dirigirse_a($pagina){
	?><script language="javascript">
	location.href='<?php echo $pagina; ?>';
	</script><?php
}
function registraAcceso($idUsuario, $idTipoAcceso, $elementos, $valores){
	$sql = "INSERT INTO acceso VALUES ('$idUsuario', '', '$idTipoAcceso', NOW() )";
	$res = mysql_query($sql);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}
	
	$last_id = mysql_insert_id();
	
	if ($elementos != 'NULL'){
		for($i = 0; $i < count($elementos); $i++){
			$elemento = $elementos[$i];
			$valor = $valores[$i];
			$sql2 = "INSERT INTO detalleElementoAcceso VALUES ('$idUsuario', '$last_id', '$elemento', '$valor' )";
			$res2 = mysql_query($sql2);
			if (!$res2) {
				die('Error en la consulta SQL: <br><b>'.$sql2.'</b><br>'. mysql_error());
			}
			
		
		}
	}
	
	
}

function alerta($mensaje){
	?><script language="javascript">
	alert("<?php echo $mensaje; ?>");
	</script><?php
}

function acualizaUltimoAcceso($idUsuario){
	$sql = "UPDATE `usuario` SET `ultimoAccesoUsuario` = NOW( ) WHERE `idUsuario` = ".$idUsuario;
	$res = mysql_query($sql);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}
}

?>