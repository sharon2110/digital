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
include('conexion.php');

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$regpagina = 8;
$inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;
$cont = ($pagina > 1) ? (($pagina * $regpagina) - ($regpagina-1)) : 1;
    $idusu = $_SESSION['idusuario'];
if ($tusu === "Administrador") {
    $sentencia = $con->prepare("SELECT * from cliente ORDER BY paterno LIMIT $regpagina offset $inicio");
    $sentencia->execute();
    $sentencia = $sentencia->fetchAll();

    $sentenciaT = $con->prepare("SELECT * from cliente");
    $sentenciaT->execute();
    $totalreg = $sentenciaT->rowCount();
    $numeroPag = ceil($totalreg / $regpagina);
} else {
    $sentencia = $con->prepare("SELECT * from cliente c where c.usuario =? ORDER BY paterno LIMIT $regpagina offset $inicio");
    $sentencia->execute([$idusu]);
    $sentencia = $sentencia->fetchAll();

    $sentenciaT = $con->prepare("SELECT * from cliente c where c.usuario=?");
    $sentenciaT->execute([$idusu]);
    $totalreg = $sentenciaT->rowCount();
    $numeroPag = ceil($totalreg / $regpagina);
}
