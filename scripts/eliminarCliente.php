<?php

include('conexion.php');
include('verifica.php');

$id = $_POST["idcli"];
function verificar_existencia_venta_tramite($id, $tabla)
{
    include('conexion.php');
    $sql = "SELECT * FROM $tabla where cliente = :id";
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();
    if (count($resultado) > 0) {
        return true;
    } else {
        return false;
    }
}
if (verificar_existencia_venta_tramite($id, "venta") or verificar_existencia_venta_tramite($id, "tramitebancario")) {
    echo "No se puede eliminar";
} else {
    $sql2 = 'SELECT cicliente FROM cliente WHERE idcliente = :id';
    $sentencia2 = $con->prepare($sql2);
    $sentencia2->bindParam(':id', $id, PDO::PARAM_STR);
    $resultado2 = $sentencia2->execute();
    $cicliente = $sentencia2->fetch();
    $sql = 'DELETE FROM cliente
    WHERE idcliente = :id';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
    $resultado = $sentencia->execute();
    if ($resultado === true) {
        $mensaje = "Cliente Eliminado";
    }
    $ruta = "../images/" . $cicliente["cicliente"];

    eliminar_directorio($ruta);

    echo $mensaje;
}
function eliminar_directorio($dir)
{
    foreach(glob($dir."/*.*") as $archivos_carpeta) 
    { 
     unlink($archivos_carpeta);     // Eliminamos todos los archivos de la carpeta hasta dejarla vacia 
    } 
    rmdir($dir);   
}
