<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<link rel="stylesheet" href="css/all-games-page.css">
<link rel="stylesheet" href="css/style.css">

<div class="page-content">
    <?php
    error_reporting(0);
    ?>
    <?php

    if (isset($_SESSION['user'])) {
        $info = $_SESSION['user'] ?? [];
    }

    include_once 'class/Jogos.php';
    include_once 'class/Usuario.php';
    include_once 'class/Conectar.php';

    $jogo = new Jogo();
    $usuario = new Usuario();

    if (filter_input(INPUT_GET, 'id_user') != NULL) {
        $id_usuario = filter_input(INPUT_GET, 'id_user');
        $jogo->setId_usuario($id_usuario);
        $dados = $jogo->consultarPorIdUsuario();

        $sql = "SELECT * FROM usuario WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array();
    } else {
        $dados = $jogo->consultar();
    }


    ?>
    <?php
    if (isset($_SESSION['user'])) {
    ?>

    <?php } ?>

    <div class="row">
        <div class="row justify-content-center mt-4">
        <?php
                    if (isset($_SESSION['user'])) {
                    ?>
            <a href="?p=pages/register_edit_page" class="btn btn-form grow" style="width: auto!important; padding:1em!important;">Cadastrar</a>
        <?php } ?>
        </div>
        <div class="lista-jogos mt-4">
            <?php foreach ($dados as $mostrar) { ?>
                <div class="pai-jogos-todos-jogos">
                    <div id="id<?= $mostrar['id'] ?>" class="jogo-todos-jogos" style="--aspect-ratio: 16/9">
                        <?php
                        if (isset($_SESSION['user'])) {
                        ?>
                            <form method="post" class="configuracoes">
                                
                                <a class="" href="?p=pages/register_edit_page&id=<?= $mostrar['id'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-fill">
                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                    </svg>
                                </a>
                                <a class="" href="?p=pages/register_imgs&id=<?= $mostrar['id'] ?>&rel=edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-images">
                                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                                    </svg>
                                </a>
                                <a class="" href="?p=pages/register_game_build&id=<?= $mostrar['id'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-zip-fill" viewBox="0 0 16 16">
                                        <path d="M5.5 9.438V8.5h1v.938a1 1 0 0 0 .03.243l.4 1.598-.93.62-.93-.62.4-1.598a1 1 0 0 0 .03-.243z" />
                                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-4-.5V2h-1V1H6v1h1v1H6v1h1v1H6v1h1v1H5.5V6h-1V5h1V4h-1V3h1zm0 4.5h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.109 0l-.93-.62a1 1 0 0 1-.415-1.074l.4-1.599V8.5a1 1 0 0 1 1-1z" />
                                    </svg>
                                </a>
                                <a class="" href="?p=pages/delete_games&id=<?= $mostrar['id'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash-fill">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>
                            </form>
                        <?php } ?>
                        <br>

                    </div>
                    <a href="?p=pages/games_page&id=<?= $mostrar['id'] ?>" class="link-pag-jogo">
                        <i><?= $mostrar['nome'] ?></i>
                    </a>
                </div>
                <style>
                    @keyframes myAnim {
                        0% {
                            transform: scaleY(0);
                            transform-origin: 100% 100%;
                        }

                        100% {
                            transform: scaleY(1);
                            transform-origin: 100% 100%;
                        }
                    }

                    .configuracoes {
                        display: none;
                    }

                    #id<?= $mostrar['id'] ?> {
                        background-color: black;
                        background-position: center;
                        background-image: url("pages/games_data/games_images/<?php echo $mostrar['id'] . '/' . $mostrar['img_capa']; ?>");
                    }

                    .pai-jogos-todos-jogos:hover .configuracoes {
                        justify-content: space-between;
                        display: flex;
                        height: 50;
                        width: 250;
                        flex-direction: row;
                        /* float: right; */
                        border-radius: 0px 0px 10px 10px;
                        background-color: #000000db;
                        animation: myAnim 0.2s linear 0s 1 normal forwards;
                        align-items: center;
                        align-content: center;
                        flex-wrap: nowrap;
                    }

                    .pai-jogos-todos-jogos:hover #id<?= $mostrar['id'] ?> {
                        background-position: center;
                        background-image: url("pages/games_data/games_images/<?php echo $mostrar['id'] . '/' . $mostrar['gif_preview']; ?>");
                    }
                </style>
            <?php } ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>