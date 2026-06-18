<?php require_once 'views/cabecalho.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Histórico de Pedidos</h2>
    <a href="/pedidos/cadastro" class="btn btn-primary">Novo Pedido</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                <tr>
                    <td>#<?php echo $pedido['id']; ?></td>
                    <td><?php echo htmlspecialchars($pedido['cliente_nome']); ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?></td>
                    <td>
                        <?php 
                            $status = $pedido['status'] ?? 'Novo';
                            $badgeClass = 'bg-info';
                            if ($status === 'Entregue') $badgeClass = 'bg-success';
                            elseif ($status === 'Pendente') $badgeClass = 'bg-warning text-dark';
                            elseif ($status === 'Cancelado') $badgeClass = 'bg-danger';
                        ?>
                        <span class="badge <?php echo $badgeClass; ?>"><?php echo $status; ?></span>
                    </td>
                    <td>R$ <?php echo number_format($pedido['valor_total'], 2, ',', '.'); ?></td>
                    <td class="text-end">
                        <a href="/pedidos/detalhes?id=<?php echo $pedido['id']; ?>" class="btn btn-sm btn-outline-secondary">Detalhes</a>
                        <?php if ($status !== 'Cancelado' && $status !== 'Entregue'): ?>
                            <a href="/pedidos/cancel?id=<?php echo $pedido['id']; ?>" 
                               class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('Tem certeza que deseja cancelar este pedido? O estoque será restaurado.')">Cancelar</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'views/rodape.php'; ?>
