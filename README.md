🍩 Divino Donuts - E-commerce

Bem-vindo ao repositório oficial do Divino Donuts, um projeto de e-commerce completo construído com PHP. Este sistema foi convertido de uma aplicação estática (HTML, CSS, JS) para uma aplicação web dinâmica e robusta, capaz de gerenciar usuários, produtos, pedidos e um carrinho de compras funcional.

✨ Funcionalidades Principais

Sistema de Autenticação de Usuários: Cadastro, login e logout seguros com sessões PHP e hashing de senhas.
Catálogo de Produtos Dinâmico: Os produtos são carregados a partir de um arquivo JSON, permitindo fácil atualização.
Filtragem e Busca de Produtos: Funcionalidades de filtragem por categoria e busca por nome implementadas no lado do servidor.
Carrinho de Compras Persistente: O carrinho de compras é salvo na sessão do usuário, permitindo que ele navegue pelo site sem perder seus itens.
Gerenciamento de Quantidade: O usuário pode aumentar, diminuir ou remover itens diretamente da página do carrinho.
Fluxo de Checkout Completo: Desde a seleção de produtos até a página de pagamento e a confirmação final do pedido.
Histórico de Pedidos: Todos os pedidos finalizados são salvos em um arquivo JSON, criando um registro permanente.
Design Responsivo: O layout se adapta a diferentes tamanhos de tela, desde desktops até dispositivos móveis.

🚀 Tecnologias Utilizadas

Backend: PHP
Frontend: HTML5, CSS3, JavaScript (ES6)
Prototipagem: Figma
Logo: Canva 
Banco de Dados: Arquivos JSON (simulando um banco de dados NoSQL)
Fontes e Ícones: Google Fonts, Font Awesome
Auxílio na Codificação: Gemini Pro
Codificação: Visual Studio Code

📁 Arquitetura do Projeto

O projeto está organizado na seguinte estrutura de pastas para uma clara separação de responsabilidades:
divino-donuts/
│
├── pages/  
│   ├── login.php
│   ├── cadastro.php
│   ├── home.php
│   ├── produtos.php
│   ├── carrinho.php
│   ├── pagamento.php
│   ├── acessibilidade.php
│   ├── usuarios.json         (Banco de dados de usuários)
│   ├── produtos.json         (Banco de dados de produtos)
│   ├── pedidos.json          (Histórico de pedidos)
│
├── styles/
│   ├── login.css
│   └── ... (todas as outras folhas de estilo)
│
├── scripts/
│   ├── login.js
│   └── ... (todos os outros arquivos JavaScript)
│
├── img/
│   ├── produtos/
│   ├── icons/
│   └── ... (todas as imagens)
│
│
└── README.md             (Esta documentação)

🛠️ Instalação e Execução

Para executar este projeto em sua máquina local, siga os passos abaixo:
Pré-requisitos: Certifique-se de ter um ambiente de servidor local instalado, como XAMPP, WAMP ou MAMP.
Clone o Repositório:
Bash
git clone https://github.com/helen2411/Divino_Donuts.git


Mova os Arquivos: Copie a pasta do projeto para o diretório do seu servidor web (geralmente htdocs no XAMPP ou www no WAMP/MAMP).
Inicie o Servidor: Abra o painel de controle do seu ambiente (ex: XAMPP Control Panel) e inicie os serviços Apache.
Acesse no Navegador: Abra seu navegador e acesse a página inicial do projeto, geralmente através de um dos seguintes links:
http://localhost/divino-donuts/
http://localhost/divino-donuts/paginas/home.php (dependendo de onde você colocou os arquivos).

📄 Descrição das Páginas e Scripts

🍩 Página de Login (login.php)

Esta é a porta de entrada para usuários registrados.
Propósito: Autenticar um usuário.
Funcionalidades:
Verifica se um usuário já está logado e o redireciona.
Processa o formulário de login via POST.
Valida as credenciais comparando o e-mail e a senha (usando password_verify) com os dados de usuarios.json.
Inicia a sessão ($_SESSION) em caso de sucesso e redireciona para a home.php.
Exibe mensagens de erro em caso de falha.

🍓 Página de Cadastro (cadastro.php)

