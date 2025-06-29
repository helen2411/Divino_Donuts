<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: home.php');
    exit;
}

$erro_login = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_enviado = $_POST['email'] ?? '';
    $senha_enviada = $_POST['password'] ?? '';

    if (empty($email_enviado) || empty($senha_enviada)) {
        $erro_login = 'Por favor, preencha todos os campos.';
    } else {
        // --- MUDANÇA PRINCIPAL: LER USUÁRIOS DO ARQUIVO JSON ---
        $caminho_json = 'usuarios.json';
        $usuarios_cadastrados = [];
        if (file_exists($caminho_json)) {
            $usuarios_cadastrados = json_decode(file_get_contents($caminho_json), true);
        }
        
        $usuario_encontrado = null;
        foreach ($usuarios_cadastrados as $usuario) {
            if ($usuario['email'] === $email_enviado) {
                $usuario_encontrado = $usuario;
                break;
            }
        }

        // A verificação da senha continua a mesma
        if ($usuario_encontrado && password_verify($senha_enviada, $usuario_encontrado['senha_hash'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email_enviado;
            $_SESSION['nome'] = $usuario_encontrado['nome']; // Podemos até guardar o nome na sessão
            
            header('Location: home.php');
            exit;
        } else {
            $erro_login = 'Email ou senha inválidos.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divino Donuts - Login</title>
    <link rel="stylesheet" href="../styles/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Jua&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-page-wrapper">
        <a href="acessibilidade.php" class="accessibility-icon" aria-label="Acessibilidade">
            <i class="fas fa-wheelchair"></i>
        </a>
        <div class="login-card-container">
            <div class="login-card">
                <img src="../img/logo/1.png" alt="Divino Donuts Logo" class="login-logo">
                <form class="login-form" action="login.php" method="POST">
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="email" required>
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="senha" required>
                    </div>
                    <?php if (!empty($erro_login)): ?>
                        <p class="error-message" style="color: red; text-align: center; margin-bottom: 10px;"><?php echo htmlspecialchars($erro_login); ?></p>
                    <?php endif; ?>
                    <button type="submit" class="login-button" id="loginButton">Login</button>
                </form>
                <div class="social-login">
                    <a href="#" class="social-icon google" aria-label="Login com Google"><i class="fab fa-google"></i></a>
                    <a href="#" class="social-icon facebook" aria-label="Login com Facebook"><i class="fab fa-facebook-f"></i></a>
                </div>
                <p class="register-text">
                    Não possui conta? <a href="cadastro.php" class="register-link">Cadastre-se</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>