<?php 
//incluimos el archivo header del menu principal
include("../menu/header.php"); 
   if ($admin=="adminuser1") {

   }else{
    echo "<script>window.location='../menu/menu.php?denegado=access'</script>";
   }
?>

<div class="content-wrapper" style="min-height: 522px;">
 
<section class="content-header">

<div class="row">
<div class="col-xs-6">
<div class="input-group">
<!-- Imagen gifcargar-->
    <div id="loader" class="text-center"> <img src="../img/loader.gif"></div>
    <!-- formulario de busqueda de datos en tiempo real-->
      <form class="form-horizontal" accept-charset="utf-8"   autocomplete="off" role="form" >
            <table>
<tr><td>
<!-- Input para realizar l abusqueda-->
<input type="text" id="q" name="q"  class="form-control" size="60" onkeyup="load(1);"   placeholder="Busca por ID, Nombre, Apellido, E-mail, Usuario, Fecha , Tipo o Estado" id="q">
<span class="input-group-btn"></td><td>
         <!-- Botton de busqueda-->             
       <button  type="button" class="btn btn-default" onclick="load(1);"  title="Busca por ID, Nombre, Apellido, E-mail, Usuario, Fecha , Tipo o Estado"><span class="fa fa-search"></span></button>
                                </form>
                                </td><td>
           <div id="loader" style="position: absolute; text-align: center; top: 55px;  width: 100%;display:none;"></div><!-- Carga gif animado en la posicion indicada-->


                                </td></tr>

                                </table>



</span>
</div>
<!-- Javascript y ajax donde estan la funcione de eliminar y ediar para enviar los datos al modal utilizamos
editar.js -->
<script type="text/javascript" src="../lib/delete.js"></script>
<script type="text/javascript" src="../js/editar.js"></script>


<?php
//Mostrar mensajes alefitys 
//Si es almacenado muestra este mss
if (!empty($_GET['save'])) {

  $correcto = $_GET['save'];

  if ($correcto == "true") {

    ?>
    <body onload="save();"></body>
    <script>
      function save(){
        alertify.success("Excelente. Usuario almacenado");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php



//Si el email se repite 
  }elseif($correcto =="email"){
    
    ?>
    <body onload="email();"></body>
    <script>
      function email(){
        alertify.error("Error. El email digitado ya existe !");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php





// Si el usuario se repite
  }elseif($correcto =="user"){
        ?>
    <body onload="user();"></body>
    <script>
      function user(){
        alertify.error("Error. El usuario digitado ya existe !");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php





  }
  //Si es modificado correctamente
}elseif (!empty($_GET['modify'])) {

  $modificar = $_GET['modify'];

  if ($modificar == "true") {
       ?>
    <body onload="modificartrue();"></body>
    <script>
      function modificartrue(){
        alertify.success("Excelente. Datos modificados!");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php
    //Si no se cumple lo modificado
  }elseif ($modificar =="false"){

       ?>
    <body onload="modificarfalse();"></body>
    <script>
      function modificarfalse(){
        alertify.error("Error. Lo siento no pudo modificar datos!");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php

  }
  else{
    header("location:mostrar.php");
  }
  //Cuando se guardn los cambios de activar y descativar
}elseif (!empty($_GET['active'])) {

    $active = $_GET['active'];


    if ($active == "true") {
        ?>
    <body onload="activetrue();"></body>
    <script>
      function activetrue(){
        alertify.success("Excelente. Se guardaron los cambios!");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php
    }elseif ($active == "false") {
        ?>
    <body onload="activefalse();"></body>
    <script>
      function activefalse(){
        alertify.error("Error. Lo siento no se completó!");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php


    }else{
      header("mostrar.php");
    }

    //Cuando se cambia la contraseña
}elseif (!empty($_GET['change'])) {

  $password = $_GET['change'];

  if ($password =="true") {
    ?>
    <body onload="passtrue();"></body>
    <script>
      function passtrue(){
        alertify.success("Excelente. Nueva clave aplicada!");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php


//no se cambia la contraseña

  }elseif ($password =="false") {
   ?>
    <body onload="changefalse();"></body>
    <script>
      function changefalse(){
        alertify.error("Error. Lo siento!");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php
  }
}


?>
  

</div>

<div class="col-xs-6"></div>
<div class="col-xs-1">
<div id="loader" class="text-center"></div>
</div>
<!-- Botones de nuevo y mostrar todos os registros-->
<div class="col-xs-5 ">
<div class="btn-group pull-right">
<a href="mostrar.php" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Todos los Registros!"><li class="fa fa-eye"></li> Todo</a>
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_register" data-placement="bottom" title="Nuevo Registro!"><i class="fa fa-plus"></i> Nuevo</button>
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-placement="bottom" title="Cantidad de Registros a mostrar">
Cantidad a Mostrar 
<span class="caret"></span>
</button>
<ul class="dropdown-menu pull-right">
<li class="active" onclick="per_page(5);" id="5"><a href="mostrar.php#">5</a></li>
<li onclick="per_page(10);" id="10"><a href="mostrar.php#">10</a></li>
<li onclick="per_page(20);" id="20"><a href="mostrar.php#">20</a></li>
<li onclick="per_page(50);" id="50"><a href="mostrar.php#">50</a></li>
<li onclick="per_page(1000);" id="1000"><a href="mostrar.php#">Todos</a></li>
</ul>
<input type="hidden" id="per_page" value="5" >
</div>
</div>

</div>
</section>
 
<section class="content">

<div class="outer_div">
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header with-border">
<!-- Titulo de el box-->
<h3 class="box-title">Listado de usuario </h3>
</div> 
<div class="box-body">
<div class="table-responsive">
<!-- Aqui se carga la tabla con los datos mediante ajax-->
<div class="vertabla"></div>

</div>
</div>
</div>
</div>
</div>
</div>


</section> 
 

 
 <?php 
 //incluimos el archivo de busqueda donde se hacen las consultas
      require_once('view/userview.php');

    ?>
 <script>

  function per_page(valor){
    $("#per_page").val(valor);
    load(1);
    $('.dropdown-menu li' ).removeClass( "active" );
    $("#"+valor).addClass( "active" );
  }
 //Aqui se cargan los datos con esta funcion
  $(document).ready(function(){
    load(1);
  });
//Funcion load para cargar los datos de la busqueda
    function load(page){
      var q= $("#q").val();
      var per_page=$("#per_page").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        //Referenacia al archivo y enviar los paraetros
        url:'view/userview.php?action=ajax&page='+page+'&q='+q+'&per_page='+per_page,
         beforeSend: function(objeto){
          //para que cargue la imagen
         $('#loader').html('<img src="../img/loader.gif"> Cargando su busqueda...');
        },
        success:function(data){
          $(".vertabla").html(data).fadeIn('slow');
          $('#loader').html('');
          
        }
      })
    }
  </script>




 

<?php
//Incluimmos el footer de copyright
 include("../menu/footer.php"); ?>

