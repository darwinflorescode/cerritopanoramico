<?php 
//incluimos el archivo header del menu principal
include("../menu/header.php"); 
 if ($compra=="compras1") {

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
<input type="text" id="q" name="q"  class="form-control" size="60" onkeyup="load(1);"   placeholder="Busca por  ID, Fecha, Nombre Proveedor,  Nombre Apellido Usuario" id="q">
<span class="input-group-btn"></td><td>
         <!-- Botton de busqueda-->             
       <button  type="button" class="btn btn-default" onclick="load(1);"  title="Busca por ID, Fecha, Nombre Proveedor,  Nombre Apellido Usuario"><span class="fa fa-search"></span></button>
                                </form>
                                </td><td>
           <div id="loader" style="position: absolute; text-align: center; top: 55px;  width: 100%;display:none;"></div><!-- Carga gif animado en la posicion indicada-->


                                </td></tr>

                                </table>



</span>
</div><br>
<!-- Javascript y ajax donde estan la funcione de eliminar y ediar para enviar los datos al modal utilizamos
editar.js -->


<script src="../js/print.js"></script>




</div>

<div class="col-xs-6"></div>
<div class="col-xs-1">
<div id="loader" class="text-center"></div>
</div>
<!-- Botones de nuevo y mostrar todos os registros-->
<div class="col-xs-5 ">
<div class="btn-group pull-right">
<a href="mostrar.php" class="btn btn-default"><li class="fa fa-eye"></li> Todo</a>
<a class="btn btn-default"  href="nuevacompra.php" ><i class="fa fa-plus"></i> Nuevo</a>
<button type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown" 
aria-haspopup="true" aria-expanded="false" data-placement="bottom" title="Cantidad de Registros a mostrar!">
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
<h3 class="box-title">Listado de Compras </h3>
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
</div>

</section> 
</div> 

 
 <?php 
 //incluimos el archivo de busqueda donde se hacen las consultas
      require_once('view/viewshop.php');

    ?>
 <script>
  function per_page(valor){
    $("#per_page").val(valor);
    load(1);
    $('.dropdown-menu li' ).removeClass( "active" );
    $("#"+valor).addClass( "active" );
  }
 //funcion para cargarr los datos
  $(document).ready(function(){
    load(1);
  });

    function load(page){
      var q= $("#q").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'view/viewshop.php?action=ajax&page='+page+'&q='+q+'&per_page='+per_page,
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




 

<?php
//Incluimmos el footer de copyright
 include("../menu/footer.php"); ?>

