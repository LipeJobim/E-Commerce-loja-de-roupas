<?php
include 'conexao.php';

$nome = $_POST['txtnome'];
$sobrenome = $_POST['txtsobrenome'];
$celular = $_POST['txtcelular'];
$email = $_POST['txtemail'];
$senha = password_hash($_POST['txtsenha'], PASSWORD_DEFAULT); // Criptografa a senha
$endec = $_POST['txtendereco'];
$cidade = $_POST['txtcidade'];
$cep = $_POST['txtcep'];

try {
    // Verifica se o e-mail já está cadastrado
    $sql = "SELECT desc_email FROM tbl_usuario WHERE desc_email = :email";
    $stmt = $cn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header('Location: erro1.php');
        exit;
    }

    // Insere novo usuário com dados protegidos
    $sql = "INSERT INTO tbl_usuario 
        (nm_usuario, sbnm_usuario, cell_usuario, desc_email, desc_senha, desc_status, desc_endereco, desc_cidade, num_cep) 
        VALUES 
        (:nome, :sobrenome, :celular, :email, :senha, '0', :endereco, :cidade, :cep)";
    
    $stmt = $cn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':sobrenome', $sobrenome);
    $stmt->bindParam(':celular', $celular);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':endereco', $endec);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':cep', $cep);

    $stmt->execute();
    header('Location: ok.php');
    exit;
    
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage(); // Exibir erro em ambiente de desenvolvimento apenas
}
?>
