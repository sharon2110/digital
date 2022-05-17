<?php
include('conexion.php');
include('verifica.php');

$numcarnet = $_POST["carnet_asesor"];
$extcarnet = $_POST["extension_asesor"];
$apaterno = $_POST["apellidoP_asesor"];
$amaterno = $_POST["apellidoM_asesor"];
$nombre = $_POST["nombre_asesor"];
$cel = $_POST["celular_asesor"];
$dir = $_POST["direccion_asesor"];
$usuario = $_POST["usuario_asesor"];
$tipo = $_POST["tipo_usu"];
$estado = $_POST["estado"];
$imagen = $_FILES["croquis"];
$docu = $_FILES["hojaVida"];
$ima = $_FILES["croquis"]["tmp_name"];
$doc = $_FILES["hojaVida"]["tmp_name"];
$ruta = "../documentos/" . $numcarnet;

if (!file_exists($ruta)) {
    mkdir($ruta, true);
}
$mensaje;

if (verificar_asesor($numcarnet, "usuario")) {
    $mensaje = "El usuario ya esta registrado";
} else {
    if (($imagen["type"] == "image/jpg" or $imagen["type"] == "image/jpeg") and $docu["type"] == "application/pdf") {
        move_uploaded_file($ima, $ruta . "/" . $imagen["name"]);
        move_uploaded_file($doc, $ruta . "/" . $docu["name"]);
        $sentencia = $con->prepare("INSERT INTO usuario(ciusuario,ciext,paterno,materno,
            nombre,celular,direccion,usuario,tipousuario,estado,curriculum,croquis,contrase_a) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $resultado = $sentencia->execute([
            $numcarnet, $extcarnet, $apaterno,
            $amaterno, $nombre, $cel, $dir, $usuario, $tipo, $estado, $ruta . "/" . $docu["name"], $ruta . "/" . $imagen["name"], password_hash($numcarnet, PASSWORD_BCRYPT)
        ]);
    } else {
        $mensaje = "Elija archivos";
    } # Pasar en el mismo orden de los ?


    if ($resultado === true) {
        $mensaje = "Registro exitoso";
    }
}
echo $mensaje;
