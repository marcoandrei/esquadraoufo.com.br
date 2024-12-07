<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "include/connect.php";
require "include/incAutenticacao.php";
verificaLogin();


$nome = "Leo Sassen";
$email = "leo@clipprodutora.com.br";
$senha = md5("PortoAlegre@2024" . $salt);

$result = $bd->query("insert into usuarios ( nome , email , senha ) values ( '$nome' , '$email' , '$senha' )");



$nome = "Teste";
$email = "teste@teste.com";
$senha = md5("TesteTeste@1234" . $salt);

$result = $bd->query("insert into usuarios ( nome , email , senha ) values ( '$nome' , '$email' , '$senha' )");
