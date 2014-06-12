<?php

require("inc/incluidos.php");

/*if(empty($_FILES["file"]["tmp_name"]) || $_FILES["file"]["tmp_name"] == "none"){
   $msg="file size Limit to ".ini_get("post_max_size").". Cannot process your request";
}
else{
   $msg= " File Name: " . $_FILES["file"]["name"] . ", ";
   $msg.= " File Size: " . @filesize($_FILES["file"]["tmp_name"]);
   unlink($_FILES["file"]["tmp_name"]);
}*/

//echo $msg;

//$arr["message"]=$msg;

//echo json_encode($arr);

$file = $_REQUEST["nombreInputFile"];

if ($_FILES[$file]["error"] > 0)
{
	?>
	<script>
    alert("Se ha producido un error al adjuntar el archivo.");
    </script>
    <?php

}
else
{
	//echo "Nombre del archivo: " . $_FILES[$file]["name"] . "<br />";
	$file_name = $_FILES[$file]["name"];
	//echo "---->".get_file_extension($file_name);
	//echo "Tipo: " . $_FILES[$file]["type"] . "<br />";
	//echo "Tamaño: " . ($_FILES[$file]["size"] / 1024) . " Kb<br />";
	//echo "Stored in: " . $_FILES[$file]["tmp_name"];
	
	if ( get_file_extension($file_name) == "ppt" || get_file_extension($file_name) == "pptx")
	{
		if (file_exists("subir/archivos_act/" . $_SESSION["sesionIdUsuario"]."_".$_FILES[$file]["name"]))
      	{
			?>
			<script>
			alert("Ya has subido este archivo anteriormente.");
			
			</script>
			<?php
      	}else{
		
			move_uploaded_file($_FILES[$file]["tmp_name"],"subir/archivos_act/" . $_SESSION["sesionIdUsuario"]."_".$_FILES[$file]["name"]);
			?>
			<script>
			alert("Archivo Guardado satisfactoriamente.\nContinue completando la actividad.");
			
			</script>
			<?php
		}
	}
	else
	{
		
		?>
		<script>
		alert("El formato del archivo no es Power Point.");
		</script>
		<?php
		
		
		
	}

}

function get_file_extension($file_name)
{
	return substr(strrchr($file_name,'.'),1);
}


?>

