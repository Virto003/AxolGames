<?php

include_once 'class/Jogos.php';

$jogo = new jogo();
$dados_jogo = $jogo->consultar();

?>
<link rel="stylesheet" href="css/inicial-page/background.css">

<div class="background">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>
<div class="page-content">
    <div class="col-12" id="inicial-section">
        <div class="row d-inline">
            <div class="col-10 d-inline py-3 mx-auto">
                <img src="img/inicial_img.png">
            </div>
        </div>
        <div class="row mx-auto" style="display: flex; align-items: center; justify-content: center;">
            <div class="arrow-container">
                <a href="?p=pages/inicial_page#game-section">
                    <div class="arrow-down"></div>
                </a>
            </div>
        </div>
    </div>
    <style>

    </style>
    <script>
        document.getElementById("scroll-item").addEventListener("scroll", function(event) {
            var newDiv = document.createElement("div");
            newDiv.innerHTML = "my awesome new div";
            document.getElementById("scroll-item").appendChild(newDiv);
        });


        var checkForNewDiv = function() {
            var lastDiv = document.querySelector("#scroll-item > div:last-child");
            var maindiv = document.querySelector("#scroll-item");
            var lastDivOffset = lastDiv.offsetTop + lastDiv.clientHeight;
            var pageOffset = maindiv.offsetTop + maindiv.clientHeight;
            if (pageOffset > lastDivOffset - 10) {
                var newDiv = document.createElement("div");
                newDiv.innerHTML = "my awesome new div";
                document.getElementById("scroll-item").appendChild(newDiv);
                checkForNewDiv();
            }
        };

        checkForNewDiv();
    </script>
    <div class="col-12" id="game-section">
        <div class="row mx-auto">
            <div class="col-12">
                <div class="scrolling-wrapper">
                    <?php foreach ($dados_jogo as $mostrar) {
                        $id = $mostrar['id'];
                    ?>
                        <div class="scroll-item">
                            <script type='text/javascript'>
                                var erro = "img/fliperama/erro.gif"

                                function hover<?= $id ?>(element) {
                                    element.setAttribute('src', "pages/games_data/games_images/<?php echo $mostrar['id'] . '/' . $mostrar['gif_preview']; ?>");
                                }

                                function unhover<?= $id ?>(element) {
                                    element.setAttribute('src', "pages/games_data/games_images/<?php echo $mostrar['id'] . '/' . $mostrar['img_capa']; ?>");
                                }
                            </script>
                            <a href="?p=pages/games_page&id=<?= $id ?>">
                                <div class="flipper">
                                    <div class="nome-jogo">
                                        <?= $mostrar['nome'] ?>
                                    </div>
                                    <div class="div-tela-flipper">
                                        <img class="imagem-flipper" id="imagem-flipper#<?= $id ?>" src="pages/games_data/games_images/<?php echo $mostrar['id'] . '/' . $mostrar['img_capa']; ?>" onerror="this.src=erro;">
                                    </div>

                                    <?php
                                    $cor_flipper = $mostrar['cor_flipper'];
                                    if ($cor_flipper == null) {
                                        $cor_flipper = "cyan";
                                    }
                                    $src = "img/fliperama/fliperama_" . $cor_flipper . ".png";
                                    ?>

                                    <img src="<?= $src ?>" name="formula" id="formula" onmouseover="hover<?= $id ?>(document.getElementById('imagem-flipper#<?= $id ?>'));" onmouseout="unhover<?= $id ?>(document.getElementById('imagem-flipper#<?= $id ?>'));">

                                </div>
                            </a>
                        <?php } ?>

                        </div>
                </div>
            </div>

        </div>

    </div>

</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <a href="?p=pages/all_games_page">
            <button class="btn-show grow">
                Ver todos os jogos
            </button>
        </a>
    </div>
