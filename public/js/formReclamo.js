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
function limpiarCampos(){
	$("body input[type='text']").val('');
	$("#cboProPNR").empty();
	$("#cboDisPNR").empty();
	$("#cboProPJR").empty();
	$("#cboDisPJR").empty();	
	$("body select").val(-1);
}
function buscarPersonaNatural(){
	limpiarCampos();
	var $el = $("<div>");
	$el.url = urlBase + 'pernatural/busca/';
	
	$el.on('noseEncontro',function(){
		alert('el documento ingresado no se encuentra registrado');
	});


	$el.llenarCampos = function(dataE){
		var nombreCompleto = dataE.APE_PAT + ' ' + dataE.APE_MAT + ' ' + dataE.NOMBRE;
		var telefoMail =   dataE.TEL_FIJO + ' / ' + dataE.NUM_CELU + ' / ' + dataE.EMAIL;
		//var 
		$("#txtNatuNombre").val(dataE.NOMBRE);
		$("#txtNatuPaterno").val(dataE.APE_PAT);
		$("#txtNatuMaterno").val(dataE.APE_MAT);
		$("#txtNatuEmail").val(dataE.EMAIL);
		$("#txtNatuFijo").val(dataE.TEL_FIJO);
		$("#txtNatuMovil").val(dataE.NUM_CELU);
		$("#txtNatuReal").val(dataE.DOMICILIO);
		$("#txtNomInstDenunciada").val(nombreCompleto);
		$("#txtTxtDomiInstDenunciada").val(dataE.DOMICILIO);
		$("#txtTelefonoEmail").val(telefoMail);
		//$("#cboIdxTipoDocuIdentidad").val(IDX_TIPDOC);
		

		$("#cboDepPNR").val(dataE.COD_DEPA_CONTINENTE);
		$("#cboDepPNR").trigger('change');
		$("#txtRucDNICE").val(dataE.IDX_NUM_DOCU);

		$('#cboDepPNR').on('comboProvCargado',function(){
			$("#cboProPNR").val(dataE.COD_PROV_PAIS);
			$("#cboProPNR").trigger('change');
		});

		$('#cboProPNR').on('comboDistCargado',function(){
			$("#cboDisPNR").val(dataE.COD_DIST_CIUDAD);
			//$("#cboDisPNR").trigger('change');
		});		


		//$("#cboDisPNR").val(dataE.COD_DIST_CIUDAD);

		$("#cboIdxTipoDocuIdentidad").val(IDX_TIPDOC);
	}
	$el.buscarxDNI = function(){
		var valor = $("#txtCodNumeDocumento").val();
		if(valor.length == 0){
			alert('por favor llene el campo de documento');
			$("#txtCodNumeDocumento").focus();
			return false;
		}
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
	limpiarCampos();
	var $el = $("<div>");
	$el.url = urlBase + 'perjuridica/busca/';
	
	$el.on('noseEncontro',function(){
		alert('el documento ingresado no se encuentra registrado');
	});


	$el.llenarCampos = function(dataE){
		//console.log('datos',dataE);
		
		var telefoMail =   dataE.TEL_FIJO + ' / ' + dataE.EMAIL;

		$("#txtJuriNombre").val(dataE.RAZ_SOCIAL);
		$("#txtJuriEmail").val(dataE.EMAIL);
		$("#txtJuriTelefono").val(dataE.TEL_FIJO);
		$("#txtJuriReal").val(dataE.DOMICILIO);

		$("#txtNomInstDenunciada").val(dataE.RAZ_SOCIAL);
		$("#txtTxtDomiInstDenunciada").val(dataE.DOMICILIO);
		$("#txtTelefonoEmail").val(telefoMail);
		$("#txtRucDNICE").val(dataE.IDX_NUM_DOCU);

		$("#cboDepPJR").val(dataE.COD_DEPA_CONTINENTE);
		$("#cboDepPJR").trigger('change');

		$('#cboDepPJR').on('comboProvCargado',function(){
			$('#cboProPJR').val(dataE.COD_PROV_PAIS);
			$('#cboProPJR').trigger('change');
		});

		$('#cboProPJR').on('comboDistCargado',function(){
			$("#cboDisPJR").val(dataE.COD_DIST_CIUDAD);
		});
	}
	$el.buscarxDoc = function(){
		var valor = $("#txtJuriRuc").val();
		if(valor.length == 0){
			alert('por favor ingrese el RUC');
			$("#txtJuriRuc").focus();
			return false;
		}

		$el.url = $el.url + $("#txtJuriRuc").val();
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


$(document).on('ready',function(){
	$("#buscarNatural").on('click',function(){
		var buscar = new buscarPersonaNatural();
		buscar.buscarxDNI();
	});
	$("#buscarJuridica").on('click',function(){
		var buscar = new buscarPersonaJuridica();
		buscar.buscarxDoc();
	});	

	$('#cboDepPNR').on('change',function(){
		var id = $(this).val();
		var url = urlBase + 'ubigeos/prov/' + id;
		if(Number(id) > 0){
			$("#cboProPNR").empty();
			$("#cboDisPNR").empty();			
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
			$("#cboDisPNR").empty();			
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
		$("#cboProPJR").empty();
		$("#cboDisPJR").empty();			
			var datos = getDataSelect(url,'#cboProPJR','Seleccione Distrito','COD_PROV_PAIS','DES_PROV_PAIS');
			datos.on('dataLista',function(){
				$('#cboDepPJR').trigger('comboProvCargado');
			});			
			datos.ejecutar();
		}
	});

	$('#cboProPJR').on('change',function(){
		var id = $(this).val();
		var url = urlBase + 'ubigeos/dis/' + id;
		if(Number(id) > 0){
			$("#cboDisPJR").empty();
			var datos = getDataSelect(url,'#cboDisPJR','Seleccione Distrito','COD_DIST_CIUDAD','DES_DIST_CIUDAD');
			datos.on('dataLista',function(){
				$('#cboProPJR').trigger('comboDistCargado');
			});
			datos.ejecutar();
		}
	});
});