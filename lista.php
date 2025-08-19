<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    // se a sessão id estiver vazia ou se a sessão estatus for diferente de adm entao execute
	if(empty($_SESSION['Status']) || $_SESSION['Status'] != 1){
			header('location:index.php');  // redireciona para página index.php
	}
	include 'conexao.php';	
	include 'nav.php';
	include 'cabecalho.html';
	$consulta = $cn->query("select * from tbl_produtos");
	?>
    <div class="container-fluid">
	<?php while ($exibe = $consulta->fetch(PDO::FETCH_ASSOC)) {	?>
	<div class="row" style="margin-top: 15px;">
		<div class="col-sm-1 col-sm-offset-1">
            <img src="Produtos/<?php echo $exibe['ds_img']; ?>" class="img-responsive">
        </div>
		<div class="col-sm-5">
            <h4 style="padding-top:20px;"><b><?php echo $exibe['nm_nome']; ?></b></h4>
			<h4 style="padding-top:20px;"><b><?php echo $exibe['nm_artigo']; ?></b></h4>
        </div>
		<div class="col-sm-2" style="padding-top:20px">
		<a href="frmAlterar.php?id=<?php echo $exibe['id_produto'];?>&id2=<?php echo $exibe['id_categoria'];?>&id3=<?php echo $exibe['id_marca'];?>" style="text-decoration:none;">
		<button class="btn btn-lg btn-block btn-primary">
		<span class="glyphicon glyphicon-pencil"></span> Alterar
		</button>
		</a>
		</div>
		<div class="col-sm-2 col-xs-offset-right-1" style="padding-top:20px">
		<a href="excluir.php?id=<?php echo $exibe['id_produto']; ?>" style="text-decoration:none;">	
		<button class="btn btn-lg btn-block btn-danger">
		<span class="glyphicon glyphicon-remove"></span> Excluir		
		</button>
		</a>
		</div> 
	</div>		
	<?php } ?>
    </div>
	<br>
	<?php include 'rodape.html' ?>
</body>
</html>