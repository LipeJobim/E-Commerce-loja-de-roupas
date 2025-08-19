<?php
include 'conexao.php';  // include com arquivo de conexao
include 'resize-class.php';

//variáveis que vão receber os dados do formulário que esta na pagina formProduto
$nome = $_POST['txtnome'];
$categoria = $_POST['sltcat'];  // recebendo o valor do campo select, valor numérico
$marca = $_POST['sltmarca']; // recebendo o valor do campo select, valor numérico
$drop = $_POST['txtdrop'];
$cor = $_POST['txtcor'];
$preco = $_POST['txtpreco'];
$qtde = $_POST['txtqtde'];
$resumo = $_POST['txtresumo'];
$lanc = $_POST['sltlanc'];

$remover1='.';  // criando variável e atribuindo o valor de ponto para ela
$preco = str_replace($remover1, '', $preco); // removendo ponto de casa decimal,substituindo por vazio

$remover2=','; // criando variável e atribuindo o valor de virgula para ela
$preco = str_replace($remover2, '.', $preco); // removendo virgula de casa decimal,substituindo por ponto

$recebe_foto1 = $_FILES['txtfoto1'];
$destino = "Produtos/";  // informando para qual diretorio será enviado a imagem

//gerando nome aleatorio para imagem
// preg_match vai pegar imagens nas extensões jpg|jpeg|png|gif
// do nome que esta na variavel $recebe_foto1 do parametro name e a $extensão vai receber o formato
preg_match("/\.(jpg|jpeg|png|gif){1}$/i",$recebe_foto1['name'],$extencao1);

// a função md5 vai gerar um valor randomico  com base no horario "time"
// incrementar o ponto e a extensão
// função md5 é criado para gerar criptografia
$img_nome1 = md5(uniqid(time())).".".$extencao1[1];

try // try para tentar inserir
{
    $inserir=$cn->query("insert into tbl_produtos(nm_nome, id_categoria, id_marca, nm_artigo, nm_color_produto, vl_produto, qtd_estoque, ds_resumo_produto, ds_img, prod_lanc) VALUES ('$nome', '$categoria', '$marca', '$drop', '$cor', '$preco', '$qtde', '$resumo', '$img_nome1', '$lanc')");
    move_uploaded_file($recebe_foto1['tmp_name'], $destino.$img_nome1);             
    $resizeObj = new resize($destino.$img_nome1);
    $resizeObj -> resizeImage(1024, 1280, 'crop');
    $resizeObj -> saveImage($destino.$img_nome1, 100);
    header('Location:index.php');
}catch(PDOException $e) // se houver algum erro explodir na tela a mensagem de erro
{  
	echo $e->getMessage();
}
?>