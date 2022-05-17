<?php
session_start();
$usuario = $_SESSION['usuario'];
$tusu = $_SESSION['tipo'];
$idusu = $_SESSION['idusuario'];
if ($usuario == null || $usuario == "") {
    header("Location: ../scripts/cerrarSesion.php");
}


?>

<section class="contenedorMenu">
    <div class="menuDesplegarMd">
        <figure class="contenedorAvatar">
            <i class="far fa-times-circle cerrarMenu mostrarBar"></i>
            
        </figure>
        <br>
        <nav class="contenidoMenu">
            <ul>
                
                    <li>
                        <span class="item-menu" href="#" id="mostrarSub" style="font-size: 16px;"><i class="fas fa-user-tie fa-fw"></i>&nbsp; Asesores <i class="fas fa-chevron-down"></i></span>
                        <ul class="sub-menu">
                            <li>
                                <a href="nuevoAsesor.php" style="font-size: 16px;"><i class="fas fa-plus fa-fw"></i>&nbsp; Registrar Asesor</a>
                            </li>
                            <li>
                                <a href="listaAsesores.php" style="font-size: 16px;"><i class="fas fa-clipboard-list fa-fw"></i>&nbsp;Lista de Asesores</a>
                            </li>
                        </ul>
                    </li>
               
                <li>
                    <span class="item-menu" href="#" id="mostrarSub" style="font-size: 16px;"><i class="fas fa-users fa-fw"></i>&nbsp; Clientes <i class="fas fa-chevron-down"></i></span>
                    <ul class="sub-menu">
                        <li>
                            <a href="nuevoCliente.php" style="font-size: 16px;"><i class="fas fa-plus fa-fw"></i> &nbsp; Registrar Cliente</a>
                        </li>
                        <li>
                            <a href="listaClientes.php" style="font-size: 16px;"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de clientes</a>
                        </li>
                        <li>
                            <a href="buscarCliente.php" style="font-size: 16px;"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar cliente</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <span class="item-menu" href="#" id="mostrarSub" style="font-size: 16px;"><i class="fas fa-hand-holding-usd fa-fw"></i>&nbsp;Ventas <i class="fas fa-chevron-down"></i></span>
                    <ul class="sub-menu">
                        <li>
                            <a href="nuevaVenta.php" style="font-size: 16px;"><i class="fas fa-plus fa-fw"></i>&nbsp; Registrar Venta</a>
                        </li>
                        <li>
                            <a href="listaVenta.php" style="font-size: 16px;"><i class="fas fa-clipboard-list fa-fw"></i>&nbsp; Lista de Ventas</a>
                        </li>
                        <li>
                            <a href="buscaVenta.php" style="font-size: 16px;"><i class="fas fa-search fa-fw"></i>&nbsp; Busca Venta</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <span class="item-menu" href="#" id="mostrarSub" style="font-size: 16px;"><i class="fas fa-file-invoice-dollar fa-fw"></i>&nbsp; Créditos<i class="fas fa-chevron-down"></i></span>
                    <ul class="sub-menu">
                        <li>
                            <a href="nuevoCredito.php" style="font-size: 16px;"><i class="fas fa-plus fa-fw"></i>&nbsp; Nuevo trámite</a>
                        </li>
                        <li>
                            <a href="listaTramites.php" style="font-size: 16px;"><i class="fas fa-clipboard-list fa-fw"></i>&nbsp;Lista Trámites</a>
                        </li>
                        <li>
                            <a href="buscaTramite.php" style="font-size: 16px;"><i class="fas fa-search fa-fw"></i>&nbsp;&nbsp;&nbsp;Buscar Trámite</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <span class="item-menu" href="#" id="mostrarSub" style="font-size: 16px;"><i class="fas fa-car"></i>&nbsp; Vehículos<i class="fas fa-chevron-down"></i></span>
                    <ul class="sub-menu">
                    
                            <li>
                                <a href="nuevaMovilidad.php" style="font-size: 16px;"><i class="fas fa-plus fa-fw"></i> &nbsp; Registrar vehículo</a>
                            </li>
                            <li>
                                <a href="listaMovilidad.php" style="font-size: 16px;"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de vehículos</a>
                            </li>
                            <li>
                                <a href="busquedaMovilidad.php" style="font-size: 16px;"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar vehículo</a>
                            </li>
                     
                            <li>
                                <a href="listaMovilidad.php" style="font-size: 16px;"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de vehículos</a>
                            </li>
                            <li>
                                <a href="busquedaMovilidad.php" style="font-size: 16px;"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar vehículo</a>
                            </li>
                    </ul>
                </li>


                <li hidden>
                    <span class="item-menu" href="#" id="mostrarSub" style="font-size: 16px;"><i class="fas fa-balance-scale-left"></i>&nbsp; Finanzas<i class="fas fa-chevron-down"></i></span>
                    <ul class="sub-menu">
                        <li>
                            <a href="pagoSueldo.php" style="font-size: 16px;"><i class="fas fa-plus fa-fw"></i> &nbsp; Registrar Pago Sueldo</a>
                        </li>
                        <li>
                            <a href="pagoBono.php" style="font-size: 16px;"><i class="fab fa-btc"></i> &nbsp; Registrar Pago Bono</a>
                        </li>
                        <li>
                            <a href="pagoProveedor.php" style="font-size: 16px;"><i class="fas fa-id-card"></i> &nbsp; Registrar Pago Proveedor</a>
                        </li>
                        <li>
                            <a href="verPagos.php" style="font-size: 16px;"><i class="fas fa-dice-d6"></i> &nbsp; Ver Pagos</a>
                        </li>
                    </ul>
                </li>
   
            </ul>
        </nav>
    </div>
</section>