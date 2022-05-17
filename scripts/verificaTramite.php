<?php
if (!isset($_SESSION)) {
    session_start();
    $usuario = $_SESSION['usuario'];
    $tusu = $_SESSION['tipo'];
    $idusu = $_SESSION['idusuario'];
    if ($usuario == null || $usuario == "") {
        header("Location: ../scripts/cerrarSesion.php");
    }
}
include '../scripts/conexion.php';
$cliente = $_POST["cliente"];
$banco = $_POST["banco"];
$sql = "SELECT * from tramitebancario t 
where t.cliente =? and t.banco =?";
$sentencia = $con->prepare($sql);
$sentencia->bindParam(1,$cliente, PDO::PARAM_INT);
$sentencia->bindParam(2,$banco, PDO::PARAM_INT);
$sentencia->execute();
$resultado = $sentencia->fetchAll();
echo(count($resultado));

