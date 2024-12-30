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

    <header class="site-header">

        <div class="conteudo">

            <div class="logo"><a href="."><img src="img/esquadrao-ufo-logo.png"></a></div>

            <nav role="navigation" id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" onclick="abreMenu()">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>

                <ul class="menu-principal menu nav-menu">
                    <li><a href=".">Início</a></li>
                    <li onclick="fechaMenu()"><a href="#instrucoes">Instruções</a></li>
                    <li onclick="fechaMenu()"><a href="#inscricao">Inscrição</a></li>
                    <li onclick="fechaMenu()"><a href="#info-ufo">Informações Ufológicas</a></li>
                    <li onclick="fechaMenu()"><a href="#termos">Termos</a></li>
                </ul>


            </nav>
        </div>

    </header>

    <section id="inicio" class="aba-conteudo">
        <div class="conteudo">
            <video class="inicial-video" width="100%" preload="auto" controls playsinline="" controlsList="nodownload"
                title="Participe do Esquadrão UFO">
                <source src="video-pagina-inicial.mp4" type="video/mp4">
            </video>
            <p>O <span class="amarelo"><strong>Canal History</strong></span> e a <strong>Clip Produtora</strong> estão
                selecionando vídeos e fotos para uma nova série
                de Ufologia chamada <strong>“Esquadrão UFO”</strong>. Nesta série, especialistas irão analisar vídeos e
                fotos de estranhos objetos vistos nos céus e descobrir se são fenômenos naturais, ciência humana ou
                realmente objetos voadores não identificados. Se você já viu, gravou ou fotografou algum OVNI / UFO e
                quer fazer parte de uma nova série no <span class="amarelo"><strong>Canal History</strong></span>, envie
                seu vídeo/foto que ele
                poderá ser escolhido.</p>
            <a href="#instrucoes"><button class="btn">Saiba como enviar seu material</button></a>
        </div>
    </section>

    <section id="instrucoes" class="aba-conteudo">
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
            <a href="#inscricao"><button class="btn">Preencha seus dados</button></a>
        </div>

    </section>

    <form id="enviaObra" method="post" action="grava-obra.php" enctype="multipart/form-data">

        <input type="hidden" id="gravaObra" name="gravaObra">

        <section id="inscricao" class="aba-conteudo">
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

                <h4>Endereço</h4>
                <p>(Digite o CEP para preenchimento automático.)</p>

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
                <div class="uma-linha">
                    <div class="meia-linha">
                        <label>Cidade</label>
                        <input required id="cidade" name="cidade" type="text">
                    </div>
                    <div class="um-quarto">
                        <label>Estado</label>
                        <input required id="uf" name="uf" type="text">
                    </div>
                    <input id="ibge" name="ibge" type="hidden">
                    <div class="um-quarto">
                        <label>País <input required type="text" value="Brasil" id="pais" name="pais"></label>
                    </div>
                </div>
                <div class="uma-linha">
                    <div class="meia-linha">
                        <label>E-mail</label>
                        <input required type="email" id="email" name="email">
                    </div>
                    <div class="meia-linha">
                        <label>Telefone Celular</label>
                        <input required type="text" id="celular" name="celular" data-mask="(00) 0 0000-0000">
                    </div>
                </div>

                <h3>Documentos Pessoais</h3>

                <p>(Anexar cópia do documento de identidade e "selfie" segurando a identidade em questão ao lado do
                    rosto. Apenas JPEG ou PDF serão aceitos.)</p>

                <div class="uma-linha">
                    <label>Documento de identidade</label>
                    <input required type="file" id="cedente_rg" name="cedente_rg" accept=".pdf, .jpg, .jpeg">
                </div>
                <div class="uma-linha">
                    <label>Selfie com o documento</label>
                    <input required type="file" id="cedente_selfie" name="cedente_selfie" accept=".pdf, .jpg, .jpeg">
                </div>

                <div class="btn-bar">
                    <a href="#info-ufo"><button class="btn">Preencha as informações ufológicas</button></a>
                </div>

            </div>



        </section>

        <section id="info-ufo" class="aba-conteudo">
            <div class="conteudo">
                <h2>Dados da Obra Audiovisual</h2>


                <h3>Identificação</h3>

                <label>Título</label>
                <input required type="text" id="titulo" name="titulo">

                <div class="uma-linha">
                    <div class="um-terco">
                        <label>Duração (em segundos)</label>
                        <input required type="number" min="0" max="600" id="duracao" name="duracao">
                    </div>
                    <div class="um-terco">
                        <label>Data da obra</label>
                        <input required type="date" id="data_obra" name="data_obra">
                    </div>
                    <div class="um-terco">
                        <label>Ineditismo</label><br>
                        <input type="radio" id="publicada" name="ineditismo" value="P">
                        <label for="publicada">Publicada</label>
                        <input type="radio" id="inedita" name="ineditismo" value="I" checked>
                        <label for="inedita">Inédita</label>
                    </div>
                </div>


                <h3>Informações Ufológicas</h3>

                <div class="uma-linha">
                    <div class="um-meio">
                        <label>Dia da gravação</label>
                        <input required type="date" id="data_gravacao" name="data_gravacao">
                    </div>
                    <div class="um-meio">
                        <label>Horário aproximado da gravação</label>
                        <input required type="time" id="hora_gravacao" name="hora_gravacao">
                    </div>
                </div>
                <div class="uma-linha">
                    <label>Local da gravação (rua, avenida, praça, etc.)</label>
                    <input required type="text" id="local_gravacao" name="local_gravacao">
                </div>
                <div class="uma-linha">
                    <label>Cidade da gravação</label>
                    <input required type="text" id="cidade_gravacao" name="cidade_gravacao">

                    <label>Qual a direção do objeto em relação a você? (norte, sul, leste, oeste)?</label>
                    <input required type="text" id="direcao_objeto" name="direcao_objeto">
                </div>
                <div class="uma-linha">
                    <label>Descreva o ocorrido na gravação (o que foi visto, tipo de objeto, velocidade, direção,
                        etc.)</label>
                    <textarea id="descricao_ocorrido" name="descricao_ocorrido"></textarea>
                </div>
                <div class="uma-linha">
                    <label>Quem eram as testemunhas presentes no local?</label>
                    <input required type="text" id="testemunhas" name="testemunhas">
                </div>


                <h3>Arquivos de foto e vídeo</h3>
                <div class="uma-linha">
                    <label>Vídeo (apenas MP4)</label>
                    <input required type="file" id="video_nomearq" name="video_nomearq" accept=".mp4">
                </div>
                <div class="uma-linha">
                    <label>Fotos (apenas JPEG)</label>
                    <input type="file" multiple name="fotos[]" id="fotos" accept=".jpg, .jpeg">
                </div>

                <div class="btn-bar">
                    <a href="#termos"><button class="btn">Aceite os termos</button></a>
                </div>
            </div>

        </section>

        <section id="termos" class="aba-conteudo">
            <div class="conteudo">

                <h2>Termo de cessão de direitos autorais</h2>

                <p>Para enviar sua colaboração, você precisa estar de acordo com os termos de cessão de direitos
                    autoriais ao canal History. Leia com atenção o termo e clique no aceite ao final.</p>

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

    <section id="progressoEnvio">

        <div class="conteudo">

            <div class="progress-frame">
                <div class="progress-bar"></div>
            </div>
        </div>

    </section>

    <section id="enviaObraRetorno">

        <div class="conteudo">

            <!--<img src="img/esquadrao-ufo-logo.png" height="150">-->

            <div id="mensagemResposta">

            </div>

            <div class="btn-bar">
                <a href="index.php"><button class="btn">Voltar ao início</button></a>
            </div>
        </div>

    </section>


    <footer class="site-footer">
        <div class="footer-content">
            <p>PRODUÇÃO</p>
            <div class="rodape-marcas">
                <div id="clip"><img src="img/clip-logo.png"></div>
                <div id="history"><img src="img/history-logo.png"></div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script id="via-cep-js" type="text/javascript" src="js/vc-ws.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/funcoes.js"></script>

    <script>
        $().ready(function() {

            $('#enviaObra').submit(function(event) {

                event.preventDefault();

                let formData = new FormData($('#enviaObra')[0]);
                $('#inicio').hide();
                $('#instrucoes').hide();
                $('#enviaObra').hide();
                $('#enviaObraRetorno').hide();
                $('#progressoEnvio').show();
                $('#mensagem').empty();

                $.ajax({
                    url: "grava-obra.php",
                    type: 'POST',
                    data: formData,
                    xhr: function() {
                        myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) {
                            myXhr.upload.addEventListener('progress', function(evt) {
                                if (evt.lengthComputable) {
                                    let porcento = (evt.loaded / evt.total) * 100;
                                    porcento = parseInt(porcento);
                                    $('#progressoEnvio .progress-bar').css('width', porcento + '%');
                                }
                            });
                        } else {
                            console.log("Progresso upload não suportado.");
                        }
                        return myXhr;
                    },
                    success: function(data) {

                        // $("#enviaObra")[0].reset();
                        $('#progressoEnvio').hide();
                        $('#enviaObraRetorno').show();

                        if (data.sucesso) {
                            $("#mensagemResposta").text(data.resposta);
                            // document.location('sucesso.html');
                        } else {
                            alert(data.resposta);
                            $("#mensagemResposta").text(data.resposta);
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        $("#enviaObra")[0].show();
                        $('#progressoEnvio').hide();
                        $('#enviaObraRetorno').show();
                        $("#mensagemResposta").text('Houve um erro ao enviar os dados ao sistema. Tente novamente.');
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json"
                });

            });

        });
    </script>

</body>

</html>