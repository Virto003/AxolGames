<?php
$err = filter_input(INPUT_GET, 'err');
if ($err = "101") {
   $err_msg = "Um usuário com este email já existe";
}
?>
<link rel="stylesheet" href="css/style.css">

<div class="col-12 page-content mx-auto justify-content-center pattern-bg">
   <div class="space-ls py-3">&nbsp;</div>
   <div class="col-9 mx-auto py-5 justify-content-center" id="register">
      <p class="axol-text" style="font-family: 'Montserrat', sans-serif;">Axol</p>
      <form class="mx-auto justify-content-center">
         <div class="form-group">
            <input type="name" class="form-input" id="InputName" placeholder="Nome" pattern="[A-Za-z]{1,25}">
         </div>
         <div class="form-group">
            <input type="email" class="form-input" id="InputEmail" aria-describedby="emailHelp" placeholder="Email" name="email" required>
         </div>
         <div class="form-group">
            <input type="password" class="form-input" id="InputPassword" placeholder="Senha" name="senha" required>

         </div>
         <div class="form-group">
            <input type="password" class="form-input" id="InputPassword" placeholder="Confirme sua senha" name="" required>
         </div>
         <div class="form-group form-check">
            <input type="Hidden" value="Não" class="form-check-input checkmark" id="RegisterCheck" name="post_jogos">
            <input type="checkbox" value="sim" class="form-check-input checkmark" id="RegisterCheck" name="post_jogos">
            <label class="form-check-label" for="RegisterCheck">Deseja realizar o cadastro de jogos?</label>
         </div>
         <!-- <div class="toggle-pill-color" style="display: flex;">
               <input type="checkbox" id="RegisterCheck" name="check">
               <label for="RegisterCheck"></label>
               <p class="form-check-label">Deseja realizar o cadastro de jogos?</p>
            </div> -->
         <div class="form-group mt-1" style="text-align: left;">
            <small style="color: red"><?= $err_msg ?></small>
         </div>
         <input type="submit" class="btn btn-form grow mb-4" value="Cadastrar">
      </form>
      <div class="col-11 mx-auto">
         <div class="mx-auto">
            <p class="form-text">Ou entre com o Google</p>
         </div>

         <div class="hidden" >
            <div id="g_id_onload"data-client_id="660821359635-tpba8pi9s025h57778m43vte5uq0a7pf.apps.googleusercontent.com" data-login_uri="http://localhost/SiteTCC/login.php" data-auto_prompt="false">
            </div>
            <div class="g_id_signin mx-0" style="display: none;"  data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with" data-shape="pill" data-logo_alignment="left"></div>
         </div>
      </div>
      <hr class="my-4" />
      <p class="mb-0 form-text" style="line-height: 1.5em;">Já tem uma conta? <a class="form-link" href="?p=pages/login">Faça login</a></p>

   </div>
   <div class="col">&nbsp;</div>
</div>
<script src="http://accounts.google.com/gsi/client" async defer></script>