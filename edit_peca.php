<?php
session_start();
require '_scripts/config.php';

$dado = [];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if ID is set and not empty
    if (isset($_POST['id_peca']) && !empty($_POST['id_peca'])) {
        
        $id_peca = $_POST['id_peca'];
        $nome_peca = $_POST['nome_peca'];
        $fornecedor_peca = $_POST['fornecedor_peca'];
        $quantidade_peca = $_POST['quantidade_peca'];
        $valor_compra = $_POST['valor_compra'];
        $valor_venda = $_POST['valor_venda'];

        // Prepare and bind SQL statement
        $stmt = $mysqli->prepare("UPDATE pecas SET nome_peca=?, fornecedor_peca=?, quantidade_peca=?, valor_compra=?, valor_venda=? WHERE id_peca=?");
        $stmt->bind_param("ssdddi", $nome_peca, $fornecedor_peca, $quantidade_peca, $valor_compra, $valor_venda, $id_peca);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: home.php");
            exit;
        } else {
            echo "Erro ao atualizar: " . $stmt->error;
        }
    } else {
        echo "ID da peça não especificado.";
    }
}

// Fetch data for display
if (isset($_GET['id_peca']) && !empty($_GET['id_peca'])) {
    $id_peca = $_GET['id_peca'];
    $sql = "SELECT * FROM pecas WHERE id_peca = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_peca);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $dado = $result->fetch_assoc();
    } else {
        echo "Peça não encontrada.";
    }

    $stmt->close();
} else {
    echo "ID da peça não especificado.";
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>

<body>

  <div class="container">
    <br>
    <h2>Atualizar Peça</h2>
    <br>
    <a href="estoque.php" class="btn btn-primary">Voltar</a>
    <br>
    <br>
    <br>
    <form method="POST">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Código da peça</label>
            <input class="form-control" type="number" min="1" step="1" name="id_peca" value="<?php echo $id_peca['id_peca']; ?>" readonly>
          </div>

          <div class="form-group">

            <label>Nome</label>
            <input type="text" class="form-control" name="nome_peca" value="<?php echo $nome_peca['nome_peca']; ?>">
          </div>

          <div class="form-group">
            <label>Fornecedor</label>
            <input type="text" class="form-control" name="fornecedor_peca" value="<?php echo $fornecedor_peca['fornecedor_peca']; ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Quantidade</label>
            <input type="number" class="form-control" name="quantidade_peca" value="<?php echo $quantidade_peca['quantidade_peca']; ?>">
          </div>

          <div class="form-group">
            <label>Valor de Compra</label>
            <input type="number" class="form-control" name="valor_compra" value="<?php echo $valor_compra['valor_compra']; ?>">
          </div>

          <div class="form-group">
            <label>Valor de venda</label>
            <input type="number" class="form-control" name="valor_venda" value="<?php echo $valor_venda['valor_venda']; ?>">
          </div>

        </div>
        <button type="submit" class="btn btn-block btn-success">Atualizar</button>

      </div>
    </form>
  </div>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>
