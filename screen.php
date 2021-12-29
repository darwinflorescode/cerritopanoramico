
<!DOCTYPE html>
<html oncontextmenu="return false">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" >
      <link rel="shortcut icon" href="img/icono.ico" />
   <title>Restaurante | Cerrito Panor&aacute;mico</title>

    <!-- Bootstrap core CSS -->
    <link href="recuperar/libscreen/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="recuperar/libscreen/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="recuperar/libscreen/css/style.css" rel="stylesheet">
    <link href="recuperar/libscreen/css/style-responsive.css" rel="stylesheet">
    <script type="text/javascript" src="./js/alertify.js"></script>
    <link rel="stylesheet" href="./js/alertify.core.css" />
    <link rel="stylesheet" href="./js/alertify.default.css" />

    <script type="text/javascript">
   function login(){
                //un prompt
                alertify.prompt(" <img src='./img/warning.png'><b><h3>Ingresa nombre del Restaurante:</h3></b>", function (e, str) { 
                    if (e){

                        if (str=="Cerrito Panorámico") {
                        alertify.success("Excelente.  <h5> Restaurante " + str + " </h5> puedes continuar!");
                        setTimeout('location.href="./"', 3000);

                    }else{
                        alertify.error("Debes ingresar Cerrito Panor&aacute;mico");
                        return false;
                    }
                    }else{
                        alertify.error("Aun sigues aqui. Gracias");
                    }
                });
                return false;
            }
    </script>

  </head>

  <body onload="getTime()">

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  	<div class="container">
	  	
	  		<div id="showtime"></div>
	  			<div class="col-lg-4 col-lg-offset-4">
	  				<div class="lock-screen">
		  				<h2><a title="Inicio de sessión"  onclick="login();" style="cursor:pointer;"><i class="fa fa-lock"></i></a></h2>
		  				<p>UNLOCK</p>
		  				
		  				
		  				
	  				</div>
	  			</div><!-- /col-lg-4 -->
	  	
	  	</div><!-- /container -->

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="recuperar/libscreen/js/jquery.js"></script>
    <script src="recuperar/libscreen/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="recuperar/libscreen/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("recuperar/libscreen/img/comedor.jpg", {speed: 500});
       /* $.backstretch("./imagenes/oscuro.jpg", {speed: 500});*/
    </script>

    <script>
        function getTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('showtime').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){getTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>

  </body>
</html>
