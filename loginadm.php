<?php
session_start();
require_once "database/conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Exemplo simplificado de autenticação
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    
    if ($usuario === 'admin' && $senha === '123456') {
        $_SESSION['admin_logado'] = true;
        header('Location: admin/index.php');
        exit;
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Painel Admin - Gata Fit Store</title>
    <style>
        body { background-color: #111; color: white; font-family: Arial; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background-color: #222; padding: 40px; border-radius: 8px; width: 300px; text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: none; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #ff3385; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Gata Fit Admin</h2>
        <?php if(isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
        <form method="POST">
            <input type="text" name="usuario" placeholder="Usuário" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar no Painel</button>
        </form>
    </div>
</body>
</html>