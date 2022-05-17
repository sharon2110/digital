<?php
include '../scripts/conexion.php';
$idF = $_POST["idfolder"];
$sql = "SELECT ldb.banco,ldb.planpago,ldb.ultimaboleta from lista_deuda_banco ldb 
inner join lista_folder lf 
on ldb.listafolder = lf.idlistafolder 
inner join folder f 
on f.idfolder = lf.folder 
where f.idfolder =?";
$sentencia = $con->prepare($sql);
$sentencia->bindValue(1, $idF, PDO::PARAM_STR);
$sentencia->execute();
$resultado = $sentencia->fetchAll();

echo json_encode($resultado);