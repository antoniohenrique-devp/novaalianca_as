<?php
session_start();
require '_scripts/config.php';

$server = 'localhost';
$user = 'root';
$password = '';
$db = 'novaalianca_as';

$mysqli = new mysqli($server, $user, $password, $db,3306);

if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

$sql = "SELECT id_evento, nome_evento, data_evento, horario_evento FROM eventos";
$result = $mysqli->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = [
            'id' => $row['id_evento'],
            'title' => $row['nome_evento'],
            'start' => $row['data_evento'] . 'T' . $row['horario_evento'] 
        ];
    }
}

$mysqli->close();
?>


<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/calendario.css">

    <script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      eventTimeFormat: {
      hour: 'numeric',
      minute: '2-digit',
      hour12: false
    },
      events: <?php echo json_encode($events); ?> 
    });
    calendar.render();
  });
</script>

  </head>
  <body>
  <a type="button" class="btn btn-dark justify-content-end mt-3 ml-3" href="home.php">Voltar</a>
  <a type="button" class="btn btn-dark justify-content-end mt-3 ml-3 align-item" href="registro_evento.php">Criar promoção</a>


    <div id='calendar'></div>
  </body>
</html>