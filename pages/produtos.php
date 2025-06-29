<?php
session_start();

// --- Lógica de Login (para o menu dinâmico) ---
$usuario_logado = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$nome_usuario = $usuario_logado ? htmlspecialchars($_SESSION['nome']) : '';

// --- Lógica de Carregamento e Filtragem de Produtos ---
$todos_produtos = json_decode(file_get_contents('produtos.json'), true);
$produtos_para_exibir = $todos_produtos;

// Filtrar por Categoria
$categoria_ativa = $_GET['categoria'] ?? 'todos'; 
if ($categoria_ativa !== 'todos') {
    $produtos_para_exibir = array_filter($produtos_para_exibir, function($produto) use ($categoria_ativa) {
        return $produto['categoria'] === $categoria_ativa;
    });
}

// Filtrar por Busca
$termo_busca = $_GET['busca'] ?? '';
if (!empty($termo_busca)) {
    $produtos_para_exibir = array_filter($produtos_para_exibir, function($produto) use ($termo_busca) {
        return stristr($produto['nome'], $termo_busca);
    });
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divino Donuts - Produtos</title>
    <link rel="stylesheet" href="../styles/produtos.css">
    <link href="https://fonts.googleapis.com/css2?family=Jua&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="products-page-wrapper">
        <a href="acessibilidade.php" class="accessibility-icon" aria-label="Acessibilidade">
            <i class="fas fa-wheelchair"></i>
        </a>

        <header class="products-header">
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
            <div class="search-bar-container">
                <form action="produtos.php" method="GET" class="search-form">
                    <input type="text" name="busca" placeholder="Buscar donuts..." value="<?php echo htmlspecialchars($termo_busca); ?>">
                    <button type="submit" class="search-button" aria-label="Buscar">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <a href="carrinho.php" class="cart-icon" aria-label="Ir para o Carrinho">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </header>

        <main class="products-main-content">
            <h1 class="page-title">Produtos</h1>

            <section class="category-filters">
                <a href="produtos.php" class="filter-button <?php if($categoria_ativa == 'todos') echo 'active'; ?>">Todos</a>
                <a href="produtos.php?categoria=doces" class="filter-button yellow-border <?php if($categoria_ativa == 'doces') echo 'active'; ?>">Donuts Doces</a>
                <a href="produtos.php?categoria=salgados" class="filter-button blue-border <?php if($categoria_ativa == 'salgados') echo 'active'; ?>">Donuts Salgados</a>
                <a href="produtos.php?categoria=bebidas" class="filter-button pink-border <?php if($categoria_ativa == 'bebidas') echo 'active'; ?>">Bebidas</a>
            </section>

            <section class="product-grid">
                <?php if (empty($produtos_para_exibir)): ?>
                    <p>Nenhum produto encontrado com os critérios selecionados.</p>
                <?php else: ?>
                    <?php foreach ($produtos_para_exibir as $produto): ?>
                        <div class="product-card">
                            <a href="produto_detalhes.php?id=<?php echo $produto['id']; ?>" class="product-link">
                                <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" class="product-image">
                                <h3 class="product-name"><?php echo htmlspecialchars($produto['nome']); ?></h3>
                                <p class="product-price">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                            </a>
                            <form action="carrinho_acoes.php" method="POST">
                                <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                                <input type="hidden" name="acao" value="adicionar">
                                <button type="submit" class="add-to-cart-button">Adicionar ao Carrinho</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
        </main>
    </div>

    <script src="../scripts/produtos.js"></script>
</body>
</html>