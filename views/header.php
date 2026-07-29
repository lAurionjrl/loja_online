<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gata Fit Store - Moda Fitness</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --rosa: #ff3385; --rosa-escuro: #d91a6b; --escuro: #111; --cinza: #f3f3f3; }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: var(--cinza); color: #333; }
        
        .top-nav { 
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); 
            color: white; padding: 15px 30px; display: flex; align-items: center; 
            justify-content: space-between; position: sticky; top: 0; z-index: 1000; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .logo { font-size: 24px; font-weight: 800; color: var(--rosa); text-decoration: none; letter-spacing: 1px; }
        .logo i { margin-right: 8px; }
        .search-bar { flex-grow: 1; margin: 0 30px; display: flex; max-width: 600px; }
        .search-bar input { 
            width: 100%; padding: 12px 18px; border: none; border-radius: 30px 0 0 30px; 
            background: rgba(255,255,255,0.1); color: white; outline: none; font-size: 14px;
        }
        .search-bar input::placeholder { color: rgba(255,255,255,0.5); }
        .search-bar button { 
            padding: 12px 22px; background: var(--rosa); border: none; color: white; 
            border-radius: 0 30px 30px 0; cursor: pointer; font-weight: 600; transition: 0.3s;
        }
        .search-bar button:hover { background: var(--rosa-escuro); }
        
        .nav-links { display: flex; align-items: center; gap: 25px; }
        .nav-links a { 
            color: white; text-decoration: none; font-size: 14px; font-weight: 500; 
            transition: 0.3s; display: flex; align-items: center; gap: 6px;
        }
        .nav-links a:hover { color: var(--rosa); }
        .nav-links .cart-btn { 
            background: var(--rosa); padding: 8px 16px; border-radius: 20px; 
        }
        .nav-links .cart-btn:hover { background: var(--rosa-escuro); color: white; }
        
        .mobile-menu-btn { display: none; font-size: 22px; cursor: pointer; }
        
        @media (max-width: 768px) {
            .top-nav { padding: 12px 15px; flex-wrap: wrap; }
            .search-bar { order: 3; margin: 10px 0 0 0; max-width: 100%; width: 100%; }
            .nav-links { display: none; }
            .mobile-menu-btn { display: block; }
        }
    </style>
</head>
<body>
    <header class="top-nav">
        <a href="index.php" class="logo"><i class="fas fa-dumbbell"></i>GATA FIT STORE</a>
        <form class="search-bar" action="index.php" method="GET">
            <input type="text" name="busca" placeholder="Buscar roupas fitness, tops, legging...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
        <nav class="nav-links">
            <a href="loginadm.php"><i class="fas fa-user-shield"></i> Admin</a>
            <a href="#" class="cart-btn"><i class="fas fa-shopping-cart"></i> Carrinho (0)</a>
        </nav>
        <div class="mobile-menu-btn"><i class="fas fa-bars"></i></div>
    </header>