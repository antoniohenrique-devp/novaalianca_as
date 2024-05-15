<?php
session_start();
require '_scripts/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar e limpar os dados recebidos do formulário
    $nome_evento = trim($_POST["nome_evento"]);
    $data_evento = trim($_POST["data_evento"]);
    $horario_evento = trim($_POST["horario_evento"]);

    // Validar os campos
    if (empty($nome_evento) || empty($data_evento) || empty($horario_evento)) {
        echo "Por favor, preencha todos os campos.";
        exit(); // Encerrar o script se algum campo estiver vazio
    }

    // Usar prepared statement para inserção segura
    $sql = "INSERT INTO eventos (nome_evento, data_evento, horario_evento) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        echo "Erro na preparação da consulta.";
        exit();
    }

    // Bind dos parâmetros e execução da query
    $stmt->bind_param("sss", $nome_evento, $data_evento, $horario_evento);
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: calendario.php");
        exit();
    } else {
        echo "Erro ao cadastrar evento: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close(); 
}
?>
