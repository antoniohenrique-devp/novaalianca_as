<?php
session_start();

if(empty($_POST) or empty($_POST["email_usuario"]) or empty($_POST["senha_usuario"])){

    print "<script>location.href='index.php';</script>";
}

include('_scripts/config.php');

        $email = $_POST['email_usuario'];
        $senha = $_POST['senha_usuario'];

        $sql = "SELECT * FROM usuarios
                WHERE email_usuario = '{$email}' 
                AND senha_usuario = '".md5($senha)."'";

            $res = $mysqli->query($sql) or die($mysqli->error);

        $row = $res->fetch_object();

        $qtd = $res->num_rows;

        if($qtd > 0){
        $_SESSION["email_usuario"] = $email;
        $_SESSION["nome_usuario"] = $row->nome_usuario;
        $_SESSION["tipo"] = $row->tipo;
        print "<script>location.href='home.php';</script>";

        }else{
            print "<script>alert('Usuário e/ou senha incorreto(s)');</script>";
            print "<script>location.href='index.php';</script>";
        }


?>