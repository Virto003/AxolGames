<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/games-page.css">
<div class="page-content">  
  <?php
  include_once 'class/Jogos.php';
  $jogo = new Jogo();
  $tipo = "";
  $nome = "";
  $link_jogo = "";
  $descricao = "";
  $lancamento = "";
  $autor = "";
  $creditos = "";
  $img_capa = "";
  $gif_preview = "";

  $id = filter_input(INPUT_GET, 'id');
  $jogo->setId($id);
  $dados = $jogo->consultarPorID();
  
  if(!isset($id) || $id == null || $dados == null){
    header("location: index.php?p=pages/erro404.php");
    exit;
  }

  foreach ($dados as $mostrar) {
    $nome = $mostrar['nome'];
    $descricao = $mostrar['descricao'];
    $lancamento = $mostrar['lancamento'];
    $autor = $mostrar['autor'];
    $creditos = $mostrar['creditos'];
    $img_capa = $mostrar['img_capa'];
    $download = $mostrar['arquivo_download'];
    break;
  }

  $lancamento_data = str_replace("-",  "/", $lancamento);

  $id_jogo = filter_input(INPUT_GET, 'id');
  include_once 'class/Imagens_jogos.php';
  $imagem = new Imagem();
  $imagem_jogo = "";
  $imagem->setId_jogo($id_jogo);
  $dados_img = $imagem->consultar();
  //$descricao_img = $mostrar['descricao_img'];
  //$imagem_jogo = 'data:image/jpg;base64,'.base64_encode($mostrar['imagem_jogo']);

  ?>

  <div class="row justify-content-center mt-4">
    <div class="col-12 col-md-10">
      <div class="row ">
        <div class="col-12 titulo">
          <?= $nome ?></div>
      </div>
      <div class="row justify-content-center">
        <div class="col-12 col-md-8">
          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="div-img-carousel" style="--aspect-ratio: 16/9">
                  <img src="pages/games_data/games_images/<?php echo $id . '/' . $img_capa ?>" class="imagem-carousel">
                </div>
              </div>
              <?php
              foreach ($dados_img as $mostrar) {
              ?>
                <div class="carousel-item">
                  <div class="div-img-carousel">
                    <img src="pages/games_data/games_images/<?php echo $mostrar['id_jogo'] . '/' . $mostrar['imagem']; ?>" class="imagem-carousel">
                  </div>
                </div>
              <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <div class="col-10 col-md-4">
          <img src="pages/games_data/games_images/<?php echo $id . '/' . $img_capa ?>" class="w-100">

          <div id="descricao" class="texto"><?= $descricao ?></div>
          <div id="lancamento" class="texto-pequeno">Data de lançamento: <?= $lancamento_data ?></div>
          <div id="autor" class="texto-pequeno">Desenvolvedor: <?= $autor ?></div>
        </div>
      </div>
      <div class="row d-flex justify-content-between">
        <?php if($download == "") { echo '<div class="col-8"><div class="row justify-content-center">'; }?>
        <div class="col-12 col-md-4 align-self-center">
            <a href="pages/games_data/games_builds/<?= $id ?>/Build/index.html" target="_blank" rel="noopener noreferrer" class="btn btn-form grow">Jogar</a>
        </div>
        <?php if($download == "") { echo '</div></div>'; }?>
        <?php if($download != "") { ?>
        <div class="col-12 col-md-4 align-self-center">
            <a href="pages/games_data/games_builds/<?= $id ?>/<?= $download ?>" target="_blank" rel="noopener noreferrer" class="btn btn-form grow" download>Download</a>
        </div>
        <?php
        }
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
          $url = "https://";
        else
          $url = "http://";
        // Append the host(domain name, ip) to the URL.   
        $url .= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL   
        $url .= $_SERVER['REQUEST_URI'];
        ?>

        <div class="col-12 col-md-4 share mt-3">
          <h6>Compartilhar</h6>
          <script>
            function myFunction() {
              // Get the text field
              var copyText = document.getElementById("myInput");

              // Select the text field
              copyText.select();
              copyText.setSelectionRange(0, 99999); // For mobile devices

              // Copy the text inside the text field
              navigator.clipboard.writeText(copyText.value);
            }
          </script>

          <input type="text" id="myInput" value="<?= $url ?>" readonly="readonly">
          <a onclick="myFunction()" class="grow">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16">
              <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z" />
            </svg>
          </a>
          <div class="row justify-content-around" style="margin: 10px;">
            <a href="whatsapp://send?text=<?= $url ?>" data-action="share/whatsapp/share" target="_blank" class="btn btn-form grow" style="width: auto!important; padding:1em!important; background: #009cde;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
              </svg>
            </a>
            <a href="https://twitter.com/share?url=<?= $url ?>&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons" class="btn btn-form grow" style="width: auto!important; padding:1em!important; background: #009cde;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" target="_blank" class="bi bi-twitter" viewBox="0 0 16 16">
                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
              </svg>
            </a>
          </div>

        </div>
      </div>
        <small class="align-self-center">Obs.: A opção jogar pode não ser compatível com alguns dispositivos.</small>

    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>