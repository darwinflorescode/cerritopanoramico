<?php 
include '../../conexion/conexion.php';
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




 ?>


<!DOCTYPE html>
<html>
<head>
  <title>Detalle Producto</title>
  <link rel="shortcut icon" href="../../img/icono.ico" />
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


<button onclick="imprimir();" id="botom">Imprimir</button><form action="reportecortesia.php" method="POST">
  <input type="date" name="desde" value="<?php echo date('Y-m-d'); ?>">Hasta<input type="date" name="hasta" value="<?php echo date('Y-m-d'); ?>"><input type="submit" value="buscar">
  <a href="reportecortesia.php">Todos</a>
</form>
<center><h3>------- Detalle  de Cortesias aplicadas a clientes ------</h3>
<table width="100%" border="0" cellspacing="2" cellpadding="5">
  <tbody>
    <td bgcolor="#CCCCCC"><strong>Responsable</strong></td>
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
   echo date('d-m-Y g:i:s A'); ?></td>
  </tr>
<br>
</tbody></table>
-- - - - - - - - - -  - - - - - - - - - - --  - - - - - -- - - -<br>

<?php 

if (!empty($_POST)) {

  $desde=$_POST['desde'];
  $hasta=$_POST['hasta'];
   $command = "SELECT cortesia.*,usuario.nombre as nombrep,usuario.apellido as apell, cliente.nombre as nom,cliente.apellido as ape,mesa.numeromesa,concat(mesero.nombre,' ',mesero.apellido) as nombremesero FROM orden inner join usuario on 
    orden.idusuario= usuario.idusuario inner join cliente on orden.idcliente = cliente.idcliente inner join mesa on orden.idmesa = mesa.idmesa inner join mesero on orden.idmesero = mesero.idmesero inner join cortesia on orden.idorden=cortesia.idorden where cortesia.fechacortesia BETWEEN '$desde' AND '$hasta'";
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


}else{
    //Consulta a la tabla y le damos un limite
 $command = "SELECT cortesia.*,usuario.nombre as nombrep,usuario.apellido as apell, cliente.nombre as nom,cliente.apellido as ape,mesa.numeromesa,concat(mesero.nombre,' ',mesero.apellido) as nombremesero FROM orden inner join usuario on 
    orden.idusuario= usuario.idusuario inner join cliente on orden.idcliente = cliente.idcliente inner join mesa on orden.idmesa = mesa.idmesa inner join mesero on orden.idmesero = mesero.idmesero inner join cortesia on orden.idorden=cortesia.idorden where cortesia.idorden > 0";
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



}
 ?>
<table width="100%" border="0" cellpadding="2" cellspacing="0" class="table-list">

  <tbody>
   <tr>
   <td width="" height="22" bgcolor="#CCCCCC"><b> Fecha</b></td>
    <td width="" height="22" bgcolor="#CCCCCC"><b> Usuario</b></td>
        <td width="" height="22" bgcolor="#CCCCCC"><b> Cliente</b></td>
         <td width="" height="22" bgcolor="#CCCCCC"><b> Mesa</b></td>
          <td width="" height="22" bgcolor="#CCCCCC"><b> Mesero</b></td>
           <td width="" height="22" bgcolor="#CCCCCC"><b> Producto</b></td>
    <td width="" align="right" bgcolor="#CCCCCC"><b><b>Precio ($)</b></b></td>
    <td width="" align="center" bgcolor="#CCCCCC"><b>Cantidad</b></td>
    <td width="" align="right" bgcolor="#CCCCCC"><b>Total ($)</b></td>
  </tr>

  <?php
  if ($total!= 0) {
  
 $sumar=0;
  $sumarc=0;
  $sumarp=0;
   foreach($datoss as $row)
    {

    
$sw="SELECT * FROM producto where idproducto=".$row['idproducto'] ."";
$f= $conn->prepare($sw);
$f->execute();
$datas =$f->fetch();
$nombrepro=$datas['nombre'];


if ((($row['nom'] =="&") && ($row['ape'])=="&")) {
  $nombrecliente="No registrado";

}else{
  $nombrecliente=$row['nom']." ".$row['ape'];
}

     ?>
    <tr>
    <td><?php echo $row['fechacortesia'];?></td>

    <td><?php echo $row['nombrep']." ".$row['apell'];?></td>
    <td><?php echo $nombrecliente?></td>
    <td><?php echo $row['numeromesa'];?></td>
    <td><?php echo $row['nombremesero'];?></td>
    <td><?php echo $nombrepro;?></td>




    <td align="right">$ <?php echo $row['precio']; ?></td>
    <td align="center"><?php echo $row['cantidad']; ?></td>
    <td align="right">$ <?php echo $row['subtotal'];
   $sumar +=$row['subtotal'];
     $sumarc +=$row['cantidad'];
     $sumarp +=$row['precio'];
     ?></td>
  </tr>
     <?php  } ?>

  <tr>
    <td align="right" bgcolor="#F5F5F5" colspan="6"><strong>totales($) : </strong></td>
    <td align="right" bgcolor="#F5F5F5"><?php echo "$ ".number_format($sumarp,2); ?></td>
    <td align="center" bgcolor="#F5F5F5"><?php echo $sumarc; ?></td>
    <td align="right" bgcolor="#F5F5F5"><?php echo "$ ".number_format($sumar,2); ?></td>
  </tr> 

<?php 
  # code...
  }else{
    echo "No existe detalle de la cortesia";
  }

 ?>
</tbody></table>
</center>
<script type="text/javascript">
  function imprimir () {

    this.print();
  }
</script>
</body>
</html>



<?php 


 ?>
