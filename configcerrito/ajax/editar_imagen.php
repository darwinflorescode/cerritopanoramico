 <style>
#imga {

    width: 200px;
  height: 225px;
}

</style>

<?php
session_start();
if (!$_SESSION["ok"]) {

//redirecciona al index.php del sistema o login si no existe la session
    header("location:../");

} else {

}
/* Connect To Database*/
require_once "../../conexion/conexion.php";
if (!empty($_FILES["imagefile"])) {

    $image_name    = time() . "_" . basename($_FILES["imagefile"]["name"]);
    $target_file   = $image_name;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $imageFileZise = $_FILES["imagefile"]["size"];
    /* Inicio Validacion*/
    // Allow certain file formats
    if (((($imageFileType == "jpg") || ($imageFileType == "JPG") || ($imageFileType == "JPEG") || ($imageFileType == "png") || ($imageFileType == "PNG") || ($imageFileType == "jpeg") || $imageFileType == "gif"))) {

        $image_name = addslashes(file_get_contents($_FILES['imagefile']['tmp_name']));

        $conn = conexion();
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql              = "UPDATE perfil SET logo = '$image_name' WHERE idperfil='1';";
        $oo               = $conn->prepare($sql);
        $query_new_insert = $oo->execute();
        if ($query_new_insert) {

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlr = "SELECT * FROM perfil where idperfil = '1'";
            $qu   = $conn->prepare($sqlr);

            $qu->execute(array());

            $dat = $qu->fetch();

            $logo = $dat['logo'];
            ?>

                        <img class="img-responsive" src="data:image/jpg;base64,<?php echo base64_encode($logo); ?>" id="imga">
                        <?php

        } else if ($imageFileZise > 1048576) {
//1048576 byte=1MB
            $errors[] = "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB</p>";
        } else {
            $errors[] = "<p>Lo sentimos, sólo se permiten archivos .ICO .</p>";
        }

    } else {

        $errors = "Lo sentimos, la actualización falló Error de formato. Intente nuevamente.";
    }

}

?>
    <?php
if (isset($errors)) {
    ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error! </strong>
        <?php

    echo "$errors";

    ?>
        </div>
    <?php
}
?>

