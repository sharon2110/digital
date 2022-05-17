<?php
include('conexion.php');
$idUsu = $_GET["usuario"];

$sentencia = $con->prepare("SELECT * FROM usuario WHERE idusuario = ?;");
$sentencia->execute([$idUsu]); # Pasar en el mismo orden de los ?
$usuario = $sentencia->fetchAll();

echo json_encode($usuario[0]);
