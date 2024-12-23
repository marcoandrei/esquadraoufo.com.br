<?php

/**
 * ESQUADRÃO UFO
 * 
 * » Gestor de arquivos
 * 
 */

// Verifica se usuários está autenticado.

require_once('include/checkLogin.php');

// Se houver um arquivo enviado, grava o arquivo na pasta correta.

if (isset($_POST["upload"])) {
    if (is_uploaded_file($_FILES['arquivo']['tmp_name'])) {

        $pathNomeArquivo = "repositorio/" . $_FILES['arquivo']['name'];
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $pathNomeArquivo);
    }
}

require_once('header.php');

?>

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

            <h1>Esquadrão UFO</h1>

            <h2>Repositório de documentos</h2>

            <br /><br />

            <table class="table table-striped">

                <th></th>
                <th>Nome do arquivo</th>
                <th>Apagar</th>

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
                            case "mp4":
                                $icone = "fa fa-file-video-o";
                                break;
                            case "jpg":
                                $icone = "fa fa-file-image-o";
                                break;
                            case "jpeg":
                                $icone = "fa fa-file-image-o";
                                break;
                        }

                ?>

                        <tr>
                            <!-- ícone do arquivo -->
                            <td><i class="<?= $icone ?>" aria-hidden="true"></i>&nbsp;</td>
                            <!-- nome do arquivo -->
                            <td><a href="<?= $path . $arquivo ?>" target="_blank" class="arquivo"><?= $arquivo ?></a>&nbsp;</td>

                            <?php
                            if ($eh_admin) { // se o usuário é admin, permite apagar o arquivo
                            ?>
                                <td><a href="javascript:apagarArquivo('<?= $path ?>', '<?= $arquivo ?>')" class="apagaArquivo warning"><i class='fa fa-trash-o' aria-hidden='true'></i></a></td>
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
                <form method="post" enctype="multipart/form-data" action="arquivos.php">
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

<?php

require_once('footer.php');
