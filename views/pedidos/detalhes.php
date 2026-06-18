<?php require_once 'views/cabecalho.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Detalhes do Pedido #<?php echo $pedido->getId(); ?></h2>
    <a href="/pedidos/lista" class="btn btn-outline-secondary">Voltar para Lista</a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">Informações do Pedido</div>
            <div class="card-body">
                <p class="mb-1"><strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($pedido->getDataPedido())); ?></p>
                <p class="mb-1"><strong>Cliente ID:</strong> <?php echo $pedido->getClienteId(); ?></p>
                <hr>
                <h4 class="text-end">Total: <span class="text-primary">R$ <?php echo number_format($pedido->getValorTotal(), 2, ',', '.'); ?></span></h4>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">Itens do Pedido</div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Produto ID</th>
                            <th>Quantidade</th>
                            <th>Preço Unit.</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedido->getItens() as $item): ?>
                        <tr>
                            <td>#<?php echo $item->getProdutoId(); ?></td>
                            <td><?php echo $item->getQuantidade(); ?></td>
                            <td>R$ <?php echo number_format($item->getPrecoUnitario(), 2, ',', '.'); ?></td>
                            <td class="text-end">R$ <?php echo number_format($item->getQuantidade() * $item->getPrecoUnitario(), 2, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Valor Total:</th>
                            <th class="text-end text-primary">R$ <?php echo number_format($pedido->getValorTotal(), 2, ',', '.'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/rodape.php'; ?>
