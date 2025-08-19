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
	session_start();
	if (empty($_SESSION['ID'])) {
		header('location:formlogin.php');
	}
	include 'conexao.php';	
	include 'nav.php';
	include 'cabecalho.html';
	
	//jogando na variavel $ticket_compra o ticket recebido pelo parametro
	$ticket_compra=$_GET['ticket'];
	
	//Criando select pelo ticket recebido que foi armazenado na variavel $ticket_compra
	$consultaVenda = $cn->query("SELECT * FROM vw_venda WHERE nm_ticket='$ticket_compra'");
	?>
	
    <div class="container-fluid">
        <div class="row" style="margin-top: 15px;">
            <h1 class="text-center">Compra: <?php echo $ticket_compra ?></h1>
        </div>
        
        <div class="row" style="margin-top: 15px;">
            <div class="col-sm-1 col-sm-offset-1"><h4>Data</h4> </div>
            <div class="col-sm-2"><h4>Ticket </h4></div>
            <div class="col-sm-5"><h4>Produto</h4></div>
            <div class="col-sm-1"><h4>Quantidade</h4></div>
            <div class="col-sm-2"><h4>Preço</h4></div>	
        </div>
        <?php
        $total=0; // criando variavel chamado total
        while ($exibeVenda=$consultaVenda->fetch(PDO::FETCH_ASSOC)) {		
            $total += $exibeVenda['vl_total'];
        ?>
        
        <div class="row" style="margin-top: 15px;">
            <div class="col-sm-1 col-sm-offset-1"><b> <?php echo date('d/m/Y', strtotime($exibeVenda['data_venda'])) ?></b></div>
            <div class="col-sm-2"><b> <?php echo $exibeVenda['nm_ticket'] ?></b></div>
            <div class="col-sm-5"><b> <?php echo $exibeVenda['nm_nome'] ?></b></div>
            <div class="col-sm-1"><b> <?php echo $exibeVenda['qtd_produto'] ?></b></div>
            <div class="col-sm-2"><b> R$ <?php echo number_format($exibeVenda['vl_total'],2,',','.') ?></b></div>	
        </div>
        <?php } ?>
        
        <div class="row" style="margin-top: 15px;">
            <h2 class="text-center">Total desta compra: R$ <?php echo number_format($total,2,',','.');?></h2>
        </div>
    </div>
    <br>
	<?php
	include 'rodape.html';
	?>
</body>
</html>