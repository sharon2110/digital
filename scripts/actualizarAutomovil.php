<?php
include('conexion.php');
include('verificaAuto.php');

$id = $_POST["idMovi"];
$idp = $_POST["idProv"];
$proveedor = $_POST["selecproveedor"];
$precioCompra = $_POST["precio_compra"];
$precioMinVenta = $_POST["precio_minventa"];
$precioVenta = $_POST["precio_venta"];
$marca = $_POST["seleccion_marca"];
if ($marca == "Otro") {
    $marca = $_POST["marca_otro"];
}
$tipo = $_POST["seleccion_tipo"];
if ($tipo == "Otro") {
    $tipo = $_POST["tipo_otro"];
}
$modelo = $_POST["modelo_movi"];
$numpasaj = $_POST["num_pasamovi"];
$cilindrada = $_POST["cil_movi"];
$colores = $_POST["color"];
$fotoAuto = $_FILES["foto_auto"];

$mensaje = "";

if ($fotoAuto["name"] == "") {
    $sentencia = $con->prepare("UPDATE vehiculo SET marca=?,tipo=?,modelo=? WHERE idvehiculo=? ");
    $resultado = $sentencia->execute([$marca, $tipo, $modelo, $id]); # Pasar en el mismo orden de los ?
    if ($resultado === true) {
        $query = $con->prepare("DELETE from color_vehiculo where automovil =?");
        $res = $query->execute([$id]); # Pasar en el mismo orden de los ?

        for ($i = 0; $i < sizeof($colores); $i++) {
            $sentencia2 = $con->prepare("INSERT INTO color_vehiculo(color,automovil) VALUES (?, ?);");
            $resultado = $sentencia2->execute([$colores[$i], $id]); # Pasar en el mismo orden de los ?
        }
        $sentencia3 = $con->prepare("UPDATE detalle_vehiculo SET numpas=?,cilindrada=?,precioproveedor=?,preciominimo=?,precioventa=? WHERE vehiculo=?");
        $resultado = $sentencia3->execute([$numpasaj, $cilindrada, $precioCompra, $precioMinVenta, $precioVenta, $id]); # Pasar en el mismo orden de los ?

        $sentencia4 = $con->prepare("UPDATE auto_prov SET proveedor=? WHERE automovil=?");
        $resultado1 = $sentencia4->execute([$idp, $id]); # Pasar en el mismo orden de los ?

        $mensaje = "Actualizacion exitosa";
    } else {
        $mensaje = "No se pudo actualizar";
    }
} else {
    if ($fotoAuto["type"] == "image/jpg" or $fotoAuto["type"] == "image/jpeg") {
        $ima = $_FILES["foto_auto"]["tmp_name"];
        $ruta = "../img_vehiculos/" . $marca . "-" . $modelo;
        if (!file_exists($ruta)) {
            mkdir($ruta, true);
        }
        move_uploaded_file($ima, $ruta . "/" . $fotoAuto["name"]);

        $sentencia = $con->prepare("UPDATE vehiculo SET marca=?,tipo=?,modelo=?,fotovehiculo=? WHERE idvehiculo=? ");
        $resultado = $sentencia->execute([$marca, $tipo, $modelo, $ruta . "/" . $fotoAuto["name"], $id]); # Pasar en el mismo orden de los ?
        if ($resultado === true) {
            $query = $con->prepare("DELETE from color_vehiculo where automovil =?");
            $res = $query->execute([$id]); # Pasar en el mismo orden de los ?
            for ($i = 0; $i < sizeof($colores); $i++) {
                $sentencia2 = $con->prepare("INSERT INTO color_vehiculo(color,automovil) VALUES (?, ?);");
                $resultado = $sentencia2->execute([$colores[$i], $id]); # Pasar en el mismo orden de los ?
            }
            $sentencia3 = $con->prepare("UPDATE detalle_vehiculo SET numpas=?,cilindrada=?,precioproveedor=?,preciominimo=?,precioventa=? WHERE vehiculo=?");
            $resultado = $sentencia3->execute([$numpasaj, $cilindrada, $precioCompra, $precioMinVenta, $precioVenta, $id]); # Pasar en el mismo orden de los ?

            $sentencia4 = $con->prepare("UPDATE auto_prov SET proveedor=? WHERE automovil=?");
            $resultado1 = $sentencia4->execute([$idp, $id]); # Pasar en el mismo orden de los ?

            $mensaje = "Actualizacion exitosa";
        } else {
            $mensaje = "No se pudo actualizar";
        }
    } else {
        $mensaje = "Archivos con formato no permitido";
    }
}



echo $mensaje;
