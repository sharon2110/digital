<?php
include('conexion.php');
$idCli = $_GET["cliente"];

$sentencia = $con->prepare("SELECT * FROM cliente WHERE idcliente = ?;");
$sentencia->execute([$idCli]); # Pasar en el mismo orden de los ?
$cliente = $sentencia->fetchAll();
echo json_encode($cliente[0]);
