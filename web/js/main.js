function AJAXPOST(Pagina, Variables,Obj, MsjLoad, FuncionListo, FuncionCarga, Conexion){
	if (MsjLoad == null || MsjLoad == false){MsjLoad= MsjTipico;}
	if (FuncionCarga == null){if (Obj == null){Obj= false;}else{Obj.innerHTML = MsjLoad;}}
	document.body.style.cursor = "wait";
	jQuery("a").css("cursor","wait");
	jQuery("#div_cargando").fadeIn("fast");
	var Conexion = crearXMLHttpRequest();
	Conexion.open("POST",Pagina, true);
	Conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	Conexion.send(Variables);
	
	Conexion.onreadystatechange = ProcesarCambioEstado;
		function ProcesarCambioEstado(){
			if (Conexion.readyState == 4){
				if(Obj != false){
					jQuery(Obj).fadeOut("fast",function(){jQuery(Obj).html(Conexion.responseText);});
					jQuery(Obj).fadeIn("normal",function(){
						if (FuncionListo != null && FuncionListo != false){
							x = FuncionListo;
							x(Conexion);
						}
					});
				}else{
					if (FuncionListo != null){
						x = FuncionListo;
						x(Conexion);
					}
				}
				jQuery("#div_cargando").fadeOut("fast");
				jQuery("a").css("cursor","pointer");
				document.body.style.cursor = "auto";
			}else{
				if (FuncionCarga == null){
					//if(Obj != false){Obj.innerHTML = MsjLoad;}
				}else{
					x = FuncionCarga;
					x(Conexion);
				}
			}
		}
	return Conexion;
}

function SoloEnviar(Pagina, Variables, Callback){
	document.body.style.cursor = "wait";
	jQuery("a").css("cursor","wait");
	jQuery("#div_cargando").fadeIn("fast");
	var Conexion = crearXMLHttpRequest();
	Conexion.open("POST",Pagina, true);
	Conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	Conexion.send(Variables);
	Conexion.onreadystatechange = function(){
		if(Conexion.readyState == 4){
			if(Callback != null){
				x = Callback;
				x(Conexion);
			}
			jQuery("#div_cargando").fadeOut("fast");
			jQuery("a").css("cursor","pointer");
			document.body.style.cursor = "auto";
		}
	}
}

function crearXMLHttpRequest(){
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else 
    if (window.XMLHttpRequest) 
      xmlHttp = new XMLHttpRequest();
  return xmlHttp;
}
//FIN FUNCUINES AJAX