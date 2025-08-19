<?php
include 'conexao.php';
session_start();

$Vemail = $_POST['txtemail'];
$Vsenha = $_POST['txtsenha'];

try {
    // Usando prepared statement para evitar SQL injection
    $sql = "SELECT id_usuario, nm_usuario, desc_email, desc_senha, desc_status 
            FROM tbl_usuario 
            WHERE desc_email = :email";
    $stmt = $cn->prepare($sql);
    $stmt->bindParam(':email', $Vemail);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica a senha criptografada
        if (password_verify($Vsenha, $usuario['desc_senha'])) {
            // Login bem-sucedido
            $_SESSION['ID'] = $usuario['id_usuario'];
            $_SESSION['Status'] = $usuario['desc_status']; // 0 = comum, 1 = admin (por exemplo)

            header('Location: index.php');
            exit;
        } else {
            // Senha incorreta
            header('Location: erro.php');
            exit;
        }
    } else {
        // E-mail não encontrado
        header('Location: erro.php');
        exit;
    }

} catch (PDOException $e) {
    echo "Erro ao validar o usuário: " . $e->getMessage(); // Evite mostrar isso em produção
}
?>
