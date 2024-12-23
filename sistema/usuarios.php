<?php

/**
 * ESQUADRÃO UFO
 * 
 * » Gestor de usuários
 * 
 */


require_once('include/checkLogin.php');

$msgErro = "";
$msgSucesso = "";

// Se houver um usuário enviado, cria o usuário.

if (isset($_POST["createUser"])) {

    if ($_POST["nomeUsr"] != "") {

        if ($_POST["emailUsr"] != "") {

            if ($_POST["senhaUsr"] != "") {

                $nomeUsr = $_POST["nomeUsr"];
                $emailUsr = $_POST["emailUsr"];
                $senhaUsr = md5($_POST["senhaUsr"] . $salt);

                if (isset($_POST["adminUsr"]))
                    $adminUsr = 1;
                else
                    $adminUsr = 0;

                $criado = $bd->query("insert into usuarios ( nome, email, senha, admin ) values ( '$nomeUsr', '$emailUsr', '$senhaUsr', $adminUsr )");

                $msgSucesso = "<i>Usuário " . $nomeUsr . " criado com sucesso.</i>";

            } else {
                $msgErro = "Por favor, preencha uma senha para o usuário.<br/>";
            }
        } else {
            $msgErro = "Por favor, entre com um e-mail válido.<br/>";
        }
    } else {
        $msgErro = "Por favor, preencha um nome para o usuário.<br/>";
    }
}

if ($eh_admin) {

    require_once('header.php');

    ?>

    <!-- Monta o miolo -->

    <div class="container">

        <div class="row">

            <div class="col-md-11">

                <h1>Esquadrão UFO</h1>
                <h2>Gestão de usuários</h2>
                <br /><br />

                <table class="table table-striped">

                    <?php

                    $result = $bd->query("select nome, email, admin from usuarios");

                    if ($result) {

                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>

                                <?php

                                $icone = "fa fa-user";

                                if ($row['admin']) {
                                    $icone = "fa fa-user-plus";
                                }

                                ?>

                                <!-- ícone de usuário -->
                                <td><i class="<?= $icone; ?>" aria-hidden="true"></i>&nbsp;</td>
                                <!-- nome do usuário -->
                                <td>
                                    <?= $row['nome'] ?>
                                    </a>&nbsp;
                                </td>

                                <td>
                                    <?= $row['email'] ?>
                                    </a>&nbsp;
                                </td>

                                <?php
                                if ($eh_admin) { // se o usuário é admin, permite apagar o arquivo
                                    ?>
                                    <td><i class='fa fa-trash-o' aria-hidden='true'></i></td>
                                    <?php
                                } // endif é admin
                                ?>

                            </tr>

                            <?php

                        } // endwhile
                
                    }

                    echo "</table>";

                    echo $msgSucesso;

                    $result->free();

                    ?>
                    &nbsp;&nbsp;
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Criar novo usuário </h3>
                            <p class="msgErro">
                                <?= $msgErro; ?>
                            </p>
                            <p class="help-block">Use este formulário para criar novos usuários do sistema.</p>

                            <form method="post" action="usuarios.php" id="criaUsuario">

                                <input type="hidden" id="createUser" name="createUser">

                                <div class="form-group">
                                    <label for="nomeUsr">Nome</label>
                                    <input type="text" class="form-control" id="nomeUsr" name="nomeUsr"
                                        placeholder="Nome do usuário">
                                </div>

                                <div class="form-group">
                                    <label for="emailUsr">E-mail</label>
                                    <input type="email" class="form-control" id="emailUsr" name="emailUsr"
                                        placeholder="nome@dominio.com">
                                </div>

                                <div class="form-group">
                                    <label for="senhaUsr">Senha</label>
                                    <input type="password" class="form-control" id="senhaUsr" name="senhaUsr"
                                        placeholder="Senha de acesso">
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="adminUsr" name="adminUsr"> Este usuário é administrador.
                                    </label>
                                </div>

                                <button type="submit" id="enviar" name="enviar" class="btn btn-default">Criar
                                    usuário</button>
                            </form>

                        </div>
                    </div>

            </div>

        </div>
    </div>


    <?php

    require_once('footer.php');
} else {
    header("Location: home.php"); // volta para a página inicial
}
?>


</body>

</html>