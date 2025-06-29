<?php
// Inicia a sessão para podermos acessar as variáveis de sessão
session_start();

// Verificamos se o usuário está logado e definimos uma variável para facilitar
$usuario_logado = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

// Se o usuário estiver logado, pegamos o nome dele para a mensagem de boas-vindas
$nome_usuario = '';
if ($usuario_logado) {
    // Usamos htmlspecialchars para prevenir ataques XSS
    $nome_usuario = htmlspecialchars($_SESSION['nome']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divino Donuts - Home</title>
    
    <link rel="stylesheet" href="../styles/home.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Jua&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        .nav-item.welcome-message {
            color: #F1EF30; /* Amarelo, para combinar com a identidade visual */
            font-weight: bold;
            cursor: default;
        }
    </style>
</head>
<body>

    <div class="home-page-wrapper">
        <a href="acessibilidade.php" class="accessibility-icon" aria-label="Acessibilidade">
            <i class="fas fa-wheelchair"></i>
        </a>

        <header class="main-header">
            <a href="home.php" class="header-logo-link">
                <img src="../img/D NUTS/1.png" alt="Divino Donuts Logo" class="header-logo">
            </a>
            
            <nav class="main-nav">
                <a href="home.php" class="nav-item">Sobre Nós</a>
                <a href="produtos.php" class="nav-item">Produtos</a>
                
                <?php if ($usuario_logado): ?>
                    <span class="nav-item welcome-message">Olá, <?php echo $nome_usuario; ?>!</span>
                    <a href="minha_conta.php" class="nav-item">Minha Conta</a>
                    <a href="logout.php" class="nav-item">Sair</a>
                <?php else: ?>
                    <a href="login.php" class="nav-item">Login</a> 
                    <a href="cadastro.php" class="nav-item">Cadastro</a>
                <?php endif; ?>

            </nav>
            </header>

        <main class="home-content">
            <div class="main-content-box top-box">
                </div>

            <div class="small-indicators-group">
                <div class="small-indicator pink"></div>
                <div class="small-indicator gray"></div>
                <div class="small-indicator gray"></div>
            </div>

            <div class="main-content-box bottom-box">
                </div>

            <section class="product-categories">
                <div class="category-card yellow-border">
                    <div class="category-content">
                        <p class="category-title">Donuts Doces</p>
                    </div>
                </div>
                <div class="category-card blue-border">
                    <div class="category-content">
                        <p class="category-title">Donuts Salgados</p>
                    </div>
                </div>
                <div class="category-card pink-border">
                    <div class="category-content">
                        <p class="category-title">Bebidas</p>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="../scripts/home.js"></script>
</body>
</html>