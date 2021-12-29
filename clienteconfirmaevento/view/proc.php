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
    $sql = "SELECT * FROM eventosespeciales where ideventosespeciales = '$q'";
    $query = $conn->prepare($sql);
    $query->execute(array($q));

    $data = $query->fetch(PDO::FETCH_ASSOC);
    
    $precio = $data['preciopersona'];


    ?>


<div class="form-group">
<label for="product_name" class="col-sm-3 control-label">Precio Persona $:</label>
<div class="col-sm-9">
<input type ='text' required value='<?php echo $precio; ?>' class='form-control' readonly name='mod_precio' id='mod_precio'>

</div>
</div>







<?php
}else{


}


    




?>
