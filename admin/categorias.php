<?php
session_start();
if (!isset($_SESSION['admin_logado'])) { header('Location: ../loginadm.php'); exit; }
require_once "../conexao/conexao.php";

$msg = '';
$editando = null;

if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $conn->query("DELETE FROM categorias WHERE id = $id");
    header("Location: categorias.php?msg=Categoria excluída!");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nome = $conn->real_escape_string($_POST['nome']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    
    if ($id > 0) {
        $conn->query("UPDATE categorias SET nome='$nome', descricao='$descricao' WHERE id=$id");
        $msg = "Categoria atualizada!";
    } else {
        $conn->query("INSERT INTO categorias (nome, descricao) VALUES ('$nome', '$descricao')");
        $msg = "Categoria cadastrada!";
    }
    header("Location: categorias.php?msg=" . urlencode($msg));
    exit;
}

if (isset($_GET['editar'])) {
    $res = $conn->query("SELECT * FROM categorias WHERE id = " . intval($_GET['editar']));
    $editando = $res->fetch_assoc();
}

$categorias = $conn->query("SELECT c.*, COUNT(p.id) as total_produtos FROM categorias c LEFT JOIN produtos p ON c.id = p.categoria_id GROUP BY c.id ORDER BY c.nome");
if (isset($_GET['msg'])) $msg = $_GET['msg'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - Gata Fit Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --rosa: #ff3385; --rosa-escuro: #d91a6b; --escuro: #1a1a2e; --cinza-bg: #f4f6f9; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; min-height: 100vh; background: var(--cinza-bg); }
        .sidebar { width: 260px; background: var(--escuro); color: white; padding: 25px 0; position: fixed; height: 100vh; z-index: 1000; transition: 0.3s; }
        .sidebar-header { padding: 0 25px 25px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 15px; }
        .sidebar-header h2 { color: var(--rosa); font-size: 20px; display: flex; align-items: center; gap: 10px; }
        .sidebar-menu { padding: 0 15px; }
        .sidebar-menu a { display: flex; align-items: center; gap: 12px; color: rgba(255,255,255,0.7); text-decoration: none; padding: 12px 15px; margin-bottom: 4px; border-radius: 10px; font-size: 14px; font-weight: 500; transition: 0.3s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: var(--rosa); color: white; }
        .sidebar-menu .logout { margin-top: 30px; background: rgba(255,255,255,0.08); }
        .sidebar-menu .logout:hover { background: #e74c3c; }
        .mobile-toggle { display: none; position: fixed; top: 15px; left: 15px; z-index: 1001; background: var(--rosa); color: white; border: none; padding: 12px; border-radius: 10px; cursor: pointer; }
        .content { flex: 1; margin-left: 260px; padding: 30px; transition: 0.3s; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .page-header h1 { font-size: 26px; color: var(--escuro); }
        .btn-primary { background: linear-gradient(135deg, var(--rosa), var(--rosa-escuro)); color: white; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-size: 14px; transition: 0.3s; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(255,51,133,0.3); }
        .alert { padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 14px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .panel { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 25px; }
        .panel h3 { font-size: 18px; color: var(--escuro); margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { font-size: 13px; font-weight: 600; color: #666; margin-bottom: 6px; display: block; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px 14px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px; outline: none; transition: 0.3s; }
        .form-group input:focus, .form-group textarea:focus { border-color: var(--rosa); }
        .form-actions { margin-top: 15px; display: flex; gap: 10px; }
        .btn-secondary { background: #6c757d; color: white; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 600; cursor: pointer; text-decoration: none; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { text-align: left; padding: 14px 12px; color: #888; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #f0f0f0; }
        .data-table td { padding: 14px 12px; border-bottom: 1px solid #f5f5f5; font-size: 14px; color: #444; }
        .data-table tr:hover { background: #fafafa; }
        .cat-icon { width: 40px; height: 40px; background: linear-gradient(135deg, var(--rosa), var(--rosa-escuro)); color: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; }
        .actions { display: flex; gap: 8px; }
        .actions a { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 13px; transition: 0.3s; }
        .actions .edit { background: #e3f2fd; color: #1976d2; }
        .actions .edit:hover { background: #1976d2; color: white; }
        .actions .delete { background: #ffebee; color: #c62828; }
        .actions .delete:hover { background: #c62828; color: white; }
        @media (max-width: 768px) { .sidebar { transform: translateX(-100%); } .sidebar.open { transform: translateX(0); } .content { margin-left: 0; padding: 70px 15px 20px; } .mobile-toggle { display: block; } .page-header { flex-direction: column; gap: 15px; align-items: flex-start; } }
    </style>
</head>
<body>
<button class="mobile-toggle" onclick="document.querySelector('.sidebar').classList.toggle('open')"><i class="fas fa-bars"></i></button>
<aside class="sidebar">
    <div class="sidebar-header"><h2><i class="fas fa-dumbbell"></i> Gata Fit Admin</h2></div>
    <nav class="sidebar-menu">
        <a href="index.php"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="produtos.php"><i class="fas fa-box"></i> Produtos</a>
        <a href="categorias.php" class="active"><i class="fas fa-tags"></i> Categorias</a>
        <a href="pedidos.php"><i class="fas fa-shopping-bag"></i> Pedidos</a>
        <a href="carrinhos.php"><i class="fas fa-shopping-cart"></i> Carrinhos</a>
        <a href="clientes.php"><i class="fas fa-users"></i> Clientes</a>
        <a href="pagamentos.php"><i class="fas fa-credit-card"></i> Pagamentos</a>
        <a href="administradores.php"><i class="fas fa-user-shield"></i> Admins</a>
        <a href="../loginadm.php" class="logout"><i class="fas fa-sign-out-alt"></i> Sair</a>
    </nav>
</aside>
<main class="content">
    <div class="page-header">
        <h1><i class="fas fa-tags" style="color: var(--rosa); margin-right: 10px;"></i>Gerenciar Categorias</h1>
        <button class="btn-primary" onclick="document.getElementById('form-cat').scrollIntoView({behavior:'smooth'})"><i class="fas fa-plus"></i> Nova Categoria</button>
    </div>
    <?php