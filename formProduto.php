<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <title> Bella Boutique</title>
    <meta name="Author" content="Felipe Jobim">
    <link rel="icon" type="image/png" href="Logos/belalogo.jpg">
    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="estilo.css">
    <script src="jquery.mask.js"></script>
    <script>
    $(document).ready(function()
    {
        $('#txtpreco').mask('0.000.000,00', {reverse: true});
    });
    </script>
</head>
<body>
<?php
	session_start();

    if(empty($_SESSION['Status']) || $_SESSION['Status'] != 1){
        header('location:index.php');
    }
	include 'conexao.php';	
	include 'nav.php';
	include 'cabecalho.html';

    $consultaCategoria = $cn-> query("select * from tbl_categoria");
    $consultaMarca = $cn-> query("select * from tbl_marca");
	?>
	<div class="container-fluid">
		<div+ class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<h2 style="font-size:3.5vw; color: #000; text-shadow: 1px 1px 0px #fdeb00; letter-spacing: 3px; text-align: center; margin-top: -30px">Inclusão de Produtos</h2>
				<form method="post" action="insprod.php" name="incluiProd" enctype="multipart/form-data">
					<div class="form-group">
						<label for="txtnome">Nome do Produto</label>
						<input name="txtnome" type="text" class="form-control" required id="txtnome">
					</div>
					<div class="form-group">
					<label for="sltcat">Categoria</label>
					<select class="form-control" name="sltcat">
					  <option value="">Selecione</option>
                      <?php while($lista = $consultaCategoria -> fetch(PDO::FETCH_ASSOC)) { ?>
					  <option value="<?php echo $lista['id_categoria']?>"><?php echo $lista['nm_categoria']?></option>
                      <?php } ?>			
					</select>
					</div>
				    <div class="form-group">
					<label for="sltautor">Marca</label>
					<select class="form-control" name="sltmarca">
					  <option value="">Selecione</option>
                      <?php while($lista = $consultaMarca -> fetch(PDO::FETCH_ASSOC)) { ?>
					  <option value="<?php echo $lista['id_marca']?>"><?php echo $lista['nm_marca']?></option>
                      <?php } ?>
					</select>
					</div>
					<div class="form-group">
					<label for="txtcor">Cor</label>
					<input type="text" class="form-control"  name="txtcor"  required id="txtcor">
					</div>					
					<div class="form-group">
					<label for="txtdrop">Código</label>
                    <input type="text" class="form-control"  name="txtdrop"  required id="txtdrop">
					</div>
					<div class="form-group">
					<label for="txtpreco">Preço</label>
					<input type="text" class="form-control"  name="txtpreco"  required id="txtpreco">
					</div>
					<div class="form-group">
					<label for="txtqtde">Quantidade em Estoque</label>
					<input type="number" class="form-control" name="txtqtde" required id="txtqtde">
					</div>
					<div class="form-group">
					<label for="txtresumo">Resumo do Produto</label>
						<textarea rows="5" class="form-control" name="txtresumo"></textarea>
					</div>					
					<div class="form-group">
					<label for="txtfoto1">Foto Principal</label>
					<input type="file" accept="Produtos/*" class="form-control" name="txtfoto1" required id="txtfoto1">
					</div>
					<div class="form-group">
					<label for="sltlanc">Lançamento?</label>
					<select class="form-control" name="sltlanc">
					  <option value="">Selecione</option>
					  <option value="S">Sim</option>
					  <option value="N">Não</option>					  
					</select>
					</div>
				<button type="submit" class="btn btn-lg btn-primary">
					<span class="glyphicon glyphicon-pencil"></span> Cadastrar
				</button>
				</form>
			</div>
		</div+>
	</div>
	<?php include 'rodape.html' ?>
</body>
</html>