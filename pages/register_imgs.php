
<?php
error_reporting(0);
include_once 'class/conectar.php';

$info = $_SESSION['user'] ?? [];
$id_jogo = filter_input(INPUT_GET, 'id');
$rel = filter_input(INPUT_GET, 'rel');

if (!isset($_SESSION['user'])) {
	header("location: index.php?p=pages/erro404.php");
	exit;
}

$id = filter_input(INPUT_GET, 'id');

include_once 'class/Jogos.php';
$jogo = new Jogo();
$jogo->setId($id);
include_once 'class/Imagens_jogos.php';
$imagem = new Imagem();
$imagem->setId_jogo($id_jogo);
$dados_img = $imagem->consultar();
$dados_img_jogo = $jogo->consultarPorID();
foreach ($dados_img_jogo as $mostrar) {
	$jogo_img_capa = $mostrar['img_capa'];
	$jogo_gif_preview = $mostrar['gif_preview'];
	$cor_flipper = $mostrar['cor_flipper'];
}

$arquivos = 0;

if (filter_input(INPUT_POST, 'btn_salvar_img_capa')) {

	$img_capa =  $_FILES['img_capa'];
	$img_capa_nome = $img_capa['name'];
	$ext = ltrim(substr($img_capa_nome, strrpos($img_capa_nome, '.')), '.');
	$img_capa_nome = "Img-capa." . $ext;

	$query = "UPDATE jogo
		SET img_capa = ?
		WHERE id = ?";
	$stmt = $con->prepare($query);
	$stmt->bind_param("si", $img_capa_nome, $id);
	$stmt->execute();

	$dir = "pages/games_data/games_images/$id/";
	if (!is_dir($dir)) {
		mkdir($dir, 0777, true);
		$mover = move_uploaded_file($_FILES['img_capa']['tmp_name'], $dir .  $img_capa_nome);
	} else {
		$mover = move_uploaded_file($_FILES['img_capa']['tmp_name'], $dir .  $img_capa_nome);
	}


	if ($rel == "edit") {
		header("location: index.php?p=pages/register_imgs&id=$id&rel=edit");
		exit();
	} else {
		header("location: index.php?p=pages/register_imgs&id=$id");
		exit();
	}
}

if (filter_input(INPUT_POST, 'btn_salvar_gif_preview')) {

	$gif_preview =  $_FILES['gif_preview'];
	$gif_preview_nome = $gif_preview['name'];
	$ext = ltrim(substr($gif_preview_nome, strrpos($gif_preview_nome, '.')), '.');
	$gif_preview_nome = "Gif-preview." . $ext;

	$query = "UPDATE jogo
		SET gif_preview = ?
		WHERE id = ?";
	$stmt = $con->prepare($query);
	$stmt->bind_param("si", $gif_preview_nome, $id);
	$stmt->execute();

	$dir = "pages/games_data/games_images/$id/";
	if (!is_dir($dir)) {
		mkdir($dir, 0777, true);
		$mover = move_uploaded_file($_FILES['gif_preview']['tmp_name'], $dir .  $gif_preview_nome);
	} else {
		$mover = move_uploaded_file($_FILES['gif_preview']['tmp_name'], $dir .  $gif_preview_nome);
	}

	if ($rel == "edit") {
		header("location: index.php?p=pages/register_imgs&id=$id&rel=edit");
		exit();
	} else {
		header("location: index.php?p=pages/register_imgs&id=$id");
		exit();
	}
}

