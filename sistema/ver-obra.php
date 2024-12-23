<?php

// Verifica se está autenticado.

require_once('include/checkLogin.php');


$msgErro = "";
$msgSucesso = "";

$obra_id = $_GET["id"];

require_once('header.php');

?>
<!-- Monta o miolo -->

<div class="container">

    <div class="row">

        <div class="col-md-10 col-xs-12">

            <h1>Esquadrão UFO</h1>

            <h2>Visualização de obra</h2>

            <br><br>

            <h3>Informações da obra</h3>

            <?php

            $result = $bd->query("
                
                    SELECT *
                    FROM obras 
                    WHERE id = $obra_id
                
                ");

            if ($result) {

                while ($row = $result->fetch_assoc()) {

                    $cedente_id = $row['cedente_id'];

            ?>

                    <div class="row">

                        <p class="msgErro">
                            <?= $msgErro; ?>
                        </p>

                        <form id="verObra">

                            <div class="form-group row mt-2">
                                <div class="col-sm-6">
                                    <label class="col-form-label form-label">Título</label>
                                    <input readonly type="text" class="form-control" id="nome" name="nome"
                                        value="<?= $row['titulo'] ?>">
                                </div>
                                <div class="col-sm-2">
                                    <label class="col-form-label form-label">Data</label>
                                    <input readonly type="text" class="form-control" id="data_obra" name="data_obra"
                                        value="<?= $row['data_obra'] ?>">
                                </div>
                                <div class="col-sm-2">
                                    <label class="col-form-label form-label">Duração (s)</label>
                                    <input readonly type="text" class="form-control" id="duracao" name="duracao"
                                        value="<?= $row['duracao'] ?>">
                                </div>
                                <div class="col-sm-2">
                                    <label class="col-form-label form-label">Ineditismo</label>
                                    <input readonly type="text" class="form-control" id="ineditismo" name="ineditismo" value="<?php if ($row['ineditismo'] == 'I') {
                                                                                                                                    echo "Inédita";
                                                                                                                                } else {
                                                                                                                                    echo "Publicada";
                                                                                                                                } ?>">
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <div class="col-sm-2">
                                    <label class="col-form-label form-label">Data gravação</label>
                                    <input readonly type="text" class="form-control" id="data_gravacao" name="data_gravacao"
                                        value="<?= $row['data_gravacao'] ?>">
                                </div>
                                <div class="col-sm-2">
                                    <label class="col-form-label form-label">Hora gravação</label>
                                    <input readonly type="text" class="form-control" id="data_obra" name="data_obra"
                                        value="<?= $row['hora_gravacao'] ?>">
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <div class="col-sm-5">
                                    <label class="col-form-label form-label">Local</label>
                                    <input readonly type="text" class="form-control form-control-sm" id="local_gravacao"
                                        name="local_gravacao" value="<?= $row['local_gravacao'] ?>">
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-form-label form-label">Cidade</label>
                                    <input readonly type="text" class="form-control form-control-sm" id="cidade_gravacao"
                                        name="cidade_gravacao" value="<?= $row['cidade_gravacao'] ?>">
                                </div>
                                <div class="col-sm-3">
                                    <label class="col-form-label form-label">Direção do objeto</label>
                                    <input readonly type="text" class="form-control form-control-sm" id="direcao_objeto"
                                        name="direcao_objeto" value="<?= $row['direcao_objeto'] ?>">
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label class="col-form-label form-label">Descrição do ocorrido</label>
                                <textarea readonly class="form-control" rows="2" id="descricao_ocorrido"
                                    name="descricao_ocorrido"><?= $row['descricao_ocorrido'] ?></textarea>
                            </div>

                            <div class="form-group mt-2">
                                <label class="col-form-label form-label">Testemunhas</label>
                                <input readonly type="text" class="form-control form-control-sm" id="testemunhas"
                                    name="testemunhas" value="<?= $row['testemunhas'] ?>">
                            </div>

                            <?php

                            $nomearq = "repositorio/video_" . $obra_id . "__" . $row['video_nomearq'];

                            ?>

                            <div class="form-group row mt-2">
                                <div class="col-sm-3">
                                    <label class="col-form-label form-label">Arquivos</label>

                                    <?php
                                    if (file_exists($nomearq)) {
                                    ?>

                                        <a href="<?= $nomearq ?>" target="_blank" class="btn btn-default">
                                            Baixar vídeo <i class="fa fa-download" aria-hidden="true"></i>

                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <p><em>Vídeo removido do diretório.</em></p>
                                    <?php
                                    }
                                    ?>

                                </div>

                            </div>


                        </form>


                    </div>

                <?php
                } // WHILE

            } // IF

            // Fotos da obra

            $result = $bd->query("SELECT * FROM obras_fotos WHERE obra_id = $obra_id");

            if ($result) {

                echo '<div class="row">';

                $i = 0;

                while ($row = $result->fetch_assoc()) {

                    $nomefoto = "repositorio/foto_" . $obra_id . "-" . $i . "__" . $row['foto_nomearq'];

                ?>

                    <a href="<?= $nomefoto ?>" target="_blank"><img src="<?= $nomefoto ?>"
                            style="width: 150px; margin-right: 1rem;"></a>

            <?php
                }

                echo '</div>';
            }

            ?>

            <br><br>

            <h3>Informações do cedente</h3>

            <?php

            $result = $bd->query("SELECT * FROM cedentes WHERE id = $cedente_id");

            if ($result) {

                while ($row = $result->fetch_assoc()) {
            ?>

                    <div class="row">

                        <p class="msgErro">
                            <?= $msgErro; ?>
                        </p>

                        <form id="verObra">

                            <div class="form-group row mt-2">
                                <div class="col-sm-9">
                                    <label class="col-form-label form-label">Nome</label>
                                    <input readonly type="text" class="form-control form-control-sm" id="nome"
                                        name="nome" value="<?= $row['nome'] ?>">
                                </div>
                                <div class="col-sm-3">
                                    <label class="col-form-label form-label">Data de nascimento</label>
                                    <input readonly type="text" class="form-control form-control-sm" id="data_nasc"
                                        name="data_nasc" value="<?= $row['data_nasc'] ?>">
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <div class="col-sm-2">
                                    <label class="col-form-label form-label">CPF</label>
                                    <input readonly type="text" class="form-control" id="cpf" name="cpf"
                                        value="<?= $row['cpf'] ?>">
                                </div>
                                <div class="col-sm-3">
                                    <label class="col-form-label form-label">RG</label>
                                    <input readonly type="text" class="form-control" id="rg" name="rg"
                                        value="<?= $row['rg'] ?>">
                                </div>
                                <div class="col-sm-2">
                                    <label class="col-form-label form-label">Nacionalidade</label>
                                    <input readonly type="text" class="form-control" id="nacionalidade" name="nacionalidade"
                                        value="<?= $row['nacionalidade'] ?>">
                                </div>

                                <?php
                                switch ($row['estado_civil']) {
                                    case 'S':
                                        $ec = 'solt';
                                        break;
                                    case 'C':
                                        $ec = 'cas';
                                        break;
                                    case 'D':
                                        $ec = 'div';
                                        break;
                                    case 'V':
                                        $ec = 'viuv';
                                        break;
                                }
                                ?>

                                <div class="col-sm-1">
                                    <label class="col-form-label form-label">E. civil</label>
                                    <input readonly type="text" class="form-control" id="estado_civil" name="estado_civil"
                                        value="<?= $ec ?>">
                                </div>

                                <?php
                                switch ($row['sexo']) {
                                    case 'F':
                                        $sx = 'fem';
                                        break;
                                    case 'M':
                                        $sx = 'masc';
                                        break;
                                    case 'O':
                                        $sx = 'outr';
                                        break;
                                }
                                ?>

                                <div class="col-sm-1">
                                    <label class="col-form-label form-label">Sexo</label>
                                    <input readonly type="text" class="form-control" id="sexo" name="sexo"
                                        value="<?= $sx ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label class="col-form-label form-label">Profissão</label>
                                    <input readonly type="text" class="form-control" id="profissao" name="profissao"
                                        value="<?= $row['profissao'] ?>">
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <div class="col-sm-6">
                                    <label class="col-form-label form-label">Endereço</label>
                                    <input readonly type="text" class="form-control form-control-sm" id="endereco"
                                        name="endereco" value="<?= $row['endereco'] ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label class="col-form-label form-label">Cidade</label>
                                    <input readonly type="text" class="form-control form-control-sm" id="cidade"
                                        name="cidade" value="<?= $row['cidade'] ?>">
                                </div>
                                <div class="col-sm-1">
                                    <label class="col-form-label form-label">UF</label>
                                    <input readonly type="text" class="form-control form-control-sm" id="estado"
                                        name="estado" value="<?= $row['estado'] ?>">
                                </div>
                                <div class="col-sm-2">
                                    <label class="col-form-label form-label">País</label>
                                    <input readonly type="text" class="form-control form-control-sm" id="pais"
                                        name="pais" value="<?= $row['pais'] ?>">
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <div class="col-sm-6">
                                    <label class="col-form-label form-label">E-mail</label>
                                    <input readonly type="text" class="form-control form-control-sm" id="email"
                                        name="email" value="<?= $row['email'] ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-form-label form-label">Telefone de contato</label>
                                    <input readonly type="text" class="form-control form-control-sm" id="celular"
                                        name="celular" value="<?= $row['celular'] ?>">
                                </div>
                            </div>

                            <?php

                            $fotodoc = "repositorio/" . $cedente_id . "-rg__" . $row['identidade_nomearq'];

                            $fotoself = "repositorio/" . $cedente_id . "-selfie__" . $row['selfie_nomearq'];

                            ?>

                            <div class="form-group mt-2">

                                <strong>Documentos</strong>&nbsp;&nbsp;

                                <a href="<?= $fotodoc ?>" class="btn btn-default" target="_blank">Foto do documento</a>

                                <a href="<?= $fotoself ?>" class="btn btn-default" target="_blank">Foto selfie</a>

                            </div>



                        </form>

                    </div>

            <?php
                } // WHILE

            } // IF
            ?>

            <br><br>
            <div class="row">
                <a href="home.php" class="btn btn-default">« Voltar</a>
            </div>

        </div>

    </div>

</div>

<?php

require_once('footer.php');
