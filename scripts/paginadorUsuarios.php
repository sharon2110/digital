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
if ($tusu === "Administrador") {
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $regpagina = 8;
    $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;
    $cont = ($pagina > 1) ? (($pagina * $regpagina) - ($regpagina-1)) : 1;
    
    $sentencia = $con ->prepare("SELECT * from usuario ORDER BY paterno LIMIT $regpagina offset $inicio");
    $sentencia->execute();
    $sentencia = $sentencia->fetchAll();
    
    $sentenciaT = $con->prepare("SELECT * from usuario");
    $sentenciaT->execute();
    $totalreg = $sentenciaT->rowCount();
    $numeroPag = ceil($totalreg/$regpagina);
}


