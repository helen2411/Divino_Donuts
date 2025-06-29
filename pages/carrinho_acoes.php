<?php
session_start();

// Garante que o carrinho exista na sessão
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_POST['acao']) && isset($_POST['produto_id'])) {
    $acao = $_POST['acao'];
    $produto_id = $_POST['produto_id'];

    // Garante que o produto exista no carrinho antes de tentar manipulá-lo
    $produto_existe_no_carrinho = isset($_SESSION['carrinho'][$produto_id]);

    switch ($acao) {
        case 'adicionar':
            if ($produto_existe_no_carrinho) {
                $_SESSION['carrinho'][$produto_id]['quantidade']++;
            } else {
                $_SESSION['carrinho'][$produto_id] = ['quantidade' => 1];
            }
            break;

        case 'aumentar':
            if ($produto_existe_no_carrinho) {
                $_SESSION['carrinho'][$produto_id]['quantidade']++;
            }
            break;
            
        case 'diminuir':
            if ($produto_existe_no_carrinho) {
                if ($_SESSION['carrinho'][$produto_id]['quantidade'] > 1) {
                    $_SESSION['carrinho'][$produto_id]['quantidade']--;
                } else {
                    // Se a quantidade for 1, diminuir significa remover
                    unset($_SESSION['carrinho'][$produto_id]);
                }
            }
            break;

        case 'remover':
            if ($produto_existe_no_carrinho) {
                unset($_SESSION['carrinho'][$produto_id]);
            }
            break;
    }
}

// Redireciona de volta para o carrinho para ver as mudanças
header('Location: carrinho.php');
exit;
?>