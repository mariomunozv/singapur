<?php
require("inc/config.php");
include "../inc/_funciones.php";
include "../inc/_seccionBitacora.php";
include "../inc/_nivel.php";
if(isset($_SESSION["idSiguiente"]))
	$idSiguiente = $_SESSION["idSiguiente"];
else
	$idSiguiente = "";

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


function cargaCapitulos(idNivel){
	var division = document.getElementById("capitulos");
	a = "idNivel="+idNivel;
	AJAXPOST("itemSerieNuevoCapitulos.php",a,division);
}

function cancelar(){
	if(confirm("Cancelar esta operacion?")){ location.href="item.php"; }  
}

function save_item(){
	if(val_obligatorio("fondoItem") == false){ return; } // CAMPOS
	if(val_obligatorio("enunciadoItem") == false){ return; }
	if(val_obligatorio("respuestaCorrectaItem") == false){ return; }
	if(val_obligatorio("idTareaMatematica") == false){ return; }
	
 	if(confirm("Seguro de insertar item?")){
		var division = document.getElementById("lugar_de_carga");
		var a = $(".campos").fieldSerialize();
		a = simbolos(a);
		AJAXPOST("itemGuarda.php",a,division);
	}
}

function Alternar(Seccion){ 
    if (Seccion.style.display=="none"){Seccion.style.display=""}
    else{Seccion.style.display="none"} 
}

function cargaApartados(idSeccion){
	var division = document.getElementById("apartado");
	a = "idSeccion="+idSeccion;
	AJAXPOST("itemSerieNuevoApartados.php",a,division);
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
				<th align="right">Fondo (ID)</th> 
				<td><input type="text" name="fondoItem" value="" class="campos" id="fondoItem"></td>
			</tr>    
            <tr>
				<th align="right">Enunciado</th> 
				<td><textarea name="enunciadoItem" class="campos" cols="70" rows="4" id="enunciadoItem"></textarea></td>
			</tr>  
            <tr>
				<th align="right">Soluci&oacute;n</th> 
				<td><input type="text" name="respuestaCorrectaItem" value="" size="70" class="campos" id="respuestaCorrectaItem"></td>
			</tr>  
            <tr>
				<th align="right">Cantidad de respuestas</th> 
				<td><input type="text" name="cantidadRespuestasItem" value="" size="5" class="campos" id="cantidadRespuestasItem"></td>
			</tr> 
            
            <tr>
				<th align="right">Puntaje respuesta(s)</th> 
				<td><input type="text" name="puntajeItem" value="" class="campos" id="puntajeItem"></td>
			</tr>  
            

            
            <tr>
				<th align="right">Selecci&oacute;n multiple?</th> 
				<td><input type="checkbox" value="0" onClick="Alternar(div_alternativas)" name="esAbiertoItem" class="campos" id="esAbiertoItem"></td>
			</tr>
            
            <div id="div_alternativas" style="display:none;">
            <!--Alternativas <strong>(marcar correcta)</strong>:<br />-->
            
            <tr>
                <th align="right"><input type="radio" name="esCorrecta" value="0" id="esCorrecta1" class="campos"/></th>
                <td>
                <textarea cols="50" rows="4" name="etiqueta1" id="etiqueta1" ondblclick="document.getElementById('esCorrecta1').checked=true;" class="campos"></textarea></td>
            </tr>
            <tr>
                <th align="right"><input type="radio" name="esCorrecta" value="1" id="esCorrecta2" class="campos"/></th>
                <td><textarea cols="50" rows="4" name="etiqueta2" id="etiqueta2" ondblclick="document.getElementById('esCorrecta2').checked=true;" class="campos"></textarea></td>
            </tr>
            <tr>
                <th align="right"><input type="radio" name="esCorrecta" value="2" id="esCorrecta3" class="campos"/></th>
                <td><textarea cols="50" rows="4" name="etiqueta3" id="etiqueta3" ondblclick="document.getElementById('esCorrecta3').checked=true;" class="campos"></textarea></td>
            </tr>
            <tr>
                <th align="right"><input type="radio" name="esCorrecta" value="3" id="esCorrecta4" class="campos"/></th>
                <td><textarea cols="50" rows="4" name="etiqueta4" id="etiqueta4" ondblclick="document.getElementById('esCorrecta4').checked=true;" class="campos"></textarea></td>
            </tr>

            </div>  
            
                      
            <tr>
				<th align="right"></th> 
				<td>&nbsp;</td>
			</tr>  
            <tr>
				<th align="right">Tema</th> 
				<td>
                <select>
	                <option value="">Seleccione un tema</option>
	                <option value="didactica">Did&aacute;ctica</option>
                	<option value="matematica">Matem&aacute;tica</option>
                </select>
                </td>
			</tr>  
            <tr>
				<th align="right">Nivel</th> 
				<td>
                <select onchange="cargaCapitulos(this.value)">
                <?php 
				$niveles = getNiveles();
				echo "<option value=''>Seleccione un Nivel</option>";
				foreach($niveles as $nivel){
					echo "<option value=".$nivel["idNivel"].">".$nivel["nombreNivel"]."</option>";
				}
				?>
                </select>
                </td>
			</tr>  
            <tr>
				<th align="right">Cap&iacute;tulo</th> 
				<td>
                <select title="" onchange="javascript:cargaApartados(this.value);" name="capitulos" style="width:300px;" class="campos" id="capitulos">
                	<option value=''>Seleccione un cap&iacute;tulo</option>
                </select>
                <!--<input type="checkbox" name="fijar_idTareaMatematica" value="1" class="campos"/>Fijar-->
                </td>
			</tr>
            <tr>
				<th align="right">Apartado</th> 
				<td>
                <select title=""  name="apartado" style="width:300px;" class="campos" id="apartado">
                	<option value=''>Seleccione un apartado</option>
                </select>
                <!--<input type="checkbox" name="fijar_idTareaMatematica" value="1" class="campos"/>Fijar-->
                </td>
			</tr>  
		</tbody>
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

<div id="variables"></div>	
    
            