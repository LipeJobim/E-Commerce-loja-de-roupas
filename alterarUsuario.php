<?php
include 'conexao.php';  // incluindo a conexao
$cd_usuario = $_GET['id_altera'];  // variavel recebe o código do livro que acabamos de receber do formulário

// todas as laterações feitas nos campos serão salvas nas variaveis abaixo
$nome = $_POST['txtnome']; 
$sobrenome = $_POST['txtsobrenome'];
$cell = $_POST['txtcell'];
$email = $_POST['txtemail'];
$senha = $_POST['txtsenha'];
$endereco = $_POST['txtendereco'];
$cidade = $_POST['txtcidade'];
$cep = $_POST['txtcep'];

try // comando update para realizar as trocas
{
	$alterar = $cn->query("UPDATE tbl_usuario SET  
    nm_usuario = '$nome',
    sbnm_usuario = '$sobrenome',
    cell_usuario = '$cell',
    desc_email = '$email',
    desc_senha= '$senha',
    desc_endereco = '$endereco',
    desc_cidade = '$cidade',
    num_cep = '$cep'
    WHERE id_usuario = '$cd_usuario'"); // as alterações serão feitas baseadas pelo codigo que recebemos

	header('location:areauser.php');  // redirecionando para a pagina menu principal (se tudo der certo)
}catch(PDOException $e)  // se exsitir algum problema, será gerado uma mensagem de erro
{ 
	echo $e->getMessage();  
}
?>