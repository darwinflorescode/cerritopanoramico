


<?php
//Para enviar las sessioneso guardar las sessiones en variables
session_start();
//Compreueba si el boton ha sido clikeado para comprobar el metodo post
if(isset($_POST['accion']))

	
	//creando objeto a la conexion con la base de datos
{
	//Archivo donde se encuentra la conexion de la DB para hacer el puente
	require'../conexion/conexion.php';
	//Variable que almacena la conexion
	$conn = conexion();


	//Captura con variables que vienen del el login. para comproar el usuario
	$usuario= addslashes($_POST['usu']);
	$clave= addslashes($_POST['pass']);


	//Exception de error de pdo
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//Consulta Donde se comprueba  que el usuario existe
	$qg = $conn->prepare("SELECT usuario FROM usuario where usuario = '$usuario'");
			//Ejecuta ala consulta
			$qg->execute();
			//De acuerdo a la consulta guardamos en una variable el usuario si es correcto
			//Que existe en la base de datos
			$us = $qg->fetch(PDO::FETCH_ASSOC)['usuario'];


			//Condicion para saber si el usuario es igual al que han ingresado en el fomuario login
			if($usuario == $us){

				//Si se cumple hace la respectiva consulta 
				$consulta = $conn->prepare("SELECT * FROM usuario where usuario='$usuario'");
				//Ejecuta la consulta
       			$consulta->execute();
       			//Guardamos en una variable los datos de la connsulta
    			$dator = $consulta->fetch(PDO::FETCH_ASSOC);
    			// Guardamos en una variable el campo estado.

			    $estado = $dator['estado'];
  
			    //Si esta activo el usuario continua con la siguiente verificacion
			if ($estado == "Activo") {

			//consulta para identificar si esta bloqueado el usuario. VErdadero 1, falso 0.

			$q = $conn->prepare("SELECT bloqueado FROM usuario where usuario = '$usuario'");
			//Ejecuta la consulta antrior
					$q->execute();

					//Guardamos en una variable el campo bloqueado
					$bloq = $q->fetch(PDO::FETCH_ASSOC)['bloqueado'];

					// comprobando si el usuario tiene cero en el campo bloqueo.

							if ($bloq == 0) {
						

						// si el usuario  tiene cero bloqueo. Identificamos si es correcto sus datos de logueo con 
								//la clave incriptada con MD5
				$sql = "SELECT * FROM usuario where usuario='$usuario' and clave= MD5('$clave') ";
				//Ejecuta la consulta anterior
				$datos=$conn->query($sql);
					//Si se encuentra.	
				if ($datos->rowCount())

				{	

					///si los datos son correoctos actualiza los campos intentos y bloqueado para que pueda tener los mismos tres intentos

					$sf = "UPDATE usuario SET intentos = 0, bloqueado = 0, ultimoingreso = NOW() where usuario = '$usuario'";
					//ejecuta la coonsulta anterior
				$stmt = $conn->prepare($sf);
				$stmt->execute();
					
					//Guarda la session en las siguientes variables
					//Session del nombre usuario
					$_SESSION["usuario"]=$usuario;
					//session de la contraseña correcta ingresada
			          $_SESSION["pass"]=$clave;
			          //Ok para verificar si ha iniciado session correctamnte y usarlo para verificar redireccinar al index
					$_SESSION["ok"]=1;
					// redirecciona al menu .

					header("location:../menu/menu.php");

				
			}
			else{

				//sino ocurrre lo anterior entonces los intentos aumentan en 1 y muestra un mensaje. asi tambien cumpliendo la condicion. y la session ok queda en cero

				$_SESSION["ok"]=0;
				//Actualiza la base de datos de acuerdo al usuario iingresado
				$sql = "UPDATE usuario SET intentos = intentos+1 where usuario = '$usuario'";
				//Ejecuta la consulta anterior
				$stmt = $conn->prepare($sql);
				$stmt->execute();

				//Se hace un select para ver cuantos intentos lleva el usuario ingresadndo al sistema

				$qe = $conn->prepare("SELECT intentos FROM usuario where usuario = '$usuario'");
				//Ejecuta la consulta
						$qe->execute();

						//Guarda  los intentos de la base de datos en una variable
						$intentos = $qe->fetch(PDO::FETCH_ASSOC)['intentos'];


						//si intentos es menor o igual a dos entonces lo redirecciona con un parametro triying con los intentos que lleva el usuario
						if ($intentos <= 2 ) {

							//redirecciona con el parametro trying para mostrar el respectivo mensaje alertifys
					header("location: ../index.php?trying=$intentos");

						//Pero si los es igual o mayor a tres entonces 		
				}elseif ($intentos >= 3) {


		//pero si intentos es >= 0 entonces actualiza en la base de datos al usuario
		//sus tres intentos y el valor 1 en bloqueadio quedando de esta forma el usuario bloqueado si ningun acceso.
		//y lo redirecciona a que si quiere desbloquearlo

					//Actualiza los datos del usuario quedando el campo bloqueado como  1 osea bloqueado parano tener ningun acceso

				$s = "UPDATE usuario SET intentos = 3, bloqueado = 1 where usuario = '$usuario'";
						//Ejecuta la consulta
					$stmt = $conn->prepare($s);
					$stmt->execute();
					//Redirecciona con e paraetro bloqueado true paara mostrarr el mensaje de dialogo al usuario.
					//Preguntandole si quiere desbloquearlo
					header("location:../index.php?bloqueado=true");
						
					}


				}

				//Si ya el campo bloqueado se encuentra a 1 entonces ese usuario ya se encuentra bloqueado 
				//y le muestra un mensaje q si quiere desbloquearlo
				}elseif ($bloq == 1) {
					//Redirecciona con el parametro bloqueado igual a true para q muestre su respectivo mensaje
					header("location:../index.php?bloqueado=true");




				}

				//Si el estado es inactivo le envia un parametro de inactivo correcto. p
				//Para mostrar el respectivo mensaje
				}elseif($estado == "Inactivo"){

					//redireccina con parametro inactivo
					header("location:../index.php?inactivo=correcto");
				}else{
					//redirecciona al index.php
					header("location:../index.php");
				}





				}else{

					/// si el usuario no existe dentro de la base de dato. automaticamente lo redirecciona al index
					//Con el parametro de noresgistrado para mostrar el mensaje alertifys
					header("location:../index.php?noregistrado=true");
				}




}
else{
	//Cuando no ha sido clikeado el boton se redirecciona a index.
	header("location:../index.php");
}

//fin de todo para el login
?>