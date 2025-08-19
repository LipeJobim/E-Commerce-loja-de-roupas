<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <title>Bella Boutique - Buscar</title>
    <meta name="Author" content="Marcus Vinicius">
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
	include 'conexao.php';	
	include 'nav.php';
	include 'cabecalho.html';

    if(empty($_GET['txtPesquisar']))
    {
        echo "<html><script>location.href='index.php'</script></html>";
    }
    $pesquisar = $_GET['txtPesquisar'];
    $consulta = $cn->query("select * from vw_produto where nm_nome like concat('%','$pesquisar','%') or nm_marca like concat('%','$pesquisar','%') or nm_categoria like concat('%','$pesquisar','%')");
	if($consulta->rowCount() == 0)
    {
        echo "<html><script>location.href='erro2.php'</script></html>";
    }
    ?>
	
<div class="container-fluid">
    <?php while($Exibir = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
	<div class="row text-center" style="margin-top: 5px;">
		<div class="col-sm-2 col-sm-offset-1"><img src="Produtos/<?php echo $Exibir['ds_img']; ?>" class="img-responsive"></div>
		<div class="col-sm-4"><h2 style="padding-top:20%"><b><?php echo $Exibir['nm_nome'];?></b></h2></div>
		<div class="col-sm-2"><h2 style="padding-top:35%"><b>Preço:<br></b>R$<?php echo number_format($Exibir['vl_produto'],2,',','.');?></h4></div>
		<div class="col-sm-2 col-xs-offset-right-1" style="padding-top:6.9%">
        <a href="detalhes.php?id=<?php echo $Exibir['id_produto'] ?>" style="text-decoration:none;">
        <button class="btn btn-lg btn-block btn-primary">
        <span class="glyphicon glyphicon-info-sign"></span> Detalhes
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