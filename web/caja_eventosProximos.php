<?php
$datosEventos = getEventosProximosCurso(1);
?>
<br />
<div class="titulo_div">Eventos pr�ximos</div>

<div class="info_div">

<script language="javascript" type="text/javascript">
//CALENDARIO
//Iv�n Nieto P�rez
//Este script y otros muchos pueden
//descarse on-line de forma gratuita
//en El C�digo: www.elcodigo.com
function obtiene_fecha()
   {
   var fecha_actual = new Date()

   dia = fecha_actual.getDate()
   mes = fecha_actual.getMonth() + 1
   anio = fecha_actual.getYear()

   if (anio < 100)
      anio = '19' + anio
   else if ( ( anio > 100 ) && ( anio < 999 ) ) {
      var cadena_anio = new String(anio)
      anio = '20' + cadena_anio.substring(1,3)
   }      

   if (mes < 10)
      mes = '0' + mes

   if (dia < 10)
      dia = '0' + dia

   return (dia + "/" + mes + "/" + anio)
   }
   
   function MostrarFecha()
   {
   var nombres_dias = new Array("Domingo", "Lunes", "Martes", "Mi�rcoles", "Jueves", "Viernes", "S�bado")
   var nombres_meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre")

   var fecha_actual = new Date()

   dia_mes = fecha_actual.getDate()		//dia del mes
   dia_semana = fecha_actual.getDay()		//dia de la semana
   mes = fecha_actual.getMonth() + 1
   anio = fecha_actual.getFullYear()

   //escribe en pagina
   return (nombres_meses[mes - 1])
   }

function calendario()
   	{
	var x, y, fila, valor
   	var fecha_actual = new Date()
   	var dia_mes = fecha_actual.getDate()		//dia del mes
   	var mes = fecha_actual.getMonth() + 1		//mes del a�o
   	var anio = fecha_actual.getYear()		//a�o
   	var dia_semana = fecha_actual.getDay() - 1	//dia de la semana (-1 para domingo, 0 para lunes, etc.)

	//array de dias que tiene cada mes
	dias_por_mes = new Array(12)
	dias_por_mes[0] = 31
	dias_por_mes[1] = 28
	dias_por_mes[2] = 31
	dias_por_mes[3] = 30
	dias_por_mes[4] = 31
	dias_por_mes[5] = 30
	dias_por_mes[6] = 31
	dias_por_mes[7] = 31
	dias_por_mes[8] = 30
	dias_por_mes[9] = 31
	dias_por_mes[10] = 30
	dias_por_mes[11] = 31

	//corrige dia de la semana
	if(dia_semana == -1) 
		dia_semana = 6

	//corrige dias de febrero si a�o bisiesto
	if((anio % 4) == 0) 
		dias_por_mes[1]++

	//crea matriz de datos
	matriz = new Array(6)
	for (fila = 0; fila < 6; fila++) 
		matriz[fila] = new Array(7)

	//obtiene posici�n d�a 1
	y = dia_semana + 1
	for (x = dia_mes; x > 0; x--) {
		y--	
		if (y < 0) 
			y = 6
	}
		
	//guarda valores en variable matriz
	valor = 1
	for (fila = 0; fila < 6; fila++) {
		for (x = 0; x < 7; x++) {
			if ((fila == 0) && (x < y)) {				//valores vac�os primera fila
				matriz[fila][x] = ""
			} else if (valor > dias_por_mes[mes - 1]) {		//valores vac�os �ltima l�nea
				matriz[fila][x] = ""
			} else if (valor == dia_mes) {				//valor d�a actual
				matriz[fila][x] = "<b><font color='red'>" + valor + "</font></b>"
				valor++
			} else {
				matriz[fila][x] = valor				//valores ocupados
				valor++
			}
		}
	}

	//impresion del calendario
	document.write("<div align='center'><center>")
	document.write("")
	document.write("<table width='150' border='0' cellpadding='2' cellspacing='2' bgcolor='#CEFFCE'>")
	document.write("  <tr>")
	
	document.write("   <td colspan='7' bgcolor='#CEFFCE'><div align='center' class='right style6'><strong>" + MostrarFecha() + "</strong></div></td>")
	document.write("  </tr>")
	document.write("  <tr>")												//crea fila de nombres de d�as
	document.write("    <td width='15%'><div align='center' class='style7'>L</div></td>")
	document.write("    <td width='17%'><div align='center' class='style7'>M</div></td>")
	document.write("    <td width='16%'><div align='center' class='style7'>M</div></td>")
	document.write("    <td width='13%'><div align='center' class='style7'>J</div></td>")
	document.write("    <td width='13%'><div align='center' class='style7'>V</div></td>")
	document.write("    <td width='13%'><div align='center' class='style7'>S</div></td>")
	document.write("    <td width='13%'><div align='center' class='style7'>D</div></td>")
	document.write("  </tr>")

	for(fila = 0; fila < 6; fila++) {
		if ((matriz[fila][0] == "") && (matriz[fila][6] == "")) 		//no muestra ultima fila vac�a
			break
		document.write("  <tr>")											//crea fila de tabla calendario
		document.write("    <td width='14%' align='center'><strong>" + matriz[fila][0] + "</strong><p> </p></td>")
		document.write("    <td width='14%' align='center'><strong>" + matriz[fila][1] + "</strong><p> </p></td>")
		document.write("    <td width='14%' align='center'><strong>" + matriz[fila][2] + "</strong><p> </p></td>")
		document.write("    <td width='14%' align='center'><strong>" + matriz[fila][3] + "</strong><p> </p></td>")
		document.write("    <td width='14%' align='center'><strong>" + matriz[fila][4] + "</strong><p> </p></td>")
		document.write("    <td width='15%' align='center' bgcolor='#FFB6B6'><strong>" + matriz[fila][5] + "</strong><p> </p></td>")
		document.write("    <td width='15%' align='center' bgcolor='#FFB6B6'><strong>" + matriz[fila][6] + "</strong><p> </p></td>")
		document.write("  </tr>")
	}

	document.write("</table>")
	document.write("</center></div>")
}

</script>

<div align="center" class="style3">
<!-- Para visualizar el calendario -->
<script language="javascript" type="text/javascript">
<!--
calendario()
//-->
</script>
          
</div>


    <ul>
	<?php 
		foreach ($datosEventos as $i => $value) { 
    		if ($value["nombreEvento"] == "No existen Eventos Proximos."){ ?>
    			<li><?php 	echo $value["nombreEvento"];?></li>
    <?php		}else{
    
    ?>
    			<li>
                	<?php echo $value["nombreEvento"];?>: <?php echo cambiaf_a_normal($value["fechaEvento"]);?>
				</li>
    <?php 
			} 
		}
	?>
    </ul>
</div>      
