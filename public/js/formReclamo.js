var dominio = document.domain;
var urlBase = "http://"+ dominio +"/sndLibroReclamaciones/public/";

function getDataSelect(url,classControl,textoSeleccion,campoValor, campoTexto){
	var request = $.ajax({
	  url: url,
	  method: "GET",
	  dataType: "json"
	});
	 
	request.done(function( data ) {
	  var option = $("<option>");
		option.val(-1);
	    option.append(textoSeleccion);
	    $(classControl).append(option);	  
	  data.forEach(function(obj,i){
	    option = $("<option>");
	    option.val(obj[campoValor]);
	    option.append(obj[campoTexto]);
	    $(classControl).append(option);
	  });
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  alert( "Request failed: " + textStatus );
	});      
} 
$(document).on('ready',function(){
	$('#cboDepPNR').on('change',function(){
		var id = $(this).val();
		var url = urlBase + 'ubigeos/prov/' + id;
		if(Number(id) > 0){
			getDataSelect(url,'#cboProPNR','Seleccione Provincia','COD_PROV_PAIS','DES_PROV_PAIS');
		}
	});

	$('#cboProPNR').on('change',function(){
		var id = $(this).val();
		var url = urlBase + 'ubigeos/dis/' + id;
		if(Number(id) > 0){
			getDataSelect(url,'#cboDisPNR','Seleccione Distrito','COD_DIST_CIUDAD','DES_DIST_CIUDAD');
		}
	});
});