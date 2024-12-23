/**
 * ESQUADRÃO UFO
 *
 * Funções JS
 *
**/

// Função que apaga arquivos.

function apagarArquivo(path, file) {
  if (confirm("Você deseja realmente apagar este arquivo?")) {
    document.location = "apagarArquivo.php?arquivo=" + path + file;
  }
}

// VALIDAÇÃO DE DADOS NOS FORMULÁRIOS

// Função que mostra as mensagens de erro

function mostraErro(elemId, hintMsg) {
  document.getElementById(elemId).innerHTML = hintMsg;
}

/* validaDadosOrcamentoItem()
// Valida os dados dos itens do orçamento
–––––––––––––––––––––––––––––––––––––––––––––––––– */
function validaDadosOrcamentoItem() {
  // Variáveis do form
  var valor = document.form_projeto_orcamento.item_valor.value;
  var descricao = document.form_projeto_orcamento.item_descricao.value;
  var nomearq = document.form_projeto_orcamento.item_nomearq.value;

  // Variáveis de erro
  var valorErr = true;
  var descricaoErr = true;
  var nomearqErr = true;

  // Validando o valor
  var er = new RegExp("[0-9],[0-9]");

  if (valor == null || valor == "" || valor == "0") {
    mostraErro("valorErr", "Insira um valor que seja diferente de zero.");
  } else {
    if (er.test(valor)) {
      mostraErro("valorErr", "");
      valorErr = false;
    } else {
      mostraErro("valorErr", "Insira o valor do item no formato 9999,99.");
    }
  }

  // Validando a descrição
  if (descricao == null || descricao == "") {
    mostraErro("descricaoErr", "Preencha a descrição deste item.");
  } else {
    mostraErro("descricaoErr", "");
    descricaoErr = false;
  }

  // Validando o arquivo
  if (nomearq == null || nomearq == "") {
    mostraErro("nomearqErr", "Escolha um arquivo para enviar.");
  } else {
    mostraErro("nomearqErr", "");
    nomearqErr = false;
  }

  // Impede do formulário ser enviado se houver erros
  if ((descricaoErr || valorErr || nomearqErr) == true) {
    return false;
  }
}

/* validaDadosComprovante()
// Valida os dados dos comprovantes (notas fiscais)
–––––––––––––––––––––––––––––––––––––––––––––––––– */

function validaDadosComprovante() {
  // Variáveis do form
  var codigo = document.form_projeto_notas.nf_codigo.value;
  var valor = document.form_projeto_notas.nf_valor.value;

  var nomearq = document.form_projeto_notas.nf_nomearq.value;

  // Variáveis de erro
  var codigoErr = true;
  var valorErr = true;
  var nomearqErr = true;

  // Validando o código
  if (codigo == null || codigo == "") {
    mostraErro("codigoErr", "Insira um código para o comprovante.");
  } else {
    mostraErro("codigoErr", "");
    codigoErr = false;
  }

  // Validando o valor
  var er = new RegExp("[0-9],[0-9]");

  if (valor == null || valor == "" || valor == "0") {
    mostraErro("valorErr", "Insira um valor que seja diferente de zero.");
  } else {
    if (er.test(valor)) {
      mostraErro("valorErr", "");
      valorErr = false;
    } else {
      mostraErro(
        "valorErr",
        "Insira o valor do comprovante no formato 9999,99."
      );
    }
  }

  // Validando o arquivo
  if (nomearq == null || nomearq == "") {
    mostraErro("nomearqErr", "Escolha um arquivo para enviar.");
  } else {
    mostraErro("nomearqErr", "");
    nomearqErr = false;
  }

  // Impede do formulário ser enviado se houver erros
  if ((codigoErr || valorErr || nomearqErr) == true) {
    return false;
  }
}

// Função que valida o envio de fotos

