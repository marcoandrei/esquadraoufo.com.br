<?php
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);

if ($_SERVER["SERVER_NAME"] == "localhost") {

	$servidor = 'localhost';
	$banco = 'esq_ufo';
	$usuario = 'root';
	$senha = 'root';
} else {

	$servidor = 'mysql.hermesweb.com.br';
	$banco = 'hermesweb01';
	$usuario = 'hermesweb01';
	$senha = 'cuzE5Adacrus';
}
$bd = new mysqli($servidor, $usuario, $senha, $banco);
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
$bd->set_charset("utf8");
