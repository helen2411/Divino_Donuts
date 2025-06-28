<?php
session_start();

// --- LÓGICA DE LOGIN ---
$usuario_logado = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$nome_usuario = $usuario_logado ? htmlspecialchars($_SESSION['nome']) : '';

// --- LÓGICA DO CARRINHO ---
// 1. Carregar o catálogo de produtos para consulta
$produtos_catalogo = json_decode(file_get_contents('produtos.json'), true);
// Criar um array indexado pelo ID para facilitar a busca
$produtos_por_id = array_column($produtos_catalogo, null, 'id');

// 2. Obter o carrinho da sessão
$carrinho_sessao = $_SESSION['carrinho'] ?? [];
$itens_carrinho = [];
$subtotal = 0;
$custo_entrega = 5.00; // Valor fixo de entrega

// 3. Cruzar dados da sessão com o catálogo para obter detalhes completos
if (!empty($carrinho_sessao)) {
    foreach ($carrinho_sessao as $produto_id => $item) {
        // Verifica se o produto do carrinho ainda existe no catálogo
        if (isset($produtos_por_id[$produto_id])) {
            $produto_info = $produtos_por_id[$produto_id];
            $produto_info['quantidade'] = $item['quantidade'];
            $itens_carrinho[] = $produto_info;
            
            // 4. Calcular o subtotal
            $subtotal += $produto_info['preco'] * $produto_info['quantidade'];
        }
    }
}

// 5. Calcular o total
$total = $subtotal + $custo_entrega;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divino Donuts - Carrinho</title>
    <link rel="stylesheet" href="../styles/carrinho.css">
    <link href="https://fonts.googleapis.com/css2?family=Jua&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="cart-page-wrapper">
        <a href="acessibilidade.php" class="accessibility-icon" aria-label="Acessibilidade"><i class="fas fa-wheelchair"></i></a>

        <header class="cart-header">
            <h1 class="page-title-header">Carrinho</h1>
            <button class="menu-toggle" aria-label="Abrir Menu"><i class="fas fa-bars"></i></button>
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
            <a href="produtos.php" class="cart-icon-header" aria-label="Voltar aos Produtos">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </header>

        <main class="cart-main-content">
            <div class="cart-container">

                <?php if (empty($itens_carrinho)): ?>
                    <p class="cart-empty-message">Seu carrinho está vazio.</p>
                <?php else: ?>
                    <?php foreach($itens_carrinho as $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo htmlspecialchars($item['imagem']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>" class="item-image">
                        <div class="item-details">
                            <h3 class="item-name"><?php echo htmlspecialchars($item['nome']); ?></h3>
                            <p class="item-price">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
                        </div>
                        <div class="quantity-control">
                            <form action="carrinho_acoes.php" method="POST" class="quantity-form">
                                <input type="hidden" name="produto_id" value="<?php echo $item['id']; ?>">
                                <input type="hidden" name="acao" value="diminuir">
                                <button type="submit" class="quantity-btn minus-btn" aria-label="Diminuir quantidade">-</button>
                            </form>
                            <span class="quantity-value"><?php echo $item['quantidade']; ?></span>
                            <form action="carrinho_acoes.php" method="POST" class="quantity-form">
                                <input type="hidden" name="produto_id" value="<?php echo $item['id']; ?>">
                                <input type="hidden" name="acao" value="aumentar">
                                <button type="submit" class="quantity-btn plus-btn" aria-label="Aumentar quantidade">+</button>
                            </form>
                        </div>
                         <div class="item-total-price">
                            R$ <?php echo number_format($item['preco'] * $item['quantidade'], 2, ',', '.'); ?>
                        </div>
                        <form action="carrinho_acoes.php" method="POST" class="remove-form">
                           <input type="hidden" name="produto_id" value="<?php echo $item['id']; ?>">
                           <input type="hidden" name="acao" value="remover">
                           <button type="submit" class="remove-btn" aria-label="Remover item"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                    <?php endforeach; ?>
                    
                    <div class="summary-line-separator"></div>

                    <div class="order-summary">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="subtotal-value">R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Entrega</span>
                            <span id="delivery-value">R$ <?php echo number_format($custo_entrega, 2, ',', '.'); ?></span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="total-value">R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
                        </div>
                    </div>

                    <div class="checkout-actions">
                        <a href="produtos.php" class="btn-continue-shopping">Continuar Comprando</a>
                        <form action="finalizar_pedido.php" method="POST">
                            <button type="submit" class="checkout-button">Finalizar Pedido</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script src="../scripts/carrinho.js"></script>
</body>
</html>