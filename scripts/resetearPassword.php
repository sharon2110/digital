<?php
include '../scripts/conexion.php';
$idusuario = $_POST["usuario"];

$sentencia = $con->prepare("SELECT ciusuario from usuario where idusuario=:idusu");
$sentencia->bindParam(':idusu', $idusuario, PDO::PARAM_INT);
$sentencia->execute();
$resultado = $sentencia->fetchAll();
$ciusuario = $resultado[0]["ciusuario"];


$sentencia = $con->prepare("UPDATE usuario set contrase_a=:ciusuario where idusuario=:idusu");
$sentencia->bindParam(':idusu', $idusuario, PDO::PARAM_INT);
$sentencia->bindParam(':ciusuario', $ciusuario, PDO::PARAM_STR);
$resultado = $sentencia->execute();
$resultado = $sentencia->fetchAll();
if ($resultado) {
    echo "Reseteado";
}