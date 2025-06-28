<?php
// Escolha uma senha forte
$senha_plana = '123456';

// Gera um hash seguro da senha
$senha_hash = password_hash($senha_plana, PASSWORD_DEFAULT);

// Exibe o hash. Copie este valor!
echo "Senha Plana: " . $senha_plana . "<br>";
echo "Senha Hash (copie este valor para o login.php): " . $senha_hash;
?>