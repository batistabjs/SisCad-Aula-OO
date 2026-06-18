<div class="container mt-4">
    <h1 class="fw-bold">Dashboard</h1>
    <p class="lead">Bem-vindo ao resumo do sistema.</p>
    <hr>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Contatos</h5>
                    <p class="card-text display-4 fw-bold"><?php echo $stats['contatos_count']; ?></p>
                    <a href="/contatos/lista" class="btn btn-light btn-sm">Ver todos</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text display-4 fw-bold"><?php echo $stats['clientes_count']; ?></p>
                    <a href="/clientes/lista" class="btn btn-light btn-sm">Ver todos</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Produtos</h5>
                    <p class="card-text display-4 fw-bold"><?php echo $stats['produtos_count']; ?></p>
                    <a href="/produtos/lista" class="btn btn-light btn-sm">Ver todos</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Pedidos</h5>
                    <p class="card-text display-4 fw-bold"><?php echo $stats['pedidos_count']; ?></p>
                    <a href="/pedidos/lista" class="btn btn-light btn-sm">Ver todos</a>
                </div>
            </div>
        </div>
    </div>
</div>
