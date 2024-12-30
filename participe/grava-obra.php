<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../sistema/include/connect.php";
require "../sistema/include/funcoes.php";

$diretorio = "../sistema/repositorio/";

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
        exit(json_encode(array('sucesso' => false, 'resposta' => $error . '<h1>ERRO!</h1><p class="erro">Houve um problema durante a gravação na base de dados.<br/><br/>Por favor, entre em contato com o administrador do sistema.<br/><br/></p>')));
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
        $error = $bd->errno . ' ' . $bd->error;
        exit(json_encode(array('sucesso' => false, 'resposta' => $error . '<h1>ERRO!</h1><p class="erro">Houve um problema durante a gravação na base de dados.<br/><br/>Por favor, entre em contato com o administrador do sistema.<br/><br/></p>')));
    }

    $selfNomeArquivo = "";

    if (is_uploaded_file($_FILES['cedente_selfie']['tmp_name'])) {

        $selfNomeArquivo = sanitizeString($_FILES['cedente_selfie']['name']);
        $pathNomeArquivo = "../sistema/repositorio/" . $cedente_id . "-selfie__" . $selfNomeArquivo;
        move_uploaded_file($_FILES['cedente_selfie']['tmp_name'], $pathNomeArquivo);
    }

    $adicSelf = $bd->query("UPDATE cedentes SET selfie_nomearq = '$selfNomeArquivo' WHERE id = $cedente_id");

    if ($bd->error) {
        $error = $bd->errno . ' ' . $bd->error;
        exit(json_encode(array('sucesso' => false, 'resposta' => $error . '<h1>ERRO!</h1><p class="erro">Houve um problema durante a gravação na base de dados.<br/><br/>Por favor, entre em contato com o administrador do sistema.<br/><br/></p>')));
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
        $error = $bd->errno . ' ' . $bd->error;
        exit(json_encode(array('sucesso' => false, 'resposta' => $error . '<h1>ERRO!</h1><p class="erro">Houve um problema durante a gravação na base de dados.<br/><br/>Por favor, entre em contato com o administrador do sistema.<br/><br/></p>')));
    }

    $obra_id = mysqli_insert_id($bd);

    exit(json_encode(array('sucesso' => true, 'resposta' => 'cedente e obra')));

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

    exit(json_encode(array('sucesso' => true, 'resposta' => '<h1>Muito obrigado por sua colaboração!</h1><p>Vamos analisar seu conteúdo e entraremos em contato caso ele possa ser aproveitado.</p>')));
} else {
    header("Location: index.php");
}
