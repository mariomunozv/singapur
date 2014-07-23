<?php 

 ini_set('display_errors','On');

//session_start();
require("inc/config.php");
require("../inc/_colegio.php");
require("../inc/_detalleColegioProyecto.php");
require("../inc/_profesor.php");
//require("../inc/_directivo.php");
require("../inc/_empleadoKlein.php");
require("../inc/_cursoCapacitacion.php");
require("../inc/_usuario.php");
require("../inc/_perfil.php");



require("_head.php"); 
$menu = "ini"; 
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

class_activo('boton_profesores','activo');

</script>

<p>
<span class="titulo_form">Adminitracion Sistema</span>




<?php 
//$colegios = getColegiosProyecto(1);

//$tiposUsuarios = getTiposUsuario();

//$cursosCapacitacion = getCursosCapacitacion();
//$perfiles = getPerfiles();




?>


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
  <p>Usuarios activos</p>
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
      if($usuariosObtenidos['estadoUsuario'] == 1){

 ?>
              <tr>
                <td>
                  <input type="checkbox" name="sel[]" id="sel<?php echo $idUsuario['idUsuario'];?>"  class="campos" value="<?php echo $idUsuario['idUsuario'];?>">
                </td>
                <td onclick="check=document.getElementById('sel<?php echo $idUsuario['idUsuario'];?>');check.checked=(check.checked==false)?true:false;">
                  <?php echo $idUsuario['idUsuario'];?>
                </td>
                <td onclick="check=document.getElementById('sel<?php echo $idUsuario['idUsuario'];?>');check.checked=(check.checked==false)?true:false;">
                  <?php echo $usuariosObtenidos["nombre"];?>
                </td>
                <td onclick="check=document.getElementById('sel<?php echo $idUsuario['idUsuario'];?>');check.checked=(check.checked==false)?true:false;">
                  <?php echo $usuariosObtenidos["apellidoPaterno"];?>
                </td>
                <td onclick="check=document.getElementById('sel<?php echo $idUsuario['idUsuario'];?>');check.checked=(check.checked==false)?true:false;">
                  <?php echo $usuariosObtenidos["rbdColegio"];?>
                </td>
                <td onclick="check=document.getElementById('sel<?php echo $idUsuario['idUsuario'];?>');check.checked=(check.checked==false)?true:false;">
                  <?php echo $usuariosObtenidos["tipoUsuario"];?>
                </td>
              </tr>
              
<?php     }}
 }else{ 
   echo "<tr><td colspan='12'>No existen Usuarios registrados</td></tr>"; 
  
  }
  
  ?>
  <div id="listaCurso"></div>
</div>

<?php require("_pie.php"); ?>
