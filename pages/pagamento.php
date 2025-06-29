<?php
session_start();

// Proteção: se o carrinho estiver vazio, não faz sentido estar aqui.
if (empty($_SESSION['carrinho'])) {
    header('Location: produtos.php');
    exit;
}

// Lógica para buscar dados do carrinho e calcular totais (similar ao carrinho.php)
$produtos_catalogo = json_decode(file_get_contents('produtos.json'), true);
$produtos_por_id = array_column($produtos_catalogo, null, 'id');
$carrinho_sessao = $_SESSION['carrinho'];
$itens_carrinho = [];
$subtotal = 0;
$custo_entrega = 5.00;

foreach ($carrinho_sessao as $produto_id => $item) {
    if (isset($produtos_por_id[$produto_id])) {
        $produto_info = $produtos_por_id[$produto_id];
        $produto_info['quantidade'] = $item['quantidade'];
        $itens_carrinho[] = $produto_info;
        $subtotal += $produto_info['preco'] * $item['quantidade'];
    }
}
$total = $subtotal + $custo_entrega;

// Lógica de login para o menu
$usuario_logado = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divino Donuts - Pagamento</title>
    <link rel="stylesheet" href="../styles/pagamento.css">
    <link rel="stylesheet" href="../styles/confirmacao.css">
    <link href="https://fonts.googleapis.com/css2?family=Jua&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="payment-page-wrapper">
         <a href="acessibilidade.php" class="accessibility-icon" aria-label="Acessibilidade"><i class="fas fa-wheelchair"></i></a>
         <header class="payment-header">
             <button class="menu-toggle" aria-label="Abrir Menu"><i class="fas fa-bars"></i></button>
             <nav class="main-nav" id="mainNavigation">
                <ul>
                    </ul>
             </nav>
             <h1 class="page-title-header">Finalizar Pedido</h1>
         </header>

         <main class="payment-main-content">
            <div class="checkout-container">
                <section class="order-summary-box">
                    <h2 class="section-title">Resumo do Pedido</h2>
                    <?php foreach ($itens_carrinho as $item): ?>
                        <div class="summary-item">
                            <span class="summary-item-name"><?php echo htmlspecialchars($item['nome']); ?> (x<?php echo $item['quantidade']; ?>)</span>
                            <span class="summary-item-price">R$ <?php echo number_format($item['preco'] * $item['quantidade'], 2, ',', '.'); ?></span>
                        </div>
                    <?php endforeach; ?>
                    <hr class="summary-divider">
                    <div class="summary-total">
                        <span>Total a Pagar</span>
                        <strong>R$ <?php echo number_format($total, 2, ',', '.'); ?></strong>
                    </div>
                </section>
                
                <section class="payment-methods-box">
                <h2 class="section-title">Formas de Pagamento</h2>
                <form action="finalizar_pedido.php" method="POST" class="payment-options-form">
                    
                    <label class="payment-option-card">
                        <input type="radio" name="payment_method" value="pix" checked>
                        <span class="custom-radio"></span> <div class="method-details">
                            <img src="../img/icons/pix.png" alt="Pix" class="method-icon">
                            <span class="method-name">Pix</span>
                        </div>
                    </label>

                    <label class="payment-option-card">
                        <input type="radio" name="payment_method" value="mastercard">
                        <span class="custom-radio"></span> <div class="method-details">
                            <img src="../img/icons/mastercad.png" alt="Mastercard" class="method-icon">
                            <span class="method-name">Mastercard</span>
                        </div>
                    </label>

                    <label class="payment-option-card">
                        <input type="radio" name="payment_method" value="visa">
                        <span class="custom-radio"></span> <div class="method-details">
                            <img src="../img/icons/visa.png" alt="Visa" class="method-icon">
                            <span class="method-name">Visa</span>
                        </div>
                    </label>
                    
                    <button type="submit" class="finalize-button">Confirmar e Pagar</button>
                </form>
            </section>
            </div>
         </main>
    </div>
    <script src="../scripts/pagamento.js"></script>
</body>
</html>