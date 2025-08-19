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
        <h1>Sobre Nós</h1>

        <p><strong>Bem-vindo à BELLA BOUTIQUE!</strong></p>

        <p>Que bom que você quer saber um pouco mais sobre a gente!</p>

        <p>
            A BELLA BOUTIQUE foi fundada em <strong>02 de DEZEMBRO de 2023</strong>, na cidade de <strong>GETÚLIO VARGAS - RS</strong>, com intuito de trazer as últimas tendências. 
            Hoje somos referência e sucesso em moda, sempre buscando estar atualizados em tudo o que é tendência no Brasil e no mundo.
        </p>

        <p>
            Desde nossa fundação, seguimos com um trabalho sério e comprometido com nossos clientes, colhendo os frutos de um rápido crescimento.
        </p>

        <hr style="margin: 40px 0;">

        <p><strong>Endereço:</strong> Loteamento Feliccita 1185, Bairro Santa Catarina, Getúlio Vargas - RS</p>
        <p><strong>Bella Boutique by Lary</strong></p>
    </div>

    <?php include 'rodape.html'; ?>

</body>
</html>
