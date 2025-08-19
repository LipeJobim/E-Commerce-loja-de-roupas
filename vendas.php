<?php
session_start();
include 'conexao.php';
include 'nav.php';
include 'cabecalho.html';

// Verifica se o usuário tem permissão para acessar a área administrativa
if(empty($_SESSION['Status']) || $_SESSION['Status'] != 1){
    header('location:index.php');
    exit;
}

// Consulta as vendas no banco de dados
$consulta = $cn->query("SELECT * FROM tbl_vendas");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas - Bella Boutique</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center" style="color: #000; text-shadow: 1px 1px 0px #fdeb00; letter-spacing: 3px;">Histórico de Vendas</h1>
        <br>
        <table class="table table-bordered table-striped text-center">
            <thead class="bg-primary" style="color: white;">
                <tr>
                    <th>ID Venda</th>
                    <th>Ticket</th>
                    <th>ID Cliente</th>
                    <th>ID Produto</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Valor Total</th>
                    <th>Data da Venda</th>
                </tr>
            </thead>
            <tbody>
                <?php while($exibir = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo $exibir['id_venda']; ?></td>
                        <td><?php echo $exibir['nm_ticket']; ?></td>
                        <td><?php echo $exibir['id_cliente']; ?></td>
                        <td><?php echo $exibir['id_produto']; ?></td>
                        <td><?php echo $exibir['qtd_produto']; ?></td>
                        <td>R$ <?php echo number_format($exibir['vl_produto'], 2, ',', '.'); ?></td>
                        <td>R$ <?php echo number_format($exibir['vl_total'], 2, ',', '.'); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($exibir['data_venda'])); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php include 'rodape.html'; ?>
</body>
</html>
