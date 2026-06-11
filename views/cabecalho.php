<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>SisCad - Sistema de Cadastro</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #eee; }
        .flash-error { color: red; padding: 10px; background: #fee; border: 1px solid red; margin-bottom: 10px; }
        .flash-success { color: green; padding: 10px; background: #efe; border: 1px solid green; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>SisCad - Sistema de Cadastro</h1>
    <nav style="margin-bottom: 20px; padding: 10px; background: #f4f4f4; border-radius: 5px;">
        <a href="/contatos/lista">Contatos</a> | 
        <a href="/clientes/lista">Clientes</a> | 
        <a href="/produtos/lista">Produtos</a>
    </nav>
    <hr>

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="flash-<?php echo $_SESSION['flash']['type']; ?>">
            <?php echo $_SESSION['flash']['message']; unset($_SESSION['flash']); ?>
        </div>
    <?php endif; ?>
