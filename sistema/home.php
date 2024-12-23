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

            <table class="table table-striped lista-obras">
                <tr>
                    <th></th>
                    <th>Entrada</th>
                    <th>Obra</th>
                    <th>Cedente</th>
                    <th>Cidade</th>
                    <th>Atendente</th>
                </tr>

                <?php

                $result = $bd->query("
                
                    SELECT obras.id AS obra_id, DATE_FORMAT(obras.data_entrada, '%d/%m/%Y %H:%i') AS obra_entrada, obras.titulo AS obra_titulo, cedentes.nome AS cedente_nome, cedentes.cidade AS cedente_cidade, obras.status AS obra_status, obras.responsavel AS obra_resp
                    FROM obras INNER JOIN cedentes ON obras.cedente_id = cedentes.id
                
                ");

                if ($result) {

                    while ($row = $result->fetch_assoc()) {


                        $icone = "fa fa-square-o";    // define o ícone
                        $cor = "red"; // define a cor
                        $status = "não atendido";

                        switch ($row['obra_status']) { // verifica o status
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
                                    <a href="encerra-obra.php?id=<?= $row['obra_id'] ?>" title="<?= $status ?>">
                                    <?php } ?>
                                    <i class="<?= $icone ?>" style="color: <?= $cor ?>;" aria-hidden="true"></i>
                                    <?php if ($eh_admin) { ?>
                                    </a>
                                <?php } ?>
                            </td>

                            <!-- data de entrada -->
                            <td>
                                <a href="ver-obra.php?id=<?= $row['obra_id'] ?>">
                                    <?= $row['obra_entrada'] ?>
                                </a>
                            </td>
                            <!-- nome da obra -->
                            <td>
                                <a href="ver-obra.php?id=<?= $row['obra_id'] ?>">
                                    <?= $row['obra_titulo'] ?>
                                </a>
                            </td>
                            <!-- nome do cedente -->
                            <td>
                                <a href="ver-obra.php?id=<?= $row['obra_id'] ?>">
                                    <?= $row['cedente_nome'] ?>
                                </a>
                            </td>
                            <!-- cidade do cedente -->
                            <td>
                                <?= $row['cedente_cidade'] ?>
                            </td>
                            <!-- responsável -->
                            <td>
                                <?= $row['obra_resp'] ?>
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
