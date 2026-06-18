<?php require_once 'views/cabecalho.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Gerenciamento de Produtos</h2>
    <a href="/produtos/cadastro" class="btn btn-primary">Novo Produto</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td class="text-center">
                        <?php if ($produto->getImagem()): ?>
                            <img src="uploads/<?php echo $produto->getImagem(); ?>" width="50" height="50" class="rounded border" style="object-fit: cover;">
                        <?php else: ?>
                            <span class="text-muted small">Sem imagem</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($produto->getNome()); ?></td>
                    <td><?php echo htmlspecialchars($produto->getDescricao()); ?></td>
                    <td>R$ <?php echo number_format($produto->getPreco(), 2, ',', '.'); ?></td>
                    <td><?php echo $produto->getEstoque(); ?></td>
                    <td class="text-end">
                        <a href="/produtos/cadastro?id=<?php echo $produto->getId(); ?>" class="btn btn-sm btn-outline-secondary me-2">Editar</a>
                        <a href="/produtos/excluir?id=<?php echo $produto->getId(); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir este produto?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'views/rodape.php'; ?>
