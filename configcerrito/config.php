<?php

include "../menu/header.php";

 if ($configuracion=="configuracion1") {

   }else{
    echo "<script>window.location='../menu/menu.php?denegado=access'</script>";
   }
if (!$_SESSION["ok"]) {

//redirecciona al index.php del sistema o login si no existe la session
    header("location:../");

} else {

}

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM perfil where idperfil = '1'";
$q   = $conn->prepare($sql);

$q->execute();

$data = $q->fetch();

$nombre_empresa = $data['nombrerestaurante'];
$direccion      = $data['direccion'];
$departamento   = $data['departamento'];

$telefono = $data['telefonos'];
$email    = $data['correoelectronico'];
$logo_url = $data['logo'];
$favico_url = $data['favicon'];
$user_url = $data['imgenusers'];
$radios=$data['color'];

?>
 <style>
#imga {

 width: 200px;
  height: 225px;
}

#imgaa {

 width: 60px;
  height: 80px;
}

#imgas {

    width: 100px;
  height: 120px;
}

</style>
<div class="content-wrapper" style="min-height: 400px;">
<section class="content-header">

</section>

  <div class="form-panel">
    <div class="container-fluid">
      <div class="row">
      <form method="POST" action="ajax/editar_perfil.php">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >


          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><i class='glyphicon glyphicon-cog'></i> Configuración de El Restaurante Cerrito Panor&aacute;mico</h3>
            </div>
            <div class="panel-body">
              <div class="row">

                <div class="col-md-3 col-lg-3 " >
        <div id="load_img">
          <img class="img-responsive" src="data:image/jpg;base64,<?php echo base64_encode($logo_url); ?>" id="imga">
        </div>

          <div class="row">
              <div class="col-md-12">
              <div class="form-group">
                <input class='filestyle' data-buttonText="Logo" type="file" name="imagefile" id="imagefile" onchange="upload_image();">
              </div>
            </div>

          </div>
<br><br><br><br><br><br>
        <div id="loadd_img">
          <img class="img-responsive" src="data:image/jpg;base64,<?php echo base64_encode($favico_url); ?>" id="imgaa">
        </div>

          <div class="row">
              <div class="col-md-10">
              <div class="form-group">
                <input class='filestyle' data-buttonText=" Favicon" type="file" name="imagearchivo" id="imagearchivo" onchange="cargar_imagen();">
              </div>
            </div>

        </div>

        </div>

                <div class=" col-md-9 col-lg-9 ">
                  <table class="table table-condensed">
                    <tbody>
                      <tr>
                        <td class='col-md-3'>Nombre:</td>
                        <td><input type="text" class="form-control input-sm" name="nombre_restaurante" value="<?php echo $nombre_empresa ?>" required></td>
                      </tr>
                      <tr>
                        <td>Teléfono:</td>
                        <td><input type="text" class="form-control input-sm" name="telefono" value="<?php echo $telefono ?>" required></td>
                      </tr>
                      <tr>
                        <td>Correo electrónico:</td>
                        <td><input type="email" class="form-control input-sm" name="email" value="<?php echo $email ?>" ></td>
                      </tr>

            <tr>
                        <td>Dirección:</td>
                        <td><input type="text" class="form-control input-sm" name="direccion" value="<?php echo $direccion; ?>" required></td>
                      </tr>

            <tr>
                        <td>Departamento:</td>

                        <td><input type="text" class="form-control input-sm" name="departamento" value="<?php echo $departamento; ?>"></td>
                      </tr>
                       <tr>
                        <td>Color:</td>

                        <td>

                        <?php if ($radios=="red") {
                          $red='checked="true"';
                          $blue="";
                          $green="";
                          $yellow="";

                        }elseif ($radios=="blue") {
                           $red='';
                          $blue='checked="true"';
                          $green="";
                          $yellow="";
                        }elseif ($radios=="green") {
                           $red='';
                          $blue='';
                          $green='checked="true"';
                          $yellow="";
                        }
                        elseif ($radios=="yellow") {
                           $red='';
                          $blue='';
                          $green='';
                          $yellow='checked="true"';
                        }



                         ?>
                        <div class="control-group">
                <div class="controls">
                  <label class="radio">
                  <input type="radio" name="optionsRadios"  value="red" <?php echo $red; ?>>
                  <font color="red">Rojo</font>
                 
                  </label>
                  <label class="radio">
                  <input type="radio" name="optionsRadios"  value="blue" <?php echo $blue; ?>>
                  <font color="blue">Azul</font>
                  
                  </label>
                  <div style="clear:both"></div>
                  <label class="radio">
                  <input type="radio" name="optionsRadios" value="green" <?php echo $green; ?>>
                  <font color="green">Verde</font>
                  </label>
                  <label class="radio">
                  <input type="radio" name="optionsRadios"  value="yellow" <?php echo $yellow; ?>>
                  <font color="orange">Anaranjado</font>
                  
                  </label>
                </div>
                </div></td>
                      </tr>




                    </tbody>
                  </table>
                   <div id="loading_img">
          <img class="img-responsive" src="data:image/jpg;base64,<?php echo base64_encode($user_url); ?>" id="imgas">
        </div>

          <div class="row">
              <div class="col-md-3">
              <div class="form-group">
                <input class='filestyle' data-buttonText=" Usuario" type="file" name="userfile" id="userfile" onchange="user_image();">
              </div>
            </div>

          </div>

                </div>
        <div class='col-md-12' id="resultados_ajax"></div><!-- Carga los datos ajax -->
              </div>
            </div>
                 <div class="panel-footer text-center">

                            <button type="submit" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-refresh"></i> Actualizar datos</button>
                    </div>
          </div>
        </div>
    </form>
      </div>
      </div>
</div>





</section>

  <?php
include "../menu/footer.php"
?>

<script type="text/javascript" src="js/bootstrap-filestyle.js"> </script>


<script>
    function upload_image(){

        var inputFileImage = document.getElementById("imagefile");
        var file = inputFileImage.files[0];

        if( (typeof file === "object") && (file !== null) )
        {
          $("#load_img").text('Cargando...');
          var data = new FormData();
          data.append('imagefile',file);



          $.ajax({
            url: "ajax/editar_imagen.php",        // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: data,         // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
              $("#load_img").html(data);

            }
          });
        }


      }

      function cargar_imagen(){

        var inputFileImages = document.getElementById("imagearchivo");
        var filess = inputFileImages.files[0];

        if( (typeof filess === "object") && (filess !== null) )
        {
          $("#loadd_img").text('Cargando...');
          var data = new FormData();
          data.append('imagearchivo',filess);


          $.ajax({
            url: "ajax/editar.php",        // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: data,         // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
              $("#loadd_img").html(data);


            }
          });
        }


      }

       function user_image(){

        var inputFileImagess = document.getElementById("userfile");
        var filesss = inputFileImagess.files[0];

        if( (typeof filesss === "object") && (filesss !== null) )
        {
          $("#loading_img").text('Cargando...');
          var data = new FormData();
          data.append('userfile',filesss);


          $.ajax({
            url: "ajax/edituser.php",        // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: data,         // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
              $("#loading_img").html(data);


            }
          });
        }


      }
    </script>

