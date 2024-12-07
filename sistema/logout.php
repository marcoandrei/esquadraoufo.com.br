<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "include/connect.php";
require "include/incAutenticacao.php";

iniciaSessao();
$_SESSION = array();
$params = session_get_cookie_params();
setcookie(session_name(),'', time() - 42000,$params["path"],$params["domain"],$params["secure"],$params["httponly"]);
session_destroy();
header('Location:index.php');
?>
