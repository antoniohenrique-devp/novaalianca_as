<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/calendario.css">

</head>

<body>
  <div class="container">
    <div class="page-header">
      <h1>Registrar Promoção</h1>
    </div>

    <ol class="breadcrumb">
      <li>
        <a type="button" class="btn btn-dark justify-content-end" href="calendario.php">Ver calendário</a>
      </li>
    </ol>

    <div class="row">
      <div class="col-md-4">
        <form action="salvar_evento.php" method="POST">
          <div class="form-group">
            <label>Nome da promoção</label>
            <input type="text" class="form-control" name="nome_evento">
          </div>

          <div class="form-group">
            <label>Data da Promoção</label>
            <input type="date" class="form-control" name="data_evento">
          </div>

          <div class="form-group">
            <label>Horário da promoção</label>
            <input type="time" class="form-control" name="horario_evento">
          </div>
          <a type="button" class="btn btn-dark justify-content-end" href="home.php">Home</a>
    <button type="submit" class="btn btn-dark">Criar</button>
        </form>
      </div>
    </div>
  <br>

  </div>

</body>

</html>
