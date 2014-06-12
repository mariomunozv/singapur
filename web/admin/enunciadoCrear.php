<script language="javascript">
function enunciadoListado(){
	if(val_obligatorio("txtCantidad") == false){ return; }
	var division = document.getElementById("preguntas");
    var a = $(".campos").fieldSerialize();
	AJAXPOST("enunciadosDinamicos.php",a,division);
}

</script>

<body>
<div id="cantidad">
<table class="tablesorter">
<tr>
<th colspan="3">Creador de Enunciados</th>
</tr>
<tr>
<td>Indique la cantidad de enunciados que desea crear: </td>
<td><input type="text" name="txtCantidad" id="txtCantidad" class="campos"></td>
<td><input type="button" onClick="javascript:enunciadoListado();" value="Listar" ></td>
</tr>
</table>

</div>



<div id="preguntas"></div>

</body>
</html>
