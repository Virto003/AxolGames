<link rel="stylesheet" href="pages/register-games.css">
<?php
include_once 'class/Conectar.php';
include_once 'class/Jogos.php';

$jogo = new Jogo();
$tipo = $nome = $link_jogo = $creditos = $descricao = $lancamento = $autor = $img_capa = $gif_preview = $email = $email = "";

$id = filter_input(INPUT_GET, 'id');

$sql = "SELECT * FROM usuario WHERE email = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $info['email']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();

if (!isset($_SESSION['user'])) {
    header("location: index.php?p=pages/erro404.php");
    exit;
}

if (filter_input(INPUT_GET, 'id') != NULL) {

    $tipo = "editar";

    $jogo->setId($id);
    $dados = $jogo->consultarPorID();

    foreach ($dados as $mostrar) {
        $nome = $mostrar['nome'];
        $descricao = $mostrar['descricao'];
        $lancamento = $mostrar['lancamento'];
        $autor = $mostrar['autor'];
        $creditos = $mostrar['creditos'];

        $DataEspecifica = new DateTime($lancamento);

        $lancamento = $DataEspecifica->format('Y-m-d');
    }
}

function relax()
{
}

if (filter_input(INPUT_POST, 'btnsalvar')) {

    $nome = filter_input(INPUT_POST, 'txt_nome');
    $link_jogo = filter_input(INPUT_POST, 'txt_link_jogo');
    $descricao = filter_input(INPUT_POST, 'txt_descricao');
    $lancamento = filter_input(INPUT_POST, 'date_lancamento');
    $autor = filter_input(INPUT_POST, 'txt_autor');
    $creditos = filter_input(INPUT_POST, 'txt_creditos');

    $DataEspecifica = new DateTime($lancamento);

    $lancamento = $DataEspecifica->format('d-m-Y');

    $jogo->setNome($nome);
    $jogo->setLink_jogo($link_jogo);
    $jogo->setDescricao($descricao);
    $jogo->setLancamento($lancamento);
    $jogo->setAutor($autor);
    $jogo->setCreditos($creditos);
    $jogo->setId_usuario($row['id']);

    if ($tipo == "editar") {
        if ($jogo->editar()) {
            "Editado";
        } else {
            "erro";
        }
    } else {

        $jogo->setId(NULL);

        if ($jogo->salvar()) {
            $sql = "SELECT * FROM jogo ORDER BY id DESC limit 1";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_array();

            $id_novo = $row['id'];

            header("location: index.php?p=pages/register_imgs&id=$id_novo");
            exit();
        } else {
            echo 'erro';
        }
    }
}
?>
<link rel="stylesheet" href="css/style.css">
<div class="row mx-auto mt-5 mb-4">
    <a href="?p=pages/all_games_page">
        <img src="img/back-arrow.png" class="btn-back" style="margin-left: 3em;">
    </a>
    <h1 class="mx-auto page-title">
        Cadastro
        <span style="margin-right: 3em;"></span>
    </h1>
</div>
<div class="row mx-auto justify-content-center">
    <div class="col-md-6">
        <form class="mx-auto justify-content-center" method="post" name="formsalvar" id="formSalvar" enctype="multipart/form-data" id="formulario_salvar">
            <!-- m-3 determinei todas as bordas, não mudei o form-->
            <div class="form-group">
                <input type="text" class="form-input" name="txt_nome" placeholder="Nome do jogo" maxlength="50" value="<?= $tipo == "editar" ? $nome : relax() ?>" required>
            </div>
            <div class="form-group">
                <textarea type="text" class="form-input" name="txt_descricao" placeholder="Descrição" value="" required><?= $tipo == "editar" ? $descricao : relax() ?></textarea>
            </div>
            <div class="form-group">
                <input type="date" class="form-input" name="date_lancamento" maxlength="50" value="<?= $tipo == "editar" ? $lancamento : relax() ?>" required style="padding-top: 0.6em;">
            </div>
            <div class="form-group">
                <input type="textarea" class="form-input" name="txt_autor" placeholder="Autor" maxlength="50" value="<?= $tipo == "editar" ? $autor : relax() ?>" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-input" name="txt_creditos" placeholder="Creditos" maxlength="50" value="<?= $tipo == "editar" ? $creditos : relax() ?>" required>
            </div>
            <div class="form-group">
                <input class="btn btn-form grow mb-4" type="submit" name="btnsalvar" value="<?= $tipo == "editar" ? "Salvar alterações" : "Próximo" ?>">
            </div>
        </form>
    </div>

</div>