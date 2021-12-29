<?php  
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../../index.php");
}
?>


<?php
include '../../conexion/conexion.php';
//captura la variable que viene de ajax paea generar los siguisntes campos
$q=$_POST['q'];


if ($q!=0) {
    # code...

$conn=conexion();

	 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM producto where idproducto = '$q'";
    $query = $conn->prepare($sql);
    $query->execute(array($q));

    $data = $query->fetch(PDO::FETCH_ASSOC);
    
    $precio = $data['preciounitario'];
    $cantidad = $data['cantidad'];

    ?>


<div class="form-group">
<label for="product_name" class="col-sm-2 control-label">Precio Producto $:</label>
<div class="col-sm-4">
<input type ='numeric' value='<?php echo $precio; ?> ' class='form-control' readonly name='precio' id='precio'>
</div>
<label for="presentation" class="col-sm-2 control-label">Cantidad Existente:</label>
<div class="col-sm-4">
<input type ='numeric' value='<?php echo $cantidad; ?> ' class='form-control' readonly name='cantidadexistente' id='cantidadexistente'>
                        
</div>
</div>







<?php
}else{


}


    




?>
