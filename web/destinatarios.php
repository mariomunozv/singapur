<?php 
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
Conectarse_seg();
if (isset($_REQUEST["idUsuario"])){
	if  ($_REQUEST["idUsuario"]>0)
	{
		agregaLista($_REQUEST["idUsuario"]);
	}else{
	
		sacaLista($_REQUEST["idUsuario"]);
	}

}


?>

<table width="200" border="0">
  <?php 
 $listaDest = @$_SESSION["listaDestinatarios"];
 
 for ($i=0;$i<count($listaDest);$i++){
 ?>
      <tr>
        <td><?php echo getNombreUsuario($listaDest[$i])?></td>
        <td><img src="img/delete.gif" width="16" height="16" onclick="sacarDestinatario(<?php echo $listaDest[$i];?>)"/></td>
  </tr>
      
      
  <?php }?>
  
</table>

