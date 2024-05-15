<?php
    session_start();
    if(empty($_SESSION)){
        print "<script>location.href='index.php';</script>";
    }

?>

<link rel="stylesheet" href="assets/css/home.css">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



<header>
      <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
        <div class="container-fluid">
       
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarNav">


                <a class="navbar-brand" href="#">
                    <img src="assets/img/logo-novaalianca.png" alt="Nova Aliança Auto Services" class="logo">
                </a>

                <ul class="navbar-nav mt-1">
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="entrada.php">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="estoque.php">Estoque</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="saida.php">Vendas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calendario.php">Calendário</a>
                </li>
               
                
                </ul>
                <div class="d-flex botao-nav">
                    <a type="button" class="btn btn-danger justify-content-end" href="lougout.php">Sair</a>
                </div>
            </div>
        </div>
      </nav>
    </header>
    <br>

        <style>
        .btn-print {
        background-color: #007bff; 
        color: #fff; 
        border-color: #007bff; 
        font-weight: bold;
        margin-top: 10px;
        }
        .btn-print:focus, .btn-print:hover {
        background-color: #0056b3; 
        border-color: #0056b3; 
        }
   
    </style>
    
</head>
<body>
  <div class="container col-md-11">

    <a type="button" class="btn btn-print" href="home.php"><?php print "Olá, " . $_SESSION["nome_usuario"];?></a>

    <!-- <button type="button" class="btn btn-print">Imprimir</button>
    <a></a> -->
  </div>
</body>
</html>



        
        
    </div>



    <!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Estoque</title>
  <!-- Bootstrap CSS -->
  <!-- Latest compiled and minified CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu:wght@300;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="font-awesome/css/solid.min.css">
  <link rel="stylesheet" href="font-awesome/css/regular.min.css">
  <link rel="stylesheet" href="font-awesome/css/svg-with-js.min.css">
  <link rel="stylesheet" href="font-awesome/css/v4-shims.min.css">
  <link rel="stylesheet" href="css/home.css">

</head>
<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">


        <a href = "home.php" class= "navbar-brand" >
        <p class="font-weight-bold">Nova Aliança - Auto Service</p>
        </a>

      </div>
      
      <!--Navbar-header-->
      <div class="collapse navbar-collapse" id="barra-nav">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="sair.php"><i class="fas fa-sign-out-alt"></i>Sair</a></li>
        </ul>

      </div>
      <!--Collaose navbar-collapse-->
    </div> 
    <!--container-fluid-->
  </nav> <!--Nav-->
 <!--Fim Barra de navegação-->
  <main>
    <div class="container-fluid">
      <div class="row">

        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <div class="list-group">

            <a href="#" class="list-group-item active">
              <i class="fas fa-boxes fa-2x"></i>
            <a href="entrada.php" class="list-group-item">
            <i class="far fa-folder-open fa-2x"></i> Cadastrar Produto</a>
            <a href="estoque.php" class="list-group-item"><i class="fas fa-pallet fa-2x"></i>Consultar Estoque</a>
            <a href="saida.php" class="list-group-item"><i class="fas fa-dolly fa-2x"></i>Vendas</a>
            <a href="calendario.php" class="list-group-item"><i class="fas fa-dolly fa-2x"></i>Calendário</a>

          </div>
        </div><!--Listgroup-->

        <!--Col-sm divsao sidbar/-->

        <!--Fim barra lateral itens-->
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

          <div class="box-titulo">
            <h2></i>Estoque atual</h2>
          </div>

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
            <!--Table-responsive-->
          </div>

        </div>
        <!--Col-md-9-->


      </div>
      <!--row-->
    </div>
    <!--Container-fluid-->
  </main>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
