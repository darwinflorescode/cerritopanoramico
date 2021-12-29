<?php 
include '../conexion/conexion.php';
$conn = conexion();
session_start();
if (!$_SESSION["ok"])

{

//redirecciona al index.php del sistema o login si no existe la session
  header("location:../");

}else{

}



if (@!empty($_GET['idpedido'])) {
 $id = $_GET['idpedido'];

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT orden.*,usuario.nombre as nombrep,usuario.apellido as apell, cliente.nombre as nom,cliente.apellido as ape,cliente.email,cliente.direccion,cliente.telefono,cliente.dui,mesa.numeromesa,concat(mesero.nombre,' ',mesero.apellido) as nombremesero FROM orden inner join usuario on 
    orden.idusuario= usuario.idusuario inner join cliente on orden.idcliente = cliente.idcliente inner join mesa on orden.idmesa = mesa.idmesa inner join mesero on orden.idmesero = mesero.idmesero where idorden = $id";
    $q = $conn->prepare($sql);
    $q->execute(array($id));

    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nombres=$data['nombrep']." ".$data['apell'];
    $numeromesa= $data['numeromesa'];
    $nombremesero=$data['nombremesero'];
    $pendiente=$data['estado'];



    if ((($data['nom']) =="&") && (($data['ape'])=="&")) {
 $nombrescompleto ="________________________________<br>";
 $cliente ="Cliente no registrado ";
}else{
  $nombrescompleto=$data['nom']." ".$data['ape'];
  $cliente =$nombrescompleto;
}
   
    $rowcount = $q->rowcount();


    if ($rowcount==0)
    {
    echo "<script>alert('Ha habido un error en el pedido!!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;

    }




 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Pedido</title>
  <link rel="shortcut icon" href="../img/icono.ico" />
	<style type="text/css">
		body,td,th {
	font-family: Courier New, Courier, monospace;
}
body{
	margin:0px auto 0px;
	padding:3px;
	font-size:15px;
	color:#333;
	width:95%;
	background-position:top;
	background-color:#fff;
}
.table-list {
	clear: both;
	text-align: left;
	border-collapse: collapse;
	margin: 0px 0px 10px 0px;
	background:#fff;	
}
.table-list td {
	color: #333;
	font-size:15px;
	border-color: #fff;
	border-collapse: collapse;
	vertical-align: center;
	padding: 3px 5px;
	border-bottom:1px #CCCCCC solid;
}
	</style>
</head>

<body>



<center><h1>------- Detalle  Pedido  ------</h1>
<table width="100%" border="0" cellspacing="2" cellpadding="5">
  <tbody>
    <td bgcolor="#CCCCCC"><strong>CLIENTE</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>Pedido #</b></td>
    <td>:</td>
    <td><?php echo $_GET['idpedido']; ?></td>
  </tr>
  <tr>
    <td><b>Nombre Cliente</b></td>
    <td>:</td>
    <td><?php echo $cliente; ?></td>
  </tr>
  <tr>
    <td><b>Mesa #</b></td>
    <td>:</td>
    <td><?php echo $numeromesa; ?></td>
  </tr>
  <tr>
    <td><strong>Mesero</strong></td>
    <td>:</td>
    <td><?php echo $nombremesero; ?></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFF99"><b>Estado de Pedido </b></td>
    <td>:</td>
    <td><?php echo $pendiente; ?> * </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    
  </tr>
  <tr>
    <td bgcolor="#ffff88"><b>Responsable Pedido </b></td>
    <td>:</td>
    <td>* <?php echo $nombres; ?> </td>
    <td><?php  date_default_timezone_set('America/El_Salvador'); 
   echo date('d-m-Y g:i:s A'); ?></td>
  </tr>
<br>
</tbody></table>
-- - - - - - - - - -  - - - - - - - - - - --  - - - - - -- - - -<br>

<?php 
    //Consulta a la tabla y le damos un limite
 $command = "SELECT detalleorden.cantidad,producto.nombre as nombrepr,producto.descripcion as descri,detalleorden.precioactual,detalleorden.subtotal FROM detalleorden inner join producto
  on detalleorden.idproducto = producto.idproducto WHERE idorden = '$id'";
//Conexion donde ejecuta
$resultado = $conn->prepare($command);
$resultado->execute();
//Total de registros encontrados
$total = $resultado->rowcount();
//array
$data = array();

//Estructura ciclica de repeticion
while($rowss = $resultado->fetch())
{
    $datoss[] = $rowss;
}

 ?>
<table width="100%" border="0" cellpadding="2" cellspacing="0" class="table-list">

  <tbody>
   <tr>
  
    <td width="" height="22" bgcolor="#CCCCCC"><b>Descripci&oacute;n Producto</b></td>
    <td width="" align="right" bgcolor="#CCCCCC"><b><b>Precio ($)</b></b></td>
    <td width="" align="center" bgcolor="#CCCCCC"><b>Cantidad</b></td>
    <td width="" align="right" bgcolor="#CCCCCC"><b>Total ($)</b></td>
  </tr>

  <?php
  if ($total!= 0) {
  
  $sumar=0;
   foreach($datoss as $row)
    { ?>
    <tr>
    
    <td><?php echo $row['nombrepr']; ?></td>
    <td align="right">$ <?php echo $row['precioactual']; ?></td>
    <td align="center"><?php echo $row['cantidad']; ?></td>
    <td align="right">$ <?php echo $row['subtotal'];
    $sumar +=$row['subtotal'];
     ?></td>
  </tr>
     <?php  } ?>

  <tr>
    <td colspan="3" align="right" bgcolor="#F5F5F5"><strong>Subtotal ($) : </strong></td>
    <td align="right" bgcolor="#F5F5F5"><?php echo "$ ".number_format($sumar,2); ?></td>
  </tr>
  <tr>
    <td colspan="3" align="right"><strong>Mesero 10%  ($) : </strong></td>
    <td align="right"><?php $mese=$sumar*0.1; echo "$ ".number_format($mese,2); ?></td>
  </tr>
  <tr>
    <td colspan="3" align="right" bgcolor="#F5F5F5"><strong>TOTAL PAGAR ($) : </strong></td>
    <td align="right" bgcolor="#F5F5F5"><?php echo "$ ".number_format($sumar+$mese,2); ?></td>
  </tr>
<?php 
  # code...
  }else{
    echo "No existe detalle al pedido";
  }

 ?>
</tbody></table>
</center>
<script type="text/javascript">
  this.print();
</script>
</body>
</html>



<?php 

}else{
   echo "<script>alert('Ha habido un error en el pedido!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;

}
 ?>