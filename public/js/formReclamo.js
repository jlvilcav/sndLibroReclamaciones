var dominio = document.domain;
var urlBase = "http://"+ dominio +"/sndLibroReclamaciones/public/";

function getDataSelect(url,classControl, campoValor, campoTexto){
	var request = $.ajax({
	  url: url,
	  method: "GET",
	  dataType: "json"
	});
	 
	request.done(function( data ) {
	  data.forEach(function(obj,i){
	    var option = $("<option>");
	    console.log(obj);
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
			getDataSelect(url,'#cboProPNR','COD_PROV_PAIS','DES_PROV_PAIS');
		}
	});
});