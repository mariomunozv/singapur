<?php 

 ini_set('display_errors','On');

//session_start();
require("inc/config.php");
include "../inc/_funciones.php";
require("../inc/_colegio.php");
require("../inc/_detalleColegioProyecto.php");
require("../inc/_profesor.php");
//require("../inc/_directivo.php");
require("../inc/_empleadoKlein.php");
require("../inc/_cursoCapacitacion.php");
require("../inc/_usuario.php");
require("../inc/_perfil.php");



require("_head.php"); 
$menu = "usu"; 
require("_menu.php");  
$navegacion = "Usuarios*#";
require("_navegacion.php");
 

?>


<script language="javascript">

function new_usuario(){//nuevo_usuario
	var division = document.getElementById("usuario_nuevo");
	AJAXPOST("usuarioNuevo.php","",division);
} 


function new_(){
	var division = document.getElementById("lugar_de_carga");
	AJAXPOST("escuelaNuevo.php","",division);
} 

class_activo('boton_usuarios','activo');

</script>


<!--inicio seccion importada-->

<script language="javascript">


function upload_profesores(){
  var division = document.getElementById("cargar_aqui");
  AJAXPOST("uploadProfesor.php","",division);
} 

function upload_utp(){
  var division = document.getElementById("cargar_aqui");
  AJAXPOST("uploadUTP.php","",division);
} 

function upload_alumnos(){
  var division = document.getElementById("cargar_aqui");
  AJAXPOST("uploadAlumnosCurso.php","",division);
} 

/*
$(function() {
  $("#tabla").tablesorter({ 
    headers: {  
      0: { sorter: false }
       // Esto es para inabilitar el filtro en una columna
    },
    sortList: [[5,0], [3,0], [2,0]],
    widthFixed: true,
    widgets: ['zebra']}).tablesorterPager({
      container: $("#pager"),
      positionFixed: false,
      size:1000//Numero de registros tb
      });  
});
*/

$(document).ready(function() 
    { 
        $("#tabla").tablesorter(); 
    } 
); 

</script>
<span class="titulo_form">Usuarios</span>

<br />
<br />
<h4>Carga de datos</h4>
<br />


<? 
boton("Cargar Profesores", "upload_profesores();");
boton("Cargar UTPs", "upload_utp();");
boton("Cargar Alumnos", "upload_alumnos();");
?>


<br />
<br />
<div id="cargar_aqui"></div>
<br />
<br />

<!--Fin seccion -->


<form name="form" action="" method="POST" enctype="multipart/form-data">
	<div id="lugar_de_carga"></div>  
	</form>
    <a class="button" href="javascript:new_usuario();">
        <span>
            <div class="add">
            	<?php echo "Nuevo Usuario"; ?>
            </div>
        </span>
    </a>
            
<br />
<br />
  <div id="guarda"></div>
<div id="usuario_nuevo"></div>


<div class="caja">
  
  <table class="tablesorter" id="tabla">

   <thead>         
  <tr>
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
    
    $cuantos = 0;
  
    
  if (count($idUsuarios) > 0){
    foreach ($idUsuarios as $idUsuario){  
      $usuariosObtenidos = getDatosUsuarioPorId($idUsuario['idUsuario']);
      if($usuariosObtenidos['estadoUsuario'] == 1){

        $cuantos++;
 ?>
              <tr>
                <td>
                  <?php echo $idUsuario['idUsuario'];?>
                </td>
                <td>
                  <?php echo $usuariosObtenidos["nombre"];?>
                </td>
                <td>
                  <?php echo $usuariosObtenidos["apellidoPaterno"];?>
                </td>
                <td>
                  <?php echo $usuariosObtenidos["rbdColegio"];?>
                </td>
                <td>
                  <?php echo $usuariosObtenidos["tipoUsuario"];?>
                </td>
              </tr>
              
<?php     }
}
 }else{ 
   echo "<tr><td colspan='12'>No existen Usuarios registrados</td></tr>"; 
  
  }
  
  ?>
 </tbody> 
</table> 

<p><?php echo $cuantos; ?> Usuarios activos</p>

</div>

<?php require("_pie.php"); ?>
