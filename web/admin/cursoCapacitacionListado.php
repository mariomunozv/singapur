<?php require("inc/config.php"); 

include("../inc/_usuario.php");
include("../inc/_profesor.php");
include("../inc/_directivo.php");
include("../inc/_empleadoKlein.php");
include("../inc/_inscripcionCursoCapacitacion.php");
include("../inc/funciones.php");

//include("inc/funciones.php");
//include("inc/funcionesAdmin.php");
$idCurso = $_REQUEST["idCurso"];


?>
<script type="text/javascript" src="js/main.js"></script> 
<script type="text/javascript" src="js/funciones.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>  
<script language="javascript">

function saca(){
	
	document.getElementById("curso").value = document.getElementById("idCurso").value;
	
	if(confirm("Seguro de Desinscribir alumnos en este curso?")){

		var division = document.getElementById("guarda2");
		var a = $(".campos").fieldSerialize();
		//alert(a);
		AJAXPOST("cursoCapacitacionDesinscribe.php",a,division);
	}
} 


$(function() {
	<?php /* Asi inicializas tablesorter */ ?>	   
	$("#tabla2").tablesorter({ 
		headers: {  
			0: { sorter: false }
			 // Esto es para inabilitar el filtro en una columna
		},
		widthFixed: true,
		widgets: ['zebra']}).tablesorterPager({
			container: $("#pager2"),
			positionFixed: false,
			size:50//Numero de registros tb
			});  
}); 

</script>
<?php  boton("Desinscribir alumnos","saca();");?>
<table class="tablesorter" id="tabla2">

   <thead>         
  <tr>
  <th>N</th>
    <th>Seleccionar </th>
<th>ID</th>
	<th>Apellido Paterno </th>
	<th>nombreCompleto </th>
   

   
  </tr>
  </thead>
  <tbody>
  
  <input name="curso" id="curso"  type="hidden" class="campos"/> 
  <?php 
  
 $i = 1;
$alumnos=   getAlumnosCurso($idCurso);
	 
	
 
		
	  
	
  
    
  if (count($alumnos) > 0){
		foreach ($alumnos as $alumno){  
		 

 ?>
              <tr>
              <td><?php echo $i++;?></td>
			    <td><input type="checkbox"  name="sel2[]" id="sel2<?php echo $alumno['idUsuario'];?>"  class="campos" value="<?php echo $alumno['idUsuario'];?>"></td>
                <td><?php echo $alumno["idUsuario"];?></td>
				<td><?php echo $alumno["apellidoPaterno"];?></td>
				<td><?php echo $alumno["nombreCompleto"];?></td>
				
               
              </tr>
<?php 		}
 }else{ 
	 echo "<tr><td colspan='12'>No existen alumnos</td></tr>"; 
  
  }
 
  
  ?>
  
  
 </tbody> 
</table><br />


 <div id="pager2" class="pager">
                    <form name="a">
                        <img src="css/tabla/first.png" class="first"/>
                        <img src="css/tabla/prev.png" class="prev"/>
                        <input type="text" class="pagedisplay"/>
                        <img src="css/tabla/next.png" class="next"/>
            
                        <img src="css/tabla/last.png" class="last"/>
                        <input type="hidden" class="pagesize" value="50"><?php /* Registros por paginas */ ?> 
                    </form>
                </div>
<div id="guarda2"></div>