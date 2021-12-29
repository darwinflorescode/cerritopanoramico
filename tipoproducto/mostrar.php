<?php
//Incluye el archivo header para mostrar el menu de los modulos del sistema
 include("../menu/header.php");
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

<!-- Cargar imagen gif -->
    <div id="loader" class="text-center"> <img src="../img/loader.gif"></div>
    <!-- Formulario de busqueda en tiempo real -->
      <form class="form-horizontal" accept-charset="utf-8"   autocomplete="off" role="form" >
            <table>
<tr><td>

<!-- Input para ingresar los datos de busqueda

llamando a la funcion load() de ajax para hacer la busqueda respectiva -->

<input type="text" id="q"  class="form-control" size="30" onkeyup="load(1);"   placeholder="Busca por ID, nombre y Fecha" id="q">
<span class="input-group-btn"></td><td>
                     <!--Botton para hacer click y generar la bsqueda respectiva de los datos ingresado en el input text q -->                            
       <button  type="button" class="btn btn-default" onclick="load(1);"  title="Buscar Registros Por ID, Nombre y Fecha"><span class="fa fa-search"></span></button>
                                </form>
                                </td><td>
           <div id="loader" style="position: absolute; text-align: center; top: 55px;  width: 100%;display:none;"></div>
           <!-- Carga gif animado de acuerdo en esta posicion -->


                                </td></tr>

                                </table>



</span>
</div>
<!-- js odonde se encuentran la funciones de eliminar y Editar mediante ajax y javascript. Ajax se utiliza en el editar
para enviar los datos al modal -->
<script type="text/javascript" src="../lib/delete.js"></script>
<script type="text/javascript" src="../js/editar.js"></script>

<?php
//Incluye los modales de guardar, edtar etc
include 'modales.php';


?>

</div>
<div class="col-xs-6"></div>
<div class="col-xs-1">
<div id="loader" class="text-center"></div>
</div>
<div class="col-xs-5 ">

<!-- Botton de nuevo y mostrar todo -->
<div class="btn-group pull-right">
<a href="mostrar.php" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Todos los Registros!"><li class="fa fa-eye"></li> Todo</a>
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_tipoproducto"  data-placement="bottom" title="Nuevo Registro!"><i class="fa fa-plus"></i> Nuevo</button>
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

<!-- Caja de estilos -->
<h3 class="box-title">Listado de tipos de producto </h3>
</div> 
<div class="box-body">
<div class="table-responsive">
<!-- Enn este div llamamos los datos o carga los datos en una tabla mediante el ajax -->
<div class="tableview"></div>


<!-- cargando datos de busqueda-->
</div>
</div>
</div>
</div>
</div>
</div>


</section> 








  <?php 
  //Requerimos el archivo donde se encuentra la consulta de busqueda
      require_once('viewproductype/productype.php');

    ?>
    
<!--Ajax para cargar los datos en tiempo real -->
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


//funcion para crear la busqueda en tiempo real 
    function load(page){
      var q= $("#q").val();
      var per_page=$("#per_page").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        //Enviando parametros de bbusqueda a la consulta mediante el ajax
        url:'viewproductype/productype.php?action=ajax&page='+page+'&q='+q+'&per_page='+per_page,
         beforeSend: function(objeto){
          //Cargando gif
         $('#loader').html('<img src="../img/loader.gif"> Cargando su busqueda...');
        },
        success:function(data){
          //Div tabla
          $(".tableview").html(data).fadeIn('slow');
          $('#loader').html('');
          
        }
      })
    }
  </script>

<?php

//Inclui el footer archivo de copyright
 include("../menu/footer.php"); ?>