<?php 

function getNombreEmpleadoKleinPorRut($rutEmpleadoKlein){
	$sql = "SELECT * FROM `empleadoKlein` where rutEmpleadoKlein = '".$rutEmpleadoKlein."'";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["nombreEmpleadoKlein"]." ".$row["apellidoPaternoEmpleadoKlein"]." ".$row["apellidoMaternoEmpleadoKlein"];

}

function getNombreEmpleadoKlein($rutEmpleadoKlein){
	//echo $rutEmpleadoKlein;
	$sql = "SELECT * FROM empleadoKlein WHERE rutEmpleadoKlein = '$rutEmpleadoKlein'";
	//echo $sql;
	$res = mysql_query($sql);
    $row = mysql_fetch_array($res);
	$nombreEmpleadoKlein = $row["nombreEmpleadoKlein"]." ".$row["apellidoPaternoEmpleadoKlein"]." ".$row["apellidoMaternoEmpleadoKlein"];
	return ($nombreEmpleadoKlein);
} 


function getApellidosNombrePorRutEmpleadoKlein($rutEmpleadoKlein){
	$sql = "SELECT * FROM `empleadoKlein` where rutEmpleadoKlein = '".$rutEmpleadoKlein."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["apellidoPaternoEmpleadoKlein"]." ".$row["apellidoMaternoEmpleadoKlein"]." ".$row["nombreEmpleadoKlein"];

}


/*function getDatosEmpleadoKlein($idUsuario){
		$sql = "SELECT * FROM empleadoKlein empleadoKlein join usuario usuario on usuario.rutEmpleadoKlein = empleadoKlein.rutEmpleadoKlein WHERE usuario.idUsuario ='$idUsuario'";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		
		$datosDirectivo = array(
			"rut" => $row["rutEmpleadoKlein"],
			"loginUsuario" => $row["loginUsuario"],
			"nombre" => $row["nombreEmpleadoKlein"],
			"apellidoPaterno" => $row["apellidoPaternoEmpleadoKlein"],
			"apellidoMaterno" => $row["apellidoMaternoEmpleadoKlein"],
			"sexo" => $row["sexoEmpleadoKlein"],
			"fechaNacimiento" => $row["fechaNacimientoEmpleadoKlein"],
			"telefono" => $row["telefonoCelularEmpleadoKlein"]." ".$row["telefonoCasaEmpleadoKlein"],
			"email" => $row["emailEmpleadoKlein"],			
			"imagenUsuario" => $row["imagenUsuario"],
			"acercaDeUsuario" => $row["acercaDeUsuario"],
			"interesesUsuario" => $row["interesesUsuario"],
			"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"]
		);
		return ($datosDirectivo);
}*/


function getDatosEmpleadoKlein($idUsuario){
		$sql = "SELECT * FROM empleadoKlein empleadoKlein join usuario usuario on usuario.rutEmpleadoKlein = empleadoKlein.rutEmpleadoKlein WHERE usuario.idUsuario ='$idUsuario'";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		
		if ( $row["imagenUsuario"] == "http://www.grupoklein.cl/singapur/images/men.png" || $row["imagenUsuario"] == "/img/nophoto"){
				$row["imagenUsuario"] = "nophoto.jpg";
		}
		
		$datosDirectivo = array(
			"rutEmpleadoKlein" => $row["rutEmpleadoKlein"],
			"loginUsuario" => $row["loginUsuario"],

			"passwordUsuario" => $row["passwordUsuario"],
			"nombreEmpleadoKlein" => $row["nombreEmpleadoKlein"],
			"apellidoPaternoEmpleadoKlein" => $row["apellidoPaternoEmpleadoKlein"],
			"apellidoMaternoEmpleadoKlein" => $row["apellidoMaternoEmpleadoKlein"],
			"emailEmpleadoKlein" => $row["emailEmpleadoKlein"],
			"telefonoEmpleadoKlein" => $row["telefonoCasaEmpleadoKlein"],
			"nombreParaMostrar" => $row["nombreEmpleadoKlein"]." ".$row["apellidoPaternoEmpleadoKlein"],
			"rolEmpleadoKlein" => $row["rolEmpleadoKlein"],
			"idComuna" => $row["idComuna"],
			
			"imagenUsuario" => $row["imagenUsuario"],
			"acercaDeUsuario" => $row["acercaDeUsuario"],
			"interesesUsuario" => $row["interesesUsuario"],
			"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"]
			
		);
		return ($datosDirectivo);
}	





function actualizaDatosEmpleadoKlein($rut,$nombre,$apellidoPaterno,$apellidoMaterno,$sexo,$fechaNacimiento,$telefono,$email)
{
	$sql_udateEmpleadoKlein="UPDATE empleadoKlein SET nombreEmpleadoKlein = '$nombre', 
		apellidoPaternoEmpleadoKlein = '$apellidoPaterno', 
		apellidoMaternoEmpleadoKlein = '$apellidoMaterno', 
		sexoEmpleadoKlein = '$sexo', 
		fechaNacimientoEmpleadoKlein = '$fechaNacimiento',
		telefonoCasaEmpleadoKlein = '$telefono', 
		emailEmpleadoKlein = '$email'
		WHERE rutEmpleadoKlein  =  '$rut';";
	$result = mysql_query($sql_udateEmpleadoKlein);
	return $result;
}

function getRutEmpleados(){
		$sql = " SELECT rutEmpleadoKlein, nombreEmpleadoKlein, apellidoPaternoEmpleadoKlein from empleadoKlein where not exists (select * from usuario where usuario.rutEmpleadoKlein = empleadoKlein.rutEmpleadoKlein)";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		$i = 0;
		while ($row = mysql_fetch_array($res)){
		$empleadosKlein[$i] = array( "nombreParaMostrar"=> "[".$row["rutEmpleadoKlein"]."]  ".$row["nombreEmpleadoKlein"]." ".$row["apellidoPaternoEmpleadoKlein"],
  					  "rut"=>$row["rutEmpleadoKlein"],
					);	
		$i++;
		}
		if ($i==0){
			return(NULL);
		}
		return($empleadosKlein);
}	



?>