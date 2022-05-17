<?php
    if (isset($_POST['usuario'], $_POST['pass'])) :
        require_once '../scripts/conexion.php';
        $usua = trim($_POST["usuario"]);
        $pass = trim($_POST["pass"]);
        $estado = "Activo";
        $sentencia = $con->prepare("SELECT * FROM usuario WHERE usuario = :u and estado=:e;");
        $sentencia->bindParam(':u', $usua, PDO::PARAM_STR);
        $sentencia->bindParam(':e', $estado, PDO::PARAM_STR);
        $resultado = $sentencia->execute(); # Pasar en el mismo orden de los ?
        $resultado = $sentencia->fetchAll();
        $hash = $resultado[0]["contrase_a"];
        $totalreg = $sentencia->rowCount();
        if ($totalreg > 0) {
            if(password_verify($pass,$hash)){
                $usuario = $resultado[0]["usuario"];
                $tipousu = $resultado[0]["tipousuario"];
                $idusu= $resultado[0]["idusuario"];
                $estado= $resultado[0]["estado"];
                $perfil = $resultado[0]["perfil"];
                session_start();
                $_SESSION['usuario']=$usuario;
                $_SESSION['tipo']=$tipousu;
                $_SESSION['idusuario']=$idusu;
                $_SESSION['estado']=$estado;
                $_SESSION['perfil-us']=$perfil;
                echo "SI";
            }else{
               if(strval($pass)===strval($hash)){
                $usuario = $resultado[0]["usuario"];
                $tipousu = $resultado[0]["tipousuario"];
                $idusu= $resultado[0]["idusuario"];
                $estado= $resultado[0]["estado"];
                $perfil = $resultado[0]["perfil"];
                session_start();
                $_SESSION['usuario']=$usuario;
                $_SESSION['tipo']=$tipousu;
                $_SESSION['idusuario']=$idusu;
                $_SESSION['estado']=$estado;
                $_SESSION['perfil-us']=$perfil;
                 echo "SI";
               }else{
                echo "NO";
               }

            }
        } else {
            echo "NO";
        }
    else:    echo "NO";
    endif;
    ?>
        