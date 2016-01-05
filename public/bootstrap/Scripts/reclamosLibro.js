/**
 * Created by WebMaster on 17/12/2015.
 */
//<script>
$('#btnFinalizaRegDenuncia').bind('click', function(){
    $('#denunciaConfirm').modal('show');
});
/* INI : Dar estilo a los input file */
$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});
$(document).ready( function() {
    prepareStyledInputFiles();

});

function otraUni(){

    var xcboUniversidad = $('#cboUniversidad').val();

    if(xcboUniversidad=="0"){
        $('#txtNomInstDenunciada').show();
    }else{
        $('#txtNomInstDenunciada').hide();
    }
}

function otraInstancia(){

    var xcbo = $('#cbxBitOtraInstancia').val();

    if(xcbo=="1"){
        $('#divOtraInstancia').show();
    }else{
        $('#divOtraInstancia').hide();
    }
}


function prepareStyledInputFiles(){
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
    });
}
/* FIN : Dar estilo a los input file */
function denunciaOpenTab(tabID){
    $('#tabsDenuncia a[href="#' + tabID + '"]').tab('show');
}
$('#accordion').on('hidden.bs.collapse', function () {
    limpiar();
})
function limpiar(){

    //$('#tabsDenuncia a[href="#' + tabID + '"]').tab('show');
    $('#txtCodNumeDocumento').val('');
    $('#txtNatuNombre').val('');
    $('#txtNatuPaterno').val('');
    $('#txtNatuMaterno').val('');
    $('#txtNatuEmail').val('');
    $('#txtNatuFijo').val('');
    $('#txtNatuMovil').val('');
    $('#txtNatuReal').val('');
    $('#txtNatuNotificacion').val('');

    $('#txtJuriRuc').val('');
    $('#txtJuriNombre').val('');
    $('#txtJuriEmail').val('');
    $('#txtJuriTelefono').val('');
    $('#txtJuriReal').val('');
    $('#txtJuriNotificacion').val('');
    $('#txtJuriApoderado').val('');
    $('#txtDesPartSunarp').val('');

    $('#hidIdxDenunciante').val('');
}
/* INICIO : ayax buscar persona */
function buscaPersonaDNI(){
    var xcodNumeDocumento = $('#txtCodNumeDocumento').val();
    var xidxTipoDocuIdentidad = $('#cboIdxTipoDocuIdentidad').val();
    limpiar();
    if(xcodNumeDocumento == undefined || xcodNumeDocumento == null){
        alert('Ingrese número de DNI');
        return;
    }else{

        $.ajax({
            dataType:'json',
            type: 'POST',
            url: sunePath + 'index.php/denuncias/persona',
            data: {
                idxTipoDocuIdentidad : xidxTipoDocuIdentidad,
                idxCodNumeDocumento : xcodNumeDocumento
            },
            beforeSend: function () {

            },
            success: function(rData){

                $('#txtCodNumeDocumento').val(xcodNumeDocumento);
                $('#cboIdxTipoDocuIdentidad').val(xidxTipoDocuIdentidad);

                $('#hidIdxDenunciante').val(rData[0].IDX_PERSONA);
                $('#txtNatuNombre').val(rData[0].NOM_PERSONA);
                $('#txtNatuPaterno').val(rData[0].APE_PATERNO);
                $('#txtNatuMaterno').val(rData[0].APE_MATERNO);
                $('#txtNatuEmail').val(rData[0].DES_EMAIL);
                $('#txtNatuFijo').val(rData[0].DES_TELE_FIJO);
                $('#txtNatuMovil').val(rData[0].DES_TELE_MOVIL);

                $('#txtNatuReal').val(rData[0].TXT_DOMICILIO);
                $('#txtNatuNotificacion').val(rData[0].TXT_DOMICILIO);

                //console.log(rData);
            },
            error: function(rData, eNumber, eMessage){
                console.log(rData + eNumber + eMessage);
            }
        });
    }
}
function buscaPersonaRUC(){
    var xcodNumeDocumento = $('#txtJuriRuc').val();
    var xidxTipoDocuIdentidad = '7';
    limpiar();
    if(xcodNumeDocumento == undefined || xcodNumeDocumento == null){
        alert('Ingrese número de DNI');
        return;
    }else{

        $.ajax({
            dataType:'json',
            type: 'POST',
            url: sunePath + 'index.php/denuncias/persona',
            data: {
                idxTipoDocuIdentidad : xidxTipoDocuIdentidad,
                idxCodNumeDocumento : xcodNumeDocumento
            },
            beforeSend: function () {

            },
            success: function(rData){
                $('#txtJuriRuc').val(xcodNumeDocumento);
                //$('#cboIdxTipoDocuIdentidad').val(rData[0].IDX_TIPO_DOCU_IDENTIDAD);
                $('#hidIdxDenunciante').val(rData[0].IDX_PERSONA);
                $('#txtJuriNombre').val(rData[0].NOM_PERSONA);
                //$('#txtJuriPaterno').val(rData[0].APE_PATERNO);
                //$('#txtJuriMaterno').val(rData[0].APE_MATERNO);
                $('#txtJuriEmail').val(rData[0].DES_EMAIL);
                $('#txtJuriTelefono').val(rData[0].DES_TELE_FIJO);
                //$('#txtJuriMovil').val(rData[0].DES_TELE_MOVIL);

                $('#txtJuriReal').val(rData[0].TXT_DOMICILIO);
                $('#txtJuriNotificacion').val(rData[0].TXT_DOMICILIO);

                $('#txtJuriApoderado').val(rData[0].NOM_REPRESENTANTE);
                $('#txtDesPartSunarp').val(rData[0].DES_NUME_PART_RRPP);

                //console.log(rData);
            },
            error: function(rData, eNumber, eMessage){
                console.log(rData + eNumber + eMessage);
            }
        });
    }
}
/* FIN : ayax buscar persona */
/* INICIO : ayax buscar ubigeo */
function getUbigeo(p,h,n){
    var v_cboUbigeo = $('#cbo'+p).val();
    $.ajax({
        dataType:'html',
        type : 'POST',
        url: sunePath + 'index.php/denuncias/ubigeo',
        data : {
            codUbigeo : v_cboUbigeo
        },
        beforeSend:function(){
        },
        success: function(rData){
            $('#cbo'+h).html(rData);
            $("#cbo"+h).select2({
                placeholder: "Seleccionar...",
                language : {
                    noResults : function(){
                        return 'Seleccione Ubicación';
                    }
                }
            });

            console.log(rData);
            if(n.length > 1){
                getUbigeo(h,n,'');
            }
        }
    });

}
/* FIN : ayax buscar ubigeo */
/* INICIO : ayax guardar Denuncia */
var fd;
var xbit =0;

