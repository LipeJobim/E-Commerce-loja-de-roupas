<?php
session_start();
if (empty($_SESSION['ID'])) {
    header('location:index.php');
    exit;
}
$cd = $_SESSION['ID'];

include 'conexao.php';    
include 'nav.php';
include 'cabecalho.html';

try {
    $consulta = $cn->prepare("SELECT * FROM tbl_usuario WHERE id_usuario = :id");
    $consulta->bindParam(':id', $cd, PDO::PARAM_INT);
    $consulta->execute();
    $exibe = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$exibe) {
        die("Usuário não encontrado.");
    }
} catch (PDOException $e) {
    die("Erro ao buscar usuário: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['txtnome'] ?? '';
    $sobrenome = $_POST['txtsobrenome'] ?? '';
    $celular = $_POST['txtcell'] ?? '';
    $email = $_POST['txtemail'] ?? '';
    $novaSenha = $_POST['txtsenha'] ?? '';
    $endereco = $_POST['txtendereco'] ?? '';
    $cidade = $_POST['txtcidade'] ?? '';
    $cep = $_POST['txtcep'] ?? '';

    try {
        // Se o campo de nova senha estiver preenchido, criptografa
        if (!empty($novaSenha)) {
            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
        } else {
            // Se não, mantém a senha antiga (já criptografada)
            $senhaHash = $exibe['desc_senha'];
        }

        // Atualiza os dados do usuário
        $sqlUpdate = "UPDATE tbl_usuario SET 
                        nm_usuario = :nome,
                        sbnm_usuario = :sobrenome,
                        cell_usuario = :celular,
                        desc_email = :email,
                        desc_senha = :senha,
                        desc_endereco = :endereco,
                        desc_cidade = :cidade,
                        num_cep = :cep
                      WHERE id_usuario = :id";

        $stmtUpdate = $cn->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':nome', $nome);
        $stmtUpdate->bindParam(':sobrenome', $sobrenome);
        $stmtUpdate->bindParam(':celular', $celular);
        $stmtUpdate->bindParam(':email', $email);
        $stmtUpdate->bindParam(':senha', $senhaHash);
        $stmtUpdate->bindParam(':endereco', $endereco);
        $stmtUpdate->bindParam(':cidade', $cidade);
        $stmtUpdate->bindParam(':cep', $cep);
        $stmtUpdate->bindParam(':id', $cd, PDO::PARAM_INT);

        if ($stmtUpdate->execute()) {
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "<div class='alert alert-danger'>Erro ao atualizar usuário.</div>";
        }

    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erro no banco de dados: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bella Boutique</title>
    <meta name="Author" content="Felipe Jobim">
    <link rel="icon" type="image/png" href="Logos/belalogo.jpg">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="esti.css">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <h2 style="font-size:2.3vw; color: #000; text-shadow: 1px 1px 0px #fdeb00; letter-spacing: 5px; text-align:center;">ALTERAÇÃO DE USUÁRIO</h2>
            <form method="post" action="" name="alteraUsu" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtnome">Nome</label>
                    <input type="text" name="txtnome" value="<?php echo htmlspecialchars($exibe['nm_usuario']); ?>" class="form-control" required id="txtnome">
                </div>
                <div class="form-group">
                    <label for="txtsobrenome">Sobrenome</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($exibe['sbnm_usuario']); ?>" name="txtsobrenome" required id="txtsobrenome">
                </div>
                <div class="form-group">
                    <label for="txtcell">Celular</label>
                    <input type="tel" class="form-control" value="<?php echo htmlspecialchars($exibe['cell_usuario']); ?>" name="txtcell" required id="txtcell">
                </div>
                <div class="form-group">
                    <label for="txtemail">Email</label>
                    <input type="email" class="form-control" required name="txtemail" value="<?php echo htmlspecialchars($exibe['desc_email']); ?>" id="txtemail">
                </div>
                <!-- Campo de senha com botão mostrar -->
                <div class="form-group">
                    <label for="txtsenha">Nova Senha</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="txtsenha" id="txtsenha">
                        <span class="input-group-addon" onclick="togglePassword('txtsenha', this)" style="cursor:pointer;">
                            <i class="glyphicon glyphicon-eye-open"></i>
                        </span>
                    </div>
                </div>
                <!-- Confirmação da senha -->
                <div class="form-group">
                    <label for="confirmaSenha">Confirme a Nova Senha</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="confirmaSenha">
                        <span class="input-group-addon" onclick="togglePassword('confirmaSenha', this)" style="cursor:pointer;">
                            <i class="glyphicon glyphicon-eye-open"></i>
                        </span>
                    </div>
                    <div id="senhaMatch" class="text-danger" style="margin-top:5px;"></div>
                </div>
                <div class="form-group">
                    <label for="txtendereco">Endereço</label>
                    <input type="text" class="form-control" name="txtendereco" value="<?php echo htmlspecialchars($exibe['desc_endereco']); ?>" required id="txtendereco">
                </div>
                <div class="form-group">
                    <label for="txtcidade">Cidade</label>
                    <input type="text" class="form-control" name="txtcidade" value="<?php echo htmlspecialchars($exibe['desc_cidade']); ?>" required id="txtcidade">
                </div>
                <div class="form-group">
                    <label for="txtcep">CEP</label>
                    <input type="text" class="form-control" name="txtcep" value="<?php echo htmlspecialchars($exibe['num_cep']); ?>" required id="txtcep">
                </div>
                <button type="submit" class="btn btn-lg btn-primary">
                    <span class="glyphicon glyphicon-pencil"></span> Alterar
                </button>
            </form>
        </div>
    </div>
    <br>
</div>

<?php include 'rodape.html'; ?>

<script>
function togglePassword(id, iconSpan) {
    const input = document.getElementById(id);
    const icon = iconSpan.querySelector('i');
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("glyphicon-eye-open");
        icon.classList.add("glyphicon-eye-close");
    } else {
        input.type = "password";
        icon.classList.remove("glyphicon-eye-close");
        icon.classList.add("glyphicon-eye-open");
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const senhaInput = document.getElementById('txtsenha');
    const confirmaInput = document.getElementById('confirmaSenha');
    const senhaMatch = document.getElementById('senhaMatch');
    const form = document.forms['alteraUsu'];

    function verificarSenhas() {
        if (senhaInput.value !== confirmaInput.value) {
            senhaMatch.textContent = "As senhas não coincidem.";
            return false;
        } else {
            senhaMatch.textContent = "";
            return true;
        }
    }

    confirmaInput.addEventListener('input', verificarSenhas);
    senhaInput.addEventListener('input', verificarSenhas);

    form.addEventListener('submit', function (e) {
        if (senhaInput.value || confirmaInput.value) {
            if (!verificarSenhas()) {
                e.preventDefault();
                senhaMatch.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
});
</script>
</body>
</html>
