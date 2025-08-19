<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0" />
    <title>Bella Boutique</title>
    <meta name="Author" content="Felipe Jobim" />
    <link rel="icon" type="image/png" href="Logos/belalogo.jpg" />

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="esti.css" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
      /* ======== Para desktop: grid normal ======= */
      @media(min-width: 769px) {
        .produtos-grid {
          display: flex;
          flex-wrap: wrap;
          gap: 15px;
          justify-content: center;
        }
        .produto-item {
          flex: 0 0 calc(25% - 15px); /* 4 por linha */
          box-sizing: border-box;
        }
        .carousel-wrapper, .carousel-container, .carousel-btn {
          display: none !important; /* esconde o carrossel no desktop */
        }
      }
    /* ======== Para celular: carrossel horizontal ======= */
    @media(max-width: 768px) {
        .produtos-grid {
            display: none;
        }

        .carousel-wrapper {
            position: relative;
            overflow: hidden;
            margin: 20px 0;
        }

        .carousel-container {
            display: flex;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
            gap: 15px;
            padding: 10px;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE/Edge */
        }

        .carousel-container::-webkit-scrollbar {
            display: none; /* Chrome, Safari e Opera */
        }

        .carousel-item {
            flex: 0 0 45%;
            box-sizing: border-box;
        }

        .carousel-btn {
            display: none;
        }
    }
</style>
</head>
<body>
<?php
session_start();
include 'conexao.php';
include 'nav.php';
include 'cabecalho.html';

// Consulta utilizando prepared statement
$consulta = $cn->prepare('SELECT * FROM vw_produto');
$consulta->execute();

?>

<div class="container destaque-promocao text-center" style="margin-bottom: 30px;">
    <img src="Logos/promo.png" alt="Promoção" class="img-responsive destaque-img" />
</div>

<!-- Grid Desktop -->
<div class="container text-center produtos-grid">
    <?php while($exibir = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
      <div class="produto-item">
        <img src="Produtos/<?php echo (empty($exibir['ds_img']) ? 'default.jpg' : htmlspecialchars($exibir['ds_img'])); ?>" class="img-responsive produto-img" alt="Produto" />
        <h4><b><?php echo mb_strimwidth(htmlspecialchars($exibir['nm_nome']), 0, 17, '...'); ?></b></h4>
        <h5>R$ <?php echo number_format($exibir['vl_produto'], 2, ',', '.'); ?></h5>

        <div style="margin-top:7px;">
          <?php if($exibir['qtd_estoque'] > 0) { ?>
            <a href="carrinho.php?id=<?php echo htmlspecialchars($exibir['id_produto']); ?>">
              <button class="btn btn-block btn-default" style="background:#fdeb00; color:black;">
                <span class="glyphicon glyphicon-usd"></span> Comprar
              </button>
            </a>
          <?php } else { ?>
            <button class="btn btn-block btn-danger" disabled>
              <span class="glyphicon glyphicon-exclamation-sign"></span> Fora de Estoque
            </button>
          <?php } ?>
          <br />
          <a href="detalhes.php?id=<?php echo htmlspecialchars($exibir['id_produto']); ?>">
            <button class="btn btn-block btn-primary">
              <span class="glyphicon glyphicon-info-sign"></span> Detalhes
            </button>
          </a>
        </div>

        <?php if (isset($_SESSION['Status']) && $_SESSION['Status'] == 1) { ?>
          <h5><b>Código: <?php echo htmlspecialchars($exibir['nm_artigo']); ?></b></h5>
        <?php } ?>
      </div>
    <?php } ?>
</div>

<!-- Carousel Celular -->
<div class="container text-center carousel-wrapper">
  <div class="carousel-container">
    <?php
    // Resetando o cursor do fetch para reexibir produtos no carrossel
    $consulta->execute();
    while($exibir = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
      <div class="carousel-item">
        <img src="Produtos/<?php echo (empty($exibir['ds_img']) ? 'default.jpg' : htmlspecialchars($exibir['ds_img'])); ?>" class="img-responsive produto-img" alt="Produto" />
        <h4><b><?php echo mb_strimwidth(htmlspecialchars($exibir['nm_nome']), 0, 17, '...'); ?></b></h4>
        <h5>R$ <?php echo number_format($exibir['vl_produto'], 2, ',', '.'); ?></h5>

        <div style="margin-top:7px;">
          <?php if($exibir['qtd_estoque'] > 0) { ?>
            <a href="carrinho.php?id=<?php echo htmlspecialchars($exibir['id_produto']); ?>">
              <button class="btn btn-block btn-default" style="background:#fdeb00; color:black;">
                <span class="glyphicon glyphicon-usd"></span> Comprar
              </button>
            </a>
          <?php } else { ?>
            <button class="btn btn-block btn-danger" disabled>
              <span class="glyphicon glyphicon-exclamation-sign"></span> Fora de Estoque
            </button>
          <?php } ?>
          <br />
          <a href="detalhes.php?id=<?php echo htmlspecialchars($exibir['id_produto']); ?>">
            <button class="btn btn-block btn-primary">
              <span class="glyphicon glyphicon-info-sign"></span> Detalhes
            </button>
          </a>
        </div>

        <?php if (isset($_SESSION['Status']) && $_SESSION['Status'] == 1) { ?>
          <h5><b>Código: <?php echo htmlspecialchars($exibir['nm_artigo']); ?></b></h5>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>

<br /><br />

<?php include 'rodape.html'; ?>
</body>
</html>
