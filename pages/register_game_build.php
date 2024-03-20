<?php
$info = $_SESSION['user'] ?? [];
$id_jogo = filter_input(INPUT_GET, 'id');
$rel = filter_input(INPUT_GET, 'rel');

$sql = "SELECT * FROM jogo WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('i', $id_jogo);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();
$nome_jogo = $row['nome'];
$id_user_jogo = $row['id_usuario'];
if (!isset($_SESSION['user'])) {
    header("location: index.php?p=pages/erro404.php");
    exit;
}
if (filter_input(INPUT_POST, 'btn_salvar')) {
    $build = $_FILES['build'];
    $nome_build = "build.zip";

    $apk = $_FILES['apk'];
    $nome_apk = $apk['name'];

    $dir = "pages/games_data/games_builds/$id_jogo/";

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
        $mover = move_uploaded_file($build['tmp_name'], $dir .  $nome_build);
        $mover = move_uploaded_file($apk['tmp_name'], $dir .  $nome_apk);
    } else {
        $mover = move_uploaded_file($build['tmp_name'], $dir .  $nome_build);
        $mover = move_uploaded_file($apk['tmp_name'], $dir .  $nome_apk);
    }

    $arquivo = $dir . $nome_build;

    $query = "UPDATE jogo
		SET arquivo_download = ?
		WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("si", $nome_apk, $id_jogo);
    $stmt->execute();

    $zip = new ZipArchive;
    $zip->open($arquivo);
    $zip->extractTo($dir);
    $zip->close();

    header("location: index.php?p=pages/all_games_page&id_user=$id_user_jogo");
}

?>
<link rel="stylesheet" href="css/style.css">
<a href="?p=pages/all_games_page">
    <img src="img/back-arrow.png" class="btn-back">
</a>
<h1 class="mt-3 mx-auto page-title">
    Cadastrar jogo
</h1>
<div class="row mx-auto justify-content-center">
    <div class="col-md-6">
        Adicione os arquivos do seu jogo:
        <form class="mx-auto justify-content-center" method="post" name="formsalvar" id="formSalvar" enctype="multipart/form-data" id="formulario_salvar">
            <!-- m-3 determinei todas as bordas, não mudei o form-->
            <div class="form-group">
                <label for="adicionar-build" class="btn-add btn btn-form grow">

                    Build do jogo

                </label>
                <input type="file" name="build" id="adicionar-build" accept=".zip" class="hidden" style="display: none" required>
            </div>
            <small>A build do jogo deve ser em WebGL</small>
            <div class="form-group">
                <label for="adicionar-download" class="btn-add btn btn-form grow">
                    Download do jogo
                </label>
                <input type="file" name="apk" id="adicionar-download" accept=".apk" class="hidden" style="display: none" required>
            </div>
            <small>O arquivo para download do jogo deve ser .apk</small>
            <div class="form-group">
                <input type='submit' name='btn_salvar' value='Salvar' style="background: #009cde; width: auto!important;" class="btn btn-form grow">
            </div>
        </form>
    </div>

</div>