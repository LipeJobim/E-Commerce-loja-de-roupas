<?php
include 'conexao.php';

$id = $_POST['id_usuario'];
$senha = $_POST['nova_senha'];
$confirmar = $_POST['confirma_senha'];

if ($senha !== $confirmar) {
    die("As senhas não coincidem.");
}

$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

// Atualiza a senha
$stmt = $cn->prepare("UPDATE tbl_usuario SET desc_senha = :senha WHERE id_usuario = :id");
$stmt->execute([':senha' => $senhaCriptografada, ':id' => $id]);

// Deleta o token usado
$cn->prepare("DELETE FROM tbl_recuperacao WHERE id_usuario = :id")->execute([':id' => $id]);

echo "Senha alterada com sucesso. <a href='loginusuario.php'>Fazer login</a>";