function no_nulo(valor){
    if(valor != undefined && valor != null && valor.length > 0){
        return true;
    }else{
        return false;
    }
}


function prepareDataNuevaDenuncia(){
    var xidxDenunciaWeb= $('#txtIdxDenunciaWeb').val();
    var xcodNumeDocumento= $('#txtCodNumeDocumento').val();
    var xcodNumeRuc= $('#txtJuriRuc').val();


    if(xcodNumeDocumento != undefined && xcodNumeDocumento != null && xcodNumeDocumento.length > 0 ){
        //console.log(xcodNumeDocumento);
        var xbitTipoDenunciante= '1';

        var xidxTipoDocuIdentidad= $('#cboIdxTipoDocuIdentidad').val();
        var xtxtNombRazoSocial= $('#txtNatuPaterno').val()+' '+$('#txtNatuMaterno').val()+', '+$('#txtNatuNombre').val();
        //console.log(xtxtNombRazoSocial);

        if(!no_nulo($('#txtNatuPaterno').val())){
            alert('Ingrese su Nombre');
            xbit=0;
            return;
        }
        if(!no_nulo($('#txtNatuMaterno').val()+$('#txtNatuNombre').val())){
            alert('Ingrese minimo uno de sus apellidos');
            xbit=0;
            return;
        }
        var xdesEmail= $('#txtNatuEmail').val();
        if(!no_nulo(xdesEmail)){
            alert('Ingrese su Email');
            xbit=0;
            return;
        }
        var xdesTeleFijo= $('#txtNatuFijo').val();
        var xdesTeleCelular= $('#txtNatuMovil').val();
        if(!no_nulo(xdesTeleCelular)){
            alert('Ingrese su número de celular');
            xbit=0;
            return;
        }
        var xtxtDomiReal= $('#txtNatuReal').val();
        if(!no_nulo(xtxtDomiReal)){
            alert('Ingrese su domicilio de real');
            xbit=0;
            return;
        }
        var xtxtDomiNotificacion= $('#txtNatuNotificacion').val();
        if(!no_nulo(xtxtDomiNotificacion)){
            alert('Ingrese su domicilio de notificaciones');
            xbit=0;
            return;
        }
        var xdesPartSunarp= '';

        var xcodUbiReal= $('#cboDisPNR').val();
        if(!no_nulo(xcodUbiReal)){
            alert('Seleccione su distrito real');
            xbit=0;
            return;
        }
        var xcodUbiNotificacion= $('#cboDisPNN').val();
        if(!no_nulo(xcodUbiNotificacion)){
            alert('Seleccione su distrito de notificaciones');
            xbit=0;
            return;
        }
        var xnomReprInstDenunciante= '';
        xbit=1;
    }else if(xcodNumeRuc != undefined && xcodNumeRuc != null && xcodNumeRuc.length > 0){
        var xbitTipoDenunciante= '2';

        xcodNumeDocumento= $('#txtJuriRuc').val();
        var xidxTipoDocuIdentidad= '7';
        var xtxtNombRazoSocial= $('#txtJuriNombre').val();
        if(!no_nulo(xtxtNombRazoSocial)){
            alert('Ingrese su razón social');
            xbit=0;
            return;
        }
        var xdesEmail= $('#txtJuriEmail').val();
        if(!no_nulo(xdesEmail)){
            alert('Ingrese su Email');
            xbit=0;
            return;
        }
        var xdesTeleFijo= $('#txtJuriTelefono').val();
        if(!no_nulo(xdesTeleFijo)){
            alert('Ingrese su número de teléfono fijo');
            xbit=0;
            return;
        }
        var xdesTeleCelular= '';
        var xtxtDomiReal= $('#txtJuriReal').val();
        if(!no_nulo(xtxtDomiReal)){
            alert('Ingrese su domicilio de real');
            xbit=0;
            return;
        }
        var xtxtDomiNotificacion= $('#txtJuriNotificacion').val();
        if(!no_nulo(xtxtDomiNotificacion)){
            alert('Ingrese su domicilio de notificaciones');
            xbit=0;
            return;
        }
        var xdesPartSunarp= $('#txtDesPartSunarp').val();
        if(!no_nulo(xdesPartSunarp)){
            alert('Ingrese su partida de Sunarp');
            xbit=0;
            return;
        }
        var xcodUbiReal= $('#cboDisPJR').val();
        if(!no_nulo(xcodUbiReal)){
            alert('Seleccione su distrito real');
            xbit=0;
            return;
        }
        var xcodUbiNotificacion= $('#cboDisPJN').val();
        if(!no_nulo(xcodUbiReal)){
            alert('Seleccione su distrito de notificaciones');
            xbit=0;
            return;
        }
        var xnomReprInstDenunciante= $('#txtJuriApoderado').val();
        if(!no_nulo(xcodUbiReal)){
            alert('Ingrese el apoderado');
            xbit=0;
            return;
        }
        xbit=1;
    }else{
        alert('Ingrese su número de documento de identidad o numero de RUC');
        xbit=0;
        return;
    }

    //$('#txtJuriApoderado').val(rData[0].NOM_REPRESENTANTE);

    var xidxDenunciante= $('#hidIdxDenunciante').val();
    if( $('#cboUniversidad').val()=='0') {
        var xnomInstDenunciada = $('#txtNomInstDenunciada').val();
        if(!no_nulo(xnomInstDenunciada)){
            alert('Ingrese el nombre de la entidad (otra) denunciada');
            xbit=0;
            return;
        }

    }else{
        var xnomInstDenunciada = $('#cboUniversidad').val();
    }


    var xnomReprInstDenunciada= $('#txtNomReprInstDenunciada').val();
    var xtxtDomiInstDenunciada= $('#txtTxtDomiInstDenunciada').val();

    if(!no_nulo(xtxtDomiInstDenunciada)){
        alert('Ingrese la dirección de la entidad denunciada');
        xbit=0;
        return;
    }



    var xbitOtraInstancia= $('#cbxBitOtraInstancia').val();
    var xdesOtraInstancia= $('#txtDesOtraInstancia').val();


    var xtmxOtraInstancia= $("input[name='rbn_txtTmxOtraInstancia']:checked").val();// $('#txtTmxOtraInstancia').val();
    var xtmxAsunDenuncia= $("input[name='rbn_txtTmxAsunDenuncia']:checked").val();// $('#txtTmxAsunDenuncia').val();


    var xdesAsunDenuncia =$('label[for=txtTmxAsunDenuncia_'+xtmxAsunDenuncia+ ']').text();
    //alert(xtmxOtraInstancia);
    if(xtmxOtraInstancia == undefined || xtmxOtraInstancia == null || xtmxOtraInstancia == '' ){

        alert('Falta seleccionar una Instancia:'+xtmxOtraInstancia);
        xbit=0;
        return;
    }
    if( xtmxAsunDenuncia == undefined || xtmxAsunDenuncia == null ){
        alert('Falta seleccionar el tipo de denuncia');
        xbit=0;
        return;
    }

    var xtxtDescHechos= $('#txtTxtDescHechos').val();
    if(!no_nulo(xtxtDescHechos)){
        alert('Ingrese la descripcion de los hechos');
        xbit=0;
        return;
    }

    var xtxtPoteAfecHechos= $('#txtTxtPoteAfecHechos').val();
    if(!no_nulo(xtxtPoteAfecHechos)){
        alert('Ingrese los potenciales afectados');
        xbit=0;
        return;
    }

    var xrutDocuIdentidad= $('#txtRutDocuIdentidad').val();



    fd = new FormData();
    fd.append('idxDenunciaWeb', xidxDenunciaWeb);
    fd.append('bitTipoDenunciante', xbitTipoDenunciante);
    fd.append('rutDocuIdentidad', xrutDocuIdentidad);
    fd.append('txtNombRazoSocial', xtxtNombRazoSocial);
    fd.append('idxTipoDocuIdentidad', xidxTipoDocuIdentidad);
    fd.append('codNumeDocumento', xcodNumeDocumento);
    fd.append('desEmail', xdesEmail);
    fd.append('desTeleFijo', xdesTeleFijo);
    fd.append('desTeleCelular', xdesTeleCelular);
    fd.append('txtDomiReal', xtxtDomiReal);
    fd.append('txtDomiNotificacion', xtxtDomiNotificacion);
    fd.append('desPartSunarp', xdesPartSunarp);
    fd.append('idxDenunciante', xidxDenunciante);
    fd.append('nomInstDenunciada', xnomInstDenunciada);
    fd.append('nomReprInstDenunciada', xnomReprInstDenunciada);
    fd.append('txtDomiInstDenunciada', xtxtDomiInstDenunciada);
    fd.append('bitOtraInstancia', xbitOtraInstancia);
    fd.append('tmxOtraInstancia', xtmxOtraInstancia);
    fd.append('desOtraInstancia', xdesOtraInstancia);
    fd.append('tmxAsunDenuncia', xtmxAsunDenuncia);
    fd.append('desAsunDenuncia', xdesAsunDenuncia);
    fd.append('txtDescHechos', xtxtDescHechos);
    fd.append('txtPoteAfecHechos', xtxtPoteAfecHechos);
    fd.append('codUbiReal', xcodUbiReal);
    fd.append('codUbiNotificacion', xcodUbiNotificacion);
    fd.append('nomReprInstDenunciante', xnomReprInstDenunciante);

    var filesArr = $('.docFile');
    var files_len = filesArr.length;



    for(var i=0; i < files_len; i++){
        if(filesArr[i].files[0] != undefined){
            //var nmFile = 'nfile' + i;

            //fd.append(nmFile, filesArr[i].files[0]);
            fd.append(filesArr[i].id, filesArr[i].files[0]);

            // Agregar descripcion de Adjunto
            //_tipoadj
            var nameDes = filesArr[i].id + '_des';

            fd.append(nameDes, $('#'+nameDes).val());
            if(i>0){
                if($('#'+nameDes).val()== undefined ){
                    alert('Falta descripción del archivo ' + i );
                    xbit=0;
                    return;
                }else if($('#'+nameDes).val().length<10 ){
                    alert('Descripción muy corta del archivo ' + i );
                    xbit=0;
                    return;
                }
            }


        }
        else{
            alert('Falta adjuntar Archivos');
            xbit=0;
            return;
        }
    }

    err_messages = '';
    $('#err-doclic').hide();
}
function guardarDenuncia(){

    prepareDataNuevaDenuncia();
    if(xbit==0){
        return;
    }
    //alert(xtmxOtraInstancia +' '+xtmxAsunDenuncia);
    $.ajax({
        dataType:'html',
        type: 'POST',
        cache: false,
        processData: false,
        contentType: false,
        url: sunePath + 'index.php/denuncias/guardar',
        data: fd ,
        beforeSend: function (x) {
            if (x && x.overrideMimeType) {
                x.overrideMimeType("multipart/form-data");
            }
        },
        success: function(rData){
            //$('#txtIdxDenunciaWeb').val(rData[0].NOM_PERSONA);
            console.log(rData);

            $('#hidIdxDenunciaWeb').val(rData);
            alert('La denuncia se envio correctamente, se asigno el codigo : ' + $('#hidIdxDenunciaWeb').val());
        },
        error: function(rData, eNumber, eMessage){
            console.log('Error: '+ eMessage);
        }
    });
}

