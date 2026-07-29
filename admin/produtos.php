<?php
session_start();
if (!isset($_SESSION['admin_logado'])) { header('Location: ../loginadm.php'); exit; }
require_once "../conexao/conexao.php";

$msg = '';
$editando = null;

// Excluir
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $conn->query("DELETE FROM produtos WHERE id = $id");
    $msg = "Produto excluído com sucesso!";
    header("Location: produtos.php?msg=" . urlencode($msg));
    exit;
}

// Salvar (Adicionar/Editar)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nome = $conn->real_escape_string($_POST['nome']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $preco = floatval($_POST['preco']);
    $preco_antigo = floatval($_POST['preco_antigo']);
    $estoque = intval($_POST['estoque']);
    $categoria_id = intval($_POST['categoria_id']);
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    $desconto = intval($_POST['desconto']);
    
    $imagem = '';
    if (!empty($_POST['imagem_url'])) {
        $imagem = $conn->real_escape_string($_POST['imagem_url']);
    }
    
    if ($id > 0) {
        $conn->query("UPDATE produtos SET nome='$nome', descricao='$descricao', preco=$preco, preco_antigo=$preco_antigo, estoque=$estoque, categoria_id=$categoria_id, ativo=$ativo, desconto=$desconto, imagem='$imagem' WHERE id=$id");
        $msg = "Produto atualizado com sucesso!";
    } else {
        $conn->query("INSERT INTO produtos (nome, descricao, preco, preco_antigo, estoque, categoria_id, ativo, desconto, imagem) 
                      VALUES ('$nome', '$descricao', $preco, $preco_antigo, $estoque, $categoria_id, $ativo, $desconto, '$imagem')");
        $msg = "Produto cadastrado com sucesso!";
    }
    header("Location: produtos.php?msg=" . urlencode($msg));
    exit;
}

// Editar
if (isset($_GET['editar'])) {
    $id = intval($_GET['editar']);
    $res = $conn->query("SELECT * FROM produtos WHERE id = $id");
    $editando = $res->fetch_assoc();
}

// Listar
$produtos = $conn->query("SELECT p.*, c.nome as categoria_nome FROM produtos p LEFT JOIN categorias c ON p.categoria_id = c.id ORDER BY p.id DESC");
$categorias = $conn->query("SELECT * FROM categorias ORDER BY nome");

