<?php 
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
Conectarse_seg();
$idJornada = 1;

?>

<script language="javascript">

    function guardaBitacoraUTP1(){  
//		if((val_obligatorio("niveles1") == false) ||  (val_obligatorio("niveles2") == false)  || (val_obligatorio("niveles3") == false) ){ return; }
		if(val_obligatorio("datepicker") == false){ return; }
		if(val_obligatorio("comentarios") == false){ return; }
		//if(val_obligatorio("niveles1") == false){ return; }
		//if(IsChk("niveles")== false) {return alert("sadlasd"); }
		var division = document.getElementById("sinDiv");
		var a = $(".campos").fieldSerialize();
		AJAXPOST("bitacoraGuarda.php",a,division);  
	}
	
	
	function IsChk(chkName)
	{
		var found = 0;
		var chk = document.getElementsByName(chkName+'[]');
		for (var i=0 ; i < chk.length ; i++)
		{
			if(chk.checked == true)
			{
				found = found + 1;
			}		
		}
		if (found != 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	

</script>

<?php

/*function numNuevaClase($idJornada, $idUsuario){
		$sql = "SELECT COUNT(*) FROM bitacoraClase WHERE idJornada = ".$idJornada." and idUsuario = ".$idUsuario;
		$res = mysql_query($sql);
		$ret = mysql_result($res,0);
	    return $ret+1;
	}*/


			
	if (@$_REQUEST["editar"]==1){
		$datosClase = getClase($_REQUEST["idClase"]);
		$clase = $datosClase["clase"];
		$idJornada=$datosClase["idJornada"];
		$idUsuario=$datosClase["idUsuario"];
		$clase=$datosClase["clase"];
		$fechaClase=$datosClase["fechaClase"];
		$minutos=$datosClase["minutos"];
		$libroAlumnoDe=$datosClase["libroAlumnoDe"];
		$libroAlumnoHasta=$datosClase["libroAlumnoHasta"];
		$libroProfeDe=$datosClase["libroProfeDe"];
		$libroProfeHasta=$datosClase["libroProfeHasta"];
		$comentarios=$datosClase["comentarios"];
	}else
	{
		$idUsuario = $_SESSION["sesionIdUsuario"];
		//$idJornada = $_REQUEST["idJornada"];
		$fechaClase="";
		$minutos="";
		$libroAlumnoDe="";
		$libroAlumnoHasta="";
		$libroProfeDe="";
		$libroProfeHasta="";
		$comentarios="";
		$clase = "Clase ";
		
}
?>
					<br />
                    <p align="justify">
                    En esta bitácora, usted deberá reportar aspectos relativos a las reuniones de trabajo realizada con los docentes.<br /><br />
                    En la casilla "Fecha " indique la fecha en que se realizó la reunión.
                    En la casilla "Minutos" indique la duración de la reunión en minutos.
                    Luego, seleccione el o los niveles que corresponden a los profesores con que trabajó en dicha reunión.
                    Puede completar tantas bitácoras como reuniones haya realizado en la semana.
                    </p>
					
					<div id="sinDiv"></div>

                	<table width="88%" border="0" align="center" class="tablesorter">
                    <tr >
                      <th width="25%">Reuniones con profesores</th>
                      <th width="20%">Fecha </th>
                      <th>Minutos</th>                 
                      <th>Nivel</th>
					</tr>
                    <tr>
                      <td valign="top">Reuniones con profesores</td><input name="clase" type="hidden" class="campos" value = "<?php echo $clase;?>"/>
                      <td valign="top"><input name="fechaClase" type="text" id="datepicker" size="12" class="campos" value = "<?php echo $fechaClase;?>"/><?php echo $fechaClase;?></td>
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
                                                            <td><label><input type="checkbox" name="niveles[]" value="1"  class="campos"/>1° Básico</label></td>
                                                            <td><label><input type="checkbox" name="niveles[]" value="2"  class="campos"/>2° Básico</label></td>
                                                            <td><label><input type="checkbox" name="niveles[]" value="3"  class="campos"/>3° Básico</label></td>
                        								</tr>
                                                     </table>
                       </td>
                      </tr>
                      <tr><th colspan="4">Descripción de los temas tratados</th></tr>
                    <tr >
                      
                      <td colspan="4"><textarea name="comentarios" id="comentarios" cols="68" rows="8" class="campos"><?php echo $comentarios;?></textarea></td>
                      </tr>
                      <tr>
                      <td colspan="4">
					  <input type="hidden" id="tipoBitacora" name="tipoBitacora" value="utp1" class="campos">
						<?php boton("Enviar","guardaBitacoraUTP1()"); ?>
                      </td>
                      </tr>
                  </table>
