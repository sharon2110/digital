<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">


    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/css/all.css">
    <link rel="stylesheet" href="../views/css/sweetalert2.min.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/css/estiloHome.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/css/estiloTramites.css">
    <title>Detalle_Tramite</title>
</head>

<body>
    <?php
    session_start();
    $usuario = $_SESSION['usuario'];
    $tusu = $_SESSION['tipo'];
    $idusu = $_SESSION['idusuario'];
    $estado = $_SESSION['estado'];
    if ($usuario == null || $usuario == "" || $estado != "Activo") {
        header("Location: ../scripts/cerrarSesion.php");
    }
    $tramite = $_GET['idTramite'];
    include '../scripts/conexion.php';
    $sentencia = $con->prepare("SELECT dt.marca,dt.modelo,dt.tipo,dt.color,dt.nump,dt.precio from detalle_tramite dt 
    where dt.tramite =? ");
    $resultado = $sentencia->execute([$tramite]);
    $resultado = $sentencia->fetchAll();

    $sentencia1 = $con->prepare("SELECT e.estado,et.fecha from estado_tramite et 
    inner join estado e 
    on et.estado = e.idestado 
    where et.tramite = ?
    order by et.fecha desc");
    $resultado1 = $sentencia1->execute([$tramite]);
    $resultado1 = $sentencia1->fetchAll();

    ?>

    <div>
        <div class="container-fluid">
            <div class="row">
                <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/assets/logo.jpg" class="logoReporte col-1">
                <!--<div class="nombreEmpresa col-5"><b>ASC Motors</b></div>-->
                <div class="fecha col-4">
                    <b><?php
                        function obtenerFechaEnLetra($fecha)
                        {
                            $dia = conocerDiaSemanaFecha($fecha);
                            $num = date("j", strtotime($fecha));
                            $anno = date("Y", strtotime($fecha));
                            $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                            $mes = $mes[(date('m', strtotime($fecha)) * 1) - 1];
                            return $dia . ' ' . $num . ' de ' . $mes . ' del ' . $anno;
                        }

                        function conocerDiaSemanaFecha($fecha)
                        {
                            $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
                            $dia = $dias[date('w', strtotime($fecha))];
                            return $dia;
                        }
                        $fecha = gmdate('d-m-Y h:i:s a', time() - 25200);

                        echo obtenerFechaEnLetra($fecha) . "<br>" . "<br>" . "Codigo de Trámite: " . $tramite; ?></b>
                </div>

            </div>

        </div>

        <div class="container-fluid" style="margin-top:70px; margin-left:20px; margin-right:20px; ">
            <div style="margin-left:25px;"><b>&nbsp;&nbsp;&nbsp;Listado de Vehiculos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Historial de estados</b>


                <div class="table-responsive">
                    <table class="table tablaReporte" style="margin-top: 30px; margin-left:10px;border-collapse:collapse;">
                        <thead>
                            <tr class="text-center">
                                <th style="padding:5px;">Marca</th>
                                <th style="padding:5px;">Modelo</th>
                                <th style="padding:5px;">Tipo</th>
                                <th style="padding:5px;">Color</th>
                                <th style="padding:5px;">#Pas</th>
                                <th style="padding:5px;">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            foreach ($resultado as $detalle) :

                            ?>
                                <tr class="text-center">

                                    <td style="padding:5px;"><?= $detalle[0] ?></td>
                                    <td style="padding:5px"><?= $detalle[1] ?></td>
                                    <td style="padding:5px;"><?= $detalle[2] ?></td>
                                    <td style="padding:5px;"><?= $detalle[3] ?></td>
                                    <td style="padding:5px;"><?= $detalle[4] ?></td>
                                    <td style="padding:5px;"><?= $detalle[5] . " " . "$" ?></td>
                                </tr>
                                <tr style="background-color:rgb(79, 167, 113);">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>


                </div>


                <table class="table tablaEstado" style="margin-top: -95px; margin-left:500px; border-collapse:collapse;">
                    <thead>
                        <tr class="text-center">
                            <th style="padding:5px;">Estado</th>
                            <th style="padding:5px;">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultado1 as $estado) :

                        ?>
                            <tr class="text-center">

                                <td style="padding:5px;"><?= $estado[0] ?></td>
                                <td style="padding:5px"><?= explode("-", $estado[1])[2] . "-" . explode("-", $estado[1])[1] . "-" . explode("-", $estado[1])[0] ?></td>

                            </tr>
                            <tr style="background-color:rgb(217, 134, 67);">
                                <td></td>
                                <td></td>

                            </tr>
                    </tbody>
                <?php
                        endforeach;
                ?>

                </table>
            </div>



        </div>


        <div style="margin-top:70px;margin-left:50px;margin-right:0px; padding:10px; font-size:16px;font-style:bold;">
            <?php
            include '../scripts/conexion.php';
            $sentencia1 = $con->prepare("SELECT c.paterno,c.materno,c.nombre,c.cicliente,c.ciextcli from tramitebancario t 
                inner join cliente c
                on c.idcliente = t.cliente 
                where t.idtramitebancario =?");
            $resultado1 = $sentencia1->execute([$tramite]);
            $resultado1 = $sentencia1->fetchAll();
            echo "Cliente:" . " " . $resultado1[0]["paterno"] . " " . $resultado1[0]["materno"] . " " . $resultado1[0]["nombre"]
                . "<br>" . "<br>" . "CI:" . $resultado1[0]["cicliente"] . " " . $resultado1[0]["ciextcli"] ?>

            <div style="margin-top:15px;">
                <?php
                include '../scripts/conexion.php';
                $sentencia2 = $con->prepare("SELECT u.paterno,u.materno,u.nombre from tramitebancario t 
                inner join usuario u ON 
                t.usuario = u.idusuario 
                where t.idtramitebancario =?");
                $resultado2 = $sentencia2->execute([$tramite]);
                $resultado2 = $sentencia2->fetchAll();
                echo "Ases@r: " . " " . $resultado2[0]["paterno"] . " " . $resultado2[0]["materno"] . " " . $resultado2[0]["nombre"];
                ?>
            </div>


        </div>

</body>

</html>
<?php
$html = ob_get_clean();
require_once '../libreria/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf(['chroot' => __DIR__]);
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("reporteVenta.pdf", array("Attachment" => false));
?>