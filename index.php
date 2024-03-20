<?php

include_once 'class/Session/User.php';
use App\Session\User;
include_once 'class/Conectar.php';

new User();
App\Session\User::getInfo();


if (isset($_SESSION['user'])) {
    $info = $_SESSION['user'];
} else {
    $info['email'] = null;
}

$email = $info['email'];

$sql = "SELECT * FROM usuario WHERE email = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();

?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="axolgames, games, axol etec, etec games, axolote games, axol" />
    <meta property="og:title" content="Axol Games" />
    <meta property="og:description" content="Vem jogar com a gente!" />
    <meta property="og:type" content="game"/>
    <script src="https://kit.fontawesome.com/fffd2b7e52.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="img/axol_logo-icon.png">
    <title>Axol</title>
</head>

<body>
    <div id="header_div" style="display: none;">
        <img src="img/axol_logo.png" alt="logo">
    </div>
    <main>
        <div id="container-fluid">
            <?php
            $pagina = filter_input(INPUT_GET, 'p');

            if ($pagina == '' || empty($pagina) || $pagina == 'index' || $pagina == 'index.php') {
                include_once 'pages/inicial_page.php';
            } else if ($pagina == 'admin') {
                include_once 'pages/login.php';
            } else {
                if (file_exists($pagina . '.php')) {
                    include_once $pagina . '.php';
                } else {
                    include_once 'pages/erro404.php';
                }
            }
            ?>
        </div>
    </main>

    <nav class="a-navbar">
        <ul class="a-navbar-nav">
            <li class="logo">
                <a href="?p=pages/inicial_page" class="a-nav-link" id="nav-link-logo">
                    <img class="nav-logo" src="img/axol_logo.png">
                    <span id="text-axol" class="link-text logo-text" style="font-family: 'Montserrat', sans-serif;">Axol</span>
                </a>
            </li>
            <li class="a-nav-item">
                <a href="?p=pages/inicial_page#inicial-section" class="a-nav-link">
                    <img src="img/navbar/home.png">
                    <span class="link-text">Início</span>
                </a>
            </li>
            <li class="a-nav-item">
                <a href="?p=pages/inicial_page#game-section" class="a-nav-link">
                    <img src="img/navbar/game.png">
                    <span class="link-text">Jogos</span>
                </a>
            </li>
            <li class="a-nav-item">
                <a href="?p=pages/inicial_page#about-section" class="a-nav-link">
                    <img src="img/navbar/info.png">
                    <span class="link-text">Sobre nós</span>
                </a>
            </li>
            <!-- BTN LOGIN -->
            <li class="a-nav-item" id="btn-login">
                <?php if ($email != null) { ?>
                    <div class="a-nav-login">
                        <a class="a-nav-link" id="btn-user" href="?p=pages/all_games_page">
                            <img src="img/user_icon.png" class="rounded-circle" id="img-user">
                            <span class="link-text" id="user-name"><?= $row['nome'] ?></span>
                        </a>
                    </div>
                    <div class="a-nav-login">
                        <a class="a-nav-link" id="btn-user" href="?p=pages/user_config">
                            <img src="img/admin_icon.png" class="rounded-circle" id="img-user">
                            <span class="link-text" id="user-name">Usuários</span>
                        </a>
                    </div>
                    <div class="a-nav-login" id="btn-logout-large">
                        <a id="a-nav-logout" href="class/logout.php">
                            <img src="img/navbar/logout.png">
                            <span class="link-text">Sair</span>
                        </a>
                    </div>
                    <div class="a-nav-login" id="btn-logout-small">
                        <a id="a-nav-logout" href="class/logout.php">
                            <img src="img/navbar/logout.png">
                            <span class="link-text">Sair</span>
                        </a>
                    </div>
                <?php } ?>
            </li>
        </ul>
    </nav>

    <footer class="footer">
        <a class="footer-link" href="mailto:axolgames.fun@gmail.com" target="_blank">
            <img src="img/footer/mail.png" from="link-mail">
            <p style="margin-bottom: 0;">axolgames.fun@gmail.com</p>
        </a>
        <div id="footer-logo">
            <img src="img/axol_logo.png" alt="logo">
        </div>
        <a class="footer-link" href="https://instagram.com/axol_games?igshid=YmMyMTA2M2Y=s" target="_blank">
            <img src="img/footer/insta.png" from="link-insta">
            <p style="margin-bottom: 0;">@axol_games</p>
        </a>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/slider.js"></script>
</body>

</html>