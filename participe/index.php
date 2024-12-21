<?php
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esquadrão UFO - Participe!</title>

    <meta name="description"
        content="A equipe da Clip Produtora de Cinema e Vídeo e o History Channel agradecem o seu interesse em participar de mais esta série.">
    <meta name="author" content="Marco Andrei Kichalowsky, Arsnova Digital">

    <link rel="icon" type="image/png" href="" />

    <!-- Estilos -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <!-- Ícones -->
    <link rel="stylesheet" href="fonts/font-awesome-v5/css/fontawesome-all.css">


</head>

<body>

    <header>

        <div class="conteudo">

            <div class="logo"><img src="img/esquadrao-ufo-logo.png"></div>

            <nav role="navigation">

                <ul class="menu-principal">
                    <li onclick="exibeAba('inicio')">Início</li>
                    <li onclick="exibeAba('instrucoes')">Instruções</li>
                    <li onclick="exibeAba('inscricao')">Inscrição</li>
                    <li onclick="exibeAba('info-ufo')">Informações Ufológicas</li>
                </ul>


            </nav>
        </div>

    </header>

    <section id="inicio">
        <div class="conteudo">
            <img src="img/amorim-piramide.jpg">
            <p>O <strong>Canal History</strong> e a Clip Produtora estão selecionando vídeos e fotos para uma nova série
                de Ufologia chamada <strong>“Esquadrão UFO”</strong>. Nesta série, especialistas irão analisar vídeos e
                fotos de estranhos objetos vistos nos céus e descobrir se são fenômenos naturais, ciência humana ou
                realmente objetos voadores não identificados. Se você já viu, gravou ou fotografou algum OVNI / UFO e
                quer fazer parte de uma nova série no <strong>Canal History</strong>, envie seu vídeo/foto que ele
                poderá ser escolhido.</p>
            <button class="btn" onclick="exibe('instrucoes')">Saiba como enviar seu material</button>
        </div>

    </section>

    <section id="instrucoes">
        <div class="conteudo">
            <h2>Passo a Passo da Inscrição</h2>
            <p>Olá!</p>
            <p>A equipe da Clip Produtora de Cinema e Vídeo e o History Channel agradecem o seu interesse em
                participar de mais uma série produzida por nós. Os fenômenos com objetos voadores não identificados são
                frequentes e o compartilhamento dessas informações são importantes para comunidade ufológica. Antes de
                enviar o material, você irá preencher uma ficha cadastral, descrever o que ocorreu no dia em
                fez a
                gravação/foto e aceitar o termo de cessão de direitos autoriais.
            </p>
            <p>

            </p>
            <p>
                Obs.: O vídeo pode ter ATÉ 10 (dez) minutos de duração. Por favor envie na melhor qualidade possível.
                Vídeos que passam por aplicativos como o WhatsApp geralmente perdem a qualidade. Tente passar o arquivo
                original.</p>
            <p>
                Neste momento, para que possa postar o vídeo e ou as fotos você precisará:
            <ul>
                <li>foto da carteira de identidade aberta / frente e verso de quem gravou (ou outro documento de
                    identificação com CPF);</li>
                <li>uma "selfie" do dono da carteira de identidade (ou outro documento de identificação com CPF);
                    segurando a
                    carteira ao lado do rosto;</li>
                <li>o vídeo ou a foto para enviar.</li>
            </ul>
            </p>

        </div>

    </section>

    <form id="enviaObra" method="post" action="grava-obra.php" enctype="multipart/form-data">

        <input type="hidden" id="gravaObra" name="gravaObra">

        <section id="inscricao">
            <div class="conteudo">
                <h2>Ficha de Inscrição</h2>

                <h3>Dados Pessoais</h3>

                <div class="uma-linha">
                    <div class="um-terco">
                        <label>CPF
                            <input required type="text" id="cpf" name="cpf" title="Digite seu CPF"
                                data-mask="000.000.000-00" onblur="validaCPF(this.value);"></label>
                    </div>
                    <div class="um-terco">
                        <p id="cpfmsg" class="msgerro"></p>
                    </div>
                    <div class="um-terco">

                    </div>
                </div>

                <label>Nome do Cedente<br>
                    <input required type="text" id="nome" name="nome">
                </label>

                <div class="uma-linha">
                    <div class="um-terco">
                        <label>Nacionalidade
                            <input required type="text" id="nacionalidade" name="nacionalidade">
                        </label>
                    </div>
                    <div class="um-terco">
                        <label>Profissão<input required type="text" id="profissao" name="profissao"></label>
                    </div>
                    <div class="um-terco">
                        <label>RG
                            <input required type="text" id="rg" name="rg">
                        </label>
                    </div>
                </div>

                <div class="uma-linha">Estado Civil:
                    <div class="input-label"><label for="solteiro"><input type="radio" id="solteiro" name="estado_civil"
                                value="S" checked>
                            Solteiro(a)</label></div>

                    <div class="input-label"><label for="casado"><input type="radio" id="casado" name="estado_civil"
                                value="C">
                            Casado(a)</label></div>

                    <div class="input-label"><label for="divorciado"><input type="radio" id="divorciado"
                                name="estado_civil" value="D"> Divorciado(a)</label></div>

                    <div class="input-label"><label for="viuvo"><input type="radio" id="viuvo" name="estado_civil"
                                value="V"> Viúvo(a)</label></div>
                </div>

                <div class="uma-linha">
                    <div class="meia-linha">Sexo:
                        <input type="radio" id="feminino" name="sexo" value="F" checked>
                        <label for="feminino">Feminino</label>
                        <input type="radio" id="masculino" name="sexo" value="M">
                        <label for="masculino">Masculino</label>
                    </div>
                    <div class="meia-linha">
                        <label>Data de Nascimento
                            <input required type="date" id="data_nasc" name="data_nasc"></label>
                    </div>

                </div>

                <div class="uma-linha">
                    <div class="um-terco">
                        <label>CEP
                            <input required id="cep" name="cep" type="text" data-mask="00000-000">
                        </label>
                    </div>
                    <div class="um-terco">
                        <p id="cepmsg" class="msgerro"></p>
                    </div>
                    <div class="um-terco"></div>
                </div>

                <label>Rua</label>
                <input required id="rua" name="rua" type="text">
                <label>Bairro</label>
                <input required id="bairro" name="bairro" type="text">
                <label>Cidade</label>
                <input required id="cidade" name="cidade" type="text">
                <label>Estado</label>
                <input required id="uf" name="uf" type="text">

                <input id="ibge" name="ibge" type="hidden">

                <label>País <input required type="text" value="Brasil" id="pais" name="pais"></label>

                <label>E-mail
                    <input required type="email" id="email" name="email"></label>
                <label>Telefone Celular
                    <input required type="tel" id="celular" name="celular" data-mask="(00) 0 0000-0000"></label>


                <fieldset>
                    <legend>Documentos Pessoais</legend>
                    (Anexar cópia do documento de identidade e "selfie" segurando a identidade em questão ao lado do
                    rosto. Apenas JPEG ou PDF serão aceitos.)
                    <label>Documento de identidade</label>
                    <input required type="file" id="cedente_rg" name="cedente_rg" accept=".pdf, .jpg, .jpeg">
                    <label>Selfie com o documento</label>
                    <input required type="file" id="cedente_selfie" name="cedente_selfie" accept=".pdf, .jpg, .jpeg">
                </fieldset>

            </div>

        </section>

        <section id="info-ufo">
            <div class="conteudo">
                <h2>Dados da Obra Audiovisual</h2>
                <fieldset>
                    <legend>Identificação</legend>
                    <label>Título</label>
                    <input required type="text" id="titulo" name="titulo">
                    <label>Tempo de duração (em segundos)</label>
                    <input required type="number" min="0" max="600" id="duracao" name="duracao">
                    <label>Data da obra</label>
                    <input required type="date" id="data_obra" name="data_obra">
                    <div>Ineditismo:
                        <input type="radio" id="publicada" name="ineditismo" value="P">
                        <label for="publicada">Publicada</label>
                        <input type="radio" id="inedita" name="ineditismo" value="I" checked>
                        <label for="inedita">Inédita</label>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Informações Ufológicas</legend>
                    <label>Dia da gravação</label>
                    <input required type="date" id="data_gravacao" name="data_gravacao">
                    <label>Horário aproximado da gravação</label>
                    <input required type="time" id="hora_gravacao" name="hora_gravacao">
                    <label>Local da gravação (rua, avenida, praça, etc.)</label>
                    <input required type="text" id="local_gravacao" name="local_gravacao">
                    <label>Cidade da gravação</label>
                    <input required type="text" id="cidade_gravacao" name="cidade_gravacao">
                    <label>Qual a direção do objeto em relação a você? (norte, sul, leste, oeste)?</label>
                    <input required type="text" id="direcao_objeto" name="direcao_objeto">
                    <label>Descreva o ocorrido na gravação (o que foi visto, tipo de objeto, velocidade, direção,
                        etc.)</label>
                    <textarea id="descricao_ocorrido" name="descricao_ocorrido"></textarea>
                    <label>Quem eram as testemunhas presentes no local?</label>
                    <input required type="text" id="testemunhas" name="testemunhas">
                </fieldset>

                <fieldset>
                    <legend>Arquivos de foto e vídeo</legend>
                    (São aceitos apenas MP4 para vídeo e JPEG para fotos.)
                    <label>Vídeo</label>
                    <input required type="file" id="video_nomearq" name="video_nomearq" accept=".mp4">
                    <label>Fotos</label>
                    <input type="file" multiple name="fotos[]" id="fotos" accept=".jpg, .jpeg">
                </fieldset>

            </div>


        </section>

        <section id="termos">
            <div class="conteudo">

                <h2>Termo de cessão de direitos autorais</h2>

                <p>Para enviar sua colaboração, você precisa estar de acordo com os termos de cessão de direitos autoriais ao canal History. Leia com atenção o termo e clique no aceite ao final.</p>

                <?php include 'include/gera-aceite.php'; ?>

                <p class="caixa-aceite"><input type="checkbox" name="aceite" id="aceite" required />&nbsp;&nbsp;&nbsp;EU
                    LI
                    E
                    COMPREENDI
                    OS TERMOS E DISPOSIÇÕES DESTES <a href="">TERMOS DE USO</a> E
                    ESTOU CIENTE DE SEU INTEIRO TEOR, ACEITANDO SUAS CONDIÇÕES.</p>
                <div style="text-align: right; margin-right: 2em;"><input class="btn" type="submit" name="submit"
                        value="ENVIAR" />
                </div>

            </div>

        </section>




    </form>


    <footer>
        <div class="footer-content">
            <h2>Produção</h2>
            <ul class="rodape-marcas">
                <li id="clip"><img src="img/clip-logo.png"></li>
                <li id="history"><img src="img/history-logo.png"></li>
            </ul>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script id="via-cep-js" type="text/javascript" src="js/vc-ws.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/funcoes.js"></script>

</body>

</html>