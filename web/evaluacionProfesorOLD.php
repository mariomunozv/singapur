<?php 
require("inc/incluidos.php");
require ("hd.php");

function DatosUsuario($idUsuario){
	$sql = "SELECT * from usuario WHERE idUsuario = ".$idUsuario;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosUsuario = array("rutAlumno" => $row["rutAlumno"],"rutProfesor" => $row["rutProfesor"],"tipoUsuario" => $row["tipoUsuario"]);
	return($datosUsuario);
	
	}

function cuentaAlumnosCurso($letraCursoColegio,$anoCursoColegio,$rbdColegio,$idNivel){
	$sql = "SELECT Count(rutAlumno) AS resultado FROM matricula where rbdColegio = '$rbdColegio' and idNivel = $idNivel and anoCursoColegio = $anoCursoColegio and letraCursoColegio = '$letraCursoColegio'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	echo $row["resultado"];
	
	}

function getCursosProfesor($rutProfesor, $anoCursoColegio){
	$sql = "SELECT * FROM cursoColegio cu join nivel ni on cu.idNivel = ni.idNivel WHERE cu.rutProfesor = '$rutProfesor' 			AND cu.anoCursoColegio = $anoCursoColegio";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	$cursos = array();
	while ($row = mysql_fetch_array($res)){
	
	$cursos[$i] = array( 
		"rbdColegio" => $row["rbdColegio"],
		"anoCursoColegio" => $row["anoCursoColegio"],
		"letraCursoColegio" => $row["letraCursoColegio"],
		"idNivel" => $row["idNivel"],
		"rutProfesor" => $row["rutProfesor"],
		"nombreNivel" => $row["nombreNivel"],
		"nombreCurso" => $row["nombreNivel"]." ".$row["letraCursoColegio"]." - ".$row["anoCursoColegio"]
		);	
	$i++;
	
	}
	return($cursos);
	
}

if(@$_REQUEST["escala"] != ""){
	$escala = $_REQUEST["escala"];
}else{
	$escala = 0.5;
	}
	



registraAcceso($_SESSION["sesionIdUsuario"], 17, 'NULL'); 
$datosUsuario = DatosUsuario($_SESSION["sesionIdUsuario"]);

?>
<script>
function muestraCurso(rbdColegio,idNivel,anoCursoColegio,letraCursoColegio,escala,nombreNivel,idLista){
	
	a = "rbdColegio="+rbdColegio+"&idNivel="+idNivel+"&anoCursoColegio="+anoCursoColegio+"&letraCursoColegio="+letraCursoColegio+"&escala="+escala+"&nombreNivel="+nombreNivel+"&idLista="+idLista;
	var division = document.getElementById("lugarCarga");
	AJAXPOST("evaluacionAlumnoListadoResumenOLD.php",a,division);
} 
</script>


<body> 
 

<div id="principal">
<?php require("topMenu.php"); ?>
	
    <div id="lateralIzq">
    <?php 
		require("caja_misCursos.php");
        require("caja_glosarioPalabra.php");
       require("caja_participantes.php");
        require("caja_mensajes.php");
	
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
  
		<?php 
        require("caja_bienvenida.php");
        require("caja_calendario.php");
        ?>
    
    </div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
     
		
       <div id="tituloPagina"><h1>Evaluaciones</h1></div><br>

<p>
En el siguiente listado usted encontrar� los cursos que tiene asignados en el
Sistema. Para ingresar al listado de los alumnos y modificar los puntajes seleccione una de las <img src="img/ver.gif" width="14" height="14" alt="Ver m�s" title="Ver m�s" /> <strong>Pruebas</strong>. 
</p>


<table class="tablesorter" id="tabla">
   <thead> 
          
  <tr>
    <th>Curso</th>
    <th>A�o</th>
    <th>Profesor Jefe </th>
    
	<th>N alumnos</th>
    <th>Opciones</th>
  </tr>
  </thead>
  <tbody> 
  <?php 
  $anoActual = 2012;
  $cursos = getCursosProfesor($datosUsuario["rutProfesor"],$anoActual);
 

  if (count($cursos) > 0){
		foreach ($cursos as $curso){  
		
$nombre = getNombreProfesor($datosUsuario["rutProfesor"]);

	  ?>
              <tr onMouseOver="this.className='normalActive'" onMouseOut="this.className='normal'" class="normal">
                <td><?php echo $curso["nombreNivel"]." ".$curso["letraCursoColegio"];?></td>
                <td><?php echo $curso["anoCursoColegio"];?></td>
                <td><?php echo $nombre;?> </td>
                  <td><?php cuentaAlumnosCurso($curso["letraCursoColegio"],$curso["anoCursoColegio"],$curso["rbdColegio"],$curso["idNivel"]);?> </td>
                
  <td>
  <?php 
  $i=0;
  
  switch($curso["idNivel"])
  {
	  // 1� b�sico
	  case 1:
	  		$pruebas = array(13,17);
		  	break;
	  
	  // 2� b�sico
	  case 2:
		  	$pruebas = array(14,18);
		  	break;
			
	  // 3� b�sico
	  case 3:
	  		$pruebas = array(15,19);
		  	break;
	  
	  // 4� b�sico
	  case 4:	  	
		  	$pruebas = array(16,20);
		  	break;
   }
  
  
  
  foreach ($pruebas as $idLista){
	  $i++;
	 // para separar P1,P2 de P3,P4
		if ($i == 3)
	 	{
			echo "<br>"; 
		}
	  ?>
  <a href="javascript:muestraCurso(<?php echo $curso["rbdColegio"];?>,<?php echo $curso["idNivel"];?>,<?php echo $curso["anoCursoColegio"];?>,'<?php echo $curso["letraCursoColegio"];?>',<?php echo $escala.",'".$curso["nombreNivel"]."',".$idLista; ?>)"><img border="0" src="img/ver.gif" width="14" height="14" alt="Ver m�s" title="Ver m�s" /> Prueba <?php echo $i;?></a>
  <?php } ?>
  
  </td>
             </a>
               
              </tr>
<?php 		}
 }else{ 
	 echo "<tr><td colspan='5'>No existen Cursos asociados a este profesor</td></tr>"; 
  
  }
  
  ?>
 </tbody> 
</table>

            
           
  <div id="lugarCarga"></div>          
      
  <?php
if(@$_SESSION["sesionRbdColegio"] != ""){?>
	<script>

	
	
	muestraCurso(<?php echo $_SESSION["sesionRbdColegio"];?>,<?php echo $_SESSION["sesionIdNivel"];?>,<?php echo $_SESSION["sesionAnoCursoColegio"];?>,'<?php echo $_SESSION["sesionLetraCursoColegio"];?>',<?php echo $escala.","."'".$_SESSION["sesionNombreNivel"]."'"; ?>);

		
	</script>
	<?php
	}
?>      
        
			
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>
