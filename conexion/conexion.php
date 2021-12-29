<?php
//Funcion que contiene el enlace a la base de datos.
function conexion()
{
	$conn = null;
	$host = 'bdgn93lmfsskkapie9rn-mysql.services.clever-cloud.com';
	$db = 'bdgn93lmfsskkapie9rn';
	$user = 'uycvgcufe6ep1zum';
	$pwd = '2Z5PbKoaKqijKJOm65Vh';

	try {
		$conn = new PDO('mysql:host=' . $host . '; dbname=' . $db, $user, $pwd);
		//echo 'Conexion satisfactoria.<br>';

	} catch (PDOException $e) {
		echo '<script>';
		echo 'var pBar = document.getElementById("p");
		 var updateProgress = function(value)
		 {
		 	pBar.value = value;
		 	pBar.getElementByTagName("span")[0].innerHTML = Math.floor((100 / 70) * value);
		 }';
		echo "</script>";
		echo "<style='background-color:lightgrey'>

	";
		echo "<hr>";
		echo '<br><center><h1 style="font-size:300%"><p><font color="red">¡¡No se puede conectar con la base de datos!!</font></p></h1>';
		echo "<embed src='../img/cad.png' heigth='50' width='50'></embed><br><br><progress id='p' max='70'> <span>0</span>%</progress><br>";
		echo "<hr width='80%' color='black' size='8' /></center>";
		echo "<p>Posibles causas:</p>
		<ol>
			<li>Ha perdido conexión con el servidor. </li>
			<li>Base de datos no encontrada. </li>
			<li>Conexión expirada. </li>
			<li>Clave o usuario incorrectos. </li>
			<li>La base de datos fue removida. </li>
		</ol>";


		echo "<center><h2 style='color:green'>Si el problema persiste consulte al soporte Técnico</h2></center>";
		exit();
	}
	return $conn;
}
//conexion();
