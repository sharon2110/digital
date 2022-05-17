<?php
$id = $_GET["idUsu"];
$doc= $_GET["doc"];
include "../scripts/conexion.php";
$sql = "SELECT * FROM usuario where idusuario = :id";
$sentencia = $con->prepare($sql);
$sentencia -> bindParam(':id',$id,PDO::PARAM_STR);
$sentencia->execute();
$resultado = $sentencia->fetch();
echo $resultado[$doc];
