<?php include 'conexion/conexion.php'; ?>
<!doctype html>
<!-- Documento html -->
<html oncontextmenu="return false" >
<head lang="es">


<!-- Icono que aparece en la ventana del navegador -->
  <link rel="shortcut icon" href="img/icono.ico" />


 <!-- Librerias bootstrap para darle estilos a el login -->
<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="./lib/bootstrap.min.css">
<link rel="stylesheet" href="./lib/boot.css">


<!-- Libreria para asignar iconos Fa fa -->
 
<link rel="stylesheet" href="./iconos_fa/css/font-awesome.min.css">

 <!-- Libreria personalisada como bootstrap y otros estilos -->
<link rel="stylesheet" href="./lib/stiloadmin.css">

<!-- Estios de el contenedor de el login para definirle el alto, ancho y mas. -->
  
  <link rel="stylesheet" type="text/css" href="imagenes/style.css">

  <!-- Libreria personalisada alertifys para mensajes de dialogos -->
   <script type="text/javascript" src="./js/alertify.js"></script>
    <link rel="stylesheet" href="./js/alertify.core.css" />
    <link rel="stylesheet" href="./js/alertify.default.css" />


<!-- Titulo que aparece en el naegador del login -->
 <title>Restaurante | Cerrito Panor&aacute;mico</title>
  
</head>

<!-- Inicio del cuerpo del documento html -->
<body >




<?php

//incluye el menu de color negro de que aparece en el lado de arriba del logiin

include './recuperar/header.php';

//En este camtura la variable para mostrar el mensaje correspondiente

if (!empty($_GET['trying'])) {
 //variable para mostrar los intentos del usuario.
  $intentos = $_GET['trying'];
  $intentosfaltan = 3;
  $intentosdisponibles = $intentosfaltan - $intentos;

  ?>


<!-- se ejecuta en metodo o function onload con javascript para mostrar los intentos en un mensaje alertify  -->
  <body onload="intento(<?php echo $intentosdisponibles;?>);"></body>

    <script type="text/javascript">
      function intento(intentos){

        //Mensajes alerfitys
        alertify.error("Error, Usuario le resta " + intentos + " intentos ! ");
        alertify.log("Usuario / Contrase&ntilde;a Incorrecta."); 
        
        return false;
      }

    </script>

  <?php

  
}


//En este proceso captura la variable inactvo para mostrar si el usuario esta desactivado
if (!empty($_GET['inactivo'])) {
  $inactivo = $_GET['inactivo'];
  if ($inactivo == "correcto") {
     ?>
<!-- Uso de javascript para mostrar el respectivo mensaje de dialogo alertifys  -->
  <body onload="desactivo();"></body>

    <script type="text/javascript">
      function desactivo(){
        //Mensaje alertitys
        alertify.error("Error. Usuario su cuenta ha sido desactivada."); 
        return false;
      }

    </script>

  <?php 
  }else{

  }
}


//En este proceso captura la variable no registrado para mostrar el respectivo mensaje alertifys

if (!empty($_GET['noregistrado'])) {
  $noreg = $_GET['noregistrado'];
     ?>
<!-- Uso de javascript y el evento onload  -->
  <body onload="no();"></body>

    <script type="text/javascript">
      function no(){

        //Mensajes de dialogo alertifys
        alertify.error("Error. Usuario no registrado."); 
        return false;
      }

    </script>

  <?php 
}


//Captura la variable bloqueado para verificar si el usuario ya realizoó sus 3 intentos y le pregunta si desea desbloquearlos
if (!empty($_GET['bloqueado'])) {
//variable si esta bloqueado
  $desb = $_GET['bloqueado'];

  if ($desb == "true") {
    ?>


<!-- si es verdadero q esta bloqueado le hace la pregunta. Uso de confirm -->
  <body onload="desblo();"></body>
<script>
    function desblo(){
      //Mensaje de confirmación verdadero.
     alertify.confirm("<p><img src='./img/warning.png'>&nbsp;&nbsp;&nbsp; <b>Ha alcanzado sus 3 Intentos maximos<br><b>Usuario bloqueado!</b><br><br><b>¿Desea desbloquearlo?</b><br><br></p>",
  function (e) {
          if (e) {

            //Si responde aceptar muestra el mensaje alertifys y lo redirecciona en un segundo y medio a la url.

            alertify.success("Restablecer Intentos !!!");

            //Redirecciona en 1500 milesegundos
            setTimeout('location.href="recuperar/desbloquear.php"', 1500);
           
          } 
          //Sino retorna false y se queda en el login mostrando el respectvo mensjae
          else { alertify.log("¿Si no puede desbloquear?. Comuniquese con el Admin...");
          return false;
          }
        });
   }


</script>

  <?php
    # code...
  }
}


//Termina las condiciones de los mensajes alertifys

?>

     
<div class="container">
    <div class="row vertical-center-row">

<!--  Formularioo del login para poder ingresaar al sistema-->
        <form action="./recuperar/enviar.php" accept-charset="utf-8"  name="loginform" autocomplete="off" role="form"  method="POST" >
            <div id="loginarea">
      
                <center><h6><font color="black">INICIO DE SESI&Oacute;N</font></h6></center>
                      <?php
                      //Mensaje que se muestra cuando cierra la session el usuario

                        if (!empty($_GET['cerrar'])) {
                      $cerrar = $_GET['cerrar'];
                      echo '<p class="alert alert-success">Excelente. Ha cerrado la sesi&oacute;n correctamete. Por favor Espere...</p>';
                      echo"<meta http-equiv='refresh' content='3; url=http://localhost/cerritopanoramico/'/ >";
                    }



    ?>
                <hr/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="image">
                        <!-- Imagen q se muestar en el login -->
                            <img src="imagenes/llaves.png" class="img-responsive img-rounded" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                        <!-- Input del usuario a ingresar correctamente. Icono fa fa -->
                            <label for="username">Usuario: <span class="glyphicon glyphicon-user"></span></label>
                            <input type="text" class="form-control"  name="usu" placeholder="Ingrese su usuario" required />
                        </div>
                        <div class="form-group">

                        <!-- Input de la contraseña a ingresar correcatmente. Icono fa fa -->
                            <label for="password">Contrase&ntilde;a:  <span class="glyphicon glyphicon-lock"></span>   </label>
                            <input type="password" class="form-control"  name="pass" placeholder="Ingrese su contrase&ntilde;a" required />
                        </div>
                        <!--Boton submit del formulario del login  -->
                         <button type="submit" class="btn  btn-primary" name="accion"><span class="glyphicon glyphicon-log-in"></span>  ENTRAR</button>
                    </div>
                </div>
                <hr/>
               
                <!-- Linkk para poder recuperar la contraseña del usuario -->
                   <center><a href="recuperar/password.php"><i class="glyphicon glyphicon-question-sign"></i>&nbsp;&nbsp;¿Olvidaste tu contrase&ntilde;a?</a><br><br></center>
                     <!-- Derechos reservados del creador --><center><strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://fademype.org.sv/fademype/?p=1647" target="_blank"><font color="black">Sistema de El Restaurante Cerrito Panor&aacute;mico</font></a></strong></center>
                    
                        
                    
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Fin de contenedor -->
</body>
</html>