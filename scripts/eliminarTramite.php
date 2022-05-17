<?php

include('conexion.php');
include('verifica.php');

$id = $_POST["idtramite"];
function verificar_estado($id)
{
    include('conexion.php');
    $sql = "SELECT estado,hora FROM estado_tramite where tramite =:id and hora=(select max(hora) from estado_tramite 
    where tramite =:id) and estado='5'";
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
if (!verificar_estado($id)) {
    echo "No se puede eliminar";
} else {
    $sql2 = 'SELECT idfolder FROM folder WHERE tramite = :id';
    $sentencia2 = $con->prepare($sql2);
    $sentencia2->bindParam(':id', $id, PDO::PARAM_INT);
    $resultado2 = $sentencia2->execute();
    $folders = $sentencia2->fetchAll();
    $idfolderC = $folders[0]["idfolder"];
    $idfolderG = $folders[1]["idfolder"];

    $sql2 = 'SELECT idlistafolder FROM lista_folder WHERE folder = :folder';
    $sentencia2 = $con->prepare($sql2);
    $sentencia2->bindParam(':folder', $idfolderC, PDO::PARAM_INT);
    $resultado2 = $sentencia2->execute();
    $resultado2 = $sentencia2->fetch();
    $idListaC = $resultado2["idlistafolder"];

    $sql2 = 'SELECT idlistafolder FROM lista_folder WHERE folder = :folder';
    $sentencia2 = $con->prepare($sql2);
    $sentencia2->bindParam(':folder', $idfolderG, PDO::PARAM_INT);
    $resultado2 = $sentencia2->execute();
    $resultado2 = $sentencia2->fetch();
    $idListaG = $resultado2["idlistafolder"];

    $sql = 'DELETE FROM lista_deuda_banco
    WHERE listafolder = :folderC';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':folderC', $idfolderC, PDO::PARAM_INT);
    $resultado = $sentencia->execute();

    $sql = 'DELETE FROM lista_deuda_banco
    WHERE listafolder = :folderG';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':folderG', $idfolderG, PDO::PARAM_INT);
    $resultado = $sentencia->execute();

    $sql = 'DELETE FROM deuda_banco_folder
    WHERE folder = :folderC';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':folderC', $idfolderC, PDO::PARAM_INT);
    $resultado = $sentencia->execute();

    $sql = 'DELETE FROM deuda_banco_folder
    WHERE folder = :folderG';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':folderG', $idfolderG, PDO::PARAM_INT);
    $resultado = $sentencia->execute();

    $sql = 'DELETE FROM lista_folder
    WHERE folder = :folderC';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':folderC', $idfolderC, PDO::PARAM_INT);
    $resultado = $sentencia->execute();

    $sql = 'DELETE FROM lista_folder
    WHERE folder = :folderG';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':folderG', $idfolderG, PDO::PARAM_INT);
    $resultado = $sentencia->execute();

    $sql = 'DELETE FROM folder
    WHERE tramite = :tramite';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':tramite', $id, PDO::PARAM_INT);
    $resultado = $sentencia->execute();

    $sql = 'DELETE FROM detalle_tramite
    WHERE tramite = :tramite';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':tramite', $id, PDO::PARAM_INT);
    $resultado = $sentencia->execute();

    $sql = 'DELETE FROM estado_tramite
    WHERE tramite = :tramite';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':tramite', $id, PDO::PARAM_INT);
    $resultado = $sentencia->execute();

    $sql = 'DELETE FROM tramitebancario t
    WHERE t.idtramitebancario = :tramite';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':tramite', $id, PDO::PARAM_INT);
    $resultado = $sentencia->execute();

    if ($resultado === true) {
        $mensaje = "Eliminado";
    }
    $sql = 'SELECT t.cliente, t.banco FROM tramitebancario t
    WHERE t.idtramitebancario = :tramite';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':tramite', $id, PDO::PARAM_INT);
    $resultado = $sentencia->execute();
    $datos= $sentencia->fetchAll();

    $ruta = "../tramites/" . $datos[0]['cliente'] . "-" . $datos[0]['banco'];

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
