<?php
    session_start();
    unset($_SESSION["email"], $_SESSION["nome"], $_SESSION["tipo"]);
    session_destroy();
    header("Location:index.php");
    exit;


?>