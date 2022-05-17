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
    <link rel="stylesheet" href="./css/estiloVerPagos.css">
    <title>Ver_Pagos</title>
</head>

<body>
    <main class="contenedorPrincipal">
        <section class="contenedorMenu">
        <?php include "./inc/navlateral.php"?>
        </section>


        <section class="navbar">
        <?php include "./inc/navbar.php"?>

            <!-- OPCIONES RAPIDAS-->
            <div class="container-fluid">
                <ul class="opciones">
                <li>
                        <a href="pagoSueldo.php"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR PAGO DE SUELDO</a>
                    </li>
                    <li>
                        <a href="pagoBono.php"><i class="fab fa-btc"></i> &nbsp; REGISTRAR PAGO DE BONO</a>
                    </li>
                    <li>
                        <a href="pagoProveedor.php"><i class="fas fa-id-card"></i> &nbsp; REGISTRAR PAGO A PROVEEDOR</a>
                    </li>
                    <li>
                        <a class="active" href="verPagos.php"><i class="fas fa-dice-d6"></i> &nbsp; VER PAGOS</a>
                    </li>
                </ul>
            </div>

          
                <div class="container-fluid" style="width:100%;">
                    <div class="row filtro">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="filtro_pagos_mes" class="bmd-label-floating"><b>Mes</b></label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="1">Todos</option>
                                        <option value="2">Enero</option>
                                        <option value="3">Febrero</option>
                                        <option value="4">Marzo</option>
                                        <option value="5">Abril</option>
                                        <option value="6">Mayo</option>
                                        <option value="7">Junio</option>
                                    </select>             
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="filtro_pagos_anio" class="bmd-label-floating"><b>Año</b></label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="1">2021</option>
                                        <option value="2">2022</option>
                                        <option value="3">2023</option>
                                        <option value="4">2024</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <button type="submit" class="btn btn-success" style="margin-top: 25px; width:100%;">Ver Movimientos</button>
                        </div>
                    </div>
                </div> 
                 <!-- TABLA LISTADO-->
            <div class="container-fluid">
                <div class="table-responsive contenedorTabla">
                    <table class="table table-sm tabla">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Tipo</th>
                                <th>A favor de</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Detalle</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>1</td>
                                <td>Sueldo</td>
                                <td>Sharon Tinta Alvarez</td>
                                <td>21/10/2021</td>
                                <td>2.000 Bs.</td>
                                <td>Pago de sueldo del mes de Diciembre</td>
                                <td>
                                    <form action="">
                                        <button type="button" class="btn botonElimina">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td>2</td>
                                <td>Bono</td>
                                <td>Sharon Tinta Alvarez</td>
                                <td>20/12/2021</td>
                                <td>300 Bs.</td>
                                <td>Bono por venta</td>
                                <td>
                                    <form action="">
                                        <button type="button" class="btn botonElimina">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row" style="width:100%; margin-left:20px; margin-right:20px;">
                    <div class="col-12 col-md-3">
                        <div class="form-group ">
                        <label for="entrada_venta" class="bmd-label-floating"><b>Entrada por Ventas</b></label>
                        <input type="text" pattern="[0-9]{5,12}" class="form-control" name="entrada_venta" id="entrada_venta input" maxlength="12" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                        <label for="salida_sueldos" class="bmd-label-floating"><b>Salida por Sueldos</b></label>
                        <input type="text" pattern="[0-9]{5,12}" class="form-control" name="salida_sueldos" id="salida_sueldos input" maxlength="12" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                        <label for="salida_bonos" class="bmd-label-floating"><b>Salida por Bonos</b></label>
                        <input type="text" pattern="[0-9]{5,12}" class="form-control" name="salida_bonos" id="salida_bonos input" maxlength="12" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                        <label for="salida_prov" class="bmd-label-floating"><b>Salida por Pago Prov.</b></label>
                        <input type="text" pattern="[0-9]{5,12}" class="form-control" name="salida_prov" id="salida_prov input" maxlength="12" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 saldo">
                        <div class="form-group">
                        <label for="saldo" class="bmd-label-floating"><b>SALDO</b></label>
                        <input type="text" pattern="[0-9]{5,12}" class="form-control" name="saldo" id="saldo input" maxlength="12" readonly>
                        </div>
                    </div>
                </div>  

                <div class="col-12 col-md-12">
                <nav aria-label="Page navigation example" class="paginador">
                    <br>
                    <ul class="pagination justify-content-center ">
                        <a class="page-link disabled atras" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        <li class="page-item numpag"><a class="page-link" href="#">1</a></li>
                        <li class="page-item numpag"><a class="page-link" href="#">2</a></li>
                        <li class="page-item numpag"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link adelante" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                </div>
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