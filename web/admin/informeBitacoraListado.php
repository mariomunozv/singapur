<?php require("inc/config.php"); 


require("../inc/_colegio.php");
//require("../inc/_detalleColegioProyecto.php");
require("../inc/_profesor.php");
//require("../inc/_directivo.php");
require("../inc/_empleadoKlein.php");
require("../inc/_cursoCapacitacion.php");
require("../inc/_usuario.php");
require("../inc/_perfil.php");
//require("inc/sesionAdmin.php");

//include("inc/funciones.php");
//include("inc/funcionesAdmin.php");



function getBitacorasCurso($idCurso){
//	$sql = "SELECT * FROM bitacora a join inscripcionCursoCapacitaciion b on a.idUsuario = b.idUsuario WHERE b.idCursoCapacitacion = ".$idCurso;
    $sql=" SELECT a.nombreBitacora,a.fechaBitacora,a.tiempoBitacora, a.comentariosBitacora,a.fechaCreacionBitacora,a.tipoBitacora,c.rutProfesor, ";
	$sql.=" c.apellidoPaternoProfesor,c.nombreProfesor,c.apellidoMaternoProfesor,d.nombreColegio ";
  	$sql.=" FROM `bitacora` a join usuario b on a.idUsuario = b.idUsuario join profesor c on b.rutProfesor = c.rutProfesor join colegio d on c.rbdColegio = d.rbdColegio ";
    $sql.=" join inscripcionCursoCapacitacion e on b.idUsuario = e.idUsuario ";
	$sql.=" WHERE e.idCursoCapacitacion = ".$idCurso;
	$res = mysql_query($sql);
//	echo $sql;
	$i=0;
	while($row = mysql_fetch_array($res)){
	
	$bitacoras[$i] = array( "nombreBitacora" => $row["nombreBitacora"],
					  "fechaBitacora" => $row["fechaBitacora"],
					  "tiempoBitacora" => $row["tiempoBitacora"],
					  "fechaCreacionBitacora" => $row["fechaCreacionBitacora"],
					  "tipoBitacora" => $row["tipoBitacora"],
					  "apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"],
					  "nombreProfesor" => $row["nombreProfesor"],
					 "apellidoMaternoProfesor" => $row["apellidoMaternoProfesor"],
					"nombreColegio" => $row["nombreColegio"],
					"comentariosBitacora" => $row["comentariosBitacora"]
					);	
	$i++;
	}
	return($bitacoras);
} 

$idCurso = $_REQUEST["idCurso"];
$bitacoras = getBitacorasCurso($idCurso);

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
	$("#tabla2").tablesorter();  
}); 

</script>

<table class="tablesorter" id="tabla2">

   <thead>         
  <tr>
  <th width="80">Escuela</th>
  <th width="100">Apellidos </th>
    <th width="55">Nombre </th>
    <th width="60">Fecha</th>
	<th width="100">Seccion</th>
	<th>Horas</th>
   <th>comentariosBitacora </th>

   
  </tr>
  </thead>
  <tbody>
  

  <?php 
  


	 
	
 
		
	  
	
  
    
  if (count($bitacoras) > 0){
		foreach ($bitacoras as $bitacora){  
		 

 ?>
              <tr>
              <td><?php echo $bitacora["nombreColegio"];?></td>
			    <td><?php echo $bitacora["apellidoPaternoProfesor"]." ".$bitacora["apellidoMaternoProfesor"];?></td>
                <td><?php echo $bitacora["nombreProfesor"];?></td>
                <td><?php echo $bitacora["fechaBitacora"];?></td>
				<td><?php echo $bitacora["nombreBitacora"];?></td>
				<td><?php echo $bitacora["tiempoBitacora"];?></td>
				<td><?php echo $bitacora["comentariosBitacora"];?></td>
               
              </tr>
<?php 		}
 }else{ 
	 echo "<tr><td colspan='12'>No existen bitacoras en este curso</td></tr>"; 
  
  }
 
  
  ?>
  
  
 </tbody> 
</table><br />


<div id="guarda2"></div>