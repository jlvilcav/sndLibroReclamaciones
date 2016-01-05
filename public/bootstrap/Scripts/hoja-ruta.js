function verSeguimientoHojaRutaAdjunto(docid)
{
    $.ajax({
        dataType:'html',
        type:'POST',
        url : sunePath + 'index.php/hoja-ruta/indexajax',
        data:{
            doc : docid
        },
        beforeSend: function(){
            $('#modalHojaRutaContent').html('');
        },
        success : function(rData){
            $('#modalHojaRutaContent').html(rData);
        }
    });
}
function imprimirSeguimientoHojaRuta(){
    var docid = $('#hd_doc').val();
    window.open(sunePath + 'index.php/hoja-ruta/indexajax?doc=' + docid, '_blank', 'width=500,height=500');
}
function verSeguimientoHojaRuta(docid)
{
    $.ajax({
        dataType:'html',
        type:'POST',
        url : sunePath + 'index.php/hoja-ruta/indexajax',
        data:{
            doc : docid
        },
        beforeSend: function(){
            $('#modalHojaRutaContent').html('');
            $('#modalHojaRuta').modal('hide');
        },
        success : function(rData){
            $('#modalHojaRutaContent').html(rData);
            $('#modalHojaRuta').modal('show');
        }
    });
}