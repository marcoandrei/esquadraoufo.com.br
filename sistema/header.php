<?php

/**
 * FAUVEL
 * » Cabeçalho das páginas
 * 
 */

// Carrega funções do sistema.
require "include/funcoes.php";

?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Esquadrão UFO</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Estilos -->
    <link href="css/estilos.css" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

</head>

<body>

    <?php

    ?>

    <!-- Monta barra de navegação -->

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="home.php">
                    <img alt="Arsnova" src="img/logo-menu.png">
                </a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="home.php">Painel</a></li>
                <li><a href="arquivos.php">Arquivos</a></li>
                <?php if ($eh_admin) { ?><li><a href="usuarios.php">Usuários</a></li><?php } ?>
            </ul>

            <button class="btn btn-default navbar-btn quit-btn" onclick="document.location='logout.php'">
                Sair
            </button>

            <p class="navbar-text">Bem-vindo,
                <?= $_SESSION["login_nome"] ?>!</p>

        </div>
    </nav>