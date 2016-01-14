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
function limpiarCampos(buscar,buscarSelect){
	$("body input[type='text']").not(buscar).val('');
	$("#cboProPNR").empty();
	$("#cboDisPNR").empty();
	$("#cboProPJR").empty();
	$("#cboDisPJR").empty();
	if(buscarSelect){
		$("body select").not(buscarSelect).val(-1);
	}else{
		$("body select").val(-1);		
	}
	$('·cboIdxTipoDocuIdentidad').val(1);	
}
function actualizarCamposReclamo(tipoPersona){
	var nombreCompleto,telefoMail,domicilio;
	if(tipoPersona == 'N'){		
		nombreCompleto = $("#txtNatuNombre").val() + ' ' + $("#txtNatuPaterno").val() + ' ' + $("#txtNatuMaterno").val();
		telefoMail = $("#txtNatuFijo").val() + ' / ' + $("#txtNatuEmail").val() + ' / ' + $("#txtNatuMovil").val();
		domicilio = $("#txtNatuReal").val();
		numDoc = $("#txtCodNumeDocumento").val();
	}else if(tipoPersona == 'J'){
		nombreCompleto = $("#txtJuriNombre").val();
		telefoMail = $("#txtJuriTelefono").val() + ' / ' + $('#txtJuriEmail').val();
		domicilio = $("#txtJuriReal").val();		
		numDoc = $("#txtJuriRuc").val();
	}
	$("#txtRucDNICE").val(numDoc);
	$("#txtNomInstDenunciada").val(nombreCompleto);
	$("#txtTelefonoEmail").val(telefoMail);
	$("#txtTxtDomiInstDenunciada").val(domicilio);	 
}
function buscarPersonaNatural(){
	limpiarCampos('#txtCodNumeDocumento','#cboIdxTipoDocuIdentidad');
	var $el = $("<div>");
	$el.url = urlBase + 'pernatural/busca/';
	
	$el.on('noseEncontro',function(){
		alert('el documento ingresado no se encuentra registrado');
		$('#txtNatuNombre').focus();
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

		$("#cboIdxTipoDocuIdentidad").val(dataE.IDX_TIPDOC);
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
	limpiarCampos('#txtJuriRuc');
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
	$("#formulario").on('submit',function(event){
		event.preventDefault();
	});


	$("#siguiente").on('click',function(){
		var isNatural = $("#collapseNatural").attr('aria-expanded');
		var isJuridica = $("#collapseJuridica").attr('aria-expanded');
		if(isNatural == "true"){
			actualizarCamposReclamo('N');
		}else if(isJuridica == "true"){
			actualizarCamposReclamo('J');
		}		
	});

	$('#finalizar').on('click',function(event){
		/*
			$("#formulario").validate({
			rules:{
				"IDX_NUM_DOCU" : {
					required: true,
					minlength: 8
				}
			}
		});*/
		var flag = 0;

		flag = validar();

			if(flag == 0){
			$('#formulario').trigger('submit');
			var url = $("form").attr('action');
			var request = $.ajax({
			  url: url,
			  data: $("form").serialize(),
			  method: "POST",
			  dataType: "json"
			});
			 
			request.done(function( data ) {
				window.close();
				alert(data.mensaje);
				
				
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  console.log( "Request failed: " + textStatus );
			});

		}

	});

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
		var id2 = $('#cboDepPNR').val();
		var url = urlBase + 'ubigeos/dis/' + id +'/' + id2;
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
		var id2 = $('#cboDepPJR').val();
		var url = urlBase + 'ubigeos/dis/' + id + '/' + id2;
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

function validar(){
    var valPerNatural = collapseNatural.getAttribute('aria-expanded');
    var valPerJuridica = collapseJuridica.getAttribute('aria-expanded');
    var flag = 0;
    if(valPerNatural == "true")
    {
        flag = validaPerNat();
    } else if(valPerJuridica == "true")
    {
        flag = validaPerJur();
    }else{
        alert("Seleccionar el tipo de persona.");
        flag = 1;
    } 
    return flag;   
}

function validaPerNat(){
    var valTipo = cboIdxTipoDocuIdentidad.value == "-1" ? 0: 1;
    var valNumDoc = Number(txtCodNumeDocumento.value.length) == 0 ? 0 : 1;
    var valNombre = Number(txtNatuNombre.value.length) == 0 ? 0 : 1;;
    var valApPaterno = Number(txtNatuPaterno.value.length) == 0 ? 0 : 1;;
    var valApMaterno = Number(txtNatuMaterno.value.length) == 0 ? 0 : 1;;
    var valEmail = Number(txtNatuEmail.value.length) == 0 ? 0 : 1;;
    var valFijo = Number(txtNatuFijo.value.length) == 0 ? 0 : 1;;
    var valCelu = Number(txtNatuMovil.value.length) == 0 ? 0 : 1;;
    var valUbigeo = Number(cboDisPNR.value) <= 0 ? 0: 1;
    var domicilio = Number(txtNatuReal.value.length) == 0 ? 0 : 1;

    var Mensaje = "Los siguientes campos deben ser llenados antes: \n "
    var flag = 0;

    if(valTipo == 0){ Mensaje = Mensaje + "Tipo de doc \n"; flag = 1;}
    if(valNumDoc == 0) { Mensaje = Mensaje + "Num. de documento\n"; flag = 1;}
    if(valNombre == 0) { Mensaje = Mensaje + "Nombre\n"; flag = 1;}
    if(valApPaterno == 0) { Mensaje = Mensaje + "Apellido Paterno\n"; flag = 1;}
    if(valApMaterno == 0) { Mensaje = Mensaje + "Apellido Materno\n"; flag = 1;}
    if(valEmail == 0) { Mensaje = Mensaje + "Email\n"; flag = 1;}
    if(valFijo == 0) { Mensaje = Mensaje + "Telefono fijo\n"; flag = 1;}
    if(valCelu == 0) { Mensaje = Mensaje + "Celular\n"; flag = 1;}
    if(valUbigeo == 0) { Mensaje = Mensaje + "Ubigeo\n"; flag = 1;}
    if(domicilio == 0) { Mensaje = Mensaje + "Direccion \n"; flag = 1;}

    var MenFormRecl = ["", ""];
    MenFormRecl = validaFormReclamo();
    Mensaje = Mensaje + " " + MenFormRecl[0];
    flag = MenFormRecl[1];
    if(flag == 1){alert(Mensaje);}
    return flag;
}

function validaPerJur(){
    //var valTipo = cboIdxTipoDocuIdentidad.value == "-1" ? 0: 1;
    var valJurRUC = Number(txtJuriRuc.value.length) == 0 ? 0 : 1;
    var valJurNombre= Number(txtJuriNombre.value.length) == 0 ? 0 : 1;
    var valJurEmail = Number(txtJuriEmail.value.length) == 0 ? 0 : 1;
    var valJurTel = Number(txtJuriTelefono.value.length) == 0 ? 0 : 1;
    var valJurUbigeo = Number(cboDisPJR.value) <= 0 ? 0: 1;
    var valJurdomici = Number(txtJuriReal.value.length) == 0 ? 0 : 1;

    var Mensaje = "Los siguientes campos deben ser llenados antes: \n "
    var flag = 0;

    if(valJurRUC == 0){ Mensaje = Mensaje + "Numero de Ruc \n"; flag = 1;}
    if(valJurNombre == 0) { Mensaje = Mensaje + "Razon Social\n"; flag = 1;}
    if(valJurEmail == 0) { Mensaje = Mensaje + "Email\n"; flag = 1;}
    if(valJurTel == 0) { Mensaje = Mensaje + "Telefono\n"; flag = 1;}
    if(valJurUbigeo == 0) { Mensaje = Mensaje + "Ubigeo\n"; flag = 1;}
    if(valJurdomici == 0) { Mensaje = Mensaje + "Direccion \n"; flag = 1;}

    var MenFormRecl = ["", ""];
    MenFormRecl = validaFormReclamo();
    Mensaje = Mensaje + " " + MenFormRecl[0];
    flag = MenFormRecl[1];
    if(flag == 1){alert(Mensaje);}
    return flag;
}

function validaFormReclamo()
{
     var  Mensaje = ""
     var valDesHechos = Number(txtTxtDescHechos.value.length) == 0 ? 0 : 1;
     var flag = 0;
     if(valDesHechos == 0){ Mensaje = Mensaje + "Identificacion de atencion brindada \n"; flag = 1;}
     var array = ["",""];
     array[0]=Mensaje;
     array[1]=flag;
     //return Mensaje,flag;
     return array;
}