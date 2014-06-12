<?php 
function _t($texto){
	return htmlentities($texto);
} 
function _t2($texto){
	return utf8_encode($texto);
}
function sesion(){
	if($_SESSION["persona"]["per_id"] == ""){
		?><script language="javascript">location.href="logout.php";</script><?php
	}
} 
function fec($fecha){
	return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
}
function nombre_mes($mes){
	switch($mes){
		case 1: $mes = "Enero"; break;
		case 2: $mes = "Febrero"; break;
		case 3: $mes = "Marzo"; break;
		case 4: $mes = "Abril"; break;
		case 5: $mes = "Mayo"; break;
		case 6: $mes = "Junio"; break;
		case 7: $mes = "Julio"; break;
		case 8: $mes = "Agosto"; break;
		case 9: $mes = "Septiembre"; break;
		case 10: $mes = "Octubre"; break;
		case 11: $mes = "Noviembre"; break;
		case 12: $mes = "Diciembre"; break;
	}
	return $mes;
}
function total_obtenido($eva,$com,$nivel){
	$total = 0;
	$cantidad = 0;
	$cond = conducta("*","where con_com_id = '$com' and con_nivel = '$nivel'");
	if(mysql_num_rows($cond) > 0){
		while($row = mysql_fetch_array($cond)){
			$resu = evaluacion_resultado("res_obtenido","where res_eva_id = '$eva' and res_con_id = ".$row["con_id"]);
			if(mysql_num_rows($resu) > 0){
				while($row2 = mysql_fetch_array($resu)){
					$total += $row2["res_obtenido"] * 1;
					$cantidad++;
				}
			}
		}		
	}	
	$final = intval($total / $cantidad);
	return $final;
}
?>