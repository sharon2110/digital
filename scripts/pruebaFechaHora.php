<?php

$fechaActual = date('d-m-Y');
date_default_timezone_set('Etc/GMT-6');
$hora = date('h:i:s:A',time()+43200);
echo $hora;
echo $fechaActual;

?>