</div>
<div class="col mx-auto mt-4">
    <div class="col-9 mx-auto justify-content-center" id="about-section">
        <h1 class="section-title mb-3">Sobre nós</h1>
        <p class="section-text">
            O Projeto Axol começou a partir de um TCC com o objetivo de ter uma plataforma para subir nossos próprios jogos. Se você jogou nossos jogos, deve ter reparado que a maioria tem uma personagem rosa que parece um lagarto, essa é a Axolote, inspiração do nome do projeto! Com ele, esperamos que você consiga se distrair um pouco dos seus problemas e ter um momento de lazer!
            <br> Planejamos levar o projeto adiante. Se você quer nos ajudar, jogue nossos jogos e suba seus próprios jogos gratuitamente!
        </p>
        <br />
        <h1 class="section-title mb-3">Nossa equipe</h1>
        <div class="col mx-auto justify-content-center grid-container" id="team">
            <div class="member grid-item">
                <a href="https://www.linkedin.com/in/ane-melman/" target="_blank" alt="linkedin">
                    <div class="row d-flex justify-content-center">
                        <div class="box">
                            <img class="img-member" src="img/team/member_ane.jpg" alt="Foto Ane">
                            <img class="img-linkedin hidden-icon" src="img/team/linkedin.png" alt="logo linkedin">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="text-box">
                            <p class="member-name">Ane Melman</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="text-box">
                            <span class="hidden-info">Programadora</span>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <img class="simg-linkedin" src="img/team/linkedin_small.png" alt="logo linkedin">
                    </div>
            </div>
            <div class="member grid-item">
                <a href="https://www.linkedin.com/in/karina-miyu-kinukawa-71b5362b7/" target="_blank" alt="linkedin">
                    <div class="row d-flex justify-content-center">
                        <div class="box">
                            <img class="img-member" src="img/team/member_karina.jpg" alt="Foto Karina">
                            <img class="img-linkedin hidden-icon" src="img/team/linkedin.png" alt="logo linkedin">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="text-box">
                            <p class="member-name">Karina Kinukawa</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="text-box">
                            <span class="hidden-info">Designer</span>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <img class="simg-linkedin" src="img/team/linkedin_small.png" alt="logo linkedin">
                    </div>
            </div>
            <div class="member grid-item">
                <a href="https://www.linkedin.com/in/sophia-caires/" target="_blank" alt="linkedin">
                    <div class="row d-flex justify-content-center">
                        <div class="box">
                            <img class="img-member" src="img/team/member_sophia.jpg" alt="Foto Sophia">
                            <img class="img-linkedin hidden-icon" src="img/team/linkedin.png" alt="logo linkedin">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="text-box">
                            <p class="member-name">Sophia Caires</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="text-box">
                            <span class="hidden-info">Programadora</span>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <img class="simg-linkedin" src="img/team/linkedin_small.png" alt="logo linkedin">
                    </div>
            </div>
            <div class="member grid-item">
                <a href="https://www.linkedin.com/in/taina-c-373484230/" target="_blank" alt="linkedin">
                    <div class="row d-flex justify-content-center">
                        <div class="box">
                            <img class="img-member" src="img/team/member_taina.jpg" alt="Foto Tainá">
                            <img class="img-linkedin hidden-icon" src="img/team/linkedin.png" alt="logo linkedin">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="text-box">
                            <p class="member-name">Tainá Caldas</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="text-box">
                            <span class="hidden-info">Designer</span>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <img class="simg-linkedin" src="img/team/linkedin_small.png" alt="logo linkedin">
                    </div>
            </div>
            <div class="member grid-item">
                <a href="https://www.linkedin.com/in/victor-silva-2018b4215/" target="_blank" alt="linkedin">
                    <div class="row d-flex justify-content-center">
                        <div class="box">
                            <img class="img-member" src="img/team/member_virto.jpg" alt="Foto Victor">
                            <img class="img-linkedin hidden-icon" src="img/team/linkedin.png" alt="logo linkedin">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="text-box">
                            <p class="member-name">Victor Silva</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="text-box">
                            <span class="hidden-info">Programador e Designer</span>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <img class="simg-linkedin" src="img/team/linkedin_small.png" alt="logo linkedin">
                    </div>
            </div>
        </div>
    </div>
</div>
<style>
    .close:not(:disabled):not(.disabled):hover {
        color: #f8f9fa;
        text-decoration: none;
        opacity: .75;
    }

    .close {
        float: right;
        font-size: 1.5rem;
        font-weight: 200;
        line-height: 1;
        color: #ffffff;
        text-shadow: 0 1px 0 #fff;
        opacity: .5;
    }
</style>
<!-- ADD LINK APOIA-SE -->
<div class="apoia-se-btn">
    <a href="#" class="d-flex justify-content-center m-1" data-toggle="modal" data-target="#exampleModal">
        <img src="img/apoia-se-axol.png" alt="apoia-se">
    </a>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #090f1a;
    border-radius: 20px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apoie com um pix</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="img/pix.jpg" alt="Apoiar por pix" style="max-width:100%;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-form" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>