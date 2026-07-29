<?php
session_start();
if (!isset($_SESSION['admin_logado'])) {
    header('Location: ../loginadm.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo - Gata Fit Store</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f6f9; }
        .sidebar { width: 250px; background-color: #1a1a1a; color: white; padding: 20px; }
        .sidebar h2 { color: #ff3385; margin-bottom: 30px; font-size: 20px; }
        .sidebar a { display: block; color: #ccc; text-decoration: none; padding: 12px 10px; margin-bottom: 5px; border-radius: 4px; }
        .sidebar a:hover, .sidebar a.active { background-color: #ff3385; color: white; }
        .content { flex-grow: 1; padding: 30px; overflow-y: auto; }
        .cards-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-top: 20px; }
        .card { background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .card h3 { color: #666; font-size: 14px; }
        .card p { font-size: 24px; font-weight: bold; margin-top: 10px; color: #111; }
    </style>
</head>
<body>

    <!-- Menu Lateral (Dashboard Admin) -->
    <aside class="sidebar">
        <h2>Gata Fit Admin</h2>
        <a href="index.php" class="active">Dashboard</a>
        <a href="produtos.php">Produtos</a>
        <a href="categorias.php">Categorias</a>
        <a href="pedidos.php">Pedidos</a>
        <a href="carrinhos.php">Carrinhos</a>
        <a href="clientes.php">Clientes</a>
        <a href="pagamentos.php">Pagamentos</a>
        <a href="administradores.php">Admins</a>
        <a href="../loginadm.php" style="margin-top: 40px; background-color: #333;">Sair</a>
    </aside>

    <!-- Conteúdo Principal -->
    <main class="content">
        <h1>Visão Geral do Negócio</h1>
        
        <div class="cards-grid">
            <div class="card">
                <h3>Vendas Hoje</h3>
                <p>R$ 1.250,00</p>
            </div>
            <div class="card">
                <h3>Pedidos Pendentes</h3>
                <p>12</p>
            </div>
            <div class="card">
                <h3>Total de Clientes</h3>
                <p>348</p>
            </div>
            <div class="card">
                <h3>Produtos Ativos</h3>
                <p>85</p>
            </div>
        </div>
    </main>

</body>
</html>