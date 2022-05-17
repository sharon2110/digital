<?php

include('conexion.php');
include('verifica.php');

$id = $_GET["idmovi"];

$sql2 = 'SELECT marca,modelo FROM vehiculo WHERE idvehiculo = :id';
$sentencia2 = $con->prepare($sql2);
$sentencia2->bindParam(':id', $id, PDO::PARAM_STR);
$resultado2 = $sentencia2->execute();
$res = $sentencia2->fetch();

$ruta = "../img_vehiculos/" . $res["marca"] . "-" . $res["modelo"];

if(file_exists($ruta)){
    $di = new RecursiveDirectoryIterator($ruta, FilesystemIterator::SKIP_DOTS);
    $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
    foreach ( $ri as $file ) {
        $file->isDir() ?  rmdir($file) : unlink($file);
    }
    rmdir($ruta);
    
}


$sentencia = "DELETE FROM detalle_vehiculo WHERE vehiculo=:id";
$sentencia = $con->prepare($sentencia);
$sentencia->bindParam(':id', $id, PDO::PARAM_STR);
$resultado = $sentencia->execute();

$sentencia1 = "DELETE FROM color_vehiculo WHERE automovil=:id";
$sentencia1 = $con->prepare($sentencia1);
$sentencia1->bindParam(':id', $id, PDO::PARAM_STR);
$resultado = $sentencia1->execute();

$sentencia3 = "DELETE FROM auto_prov WHERE automovil=:id";
$sentencia3 = $con->prepare($sentencia3);
$sentencia3->bindParam(':id', $id, PDO::PARAM_STR);
$resultado3 = $sentencia3->execute();

$sentencia4 = "DELETE FROM vehiculo WHERE idvehiculo=:id";
$sentencia4 = $con->prepare($sentencia4);
$sentencia4->bindParam(':id', $id, PDO::PARAM_STR);
$resultado4 = $sentencia4->execute();

echo ("Vehiculo Eliminado");


