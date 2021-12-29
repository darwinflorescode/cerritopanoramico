<?php include("../menu/header.php");

   if ($contacto=="contacto1") {

   }else{
    echo "<script>window.location='../menu/menu.php?denegado=access'</script>";
   }

 ?>

<div class="content-wrapper" style="min-height: 522px;">
 
<section class="content-header">

<div class="row">
<div class="col-xs-6">
<div class="input-group">
    <div id="loader" class="text-center"> <img src="../img/loader.gif"></div>
      <form class="form-horizontal" accept-charset="utf-8"   autocomplete="off" role="form" >
            <table>
<tr><td>
  <!-- Este input fuciona para colocar por que datos quiere que busque.-->
<input type="text" id="q" name="q"  class="form-control" size="60" onkeyup="load(1);"   placeholder="Busca por ID, nombre, c&oacute;digo, tel&eacute;fono, direcci&oacute;n, nombrecontacto, tel&eacute;fonocontacto , estado" id="q">
<span class="input-group-btn"></td><td>
                                                 
       <button  type="button" class="btn btn-default" onclick="load(1);"  title="Busca por ID, nombre, c&oacute;digo, tel&eacute;fono, direcci&oacute;n, nombrecontacto, tel&eacute;fono , estado"><span class="fa fa-search"></span></button>
                                </form>
                                </td><td>
           

                                </table>



</span>
</div>


<?php
//Esta if sirve si los datos estan guardados dara una alerta de mensaje.
if (!empty($_GET['message'])) {

  $correcto = $_GET['message'];

  if ($correcto == "true") {

    ?>
    <body onload="save();"></body>
    <script>
      function save(){
        alertify.success("Excelente. Proveedor almacenado");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php


//Esto sirve para devolcer un error si existe el nombre

  }

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
}

//Esta if sirve para activar los datos obteniendalos por el metodo get
if (!empty($_GET['active'])) {

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
//Esta if sirve para si el activar del metodo get es falso entonces no guaradara los cambios
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
}
}

?>

</div>

<div class="col-xs-6"></div>
<div class="col-xs-1">
<div id="loader" class="text-center"></div>
</div>
<div class="col-xs-5 ">
<div class="btn-group pull-right">
<a href="mostrar.php" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Todos los Registros!"><li class="fa fa-eye"></li> Todo</a>
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#proveedor_modal" data-placement="bottom" title="Nuevo Registro!"><i class="fa fa-plus"></i> Nuevo</button>
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
<h3 class="box-title">Listado de proveedores </h3>
</div> 
<div class="box-body">
<div class="table-responsive">

<div class="vertabla"></div>
<br>

</div>

</div>
</div>
</div>
</div>
</div>


</section> 


 
 <?php 

 //sirve para requerir la viewproveedor
      require_once('view/viewproveedor.php');

    ?>
 <script>

  function per_page(valor){
    $("#per_page").val(valor);
    load(1);
    $('.dropdown-menu li' ).removeClass( "active" );
    $("#"+valor).addClass( "active" );
  }

  $(document).ready(function(){
    load(1);
  });
  //Esta fincio es para relizar la actualizacion de datos usando la variable de consulta 'q' que esta en viewproveedor.php

    function load(page){
      var q= $("#q").val();
      var per_page=$("#per_page").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'view/viewproveedor.php?action=ajax&page='+page+'&q='+q+'&per_page='+per_page,
         beforeSend: function(objeto){
         $('#loader').html('<img src="../img/loader.gif"> Cargando su busqueda...');
        },
        success:function(data){
          $(".vertabla").html(data).fadeIn('slow');
          $('#loader').html('');
          
        }
      })
    }
  </script>




 

<?php include("../menu/footer.php"); ?>

