<?php
require("inc/config.php");
include "../inc/_funciones.php";
include "../inc/_seccionBitacora.php";
include "../inc/_tareaMatematica.php";
$tareas = getTareasMatematicas();

function estaFija($variable){
	if(isset($_SESSION["$variable"])){
		$idRetorno = $_SESSION["$variable"];
	}
	
	else
		$idRetorno = "";
		
	return $idRetorno;
}


?> 

<script language="javascript">


function actualizaVariables(){
	var division = document.getElementById("variables"); 
	var a = $(".campos").fieldSerialize(); 
	AJAXPOST("itemNuevoVariablesDidacticas.php",a,division);
	

}

function eligeSeccion(){
	var division = document.getElementById("idSeccionBitacora"); 
	var a = $(".campos").fieldSerialize(); 
	AJAXPOST("itemNuevo_selectSeccion.php",a,division);
	

}


function cancelar(){
	if(confirm("Cancelar esta operacion?")){ location.href="item.php"; }  
}
function save_item(){

	if(val_obligatorio("enunciadoItem") == false){ return; }
	if(val_obligatorio("idTareaMatematica") == false){ return; }
 	if(confirm("Seguro de insertar item?")){

 var division = document.getElementById("lugar_de_carga");
 var a = $(".campos").fieldSerialize();
 a = simbolos(a);
 AJAXPOST("itemGuarda.php",a,division);
 }
}



function cambiarTitulo(objeto){
	objeto.title = objeto.options[objeto.selectedIndex].text;
}

</script>

        

	<table>
<tr valign="top">
  <td>
	<table class="formulario"> 
		<tbody>
			<!--<tr class="odd">
				<td colspan="2">Los campos con un  (*) son obligatorios.</td> 
			</tr> -->
			<input type="hidden" class="campos" name="modo" id="modo" value="nuevo">  
			

			
            <tr>
				<th align="right">Enunciado</th> 
				<td><textarea name="enunciadoItem" class="campos" cols="70" rows="4" id="enunciadoItem"></textarea></td>
			</tr>  
            
            <tr>
				<th align="right">Capitulo</th>
                <?php
                $idVariableFija = estaFija("fijar_idCapitulo");
				if ($idVariableFija != ""){
				?>	
					<script>
					eligeSeccion();
					</script>
                <?php
				}
				?> 
				<td><select name="idCapitulo" style="width:600px;" class="campos" id="idCapitulo" onchange="eligeSeccion()">
				<?php 
                $arreglo = getCapitulosConNivel();
				
				//print_r($arreglo);
				// 220 = idSeccionBitacora de Capitulo 12, "Números hasta 40"
				//getIdNombreTabla("SeccionBitacora");
				$idVariableFija = estaFija("fijar_idCapitulo");
                armaSelectActual($arreglo,"SeccionBitacora",$idVariableFija);
                //armaSelect($arreglo,"TareaMatematica"); 
                ?>
                </select>
                <input type="checkbox" name="fijar_idCapitulo" value="1" class="campos"/>Fijar
                </td>
			</tr>  
            <!--
            <tr>
				<th align="right">Seccion</th> 
				<td><select name="idSeccionBitacora" style="width:600px;" class="campos" id="idSeccionBitacora">
                </select>
                <input type="checkbox" name="fijar_idSeccionBitacora" value="1" class="campos"/>Fijar
                </td>
			</tr>  
             -->          
            <tr>
				<th align="right">Tarea matem&aacute;tica</th> 
				<td><select title="" onmouseover="javascript:cambiarTitulo(this)" name="idTareaMatematica" style="width:600px;" class="campos" id="idTareaMatematica">
                <option value="">Seleccione una tarea</option>
				<?php 
				foreach($tareas as $tarea){
	                echo "<option value=".$tarea[idTareaMatematica].">".$tarea[nombreTareaMatematica]."</option>";
				}
                ?>
                </select>
                <input type="checkbox" name="fijar_idTareaMatematica" value="1" class="campos"/>Fijar
                </td>
			</tr> 
            
            
            <tr>
				<th align="right">Competencia</th> 
				<td><select name="idCompetencia" style="width:600px;" class="campos" id="idCompetencia">
				<?php 
                $arreglo = getIdNombreTabla("Competencia");
				$idVariableFija = estaFija("fijar_idCompetencia");
                armaSelectActual($arreglo,"Competencia",$idVariableFija);
                //armaSelect($arreglo,"TareaMatematica"); 
                ?>
                </select>
                <input type="checkbox" name="fijar_idCompetencia" value="1" class="campos"/>Fijar
                </td>
			</tr>   
            
            <tr>
				<th align="right">Nivel de complejidad</th> 
				<td><select name="idNivelDeComplejidad" style="width:600px;" class="campos" id="idNivelDeComplejidad">
				<?php 
                $arreglo = getIdNombreTabla("NivelDeComplejidad");
				$idVariableFija = estaFija("fijar_idNivelDeComplejidad");
                armaSelectActual($arreglo,"NivelDeComplejidad",$idVariableFija);
                //armaSelect($arreglo,"TareaMatematica"); 
                ?>
                </select>
                <input type="checkbox" name="fijar_idNivelDeComplejidad" value="1" class="campos"/>Fijar
                </td>
			</tr> 
            

            
                    
           
            
            <tr>
				<th align="right">Puntaje max</th> 
				<td><input type="text" name="puntajeItem" value="2" class="campos"/></td>
			</tr>  
            
            
            
            <tr>
				<th align="right"></th> 
				<td>&nbsp;</td>
			</tr>    
            
		</tbody>
		<tr>
		  <td>
		    <tr>
	      <td>        
	      </table>
  </td>
  
  <td style="vertical-align:top;">
	<a class="button" href="javascript:save_item();"><span><div class="save">Insertar</div></span></a><br><br>
	<a class="button" href="javascript:cancelar();"><span><div class="delete">Cancelar</div></span></a>
  </td>
</tr>

<tr>
	<td>&nbsp;
    </td>
	<td style="vertical-align:top;">
	<a class="button" href="javascript:save_item();"><span><div class="save">Insertar</div></span></a><br><br>
	<a class="button" href="javascript:cancelar();"><span><div class="delete">Cancelar</div></span></a>
  </td>
</tr>

</table>


    
            