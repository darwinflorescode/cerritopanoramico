<?php
$manejador="mysql";
$servidor="localhost";
$usuario="root";
$pass="";
$base="db_cerrito";
$cadena="$manejador:host=$servidor;dbname=$base";
$cnx = new PDO($cadena,$usuario,$pass/*,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\'')*/);
?>