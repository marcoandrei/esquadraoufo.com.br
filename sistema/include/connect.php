<?php
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);

if ($_SERVER["SERVER_NAME"] == "localhost") {

	$servidor = 'localhost';
	$banco = 'esq_ufo';
	$usuario = 'root';
	$senha = 'root';

} else {

	$servidor = 'global-db';
	$banco = 'esquadraoufo_com_br';
	$usuario = 'esquadraoufo.com.br-NfwQ8W';
	$senha = 'B7i6Dw1xLSKuue7ivt';

}
$bd = new mysqli($servidor, $usuario, $senha, $banco);
if (mysqli_connect_errno())
	trigger_error(mysqli_connect_error());
$bd->set_charset("utf8");
