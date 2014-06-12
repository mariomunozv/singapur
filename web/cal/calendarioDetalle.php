

		<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
		
	
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/vtip.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			setTimeout(function() {$('#mensaje').fadeOut('fast');}, 3000);
		});
		</script>
		<style>
		* {margin: 0;padding: 0;font-family:Helvetica, Arial, Tahoma, sans-serif;}
		
		body {text-align:center;margin:0;width:100%;height:100%;}
		p#vtip { display: none; position: absolute; padding: 5px; left: 5px; font-size: 0.75em; background-color: #666666; border: 1px solid #666666; -moz-border-radius: 5px; -webkit-border-radius: 5px; z-index: 9999;color:white }
		p#vtip #vtipArrow { position: absolute; top: -10px; left: 5px }
		.ok{border:1px dotted green;color:green;padding:10px}
		#agenda{margin:10px;}
		#agenda h1{text-align:left;margin:0;font-size:1.5em;color:#312c2b}
		#agenda h2{text-align:left;margin:0;font-size:1em;color:#969696}
		#agenda table.calendario {margin:10px 0 0 0;width:100%;border:1px dotted #ccc;font-size:0.95em}
		.calendario th {border:1px dotted #ccc;font-weight:bold;background:#666;color:white;padding:10px 5px;}
		.calendario td{padding:10px 5px;text-align:center;border:1px dotted #ccc;}
		.calendario td.desactivada {background:#dcdcdc;}
		.calendario td.activa {background:#ffffff;}
		.calendario td.evento {background:#312c2b;color:white}
		.calendario td.hoy{font-weight:bold}
		.calendario form{margin:5px 0 !important}
		.calendario input.text{border:1px dotted #ccc;background:white;width:200px !important}
		.calendario input.enviar{border:1px dotted #ccc;background:white;width:70px !important;background:#ccc;margin:0 0 0 10px;}
		.calendario td img{vertical-align:middle;float:right;border:0;width:16px;height:16px}
		.vtip{cursor:pointer;}
		.verde{font-size:125% !important;font-weight:bold;color:green;}
		.rojo{font-size:125% !important;font-weight:bold;color:red;}
		</style>

	<div id="agenda">
		
		<?php
			include("config.inc.php");
			function fecha ($valor)
			{
				$time = explode(" ",$valor);
				$fecha = explode("-",$time[0]);
				$fechex = "$fecha[2]/$fecha[1]/$fecha[0] $time[1]";
				return $fechex;
			}
			
			if (!@$_GET[fecha]) 
			{
				$mesactual=intval(date("m"));
				if ($mesactual<10) $elmes="0".$mesactual;
				else $elmes=$mesactual;
				$elanio=date("Y");
			} 
			else 
			{
				$cortefecha=explode("-",@$_GET[fecha]);
				$mesactual=intval($cortefecha[1]);
				if ($mesactual<10) $elmes="0".$mesactual;
				$elanio=$cortefecha[0];
			}
			$primeromes=date("N",mktime(0,0,0,$mesactual,1,$elanio));
			if (!@$_GET[mes]) $hoy=date("Y-m-d"); else $hoy="$_GET[ano]-$_GET[mes]-01";
			$dias=array("","31","28","31","30","31","30","31","31","30","31","30","31");
			$q1="select * from evento where month(fechaEvento)='$elmes' and year(fechaEvento)='$elanio'"."  and idCursoCapacitacion = ".$_SESSION["sesionIdCurso"];
			mysql_select_db($dbname);
			$r1=mysql_query($q1);
			if ($f1=mysql_fetch_array($r1))
			{
				$ides=array();
				$eventos=array();
				$titulos=array();
				$h=0;
				do
				{
					$ides[$h]="$f1[idEvento]";
					$eventos[$h]="$f1[fechaEvento]";
					$titulos[$h]="$f1[nombreEvento]";
					$h+=1;
				}
				while($f1=mysql_fetch_array($r1));
			}
			if (date("L")==true) $dias=array("","31","29","31","30","31","30","31","31","30","31","30","31");
			$meses=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$diasantes=$primeromes-1;
			$diasdespues=42;
			$tope=$dias[$mesactual]+$diasantes;
			if ($tope%7!=0) $totalfilas=intval(($tope/7)+1);
			else $totalfilas=intval(($tope/7));
			echo "<h2>Calendario de Eventos para: ".$meses[$mesactual]." de $elanio</h2>";
			echo @$mostrar;
			echo "<table class='calendario'><tr>";
			echo "<tr><th>L</th><th>M</th><th>M</th><th>J</th><th>V</th><th>S</th><th>D</th></tr>";
			$j=1;
			$filita=0;
			echo "<script>function mostrar(cual) {if (document.getElementById(cual).style.display=='block') {document.getElementById(cual).style.display='none';} else {document.getElementById(cual).style.display='block'} }</script>";
			function buscarevento($fecha,$eventos,$titulos)
			{
				$clave=array_search($fecha,$eventos,true);
				return $titulos[$clave];
			}
			for ($i=1;$i<=$diasdespues;$i++)
			{
				if ($filita<$totalfilas)
				{
				if ($i>=$primeromes && $i<=$tope) 
				{
					echo "<td";
					if ($j<10) $dd="0".$j;else $dd=$j;
					$compuesta=$elanio."-$elmes-$dd";
					if (count(@$eventos)>0 && in_array(@$compuesta,@$eventos,true)) {echo " class=' evento";@$noagregar=true;}
					else {echo " class='activa";@$noagregar=false;}
					if ($hoy==$compuesta) echo " hoy";
					if ($noagregar==false) echo "'>$j";
					else echo "'><span class='vtip' title='".buscarevento($compuesta,$eventos,$titulos)."'>$j</span>";
					echo "</td>";
					$j+=1;
				}
				else echo "<td class='desactivada'>&nbsp;</td>";
				if ($i==7 || $i==14 || $i==21 || $i==28 || $i==35 || $i==42) {echo "<tr>";$filita+=1;}
				}
			}
			echo "</table>";
			$mesanterior=date("Y-m-d",mktime(0,0,0,$mesactual-1,01,$elanio));
			$messiguiente=date("Y-m-d",mktime(0,0,0,$mesactual+1,01,$elanio));
			echo "<p style='font-size:13px;margin:20px;padding:20px'>&laquo; <a href='$_SERVER[PHP_SELF]?fecha=$mesanterior'>Mes Anterior</a> --- <a href='$_SERVER[PHP_SELF]?fecha=$messiguiente'>Mes Siguiente</a> &raquo;</p>";
			
		?>
	</div>
    
