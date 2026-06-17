<div class="container mt-4">
    <h1>Dashboard</h1>
    <p class="lead">Bem-vindo ao resumo do sistema.</p>
    <hr>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Contatos</h5>
                    <p class="card-text display-4"><?php echo $stats['contatos']; ?></p>
                    <a href="/contatos/lista" class="btn btn-light btn-sm">Ver Todos</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text display-4"><?php echo $stats['clientes']; ?></p>
                    <a href="/clientes/lista" class="btn btn-light btn-sm">Ver Todos</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Produtos</h5>
                    <p class="card-text display-4"><?php echo $stats['produtos']; ?></p>
                    <a href="/produtos/lista" class="btn btn-light btn-sm">Ver Todos</a>
                </div>
            </div>
        </div>
    </div>
</div>
