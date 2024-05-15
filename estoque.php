<?php
session_start();
// header("refresh: 0.2");
require '_scripts/config.php';
?>

<!DOCTYPE html>

<html lang="pt_br">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu:wght@300;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="font-awesome/css/solid.min.css">
    <link rel="stylesheet" href="font-awesome/css/regular.min.css">
    <link rel="stylesheet" href="font-awesome/css/svg-with-js.min.css">
    <link rel="stylesheet" href="font-awesome/css/v4-shims.min.css">
    <link rel="stylesheet" href="css/home.css">
    <style>
        .container header {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>

<br>
   
<section class="">
 <div class="container">

   <fieldset>
   <h2>Estoque</h2>
   </fieldset>
   <br>
   <a href="home.php" class="btn btn-primary">Voltar</a>

   <br>
   <br>
   <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fas fa-clipboard-list"></i> Movimentações
            </div>
            <!--Panel Heading-->
            <div class="table-responsive">
              <table class="table table-striped table-condensed" style="min-height: 310px;">
                <thead>
                  <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Fornecedor</th>
                    <th>Quantidade</th>
                    <th>Valor de compra</th>
                    <th>Valor de venda</th>
                    <th>Registro</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    include '_scripts/config.php';
                    $entrada = [];
                    $sql = "SELECT * FROM pecas ORDER BY id_peca DESC";
                    $result = $mysqli->query($sql);

                    if ($result === false) {
                        die("Erro na consulta: " . $mysqli->error);
                    }

                    // Verifica se há resultados
                    if ($result->num_rows > 0) {
                        // Processa o resultado da consulta
                        while ($row = $result->fetch_assoc()) {
                            $entrada[] = $row;
                        }
                    } else {
                        echo "Não foram encontrados resultados.";
                    }

                                ?>
                    <?php foreach ($entrada as $item) : ?>
                        <tr>
                            <td><?php echo $item['id_peca']; ?></td>
                            <td><?php echo $item['nome_peca']; ?></td>
                            <td><?php echo $item['fornecedor_peca']; ?></td>
                            <td><?php echo $item['quantidade_peca']; ?></td>
                            <td><?php echo $item['valor_compra']; ?></td>
                            <td><?php echo $item['valor_venda']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($item['data_peca'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>

            </div>

            <a href="estoque.php" class="btn btn-success">Atualizar</a>
            <a href="estoque.php" class= "btn btn-danger">Excluir</a>

        </div>

</section>
</body>
</html>