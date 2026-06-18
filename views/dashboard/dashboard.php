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

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-dark text-white mb-3 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Cotação do Dólar</h5>
                    <p id="dolar-cotacao" class="card-text display-6 fw-bold">Carregando...</p>
                    <small class="text-white">Fonte: dolarapi.com</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dolarElement = document.getElementById('dolar-cotacao');
        if (dolarElement) {
            fetch('/api/integracao/dolar')
                .then(response => {
                    if (!response.ok) throw new Error('Erro na requisição');
                    return response.json();
                })
                .then(data => { 
                    if (data && data.valor) {
                        dolarElement.innerText = data.valor.toLocaleString('pt-BR', { 
                                                                                style: 'currency', 
                                                                                currency: 'BRL' 
                                                                            });
                    } else {
                        dolarElement.innerText = 'Indisponível';
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar cotação:', error);
                    dolarElement.innerText = 'Erro ao carregar';
                });
        }
    });
</script>
