<?php
//Incuimos menu principal del sistema
include("../menu/header.php");

   if ($configuracion=="configuracion1") {

   }else{
    echo "<script>window.location='../menu/menu.php?denegado=access'</script>";
   }
?>
<div class="content-wrapper" style="min-height: 400px;">
 
<section class="content-header">
<h1>  <i>Generar copia de seguridad de Base de Datos</i></h1>
</section>

<section class="content">
<div class="row">
<div class="col-md-3">
 
<div class="box box-primary">
<div class="box-body box-profile">
<div id="load_img">
<img class="img-responsive"  style="height:225px;" src="../imagenes/cerrito.png" class="img-circle" alt="User Image">
</div>

<p class="text-muted text-center mail-text">Restaurante Cerrito Panor&aacute;mico</p>
</div>
 
</div>
 
</div>
 
<div class="col-md-6">
<form class="form-horizontal" action="generatebackup.php" accept-charset="utf-8"   autocomplete="off" role="form" method="post"  name="profi">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="" data-toggle="tab" aria-expanded="true">Copia de seguridad</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="form-group">
<label for="name" class="col-sm-3 control-label">Usuario:</label>
<div class="col-sm-9">
<input type="text" class="form-control" required  name="users" placeholder="Ingrese su usuario" >
</div>
</div>
<div class="form-group">
<label for="number_id" class="col-sm-3 control-label">Contrase&ntilde;a:</label>
<div class="col-sm-9">
<input type="password" class="form-control" required  name="passw" placeholder="Ingrese su contraseña" value="">
</div>
</div>


<div class="form-group">
<div class="col-sm-offset-3 col-sm-9">
<button type="submit" class="btn btn-primary" ><span class="fa fa-database"></span> Generar Backup</button>

</div>

</div>

</form>


<?php 
if (!empty($_POST['users']) && !empty($_POST['passw'])) {

	$userr= $_POST['users'];
	$passwr = $_POST['passw'];

//Consulta para verificar si es el administrador
  $quer = $conn->prepare("SELECT * FROM usuario  where usuario = '$userr' and clave = MD5('$passwr') and isadmin=1");
     $quer->execute();

     $rowcount = $quer->rowcount();



if ($rowcount) {
  //conexion a db
	$con = mysqli_connect("localhost","root","","db_cerrito");


$tables = array();
$query = mysqli_query($con, 'SHOW TABLES');
while($row = mysqli_fetch_row($query)){
     $tables[] = $row[0];
}

$result = "";
foreach($tables as $table){
$query = mysqli_query($con, 'SELECT * FROM '.$table);
$num_fields = mysqli_num_fields($query);

$result .= 'DROP TABLE IF EXISTS '.$table.'; SET FOREIGN_KEY_CHECKS=0;';
$row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE '.$table));
$result .= "\n\n".$row2[1].";\n\n";

for ($i = 0; $i < $num_fields; $i++) {
while($row = mysqli_fetch_row($query)){
   $result .= 'INSERT INTO '.$table.' VALUES(';
     for($j=0; $j<$num_fields; $j++){
       $row[$j] = addslashes($row[$j]);
       $row[$j] = str_replace("\n","\\n",$row[$j]);
       if(isset($row[$j])){
       $result .= "'".$row[$j]."'" ; 
    }else{ 
      $result .= '""';
    }
    if($j<($num_fields-1)){ 
      $result .= ',';
    }
    }
    $result .= ");\n";
}
}
$result .="SET FOREIGN_KEY_CHECKS=1;\n\n";
}


//Create Folder
$folder = 'copiasDB/';
if (!is_dir($folder))
mkdir($folder, 0777, true);
chmod($folder, 0777);

date_default_timezone_set('America/El_Salvador'); 

$date = date('d-m-Y'); 
$filename = $folder."restaurante_".$date; 

$handle = fopen($filename.'.sql','w+');
fwrite($handle,$result);
fclose($handle);









 ?>
<div class="form-group">
<div class="col-sm-offset-3 col-sm-9"> <div class="alert bg-green alert-dismissable">
 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  Excelente. Backup se gener&oacute; con exito. En carpeta <?php echo $filename.".sql"; ?></a>
</div> </div>
<div class="form-group">
<div class="col-sm-offset-3 col-sm-9">
<a href="<?php echo $filename.".sql"; ?>" class="btn btn-success" ><span class="fa fa-download"> </span>  Descargar</a>

</div>



<?php }else{
	echo '<div class="form-group">
<div class="col-sm-offset-3 col-sm-9"> <div class="alert bg-red alert-dismissable">
 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  Error en sus datos ingresados</a>
</div> </div>
';
} 




}?>

</div>
</div>
 
 
</div>
 
</div>
 





</div>
 

</section> 


<?php

//incluimos el copyright
include("../menu/footer.php");

?>