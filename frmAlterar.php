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
    <script>
    /* mscara para o preço */	
    $(document).ready(function(){
    $('#preco').mask('000.000.000.000.000,00', {reverse: true});	
    });
    </script>
</head>
<body>
<?php
	session_start();	
    // se a sessão id estiver vazia ou se a sessão estatus for diferente de adm entao execute
	if(empty($_SESSION['Status']) || $_SESSION['Status'] != 1){
			header('location:index.php');  // redireciona para página index.php
	}
	$cd = $_GET['id'];
	$cd2 = $_GET['id2'];
	$cd3 = $_GET['id3'];
	include 'conexao.php';	
	include 'nav.php';
	include 'cabecalho.html';
	$consulta = $cn->query("SELECT * FROM tbl_produtos WHERE id_produto='$cd'");	
	$exibe = $consulta->fetch(PDO::FETCH_ASSOC);
	$consultaCat = $cn->query("SELECT id_categoria, nm_categoria FROM tbl_categoria where id_categoria='$cd2' union select id_categoria, nm_categoria FROM tbl_categoria where id_categoria !='$cd2'");
	$consultaMarca = $cn->query("SELECT id_marca, nm_marca FROM tbl_marca where id_marca='$cd3' union select id_marca, nm_marca FROM tbl_marca where id_marca !='$cd3'");
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<h2 style="font-size:2.3vw; color: #000; text-shadow: 1px 1px 0px #fdeb00; letter-spacing: 5px; text-align:center;">ALTERAÇÃO DE PRODUTO</h2>
				<form method="post" action="alterarProduto.php?cd_altera=<?php echo $cd; ?>" name="incluiProd" enctype="multipart/form-data">
					<div class="form-group">
						<label for="txtnome">Nome</label>
						<input type="text" name="txtnome" value="<?php echo $exibe['nm_nome']; ?>"  class="form-control" required id="txtnome">
					</div>
					<div class="form-group">
						<label for="sltmarca">Marca</label>
						<select class="form-control" name="sltmarca">
							<?php					
								while($exibeautor = $consultaMarca->fetch(PDO::FETCH_ASSOC)){
							?>
							<option value="<?php echo $exibeautor['id_marca'];?>"><?php echo $exibeautor['nm_marca'];?></option>;
							<?php }	?>	
						</select>
					</div>
                    <div class="form-group">
						<label for="sltcat">Categoria</label>
						<select class="form-control" name="sltcat">
							<?php					
								while($exibecat = $consultaCat->fetch(PDO::FETCH_ASSOC)){
							?>
							<option value="<?php echo $exibecat['id_categoria'];?>"><?php echo $exibecat['nm_categoria'];?></option>;
							<?php }	?>	
						</select>
					</div>
					<div class="form-group">
					<label for="txtcor">Cor</label>
					<input type="text" class="form-control" value="<?php echo $exibe['nm_color_produto']; ?>" name="txtcor" required id="txtcor">
					</div>
					<div class="form-group">
					<label for="txtartigo">Artigo</label>
					<input type="text" class="form-control" value="<?php echo $exibe['nm_artigo']; ?>" name="txtartigo" required id="txtartigo">
					</div>
					<div class="form-group">
					<label for="txtpreco">Preço</label>
					<input type="text" class="form-control" required name="txtpreco" value="<?php echo $exibe['vl_produto']; ?>" id="preco">
					</div>
					<div class="form-group">
					<label for="txtqtde">Quantidade em Estoque</label>
					<input type="number" class="form-control" name="txtqtde" value="<?php echo $exibe['qtd_estoque']; ?>" required id="txtqtde">
					</div>
					<div class="form-group">
					<label for="txtresumo">Resumo</label>
						<textarea rows="5" class="form-control" name="txtresumo"><?php echo $exibe['ds_resumo_produto']; ?></textarea>
					</div>
					<div class="form-group">
					<label for="txtfoto1">Foto</label>
					<input type="file" accept="image/*" class="form-control" name="txtfoto1" id="foto1">
					</div>
					<div class="form-group">
					<img src="Produtos/<?php echo $exibe['ds_img']; ?>" width="100px" >
					</div>
					<div class="form-group">
					<label for="sltlanc">Lançamento?</label>
					<select class="form-control" name="sltlanc">					  				
					<!-- se o sg_lancamento == S este valor estará selecionado senão vazio -->
					<option value="S" <?=($exibe['prod_lanc'] == 'S')?'selected':''?>>Sim</option>	<option value="N" <?=($exibe['prod_lanc'] == 'N')?'selected':''?>>Não</option>	  
					</select>
					</div>
					<button type="submit" class="btn btn-lg btn-primary">
					<span class="glyphicon glyphicon-pencil"></span> Alterar
				    </button>
				</form>
			</div>
		</div>
        <br>
	</div>
	<?php include 'rodape.html' ?>
</body>
</html>