<?php 
session_start();
include "inc/conecta.php";
include "inc/_bitacora.php";
include "inc/_usuario.php";
include "inc/_profesor.php";
include "inc/_seccionBitacora.php";
include "sesion/sesion.php";
Conectarse_seg();
$idUsuario = $_REQUEST["idUsuario"];
$idCurso = $_REQUEST["idCurso"];
$bitacoras = getBitacorasCompletadasUsuario($idUsuario,$idCurso);
$partes = getPartesLibro($idCurso);
//$cap = 1; //Para Línea 49 Comentada
$capCompletos = array();
foreach($partes as $parte)
{
	$capitulos = getSeccionPadreBitacora($parte['parteLibro']);
	foreach($capitulos as $capitulo){
		$listaCapitulos[] = $capitulo["idSeccionBitacora"];
	}

}
foreach($listaCapitulos as $lCap) //Hasta aquí se tienen todos los capitulos del libro
{
	$seccinoes = getSeccionBitacoraCapitulo($lCap);
	$bandera = false;
	$libera = 0;
	foreach($seccinoes as $seccion){ //Aquí se separa cada capítulo por sus secciones.
		foreach($bitacoras as $bitacora){
 			if($seccion["idSeccionBitacora"] == $bitacora["idSeccionBitacora"]){
				unset($seccinoes[$libera]);
				break;
			} //fin if
		} //fin foreach($bitacoras as $bitacora)
		$libera++;
	} //fin foreach($seccinoes as $seccion)
	if(count($seccinoes)==0){
		$capCompletos[] = $lCap;
	}
	/* //Estas líneas muestran en pantalla que capitulos están completos
	echo "Cap: ".$cap." = ";
	echo $bandera."<br>";
	$cap++;
	*/
	
}

if(count($capCompletos)>0){?>
	<table width="10%" border="0" align="center" class="tablesorter">
	<tr>
    	<th colspan="7" align="center">Capítulos implementados</th>
    </tr>
	<tr>
	    <th align="left">Usuario que ingresó Bitácora</th>
	    <th>Capítulo</th>
        <th align="left">Horas de implementación</th>
        <th align="left">Fecha inicio</th>
        <th align="left">Fecha término</th>
        <th>Estado</th>
    </tr>
    <?php foreach($capCompletos as $capCompletos){?>
    
     <tr>
       	<?php $nombres = getUsuariosIngresanCapitulo($capCompletos,$idCurso,$idUsuario); ?>
		<td align="center" valign="top">
			<?php 
			$slash = 0;
			foreach($nombres as $nombre){
				if($slash > 0){
					echo " / ";
				}
				echo $nombre["nombreProfesor"];
				$slash++;
			}?>
        </td>
		<td align="center" valign="top">
        	<?php echo getNombreCapituloCompletoBitacora($capCompletos);?>
        </td>
		<td align="center" valign="top">
        	<?php echo getHorasImplementadas($capCompletos,$idUsuario,$idCurso); ?>
        </td>
		<td align="center" valign="top">
        	<?php $bitacorasTodas = getFechasCapitulo($capCompletos,$idUsuario,$idCurso);
			echo $bitacorasTodas["fechaInicio"];?>
        </td>
		<td align="center" valign="top">
        <?php  echo $bitacorasTodas["fechaTermino"];?>
        </td>        
		<td align="center" valign="top">Declarada</td> 
	<?php }?>
    </tr>
</table>
<?php 
}else{
	echo "Aun no tiene capítulos completos";
}