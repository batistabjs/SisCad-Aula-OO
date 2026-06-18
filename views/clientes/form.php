<?php require_once 'views/cabecalho.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                <?php echo $cliente ? 'Editar' : 'Cadastrar'; ?> Cliente
            </div>
            <div class="card-body p-4">
                <?php if (isset($erro)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
                <?php endif; ?>

                <form method="POST" action="/clientes/salvar">
                    <?php if ($cliente): ?>
                        <input type="hidden" name="id" value="<?php echo $cliente->getId(); ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?php echo htmlspecialchars($cliente ? $cliente->getNome() : ($_POST['nome'] ?? '')); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF (000.000.000-00)</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" value="<?php echo htmlspecialchars($cliente ? $cliente->getCpf() : ($_POST['cpf'] ?? '')); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($cliente ? $cliente->getEmail() : ($_POST['email'] ?? '')); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" value="<?php echo htmlspecialchars($cliente ? $cliente->getTelefone() : ($_POST['telefone'] ?? '')); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" name="endereco" id="endereco" class="form-control" value="<?php echo htmlspecialchars($cliente ? $cliente->getEndereco() : ($_POST['endereco'] ?? '')); ?>">
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="/clientes/lista" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Salvar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/rodape.php'; ?>
