<?php
$id = $_GET["idMovi"];
include "../scripts/conexion.php";

$sql = "SELECT p.proveedor, dv.numpas,dv.cilindrada 
FROM detalle_vehiculo dv 
INNER JOIN auto_prov ap 
ON dv.vehiculo = ap.automovil
inner join proveedor p 
on p.idproveedor = ap.proveedor
where dv.vehiculo = :idv";

$sentencia = $con->prepare($sql);
$sentencia -> bindParam(':idv',$id,PDO::PARAM_STR);
$sentencia->execute();
$resultado = $sentencia->fetchAll();

$sql1 = "SELECT color from 
color where idcolor in (select color from 
color_vehiculo cv where cv.automovil =:idv)";
$sentencia1 = $con->prepare($sql1);
$sentencia1 -> bindParam(':idv',$id,PDO::PARAM_STR);
$sentencia1->execute();
$resultado1 = $sentencia1->fetchAll();

$sql2 = "SELECT fotovehiculo from vehiculo 
where idvehiculo =:idv";
$sentencia2 = $con->prepare($sql2);
$sentencia2 -> bindParam(':idv',$id,PDO::PARAM_STR);
$sentencia2->execute();
$resultado2 = $sentencia2->fetchAll();


$enviar = array_merge($resultado, $resultado1,$resultado2);
echo json_encode($enviar);