<?php 

$nombre= "subir/fotos_perfil/".$_GET['img']; 
$datos = getimagesize($nombre);

if($datos[2]==1){$img = @imagecreatefromgif($nombre);}
if($datos[2]==2){$img = @imagecreatefromjpeg($nombre);}
if($datos[2]==3){$img = @imagecreatefrompng($nombre);}

$anchura=$datos[0];
$altura = $datos[1];

if($_GET["i"] > 0){
	if($anchura <= $altura){
		$_GET["x"] = $_GET["i"];
	}else{
		$_GET["y"] = $_GET["i"];
	}
}
if($_GET["x"] > 0){
	$ancho = $_GET['x'];
	$alto = intval(($altura * $ancho) / $anchura);
}
if($_GET["y"] > 0){
	$alto = $_GET['y'];
	$ancho = intval(($anchura * $alto) / $altura);	
} 

$thumb = imagecreatetruecolor($ancho,$alto);
imagesavealpha($thumb, true);
$trans_colour = imagecolorallocatealpha($thumb, 0, 0, 0, 127);
imagefill($thumb, 0, 0, $trans_colour);
	
imagecopyresampled($thumb, $img, 0, 0, 0, 0, $ancho, $alto, $anchura, $altura); 
if($datos[2]==1){header("Content-type: image/gif"); imagegif($thumb);} 
if($datos[2]==2){header("Content-type: image/jpeg");imagejpeg($thumb);} 
if($datos[2]==3){header("Content-type: image/png");imagepng($thumb); } 
imagedestroy($thumb);  
?> 