if (isset($_GET['msg'])) $msg = $_GET['msg'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Gata Fit Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --rosa: #ff3385; --rosa-escuro: #d91a6b; --escuro: #1a1a2e; --cinza-bg: #f4f6f9; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; min-height: 100vh; background: var(--cinza-bg); }
        
        .sidebar {
            width: 260px; background: var(--escuro); color: white;
            padding: 25px 0; position: fixed; height: 100vh; overflow-y: auto;
            transition: 0.3s; z-index: 1000;
        }
        .sidebar-header { padding: 0 25px 25px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 15px; }
        .sidebar-header h2 { color: var(--rosa); font-size: 20px; display: flex; align-items: center; gap: 10px; }
        .sidebar-menu { padding: 0 15px; }
        .sidebar-menu a { display: flex; align-items: center; gap: 12px; color: rgba(255,255,255,0.7); text-decoration: none; padding: 12px 15px; margin-bottom: 4px; border-radius: 10px; font-size: 14px; font-weight: 500; transition: 0.3s; }
        .sidebar-menu a i { width: 20px; text-align: center; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: var(--rosa); color: white; }
        .sidebar-menu .logout { margin-top: 30px; background: rgba(255,255,255,0.08); }
        .sidebar-menu .logout:hover { background: #e74c3c; }
        
        .mobile-toggle { display: none; position: fixed; top: 15px; left: 15px; z-index: 1001; background: var(--rosa); color: white; border: none; padding: 12px; border-radius: 10px; cursor: pointer; }
        
        .content { flex: 1; margin-left: 260px; padding: 30px; transition: 0.3s; }
        
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .page-header h1 { font-size: 26px; color: var(--escuro); }
        .btn-primary {
            background: linear-gradient(135deg, var(--rosa), var(--rosa-escuro));
            color: white; border: none; padding: 12px 24px; border-radius: 10px;
            font-weight: 600; cursor: pointer; text-decoration: none; display: inline-flex;
            align-items: center; gap: 8px; font-size: 14px; transition: 0.3s;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(255,51,133,0.3); }
        
        .alert {
            padding: 14px 20px; border-radius: 10px; margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px; font-size: 14px;
        }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        
        .panel { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 25px; }
        .panel h3 { font-size: 18px; color: var(--escuro); margin-bottom: 20px; }
        
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 13px; font-weight: 600; color: #666; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-group input, .form-group select, .form-group textarea {
            padding: 12px 14px; border: 1px solid #e0e0e0; border-radius: 10px;
            font-size: 14px; outline: none; transition: 0.3s;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: var(--rosa); }
        .form-group textarea { resize: vertical; min-height: 80px; }
        
        .form-actions { margin-top: 20px; display: flex; gap: 10px; }
        .btn-secondary { background: #6c757d; color: white; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 600; cursor: pointer; text-decoration: none; }
        
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { text-align: left; padding: 14px 12px; color: #888; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #f0f0f0; }
        .data-table td { padding: 14px 12px; border-bottom: 1px solid #f5f5f5; font-size: 14px; color: #444; vertical-align: middle; }
        .data-table tr:hover { background: #fafafa; }
        
        .product-thumb {
            width: 50px; height: 50px; border-radius: 8px; object-fit: cover;
            background: #f0f0f0; display: flex; align-items: center; justify-content: center;
        }
        .product-thumb img { width: 100%; height: 100%; object-fit: cover; border-radius: 8px; }
        
        .status-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 6px; }
        .status-ativo { background: #2ecc71; }
        .status-inativo { background: #e74c3c; }
        
        .actions { display: flex; gap: 8px; }
        .actions a {
            width: 32px; height: 32px; border-radius: 8px; display: flex;
            align-items: center; justify-content: center; text-decoration: none;
            font-size: 13px; transition: 0.3s;
        }
        .actions .edit { background: #e3f2fd; color: #1976d2; }
        .actions .edit:hover { background: #1976d2; color: white; }
        .actions .delete { background: #ffebee; color: #c62828; }
        .actions .delete:hover { background: #c62828; color: white; }
        
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .content { margin-left: 0; padding: 70px 15px 20px; }
            .mobile-toggle { display: block; }
            .page-header { flex-direction: column; gap: 15px; align-items: flex-start; }
            .data-table { font-size: 12px; }
            .data-table th, .data-table td { padding: 10px 6px; }
            .product-thumb { width: 40px; height: 40px; }
        }
    </style>
</head>
<body>

<button class="mobile-toggle" onclick="document.querySelector('.sidebar').classList.toggle('open')">
    <i class="fas fa-bars"></i>
</button>

<aside class="sidebar">
    <div class="sidebar-header">
        <h2><i class="fas fa-dumbbell"></i> Gata Fit Admin</h2>
    </div>
    <nav class="sidebar-menu">
        <a href="index.php"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="produtos.php" class="active"><i class="fas fa-box"></i> Produtos</a>
        <a href="categorias.php"><i class="fas fa-tags"></i> Categorias</a>
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
        <h1><i class="fas fa-box" style="color: var(--rosa); margin-right: 10px;"></i>Gerenciar Produtos</h1>
        <button class="btn-primary" onclick="document.getElementById('form-produto').scrollIntoView({behavior:'smooth'})">
            <i class="fas fa-plus"></i> Novo Produto
        </button>
    </div>
    
    <?php if ($msg): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($msg); ?></div>
    <?php endif; ?>
    
    <!-- Formulário -->
    <div class="panel" id="form-produto">
        <h3><?php echo $editando ? 'Editar Produto' : 'Cadastrar Novo Produto'; ?></h3>
        <form method="POST">
            <?php if ($editando): ?>
                <input type="hidden" name="id" value="<?php echo $editando['id']; ?>">
            <?php endif; ?>
            <div class="form-grid">
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Nome do Produto</label>
                    <input type="text" name="nome" value="<?php echo $editando['nome'] ?? ''; ?>" required placeholder="Ex: Top Fitness Alta Sustentação">
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Descrição</label>
                    <textarea name="descricao" placeholder="Descrição do produto..."><?php echo $editando['descricao'] ?? ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Preço (R$)</label>
                    <input type="number" step="0.01" name="preco" value="<?php echo $editando['preco'] ?? ''; ?>" required placeholder="89.90">
                </div>
                <div class="form-group">
                    <label>Preço Antigo (R$)</label>
                    <input type="number" step="0.01" name="preco_antigo" value="<?php echo $editando['preco_antigo'] ?? ''; ?>" placeholder="129.90">
                </div>
                <div class="form-group">
                    <label>Estoque</label>
                    <input type="number" name="estoque" value="<?php echo $editando['estoque'] ?? '0'; ?>" required>
                </div>
                <div class="form-group">
                    <label>Desconto (%)</label>
                    <input type="number" name="desconto" value="<?php echo $editando['desconto'] ?? '0'; ?>" min="0" max="100">
                </div>
                <div class="form-group">
                    <label>Categoria</label>
                    <select name="categoria_id" required>
                        <option value="">Selecione...</option>
                        <?php while ($cat = $categorias->fetch_assoc()): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo ($editando && $editando['categoria_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['nome']); ?>
                            </option>
                        <?php endwhile; ?>
                        <?php $categorias->data_seek(0); ?>
                    </select>
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>URL da Imagem</label>
                    <input type="url" name="imagem_url" value="<?php echo $editando['imagem'] ?? ''; ?>" placeholder="https://exemplo.com/imagem.jpg">
                </div>
                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="ativo" <?php echo (!$editando || $editando['ativo']) ? 'checked' : ''; ?> style="width: auto;">
                        <span>Produto Ativo</span>
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary"><i class="fas fa-save"></i> <?php echo $editando ? 'Atualizar' : 'Salvar'; ?></button>
                <?php if ($editando): ?>
                    <a href="produtos.php" class="btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    
    <!-- Tabela -->
    <div class="panel">
        <h3><i class="fas fa-list" style="color: var(--rosa); margin-right: 8px;"></i>Lista de Produtos</h3>
        <div style="overflow-x: auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($produtos && $produtos->num_rows > 0): ?>
                        <?php while ($p = $produtos->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <div class="product-thumb">
                                        <?php if ($p['imagem']): ?>
                                            <img src="<?php echo htmlspecialchars($p['imagem']); ?>" alt="">
                                        <?php else: ?>
                                            <i class="fas fa-image" style="color: #ccc;"></i>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($p['nome']); ?></strong><br>
                                    <small style="color: #999;"><?php echo substr(htmlspecialchars($p['descricao']), 0, 50); ?>...</small>
                                </td>
                                <td><?php echo htmlspecialchars($p['categoria_nome'] ?? '-'); ?></td>
                                <td style="font-weight: 700; color: var(--rosa);">R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></td>
                                <td><?php echo $p['estoque']; ?></td>
                                <td>
                                    <span class="status-dot status-<?php echo $p['ativo'] ? 'ativo' : 'inativo'; ?>"></span>
                                    <?php echo $p['ativo'] ? 'Ativo' : 'Inativo'; ?>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="?editar=<?php echo $p['id']; ?>" class="edit" title="Editar"><i class="fas fa-edit"></i></a>
                                        <a href="?excluir=<?php echo $p['id']; ?>" class="delete" title="Excluir" onclick="return confirm('Tem certeza?')"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="7" style="text-align: center; padding: 40px; color: #999;">Nenhum produto cadastrado</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

</body>
</html>