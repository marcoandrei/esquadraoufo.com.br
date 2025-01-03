<?php

/**
 * ESQUADRÃO UFO
 * 
 * » Verifica se o usuário está autenticado 
 * e carrega informações de sessão.
 * 
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "connect.php";
require "incAutenticacao.php";
verificaLogin();

$eh_admin = $_SESSION["login_admin"];
// $tipo_usuario = $_SESSION["login_tipo"];
