<?php
session_start();

// 1. VERIFICAÇÕES DE SEGURANÇA
// Garante que o acesso seja via POST e que o carrinho não esteja vazio.
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['carrinho'])) {
    // Se não, redireciona para a home.
    header('Location: home.php');
    exit;
}

// 2. RECALCULA O TOTAL NO SERVIDOR (medida de segurança)
$produtos_catalogo = json_decode(file_get_contents('produtos.json'), true);
$produtos_por_id = array_column($produtos_catalogo, null, 'id');
$carrinho_sessao = $_SESSION['carrinho'];

$subtotal = 0;
$itens_do_pedido = [];

foreach ($carrinho_sessao as $produto_id => $item) {
    if (isset($produtos_por_id[$produto_id])) {
        $produto_info = $produtos_por_id[$produto_id];
        $subtotal += $produto_info['preco'] * $item['quantidade'];
        // Guarda os itens para salvar no pedido
        $itens_do_pedido[] = [
            'id' => $produto_id,
            'nome' => $produto_info['nome'],
            'quantidade' => $item['quantidade'],
            'preco_unitario' => $produto_info['preco']
        ];
    }
}
$total_final = $subtotal + 5.00; // Adiciona a mesma taxa de entrega

// 3. MONTA O OBJETO DO PEDIDO
$novo_pedido = [
    'id_pedido' => 'PEDIDO_' . uniqid(), // Gera um ID de pedido único
    'id_usuario' => $_SESSION['email'] ?? 'visitante', // Pega o email do usuário logado ou marca como visitante
    'data_pedido' => date('Y-m-d H:i:s'),
    'itens' => $itens_do_pedido,
    'total_pago' => $total_final,
    'metodo_pagamento' => $_POST['payment_method'] ?? 'Não especificado'
];

// 4. SALVA O PEDIDO NO "BANCO DE DADOS" JSON
$pedidos_anteriores = json_decode(file_get_contents('pedidos.json'), true);
$pedidos_anteriores[] = $novo_pedido;
file_put_contents('pedidos.json', json_encode($pedidos_anteriores, JSON_PRETTY_PRINT));

// 5. LIMPA O CARRINHO
$_SESSION['carrinho'] = [];

// 6. REDIRECIONA PARA A PÁGINA DE CONFIRMAÇÃO
header('Location: confirmacao_pedido.php?id=' . $novo_pedido['id_pedido']);
exit;
?>