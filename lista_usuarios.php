<?php
session_start();

if(empty($_SESSION['Status']) || $_SESSION['Status'] != 1){
    header('location:index.php');
    exit;
}

include 'conexao.php';
include 'nav.php';
include 'cabecalho.html';

try {
    $sql = "SELECT id_usuario, nm_usuario, sbnm_usuario, desc_email, desc_endereco FROM tbl_usuario ORDER BY nm_usuario";
    $stmt = $cn->query($sql);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar usuários: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Usuários - Bella Boutique</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
      <link rel="stylesheet" href="esti.css">
</head>
<body>
<div class="container">
    <h2 class="text-center" style="margin-top:20px;">Lista de Usuários</h2>
    <table class="table table-striped table-bordered" style="margin-top:20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Email</th>
                <th>Endereço</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($usuarios as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id_usuario']) ?></td>
                <td><?= htmlspecialchars($user['nm_usuario']) ?></td>
                <td><?= htmlspecialchars($user['sbnm_usuario']) ?></td>
                <td><?= htmlspecialchars($user['desc_email']) ?></td>
                <td><?= htmlspecialchars($user['desc_endereco']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="adm.php" class="btn btn-default">Voltar</a>
</div>

<?php include 'rodape.html'; ?>

</body>
</html>
