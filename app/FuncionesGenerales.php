<?php

function cambiarFormatoFecha($fecha, $formato_ini = 'd-m-Y', $formato_fin = 'Y-m-d') {
    $nuevaFecha = DateTime::createFromFormat($formato_ini, $fecha);
    return $nuevaFecha->format($formato_fin);
}
