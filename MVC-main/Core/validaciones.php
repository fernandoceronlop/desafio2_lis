<?php
function estaVacio($var){
 return empty(trim($var));
}

function esTexto($var){
    return preg_match('/^[a-zA-Z ]+$/',$var);
}

function esMail($var){
    return filter_var($var,FILTER_VALIDATE_EMAIL);
}

function esCarnet($var){
    return preg_match('/^[A-Z]{2}[0-9]{6}$/',$var);
}

function esTelefono($var){
    return preg_match('/^[267][0-9]{3}-?[0-9]{4}$/',$var);
}

function esCodigoProducto($var){
    return preg_match('/^PROD[0-9]{5}$/',$var);
}

function esTarjeta($var){
    return preg_match('/^5[1-5][0-9]{2}( ?[0-9]{4}){3}$/',$var);
}


?>