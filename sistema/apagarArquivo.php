<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require "include/connect.php";
    require "include/incAutenticacao.php";
    verificaLogin();


    $arquivo = $_GET["arquivo"];
   
    if(isset($arquivo) && file_exists($arquivo)){ // Verifica se a variável $arquivo não está vazia e se $arquivo existe
    
        unlink($arquivo); // apaga o arquivo
      
        header("Location: home.php"); // volta para a página de arquivos

    }
?>