<?php
require("inc/incluidos.php");
require("inc/_visitaEscuela.php");
//validacion de datos
if( $_POST["idAsesor"]!=""){
	if($_POST["rbdColegio"]!=""){
		if($_POST["fechaVisita"]!=""){
			if($_POST["numeroVisita"]!="" || $_POST["numeroVisitaOtro"]!=""){
				$numeroVisita = $_POST["numeroVisita"]!="" ? $_POST["numeroVisita"] : $_POST["numeroVisitaOtro"];
				if($_POST["horaLlegada"]!="" && $_POST["horaSalida"]!=""){
					$fecha = $_POST["fechaVisita"];
					if( !existePK(substr($fecha, 6),$numeroVisita,$_POST["rbdColegio"]) ){
						crearVisitaEscuela($_POST);					
					}else{
						echo 6;
					}
				}else{
					echo 5;
				}
			}else{
				echo 4;
			}
		}else{
			echo 3;
		}
	}else{
		echo 2;
	}
}else{
	echo 1;
}
?>

