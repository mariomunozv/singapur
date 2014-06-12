<?php 
require("inc/config.php");
require("_head.php");
$menu = "ite";
require("_menu.php"); 
$navegacion = "Items*item.php";
require("_navegacion.php");

include "../inc/_item.php";


?>
<script>
class_activo('boton_item','activo');
</script>

<script language="javascript">
function new_(){
	var division = document.getElementById("lugar_de_carga");
	AJAXPOST("itemNuevo.php","",division);
} 
</script>

<script language="javascript">
function edit_(idItem){
	var division = document.getElementById("lugar_de_carga");
	AJAXPOST("itemEdita.php?idItem="+idItem,"",division);
	
} 

function busca_(){
	var division = document.getElementById("lugar_de_carga");
	var busqueda = document.getElementById("busquedaItem");
	AJAXPOST("itemBusca.php?query="+busqueda.value,"",division);
	
} 


function handleKeyPress(e){
	var key=e.keyCode || e.which;
	if (key==13){
		busca_();
	}
}


</script>
<p>
<a name="top" id="top"></a>
<span class="titulo_form">Adminitracion Items</span>


<form name="form" action="" method="POST" enctype="multipart/form-data">
<div id="lugar_de_carga"></div>  
	</form>
    <a class="button" href="javascript:new_();">
    	<span>
        	<div class="add"><?php echo "Nuevo item"; ?></div>
        </span>
	</a>
    
<table>
	<tr>
    	<td><input id="busquedaItem" name="busquedaItem" type="text" onkeypress="handleKeyPress(event)" /></td>
        <td>
        <a class="button" href="javascript:busca_();">
            <span>
                <div class="add"><?php echo "Buscar item"; ?></div>
            </span>
        </a>
    	</td>
    </tr>
</table>



            
<p> 

<?php
  $arregloItems = getItemsTodos();
  if (count($arregloItems) > 1)
  	echo count($arregloItems)." Items en la BD: ";

?>

<table class="tablesorter" id="tabla">
   <thead>         
  <tr>
    <th>ID</th>
    <th width="800">Enunciado </th>
	<th>Opciones</th>
   
  </tr>
  </thead>
  <tbody>
  <?php 
 
  if (count($arregloItems) > 1){
		foreach ($arregloItems as $item){  
	  ?>
              <tr>
                <td><?php echo $item["idItem"];?></td>
                <td><?php echo $item["enunciadoItem"];?></td>
                <td><a href="#top" onclick="javascript:edit_(<?php echo $item["idItem"]; ?>);">Editar</a> - <a href="../series/verItem.php?idItem=<?php echo $item["idItem"];?>" target="_blank">Ver</a></td>
               
              </tr>
<?php 		}
 }else{ 
	 echo "<tr><td colspan='5'>No hay items</td></tr>"; 
  
  }
  
  ?>
 </tbody> 
</table>
</p>
<?php require("_pie.php"); ?>
