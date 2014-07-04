<?php session_start();
include "../inc/conecta.php";
include "../inc/funciones.php";

$rbdColegio = $_REQUEST["rbdColegio"];
$idNivel = $_REQUEST["idNivel"];
$anoCursoColegio = $_REQUEST["anoCursoColegio"];
$letraCursoColegio = $_REQUEST["letraCursoColegio"];
?> 
 
<script language="javascript">
function Valida_Rut( Objeto ) 
{
	var tmpstr = "";
	var intlargo = Objeto.value
	if (intlargo.length> 0)
	{
		crut = Objeto.value
		largo = crut.length;
		if ( largo <2 )
		{
			alert('rut inválido')
			Objeto.focus()
			return false;
		}
		for ( i=0; i <crut.length ; i++ )
		if ( crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-' )
		{
			tmpstr = tmpstr + crut.charAt(i);
		}
		rut = tmpstr;
		crut=tmpstr;
		largo = crut.length;
	
		if ( largo> 2 )
			rut = crut.substring(0, largo - 1);
		else
			rut = crut.charAt(0);
	
		dv = crut.charAt(largo-1);
	
		if ( rut == null || dv == null )
		return 0;
	
		var dvr = '0';
		suma = 0;
		mul  = 2;
	
		for (i= rut.length-1 ; i>= 0; i--)
		{
			suma = suma + rut.charAt(i) * mul;
			if (mul == 7)
				mul = 2;
			else
				mul++;
		}
	
		res = suma % 11; 
		if (res==1)
			dvr = 'k';
		else if (res==0)
			dvr = '0';
		else
		{
			dvi = 11-res;
			dvr = dvi + "";
		}
	
		if ( dvr != dv.toLowerCase() )
		{
			alert('El Rut Ingreso es Invalido')
			$("#rutAlumno").addClass("alertar");
			Objeto.focus()
			return false;
		}
		//alert('El Rut Ingresado es Correcto!')
		return true;
	}
}


	$(function() {
		$( "#datepicker" ).datepicker();
		$('#datepicker').datepicker('option', {dateFormat: 'yy-mm-dd'});

	});



function cancelar(){
	if(confirm("Cancelar esta operación?")){ location.href="cursoDetalle.php?rbdColegio=<?php echo $rbdColegio;?>&idNivel=<?php echo $idNivel;?>&anoCursoColegio=<?php echo $anoCursoColegio;?>&letraCursoColegio=<?php echo $letraCursoColegio;?>"; }   
}

function valida_rut(rut){
	 if(val_obligatorio("rutAlumno") == false){ return; }
	if (Valida_Rut(document.form.rutAlumno)){
	save_alumno();
	}
	}

function upload(){ 
	

	 // CAMPOS
	
	 
	 
	
    if(confirm("¿Seguro de enviar este archivo?")){

 var division = document.getElementById("lugar_de_carga");
 var a = $(".campos").fieldSerialize();
 alert(a);
 AJAXPOST("alumnoGuarda.php",a+"modo=carga",division);
 document
 
 }
} 
</script>


<form name="form" action="cargaMasivaProfesores.php" method="POST" enctype="multipart/form-data">
<input type="hidden"  name="modo" id="modo" value="carga"  class="campos" /> 
<input type="hidden"  name="rbdColegio" id="rbdColegio" value="<?php echo $rbdColegio;?>"  class="campos" />       
<input type="hidden"  name="anoCursoColegio" id="anoCursoColegio" value="<?php echo $anoCursoColegio;?>"  class="campos" />   
<input type="hidden"  name="letraCursoColegio" id="letraCursoColegio" value="<?php echo $letraCursoColegio;?>"  class="campos" />     
<input name="userfile" type="file"> 
       
       <input type="submit" name="aa" />
       </form>
