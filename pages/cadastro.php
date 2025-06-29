<?php
// Variáveis para mensagens e para repopular o formulário
$mensagem_erro = '';
$mensagem_sucesso = '';
$nome = $telefone = $endereco = $cep = $email = '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta e limpa os dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $telefone = htmlspecialchars($_POST['telefone']);
    $endereco = htmlspecialchars($_POST['endereco']);
    $cep = htmlspecialchars($_POST['cep']);
    $email = htmlspecialchars($_POST['email']);
    $senha = $_POST['password']; // Não aplicamos htmlspecialchars na senha antes de criptografar

    // --- Validação no Servidor ---
    if (empty($nome) || empty($telefone) || empty($endereco) || empty($cep) || empty($email) || empty($senha)) {
        $mensagem_erro = 'Por favor, preencha todos os campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem_erro = 'O formato do e-mail é inválido.';
    } else {
        $caminho_json = 'usuarios.json';
        
        // Lê os usuários existentes do arquivo JSON
        $usuarios_cadastrados = json_decode(file_get_contents($caminho_json), true);
        
        // Verifica se o e-mail já está em uso
        $email_existe = false;
        foreach ($usuarios_cadastrados as $usuario) {
            if ($usuario['email'] === $email) {
                $email_existe = true;
                break;
            }
        }

        if ($email_existe) {
            $mensagem_erro = 'Este e-mail já foi cadastrado. Tente outro.';
        } else {
            // Se tudo estiver certo, cria o novo usuário
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            
            $novo_usuario = [
                'id' => uniqid(), // Gera um ID único
                'nome' => $nome,
                'telefone' => $telefone,
                'endereco' => $endereco,
                'cep' => $cep,
                'email' => $email,
                'senha_hash' => $senha_hash
            ];
            
            // Adiciona o novo usuário à lista
            $usuarios_cadastrados[] = $novo_usuario;
            
            // Salva a lista atualizada de volta no arquivo JSON
            file_put_contents($caminho_json, json_encode($usuarios_cadastrados, JSON_PRETTY_PRINT));
            
            $mensagem_sucesso = 'Cadastro realizado com sucesso! Você já pode fazer o login.';
            
            // Limpa os campos após o sucesso
            $nome = $telefone = $endereco = $cep = $email = '';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divino Donuts - Cadastro</title>
    <link rel="stylesheet" href="../styles/cadastro.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Jua&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos simples para as mensagens */
        .mensagem-sucesso { color: green; text-align: center; padding: 10px; font-weight: bold; }
        .mensagem-erro { color: red; text-align: center; padding: 10px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="register-page-wrapper">
        <a href="acessibilidade.php" class="accessibility-icon" aria-label="Acessibilidade">
            <i class="fas fa-wheelchair"></i>
        </a>

        <div class="register-card-container">
            <div class="register-card">
                <form class="register-form" action="cadastro.php" method="POST">
                    
                    <?php if (!empty($mensagem_sucesso)): ?>
                        <p class="mensagem-sucesso"><?php echo $mensagem_sucesso; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($mensagem_erro)): ?>
                        <p class="mensagem-erro"><?php echo $mensagem_erro; ?></p>
                    <?php endif; ?>

                    <div class="input-group">
                        <input type="text" id="name" name="nome" placeholder="nome" value="<?php echo $nome; ?>" required>
                    </div>
                    <div class="input-group">
                        <input type="tel" id="phone" name="telefone" placeholder="telefone" value="<?php echo $telefone; ?>" required>
                    </div>
                    <div class="input-group">
                        <input type="text" id="address" name="endereco" placeholder="endereço" value="<?php echo $endereco; ?>" required>
                    </div>
                    <div class="input-group">
                        <input type="text" id="zipcode" name="cep" placeholder="cep" value="<?php echo $cep; ?>" required>
                    </div>
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="senha" required>
                    </div>
                    <button type="submit" class="cad-button" id="cadButton">Cadastrar</button>
                </form>

                <img src="../img/logo/1.png" alt="Divino Donuts Logo" class="register-logo">
            </div>
             <p class="login-text" style="text-align:center; margin-top: 20px;">
                Já possui conta? <a href="login.php" class="login-link" style="color: white; font-weight: bold;">Faça o login</a>
            </p>
        </div>
    </div>
    
    </body>
</html>