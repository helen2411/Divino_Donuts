<?php
// Inicia a sessão
session_start();

// Desfaz todas as variáveis de sessão
$_SESSION = [];

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header('location: login.php');
exit;
?>