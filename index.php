<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<?php 
session_start();
include("_scripts/config.php");


session_destroy();
?>

<link rel="stylesheet" href="assets/css/login.css">


<div class="wrapper fadeInDown">
  <div id="formContent">

    <div class="fadeIn first">
      <img src="assets/img/logo-novaalianca.png" id="icon" alt="Icon" />
    </div>

      <h5>Acesso Restrito</h5>
    
    <form action="login.php" method="POST">
      <input type="text" class="fadeIn second" name="email_usuario" placeholder="E-mail" required>
      <input type="text"  class="fadeIn third" name="senha_usuario" placeholder="Senha" required>
      <!-- <input type="submit" class="fadeIn fourth" <a href:"functions/login.php" value="Entrar"" > -->
      <button type="submit" class="btn btn-primary" href="functions/login.php">Entrar</button>


    </form>
<!-- 
    <div id="formFooter">
      <a class="underlineHover" href="_scripts/register_user.php">Não tem conta? Registre-se</a>
    </div> -->



  </div>
</div>
