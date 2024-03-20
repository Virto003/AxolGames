<link rel="stylesheet" href="css/style.css">

<?php
$err = filter_input(INPUT_GET, 'err');
$err_msg = "";
if ($err == "101") {
   $err_msg = "Usuário ou senha incorretos";
}
if (isset($_SESSION['user'])) {
	header("location: index.php?p=pages/erro404.php");
	exit;
}
?>
<div class="col-12 page-content mx-auto justify-content-center pattern-bg">
   <div class="space-ls py-3">&nbsp;</div>
   <div class="col-9 mx-auto py-5 justify-content-center" id="login">
      <p class="axol-text" style="font-family: 'Montserrat', sans-serif;">Axol</p>
      <form class="mx-auto justify-content-center" method="post" action="class/Login_site/login.php">
         <div class="form-group">
            <input type="email" class="form-input" id="InputEmail" placeholder="Email" name="email" required>
         </div>
         <div class="form-group mb-0">
            <input type="password" class="form-input" id="InputPassword" placeholder="Senha" name="senha" required>
         </div>
         <div class="form-group mt-1" style="text-align: left;">
            <small style="color: red"><?= $err_msg ?></small>
         </div>
         <input type="submit" class="btn btn-form grow mb-4" value="Entrar">
      </form>
   <div class="col">&nbsp;</div>
</div>
<style>
#container-fluid .page-content {
    padding-bottom: 2.7em;
}
        footer{
margin-top: 0!important;
        }
    </style>