function removeInputFileAdj(id){
    $('#ndocfile' + id + '_div').remove();

    var totalfiles = $('.docFile').length;
    if(totalfiles<11){
        $('#btnAppendFileSelector').removeAttr('disabled');
    }
}

var inputFileControlsCount = 1;

function appendInputFileAdj(){

    var totalfiles = $('.docFile').length;

    if(totalfiles == 11){
        return;
    }

    inputFileControlsCount = inputFileControlsCount + 1;
    var divadj = $('#divAdjuntosContainer');
    var inputCtrl = '';


    //ndocfile1_div
    inputCtrl += '<div class="col-md-12" id="ndocfile' + inputFileControlsCount + '_div">';
    inputCtrl += '<div class="col-sm-12 col-md-12" style="margin-top:5px;">';
    inputCtrl += '<label class="col-sm-12 col-md-2">Descripci&oacute;n :</label>';
    inputCtrl += '<div class="col-sm-12 col-md-4">';
    /* Tipo Adjunto */
    inputCtrl += '<input class="form-control text-uppercase" type="text" maxlength="80" id="docfile' + inputFileControlsCount + '_des"/>';
    inputCtrl += '</div>';

    /* Seccion Examinar */
    inputCtrl += '<div class="input-group col-sm-12 col-md-6">';
    inputCtrl += '<span class="input-group-btn">';
    inputCtrl += '<span class="btn btn-default btn-file">';
    inputCtrl += 'Examinar <input class="docFile"  id="docfile' + inputFileControlsCount + '" type="file" name="c_lob_uload[]">';
    inputCtrl += '</span>';
    inputCtrl += '</span>';
    inputCtrl += '<input type="text" class="form-control" readonly>';


    /* Boton Eliminar */
    inputCtrl += '<span class="input-group-btn">';
    inputCtrl += '<button type="button" onclick="removeInputFileAdj(' + inputFileControlsCount + ')" class="btn btn-default">';
    inputCtrl += '<i class="fa fa-trash" title="Eliminar"></i>';
    inputCtrl += '</button>';
    inputCtrl += '</span>';

    inputCtrl += '</div>';
    inputCtrl += '</div>';
    inputCtrl += '</div>';

    divadj.append(inputCtrl);
    prepareStyledInputFiles();


    totalfiles = $('.docFile').length;
    if(totalfiles == 11){
        $('#btnAppendFileSelector').attr('disabled', 'disabled');
    }
}
//</script>