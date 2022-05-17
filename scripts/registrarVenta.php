<?php
include '../scripts/conexion.php';
$idusuario = $_POST["idUsuario"];
$obs = $_POST["obs"];
$sentencia = $con->prepare("SELECT * from usuario where idusuario=:idusu and estado=:estado");
$sentencia->bindParam(':idusu', $idusuario, PDO::PARAM_INT);
$sentencia->bindValue(':estado', "Activo");
$sentencia->execute();
$resultado = $sentencia->fetchAll();
$num = count($resultado);
if ($num > 0) {
    registrarVenta();
    echo "Registrado";
}



function registrarVenta()
{
    include '../scripts/conexion.php';
    $cliente = $_POST["cliente"];
    $vehiculos = $_POST["vehiculos"];
    $idusuario = $_POST["idUsuario"];
    $obs = $_POST["obs"];
    $fecha = date('d-m-Y');
    date_default_timezone_set('Etc/GMT-6');
    $hora = date('h:i:A', time() + 43200);
    $sentencia = $con->prepare("INSERT INTO venta(cliente,usuario,fecha,hora,observaciones) VALUES (?, ?, ?,?, ?);");
    $sentencia->bindParam(1, $cliente, PDO::PARAM_INT);
    $sentencia->bindParam(2, $idusuario, PDO::PARAM_INT);
    $sentencia->bindParam(3, $fecha, PDO::PARAM_STR);
    $sentencia->bindParam(4, $hora, PDO::PARAM_STR);
    $sentencia->bindParam(5, $obs, PDO::PARAM_STR);
    $sentencia->execute();
    $sentencia1 = $con->prepare("SELECT idventa FROM venta WHERE cliente=:cliente and usuario=:usuario and fecha=:fecha");
    $sentencia1->bindParam(':cliente', $cliente, PDO::PARAM_INT);
    $sentencia1->bindParam(':usuario', $idusuario, PDO::PARAM_INT);
    $sentencia1->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $sentencia1->execute();
    $resultado1 = $sentencia1->fetch();
    $idVenta =  $resultado1["idventa"];
    foreach ($vehiculos as $vehiculo) {
        foreach ($vehiculo as $dato) {
            $marca = $dato[0];
            $modelo = $dato[1];
            $tipo = $dato[2];
            $color = $dato[3];
            $numpas = $dato[4];
            $cil = $dato[5];
            $precio = $dato[6];
            $tventa = $dato[7];
            $contacto = $dato[8];
            if ($dato[9]=="true") {
                $ruat = "si";
            } else {
                $ruat = "no";
            }
            if ($dato[10]=="true") {
                $poliza = "si";
            } else {
                $poliza = "no";
            }
            if ($dato[11]=="true") {
                $soat = "si";
            } else {
                $soat = "no";
            }
            if ($dato[12]=="true") {
                $placa = "si";
            } else {
                $placa = "no";
            }
            if ($dato[13]=="true") {
                $transito = "si";
            } else {
                $transito = "no";
            }
            $sentencia2 = $con->prepare("INSERT INTO detalle_venta(venta,marca,modelo,tipo,color,nump, cilindrada,precio,tipo_venta,contacto,
                ruat,poliza,soat,placa,resolucion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?);");
            $sentencia2->bindParam(1, $idVenta, PDO::PARAM_STR);
            $sentencia2->bindParam(2, $marca, PDO::PARAM_STR);
            $sentencia2->bindParam(3, $modelo, PDO::PARAM_STR);
            $sentencia2->bindParam(4, $tipo, PDO::PARAM_STR);
            $sentencia2->bindParam(5, $color, PDO::PARAM_STR);
            $sentencia2->bindParam(6, $numpas, PDO::PARAM_STR);
            $sentencia2->bindParam(7, $cil, PDO::PARAM_STR);
            $sentencia2->bindParam(8, $precio, PDO::PARAM_STR);
            $sentencia2->bindParam(9, $tventa, PDO::PARAM_STR);
            $sentencia2->bindParam(10, $contacto, PDO::PARAM_STR);
            $sentencia2->bindParam(11, $ruat, PDO::PARAM_STR);
            $sentencia2->bindParam(12, $poliza, PDO::PARAM_STR);
            $sentencia2->bindParam(13, $soat, PDO::PARAM_STR);
            $sentencia2->bindParam(14, $placa, PDO::PARAM_STR);
            $sentencia2->bindParam(15, $transito, PDO::PARAM_STR);
            $resultado2 = $sentencia2->execute(); # Pasar en el mismo orden de los ?
        }
    }
}
