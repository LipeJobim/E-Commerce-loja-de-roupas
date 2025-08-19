<!-- recuperar_senha.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Recuperação de Senha</h2>
        <form method="POST" action="enviar_email_recuperacao.php">
            <div class="form-group">
                <label>Digite seu e-mail:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar link</button>
        </form>
    </div>
</body>
</html>
