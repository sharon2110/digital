<?php
include('conexion.php');
$idMov = $_GET["movilidad"];

$sentencia = $con->prepare("SELECT p.proveedor,dv.precioproveedor, dv.preciominimo, dv.precioventa,v.marca,v.tipo,v.modelo,dv.numpas,dv.cilindrada,v.fotovehiculo from
vehiculo v 
inner join auto_prov ap 
on v.idvehiculo = ap.automovil 
inner join proveedor p 
on p.idproveedor = ap.proveedor 
inner join detalle_vehiculo dv 
on v.idvehiculo = dv.vehiculo 
where v.idvehiculo =:idv");
$sentencia -> bindParam(':idv',$idMov,PDO::PARAM_STR);
$sentencia->execute();
$resultado = $sentencia->fetchAll();


$sentencia1 = $con->prepare("SELECT idcolor from 
color where idcolor in (select color from 
color_vehiculo cv where cv.automovil =:idv)");
$sentencia1 -> bindParam(':idv',$idMov,PDO::PARAM_STR);
$sentencia1->execute();
$resultado1 = $sentencia1->fetchAll();

$enviar = array_merge($resultado, $resultado1);
echo json_encode($enviar);
