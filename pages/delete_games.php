<?php

include_once "class/Conectar.php"; // Using database connection file here
include_once "class/Jogos.php";
include_once "class/Imagens_jogos.php";

$id = $_GET['id'];

$jogo = new Jogo();

$jogo->setId($id);

$imagem = new Imagem();

$imagem->setId_jogo($id);

$dados_img = $imagem->consultar();

foreach($dados_img as $mostrar){
    $imagem = $mostrar['imagem'];
    unlink("pages/games_data/games_images/$id/$imagem");
}

rmdir("pages/games_data/games_images/$id");

$dados = $jogo->consultarPorID();

$id_user = $dados['id_usuario'];

$jogo->excluir();

header("location: index.php?p=pages/all_games_page&id_user=$id_user");
exit();
?>
