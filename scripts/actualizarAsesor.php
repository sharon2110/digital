<?php
session_start();
$usuario = $_SESSION['usuario'];
$tusu = $_SESSION['tipo'];
$idusu = $_SESSION['idusuario'];
if ($usuario == null || $usuario == "") {
    header("Location: ../scripts/cerrarSesion.php");
}

include('conexion.php');
include('verifica.php');
$id = $_POST["idUsu"];
$numcarnet = $_POST["carnet_asesor"];
$extcarnet = $_POST["extension_asesor"];
$apaterno = $_POST["apellidoP_asesor"];
$amaterno = $_POST["apellidoM_asesor"];
$nombre = $_POST["nombre_asesor"];
$cel = $_POST["celular_asesor"];
$dir = $_POST["direccion_asesor"];
$usuarioN = $_POST["usuario_asesor"];
$tipoUsuN = $_POST["tipo_usu"];
$estado = $_POST["estado"];
$docu = $_FILES["hojaVida"];
$croquis = $_FILES["croquis"];
$nomdocu = $docu["name"];
$nomima = $croquis["name"];
$verificaCroquis = $_POST["verificaCroquis"];
$mensaje;


function verificar($id, $tabla)
{
    include('conexion.php');
    $sql = "SELECT * FROM $tabla where idusuario = :id";
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();
    if (count($resultado) > 0) {
        return true;
    } else {
        return false;
    }
}
if (verificar($id, "usuario")) {
    if ($nomdocu !== "") {
        //SE CAMBIO CURRICULUM
        if ($nomima == "") {
            if ($verificaCroquis == "croquis") {
                //SE CAMBIO CURRICULUM PERO NO CROQUIS
                $doc = $_FILES["hojaVida"]["tmp_name"];
                $ruta = "../documentos/" . $numcarnet;
                if (!file_exists($ruta)) {
                    mkdir($ruta, true);
                }
                move_uploaded_file($doc, $ruta . "/" . $nomdocu);
                $sql = "UPDATE usuario SET ciusuario=?, ciext=?, paterno=?,materno=?, nombre=?, celular=?, direccion=?, usuario=?, tipousuario=?, estado=?,curriculum=? WHERE idusuario=?";
                $sentencia = $con->prepare($sql);
                $resultado = $sentencia->execute([$numcarnet, $extcarnet, $apaterno, $amaterno, $nombre, $cel, $dir, $usuarioN, $tipoUsuN, $estado,  $ruta . "/" . $nomdocu, $id]);
                if ($resultado === true) {
                    $mensaje = "Actualizacion exitosa";
                } else {
                    $mensaje = "No se pudo actualizar";
                }
            } else {
                //CON CURRICULUM PERO SIN CROQUIS
                $doc = $_FILES["hojaVida"]["tmp_name"];
                $ruta = "../documentos/" . $numcarnet;
                if (!file_exists($ruta)) {
                    mkdir($ruta, true);
                }
                move_uploaded_file($doc, $ruta . "/" . $nomdocu);
                $sql = "UPDATE usuario SET ciusuario=?, ciext=?, paterno=?,materno=?, nombre=?, celular=?, direccion=?, usuario=?, tipousuario=?, estado=?,curriculum=?,croquis=? WHERE idusuario=?";
                $sentencia = $con->prepare($sql);
                $resultado = $sentencia->execute([$numcarnet, $extcarnet, $apaterno, $amaterno, $nombre, $cel, $dir, $usuarioN, $tipoUsuN, $estado,  $ruta . "/" . $nomdocu, null, $id]);
                if ($resultado === true) {
                    $mensaje = "Actualizacion exitosa";
                } else {
                    $mensaje = "No se pudo actualizar";
                }
            }
        } else {
            //SE CAMBIO CURRICULUM Y CROQUIS
            $ima = $_FILES["croquis"]["tmp_name"];
            $doc = $_FILES["hojaVida"]["tmp_name"];
            $ruta = "../documentos/" . $numcarnet;
            if (!file_exists($ruta)) {
                mkdir($ruta, true);
            }
            move_uploaded_file($ima, $ruta . "/" . $nomima);
            move_uploaded_file($doc, $ruta . "/" . $nomdocu);

            $sql = "UPDATE usuario SET ciusuario=?, ciext=?, paterno=?,materno=?, nombre=?, celular=?, direccion=?, usuario=?, tipousuario=?, estado=?,curriculum=?,croquis=? WHERE idusuario=?";
            $sentencia = $con->prepare($sql);
            $resultado = $sentencia->execute([
                $numcarnet, $extcarnet, $apaterno,
                $amaterno, $nombre, $cel, $dir, $usuarioN, $tipoUsuN, $estado, $ruta . "/" . $nomdocu, $ruta . "/" . $nomima, $id
            ]); # Pasar en el mismo orden de los ?
            if ($resultado === true) {
                $mensaje = "Actualizacion exitosa";
            }
        }
    } else {
        //NO SE CAMBIO CURRICULUM
        if ($nomima == "") {
                if ($verificaCroquis == "croquis") {
                    //NO SE CAMBIO CURRICULUM NI CROQUIS 
                    $sql = "UPDATE usuario SET ciusuario=?, ciext=?, paterno=?,materno=?, nombre=?, celular=?, direccion=?, usuario=?, tipousuario=?, estado=? WHERE idusuario=?";
                    $sentencia = $con->prepare($sql);
                    $resultado = $sentencia->execute([$numcarnet, $extcarnet, $apaterno, $amaterno, $nombre, $cel, $dir, $usuarioN, $tipoUsuN, $estado, $id]);
                    if ($resultado === true) {
                        $mensaje = "Actualizacion exitosa";
                    } else {
                        $mensaje = "No se pudo actualizar";
                    }
                } else {
                    //NO SE CAMBIO CURRICULUM CROQUIS VACIO
                    $sql = "UPDATE usuario SET ciusuario=?, ciext=?, paterno=?,materno=?, nombre=?, celular=?, direccion=?, usuario=?, tipousuario=?, estado=?,croquis=? WHERE idusuario=?";
                    $sentencia = $con->prepare($sql);
                    $resultado = $sentencia->execute([$numcarnet, $extcarnet, $apaterno, $amaterno, $nombre, $cel, $dir, $usuarioN, $tipoUsuN, $estado, null, $id]);
                    if ($resultado === true) {
                        $mensaje = "Actualizacion exitosa";
                    } else {
                        $mensaje = "No se pudo actualizar";
                    }
                }
        } else {
                //NO SE CAMBIO CURRICULUM PERO SI CROQUIS

                $ima = $_FILES["croquis"]["tmp_name"];
                $ruta = "../documentos/" . $numcarnet;
                if (!file_exists($ruta)) {
                    mkdir($ruta, true);
                }
                move_uploaded_file($ima, $ruta . "/" . $nomima);

                $sql = "UPDATE usuario SET ciusuario=?, ciext=?, paterno=?,materno=?, nombre=?, celular=?, direccion=?, usuario=?, tipousuario=?, estado=?,croquis=? WHERE idusuario=?";
                $sentencia = $con->prepare($sql);
                $resultado = $sentencia->execute([
                    $numcarnet, $extcarnet, $apaterno,
                    $amaterno, $nombre, $cel, $dir, $usuarioN, $tipoUsuN, $estado, $ruta . "/" . $nomima, $id
                ]); # Pasar en el mismo orden de los ?
                if ($resultado === true) {
                    $mensaje = "Actualizacion exitosa";
                }
            }
        
    }
} else {
    $mensaje = "Usuario no encontrado";
}
echo $mensaje;
