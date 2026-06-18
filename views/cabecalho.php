<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SisCad - Sistema de Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">SisCad</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuSisCad" aria-controls="menuSiscad" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuSisCad">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/usuarios/lista">Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pedidos/lista">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contatos/lista">Contatos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/clientes/lista">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/produtos/lista">Produtos</a>
                    </li>
                </ul>
                <a href="/auth/logout" class="btn btn-outline-danger ms-lg-3">Sair</a>
            </div>
        </div>
    </nav>

    <main class="container py-4 flex-grow-1">
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="alert alert-<?php echo $_SESSION['flash']['type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['flash']['message']; unset($_SESSION['flash']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>
