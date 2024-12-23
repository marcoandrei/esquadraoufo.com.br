<?php

require_once('include/checkLogin.php');

$arquivo = $_GET["arquivo"];

if (isset($arquivo) && file_exists($arquivo)) { // Verifica se a variável $arquivo não está vazia e se $arquivo existe

    unlink($arquivo); // apaga o arquivo

    header("Location: arquivos.php"); // volta para a página de arquivos

}
