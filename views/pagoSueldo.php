<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/sweetalert2.min.css">
    <link rel="stylesheet" href="./css/estiloHome.css">
    <link rel="stylesheet" href="./css/estiloPagoSueldo.css">
    <title>Pago_Sueldo</title>
</head>

<body>
    <main class="contenedorPrincipal">
        <section class="contenedorMenu">
            <?php include "./inc/navlateral.php"?>
        </section>


        <section class="navbar aside">
            <?php include "./inc/navbar.php"?>

            <!-- OPCIONES RAPIDAS-->
            <div class="container-fluid">
                <ul class="opciones">
                    <li>
                        <a class="active" href="pagoSueldo.php"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR PAGO DE SUELDO</a>
                    </li>
                    <li>
                        <a href="pagoBono.php"><i class="fab fa-btc"></i> &nbsp; REGISTRAR PAGO DE BONO</a>
                    </li>
                    <li>
                        <a href="pagoProveedor.php"><i class="fas fa-id-card"></i> &nbsp; REGISTRAR PAGO A PROVEEDOR</a>
                    </li>
                    <li>
                        <a href="verPagos.php"><i class="fas fa-dice-d6"></i> &nbsp; VER PAGOS</a>
                    </li>
                </ul>
            </div>

            <!-- TABLA REGISTRO-->
            <div class="container-fluid">
                <form action="" class="formularioPago" autocomplete="off">
                    <fieldset>
                        <legend><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo Pago de Sueldo</legend>
                        <div class="container-fluid">
                            <div class="row datosEmpleado">
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="empleado" class="bmd-label-floating">Empleado</label>
                                        <select class="form-select" aria-label="Default select example">
                                          <option selected>Seleccionar</option>
                                          <option value="1">Ana Perez</option>
                                          <option value="2">Maria Choque</option>
                                       </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <br>
                                    <div class="form-group">
                                        <label for="ci_empleado" class="bmd-label-floating"><b>CI</b></label>
                                        <label for="ci_empleado" class="bmd-label-floating">12605976 L.P</label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <label for="pago_sueldo" class="bmd-label-floating">Monto Pago</label>
                                        <input type="text" pattern="[0-9.]{5,6}" class="form-control" name="pago_sueldo" id="pago_sueldo input" maxlength="6" required>
                                    </div>
                                </div>
                                <div class="col-2 col-md-2">
                                <br>
                                    <div class="form-group">
                                        <label for="moneda_sueldo" class="bmd-label-floating">Bs.</label>
                                    </div>
                                </div>
                               
                                <div class="col-12 col-md-4 justify-content-center calendario">
                                <br><br>
                                        <label for="fecha">Fecha:</label>&nbsp;
                                        <input type="date" id="start" name="trip-start" value="2022-01-20" min="2021-10-01" max="2030-12-31">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <p class="text-center" style="margin-top: 30px;">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> &nbsp; GUARDAR</button>
                    </p>
                </form>
            </div>
        </section>
    </main>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/home.js"></script>
</body>

</html>