<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ERROR | E_PARSE);

include 'conexao.php'; // Certifique-se de que esta linha existe para usar $cn

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

$total = 0;
?>

<div class="container-fluid">
    <div class="row text-center" style="margin-top: 15px;">
        <h1>Carrinho de Compras</h1>
    </div>

    <?php if (empty($_SESSION['carrinho'])): ?>
        <div class="row text-center" style="margin-top: 15px;">
            <h1>Carrinho Vazio</h1>
        </div>
    <?php else: ?>
        <?php
        foreach ($_SESSION['carrinho'] as $cd => $qnt) {
            if (!is_numeric($cd)) continue; // Segurança adicional
            $stmt = $cn->prepare("SELECT * FROM tbl_produtos WHERE id_produto = :id");
            $stmt->bindParam(':id', $cd, PDO::PARAM_INT);
            $stmt->execute();
            $exibe = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($exibe) {
                $produto = htmlspecialchars($exibe['nm_nome'], ENT_QUOTES, 'UTF-8');
                $codigo_produto = htmlspecialchars($exibe['nm_artigo'], ENT_QUOTES, 'UTF-8');
                $preco = number_format($exibe['vl_produto'], 2, ',', '.');
                $imagem = htmlspecialchars($exibe['ds_img'] ?: 'default.jpg', ENT_QUOTES, 'UTF-8');
                $total += $exibe['vl_produto'];
        ?>
        <div class="row" style="margin-top: 15px;">
            <div class="col-sm-1 col-sm-offset-1">
                <img src="Produtos/<?php echo $imagem; ?>" class="img-responsive" />
            </div>

            <div class="col-sm-4">
                <h4 style="padding-top:20px"><?php echo $produto; ?></h4>
                <h5>Código: <?php echo $codigo_produto; ?></h5>
            </div>

            <div class="col-sm-2">
                <h4 style="padding-top:20px">R$ <?php echo $preco; ?></h4>
            </div>

            <div class="col-sm-2 col-xs-offset-right-1" style="padding-top:20px">
                <a href="#" onclick="confirmarRemocao(<?php echo intval($cd); ?>)">
                    <button class="btn btn-lg btn-block btn-danger">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </a>
            </div>
        </div>
        <?php
            }
        }
        ?>
    <?php endif; ?>
</div>

<script>
function confirmarRemocao(id) {
    if (confirm("Deseja remover este item do carrinho?")) {
        window.location.href = "removecarrinho.php?id=" + encodeURIComponent(id);
    }
}
</script>

<?php
$numero_vendedor = "inserir algum whats aqui";
$mensagem = "Olá, gostaria de fazer um pedido:\n";

if (!empty($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $cd => $_) {
        if (!is_numeric($cd)) continue;
        $stmt = $cn->prepare("SELECT nm_nome, nm_artigo, vl_produto FROM tbl_produtos WHERE id_produto = :id");
        $stmt->bindParam(':id', $cd, PDO::PARAM_INT);
        $stmt->execute();
        $exibe = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($exibe) {
            $nome_produto = $exibe['nm_nome'];
            $codigo_produto = $exibe['nm_artigo'];
            $preco_produto = $exibe['vl_produto'];
            $mensagem .= "- Código: $codigo_produto | $nome_produto (R$ " . number_format($preco_produto, 2, ',', '.') . ")\n";
        }
    }

    $mensagem .= "Total: R$ " . number_format($total, 2, ',', '.') . "\n";
    $link_whatsapp = "https://wa.me/" . $numero_vendedor . "?text=" . urlencode($mensagem);
}
?>

<div class="row text-center" style="margin-top: 15px;">
    <h1><b>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></b></h1>
</div>

<div class="row text-center" style="margin-top: 15px;">
    <a href="index.php">
        <button class="btn btn-lg btn-primary">Continuar Comprando</button>
    </a>

    <?php if (!empty($_SESSION['carrinho'])): ?>
        <a href="<?php echo htmlspecialchars($link_whatsapp, ENT_QUOTES, 'UTF-8'); ?>" target="_blank">
            <button class="btn btn-lg btn-success">Finalizar Compra</button>
        </a>
    <?php endif; ?>
</div>
