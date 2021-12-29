<?php include("../menu/header.php");
   if ($inventario=="inventario1") {

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
  <!-- Este input nos servira para los datos que  usted desea guardar y busca por la variable 'q' que agarra toda la consulta -->
<input type="text" id="q" name="q"  class="form-control" size="60" onkeyup="load(1);" placeholder="Busca por ID, Fecha producci&oacute;n, fecha vencimiento o nombre producto">
<span class="input-group-btn"></td><td>

  <!-- Busquueda pro medio del botton -->                                               
<button  type="button" class="btn btn-default" onclick="load(1);" title="Busca por ID, Fecha producci&oacute;n, fecha vencimiento o nombre producto"><span class="fa fa-search"></span></button>
                                </form>
                                </td></tr>

                                </table>



</span>
</div>

<?php
if (!empty($_GET['save'])) {

  $correcto = $_GET['save'];

  if ($correcto == "true") {

    ?>
    <body onload="save();"></body>
    <script>
      function save(){
        alertify.success("Excelente. Producción registrada");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php




  }elseif($correcto =="false"){
    
    ?>
    <body onload="dui();"></body>
    <script>
      function dui(){
        alertify.error("Error. El producto existe en producción !");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php






  }elseif($correcto =="error"){
        ?>
    <body onload="error();"></body>
    <script>
      function error(){
        alertify.error("Error. Existe un error en el proceso!");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php





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



?>

</div>

<div class="col-xs-6"></div>
<div class="col-xs-1">
<div id="loader" class="text-center"></div>
</div>
<div class="col-xs-5 ">
<div class="btn-group pull-right">
<a href="mostrar.php" class="btn btn-default"><li class="fa fa-eye"></li> Todo</a>
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#produccion_modal"><i class="fa fa-plus"></i> Nuevo</button>
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
<h3 class="box-title">Listado de producci&oacute;n </h3>
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
include 'modales.php';
 //sirve para requerir la viewproveedor
      require_once('view/viewproduccion.php');

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
  //Esta funcion  es para relizar la actualizacion de datos usando la variable de consulta 'q' que esta en viewproveedor.php

    function load(page){
      var q= $("#q").val();
       var per_page=$("#per_page").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'view/viewproduccion.php?action=ajax&page='+page+'&q='+q+'&per_page='+per_page,
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

