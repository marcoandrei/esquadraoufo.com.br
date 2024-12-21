<?php

/*
 * geraSenha($numDigitos)
 * Retorna uma senha de tamanho $numDigitos 
 * com uma variação aleatória de caracteres definidos em $caracteres.
 */

function geraSenha($numDigitos)
{
	$caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	$senha = "";
	for ($i = 1; $i <= $numDigitos; $i++) {
		$senha .= substr($caracteres, rand(0, strlen($caracteres) - 1), 1);
	}
	return $senha;
}

/*
 * enviaEmail($destino,$assunto,$mensagem)
 * Envia por e-mail a $mensagem com o $assunto para o endereço $destino.   
 */

function enviaEmail($destino, $assunto, $mensagem)
{

	$mensagem = stripslashes($mensagem);

	// require_once 'PHPMailer/PHPMailerAutoload.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	require 'PHPMailer/src/Exception.php';


	$mail = new PHPMailer\PHPMailer\PHPMailer(true);
	$mail->setLanguage('br', 'PHPMailer/language/');
	$mail->CharSet = "utf-8";
	$mail->IsSendmail();
	$mail->Port = 587;
	$mail->IsSMTP();
	$mail->Host = "smtp.zoho.com";
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	$mail->Username = "projetos@fundosocialsicredi.com.br";
	$mail->Password = "FundoDesenvolvimentoSocial@2020";
	$mail->IsHTML(true);
	$mail->setFrom("projetos@fundosocialsicredi.com.br");
	$mail->addReplyTo("nao-responda@fundosocialsicredi.com.br");
	$mail->Subject = $assunto;
	$mail->Body = $mensagem;

	if (is_array($destino)) {
		foreach ($destino as $dest) {
			if (filter_var($dest, FILTER_VALIDATE_EMAIL)) {
				$mail->AddAddress($dest);
			}
		}
	} else {
		if (filter_var($destino, FILTER_VALIDATE_EMAIL)) {
			$mail->AddAddress($destino);
		}
	}

	if ($mail->Send()) {
		return true;
	} else {
		return false;
	}
}

function limpaCNPJ($valor)
{
	$valor = trim($valor);
	$valor = str_replace(".", "", $valor);
	$valor = str_replace(",", "", $valor);
	$valor = str_replace("-", "", $valor);
	$valor = str_replace("/", "", $valor);
	$valor = str_replace(" ", "", $valor);
	return $valor;
}

function limpaValor($valor)
{
	$valor = preg_replace("/[^0-9\,]/", "", $valor);
	return $valor;
}


function sanitizeString($string)
{

	// matriz de entrada
	$what = array('ä', 'ã', 'à', 'á', 'â', 'ê', 'ë', 'è', 'é', 'ï', 'ì', 'í', 'ö', 'õ', 'ò', 'ó', 'ô', 'ü', 'ù', 'ú', 'û', 'À', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', 'ç', 'Ç', ' ', '-', '(', ')', ',', ';', ':', '|', '!', '"', '#', '$', '%', '&', '/', '=', '?', '~', '^', '>', '<', 'ª', 'º');

	// matriz de saída
	$by   = array('a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'A', 'A', 'E', 'I', 'O', 'U', 'n', 'n', 'c', 'C', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_');

	// devolver a string
	return str_replace($what, $by, $string);
}


// Função que aplica uma máscara a um valor ou palavra determinada.
// Exemplo de uso: aplicaMascara( $cnpj, '##.###.###/####-##' );

function aplicaMascara($val, $mask)
{
	$maskared = '';
	$k = 0;
	for ($i = 0; $i <= strlen($mask) - 1; $i++) {
		if ($mask[$i] == '#') {
			if (isset($val[$k]))
				$maskared .= $val[$k++];
		} else {
			if (isset($mask[$i]))
				$maskared .= $mask[$i];
		}
	}
	return $maskared;
}


// Cria uma matriz com os nomes dos campos do projeto

$nomesCampos = array(
	"contato_nome" => "Nome do contato",
	"contato_email" => "E-mail do contato",
	"contato_fone" => "Fone do contato",

	"entidade_nome" => "Nome da entidade",
	"entidade_cnpj" => "CNPJ da entidade",
	"entidade_endereco" => "Endereço da entidade",
	"entidade_municipio" => "Município da entidade",
	"entidade_web" => "Endereço na Web da entidade",
	"entidade_conta" => "Conta da entidade no Sicredi",
	"entidade_repr_nome" => "Representante legal da entidade",
	"entidade_repr_cargo" => "Cargo do representante legal",

	"projeto_nome" => "Nome do projeto",
	"projeto_resp" => "Responsável pelo projeto",
	"projeto_local" => "Local do projeto",
	"projeto_endereco" => "Endereço do projeto",
	"projeto_objetivo" => "Objetivos do projeto",
	"projeto_periodo" => "Período do projeto",
	"projeto_existe" => "Projeto já existe",
	"projeto_pessoas" => "Número de pessoas beneficiadas",
	"projeto_publico" => "Público-alvo do projeto",
	"projeto_beneficios" => "projeto_beneficios",
	"projeto_total" => "Valor total do projeto",
	"projeto_valor" => "Valor solicitado para o projeto",
	"projeto_contra" => "Valor de contrapartida",
	"projeto_parcial" => "Aceita receber o valor parcial?",
	"projeto_apoiadores"  => "Outros apoiadores do projeto",
	"projeto_orcamento" =>  "Documento PDF com o orçamento do projeto",
	"projeto_info" => "Documento PDF com outras informações do projeto",
);
