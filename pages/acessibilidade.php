<?php
session_start();

// Lógica de Login para o menu dinâmico
$usuario_logado = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$nome_usuario = $usuario_logado ? htmlspecialchars($_SESSION['nome']) : '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divino Donuts - Acessibilidade</title>
    
    <link rel="stylesheet" href="../styles/acessibilidade.css"> 
    
    <link href="https://fonts.googleapis.com/css2?family=Jua&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="accessibility-page-wrapper">
        <a href="acessibilidade.php" class="accessibility-icon" aria-label="Acessibilidade">
            <i class="fas fa-wheelchair"></i>
        </a>

        <header class="accessibility-header">
            <button class="menu-toggle" aria-label="Abrir Menu">
                <i class="fas fa-bars"></i>
            </button>
            <nav class="main-nav" id="mainNavigation">
                <ul>
                    <li><a href="home.php">Sobre Nós</a></li>
                    <li><a href="produtos.php">Produtos</a></li>
                    <li><a href="carrinho.php">Carrinho</a></li>
                    <?php if ($usuario_logado): ?>
                        <li><a href="minha_conta.php">Minha Conta</a></li>
                        <li><a href="logout.php">Sair</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="cadastro.php">Cadastro</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <h1 class="page-title-header">Acessibilidade</h1>
        </header>

        <main class="accessibility-main-content">
            <section class="accessibility-section" id="libras-section">
                <h2 class="section-title">Libras</h2>
                <div class="options-grid">
                    <button class="option-button libras-button" data-feature="libras">
                        <img src="../img/icons/libras.png" alt="Libras Icon" class="option-icon">
                    </button>
                </div>
            </section>

            <section class="accessibility-section" id="font-control-section">
                <h2 class="section-title">Controle de Fontes</h2>
                <div class="options-grid">
                    <button class="option-button" data-feature="tamanho-fonte"><i class="fas fa-font option-icon"></i><span>Tamanho</span></button>
                    <button class="option-button" data-feature="espacamento-letras"><i class="fas fa-expand-alt option-icon"></i><span>Espaçamento<br>-Letras</span></button>
                    </div>
            </section>
            </main>
    </div>

    <script src="../scripts/acessibilidade.js"></script>
</body>
</html>