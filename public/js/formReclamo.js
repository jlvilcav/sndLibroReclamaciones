var dominio = document.domain;
var urlBase = "http://"+ dominio +"/reclamaciones/public/";

function getDataSelect(url,classControl,textoSeleccion,campoValor, campoTexto){
	var $el = $("<div>");
	$el.request = $.ajax({
	  url: url,
	  method: "GET",
	  dataType: "json"
	});
	
	$el.ejecutar = function(){
		$el.request.done(function( data ) {
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
		  $el.trigger("dataLista");
		});
		 
		$el.request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
	}

	return $el;      
}

function buscarPersonaNatural(){
	var $el = $("<div>");
	$el.url = urlBase + 'pernatural/busca/';
	
	$el.on('noseEncontro',function(){
		alert('el documento ingresado no esta en la bd');
	});


	$el.llenarCampos = function(dataE){
		var nombreCompleto = dataE.APE_PAT + ' ' + dataE.APE_MAT + ' ' + dataE.NOMBRE;
		var telefoMail =   dataE.TEL_FIJO + ' ' + dataE.NUM_CELU + ' ' + dataE.EMAIL
		//var 
		$("#txtNatuNombre").val(dataE.NOMBRE);
		$("#txtNatuPaterno").val(dataE.APE_PAT);
		$("#txtNatuMaterno").val(dataE.APE_MAT);
		$("#txtNomInstDenunciada").val(nombreCompleto);
		$("#txtNatuEmail").val(dataE.EMAIL);
		$("#txtNatuFijo").val(dataE.TEL_FIJO);
		$("#txtNatuMovil").val(dataE.NUM_CELU);
		$("#txtNatuReal").val(dataE.DOMICILIO);
		$("#txtRucDNICE").val(dataE.IDX_NUM_DOCU);
		$("#txtTxtDomiInstDenunciada").val(dataE.DOMICILIO);
		$("#txtTelefonoEmail").val(telefoMail);
		//$("#cboIdxTipoDocuIdentidad").val(IDX_TIPDOC);
		

		$("#cboDepPNR").val(dataE.COD_DEPA_CONTINENTE);
		$("#cboDepPNR").trigger('change');

		$('#cboDepPNR').on('comboProvCargado',function(){
			$("#cboProPNR").val(dataE.COD_PROV_PAIS);
			$("#cboProPNR").trigger('change');
		});

		$('#cboProPNR').on('comboDistCargado',function(){
			$("#cboDisPNR").val(dataE.COD_DIST_CIUDAD);
			//$("#cboDisPNR").trigger('change');
		});		


		$("#cboDisPNR").val(dataE.COD_DIST_CIUDAD);

		$("#cboIdxTipoDocuIdentidad").val(IDX_TIPDOC);
	}
	$el.buscarxDNI = function(){
		$el.url = $el.url + $("#txtCodNumeDocumento").val();
		var request = $.ajax({
		  url: $el.url,
		  method: "GET",
		  dataType: "json"
		});
		 
		request.done(function( data ) {
			if(data[0]){
				$el.llenarCampos(data[0]);
			}else{
				$el.trigger('noseEncontro');
			}
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  console.log( "Request failed: " + textStatus );
		});
	}
	return $el;
}
function buscarPersonaJuridica(){

}


$(document).on('ready',function(){
	$("#buscarNatural").on('click',function(){
		var buscar = new buscarPersonaNatural();
		buscar.buscarxDNI();
	});

	$('#cboDepPNR').on('change',function(){
		var id = $(this).val();
		var url = urlBase + 'ubigeos/prov/' + id;
		if(Number(id) > 0){
			var datos = getDataSelect(url,'#cboProPNR','Seleccione Provincia','COD_PROV_PAIS','DES_PROV_PAIS');
			datos.on('dataLista',function(){
				$('#cboDepPNR').trigger('comboProvCargado');
			});
			datos.ejecutar();
		}
	});
	$('#cboProPNR').on('change',function(){
		var id = $(this).val();
		var url = urlBase + 'ubigeos/dis/' + id;
		if(Number(id) > 0){
			var datos = getDataSelect(url,'#cboDisPNR','Seleccione Distrito','COD_DIST_CIUDAD','DES_DIST_CIUDAD');
			datos.on('dataLista',function(){
				$('#cboProPNR').trigger('comboDistCargado');
			});
			datos.ejecutar();			
		}
	});

	$('#cboDepPJR').on('change',function(){
		var id = $(this).val();
		var url = urlBase + 'ubigeos/prov/' + id;
		if(Number(id) > 0){
			getDataSelect(url,'#cboProPJR','Seleccione Distrito','COD_PROV_PAIS','DES_PROV_PAIS');
		}
	});

	$('#cboProPJR').on('change',function(){
		var id = $(this).val();
		var url = urlBase + 'ubigeos/dis/' + id;
		if(Number(id) > 0){
			getDataSelect(url,'#cboDisPJR','Seleccione Distrito','COD_DIST_CIUDAD','DES_DIST_CIUDAD');
		}
	});
});