Permite que novos clientes criem uma conta.
Propósito: Registrar um novo usuário.
Funcionalidades:
Processa o formulário de cadastro via POST.
Valida os dados (campos vazios, formato de e-mail).
Verifica se o e-mail já existe em usuarios.json.
Criptografa a senha com password_hash.
Salva o novo usuário no arquivo usuarios.json.
Exibe mensagens de sucesso ou erro.

☕ Página Home (home.php)

A página principal e vitrine do site.
Propósito: Apresentar a loja e servir como ponto central de navegação.
Funcionalidades:
Possui um menu de navegação dinâmico:
Para visitantes, exibe links de "Login" e "Cadastro".
Para usuários logados, exibe uma mensagem de boas-vindas ("Olá, [Nome]!") e os links "Minha Conta" e "Sair".
Apresenta as categorias de produtos.

🛍️ Página de Produtos (produtos.php)

O catálogo completo de produtos da Divino Donuts.
Propósito: Exibir todos os produtos disponíveis para compra.
Funcionalidades:
Carrega a lista de produtos do arquivo produtos.json.
Gera a grade de produtos dinamicamente com um loop foreach do PHP.
Permite a filtragem por categoria e busca por nome via servidor (parâmetros na URL).
Cada produto possui um botão "Adicionar ao Carrinho" que envia os dados para carrinho_acoes.php.

🛒 Página do Carrinho (carrinho.php)

Onde o usuário revisa os itens selecionados.
Propósito: Exibir e gerenciar os itens do carrinho de compras.
Funcionalidades:
Lê os dados do carrinho armazenados em $_SESSION['carrinho'].
Busca os detalhes completos de cada produto em produtos.json.
Exibe a lista de itens, com nome, imagem, preço unitário, quantidade e preço total por item.
Permite aumentar, diminuir ou remover itens através de formulários que se comunicam com carrinho_acoes.php.
Calcula e exibe o subtotal, a taxa de entrega e o valor total do pedido, tudo no lado do servidor.

💳 Fluxo de Pagamento (pagamento.php)

A etapa final da compra.
Propósito: Permitir que o usuário revise o pedido e "finalize" a compra.
Funcionalidades:
Protegida contra acesso direto (redireciona se o carrinho estiver vazio).
Exibe um resumo final do pedido com todos os itens e o valor total.
Apresenta um formulário para seleção da forma de pagamento.
Ao submeter, envia os dados para finalizar_pedido.php.

♿ Página de Acessibilidade (acessibilidade.php)

Painel de controle para ferramentas de acessibilidade.
Propósito: Oferecer opções para melhorar a experiência de usuários com diferentes necessidades.
Funcionalidades:
Apresenta um menu de opções (Libras, controle de fonte, modo escuro, etc.).
A lógica de ativação dessas ferramentas é controlada pelo JavaScript (acessibilidade.js), pois precisa manipular a página em tempo real no navegador.
O PHP é usado apenas para integrar a página ao restante do site, com o menu de navegação dinâmico.

⚙️ Scripts de Lógica (Helpers)

carrinho_acoes.php: Um script que não exibe HTML. Ele é o "motor" do carrinho, responsável por receber as ações (adicionar, aumentar, diminuir, remover) e atualizar os dados na $_SESSION['carrinho'].

finalizar_pedido.php: Outro script de lógica. Ele é acionado pela página de pagamento para:
Validar e processar o pedido.
Salvar os detalhes da compra em pedidos.json.
Limpar o carrinho da sessão.
Redirecionar o usuário para a página de confirmação.

logout.php: Script simples que destrói a sessão do usuário e o redireciona para a página de login.

confirmacao_pedido.php: A página final do fluxo de compra, que exibe os detalhes do pedido recém-criado para o cliente.

🔮 Próximos Passos e Melhorias

Este projeto é uma base sólida. Para levá-lo ao próximo nível, devo considerar:

Migração para Banco de Dados SQL: Substituir os arquivos JSON por um banco de dados relacional como MySQL ou MariaDB para melhor performance e escalabilidade.
Página "Minha Conta": Desenvolver a página onde usuários logados podem ver seu histórico de pedidos e gerenciar seus dados cadastrais.
Painel Administrativo: Criar uma área restrita para o administrador do site poder adicionar/editar produtos sem precisar alterar o arquivo JSON manualmente.
Integração com Gateway de Pagamento: Estudar a API de serviços como Mercado Pago, PagSeguro ou Stripe para processar pagamentos reais.






