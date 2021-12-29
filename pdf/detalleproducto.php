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


//guardamos las sessiones en unas variables
$usuario = $_SESSION['usuario'];
$clave = $_SESSION['pass'];


 $sqls = "SELECT * FROM usuario where  usuario='$usuario' and clave = MD5('$clave')";
 $p = $conn->prepare($sqls);
    $p->execute();

    $datos = $p->fetch(PDO::FETCH_ASSOC);
    $nombress=$datos['nombre'].' '.$datos['apellido'];

if (@!empty($_GET['iddetalle'])) {
 $id = $_GET['iddetalle'];




if ($id=="true") {
  # code...

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Detalle Producto</title>
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



<center><h3>--- PRODUCTOS QUE NECESITA ABASTECER = 0  O  < 10 ---</h3>
<table width="100%" border="0" cellspacing="2" cellpadding="5">
  <tbody>
    <td bgcolor="#CCCCCC"><strong>Responsable en sistema</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>Nombre</b></td>
    <td>:</td>
    <td><?php echo $nombress; ?></td>
  </tr>
  
 <tr><td></td></tr>
  <tr>
    
    <td><?php  date_default_timezone_set('America/El_Salvador'); 
   echo "Fecha ".date('d-m-Y g:i:s A'); ?></td>
  </tr>
<br>
</tbody></table>
-- - - - - - - - - -  - - - - - - - - - - --  - - - - - -- - - -<br>

<?php 
    //Consulta a la tabla y le damos un limite
 $command = "SELECT producto.*,tipoproducto.nombre as nombre, producto.nombre as nombproducto, producto.estado, tipoproducto.idtipoproducto as idtipo FROM producto INNER JOIN tipoproducto ON producto.idtipoproducto = tipoproducto.idtipoproducto where cantidad<10";
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
  
    <td width="" height="22" bgcolor="#CCCCCC"><b> Producto</b></td>
    <td width="" align="right" bgcolor="#CCCCCC"><b><b>Precio ($)</b></b></td>
    <td width="" align="center" bgcolor="#CCCCCC"><b>Cantidad</b></td>
    <td width="" align="right" bgcolor="#CCCCCC"><b>Total ($)</b></td>
  </tr>

  <?php
  if ($total!= 0) {
  

   foreach($datoss as $row)
    { ?>
    <tr>
    
    <td><?php echo $row['nombproducto']; ?></td>
    <td align="right">$ <?php echo $row['preciounitario']; ?></td>
    <td align="center"><?php echo $row['cantidad']; ?></td>
    <td align="right">$ <?php echo $row['total'];
   
     ?></td>
  </tr>
     <?php  } ?>

  

<?php 
  # code...
  }else{
    echo "No existe detalle de producto";
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
   echo "<script>alert('Ha habido un error en el detalle!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;
}

}else{
   echo "<script>alert('Ha habido un error en el detalle!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;

}
 ?>
