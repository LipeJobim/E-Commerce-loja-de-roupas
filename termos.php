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
        <h1>Termos e Condições de Uso</h1>

        <h3>Confirmação de Dados Anti Fraude</h3>

        <p>
            É importante que todos os seus dados informados no cadastro estejam corretos e sem divergências, pois realizamos análise de dados a fim de garantir a segurança de compras em nosso site, evitando enviar pedidos efetuados com cartões clonados e afins. 
            É importante também que seu telefone seja informado corretamente, pois em caso de trocas e devoluções ou outros procedimentos que sejam necessários entrar em contato possamos contatar o cliente.
        </p>

        <p>
            Em todas as primeiras compras no site, ou quando houver divergências ou inconsistência nos dados informados no cadastro da compra, entraremos em contato via Whatsapp com o número <strong>54 99611-3790</strong>, solicitando confirmação de identidade.
        </p>
    </div>

    <?php include 'rodape.html'; ?>

</body>
</html>
