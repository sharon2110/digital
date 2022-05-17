<?php
include '../scripts/conexion.php';
$idF = $_POST["idfolder"];
$sql = "SELECT dbf.banco,dbf.planpago,dbf.ultimaboleta from deuda_banco_folder dbf 
where dbf.folder =?";
$sentencia = $con->prepare($sql);
$sentencia->bindValue(1, $idF, PDO::PARAM_STR);
$sentencia->execute();
$resultado = $sentencia->fetchAll();

echo json_encode($resultado);
