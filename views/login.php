<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SisCad - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .login-header {
            background-color: #0d6efd;
            color: white;
            border-radius: 1rem 1rem 0 0;
            padding: 2rem;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="card login-card">
        <div class="login-header">
            <h2 class="fw-bold mb-0">SisCad</h2>
            <p class="mb-0">Acesse sua conta</p>
        </div>
        <div class="card-body p-4">
            <?php if (isset($_SESSION['flash'])): ?>
                <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['flash']['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['flash']); ?>
            <?php endif; ?>

            <form action="/login/autenticar" method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                </div>
            </form>
            <div class="text-center mt-4">
                <a href="/" class="text-decoration-none text-muted small">Voltar para a Home</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
