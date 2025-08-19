<?php
include 'conexao.php';  // incluindo a conexao
include 'resize-class.php'; // classe para redimensionar imagem
$cd_produto = $_GET['cd_altera'];  // variavel recebe o código do livro que acabamos de receber do formulário

// abaixo criando a consulta pelo codigo do livro que recebemos acima
$consulta = $cn->query("SELECT ds_img FROM tbl_produtos WHERE id_produto='$cd_produto'"); 

//criando uma array 
$exibe = $consulta->fetch(PDO::FETCH_ASSOC);

// todas as laterações feitas nos campos serão salvas nas variaveis abaixo
$nome = $_POST['txtnome']; 
$marca = $_POST['sltmarca'];
$categoria = $_POST['sltcat'];
$cor = $_POST['txtcor'];
$artigo = $_POST['txtartigo'];
$preco = $_POST['txtpreco'];
$qtde = $_POST['txtqtde'];
$resumo = $_POST['txtresumo'];
$lanc = $_POST['sltlanc'];

$remover1='.';  // variável que vai receber o ponto
$preco = str_replace($remover1, '', $preco); // substituindo . por vazio
$remover2=','; // variável que vai receber a virgula
$preco = str_replace($remover2, '.', $preco); // substituindo , por .

$recebe_foto1 = $_FILES['txtfoto1'];  // recebendo conteudo do campo file
$destino = "Produtos/";  //pasta aonde será feito upload da imagem

if (!empty($recebe_foto1['name'])) // se a propriedade name[propriedade que pega o nome da imagem ] não estiver vazia faça
{ 
	preg_match("/\.(jpg|jpeg|png|gif){1}$/i",$recebe_foto1['name'],$extencao1); // pegar extensão
	$img_nome1 = md5(uniqid(time())).".".$extencao1[1]; //gerar nome unico para img, enviar esta variável
	$upload_foto1=1; // se variavel criada for 1 precisará trocar imagem
}
else // caso não haja alteração na imagem, pegar o nome da imagem que está no banco
{
	$img_nome1=$exibe['ds_img'];
	$upload_foto1=0;  // zero pq não fará atualização de fotos
	
}
try // comando update para realizar as trocas
{
	$alterar = $cn->query("UPDATE tbl_produtos SET  
    nm_nome = '$nome',
    id_marca = '$marca',
    id_categoria = '$categoria',
    nm_color_produto = '$cor',
    nm_artigo= '$artigo',
    vl_produto = '$preco',
    qtd_estoque = '$qtde',
    ds_resumo_produto = '$resumo',
    ds_img = '$img_nome1',
    prod_lanc = '$lanc'	
    WHERE id_produto = '$cd_produto'"); // as alterações serão feitas baseadas pelo codigo que recebemos

	if ($upload_foto1==1) // se a foto1 for igual a 1 é pq foi feito alteração será feita
    {  
		move_uploaded_file($recebe_foto1['tmp_name'], $destino.$img_nome1);             
		$resizeObj = new resize($destino.$img_nome1);
		$resizeObj -> resizeImage(1024, 1280, 'crop');
		$resizeObj -> saveImage($destino.$img_nome1, 100);
	}
	header('location:adm.php');  // redirecionando para a pagina menu principal (se tudo der certo)
}catch(PDOException $e)  // se exsitir algum problema, será gerado uma mensagem de erro
{ 
	echo $e->getMessage();  
}
?>