if (filter_input(INPUT_POST, 'btn_salvar')) {

	$arquivos =  $_FILES['arquivos'];
	$nomes = $arquivos['name'];

	for ($i = 0; $i < count($nomes); $i++) {

		$randon = rand();
		$nomes[$i] = $randon . $nomes[$i];

		$query = "INSERT INTO imagens values(default, ?, ?)";
		$stmt = $con->prepare($query);
		$stmt->bind_param('si', $nomes[$i], $id);
		$stmt->execute();

		$dir = "pages/games_data/games_images/$id/";
		if (!is_dir($dir)) {
			mkdir($dir, 0777, true);
			$mover = move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], $dir . $nomes[$i]);
		} else {
			$mover = move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], $dir . $nomes[$i]);
		}
	}

	if ($rel == "edit") {
		header("location: index.php?p=pages/register_imgs&id=$id&rel=edit");
		exit();
	} else {
		header("location: index.php?p=pages/register_imgs&id=$id");
		exit();
	}
}
if (filter_input(INPUT_POST, 'btn_salvar_cor_flipper')) {

	$cor_flipper = filter_input(INPUT_POST, 'option');

	$query = "UPDATE jogo
		SET cor_flipper = ?
		WHERE id = ?";
	$stmt = $con->prepare($query);
	$stmt->bind_param("si", $cor_flipper, $id);
	$stmt->execute();

	if ($rel == "edit") {
		header("location: index.php?p=pages/all_games_page");
		exit();
	} else {
		header("location: index.php?p=pages/register_game_build&id=$id");
		exit();
	}
}
?>
<link rel="stylesheet" href="css/register-imgs.css">
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<link rel="stylesheet" href="css/style.css">
<div class="row mx-auto mt-5 mb-4">
    <a href="?p=pages/all_games_page">
        <img src="img/back-arrow.png" class="btn-back" style="margin-left: 3em;">
    </a>
    <h1 class="mx-auto page-title">
        Editar
        <span style="margin-right: 3em;"></span>
    </h1>
