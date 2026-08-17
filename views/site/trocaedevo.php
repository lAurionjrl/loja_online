<?php 
declare(strict_types=1);
use App\Helpers\View;
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Online | Produtos, ofertas e tecnologia</title>
    
    <meta name="description" content="Encontre produtos de informática, celulares, acessórios, games e ofertas especiais em nossa loja online.">
    <meta name="keywords" content="loja online, eletrônicos, informática, celulares, acessórios, games, ofertas">
    <meta name="author" content="Loja Online">
    
    <meta property="og:title" content="Loja Online | Produtos, ofertas e tecnologia">
    <meta property="og:description" content="Encontre produtos de informática, celulares, acessórios, games e ofertas especiais em nossa loja online.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="assets/img/og-image.jpg">
    
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    
    <base href="/loja_online/public/">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="<?= BASE_URL . '/assets/css/site.css' ?>">
</head>
<body>

    

    <!-- Navbar principal -->
    <?php View::componente('site/header');?>

    <main id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                   troca e devoluções
                </div>
            </div>
        </div>
        
    </main>

    <!-- Rodapé -->
     <?php View::componente('site/footer');?>
   
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>