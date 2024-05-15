<?php
session_start();
require '_scripts/config.php';

if (isset($_GET['id_peca']) && !empty($_GET['id_peca'])) {
    // Utilize prepared statements para evitar SQL Injection
    $id_peca = $_GET['id_peca'];
    $stmt = $mysqli->prepare("DELETE FROM pecas WHERE id_peca = ?");
    $stmt->bind_param("i", $id_peca); // "i" indica que é um parâmetro inteiro
    $stmt->execute();
    
    // Verifica se a exclusão foi bem-sucedida
    if ($stmt->affected_rows > 0) {
        $_SESSION['mensagem'] = "Peça excluída com sucesso.";
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir peça.";
    }

    $stmt->close();
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
    <h2>Excluir Peça</h2>
    <br>
    <a href="estoque.php" class="btn btn-primary">Voltar</a>
    <br>
    <br>
    <br>
    <form method="POST">
    <div class="col-md-6">
    <div class="form-group">
        <label>Código da peça</label>
        <input class="form-control" type="number" min="1" step="1" name="id_peca" value="<?php echo isset($dado['id_peca']) ? $dado['id_peca'] : ''; ?>">
    </div>
    <button type="submit" class="btn btn-block btn-danger">Excluir</button>
</div>


      </div>
    </form>
  </div>