</div>
<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="div-inserir-imagens">
			<table class="">
				<form method='post' enctype='multipart/form-data'>
					<th scope="col">
						<div class="form-group">
							<script>
								function previewCapa() {
									img_capa_img.src = URL.createObjectURL(event.target.files[0]);
								}

								function previewGif() {
									gif_preview_gif.src = URL.createObjectURL(event.target.files[0]);
								}
							</script>
							<label for="img_capa_add" class="btn-add btn btn-form grow">
								<?php if ($jogo_img_capa == null) { ?>
									<svg class="icon-add-edit" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
										<path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
									</svg>
									Adicionar imagem de capa
								<?php } else { ?>
									<svg class="icon-add-edit" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
										<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
									</svg>
									Editar imagem de capa
								<?php } ?>
							</label>
							<input type="file" name="img_capa" accept=".jpg,.png,.jpeg" id="img_capa_add" onchange="previewCapa()" class="hidden" required>
						</div>
					</th>
					<th scope="col">
						<div class="form-group">
							<input type='submit' name='btn_salvar_img_capa' value='Salvar' style="background: #009cde; width: auto!important;" class="btn btn-form grow">
						</div>
					</th>
				</form>

				<tbody>
					<td class="imagem-table">
						<?php foreach ($dados_img_jogo as $mostrar) {
							if ($mostrar['img_capa'] == null) {
						?>
								escolha uma imagem de capa para o seu jogo
							<?php
							} ?>

							<img <?php
									if ($mostrar['img_capa'] != null) {
									?> src="pages/games_data/games_images/<?php echo $mostrar['id'] . '/' . $mostrar['img_capa']; ?>" <?php
																																	} ?> id="img_capa_img">
						<?php } ?>
					</td>
				</tbody>
				<form method='post' enctype='multipart/form-data'>
					<div class="">
						<th scope="col">
							<div class="form-group">
								<label for="adicionar-gif-preview" class="btn-add btn btn-form grow">
									<?php if ($jogo_gif_preview == null) { ?>
										<svg class="icon-add-edit" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
											<path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
										</svg>
										Adicione um gif para preview
									<?php } else { ?>
										<svg class="icon-add-edit" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
											<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
										</svg>
										Editar gif
									<?php } ?>
								</label>
								<input type="file" name="gif_preview" id="adicionar-gif-preview" accept=".gif" class="hidden" onchange="previewGif()" required>
							</div>
						</th>
						<th scope="col">
							<div class="form-group">
								<input type='submit' name='btn_salvar_gif_preview' value='Salvar' style="background: #009cde; width: auto!important;" class="btn btn-form grow">
							</div>
						</th>
				</form>
				<tbody>
					<td class="imagem-table">
						<?php foreach ($dados_img_jogo as $mostrar) {
							if ($mostrar['gif_preview'] == null) {
						?>
								escolha um gif de demonstração do seu jogo
							<?php
							} ?>

							<img <?php
									if ($mostrar['gif_preview'] != null) {
									?> src="pages/games_data/games_images/<?php echo $mostrar['id'] . '/' . $mostrar['gif_preview']; ?>" <?php
																																		} ?> id="gif_preview_gif" alt="">
						<?php } ?>
					</td>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-6 col-md-4">
		<script type='text/javascript'>
			$(document).ready(function() {
				$("input:radio[name=option]").click(function() {
					var value = $(this).val();
					var image_name;
					if (value == 'cyan') {
						image_name = "img/fliperama/fliperama_cyan.png";
					}
					if (value == 'key-black') {
						image_name = "img/fliperama/fliperama_key-black.png";
					}
					if (value == 'magenta') {
						image_name = "img/fliperama/fliperama_magenta.png";
					}
					if (value == 'yellow') {
						image_name = "img/fliperama/fliperama_yellow.png";
					}

					$('#formula').attr('src', image_name);
				});
			});
			<?php foreach ($dados_img_jogo as $mostrar) { ?>
				var img_capa = "pages/games_data/games_images/<?php echo $mostrar['id'] . '/' . $mostrar['img_capa']; ?>";
				var gif_preview = "pages/games_data/games_images/<?php echo $mostrar['id'] . '/' . $mostrar['gif_preview']; ?>";
			<?php } ?>
			var erro = "img/fliperama/erro.gif"

			function hover(element) {
				element.setAttribute('src', gif_preview);
			}

			function unhover(element) {
				element.setAttribute('src', img_capa);
			}
		</script>
		<div class="flipper">
			<div class="div-tela-flipper">
				<img id="imagem-flipper" src="pages/games_data/games_images/<?php echo $mostrar['id'] . '/' . $mostrar['img_capa']; ?>" onerror="this.src=erro;">
			</div>

			<?php
			if ($cor_flipper == null) {
				$cor_flipper = "cyan";
			}
			$src = "img/fliperama/fliperama_" . $cor_flipper . ".png";
			?>

			<img src="<?= $src ?>" name="formula" id="formula" onmouseover="hover(document.getElementById('imagem-flipper'));" onmouseout="unhover(document.getElementById('imagem-flipper'));">

		</div>
		<form class="cor" method="post">
			<input type="radio" name="option" id="cyan" class="hidden" value="cyan">
			<label for="cyan" class="escolher-cor cyan"></label>

			<input type="radio" name="option" id="magenta" class="hidden" value="magenta">
			<label for="magenta" class="escolher-cor magenta"></label>

			<input type="radio" name="option" id="yellow" class="hidden" value="yellow">
			<label for="yellow" class="escolher-cor yellow"></label>

			<input type="radio" name="option" id="black" class="hidden" value="key-black">
			<label for="black" class="escolher-cor black"></label>

			<div class="form-group">
				<input type='submit' name='btn_salvar_cor_flipper' id="btn-salvar-cor-flipper" value='Salvar' style="background: #009cde; width: auto!important;" class="hidden">
			</div>
		</form>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="div-inserir-imagens">
			<table class="">
				<form method='post' enctype='multipart/form-data'>
					<th scope="col">
						<div class="form-group">
							<label for="adicionar-imgs" class="btn-add btn btn-form grow">
								<svg class="icon-add-edit" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
									<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
									<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
								</svg>
								Adicionar imagens do jogo
							</label>
							<input type="file" id="adicionar-imgs" accept="image/*" class="hidden" name="arquivos[]" multiple required>
						</div>
					</th>
					<th scope="col">
						<div class="form-group">
							<input type='submit' name='btn_salvar' value='Upload' style="background: #009cde; width: auto!important;" class="btn btn-form grow">
						</div>
					</th>
				</form>
				<?php foreach ($dados_img as $mostrar) { ?>
					<tr>
						<td class="imagem-table">
							<img src="pages/games_data/games_images/<?php echo $mostrar['id_jogo'] . '/' . $mostrar['imagem']; ?>" alt="">
						</td>
						<td align="center">
							<a href="?p=pages/delete_imgs&id=<?= $mostrar['id_img'] ?><?= $rel == "edit" ? "&rel=edit" : "" ?>" class="btn btn-form grow" style="width: auto!important; padding:1em!important;">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
									<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
								</svg>
							</a>
						</td>
					</tr>
				<?php } ?>

			</table>

		</div>
	</div>
</div>
<div class="row justify-content-center">
	<label for="btn-salvar-cor-flipper" class="btn btn-form grow" style="width: auto!important; padding:1em!important;"><?= $rel == "edit" ? "Salvar alterações" : "Próximo" ?></label>
</div>