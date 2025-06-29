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

    <link rel="stylesheet" href="../styles/footer.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
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
                <img src="../img/logo/1.png" alt="Divino Donuts Logo" class="header-logo">
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

        <div id="meuCarrossel" class="carousel slide" data-bs-ride="carousel">
    
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#meuCarrossel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#meuCarrossel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#meuCarrossel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#meuCarrossel" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>

<div class="carousel-inner">

    <div class="carousel-item active">
        <img src="../img/carrossel/bemvindo.png" class="d-block w-100" alt="Banner promocional 1">
        <!-- <div class="carousel-caption d-none d-md-block">
            <h5>A Doçura Que Te Conquista!</h5>
            <p>Donuts artesanais feitos com os melhores ingredientes e uma dose extra de amor.</p>
        </div> -->
    </div>

    <div class="carousel-item">
        <img src="../img/carrossel/promocao.png" class="d-block w-100" alt="Banner promocional 2">
        <!-- <div class="carousel-caption d-none d-md-block">
            <h5>Leve 3, Pague 2!</h5>
            <p>A promoção perfeita para compartilhar (ou não!). Válido todas as quartas-feiras.</p>
        </div> -->
    </div>

    <div class="carousel-item">
        <img src="../img/carrossel/Bebidas.png" class="d-block w-100" alt="Banner promocional 3">
        <!-- <div class="carousel-caption d-none d-md-block">
            <h5>Receba em Casa com Frete Grátis!</h5>
            <p>Para pedidos acima de R$ 50,00 na sua região.</p>
        </div> -->
    </div>

</div>
                <button class="carousel-control-prev" type="button" data-bs-target="#meuCarrossel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#meuCarrossel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>

            <div class="main-content-box bottom-box">
                <div class="about-us-content">
                    <h2>Sobre Nós</h2>
                    <p>
                        Bem-vindo à Divino Donuts! Nascemos da paixão por donuts artesanais,
                        feitos com os melhores ingredientes e uma dose extra de amor.
                        Nossa missão é trazer um momento de alegria e doçura para o seu dia.
                        <br><br>
                        <strong></strong>
                    </p>
                </div>
            </div>

            <section class="product-categories">

                <a href="produtos.php?categoria=doces" class="category-card yellow-border">
                    <div class="category-content">
                        <p class="category-title">Donuts Doces</p>
                    </div>
                </a>

                <a href="produtos.php?categoria=salgados" class="category-card blue-border">
                    <div class="category-content">
                        <p class="category-title">Donuts Salgados</p>
                    </div>
                </a>

                <a href="produtos.php?categoria=bebidas" class="category-card pink-border">
                    <div class="category-content">
                        <p class="category-title">Bebidas</p>
                    </div>
                </a>

            </section>
        </main>
    </div>

    <script src="../scripts/home.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php include 'footer.php'; ?>

</body>
</html>