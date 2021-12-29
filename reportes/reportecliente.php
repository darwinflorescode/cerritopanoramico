<?php
//Incluimos el menu principal de el sistema
 include("../menu/header.php");
 if ($reporte=="reporte1") {

   }else{
    echo "<script>window.location='../menu/menu.php?denegado=access'</script>";
   }

  ?>
 <script src="../js/print.js"></script>

<div class="content-wrapper" style="min-height: 522px;">
<section class="content-header">
<div class="row">

<div class="col-xs-3">
<div class="input-group">
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
<input type="date" value="<?php date_default_timezone_set('America/El_Salvador');  echo date('Y-m-d'); ?>" id="desde" class="form-control pull-right"   required>
</div> 
</div>
<div class="col-xs-1">
<div class="input-group">
<h5><b>HASTA</b></h5>
</div> 
</div>

<div class="col-xs-3">
<div class="input-group">
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
<input type="date" id="hasta" value="<?php echo date('Y-m-d'); ?>" class="form-control pull-right"   required>
</div> 
</div>
<div class="col-xs-1">
<div id="loader" class="text-center"></div>
</div>
<div class="col-xs-5 ">

<div class="btn-group pull-right">
<button type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-placement="bottom" title="Cantidad de Registros a mostrar">
Cantidad a Mostrar 
<span class="caret"></span>
</button>
<ul class="dropdown-menu pull-right">
<li class="active" onclick="per_page(5);" id="5"><a href="reportecliente.php#">5</a></li>
<li onclick="per_page(10);" id="10"><a href="reportecliente.php#">10</a></li>
<li onclick="per_page(20);" id="20"><a href="reportecliente.php#">20</a></li>
<li onclick="per_page(50);" id="50"><a href="reportecliente.php#">50</a></li>
<li onclick="per_page(1000);" id="1000"><a href="reportecliente.php#">Todos</a></li>
</ul>
<input type="hidden" id="per_page" value="5" >
</div>
<div class="btn-group pull-right">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="fa fa-print"></span>&nbsp;Imprimir <span class="fa fa-caret-down"></span></button>
<ul class="dropdown-menu">
<li><a href="javascript:window.open(imprimirclientetodos())"><i class="fa fa-print"></i> Todos</a></li>
<li><a href="javascript:window.open(imprimirclientefecha())"><i class="fa fa-print"></i> Fechas</a></li>

</ul>
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
<h3 class="box-title">Listado de clientes </h3>
</div> 
<div class="box-body">
<div class="table-responsive">
<!-- Cargar los datos mediante el ajax-->

<div class="vertabla"></div>

<!-- Cargar datos del ajax-->

</div>
</div>
</div>
</div>
</div>
</div>


</section> 
 

 
 <?php 
 //Requiremos el archivo del as consultas de busquedad
      require_once('view/viewcliente.php');

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
      var q= "";
       var per_page=$("#per_page").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        //Referencia al archivo de busqueda y enviarle los parametros
        url:'view/viewcliente.php?action=ajax&page='+page+'&q='+q+'&per_page='+per_page,
         beforeSend: function(objeto){
          //Cargar la imegen gif
         $('#loader').html('<img src="../img/loader.gif"> Cargando su busqueda...');
        },
        success:function(data){
          //Div de muestar de los datos
          $(".vertabla").html(data).fadeIn('slow');
          $('#loader').html('');
          
        }
      })
    }
  </script>




 

<?php
//Mostrar el copyright
 include("../menu/footer.php"); ?>

