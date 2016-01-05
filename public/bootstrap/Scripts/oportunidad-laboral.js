function renderTipoConvocatoria(idx){
    $.ajax({
        dataType:'html',
        type:'POST',
        data:{
            idx : idx
        },
        url: sunePath + 'index.php/oportunidad-laboral/tipoconvocatoria',
        success: function(rData){
            $('#layout_wrapper').html(rData);
            $.AdminLTE.boxWidget.activate();
        }
    });
}
function renderListaTipoConvocatoria(){
    $.ajax({
        dataType:'html',
        type:'POST',
        data:{},
        url: sunePath + 'index.php/oportunidad-laboral/listatipoconvocatoria',
        success: function(rData){
            $('#layout_wrapper').html(rData);
            $.AdminLTE.boxWidget.activate();
        }
    });
}

function goConvocatoriaListado(){
    $.ajax({
        dataType:'html',
        type:'POST',
        data:{},
        url: sunePath + 'index.php/oportunidad-laboral/mantenimiento',
        success: function(rData){
            $('#layout_wrapper').html(rData);
            $.AdminLTE.boxWidget.activate();
        }
    });
}
function goConvocatoria(idx){
    $.ajax({
        dataType:'html',
        type:'POST',
        data:{
            v_idx : idx
        },
        url: sunePath + 'index.php/oportunidad-laboral/oporlabo',
        success: function(rData){
            $('#layout_wrapper').html(rData);
            $.AdminLTE.boxWidget.activate();
        }
    });
}
function ConvocatoriaGuardar() {
    var idx = $('#txt_idx_convocatoria').val();

    var fechaini = $('#txt_fecha_rango').val().substring(0, 11);
    var fechafin = $('#txt_fecha_rango').val().substring(13, 24);

    var titulo = $('#txt_des_titulo').val();
    var descripcion = $('#txt_detalle').val();
    var tipo = $('#cbo_tipo_convo').val();
    var unidorga = $('#cbo_unid_orga').val();

    var err_messages  = '';

    if (titulo.length == 0){
        err_messages  += '<i class="fa fa-times"></i> Ingrese Nombre del Proceso <br/>';
    }
    if(descripcion.length == 0){
        err_messages  += '<i class="fa fa-times"></i> Ingrese Descripción del Proceso <br/>';
    }
    if(fechaini.length == 0 || fechafin.length == 0){
        err_messages  += '<i class="fa fa-times"></i> Ingrese Periodo del Proceso<br/>';
    }
    if(err_messages .length > 0){
        $('#err-oporlabo-msg').html(err_messages );
        $('#err-oporlabo').show();
        $('#err-oporlabo').goTo();
        return;
    }

    fd = new FormData();
    fd.append('v_idx', idx);
    fd.append('v_titulo', titulo);
    fd.append('v_descripcion', descripcion);
    fd.append('v_tipo', tipo);
    fd.append('v_unidorga', unidorga);
    fd.append('v_fechaini', fechaini);
    fd.append('v_fechafin', fechafin);

    var filesArr = $('.docFile');
    var files_len = filesArr.length;

    for(var i=0; i < files_len; i++){
        if(filesArr[i].files[0] != undefined){
            //var nmFile = 'nfile' + i;

            //fd.append(nmFile, filesArr[i].files[0]);
            fd.append(filesArr[i].id, filesArr[i].files[0]);

            /* Agregar Tipo de Adjunto */
            //_tipoadj
            var nameTipoAdj = filesArr[i].id + '_tipoadj';
            fd.append(nameTipoAdj, $('#'+nameTipoAdj).val());
        }
    }

    $.ajax({
        dataType:'html',
        type:'POST',
        cache: false,
        processData: false,
        contentType: false,
        url: sunePath + 'index.php/oportunidad-laboral/ajaxoporlaboguardar',
        data: fd,
        beforeSend: function (x) {
            if (x && x.overrideMimeType) {
                x.overrideMimeType("multipart/form-data");
            }
            //$('#docGuardando').modal('show');

        },
        success: function(rData){
        },
        complete: function(){
            goConvocatoriaListado();
        }
    });
}



