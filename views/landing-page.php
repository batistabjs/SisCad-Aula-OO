<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SisCad - Controle de Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: white;
            padding: 100px 0;
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 2rem 0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">SisCad</a>
            <div class="ms-auto">
                <a href="/login" class="btn btn-outline-primary">Acessar Sistema</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold">Controle suas Vendas com Eficiência</h1>
            <p class="lead mb-5">A solução completa para gestão de clientes, contatos e produtos em um só lugar. Simples, rápido e intuitivo.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="/login" class="btn btn-light btn-lg px-4 gap-3 fw-bold text-primary">Começar Agora</a>
                <a href="#recursos" class="btn btn-outline-light btn-lg px-4">Saiba Mais</a>
            </div>
        </div>
    </header>

    <!-- Recursos -->
    <section id="recursos" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Por que escolher o SisCad?</h2>
                <p class="text-muted">Tudo o que você precisa para organizar seu negócio.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="feature-icon">👥</div>
                    <h4>Gestão de Clientes</h4>
                    <p class="text-muted">Mantenha um banco de dados organizado de seus clientes e facilite a comunicação.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">📞</div>
                    <h4>Contatos Rápidos</h4>
                    <p class="text-muted">Acesse rapidamente as informações de contato para agilizar suas vendas.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">📦</div>
                    <h4>Catálogo de Produtos</h4>
                    <p class="text-muted">Controle seu estoque e visualize seus produtos de forma simplificada.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sobre -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="https://img.freepik.com/free-vector/business-analytics-concept-illustration_114360-4351.jpg" class="img-fluid rounded shadow" alt="Análise de Vendas">
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <h2 class="fw-bold mb-4">Sua empresa no próximo nível</h2>
                    <p>O SisCad foi desenvolvido para empreendedores que buscam sair das planilhas complicadas e migrar para um sistema organizado. Com foco em usabilidade, permitimos que você gaste menos tempo organizando dados e mais tempo vendendo.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2">✅ Interface Responsiva (Acesse do celular)</li>
                        <li class="mb-2">✅ Cadastro Simplificado</li>
                        <li class="mb-2">✅ Dashboard de Indicadores</li>
                    </ul>
                    <a href="/login" class="btn btn-primary mt-3">Experimentar Gratuitamente</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-light border-top py-4 mt-5">
        <div class="container text-center text-muted">
            <p class="mb-0">&copy; 2026 SisCad - Sistema de Controle de Vendas. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
