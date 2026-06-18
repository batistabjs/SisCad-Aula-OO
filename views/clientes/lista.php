<?php require_once 'views/cabecalho.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Gerenciamento de Clientes</h2>
    <a href="/clientes/cadastro" class="btn btn-primary">Novo Cliente</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $indice => $cliente): ?>
                <tr>
                    <td><?php echo $indice + 1; ?></td>
                    <td><?php echo htmlspecialchars($cliente->getNome()); ?></td>
                    <td><?php echo htmlspecialchars($cliente->getCpf()); ?></td>
                    <td><?php echo htmlspecialchars($cliente->getEmail()); ?></td>
                    <td><?php echo htmlspecialchars($cliente->getTelefone()); ?></td>
                    <td><?php echo htmlspecialchars($cliente->getEndereco()); ?></td>
                    <td class="text-end">
                        <a href="/clientes/cadastro?id=<?php echo $cliente->getId(); ?>" class="btn btn-sm btn-outline-secondary me-2">Editar</a>
                        <a href="/clientes/excluir?id=<?php echo $cliente->getId(); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir este cliente?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'views/rodape.php'; ?>
