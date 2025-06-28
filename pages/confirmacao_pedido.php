<?php
session_start();

$id_pedido_url = $_GET['id'] ?? null;
$pedido_encontrado = null;

if ($id_pedido_url) {
    $todos_pedidos = json_decode(file_get_contents('pedidos.json'), true);
    foreach ($todos_pedidos as $pedido) {
        if ($pedido['id_pedido'] === $id_pedido_url) {
            $pedido_encontrado = $pedido;
            break;
        }
    }
}

// Se não encontrou o pedido, redireciona para a home para evitar erros.
if (!$pedido_encontrado) {
    header('Location: home.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Confirmado!</title>
    <link rel="stylesheet" href="../styles/confirmacao.css"> <link href="https://fonts.googleapis.com/css2?family=Jua&family=Inter:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="confirmation-wrapper">
        <div class="confirmation-box">
            <h1>Obrigado pelo seu pedido!</h1>
            <p>Seu pedido foi confirmado com sucesso.</p>
            
            <div class="order-details">
                <h2>Detalhes do Pedido</h2>
                <p><strong>Número do Pedido:</strong> <?php echo htmlspecialchars($pedido_encontrado['id_pedido']); ?></p>
                <p><strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($pedido_encontrado['data_pedido'])); ?></p>
                <p><strong>Total Pago:</strong> R$ <?php echo number_format($pedido_encontrado['total_pago'], 2, ',', '.'); ?></p>
                <p><strong>Forma de Pagamento:</strong> <?php echo ucfirst(htmlspecialchars($pedido_encontrado['metodo_pagamento'])); ?></p>
                
                <h3>Itens Comprados:</h3>
                <ul>
                    <?php foreach ($pedido_encontrado['itens'] as $item): ?>
                        <li><?php echo htmlspecialchars($item['nome']); ?> (x<?php echo $item['quantidade']; ?>)</li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <a href="produtos.php" class="back-to-products">Voltar aos Produtos</a>
        </div>
    </div>
</body>
</html>