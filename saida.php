<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php
session_start();
require_once '_scripts/config.php';

$server = 'localhost';
$user = 'root';
$password = '';
$db = 'novaalianca_as';

$mysqli = new mysqli($server, $user, $password, $db, 3306);

if (isset($_POST['id_produto'], $_POST['desc_venda'], $_POST['quantidade'], $_POST['total'])) {
    // Validar os dados recebidos
    $id_produto = $_POST['id_produto'];
    $desc_venda = $_POST['desc_venda'];
    $quantidade = $_POST['quantidade'];
    $total = $_POST['total'];

    // Verificar se os dados não estão vazios
    if (empty($id_produto) || empty($desc_venda) || empty($quantidade) || empty($total)) {
        echo "Por favor, preencha todos os campos.";
        exit();
    }

    $sql = "INSERT INTO vendas (id_produto, desc_venda, quantidade, total) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        // Bind dos parâmetros e execução da consulta
        $stmt->bind_param("ssdd", $id_produto, $desc_venda, $quantidade, $total);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: home.php");
            exit();
        } else {
            echo "Erro ao cadastrar peça: " . $stmt->error;
        }
    } else {
        echo "Erro ao preparar a consulta.";
    }
    
    // Fechar a conexão com o banco de dados
    $mysqli->close();
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Vendas</h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <a type="button" class="btn btn-primary justify-content-end" href="home.php">Voltar</a>
            </li>
        </ol>
        <div class="table-responsive">
              <table class="table table-striped table-condensed" style="min-height: 310px;">
                <thead>
                  <tr>
                    <th>Descricao</th>
                    <th>Quantidade</th>
                    <th>Valor total</th>
                    <th>Data</th>
                  </tr>
                </thead>
                    <tbody>
                        <?php 
                        include '_scripts/config.php';
                        
                        $entrada = [];
                        $sql = "SELECT * FROM vendas ORDER BY id_venda DESC";
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
                                <td><?php echo $item['desc_venda']; ?></td>
                                <td><?php echo $item['quantidade']; ?></td>
                                <td><?php echo $item['total']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($item['data_venda'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                     </tbody>
             </div>  
          </div>

        <section class="formulario">
            <div class="container">
                <form class="form" method="POST">
                    <fieldset>
                        <legend><h2>Dados</h2></legend>
                
                            <div class="row">
                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Código do produto</label>
                                                <input type="number" name="id_produto" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Quantidade</label>
                                                <input type="number" name="quantidade" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Descrição</label>
                                                <input class="form-control" type="text" name="desc_venda">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Valor total</label>
                                                <input type="number" class="form-control" name="total" min="0.00" step="0.01" value="0.00">
                                            </div>
                                        </div>


                                    <button type="submit" class="mt-5 btn btn-block btn-primary">Vender</button>
                                    <br>
                                    <br>

                        </div>
                    </fieldset>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
