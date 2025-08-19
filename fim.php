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
	include 'conexao.php';	
	include 'nav.php';
	include 'cabecalho.html';
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 text-center">
				<h2>Compra efetuada com sucesso!<br><br> Seu número de registro é: <b><?php echo $ticket; ?></b></h2>							
			</div>
		</div>
	</div>
	<br>
	<?php include 'rodape.html' ?>
</body>
</html>