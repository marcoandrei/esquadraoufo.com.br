<?php

// NAV.PHP
// Monta a barra de navegação

?>

<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="http://terconbr.com.br">
                    <img alt="Tercon Asset" src="img/tercon-brand.png">
                </a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Arquivos <span class="sr-only">(current)</span></a></li>
                <?php
                  if ( $eh_admin ) { // se o usuário é admin, permite apagar o arquivo
                ?>
                 <li><a href="usuarios.php">Usuários</a></li>
                <?php
                    } // endif é admin
                ?>
            </ul>

            <button class="btn btn-default navbar-btn" onclick="document.location='logout.php'">
                    Sair
            </button>

            <p class="navbar-text">Bem-vindo, <?=$_SESSION["login_nome"] ?>!</p>

        </div>
    </nav>