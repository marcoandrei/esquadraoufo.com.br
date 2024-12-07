<?php

// Verifica se está autenticado.

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "include/connect.php";
require "include/incAutenticacao.php";
verificaLogin();

$msgErro = "";
$msgSucesso ="";

// Se houver um usuário enviado, cria o usuário.

if ( isset($_POST["createUser"]) ) {

  if ( $_POST["nomeUsr"] != "") {

    if ( $_POST["emailUsr"] !="" ) {

      if ( $_POST["senhaUsr"] !="" ) {

        $nomeUsr = $_POST["nomeUsr"];
        $emailUsr = $_POST["emailUsr"];
        $senhaUsr = md5($_POST["senhaUsr"].$salt);

        if ( isset($_POST["adminUsr"]) ) $adminUsr = 1; else $adminUsr = 0 ;

        $criado = $bd->query("insert into usuarios ( nome, email, senha, admin ) values ( '$nomeUsr', '$emailUsr', '$senhaUsr', $adminUsr )");

        $msgSucesso = "<i>Usuário ".$nomeUsr." criado com sucesso.</i>";

    	}
      else {
        $msgErro = "Por favor, preencha uma senha para o usuário.<br/>";
      }
  	}
    else {
      $msgErro =  "Por favor, entre com um e-mail válido.<br/>";
    }
  }
  else {
      $msgErro = "Por favor, preencha um nome para o usuário.<br/>";
  }
}

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
        <link href="css/estilos.css" rel="stylesheet" />

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>

    <body>

        <?php

    $eh_admin = $_SESSION["login_admin"];

    if ( $eh_admin ) {
?>

            <!-- Monta barra de navegação -->
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="http://arsnova.digital">
                            <img alt="Arsnova" src="img/arsnova-brand.png">
                        </a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><a href="home.php">Arquivos</a></li>
                        <li class="active"><a href="#">Usuários <span class="sr-only">(current)</span></a></li>
                    </ul>

                    <button class="btn btn-default navbar-btn" onclick="document.location='logout.php'">
                    Sair
            </button>

                    <p class="navbar-text">Bem-vindo,
                        <?=$_SESSION["login_nome"]; ?>!</p>

                </div>
            </nav>

            <!-- Monta o miolo -->

            <div class="container">

                <div class="row">

                    <div class="col-md-11">

                        <h1>Usuários</h1>

                        <table class="table table-striped">

                            <?php

                $result = $bd->query("select nome, email, admin from usuarios");

                if ( $result ) {

                    while ( $row = $result->fetch_assoc() ) {
                    ?>
                                <tr>

                                    <?php

                            $icone = "fa fa-user";

                            if ( $row['admin'] ) {
                              $icone = "fa fa-user-plus";
                            }

                          ?>

                                        <!-- ícone de usuário -->
                                        <td><i class="<?=$icone;?>" aria-hidden="true"></i>&nbsp;</td>
                                        <!-- nome do usuário -->
                                        <td>
                                            <?=$row['nome']?>
                                                </a>&nbsp;</td>

                                        <td>
                                            <?=$row['email']?>
                                                </a>&nbsp;</td>

                                        <?php
                               if ( $eh_admin ) { // se o usuário é admin, permite apagar o arquivo
                            ?>
                                            <td><i class='fa fa-trash-o' aria-hidden='true'></i></td>
                                            <?php
                               } // endif é admin
                            ?>

                                </tr>

                                <?php

                    } // endwhile

                }

                echo "</table>";
                echo $msgSucesso;

            $result->free();

            ?>
                                    &nbsp;&nbsp;
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Criar novo usuário </h3>
                                            <p class="msgErro">
                                                <?=$msgErro;?>
                                            </p>
                                            <p class="help-block">Use este formulário para criar novos usuários do sistema.</p>

                                            <form method="post" action="usuarios.php" id="criaUsuario">

                                                <input type="hidden" id="createUser" name="createUser">

                                                <div class="form-group">
                                                    <label for="nomeUsr">Nome</label>
                                                    <input type="text" class="form-control" id="nomeUsr" name="nomeUsr" placeholder="Nome do usuário">
                                                </div>

                                                <div class="form-group">
                                                    <label for="emailUsr">E-mail</label>
                                                    <input type="email" class="form-control" id="emailUsr" name="emailUsr" placeholder="nome@dominio.com">
                                                </div>

                                                <div class="form-group">
                                                    <label for="senhaUsr">Senha</label>
                                                    <input type="password" class="form-control" id="senhaUsr" name="senhaUsr" placeholder="Senha de acesso">
                                                </div>

                                                <div class="checkbox">
                                                    <label>
                      <input type="checkbox" id="adminUsr" name="adminUsr" > Este usuário é administrador.
                    </label>
                                                </div>

                                                <button type="submit" id="enviar" name="enviar" class="btn btn-default">Criar usuário</button>
                                            </form>

                                        </div>
                                    </div>
                                    <?php

            ?>

                    </div>

                </div>
            </div>
            <br/><br/>

            <footer class="footer">
                <div class="container">
                    <p class="text-muted">
                        <a href="http://arsnova.digital/?utm_source=hermes&amp;utm_medium=logo-rodape&amp;utm_campaign=feito-por-arsnova"><img src="http://arsnova.digital/arsnova-logo.png" style="vertical-align: text-bottom" height="12" width="66"></a>
                    </p>
                </div>
            </footer>

            <?php
    }
    else
    {
        header("Location: home.php"); // volta para a página de arquivos
    }
    ?>


    </body>

    </html>
