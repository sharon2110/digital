<?php
session_start();
$usuario = $_SESSION['usuario'];
$tusu = $_SESSION['tipo'];
$idusu = $_SESSION['idusuario'];
if ($usuario == null || $usuario == "") {
    header("Location: ../scripts/cerrarSesion.php");
}
 $ci = trim($_GET['cliente']);
 include "../scripts/conexion.php";
 if($tusu==="Administrador"){
    $sql = "SELECT * FROM cliente where cicliente = ?";
    $sentencia = $con->prepare($sql);
    $sentencia->bindValue(1, $ci, PDO::PARAM_STR);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();
 }else{
     if($tusu==="Restringido"){
        $sql = "SELECT * FROM cliente c where c.cicliente = ? and c.usuario=?";
        $sentencia = $con->prepare($sql);
        $sentencia->bindValue(1, $ci, PDO::PARAM_STR);
        $sentencia->bindValue(2, $idusu, PDO::PARAM_STR);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
       
     }

 }
 echo json_encode($resultado);

   

 


