<?php require_once 'views/cabecalho.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                <?php echo $usuario ? 'Editar' : 'Cadastrar'; ?> Usuário
            </div>
            <div class="card-body p-4">
                <?php if (isset($erro)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
                <?php endif; ?>

                <form method="POST" action="/usuarios/salvar">
                    <?php if ($usuario): ?>
                        <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuário</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo htmlspecialchars($usuario ? $usuario->getUsuario() : ($_POST['usuario'] ?? '')); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control" value="<?php echo htmlspecialchars($usuario ? $usuario->getSenha() : ($_POST['senha'] ?? '')); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="perfil" class="form-label">Perfil de Acesso</label>
                        <select name="perfil" id="perfil" class="form-select" required>
                            <option value="Usuario_Comum" <?php echo ($usuario && $usuario->getPerfil() == 'Usuario_Comum') ? 'selected' : ''; ?>>Usuário Comum</option>
                            <option value="Moderador" <?php echo ($usuario && $usuario->getPerfil() == 'Moderador') ? 'selected' : ''; ?>>Moderador</option>
                            <option value="Administrador" <?php echo ($usuario && $usuario->getPerfil() == 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
                        </select>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="/usuarios/lista" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Salvar Usuário</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/rodape.php'; ?>