function validaDadosFotos() {
  // Variáveis do form
  var foto = document.form_projeto_fotos.foto_nomearq.value;
  var descricao = document.form_projeto_fotos.foto_descricao.value;

  // Variáveis de erro
  var fotoErr = true;
  var fotoDescrErr = true;

  // Validando a descrição
  if (descricao == null || descricao == "") {
    mostraErro("fotoDescrErr", "Preencha a descrição deste item.");
  } else {
    mostraErro("fotoDescrErr", "");
    fotoDescrErr = false;
  }

  // Validando o código
  if (foto == null || foto == "") {
    mostraErro("fotoErr", "Escolha um arquivo para enviar.");
  } else {
    mostraErro("fotoErr", "");
    fotoErr = false;
  }

  // Impede do formulário ser enviado se houver erros
  if (fotoErr || fotoDescrErr == true) {
    return false;
  }
}

// Função que valida a gravação de projetos
function validaDadosGravaProjeto() {
  //Variáveis do form
  var nome_projeto = document.form_projeto_cadastro.projeto_nome.value;

  // Variáveis de erro
  var nomeProjErr = true;

  // Validando a descrição
  if (nome_projeto == null || nome_projeto == "") {
    mostraErro(
      "nomeProjErr",
      "O nome do projeto é uma informação obrigatória."
    );
    document.getElementById("projeto-nome").focus();
  } else {
    mostraErro("nomeProjErr", "");
    nomeProjErr = false;
  }

  // Impede do formulário ser enviado se houver erros
  if (nomeProjErr == true) {
    return false;
  }
}

// Função que apaga o comprovante

function apagaComprovante(id) {
  if (confirm("Você deseja realmente apagar este item?")) {
    $("#idComprov").val(id);
    $("#formApagaComprov").submit();
  }
}

// Função que valida CNPJ

function validaCNPJ(ObjCnpj) {
  var cnpj = ObjCnpj.value;
  var valida = new Array(6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
  var dig1 = new Number();
  var dig2 = new Number();

  exp = /\.|\-|\//g;
  cnpj = cnpj.toString().replace(exp, "");
  var digito = new Number(eval(cnpj.charAt(12) + cnpj.charAt(13)));

  for (i = 0; i < valida.length; i++) {
    dig1 += i > 0 ? cnpj.charAt(i - 1) * valida[i] : 0;
    dig2 += cnpj.charAt(i) * valida[i];
  }
  dig1 = dig1 % 11 < 2 ? 0 : 11 - (dig1 % 11);
  dig2 = dig2 % 11 < 2 ? 0 : 11 - (dig2 % 11);

  if (dig1 * 10 + dig2 != digito) alert("CNPJ inválido!");
}

// Função que faz o filtro automático sobre o resultado das buscas

$(function () {
  $("#tabela-filtro input").keyup(function () {
    var index = $(this).parent().index();
    var nth = "#tabela-filtro td:nth-child(" + (index + 1).toString() + ")";
    var valor = $(this).val().toUpperCase();
    $("#tabela-filtro tbody tr").show();
    $(nth).each(function () {
      if ($(this).text().toUpperCase().indexOf(valor) < 0) {
        $(this).parent().hide();
      }
    });
  });

  $("#tabela-filtro input").blur(function () {
    $(this).val("");
  });
});

// ---------------------
// MÁSCARAS
// ---------------------

// Máscara para CNPJ e valores em reais

$(document).ready(function () {
  $(".mascara-cpf").mask("000.000.000-00", {
    reverse: true,
  });
  $(".mascara-cnpj").mask("00.000.000/0000-00", {
    reverse: true,
  });
  $(".mascara-valor-reais").mask("#.##0,00", {
    reverse: true,
  });
  $(".mascara-inteiros").mask("0#");
});




// ---------------------
// CADASTRO DE USUÁRIOS
// ---------------------

// Função que apaga usuários.

function apagaUsuario(id) {
  if (confirm("Você deseja realmente apagar este usuário?")) {
    document.location = "admin-apaga-usuario.php?id=" + id;
  }
}

// ---------------------
// CADASTRO DE AGÊNCIAS
// ---------------------

// Função que apaga agências.

function apagaAgencia(id) {
  if (confirm("Você deseja realmente apagar esta agência?")) {
    document.location = "admin-apaga-agencia.php?id=" + id;
  }
}

// ---------------------
// CADASTRO DE PROJETOS
// ---------------------

// Função que apaga itens de listas

function apagaItem(id) {
  if (confirm("Você deseja realmente apagar este item?")) {
    $("#idItem").val(id);
    $("#formApagaItem").submit();
  }
}

