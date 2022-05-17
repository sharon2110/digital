<?php
include('conexion.php');

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$regpagina = 8;
$inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;
$cont = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 1;

$sentencia = $con ->prepare("SELECT v.idvehiculo,v.marca, v.tipo,v.modelo, dv.precioproveedor,dv.preciominimo,dv.precioventa from vehiculo v INNER JOIN detalle_vehiculo dv ON v.idvehiculo = dv.vehiculo ORDER BY v.marca LIMIT $regpagina offset $inicio");
$sentencia->execute();
$sentencia = $sentencia->fetchAll();

$sentenciaT = $con->prepare("SELECT v.idvehiculo,v.marca, v.tipo,v.modelo, dv.precioproveedor,dv.preciominimo,dv.precioventa from vehiculo v INNER JOIN detalle_vehiculo dv ON v.idvehiculo = dv.vehiculo");
$sentenciaT->execute();
$totalreg = $sentenciaT->rowCount();


$numeroPag = ceil($totalreg/$regpagina);

