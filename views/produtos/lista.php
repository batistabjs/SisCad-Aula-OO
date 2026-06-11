<h2>Gerenciamento de Produtos</h2>
<p><a href="index.php?page=/produtos/cadastro">Cadastrar Novo Produto</a></p>

<table>
    <thead>
        <tr><th>Imagem</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Estoque</th><th>Ações</th></tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto): ?>
            <tr>
                <td>
                    <?php if ($produto->getImagem()): ?>
                        <img src="uploads/<?php echo $produto->getImagem(); ?>" width="50" height="50" style="object-fit: cover;">
                    <?php else: ?>
                        Sem imagem
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($produto->getNome()); ?></td>
                <td><?php echo htmlspecialchars($produto->getDescricao()); ?></td>
                <td>R$ <?php echo number_format($produto->getPreco(), 2, ',', '.'); ?></td>
                <td><?php echo $produto->getEstoque(); ?></td>
                <td>
                    <a href="index.php?page=/produtos/cadastro&id=<?php echo $produto->getId(); ?>">Editar</a> | 
                    <a href="index.php?page=/produtos/excluir&id=<?php echo $produto->getId(); ?>" onclick="return confirm('Excluir este produto?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
