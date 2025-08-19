<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <title>Bella Boutique</title>
    <meta name="Author" content="Felipe Jobim">
    <link rel="icon" type="image/png" href="Logos/belalogo.jpg">

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="esti.css">
</head>
<body>
    <?php 
    session_start();  // Inicia a sessão para verificar se o ADM está logado
    include 'conexao.php';
    include 'nav.php';
    include 'cabecalho.html';?>

<div class="container" style="padding: 40px 15px;">
        <h1>Política de Entrega</h1>

        <h3>Prazo de entrega</h3>
        <p>O prazo para entrega dos produtos varia de acordo com o local e a forma de pagamento escolhida.</p>
        <p>Para calcular o prazo de entrega do produto, basta informar seu CEP.</p>
        <p><strong>ATENÇÃO:</strong> O prazo para entrega do pedido passa a ser considerado a partir da postagem do produto nos Correios.</p>
        <p><strong>Entregas grátis em Getúlio Vargas</strong></p>

        <h3>Alteração de endereço</h3>
        <p>Não será possível a alteração do endereço de entrega após o processamento do pedido e liberação do produto no nosso Centro de Distribuição.</p>
    </div>


    <?php include 'rodape.html'; ?>  

</body>
</html>
