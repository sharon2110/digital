<?php

function verificar_existencia( $id, $tabla) {
    include ('conexion.php');
    $sql = "SELECT * FROM $tabla where cicliente = :ci";
    $sentencia = $con->prepare($sql);
    $sentencia -> bindParam(':ci',$id,PDO::PARAM_STR);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();
    if(count($resultado)>0){
        return true;

    }else{
        return false;
    }
 
}
function verificar_asesor( $id, $tabla) {
    include ('conexion.php');
    $sql = "SELECT * FROM $tabla where ciusuario = :ci";
    $sentencia = $con->prepare($sql);
    $sentencia -> bindParam(':ci',$id,PDO::PARAM_STR);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();
    if(count($resultado)>0){
        return true;

    }else{
        return false;
    }
 
}
function verificar_vehiculo_tramite( $id) {
    include ('conexion.php');
    $sql = "SELECT * FROM detalle_tramite where vehiculo = :id";
    $sentencia = $con->prepare($sql);
    $sentencia -> bindParam(':id',$id,PDO::PARAM_STR);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();
    if(count($resultado)>0){
        return true;
    }else{
        return false;
    }
}

?>
