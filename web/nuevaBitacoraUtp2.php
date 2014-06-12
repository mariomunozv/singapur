<?php 
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
Conectarse_seg();
$idJornada = 1;?>


<script language="javascript">

    function guardaBitacoraUTP2(){  
//		if((val_obligatorio("niveles1") == false) ||  (val_obligatorio("niveles2") == false)  || (val_obligatorio("niveles3") == false) ){ return; }
		if(val_obligatorio("datepicker") == false){ return; }
		if(val_obligatorio("tiempo") == false){ return; }
		if(val_obligatorio("comentarios") == false){ return; }
		//if(val_obligatorio("niveles1") == false){ return; }
		//if(IsChk("niveles")== false) {return alert("sadlasd"); }
	   	var division = document.getElementById("sinDiv");
		var a = $(".campos").fieldSerialize();
		//alert(a);
		AJAXPOST("bitacoraGuarda.php",a,division);  
	}
	
	
	
	
	

</script>

<?php
/*function numNuevaClase($idJornada, $idUsuario){
		$sql = "SELECT COUNT(*) FROM bitacoraClase WHERE idJornada = ".$idJornada." and idUsuario = ".$idUsuario;
		$res = mysql_query($sql);
		$ret = mysql_result($res,0);
	    return $ret+1;
	}*/


			
	
?>



					<br />
                    <p align="justify">
                    En esta bitácora, usted deberá reportar aspectos relativos a las observaciones de aula realizadas.<br /><br /> 
                    En la casilla "Fecha " indique la fecha en que se realizó la observación.
                    En la casilla "Minutos" indique la duración de la observación en minutos.
                    Luego, seleccione el nivel del curso observado.
                    Puede completar tantas bitácoras como observaciones haya realizado en la semana.

                    </p>
<div id="sinDiv"></div>
                	<table width="88%" border="0" align="center" class="tablesorter">
                    <tr >
                      <th width="14%">Acompañamiento en aula</td>
                      <th width="15%">Fecha </td>
                      <th>Minutos</td>
                      <th>Nivel</th>
                      </tr>
                    <tr>
                      <td valign="top">Acompañamiento en aula</td>
                      <td valign="top"><input name="fechaClase" type="text" id="datepicker" size="12" class="campos" value = ""/></td>
                      <td valign="top">
                      			<select name="tiempo" id="tiempo" class="campos">
                                        <option value="30">30</option>
                                        <option value="60">60</option>
                                        <option value="90">90</option>
                                         <option value="90">120</option>
                      			</select></td>
                      <td valign="top">
                      								<table border="0">
                      									<tr>
                                                            <td><label><input type="radio" name="nivel" value="1"  class="campos" />1 Básico</label></td>
                                                            <td><label><input type="radio" name="nivel" value="2"  class="campos" />2 Básico</label></td>
                                                            <td><label><input type="radio" name="nivel" value="3"  class="campos" />3 Básico</label></td>
                        								</tr>
                                                     </table>
                       </td>
                      </tr>
                      <tr><th colspan="4">Contenidos tratados en clase y aspectos a destacar</th></tr>
                    <tr >
                      
                      <td colspan="4"><textarea name="comentarios" id="comentarios" cols="68" rows="8" class="campos"></textarea></td>
                      </tr>
                      <tr>
                      <td colspan="4">
                      <input name="tipoBitacora" id="tipoBitacora" type="hidden" value="utp2" class="campos"/>
                      <input name="niveles" id="niveles" type="hidden"  class="campos"/>
                   <?php boton("Enviar","guardaBitacoraUTP2()"); ?>
                      </td>
                      </tr>
                  </table>

             