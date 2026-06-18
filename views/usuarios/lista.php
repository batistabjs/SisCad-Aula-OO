<?php require_once 'views/cabecalho.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Gerenciamento de Usuários</h2>
    <a href="/usuarios/cadastro" class="btn btn-primary">Novo Usuário</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Usuário</th>
                    <th>Perfil</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $indice => $usuario): ?>
                <tr>
                    <td><?php echo $indice + 1; ?></td>
                    <td><?php echo htmlspecialchars($usuario->getUsuario()); ?></td>
                    <td><span class="badge bg-info text-dark"><?php echo htmlspecialchars($usuario->getPerfil()); ?></span></td>
                    <td class="text-end">
                        <a href="/usuarios/cadastro?id=<?php echo $usuario->getId(); ?>" class="btn btn-sm btn-outline-secondary me-2">Editar</a>
                        <a href="/usuarios/excluir?id=<?php echo $usuario->getId(); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'views/rodape.php'; ?>
