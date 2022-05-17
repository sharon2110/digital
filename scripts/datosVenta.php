<?php

include '../scripts/conexion.php';
$idV = $_POST["idventa"];

$sql = "SELECT * from venta v 
inner join cliente c 
on v.cliente = c.idcliente 
where v.idventa =?";
$sentencia = $con->prepare($sql);
$sentencia->bindValue(1, $idV, PDO::PARAM_STR);
$sentencia->execute();
$resultado = $sentencia->fetchAll();

$sql1 = "SELECT * from detalle_venta dv
where dv.venta =?";
$sentencia1 = $con->prepare($sql1);
$sentencia1->bindValue(1, $idV, PDO::PARAM_STR);
$sentencia1->execute();
$resultado1 = $sentencia1->fetchAll();

$enviar = array_merge($resultado, $resultado1);

echo json_encode($enviar);