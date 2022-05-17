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
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/css/estiloHome.css">
    <link rel="stylesheet"
        href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/css/estiloVentas.css">
    <title>Reporte_Venta</title>

</head>

<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
        $usuario = $_SESSION['usuario'];
        $tusu = $_SESSION['tipo'];
        $idusu = $_SESSION['idusuario'];
        if ($usuario == null || $usuario == "") {
            header("Location: ../scripts/cerrarSesion.php");
        }
    }
    $ventaB = $_GET['idVenta'];
    $venta = base64_decode($ventaB);
    include '../scripts/conexion.php';
    $sentencia = $con->prepare("SELECT dv.marca,dv.modelo,dv.tipo,dv.color,dv.nump,dv.precio,dv.tipo_venta,dv.contacto from detalle_venta dv
    where dv.venta =? ");
    $resultado = $sentencia->execute([(int)$venta]);
    $resultado = $sentencia->fetchAll();
    $contador = 0;

    ?>

    <div>
        <div class="container-fluid">
            <div class="row">
                <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/assets/logo.jpg" style="height:85px!important; width:85px !important;margin-top:25px!important;"
                    class="logoReporte col-1">
                <!--<div class="nombreEmpresa col-5"><b>ASC Motors</b></div>-->
                <div class="fecha col-4">
                    <b
                        style="font-size:14px!important;"><?php
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

                                                            echo obtenerFechaEnLetra($fecha) . "<br>" . "<br>" . "Codigo de Venta: " . $venta; ?></b>
                </div>

            </div>
            <div
                style="background-color: rgb(112, 40, 24);;height:4px; margin: left 50px; margin-right:50px; border-radius:4%;">
            </div>
        </div>
        <div class="row">
        <div class="col-md-4" style="font-weight:bold;font-size:14px; margin-left:300px;">
                <?php
                echo "<br><b>REPORTE DE VENTA<b>" ?>
            </div>
            <div class="col-md-4" style="font-size:14px!important; margin-left:70px; margin-top:10px;">
                <?php
                include '../scripts/conexion.php';
                $sentencia1 = $con->prepare("SELECT c.paterno,c.materno,c.nombre,c.cicliente,c.ciextcli from venta v 
                inner join cliente c
                on c.idcliente = v.cliente 
                where v.idventa =?");
                $resultado1 = $sentencia1->execute([(int)$venta]);
                $resultado1 = $sentencia1->fetchAll();
                echo "<br>Cliente:" . " " . $resultado1[0]["paterno"] . " " . $resultado1[0]["materno"] . " " . $resultado1[0]["nombre"]
                     . "&nbsp;&nbsp;&nbsp;&nbsp;CI:" . $resultado1[0]["cicliente"] . " " . $resultado1[0]["ciextcli"] ?>
                <?php
                include '../scripts/conexion.php';
                $sentencia2 = $con->prepare("SELECT u.paterno,u.materno,u.nombre from venta v 
                inner join usuario u ON 
                v.usuario = u.idusuario 
                where v.idventa =?");
                $resultado2 = $sentencia2->execute([(int)$venta]);
                $resultado2 = $sentencia2->fetchAll();
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ases@r: " . " " . $resultado2[0]["paterno"] . " " . $resultado2[0]["materno"] . " " . $resultado2[0]["nombre"];
                ?>
            </div>
            </div>
<br>

        </div>
            <div class="col-md-4" style="margin-left:70px;">
                <?php

                include '../scripts/conexion.php';
                $sentencia3 = $con->prepare("SELECT v.fecha,v.hora from venta v 
                   where v.idventa =?");
                $resultado3 = $sentencia3->execute([(int)$venta]);
                $resultado3 = $sentencia3->fetchAll();
                echo "Registrado el: " . " " . explode("-", $resultado3[0]["fecha"])[2] . "-" . explode("-", $resultado3[0]["fecha"])[1] . "-" . explode("-", $resultado3[0]["fecha"])[0]."&nbsp;&nbsp;a horas: ". $resultado3[0]["hora"];

                ?>
            </div>
        </div>

        <div class="container-fluid" style="margin-top:30px; margin-left:55px; margin-right:55px; ">
            <div class="table-responsive">
                <table class="table tablaReporte" style="margin-top: 30px; border-collapse:collapse; width:100%;">
                    <thead>
                        <tr class="" style="font-size:14px important;">

                            <th style="padding:5px;">#</th>
                            <th style="padding:5px;">Marca</th>
                            <th style="padding:5px;">Modelo</th>
                            <th style="padding:5px;">Tipo</th>
                            <th style="padding:5px;">Color</th>
                            <th style="padding:5px;">#Pas</th>
                            <th style="padding:5px;">Precio</th>
                            <th style="padding:5px;">Tipo Venta</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        foreach ($resultado as $ventas) :
                            $contador++;
                        ?>
                        <tr class="text-center"  style="font-size:13px important; text-align:center;">
                            <td style="padding:5px;"><?= $contador ?></td>
                            <td style="padding:5px;"><?= $ventas[0] ?></td>
                            <td style="padding:5px"><?= $ventas[1] ?></td>
                            <td style="padding:5px;"><?= $ventas[2] ?></td>
                            <td style="padding:5px;"><?= $ventas[3] ?></td>
                            <td style="padding:5px;"><?= $ventas[4] ?></td>
                            <td style="padding:5px;"><?= $ventas[5] . " " . "$" ?></td>
                            <td style="padding:5px;"><?= $ventas[6] ?></td>


                        </tr>

                        <?php
                        endforeach;
                        ?>
                        <tr style="background-color:rgb(34, 48, 37);">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr class="text-center" style="font-size:13px!important; text-align:center;">
                            <td style="padding:5px;" colspan="4"  style="font-size:10px!important; text-align:center;">
                                <b>
                                    Monto total de la venta:</b>

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td  style="font-size:13px!important; text-align:center;">
                                <b>
                                    <?php
                                    include '../scripts/conexion.php';
                                    $sentencia4 = $con->prepare("SELECT count(*),sum(dv.precio) from detalle_venta dv
            where dv.venta = ?");
                                    $resultado4 = $sentencia4->execute([(int)$venta]);
                                    $resultado4 = $sentencia4->fetchAll();
                                    echo $resultado4[0]["sum"] . " " . "$";
                                    ?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>

    </div>
</body>

</html>
<script type="text/php">
    if ( isset($pdf) ) {
    // OLD 
    $font = Font_Metrics::get_font("Arial", "normal");
    $pdf->page_text(960, 590, "{PAGE_NUM} de {PAGE_COUNT}", $font, 10, array(0,0,0));
    // v.0.7.0 and greater
    /*$x = 72;
    $y = 18;
    $text = "{PAGE_NUM} of {PAGE_COUNT}";
    $font = $fontMetrics->get_font("helvetica", "bold");
    $size = 6;
    $color = array(255,0,0);
    $word_space = 0.0;  //  default
    $char_space = 0.0;  //  default
    $angle = 0.0;   //  default
    $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);*/
}
</script>
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