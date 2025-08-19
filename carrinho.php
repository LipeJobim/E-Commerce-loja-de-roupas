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
	<link rel="stylesheet" href="estilo.css">
</head>
<body>	
	
<?php
session_start(); // iniciando sessão

// ===============================
// Login removido (não precisa mais)
// ===============================
// if (empty($_SESSION['ID'])) {
//     header('location:formlogin.php'); // redirecionava para login
// }

include 'conexao.php';    // incluindo arquivo de conexao
include 'nav.php';        // incluindo barra de navegação
include 'cabecalho.html'; // incluindo cabeçalho

// verificando se o código do produto NÃO está vazio
if (!empty($_GET['id'])) {

    // inserindo o código do produto na variável $cd_prod
    $cd_prod = $_GET['id'];

    // se a sessão carrinho não estiver preenchida
    if (!isset($_SESSION['carrinho'])) {
        // será criado uma sessão chamada carrinho para receber um vetor
        $_SESSION['carrinho'] = array();
    }

    // se o produto ainda não estiver no carrinho
    if (!isset($_SESSION['carrinho'][$cd_prod])) {
        // será adicionado o produto ao carrinho com quantidade 1
        $_SESSION['carrinho'][$cd_prod] = 1;
    } else {
        // se já estiver no carrinho, aumenta a quantidade
        $_SESSION['carrinho'][$cd_prod] += 1;
    }

    // mostrando o carrinho com o produto adicionado
    include 'mostraCarrinho.php';
} else {
    // mostrando o carrinho vazio ou com produtos já adicionados
    include 'mostraCarrinho.php';
}
?>

</html>