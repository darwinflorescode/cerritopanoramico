<?php
//Incluye el archivo header donde se encuentra el menu de modulos del sistema
include("header.php");

//Verfica la session de ingreso del usuario
if (!$_SESSION["ok"]) {

    //Redirecciona al index,.php
    header("location:../");
}
?>


<div class="content-wrapper" style="min-height: 522px;">
    <section class="content-header">
        <?php if (!empty($_GET['denegado'])) {
            if ($_GET['denegado'] == "access") {
                # code...
        ?>
                <div class="alert bg-red alert-dismissable" style="width:90%;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Acceso Denegado a este usuario
                </div>


            <?php
            } else {
            }
        }

        if ($inicio1 == "inicio11") {
            # code...
            ?>

            <h1><i><b>Panel de Control</b></i>

                <small>Sistema de Restaurante Cerrito Panor&aacute;mico</small>
                <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>
                <span class="sr-only">Loading...</span>
            </h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Inicio</li>
            </ol>
            <!--Lerta de mensaje de stock del productos de produccion -->

            <?php
            $pd = $conn->prepare("SELECT * from producto where cantidad<10");

            $pd->execute();

            $prod = $pd->rowcount();
            if ($prod > 0) {
            ?>
                <div class="alert bg-red alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Existen productos que necesitan ser abastecidos. He aqui el detalle <a target="_blank" href="../pdf/detalleproducto.php?iddetalle=true" class="alert-link">Ver</a>

                </div>
            <?php


            }
            ?>


    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i>M&Oacute;DULOS</i></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>

                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <!-- <strong>Bienvenido Estimado Usuario: <font color="blue"><?php  ?></font></strong> -->
                                </p>

                                <!-- Inicio de imagenes de modulos del sistema del menu de inicio -->
                                <div class="table-responsive">

                                    <table>
                                        <tr>
                                            <td>

                                                <!-- Imagen de clientes-->
                                                <a href="../cliente/mostrar.php" data-toggle="tooltip" data-placement="top" title="Clientes">
                                                    <div id="" class="pull-left radius-5px" style=" margin: 1px; border: 1px solid #ddd;">
                                                        <div class="pull-left">
                                                            <img src="../imagenes/cliente.jpeg" width="140px">
                                                        </div>
                                                        <div class="pull-left" style=" width:75px;">
                                                            <div>
                                                                <h5>
                                                                    <font color="black">Clientes</font>
                                                                </h5>
                                                            </div>
                                                            <div>Agregar, Actualizar, Borrar y Buscar </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>

                                                <!-- Imagen de proveedores -->
                                                <a href="../proveedor/mostrar.php" data-toggle="tooltip" data-placement="top" title="Provedores">
                                                    <div id="" class="pull-left radius-5px" style="margin: 1px; border: 1px solid #ddd;">
                                                        <div class="pull-left">
                                                            <img src="../imagenes/proveedor.png" width="140px">
                                                        </div>
                                                        <div class="pull-left" style="width:75px;">
                                                            <div>
                                                                <h5>
                                                                    <font color="black">Proveedor</font>
                                                                </h5>
                                                            </div>
                                                            <div>Agregar, Actualizar, Borrar y Buscar </div>
                                                        </div>
                                                    </div>
                                                </a> </a>
                                            </td>

                                            <!--Imagen de produccion -->
                                            <td> <a href="../produccion/mostrar.php" data-toggle="tooltip" data-placement="bottom" title="Produccion">
                                                    <div id="" class="pull-left radius-5px" style="border: 1px solid #ddd;">
                                                        <div class="pull-left">
                                                            <img src="../imagenes/produccion.png" width="140px">
                                                        </div>
                                                        <div class="pull-left" style=" width:75px;">
                                                            <div>
                                                                <h5>
                                                                    <font color="black">Producción</font>
                                                                </h5>
                                                            </div>
                                                            <div>Agregar, Actualizar, Borrar y Buscar</div>
                                                        </div>
                                                    </div>
                                                </a> </td>

                                        </tr>
                                        <tr>
                                            <td><a href="../producto/mostrar.php" data-toggle="tooltip" data-placement="top" title="Producto">
                                                    <div class="pull-left radius-5px" style="border: 1px solid #ddd;">
                                                        <div class="pull-left">
                                                            <img src="../imagenes/producto.png" width="140px">
                                                        </div>
                                                        <div class="pull-left" style=" width:75px;">
                                                            <div>
                                                                <h5>
                                                                    <font color="black">Invetario</font>
                                                                </h5>
                                                            </div>
                                                            <div>Agregar, Actualizar, Borrar y Buscar </div>
                                                        </div>
                                                    </div>
                                                </a> </td>
                                            <td>
                                                <a href="../compra/nuevacompra.php" data-toggle="tooltip" data-placement="left" title="Compra">
                                                    <div class="pull-left radius-5px" style="border: 1px solid #ddd;">
                                                        <div class="pull-left">
                                                            <img src="../imagenes/venta.png" width="140px">
                                                        </div>
                                                        <div class="pull-left" style=" width:75px;">
                                                            <div>
                                                                <h5>
                                                                    <font color="black">Compras</font>
                                                                </h5>
                                                            </div>
                                                            <div>Agregar, mostrar, buscar, y descargar / imprimir</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td><a href="../usuario/mostrar.php" data-toggle="tooltip" data-placement="left" title="Usuario">
                                                    <div class="pull-left radius-5px" style="border: 1px solid #ddd;">
                                                        <div class="pull-left">
                                                            <img src="../imagenes/usuario1.jpg" width="140px">
                                                        </div>
                                                        <div class="pull-left" style=" width:75px;">
                                                            <div>
                                                                <h5>
                                                                    <font color="black">Usuarios</font>
                                                                </h5>
                                                            </div>
                                                            <div>Agregar, Actualizar, Borrar y Buscar </div>
                                                        </div>
                                                    </div>
                                                </a> </td>
                                        </tr>
                                        <tr>

                                            <td><a href="../venta/generarventa.php" data-toggle="tooltip" data-placement="top" title="Venta">
                                                    <div id="" class="pull-left radius-5px" style="border: 1px solid #ddd;">
                                                        <div class="pull-left">
                                                            <img src="../imagenes/ventas.jpg" width="140px">
                                                        </div>
                                                        <div class="pull-left" style=" width:75px;">
                                                            <div>
                                                                <h5>
                                                                    <font color="black">Ventas</font>
                                                                </h5>
                                                            </div>
                                                            <div>Agregar, mostrar, buscar, y descargar / imprimir</div>
                                                        </div>
                                                    </div>
                                                </a> </td>
                                            <td>
                                                <a href="../clienteconfirmaevento/mostrar.php" data-toggle="tooltip" data-placement="top" title="Detalle de Eventos especiales">
                                                    <div id="" class="pull-left radius-5px" style="border: 1px solid #ddd;">
                                                        <div class="pull-left">
                                                            <img src="../imagenes/evento.png" width="140px">
                                                        </div>
                                                        <div class="pull-left" style=" width:75px;">
                                                            <div>
                                                                <h5>
                                                                    <font color="black">Eventos Especiales</font>
                                                                </h5>
                                                            </div>
                                                            <div>Agregar Productos al detalle del evento.</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="../mesa/mostrar.php" data-toggle="tooltip" data-placement="top" title="Mesas">
                                                    <div id="" class="pull-left radius-5px" style="border: 1px solid #ddd;">
                                                        <div class="pull-left">
                                                            <img src="../imagenes/mesa.jpg" width="140px">
                                                        </div>
                                                        <div class="pull-left" style=" width:75px;">
                                                            <div>
                                                                <h5>
                                                                    <font color="black">Mesa</font>
                                                                </h5>
                                                            </div>
                                                            <div>Agregar, actualizar, buscar y mostrar</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>




                                    </table>
                                    <br>

                                </div>


                            </div>


                            <!-- cajitas que aparecen en el lado derecho del sistema -->
                            <div class="col-md-4">

                                <div class="info-box bg-purple">
                                    <span class="info-box-icon"><i class="fa fa-tags"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Inventario</span>
                                        <span class="info-box-number"><?php echo "<td>" . $t . "</td>"; ?></span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 100%"></div>
                                        </div>
                                        <span class="progress-description">
                                            <?php echo "<td>" . $totalp . " <font size='1'>productos con exitencia</font></td>"; ?> </span>
                                    </div>
                                </div>
                                <div class="info-box bg-green">
                                    <span class="info-box-icon"><i class="fa fa-money"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Ventas <?php echo $anno; ?></span>
                                        <span class="info-box-number">$ <?php echo '<td>' . number_format($totalv, 2) . '</td>'; ?></span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 100%"></div>
                                        </div>
                                        <span class="progress-description">
                                            Facturas : <?php echo "<td>" . $f . "</td>"; ?></span>
                                    </div>
                                </div>

                                <div class="info-box bg-aqua">
                                    <span class="info-box-icon"><i class="fa fa-users "></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Clientes</span>
                                        <span class="info-box-number"><?php echo "<td>" . $clientes . "</td>"; ?></span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 100%"></div>
                                        </div>
                                        <span class="progress-description">
                                            Clientes nuevos: <?php echo "<td>" . $to . "</td>"; ?></span>
                                    </div>
                                </div>
                                <div class="info-box bg-gray">
                                    <span class="info-box-icon"><i class="fa fa-truck"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Proveedores</span>
                                        <span class="info-box-number"><?php echo "<td>" . $pv . "</td>"; ?></span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 100%"></div>
                                        </div>
                                        <span class="progress-description">
                                            Provedores nuevos:<?php echo "<td>" . $gg . "</td>"; ?> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                    </div>
                </div>
            </div>
        </div>







    <?php  }

    ?>







    <?php if ($inicio2 == "inicio21") {
        # code...
    ?>


        <!-- Para inferior donde se muestrar otros modulos extras -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel bg-blue">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-database fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"></div>
                                <div>Backup</div>
                            </div>
                        </div>
                    </div>
                    <a href="../backup/generatebackup.php">
                        <div class="panel-footer">
                            <span class="pull-left">Copia de seguridad</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel bg-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-briefcase fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"></div>
                                <div>Tipo usuario</div>
                            </div>
                        </div>
                    </div>
                    <a href="../tipousuario/mostrar.php">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel bg-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-institution fa-5x"></i>
                            </div>

                            <div class="col-xs-9 text-right">
                                <div class="huge"></div>
                                <div>Perfil Restaurante</div>
                            </div>
                        </div>
                    </div>
                    <a href="../configcerrito/config.php">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel bg-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-suitcase fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"></div>
                                <div>Tipo Producto</div>
                            </div>
                        </div>
                    </div>
                    <a href="../tipoproducto/mostrar.php">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>


    <?php } ?>

    <?php if ($inicio3 == "inicio31") {
        # code...
    ?>

        <div class="row">

            <div class="col-md-8">

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">&Uacute;ltimas ventas</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">

                            <?php

                            //Query a la tabla con el inner join
                            $sql = "SELECT orden.idorden,orden.fechaorden,concat(cliente.nombre,' ',cliente.apellido) as nombrecliente,mesa.numeromesa,concat(mesero.nombre,' ',mesero.apellido) as nombremesero,concat(usuario.nombre,' ',usuario.apellido) nombreusuario,orden.estado FROM orden inner join cliente on orden.idcliente=cliente.idcliente INNER join mesa on orden.idmesa = mesa.idmesa INNER JOIN mesero on orden.idmesero = mesero.idmesero INNER JOIN usuario on orden.idusuario = usuario.idusuario  order by orden.idorden desc LIMIT 5 ";

                            $q = $conn->prepare($sql);
                            $q->execute();
                            //Ejecuta lel query
                            //Mostrar el tota de registros almaceados en el query
                            $total = $q->rowcount();
                            $model = array();
                            //Array
                            while ($rows = $q->fetch()) {
                                $model[] = $rows;
                            }



                            $qg = $conn->prepare("SELECT sum(subtotal) as tot FROM detalleorden");
                            $qg->execute();

                            $data = $qg->fetch(PDO::FETCH_ASSOC);

                            $t = $data['tot'];
                            $to = $t * 0.1;
                            $tota = $t + $to;

                            ?>


                            <!-- tabla dond mostramos los datos-->
                            <table class="table no-margin">

                                <thead>
                                    <tr>
                                        <!-- Encabezado de la tablas-->
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Nombre Cliente</th>
                                        <th>Mesa</th>
                                        <th>Nombre Mesero</th>
                                        <th>Nombre Usuario</th>
                                        <th>Total</th>
                                        <th>P/Cliente</th>
                                        <th>Cambio</th>
                                        <th>Estado</th>
                                </thead>
                                </tr>

                                <?php
                                //Si es mayor a cero hacemos el foreach para recorrer los datos almacenados
                                if ($total != 0) {
                                ?>
                                <?php
                                    $totalp = 0;
                                    foreach ($model as $row) {
                                        //Mostrar los datos en celdas y filas
                                        echo "<tr>";

                                        echo "<tbody>";
                                        echo "<td>" . $row['idorden'] . "</td>";
                                        echo "<td>" . $row['fechaorden'] . "</td>";
                                        echo "<td>" . $row['nombrecliente'] . "</td>";
                                        echo "<td><span class='badge label-primary'>" . $row['numeromesa'] . "</span></td>";
                                        echo "<td>" . $row['nombremesero'] . "</td>";
                                        echo "<td>" . $row['nombreusuario'] . "</td>";


                                        $consult = $conn->prepare("SELECT sum(subtotal) as totales FROM detalleorden where idorden = " . $row['idorden'] . "");
                                        $consult->execute();

                                        $daa = $consult->fetch(PDO::FETCH_ASSOC);

                                        $totals = $daa['totales'];

                                        $aporte = $totals * 0.1;
                                        $totalas = $totals + $aporte;
                                        $totalp += $totalas;

                                        echo "<td><span class='badge label-primary'><li class='glyphicon glyphicon-usd '></li> " . number_format($totalas, 2) . "</span></td>";

                                        $quert = $conn->prepare("SELECT * FROM pago where idorden = " . $row['idorden'] . "");
                                        $quert->execute();

                                        $pagodata = $quert->fetch(PDO::FETCH_ASSOC);


                                        $pagocliente = $pagodata['pagocliente'];
                                        $cambio = $pagodata['cambio'];

                                        if (($pagocliente == "") || ($cambio == "")) {
                                            echo "<td><span class='badge label-danger'><li class='glyphicon glyphicon-usd '></li> 0</span></td>";
                                            echo "<td><span class='badge label-danger'><li class='glyphicon glyphicon-usd '></li> 0</span></td>";
                                        } else {
                                            echo "<td><span class='badge label-success'><li class='glyphicon glyphicon-usd '></li> " . number_format($pagocliente, 2) . "</span></td>";
                                            echo "<td><span class='badge label-info'><li class='glyphicon glyphicon-usd '></li> " . number_format($cambio, 2) . "</span></td>";
                                        }






                                        $estadoventa = $row['estado'];

                                        if ($estadoventa == "Pendiente") {
                                            echo "<td><span class='badge label-danger'>" . $estadoventa . "</span></td>";
                                        } else {
                                            echo "<td><span class='badge label-success'>" . $estadoventa . "</span></td>";
                                        }





                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo '<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4 style="text-align: center;">Aviso!!!</h4><h5 style="text-align: center;">No hay datos para mostrar</h5> 
            </div>';
                                    echo "";
                                }

                                echo "</tbody>";
                                echo "</table>";

                                ?>





                                <!-- <table class="table no-margin">
<thead>
<tr>
<th>Factura Nº</th>
<th>Cliente</th>
<th>Fecha</th>
<th class="text-right">Total </th>
</tr>
</thead>
<tbody>
<tr>
<td><a href="#">474</a></td>
<td>daassss</td>
<td>28-08-2016</td>
<td class="text-right">57.82</td>
</tr>

</tbody>
</table> -->
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="../venta/generarventa.php" class="btn btn-sm btn-default btn-flat pull-left">Nueva venta</a>
                        <a href="../venta/mostrar.php" class="btn btn-sm btn-default btn-flat pull-right">Ver todas las ventas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Nuevos Eventos</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <?php
                    // consulta para poder seleccionar los nuevos registros de proveedores
                    $jj = $conn->prepare("SELECT * FROM eventosespeciales where preciopersona>0 order by ideventosespeciales DESC LIMIT 5");

                    $jj->execute();
                    $evenes = $jj->rowcount();





                    ?>




                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            <?php if ($evenes != 0) {
                                while ($row = $jj->fetch()) {

                            ?>

                                    <li class="item">
                                        <div class="product-img">
                                            <img src="../imagenes/evento.jpg" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <a href="../pdf/infoevent.php?idevento=<?php echo $row['ideventosespeciales']; ?>" target="_blank" data-toggle="tooltip" data-placement="left" title="Imprimir Evento!" class="product-title"><?php echo "<td>" . $row['opcion'] . "</td>"; ?><span class="label label-info pull-right">
                                                    <font size='3'><?php echo "<td>" . $row['ideventosespeciales'] . "</td>"; ?></font>
                                                </span></a>
                                            <span class="product-description">$ <?php echo "<td>" . $row['preciopersona'] . "</td>"; ?></span>
                                        </div>
                                    </li>


                            <?php

                                }
                            } else {
                                echo '<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4 style="text-align: center;">Aviso!!!</h4><h5 style="text-align: center;">No hay datos para mostrar</h5> 
            </div>';
                            }

                            ?>



                        </ul>
                    </div>
                    <div class="box-footer text-center">
                        <a href="../eventosespeciales/mostrar.php" class="uppercase">Ver todos los Eventos</a>
                    </div>
                </div>
            </div>
        </div>

    <?php }  ?>
    </section>


    <?php

    //Incluye el archivo footer donde se encuentra el copyright
    include("footer.php");

    ?>