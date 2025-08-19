<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bella Boutique - Categorias</title>
    <meta name="Author" content="Felipe Jobim" />
    <link rel="icon" type="image/png" href="Logos/belalogo.jpg" />
    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="esti.css" />

    <style>
      @media(min-width: 769px) {
        .produtos-grid {
          display: flex;
          flex-wrap: wrap;
          gap: 15px;
          justify-content: center;
        }
        .produto-item {
          flex: 0 0 calc(25% - 15px);
          box-sizing: border-box;
        }
        .carousel-wrapper, .carousel-container, .carousel-btn {
          display: none !important;
        }
      }

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

// Sanitiza categoria
$cat = isset($_GET['cat']) ? trim($_GET['cat']) : '';
$cat = preg_replace("/[^a-zA-Z0-9À-ú\s\-]/u", '', $cat);

// Consulta segura
$stmt = $cn->prepare("SELECT * FROM vw_produto WHERE nm_categoria = :cat");
$stmt->bindParam(':cat', $cat);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid text-center">
    <h1 style="font-size:3.5vw; color: #000; text-shadow: 1px 1px 0 #fdeb00; letter-spacing: 5px;">
        <?php echo mb_strtoupper(htmlspecialchars($cat, ENT_QUOTES, 'UTF-8')); ?>
    </h1>

    <!-- Grid desktop -->
    <div class="produtos-grid">
        <?php foreach($produtos as $Exibir) { ?>
            <div class="produto-item">
                <img src="Produtos/<?php echo htmlspecialchars($Exibir['ds_img'] ?: 'default.jpg', ENT_QUOTES, 'UTF-8'); ?>" class="img-responsive produto-img" alt="<?php echo htmlspecialchars($Exibir['nm_nome'], ENT_QUOTES, 'UTF-8'); ?>" />
                <div><h3><b><?php echo mb_strimwidth(htmlspecialchars($Exibir['nm_nome'], ENT_QUOTES, 'UTF-8'), 0, 30, '...'); ?></b></h3></div>
                <div><h4>R$ <?php echo number_format($Exibir['vl_produto'], 2, ',', '.'); ?></h4></div>
                <div class="text-center" style="margin-top:7px;">
                    <?php if ($Exibir['qtd_estoque'] > 0) { ?>
                        <a href="carrinho.php?id=<?php echo htmlspecialchars($Exibir['id_produto'], ENT_QUOTES, 'UTF-8'); ?>" style="text-decoration:none;">
                            <button class="btn btn-lg btn-block btn-default" style="background:#fdeb00; color:black;">
                                <span class="glyphicon glyphicon-usd"></span> Comprar
                            </button>
                        </a>
                    <?php } else { ?>
                        <button class="btn btn-lg btn-block btn-danger" disabled>
                            <span class="glyphicon glyphicon-exclamation-sign"></span> Fora de Estoque
                        </button>
                    <?php } ?>
                    <br />
                    <a href="detalhes.php?id=<?php echo htmlspecialchars($Exibir['id_produto'], ENT_QUOTES, 'UTF-8'); ?>" style="text-decoration:none;">
                        <button class="btn btn-lg btn-block btn-primary">
                            <span class="glyphicon glyphicon-info-sign"></span> Detalhes
                        </button>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Carrossel celular -->
    <div class="carousel-wrapper">
      <div class="carousel-container">
        <?php foreach($produtos as $Exibir) { ?>
          <div class="carousel-item">
              <img src="Produtos/<?php echo htmlspecialchars($Exibir['ds_img'] ?: 'default.jpg', ENT_QUOTES, 'UTF-8'); ?>" class="img-responsive produto-img" alt="<?php echo htmlspecialchars($Exibir['nm_nome'], ENT_QUOTES, 'UTF-8'); ?>" />
              <div><h3><b><?php echo mb_strimwidth(htmlspecialchars($Exibir['nm_nome'], ENT_QUOTES, 'UTF-8'), 0, 30, '...'); ?></b></h3></div>
              <div><h4>R$ <?php echo number_format($Exibir['vl_produto'], 2, ',', '.'); ?></h4></div>
              <div class="text-center" style="margin-top:7px;">
                  <?php if ($Exibir['qtd_estoque'] > 0) { ?>
                      <a href="carrinho.php?id=<?php echo htmlspecialchars($Exibir['id_produto'], ENT_QUOTES, 'UTF-8'); ?>" style="text-decoration:none;">
                          <button class="btn btn-lg btn-block btn-default" style="background:#fdeb00; color:black;">
                              <span class="glyphicon glyphicon-usd"></span> Comprar
                          </button>
                      </a>
                  <?php } else { ?>
                      <button class="btn btn-lg btn-block btn-danger" disabled>
                          <span class="glyphicon glyphicon-exclamation-sign"></span> Fora de Estoque
                      </button>
                  <?php } ?>
                  <br />
                  <a href="detalhes.php?id=<?php echo htmlspecialchars($Exibir['id_produto'], ENT_QUOTES, 'UTF-8'); ?>" style="text-decoration:none;">
                      <button class="btn btn-lg btn-block btn-primary">
                          <span class="glyphicon glyphicon-info-sign"></span> Detalhes
                      </button>
                  </a>
              </div>
          </div>
        <?php } ?>
      </div>
    </div>
</div>

<br /><br />

<?php include 'rodape.html'; ?>
</body>
</html>
