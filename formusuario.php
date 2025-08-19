<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <title>Bella Boutique - Cadastro</title>
    <meta name="Author" content="Felipe Jobim">
    <link rel="icon" type="image/png" href="Logos/belalogo.jpg">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="esti.css">
    <!-- CSS Personalizado -->
    <style>
        .form-group { position: relative; }
        .password-toggle { 
            position: absolute; 
            right: 10px; 
            top: 35px; 
            cursor: pointer; 
            color: #777;
        }
        .error { color: #d9534f; font-size: 0.9em; }
        .success { color: #5cb85c; }
    </style>
</head>
<body>
    <?php
    include 'conexao.php';	
    include 'nav.php';
    include 'cabecalho.html';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <h2 class="text-center">Cadastro de novo Cliente</h2>
                <br>
                <form method="post" action="inserirusuario.php" name="logon" id="formCadastro">
                    <!-- Nome e Sobrenome -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nome">Nome*</label>
                                <input name="txtnome" type="text" class="form-control" required id="nome">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="sobrenome">Sobrenome*</label>
                                <input name="txtsobrenome" type="text" class="form-control" required id="sobrenome">
                            </div>
                        </div>
                    </div>

                    <!-- Celular -->
                    <div class="form-group">
                        <label for="celular">Celular com DD*</label>
                        <input name="txtcelular" type="tel" class="form-control" required id="celular" placeholder="(00) 00000-0000">
                    </div>

                    <!-- E-mail -->
                    <div class="form-group">
                        <label for="email">E-mail*</label>
                        <input name="txtemail" type="email" class="form-control" required id="email">
                    </div>

                    <!-- Senha com visualização -->
                    <div class="form-group">
                        <label for="senha">Senha* (mínimo 6 caracteres)</label>
                        <input name="txtsenha" type="password" class="form-control" required id="senha" minlength="6">
                        <i class="password-toggle fas fa-eye" onclick="togglePassword('senha')"></i>
                    </div>

                    <!-- Confirmação de Senha -->
                    <div class="form-group">
                        <label for="confirmaSenha">Confirme sua Senha*</label>
                        <input name="txtconfirmaSenha" type="password" class="form-control" required id="confirmaSenha">
                        <i class="password-toggle fas fa-eye" onclick="togglePassword('confirmaSenha')"></i>
                        <div id="senhaMatch" class="error"></div>
                    </div>

                    <!-- Endereço -->
                    <div class="form-group">
                        <label for="endereco">Endereço*</label>
                        <input name="txtendereco" type="text" class="form-control" required id="endereco">
                    </div>

                    <!-- Cidade e CEP -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="cidade">Cidade*</label>
                                <input name="txtcidade" type="text" class="form-control" required id="cidade">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="cep">CEP*</label>
                                <input name="txtcep" type="text" class="form-control" required id="cep" placeholder="00 000-000">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" id="btnCadastrar">
                        <i class="fas fa-user-plus"></i> Cadastrar
                    </button>
                </form>
                <br>
                <p class="text-center">Já tem conta? <a href="login.php">Faça login</a></p>
            </div>
        </div>
    </div>

    <?php include 'rodape.html' ?>

    <!-- Scripts -->
    <script src="jquery.mask.js"></script>
    <script>
        $(document).ready(function(){
            // Máscaras
            $("#cep").mask("00 000-000");
            $("#celular").mask("(00) 00000-0000");

            // Validar confirmação de senha em tempo real
            $("#confirmaSenha, #senha").on('keyup', function(){
                var senha = $("#senha").val();
                var confirmaSenha = $("#confirmaSenha").val();
                
                if(confirmaSenha.length > 0) {
                    if(senha !== confirmaSenha) {
                        $("#senhaMatch").html('<i class="fas fa-times-circle"></i> As senhas não coincidem');
                        $("#btnCadastrar").prop('disabled', true);
                    } else {
                        $("#senhaMatch").html('<span class="success"><i class="fas fa-check-circle"></i> Senhas coincidem</span>');
                        $("#btnCadastrar").prop('disabled', false);
                    }
                }
            });

            // Validar formulário antes de enviar
            $("#formCadastro").submit(function(e) {
                var senha = $("#senha").val();
                var confirmaSenha = $("#confirmaSenha").val();
                
                if(senha !== confirmaSenha) {
                    e.preventDefault();
                    $("#senhaMatch").html('<i class="fas fa-times-circle"></i> As senhas não coincidem').addClass('error');
                    $("#senha").focus();
                }
            });
        });

        // Mostrar/esconder senha
        function togglePassword(id) {
            var input = document.getElementById(id);
            var icon = input.nextElementSibling;
            
            if(input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>