<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require "include/connect.php";
    require "include/incAutenticacao.php";
    verificaLogin();


    $arquivo = $_GET["arquivo"];
   
    if(isset($arquivo) && file_exists($arquivo)){ // Verifica se a variável $arquivo não está vazia e se $arquivo existe
    
        switch(strtolower(substr(strrchr(basename($arquivo),"."),1))){ // verifica a extensão do arquivo para pegar o tipo
             case "pdf": $tipo="application/pdf"; break;
              case "zip": $tipo="application/zip"; break;
             case "doc": $tipo="application/msword"; break;
             case "xls": $tipo="application/vnd.ms-excel"; break;
             case "ppt": $tipo="application/vnd.ms-powerpoint"; break;
             case "gif": $tipo="image/gif"; break;
             case "png": $tipo="image/png"; break;
             case "jpg": $tipo="image/jpg"; break;
             case "mp3": $tipo="audio/mpeg"; break;
             case "exe": // deixar vazio por segurança
            case "php": // deixar vazio por segurança
             case "htm": // deixar vazio por segurança
             case "html": // deixar vazio por segurança
        }
      
        header("Content-Type: ".$tipo); // informa o tipo do arquivo ao navegador
      
        header("Content-Length: ".filesize($arquivo)); // informa o tamanho do arquivo ao navegador
      
        header("Content-Disposition: attachment; filename=".basename($arquivo)); // informa ao navegador que é do tipo Anexo e informa o nome do arquivo
      
        readfile ($arquivo); // lê o arquivo
      
        exit; // encerra o processo
   }
?>