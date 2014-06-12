<?php 
//session_start();
require("inc/config.php");
require("../inc/_colegio.php");
//require("../inc/_detalleColegioProyecto.php");
require("../inc/_profesor.php");
//require("../inc/_directivo.php");
require("../inc/_empleadoKlein.php");
require("../inc/_cursoCapacitacion.php");
require("../inc/_usuario.php");
require("../inc/_perfil.php");
//require("inc/sesionAdmin.php");


require("_head.php");  
$menu = "ini"; 
//require("_menu.php");  
$navegacion = "Inicio*inicio.php";
//require("_navegacion.php");
 



function getBitacorasCurso($idCurso){
//	$sql = "SELECT * FROM bitacora a join inscripcionCursoCapacitaciion b on a.idUsuario = b.idUsuario WHERE b.idCursoCapacitacion = ".$idCurso;
    $sql.=" SELECT a.nombreBitacora,a.fechaBitacora,a.tiempoBitacora, a.comentariosBitacora,a.fechaCreacionBitacora,a.tipoBitacora,c.rutProfesor, ";
	$sql.=" c.apellidoPaternoProfesor,c.nombreProfesor,c.apellidoMaternoProfesor,d.nombreColegio ";
    $sql.=" join inscripcionCursoCapacitacion e on b.idUsuario = e.idUsuario ";
	$sql.=" FROM `bitacora` a join usuario b on a.idUsuario = b.idUsuario join profesor c on b.rutProfesor = c.rutProfesor join colegio d on c.rbdColegio = d.rbdColegio ";
	$res = mysql_query($sql);
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
					"nombreColegio" => $row["nombreColegio"] );	
	$i++;
	}
	return($bitacoras);
} 
	 
	 
/*if($_REQUEST["modo"] == "aceptar"){
	$sql = "update evaluacion set eva_decision = 'A', eva_recepcionado = '".date("Y-m-d")."' where eva_id = '".$_REQUEST["eva"]."' ";
	$res = mysql_query($sql);
}
if($_REQUEST["modo"] == "rechazar"){
	$sql = "update evaluacion set eva_decision = 'R', eva_recepcionado = '".date("Y-m-d")."' where eva_id = '".$_REQUEST["eva"]."' ";
	$res = mysql_query($sql);
}*/
?>


<script language="javascript">

function new_cursoCapacitacion(){
	var division = document.getElementById("curso_nuevo");
	AJAXPOST("cursoCapacitacionNuevo.php","",division);
} 


function actualizaCurso(){

	cursoListado(document.getElementById("idCurso").value);
	
	
} 
function cursoListado(curso){

	var division = document.getElementById("listaCurso");
	AJAXPOST("informeBitacoraListado.php","idCurso="+curso,division);
	
} 




class_activo('boton_informeBitacora','activo');

</script>

<p>
<span class="titulo_form">Adminitracion Sistema</span>




<?php 

$colegios = getColegios();
$cursosCapacitacion = getCursosCapacitacion();





?>



 
        
  <div id="guarda"></div>
<div id="curso_nuevo"></div>



<table class="tablesorter">
            	
                <tr>
                	
                    <td><label>
                      <select name="idCurso" id="idCurso" onchange="actualizaCurso()">
                      <option>Selecciona Curso</option>
                       <?php foreach ($cursosCapacitacion as $curso){?>
                      		<option value="<?php echo $curso["idCursoCapacitacion"];?>"><?php echo $curso["nombreCortoCursoCapacitacion"];?></option>
                      <?php }?>
                      </select>
                    </label></td>
                    
                </tr>
            </table>
            
       
<div id="listaCurso"></div>





      
<?php require("_pie.php"); ?>
