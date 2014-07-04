<?php 
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
Conectarse_seg();
$idJornada = 1;
$idCurso = 1; 
$idUsuario = $_SESSION['sesionIdUsuario'];
$idPerfil = $_REQUEST["perfil"];
?>

<script> 

function actualizaSecciones(idUsuario,idCapitulo){
	var division = document.getElementById("seccion"); 
	var a = "idPadre="+idCapitulo+"&profesor="+idUsuario;
	AJAXPOST("select.php",a,division);
	if(idUsuario!=0){
		muestraBitacorasSeccion(idUsuario,idCapitulo);
	}
}

function muestraBitacorasSeccion(idUsuario,idCapitulo){
	var division = document.getElementById("listadoBitacoras");
	var a = "idUsuario="+idUsuario+"&idCapitulo="+idCapitulo; 
	AJAXPOST("bitacorasProfeListado.php",a,division);
}

function traeCursos(idUsuario){
	var division = document.getElementById("cursoColegio");
	a = "idUsuario="+idUsuario;
	AJAXPOST("nuevaBitacoraProfeCursos.php",a,division);
}

function traePartes(idUsuario,idCurso){
	muestraCapitulosCompletos(idUsuario,idCurso)
	var division = document.getElementById("libro");
	a = "idCurso="+idCurso;
	AJAXPOST("nuevaBitacoraProfePartesLibros.php",a,division);
}

function traeCapitulos(idUsuario,parte){
	var division = document.getElementById("idPadre");
	a = "idUsuario="+idUsuario+"&parte="+parte;
	AJAXPOST("nuevaBitacoraProfeCapitulos.php",a,division);
	actualizaSecciones(0,0)
}

function muestraCapitulosCompletos(idUsuario,idCurso){  
	var division = document.getElementById("listadoCapitulos");
	a = "idUsuario="+idUsuario+"&idCurso="+idCurso;
	AJAXPOST("bitacorasCapitulosListados.php",a,division);  
}

function validaHoras(id){
	var valor = document.getElementById(id);
	if(!valor.checkValidity()){
		alert("Ingrese una cantidad de horas válidas");
		valor.focus();
		return;
	}else if(valor.value < 0 || valor.value > 30 ) {
		alert("El número de horas debe ser entre 0 y 30")
		valor.focus();
		return;
	}else{
		return true;
	}
}

function guardaBitacora(){
	if(val_obligatorio("profesor") == false){ return; }
	if(val_obligatorio("cursoColegio") == false){ return; }
	if(val_obligatorio("libro") == false){ return; }
	if(val_obligatorio("idPadre") == false){ return; }
	if(val_obligatorio("seccion") == false){ return; }
	if(val_obligatorio("horas") == false){ return; }
	if(document.getElementById("horas").value > 0){
		if(val_obligatorio("datepicker") == false){ return; }
		if(val_obligatorio("datepicker2") == false){ return; }
		if(document.getElementById("datepicker2").value < document.getElementById("datepicker").value){
			alert("La fecha de inicio no puede ser mayor a la fecha de término");
			return;
		}
	}
	var division = document.getElementById("guardaBitacora");
	var a = $(".campos").fieldSerialize(); 
	AJAXPOST("bitacoraGuarda.php",a,division);
}

</script>

<?php

$usuario = getDatosUsuarioPorId($idUsuario);
$profesores = getProfesoresColegio($usuario['rbdColegio']);
?>


<br />
<p align="justify">
Busque a continuaci&oacute;n el profesor y curso para ver bit&aacute;cora
</p>
<table border="0" align="center" class="tablesorter">
	<tr>
    	<th colspan="2">Ingreso de Bit&aacute;cora</th>
	</tr>
<?php
// Llegó desde el curso
if (isset ($_REQUEST["idSeccionBitacora"])){
	$idPadre = getPadre($_REQUEST["idSeccionBitacora"]);
	?>
	<script>
		actualizaSecciones();
	</script>
	
<?php
}		
?>
	<tr>
    	<td valign="top">
			Profesor: 
        </td>
 		<td valign="top">
        	<select id="profesor" name="profesor" style="width:250px" class="campos" onchange="traeCursos(this.value)">
            	<option value="">Seleccione Profesor</option>
			<?php 
			if($idPerfil == 1){
				echo "<option value=".$usuario['idUsuario'].">".$usuario['nombre']." ".$usuario['apellidoPaterno']."</option>";
			}else if($idPerfil == 3 || $idPerfil == 4){
				foreach($profesores as $profesor){
					echo "<option value=".$profesor['idUsuario'].">".$profesor['nombreProfesor']." ".$profesor['apellidoPaternoProfesor']."</option>";
				}
			}else{
				echo "<option>".$idPerfil."</option>";
			}
			?>
            </select>
        </td>
    </tr>
    <tr>
		<td valign="top">
			Curso:
        </td>
        <td>
			<select id="cursoColegio" name="cursoColegio" style="width:250px" onchange="traePartes(profesor.value,this.value)" class="campos">
            	<option value="">Seleccione Curso</option>
            </select>
        </td>
	</tr>
</table>
<div id="guardaBitacora"></div>
<div id="listadoBitacoras"></div>
<div id="listadoCapitulos"></div>