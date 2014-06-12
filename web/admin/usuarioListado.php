<?php 
  //ini_set('display_errors','On');
  
require("inc/config.php"); 

include_once("../inc/_usuario.php");
include_once("../inc/_profesor.php");
//include_once("../inc/_directivo.php");
include_once("../inc/_empleadoKlein.php");
include_once("../inc/_funciones.php");


//include("inc/funciones.php");
//include("inc/funcionesAdmin.php");



?>
<script language="javascript">

function inscribe_cursoCapacitacion(){
	
	document.getElementById("curso").value = document.getElementById("idCurso").value;
	
	if(confirm("Seguro de inscribir al usuario en este curso?")){

		var division = document.getElementById("guarda");
		var a = $(".campos").fieldSerialize();
		//alert(a);
		AJAXPOST("cursoCapacitacionInscribe.php",a,division);
	}
} 


$(function() {
	<?php /* Asi inicializas tablesorter */ ?>	   
	$("#tabla").tablesorter({ 
		headers: {  
			0: { sorter: false }
			 // Esto es para inabilitar el filtro en una columna
		},
		widthFixed: true,
		widgets: ['zebra']}).tablesorterPager({
			container: $("#pager"),
			positionFixed: false,
			size:200//Numero de registros tb
			});  
}); 



</script>
<?php boton("Inscribir","inscribe_cursoCapacitacion();");?>

<table class="tablesorter" id="tabla">

   <thead>         
  <tr>
    <th>Seleccionar </th>
    <th>ID</th>
    <th>Nombre </th>
	<th>Apellido Paterno </th>
	<th>RBD </th>
    <th>Tipo Usuario</th>

   
  </tr>
  </thead>
  <tbody>
  
  <?php 
  
	  $idUsuarios = getIdUsuarios();
	  
	  
  
    
  if (count($idUsuarios) > 0){
		foreach ($idUsuarios as $idUsuario){  
		  $usuariosObtenidos = getDatosUsuarioPorId($idUsuario['idUsuario']);

 ?>
              <tr>
			    <td><input type="checkbox" name="sel[]" id="sel<?php echo $idUsuario['idUsuario'];?>"  class="campos" value="<?php echo $idUsuario['idUsuario'];?>"></td>
                <td onclick="check=document.getElementById('sel<?php echo $idUsuario['idUsuario'];?>');
											check.checked=(check.checked==false)?true:false;"><?php echo $idUsuario['idUsuario'];?></td>
                <td onclick="check=document.getElementById('sel<?php echo $idUsuario['idUsuario'];?>');
											check.checked=(check.checked==false)?true:false;"><?php echo $usuariosObtenidos["nombre"];?></td>
				<td onclick="check=document.getElementById('sel<?php echo $idUsuario['idUsuario'];?>');
											check.checked=(check.checked==false)?true:false;"><?php echo $usuariosObtenidos["apellidoPaterno"];?></td>
				<td onclick="check=document.getElementById('sel<?php echo $idUsuario['idUsuario'];?>');
											check.checked=(check.checked==false)?true:false;"><?php echo $usuariosObtenidos["rbdColegio"];?></td>
				<td onclick="check=document.getElementById('sel<?php echo $idUsuario['idUsuario'];?>');
											check.checked=(check.checked==false)?true:false;"><?php echo $usuariosObtenidos["tipoUsuario"];?></td>
               
              </tr>
              
<?php 		}
 }else{ 
	 echo "<tr><td colspan='12'>No existen profesores</td></tr>"; 
  
  }
  
  ?>
 </tbody> 
</table> 
<input name="curso" id="curso"  type="hidden" class="campos"/> 

</form>
  <div id="pager" class="pager">
                    <form name="a">
                        <img src="css/tabla/first.png" class="first"/>
                        <img src="css/tabla/prev.png" class="prev"/>
                        <input type="text" class="pagedisplay"/>
                        <img src="css/tabla/next.png" class="next"/>
            
                        <img src="css/tabla/last.png" class="last"/>
                        <input type="hidden" class="pagesize" value="200"><?php /* Registros por paginas */ ?> 
                    </form>
                </div>
