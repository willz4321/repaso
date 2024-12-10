<?php
function formatearFecha($fecha) {

    $FechaDatos = explode("-", $fecha);
    $fechaFormateada = array_reverse($FechaDatos);
    
   return implode("/",$fechaFormateada);
}
?>