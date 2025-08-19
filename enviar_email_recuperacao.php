<?php
include 'conexao.php';

$email = $_POST['email'];

// Verifica se o e-mail existe
$stmt = $cn->prepare("SELECT id_usuario FROM tbl_usuario WHERE desc_email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    $token = bin2hex(random_bytes(16));
    $expira = date("Y-m-d H:i:s", strtotime('+1 hour'));

    // Cria tabela se ainda não existir (faça isso no banco antes!)
    $cn->prepare("INSERT INTO tbl_recuperacao (id_usuario, token, expira_em) VALUES (:id, :token, :expira)")
        ->execute([
            ':id' => $usuario['id_usuario'],
            ':token' => $token,
            ':expira' => $expira
        ]);

    $link = "http://SEUSITE.com/redefinir_senha.php?token=$token";

    // Envia o e-mail
    mail($email, "Recuperação de senha", "Clique para redefinir sua senha: $link");

    echo "Um link foi enviado para seu e-mail.";
} else {
    echo "E-mail não encontrado.";
}
