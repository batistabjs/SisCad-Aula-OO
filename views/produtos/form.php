<?php require_once 'views/cabecalho.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                <?php echo $produto ? 'Editar' : 'Cadastrar'; ?> Produto
            </div>
            <div class="card-body p-4">
                <?php if (isset($erro)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
                <?php endif; ?>

                <form method="POST" action="/produtos/salvar" enctype="multipart/form-data">
                    <?php if ($produto): ?>
                        <input type="hidden" name="id" value="<?php echo $produto->getId(); ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Produto</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?php echo htmlspecialchars($produto ? $produto->getNome() : ($_POST['nome'] ?? '')); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea name="descricao" id="descricao" class="form-control" rows="3"><?php echo htmlspecialchars($produto ? $produto->getDescricao() : ($_POST['descricao'] ?? '')); ?></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="preco" class="form-label">Preço (ex: 25.50)</label>
                            <input type="text" name="preco" id="preco" class="form-control" value="<?php echo htmlspecialchars($produto ? $produto->getPreco() : ($_POST['preco'] ?? '')); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="estoque" class="form-label">Estoque</label>
                            <input type="number" name="estoque" id="estoque" class="form-control" value="<?php echo htmlspecialchars($produto ? $produto->getEstoque() : ($_POST['estoque'] ?? '')); ?>" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem do Produto</label>
                        <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*">
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="/produtos/lista" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Salvar Produto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/rodape.php'; ?>
