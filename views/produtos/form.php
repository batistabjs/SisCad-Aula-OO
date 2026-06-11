<h2><?php echo $produto ? 'Editar' : 'Cadastrar'; ?> Produto</h2>

<?php if (isset($erro)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($erro); ?></p>
<?php endif; ?>

<form method="POST" action="index.php?page=/produtos/salvar" enctype="multipart/form-data">
    <?php if ($produto): ?>
        <input type="hidden" name="id" value="<?php echo $produto->getId(); ?>">
    <?php endif; ?>
    <div style="margin-bottom: 10px;">
        <label for="nome">Nome do Produto:</label><br>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($produto ? $produto->getNome() : ($_POST['nome'] ?? '')); ?>">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao"><?php echo htmlspecialchars($produto ? $produto->getDescricao() : ($_POST['descricao'] ?? '')); ?></textarea>
    </div>
    <div style="margin-bottom: 10px;">
        <label for="preco">Preço (ex: 25.50):</label><br>
        <input type="text" name="preco" id="preco" value="<?php echo htmlspecialchars($produto ? $produto->getPreco() : ($_POST['preco'] ?? '')); ?>">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="estoque">Estoque:</label><br>
        <input type="number" name="estoque" id="estoque" value="<?php echo htmlspecialchars($produto ? $produto->getEstoque() : ($_POST['estoque'] ?? '')); ?>">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="imagem">Imagem do Produto:</label><br>
        <input type="file" name="imagem" id="imagem" accept="image/*">
    </div>
    <button type="submit">Salvar Produto</button>
    <a href="index.php?page=/produtos/lista">Voltar</a>
</form>
