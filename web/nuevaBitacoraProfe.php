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

function actualizaSecciones(idUsuario,idCapitulo,idCurso){
	var division = document.getElementById("seccion"); 
	var a = "idPadre="+idCapitulo+"&profesor="+idUsuario+"&curso="+idCurso;
	AJAXPOST("select.php",a,division);
	if(idUsuario!=0){
		muestraBitacorasSeccion(idUsuario,idCapitulo,idCurso);
	}
}

function muestraBitacorasSeccion(idUsuario,idCapitulo,idCurso){
	var division = document.getElementById("listadoBitacoras");
	var a = "idUsuario="+idUsuario+"&idCapitulo="+idCapitulo+"&idCurso="+idCurso; 
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

function traeCapitulos(idUsuario,parte,curso){
	var division = document.getElementById("idPadre");
	a = "idUsuario="+idUsuario+"&parte="+parte+"&idCurso="+curso;
	AJAXPOST("nuevaBitacoraProfeCapitulos.php",a,division);
	actualizaSecciones(0,0,0)
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
En esta bitácora, usted deberá reportar aspectos relativos al uso de los textos con sus estudiantes. 
Debe completarla <strong>al finalizar el estudio de cada apartado</strong>.<br /><br />
En la casilla "Fecha de inicio" indique la fecha en que comenzó a estudiar el apartado.
En la casilla "Horas pedagógicas" indique la cantidad de horas pedagógicas utilizadas en el estudio 
de dicho apartado. Si usted planea no implementar algún apartado del libro, igual deberá declararlo en esta sección, 
pero indcando un valor de "0" en el campo "Horas de implementación" del formulario que se despliega a continuación.
<strong>Recuerde que sólo podrá completar una bitácora por cada apartado del libro.</strong>
</p>
<table border="0" align="center" class="tablesorter">
	<tr>
    	<th colspan="2">Ingreso de Bítacora</th>
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
    <tr>
		<td valign="top">
			Libro:
        </td>
        <td>
			<select id="libro" name="libro" style="width:250px" onchange="traeCapitulos(profesor.value,this.value,cursoColegio.value)">
            	<option>Seleccione Libro</option>
            </select>
        </td>
	</tr>
	<tr>
	<?php 
		if($idPerfil == 1){?>
		   <input name="tipoBitacora" id="tipoBitacora" class="campos" type="hidden" value="Profesor" />
		<?php }else if($idPerfil == 3){ ?>
		   <input name="tipoBitacora" id="tipoBitacora" class="campos" type="hidden" value="UTP" />
		<?php }else{ ?>
		<input name="tipoBitacora" id="tipoBitacora" class="campos" type="hidden" value="Nivel superior" />
		<?php } ?>
		<td>Capítulo</td>
        <td valign="top">
 			<select name="idPadre" class="campos" onchange="javascript:actualizaSecciones(profesor.value,this.value,cursoColegio.value);" id="idPadre" style="width:250px">
                 <option value="">Seleccione Capítulo</option>
					<?php 							
                    foreach ($seccionesPadre as $seccion){ 
                            $opc_sel = "";
                            if ($seccion["idSeccionBitacora"] == @$idPadre){
                                $opc_sel = "selected";	
                            }
                    ?>
                 <option <?php echo $opc_sel; ?> value="<?php echo $seccion["idSeccionBitacora"];?>" ><?php echo $seccion["nombreSeccionBitacora"];?>
                 </option>
                <?php }?>
            </select>
    	</td>
    </tr>
    <tr>
	    <td>Apartado</td>
		<td valign="top">
        	<select name="seccion" id="seccion"  class="campos" style="width:250px">
            	<option value="">Seleccione Apartado</option>
			</select>
    	</td>
	</tr>
    <tr>
	    <td>Horas de implementación</td>
		<td valign="top">
        	<input type="number" min="0" max="30" maxlength="2" id="horas" name="horas" class="campos" onblur="validaHoras('horas')" style="width:250px" required="required" pattern= "[0-9]{1,2}" />
    	</td>
	</tr>
    <tr>
	    <td>Fecha de Inicio</td>
		<td valign="top">
        	<input type="text" id="datepicker" name="fInicio" class="campos" style="width:250px"/>
    	</td>
	</tr>
    <tr>
	    <td>Fecha de Término</td>
		<td valign="top">
        	<input type="text" id="datepicker2" name="fTermino" class="campos" style="width:250px"/>
    	</td>
	</tr>
    <tr>
        <td colspan="2" align="right">
        <?php 
        boton("Enviar","guardaBitacora()");
        ?>
        </td>
    </tr>
</table>
<div id="guardaBitacora"></div>
<div id="listadoBitacoras"></div>
<div id="listadoCapitulos"></div>


