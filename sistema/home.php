<?php

// Verifica se usuários está autenticado.

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "include/connect.php";
require "include/incAutenticacao.php";
verificaLogin();

// Se houver um arquivo enviado, grava o arquivo na pasta correta.

if (isset($_POST["upload"])) {
    if (is_uploaded_file($_FILES['arquivo']['tmp_name'])) {

        $pathNomeArquivo = "repositorio/" . $_FILES['arquivo']['name'];
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $pathNomeArquivo);
    }
}

?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Esquadrão UFO</title>
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
                <li class="active"><a href="#">Arquivos <span class="sr-only">(current)</span></a></li>
                <?php
                if ($eh_admin) { // se o usuário é admin, permite apagar o arquivo
                ?>
                    <li><a href="usuarios.php">Usuários</a></li>
                <?php
                } // endif é admin
                ?>
            </ul>

            <button class="btn btn-default navbar-btn" onclick="document.location='logout.php'">
                Sair
            </button>

            <p class="navbar-text">Bem-vindo, <?= $_SESSION["login_nome"] ?>!</p>

        </div>
    </nav>

    <!-- Monta o miolo -->

    <div class="container">

        <div class="row">

            <div class="col-md-11">

                <?php

                // Variáveis

                $path = "repositorio/"; // Onde ficarão os arquivos
                $diretorio = dir($path); // Lista os arquivos do diretório

                $quantos_arquivos = 0; // Conta o número de arquivos

                ?>

                <h1>Repositório de documentos</h1>


                <table class="table table-striped">

                    <?php

                    while ($arquivo = $diretorio->read()) {
                        if ($arquivo != '.' && $arquivo != '..') {

                            $quantos_arquivos++;

                            // Verifica a extensão do arquivo para definir o ícone no prefixo

                            $icone = "fa fa-file-o"; // define o ícone de documento comum como padrão

                            switch (strtolower(substr(strrchr(basename($arquivo), "."), 1))) { // verifica a extensão do arquivo para pegar o tipo
                                case "pdf":
                                    $icone = "fa fa-file-pdf-o";
                                    break;
                                case "zip":
                                    $icone = "fa fa-file-archive-o";
                                    break;
                                case "doc":
                                    $icone = "fa fa-file-word-o";
                                    break;
                                case "docx":
                                    $icone = "fa fa-file-word-o";
                                    break;
                                case "xls":
                                    $icone = "fa fa-file-excel-o";
                                    break;
                                case "xlsx":
                                    $icone = "fa fa-file-excel-o";
                                    break;
                            }

                    ?>

                            <tr>
                                <!-- ícone do arquivo -->
                                <td><i class="<?= $icone ?>" aria-hidden="true"></i>&nbsp;</td>
                                <!-- nome do arquivo -->
                                <td><a href="baixarArquivo.php?arquivo=<?= $path . $arquivo ?>" class="arquivo"><?= $arquivo ?></a>&nbsp;</td>

                                <?php
                                if ($eh_admin) { // se o usuário é admin, permite apagar o arquivo
                                ?>
                                    <td><a href="apagarArquivo.php?arquivo=<?= $path . $arquivo ?>" class="apagaArquivo warning"><i class='fa fa-trash-o' aria-hidden='true'></i></a></td>
                                <?php
                                } // endif é admin
                                ?>

                            </tr>


                    <?php
                        } // endif
                    } //endwhile
                    ?>

                </table>

                <?php

                if ($quantos_arquivos == 0)
                    echo "<p>Nenhum arquivo disponível no momento.</p>";
                else {
                    if ($quantos_arquivos == 1)
                        echo "<p>" . $quantos_arquivos . "&nbsp;arquivo disponível.</p>";
                    else
                        echo "<p>" . $quantos_arquivos . "&nbsp;arquivos disponíveis.</p>";
                }



                $diretorio->close();

                if ($eh_admin) {

                ?>
                    <br /><br />
                    <form method="post" enctype="multipart/form-data" action="home.php">
                        <div class="form-group">
                            <input type="hidden" id="upload" name="upload">
                            <label for="arquivo">Novo arquivo</label>

                            <input type="file" id="arquivo" name="arquivo" />
                            <p class="help-block">Use este campo para subir arquivos ao repositório.</p>
                            <button type="submit" id="enviar" name="enviar" class="btn btn-default">Enviar arquivo</button>
                        </div>


                    </form>

                <?php
                }









                ?>



            </div>


        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-muted">
                <a href="http://arsnova.digital/?utm_source=hermes&amp;utm_medium=logo-rodape&amp;utm_campaign=feito-por-arsnova"><img src="http://arsnova.digital/arsnova-logo.png" style="vertical-align: text-bottom" height="12" width="66"></a>
            </p>
        </div>
    </footer>

</body>

</html>