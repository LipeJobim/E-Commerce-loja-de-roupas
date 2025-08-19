<?php
include 'conexao.php';

$token = $_GET['token'];

$stmt = $cn->prepare("SELECT * FROM tbl_recuperacao WHERE token = :token AND expira_em > NOW()");
$stmt->bindParam(':token', $token);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    die("Link inválido ou expirado.");
}

$dados = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<form method="POST" action="salvar_nova_senha.php">
    <input type="hidden" name="id_usuario" value="<?= $dados['id_usuario'] ?>">
    <label>Nova senha:</label>
    <input type="password" name="nova_senha" class="form-control" required>
    <label>Confirmar nova senha:</label>
    <input type="password" name="confirma_senha" class="form-control" required>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
