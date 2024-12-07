<?php

// Iniciação

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "include/incAutenticacao.php";
require "include/connect.php";

// Se recebeu email e senha, autentica.

if(isset($_POST["email"],$_POST["senha"])) {
	
	extract($_POST,EXTR_OVERWRITE);
	
	$senha = md5($senha.$salt);
	$query = "select id,nome,admin from usuarios where email = ? and senha = ?";
	$result = $bd->prepare($query); 
	$result->bind_param("ss",$email,$senha);
	$result->execute();
	$result->bind_result($id,$nome,$admin);
	$result->fetch();
	$result->close();
	if($id) {
		iniciaSessao();
		$_SESSION["login_id"] = $id;
		$_SESSION["login_nome"] = $nome;
		$_SESSION["login_fingerprint"] = md5($_SERVER['HTTP_USER_AGENT'].$id.$nome);
        $_SESSION["login_admin"] = $admin;
		exit(json_encode(array('sucesso' => true)));
	}
	exit(json_encode(array('sucesso' => false)));
}


//

iniciaSessao();
$_SESSION = array();
$params = session_get_cookie_params();
setcookie(session_name(),'', time() - 42000,$params["path"],$params["domain"],$params["secure"],$params["httponly"]);
session_destroy();

?>


    <!DOCTYPE html>
    <html lang="pt">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Arsnova — Sistema de controle</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet" />
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            var esteScript = window.location.pathname.split("/").pop();

        </script>
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
        <script>
            $().ready(function() {

                $('#formLogin').submit(function() {
                    if ($.trim($("#email").val()) != "" && $.trim($("#senha").val()) != "") {

                        $('#mensagem #textoMensagem').html('verificando login');
                        $('#mensagem').removeClass('hidden');
                        $.post(
                            esteScript,
                            $('#formLogin').serialize(),
                            function(data) {
                                $('#mensagem').addClass('hidden');
                                if (data.sucesso) {
                                    $('#divLogin').fadeOut('fast', function() {
                                        document.location = "home.php";
                                    });
                                } else {
                                    $('#erro #textoErro').html('login inválido');
                                    $('#erro').removeClass('hidden');
                                    $('#email').val('');
                                    $('#senha').val('');
                                    $("#email").focus();
                                    setTimeout(function() {
                                        $('#erro').addClass('hidden')
                                    }, 4000);
                                }
                            },
                            "json"
                        );
                        return;
                    }
                    return false;
                });
                $("#email").focus();

            });

        </script>
    </head>

    <body>

        <div class="container">
            <div class="row">


                <div class="col-md-4 col-md-offset-4" style="margin-top:64px">
                    <div id="divLogin" class="panel">
                        <div class="panel-body">

                            <div class="page-header">
                                <div align="center"><img src="img/arsnova-logo.png"></div>
                            </div>

                            <form id="formLogin" name="formLogin" method="post" role="form" onsubmit="return false">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="addonLoginEmail"><i class="fa fa-user"></i></span>
                                        <input id="email" name="email" type="text" class="form-control" placeholder="email" aria-describedby="addonLoginEmail">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="addonLoginSenha"><i class="fa fa-lock"></i></span>
                                        <input id="senha" name="senha" type="password" class="form-control" placeholder="senha" aria-describedby="addonLoginSenha">
                                    </div>
                                </div>

                                <button class="btn btn-sm btn-default center-block" type="submit"><i class="fa fa-sign-in"></i> Entrar</button>

                            </form>

                        </div>
                    </div>

                    <div id="erro" class="alert alert-danger hidden" role="alert">
                        <p class="text-center" id="textoErro"></p>
                    </div>

                    <div id="mensagem" class="alert alert-success hidden" role="alert">
                        <p class="text-center" id="textoMensagem"></p>
                    </div>


                </div>


            </div>
        </div>



    </body>

    </html>
