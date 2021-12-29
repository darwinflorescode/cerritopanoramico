
<?php
//Incluimos el menu principal de el sistema
 include("../menu/header.php");

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
<!-- Imagen gifcargar-->
    <div id="loader" class="text-center"> <img src="../img/loader.gif"></div>
    <!-- Formulario de busqueda de datos-->
      <form class="form-horizontal" accept-charset="utf-8"   autocomplete="off" role="form" >
            <table>
<tr><td>
<!-- input donde se ingresan los datos a buscar-->
<input type="text" id="q" name="q"  class="form-control" size="60" onkeyup="load(1);"   placeholder="Busca por ID, nombre, apellido, dui, e-mail, teléfono, dirección , whatsapp o fecha" id="q">
<span class="input-group-btn"></td><td>
                <!-- Botton d busqueda de datos -->                                 
       <button  type="button" class="btn btn-default" onclick="load(1);"  title="Busca por ID, nombre, apellido, dui, e-mail, teléfono, dirección , whatsapp o fecha"><span class="fa fa-search"></span></button>
                                </form>
                                </td><td>
                                <!-- Imagen gifcargar de acuerdo a la posicion-->
           <div id="loader" style="position: absolute; text-align: center; top: 55px;  width: 100%;display:none;"></div><!-- Carga gif animado -->


                                </td></tr>

                                </table>



</span>
</div>


<?php

//mensajes de gdialogo  alerfitys
//Si se guarda correctamente
if (!empty($_GET['save'])) {

  $correcto = $_GET['save'];

  if ($correcto == "true") {

    ?>
    <body onload="save();"></body>
    <script>
      function save(){
        alertify.success("Excelente. Cliente almacenado");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php


//sin se cumple al guardar

  }elseif($correcto =="false"){
    
    ?>
    <body onload="dui();"></body>
    <script>
      function dui(){
        alertify.error("Error. Dui ya existe !");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php





//si existe un error
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



//Si es modificado correctamnte
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
    // Si este fallaen el proceso de modificacion
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
<!-- Booton de mostrar todo y nuevo registro-->
<div class="btn-group pull-right">
<a href="mostrar.php" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Todos los Registros!"><li class="fa fa-eye"></li> Todo</a>
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#cliente_modal" data-placement="bottom" title="Nuevo Registro!"><i class="fa fa-plus" ></i> Nuevo</button>
<button type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-placement="bottom" title="Cantidad de Registros a mostrar">
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
      var q= $("#q").val();
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

