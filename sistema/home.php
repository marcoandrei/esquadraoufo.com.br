<?php

/**
 * ESQUADRÃO UFO
 * 
 * » Painel administrativo
 * 
 */


require_once('include/checkLogin.php');
require_once('header.php');

?>


<!-- Monta o miolo -->

<div class="container">

    <div class="row">

        <div class="col-md-11">

            <?php

            // Variáveis

            $em_aberto = 0;
            $atendidas = 0;
            $fechadas = 0;

            ?>


            <h1>Esquadrão UFO</h1>
            <h2>Envio de colaborações</h2>
            <br /><br />

            <table class="table table-striped">
                <tr>
                    <th></th>
                    <th>Entrada</th>
                    <th>Nome</th>
                    <th>Cidade</th>
                    <th>Atendente</th>
                </tr>

                <?php

                $result = $bd->query("SELECT id, DATE_FORMAT(data_entrada, '%d/%m/%Y %H:%i') as data_entrada_2, nome, cidade, status, responsavel FROM cedentes");

                if ($result) {

                    while ($row = $result->fetch_assoc()) {


                        $icone = "fa fa-square-o";    // define o ícone
                        $cor = "red"; // define a cor
                        $status = "não atendido";

                        switch ($row['status']) { // verifica o status
                            case "0":
                                $status = "não atendido";
                                $em_aberto++;
                                break;
                            case "1":
                                $icone = "fa fa-check-square-o";
                                $cor = "orange";
                                $status = "atendido";
                                $atendidas++;
                                break;
                            case "2":
                                $icone = "fa fa-thumbs-o-up";
                                $cor = "green";
                                $status = "fechado";
                                $fechadas++;
                                break;
                        }

                ?>


                        <tr>
                            <!-- ícone do item -->
                            <td>
                                <?php if ($eh_admin) { ?>
                                    <a href="fecha-exame.php?id=<?= $row['id'] ?>" title="<?= $status ?>">
                                    <?php } ?>
                                    <i class="<?= $icone ?>" style="color: <?= $cor ?>;" aria-hidden="true"></i>
                                    <?php if ($eh_admin) { ?>
                                    </a>
                                <?php } ?>
                            </td>

                            <!-- data da solicitação -->
                            <td>

                                <?= $row['data_entrada_2'] ?>
                            </td>

                            <!-- dados do exame -->

                            <td>
                                <a href="edita-exame.php?id=<?= $row['id'] ?>" class="marcacao marcacao-nome">
                                    <?= $row['nome'] ?>
                                </a>

                            </td>

                            <td>
                                <?= $row['cidade'] ?>
                            </td>

                            <td>
                                <?= $row['responsavel'] ?>
                            </td>

                            <?php


                            ?>

                        </tr>


                <?php
                    } //endwhile
                } // endif
                ?>

            </table>
            <br />

            <?php
            echo '<p>Em aberto: ' . $em_aberto . ' — Atendidas: ' . $atendidas . ' — Fechadas: ' . $fechadas . '</p>';
            ?>


        </div>


    </div>
</div>

<?php

require_once('footer.php');
