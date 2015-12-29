var myPattern = {
    SOLO_LETRAS: /[A-Za-z]/,
    SOLO_NUMEROS: /\d/,
    NUMEROS_Y_LETRAS: /\w/,
};

function validarInputNoSpace(e){
    var vKey = (document.all) ? e.keyCode : e.which;
    if(vKey == 32) return false; // Espacios
    return true;
}
function validarInput(e, pattern, wspace){
    var vKey = (document.all) ? e.keyCode : e.which;
    if( vKey == 8 ) return true; // Backspace
    if( vKey == 0 ) return true; // Tab
    if( vKey == 13) return true; // Enter
    if( (vKey == 32) && wspace) return true; // Espacios

    var te = String.fromCharCode(vKey);
    return pattern.test(te);
}

function validarInputLetras(e){
    return validarInput(e, myPattern.SOLO_LETRAS, true);
}
function validarInputLetrasNoSpace(e){
    return validarInput(e, myPattern.SOLO_LETRAS, false);
}
function validarInputNumeros(e){
    return validarInput(e, myPattern.SOLO_NUMEROS, true);
}
function validarInputNumerosNoSpace(e){
    return validarInput(e, myPattern.SOLO_NUMEROS, false);
}
function validarInputNumerosyLetras(e){
    return validarInput(e, myPattern.NUMEROS_Y_LETRAS, true);
}
function validarInputNumerosyLetrasNoSpace(e){
    return validarInput(e, myPattern.NUMEROS_Y_LETRAS, false);
}