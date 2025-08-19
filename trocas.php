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
        <h1>Política de Trocas e Devoluções</h1>

        <h3>Direito a Troca/Devolução</h3>

        <p>
            O cliente que tenha comprado um produto vendido pela <strong>BELLA BOUTIQUE</strong> terá o direito de realizar a troca do mesmo pelos seguintes motivos:
        </p>
        <ul>
            <li>Insatisfação – Por cor, modelo ou tamanho;</li>
            <li>Produto entregue em desacordo ou defeito;</li>
        </ul>

        <h3>Cancelamento por arrependimento/insatisfação</h3>
        <p>
            Opção destinada ao cliente que deseja cancelar o pedido dentro do prazo legal.
        </p>

        <p style="color: red; font-weight: bold;">
            ATENÇÃO!!! MERCADORIAS DO DEPARTAMENTO DE PROMOÇÕES, AVARIA/DEFEITO, BLACK FRIDAY, BYE BYE INVERNO E BYE BYE VERÃO NÃO EFETUAMOS DEVOLUÇÃO E TROCA.
        </p>
    </div>

    <?php include 'rodape.html'; ?>

</body>
</html>
