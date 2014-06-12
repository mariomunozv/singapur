<?php
ini_set("display_errors","on");
include("../inc/_alternativa.php");
require("inc/config.php");

$tipoAlternativa = $_POST['tipoAlternativa'];
$enunciados = $_POST['seleccionados'];
$cuentaErrores = 0;


function crearEscalaTipoProblemaPorcentaje($idEnunciado)
{
	if (crearAlternativa($idEnunciado,198) > 0 && crearAlternativa($idEnunciado,199) > 0 && crearAlternativa($idEnunciado,200) > 0 )
	{
		return true;
	}else{
		return false;
	}
}



function crearEscalaTipoProblemaSegunEnunciado($idEnunciado)
{
	if (crearAlternativa($idEnunciado,194) > 0 && crearAlternativa($idEnunciado,195) > 0 )
	{
		return true;
	}else{
		return false;
	}
}


function crearEscalaTipoProblema($idEnunciado)
{
	if (crearAlternativa($idEnunciado,191) > 0 && crearAlternativa($idEnunciado,192) > 0 && crearAlternativa($idEnunciado,193) > 0 )
	{
		return true;
	}else{
		return false;
	}
}


function crearEscalaCorresponde($idEnunciado)
{
	if (crearAlternativa($idEnunciado,189) > 0 && crearAlternativa($idEnunciado,190) > 0 )
	{
		return true;
	}else{
		return false;
	}
}





function crearEscalade1a4($idEnunciado)
{
	if (crearAlternativa($idEnunciado,4) > 0 && crearAlternativa($idEnunciado,5) > 0 && crearAlternativa($idEnunciado,6) > 0 && crearAlternativa($idEnunciado,7) > 0)
	{
		return true;
	}else{
		return false;
	}
}

function escala1a5($idEnunciado)
{
	if (crearAlternativa($idEnunciado,3) > 0 && crearAlternativa($idEnunciado,4) > 0 && crearAlternativa($idEnunciado,5) > 0 && crearAlternativa($idEnunciado,6) > 0)
	{
		return true;
	}else{
		return false;
	}
}

function escalacasiTDiasANunca($idEnunciado)
{
	if (crearAlternativa($idEnunciado,7) > 0 && crearAlternativa($idEnunciado,8) > 0 && crearAlternativa($idEnunciado,9) > 0 && crearAlternativa($idEnunciado,10) > 0)
	{
		return true;
	}else{
		return false;
	}
}

function crearEscalade1a4_2($idEnunciado)
{
	if (crearAlternativa($idEnunciado,36) > 0 && crearAlternativa($idEnunciado,37) > 0 && crearAlternativa($idEnunciado,38) > 0 && crearAlternativa($idEnunciado,39) > 0)
	{
		return true;
	}else{
		return false;
	}
}

function crearEscalade1aNASINO($idEnunciado)
{
	if (crearAlternativa($idEnunciado,36) > 0 && crearAlternativa($idEnunciado,1) > 0 && crearAlternativa($idEnunciado,2) > 0)
	{
		return true;
	}else{
		return false;
	}
}

function SiNo($idEnunciado)
{
	if (crearAlternativa($idEnunciado,8) > 0 && crearAlternativa($idEnunciado,9) > 0)
	{
		return true;
	}else{
		return false;
	}
}


function crearEscaladeSemanalaNunca($idEnunciado)
{
	if (crearAlternativa($idEnunciado,62) > 0 && crearAlternativa($idEnunciado,63) > 0 && crearAlternativa($idEnunciado,64) > 0 && crearAlternativa($idEnunciado,65) > 0 && crearAlternativa($idEnunciado,66) > 0 && crearAlternativa($idEnunciado,67) > 0 )
	{
		return true;
	}else{
		return false;
	}
}

function crearEscaladeDiarioaNunca($idEnunciado)
{
	if (crearAlternativa($idEnunciado,61) > 0 && crearAlternativa($idEnunciado,62) > 0 && crearAlternativa($idEnunciado,63) > 0 && crearAlternativa($idEnunciado,64) > 0 && crearAlternativa($idEnunciado,65) > 0 && crearAlternativa($idEnunciado,66) > 0 && crearAlternativa($idEnunciado,67) > 0 )
	{
		return true;
	}else{
		return false;
	}
}

function deCase10($idEnunciado)
{
if (crearAlternativa($idEnunciado,11) > 0 && crearAlternativa($idEnunciado,12) > 0 && crearAlternativa($idEnunciado,13) > 0 && crearAlternativa($idEnunciado,14) > 0)
	{
		return true;
	}else{
		return false;
	}
}

function DirectorANoSeHace($idEnunciado)
{
if (crearAlternativa($idEnunciado,81) > 0 && crearAlternativa($idEnunciado,82) > 0 && crearAlternativa($idEnunciado,83) > 0 && crearAlternativa($idEnunciado,84) > 0 && crearAlternativa($idEnunciado,85) > 0)
	{
		return true;
	}else{
		return false;
	}
}


switch($tipoAlternativa)
{
	case 1:
		foreach($enunciados as $enunciado)
		{
			if(crearEscalade1a4($enunciado))
			{
				//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	case 2:
		echo "caso 2";
	break;
	
	case 3:
		foreach($enunciados as $enunciado)
		{
			if(crearEscalade1a4_2($enunciado))
			{
					//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	
	case 4:
		foreach($enunciados as $enunciado)
		{
			if(crearEscalade1aNASINO($enunciado))
			{
					//nada
			}
			else
			{
					$cuentaErrores++;
			}
		}
	break;
	
	
	case 5:
		foreach($enunciados as $enunciado)
		{
			if(crearEscaladeSemanalaNunca($enunciado))
			{
					//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	
	
	case 6:
		foreach($enunciados as $enunciado)
		{
			if(SiNo($enunciado))
			{
				//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	
	case 7:
		foreach($enunciados as $enunciado)
		{
			if(crearEscaladeDiarioaNunca($enunciado))
			{
				//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	case 8:
		foreach($enunciados as $enunciado)
		{
			if(escala1a5($enunciado))
			{
				//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	case 9:
		foreach($enunciados as $enunciado)
		{
			if(escalacasiTDiasANunca($enunciado))
			{
				//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	case 10:
		foreach($enunciados as $enunciado)
		{
			if(deCase10($enunciado))
			{
				//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	case 11:
		foreach($enunciados as $enunciado)
		{
			if(DirectorANoSeHace($enunciado))
			{
				//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	
	case 12:
		foreach($enunciados as $enunciado)
		{
			if(crearEscalaCorresponde($enunciado))
			{
				//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	case 13:
		foreach($enunciados as $enunciado)
		{
			if(crearEscalaTipoProblema($enunciado))
			{
				//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	
	case 14:
		foreach($enunciados as $enunciado)
		{
			if(crearEscalaTipoProblemaSegunEnunciado($enunciado))
			{
				//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	
	case 15:
		foreach($enunciados as $enunciado)
		{
			if(crearEscalaTipoProblemaPorcentaje($enunciado))
			{
				//nada
			}
			else
			{
				$cuentaErrores++;
			}
		}
	break;
	
	
	

	default:
		$cuentaErrores = 1;
	break;
}




if($cuentaErrores == 0)
{
	?>
		<script language="javascript">
		   listarEnunciadosCerrados();
		</script>
	<?php 
}
else
{
	echo "ERROR";
}

?>
