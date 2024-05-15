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

if (isset($_POST['nome_peca'], $_POST['fornecedor_peca'], $_POST['quantidade_peca'], $_POST['valor_compra'], $_POST['valor_venda'])) {
    $nome_peca = $_POST['nome_peca'];
    $fornecedor_peca = $_POST['fornecedor_peca'];
    $quantidade_peca = $_POST['quantidade_peca'];
    $valor_compra = $_POST['valor_compra'];
    $valor_venda = $_POST['valor_venda'];


    $sql = "INSERT INTO pecas (nome_peca, fornecedor_peca, quantidade_peca, valor_compra, valor_venda) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssddd", $nome_peca, $fornecedor_peca, $quantidade_peca, $valor_compra, $valor_venda);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: home.php");
            exit();
        } else {
            echo "Erro ao cadastrar peça: " . $stmt->error;
        }
    }
    
    $mysqli->close();
}
?>


<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="font-awesome/css/solid.min.css">
  <link rel="stylesheet" href="font-awesome/css/regular.min.css">
  <link rel="stylesheet" href="font-awesome/css/svg-with-js.min.css">
  <link rel="stylesheet" href="font-awesome/css/v4-shims.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu:wght@300;700&display=swap" rel="stylesheet">
</head>

<body>

  <div class="container">

  <form class="form" method="POST">
      <h1>Cadastrar produto</h1>
<br>
      <a href="home.php" class="btn btn-primary">Voltar</a>

      <br>
      <br>

      <fieldset>
        <legend>
          <h2>Dados</h2>
        </legend>

                        <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nome da peça</label>
                            <input class="form-control" type="text" name="nome_peca">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fornecedor</label>
                            <input type="text" class="form-control" name="fornecedor_peca">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Quantidade</label>
                            <input type="number" min="1" step="1" value="0" name="quantidade_peca" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Valor de compra</label>
                            <input type="number" class="form-control" min="0.00" step="0.01" value="0.00" name="valor_compra">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Valor de venda</label>
                            <input type="number" class="form-control" min="0.00" step="0.01" value="0.00" name="valor_venda">
                            
                        </div>
                    </div>
                    
                    </div>
                    <button type="submit" class="btn btn-block btn-primary mt-5">Cadastrar</button>

                        <div class="col-md-6">
                </div>

      </fieldset>
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>