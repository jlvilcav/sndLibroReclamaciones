function irDocumento(id){
    $.ajax({
        dataType:'html',
        type: 'POST',
        url: sunePath + 'index.php/licenciamiento/verdocumento',
        data : {
            p_IDX_DOCUMENTO_LICENCIAMIENTO : id
        },
        success: function(rData){
            $('#layout_wrapper').html(rData);
        }
    });
}
function irNuevoDocumento(){
    $.ajax({
        dataType:'html',
        url: sunePath + 'index.php/licenciamiento/nuevodocumento',
        success: function(rData){
            $('#layout_wrapper').html(rData);
        }
    });
}
function sideTemaSelected(id){
	$('#C_TMX_TEMA_DOCUMENTO').val(id);
	buscarDocumentosLic();
}
function buscarDocumentosLic(universidad, establecimiento, tipodocumento){
	if(universidad == undefined || universidad == null){
		universidad = 0;
	}
	if(establecimiento == undefined || establecimiento == null){
		establecimiento = 0;
	}
	
	if(!$("#tblBusquedaDoc").length){
		return;
	}
	var v_C_DES_NOMB_DOCUMENTO = $('#C_DES_NOMB_DOCUMENTO').val();
	var v_C_FEC_USUA_CREA_DESDE = '';
	var v_C_FEC_USUA_CREA_HASTA = '';

	if ($('#C_FEC_USUA_CREA_RANGO').val() != '') {
		v_C_FEC_USUA_CREA_DESDE = $('#C_FEC_USUA_CREA_RANGO').val().substring(0, 11);
		v_C_FEC_USUA_CREA_HASTA = $('#C_FEC_USUA_CREA_RANGO').val().substring(13, 24);
    }

	var v_C_IDX_TIPO_DOCUMENTO = $('#C_IDX_TIPO_DOCUMENTO').val();
	var v_C_TMX_TIPO_ADJUNTO = $('#C_TMX_TIPO_ADJUNTO').val();
	var v_C_DES_NUME_DOCUMENTO = $('#C_DES_NUME_DOCUMENTO').val();
	
    var v_C_ORIGEN = $('#C_ORIGEN').val();
    var v_C_DESTINO = $('#C_DESTINO').val();
    
    var v_C_IDX_DOCUMENTO = $('#C_IDX_DOCUMENTO').val();

    var v_C_TMX_TEMA_DOCUMENTO = $('#C_TMX_TEMA_DOCUMENTO').val();
    var v_C_BIT_TIPO_FLUJO = $('#C_BIT_TIPO_FLUJO').val();
    
    
    
    if(tipodocumento == undefined || tipodocumento == null){
		tipodocumento = v_C_IDX_TIPO_DOCUMENTO;
	}
    
    $.ajax({
        dataType:'html',
        type: 'POST',
        url: sunePath + 'index.php/licenciamiento/consultadoclicbuscar',
        data : {
        	p_C_DES_NOMB_DOCUMENTO : v_C_DES_NOMB_DOCUMENTO,
        	p_C_FEC_USUA_CREA_DESDE : v_C_FEC_USUA_CREA_DESDE,
            p_C_FEC_USUA_CREA_HASTA : v_C_FEC_USUA_CREA_HASTA,
            p_C_IDX_TIPO_DOCUMENTO : tipodocumento,
            p_C_TMX_TIPO_ADJUNTO : v_C_TMX_TIPO_ADJUNTO,
            p_C_DES_NUME_DOCUMENTO : v_C_DES_NUME_DOCUMENTO,
            p_C_ORIGEN : v_C_ORIGEN,
            p_C_DESTINO : v_C_DESTINO,
            p_C_IDX_DOCUMENTO : v_C_IDX_DOCUMENTO,
            p_C_TMX_TEMA_DOCUMENTO : v_C_TMX_TEMA_DOCUMENTO,
            p_C_BIT_TIPO_FLUJO : v_C_BIT_TIPO_FLUJO, 
            p_C_IDX_UNIVERSIDAD : universidad, 
            p_C_IDX_ESTABLECIMIENTO : establecimiento
        },
        beforeSend: function(){
            //$('#documentos-tbody-content').html('');
        },
        success: function(rData){
        	if(rData == ''){
        		$('#noResulDocs').modal('show');
        	}
        	
    		var table = $("#tblBusquedaDoc").DataTable();
            table.destroy();

            $('#documentos-tbody-content').html(rData);
            $("#tblBusquedaDoc").DataTable({
                responsive:true,
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false
            });
        	
        }
    });
}

function irConsultaDocumentosLic(tipoflujo){
	
	if($('#C_BIT_TIPO_FLUJO').val() != tipoflujo){
		$.ajax({
	        dataType:'html',
	        type:'POST',
	        data:{
	        	p_C_BIT_TIPO_FLUJO : tipoflujo
	        },
	        url: sunePath + 'index.php/licenciamiento/consultadoclic',
	        success: function(rData){
	            $('#layout_wrapper').html(rData);
	            $.AdminLTE.boxWidget.activate();
	        }
	    });
	}
}