<?php
function iniciaSessao() {
	
	$secure = false;
	$httpOnly = true;
	ini_set("session.use_only_cookies",1);
	$cookieParams = session_get_cookie_params();
	session_set_cookie_params(3600*24*30,$cookieParams["path"],$cookieParams["domain"],$secure,$httpOnly);
	session_name("sessao");
	session_start();
	session_regenerate_id();
}

function verificaLogin() {
	iniciaSessao();
	if(isset($_SESSION["login_id"],$_SESSION["login_nome"],$_SESSION["login_fingerprint"])) {
		if($_SESSION["login_fingerprint"] == md5($_SERVER['HTTP_USER_AGENT'].$_SESSION["login_id"].$_SESSION["login_nome"])) {
			return true;
		}
	}
	header("location:logout.php");
}

function verificaLogin2() {
	iniciaSessao();
	if(isset($_SESSION["login_id"],$_SESSION["login_nome"],$_SESSION["login_fingerprint"])) {
		if($_SESSION["login_fingerprint"] == md5($_SERVER['HTTP_USER_AGENT'].$_SESSION["login_id"].$_SESSION["login_nome"])) {
			return true;
		}
	}
	exit(json_encode(array('sucesso' => false , 'resposta' => 'logout')));
}



$salt = "E$%ur7&m#p";
?>
