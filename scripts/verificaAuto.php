<?php

function verificar_Auto($marca, $modelo, $numpas)
{
    include('conexion.php');
    $sql = "SELECT * from vehiculo v
    inner join detalle_vehiculo dv 
    on v.idvehiculo = dv.vehiculo 
    where v.marca =? and v.tipo =? and lower(v.modelo) LIKE ? and dv.numpas=?";
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(1, $marca, PDO::PARAM_STR);
    $sentencia->bindParam(2, $tipo, PDO::PARAM_STR);
    $sentencia->bindValue(3, "%$modelo%", PDO::PARAM_STR);
    $sentencia->bindParam(4, $numpas, PDO::PARAM_STR);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();
    if (count($resultado) > 0) {
        return true;
    } else {
        return false;
    }
}
