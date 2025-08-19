<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0" />
    <title>Bella Boutique - Detalhes</title>
    <meta name="Author" content="Felipe Jobim" />
    <link rel="icon" type="image/png" href="Logos/belalogo.jpg" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Seu CSS personalizado -->
    <link rel="stylesheet" href="esti.css" />
    <style>
      #zoom-img {
        max-width: 80%;
        height: auto;
        cursor: zoom-in;
        transition: transform 0.3s ease;
        border-radius: 10px;
        border: 2px solid white;
      }

      #zoom-img.zoomed {
        transform: scale(2);
        cursor: zoom-out;
        position: relative;
        z-index: 9999;
        box-shadow: 0 0 20px rgba(0,0,0,0.5);
      }
    </style>
</head>
<body>

<?php
session_start();
include 'conexao.php';
include 'nav.php';
include 'cabecalho.html';

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $idproduto = intval($_GET['id']);

    // Consulta com prepared statement (proteção contra SQL Injection)
    $stmt = $cn->prepare("SELECT * FROM tbl_produtos WHERE id_produto = :id");
    $stmt->bindParam(':id', $idproduto, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        header("Location: index.php");
        exit;
    }

    $exibir = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: index.php");
    exit;
}
?>

<div class="container text-center">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="thumbnail">
                <img id="zoom-img" 
                     src="Produtos/<?php echo htmlspecialchars($exibir['ds_img'] ?: 'default.jpg', ENT_QUOTES, 'UTF-8'); ?>" 
                     class="img-responsive produto-img" 
                     alt="<?php echo htmlspecialchars($exibir['nm_nome'], ENT_QUOTES, 'UTF-8'); ?>" />

                <div class="caption">
                    <h3><strong><?php echo htmlspecialchars($exibir['nm_nome'], ENT_QUOTES, 'UTF-8'); ?></strong></h3>
                    <p><strong>Resumo:</strong> <?php echo nl2br(htmlspecialchars($exibir['ds_resumo_produto'], ENT_QUOTES, 'UTF-8')); ?></p>
                    <h4><strong>Preço:</strong> R$ <?php echo number_format($exibir['vl_produto'], 2, ',', '.'); ?></h4>

                    <?php if ($exibir['qtd_estoque'] > 0) { ?>
                        <a href="carrinho.php?id=<?php echo htmlspecialchars($exibir['id_produto'], ENT_QUOTES, 'UTF-8'); ?>" style="text-decoration:none;">
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

                    <a href="index.php" style="text-decoration:none;">
                        <button class="btn btn-block btn-primary">
                            <span class="glyphicon glyphicon-arrow-left"></span> Voltar ao Catálogo
                        </button>
                    </a>

                    <?php if (isset($_SESSION['Status']) && $_SESSION['Status'] == 1) { ?>
                        <br /><h5><b>Código: <?php echo htmlspecialchars($exibir['nm_artigo'], ENT_QUOTES, 'UTF-8'); ?></b></h5>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'rodape.html'; ?>

<script>
    document.getElementById('zoom-img').addEventListener('click', function() {
        this.classList.toggle('zoomed');
    });
</script>
</body>
</html>
