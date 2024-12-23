<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../sistema/include/connect.php";
require "../sistema/include/funcoes.php";

$diretorio = "../sistema/repositorio/";

$sucesso = 0;

$mensagem = "<h1>ERRO!</h1><p>Houve um problema ao enviar sua colaboração. Por favor, tente novamente.</p>";

if (isset($_POST["gravaObra"])) {

    extract($_POST, EXTR_OVERWRITE);

    /* CEDENTE */

    // Grava cedente no BD

    $cria_cedente = "
        
            insert into cedentes ( 
            
                nome,
                nacionalidade,
                estado_civil,
                profissao,
                cpf,
                rg,
                sexo,
                data_nasc,
                endereco,
                cidade,
                estado,
                pais,
                email,
                celular                
            ) 
            
            values ( 
                '$nome',
                '$nacionalidade',
                '$estado_civil',
                '$profissao',
                '$cpf',
                '$rg',
                '$sexo',
                '$data_nasc',
                '$rua',
                '$cidade',
                '$uf',
                '$pais',
                '$email',
                '$celular'
            )
        
        ";

    if (!$bd->query($cria_cedente)) { // assuming $bd is the connection
        $error = $bd->errno . ' ' . $bd->error;
        echo $error; // 1054 Unknown column 'foo' in 'field list'
        echo '<p class="erro">ERRO! Houve um problema durante a gravação na base de dados.<br/><br/>Por favor, entre em contato com o administrador do sistema.<br/><br/></p>';
        exit;
    }

    $cedente_id = mysqli_insert_id($bd);


    // Envia documentos do cedente para o repositório

    $rgNomeArquivo = "";

    if (is_uploaded_file($_FILES['cedente_rg']['tmp_name'])) {

        $rgNomeArquivo = sanitizeString($_FILES['cedente_rg']['name']);
        $pathNomeArquivo = "../sistema/repositorio/" . $cedente_id . "-rg__" . $rgNomeArquivo;
        move_uploaded_file($_FILES['cedente_rg']['tmp_name'], $pathNomeArquivo);
    }

    $adicRg = $bd->query("UPDATE cedentes SET identidade_nomearq = '$rgNomeArquivo' WHERE id = $cedente_id");

    if ($bd->error) {
        echo $bd->error;
        echo '<p class="erro">ERRO! Houve um problema durante a gravação na base de dados.<br/><br/>Por favor, entre em contato com o administrador do sistema.<br/><br/></p>';
        die;
    }

    $selfNomeArquivo = "";

    if (is_uploaded_file($_FILES['cedente_selfie']['tmp_name'])) {

        $selfNomeArquivo = sanitizeString($_FILES['cedente_selfie']['name']);
        $pathNomeArquivo = "../sistema/repositorio/" . $cedente_id . "-selfie__" . $selfNomeArquivo;
        move_uploaded_file($_FILES['cedente_selfie']['tmp_name'], $pathNomeArquivo);
    }

    $adicSelf = $bd->query("UPDATE cedentes SET selfie_nomearq = '$selfNomeArquivo' WHERE id = $cedente_id");

    if ($bd->error) {
        echo $bd->error;
        echo '<p class="erro">ERRO! Houve um problema durante a gravação na base de dados.<br/><br/>Por favor, entre em contato com o administrador do sistema.<br/><br/></p>';
        die;
    }


    /* OBRA */

    // Grava obra no BD

    $cria_obra = $bd->query("
        
            insert into obras ( 
            
                cedente_id,
                titulo,
                duracao,
                data_obra,
                ineditismo,
                data_gravacao,
                hora_gravacao,
                local_gravacao,
                cidade_gravacao,
                direcao_objeto,
                descricao_ocorrido,
                testemunhas            
            ) 
            
            values ( 
                '$cedente_id',
                '$titulo',
                '$duracao',
                '$data_obra',
                '$ineditismo',
                '$data_gravacao',
                '$hora_gravacao',
                '$local_gravacao',
                '$cidade_gravacao',
                '$direcao_objeto',
                '$descricao_ocorrido',
                '$testemunhas'
            )
        
        ");

    if ($bd->error) {
        echo $bd->error;
        echo '<p class="erro">ERRO! Houve um problema durante a gravação na base de dados.<br/><br/>Por favor, entre em contato com o administrador do sistema.<br/><br/></p>';
        die;
    }

    $obra_id = mysqli_insert_id($bd);


    // Envia vídeo da obra para o repositório

    $vidNomeArquivo = "";

    if (is_uploaded_file($_FILES['video_nomearq']['tmp_name'])) {

        $vidNomeArquivo = sanitizeString($_FILES['video_nomearq']['name']);
        $pathNomeArquivo = "../sistema/repositorio/video_" .  $obra_id . "__" . $vidNomeArquivo;
        move_uploaded_file($_FILES['video_nomearq']['tmp_name'], $pathNomeArquivo);
    }

    $adicVid = $bd->query("UPDATE obras SET video_nomearq = '$vidNomeArquivo' WHERE id = $obra_id");


    // Envia vídeo da obra para o repositório

    $fotos = $_FILES['fotos'];

    $c = count($fotos['name']);

    for ($i = 0; $i < $c; ++$i) {

        $fotoNomeArquivo = sanitizeString($fotos['name'][$i]);
        $pathNomeArquivo = $diretorio . "foto" . "_" . $obra_id . "-" . $i . "__" . $fotoNomeArquivo;

        $upload = move_uploaded_file(
            $fotos['tmp_name'][$i],
            $pathNomeArquivo
        );

        if ($upload) {
            $adicFoto = $bd->query("
                
            insert into obras_fotos ( 
            
                obra_id,
                foto_nomearq
                
            ) 
            
            values ( 
                '$obra_id',
                '$fotoNomeArquivo'
            )


            ");
        }
    }


    $mensagem = "<h1>Muito obrigado por sua colaboração!</h1>
    <p>Vamos analisar seu conteúdo e entraremos em contato caso ele possa ser aproveitado.</p>";
    $sucesso = 1;
} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esquadrão UFO</title>

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

    <section id="gravacaoObraRetorno">

        <div class="conteudo">

            <img src="img/esquadrao-ufo-logo.png" height="150">

            <?= $mensagem ?>

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

    <script src="js/funcoes.js"></script>

</body>

</html>