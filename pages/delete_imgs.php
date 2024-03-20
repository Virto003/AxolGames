<?php

use Google\Service\CloudSearch\Id;

include_once "class/Conectar.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string
$rel = $_GET['rel'];

$sql = "SELECT * FROM imagens WHERE id_img = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();

$id_jogo = $row['id_jogo'];
$imagem = $row['imagem'];


$query = "DELETE FROM imagens WHERE id_img = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();

unlink("pages/games_data/games_images/$id_jogo/$imagem");
unlink("pages/games_data/games_images/$id_jogo/Gif-preview.gif");
unlink("pages/games_data/games_images/$id_jogo/Img-capa.png");
unlink("pages/games_data/games_images/$id_jogo/Img-capa.jpg");

if ($rel == "edit") {
		header("location: index.php?p=pages/register_imgs&id=$id_jogo&rel=edit");
		exit();
	} else {
		header("location: index.php?p=pages/register_imgs&id=$id_jogo");
		exit();
	}

?>
