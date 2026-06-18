<?php require_once 'views/cabecalho.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Gerenciamento de Contatos</h2>
    <a href="/contatos/cadastro" class="btn btn-primary">Novo Contato</a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="/contatos/lista" class="row g-3">
            <div class="col-auto">
                <input type="text" name="busca" class="form-control" placeholder="Pesquisar por nome ou e-mail..." value="<?= htmlspecialchars($busca ?? '') ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a href="/contatos/lista" class="btn btn-outline-secondary">Limpar</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contatos as $indice => $contato): ?>
                <tr>
                    <td><?php echo $indice + 1; ?></td>
                    <td><?php echo htmlspecialchars($contato->getNome()); ?></td>
                    <td><?php echo htmlspecialchars($contato->getEmail()); ?></td>
                    <td><?php echo htmlspecialchars($contato->getTelefone()); ?></td>
                    <td class="text-end">
                        <a href="/contatos/cadastro?id=<?php echo $contato->getId(); ?>" class="btn btn-sm btn-outline-secondary me-2">Editar</a>
                        <a href="/contatos/excluir?id=<?php echo $contato->getId(); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir este contato?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($totalPaginas > 1): ?>
    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <?php if ($pagina > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="/contatos/lista?pagina=<?php echo $pagina - 1; ?>&busca=<?php echo urlencode($busca); ?>">&laquo;</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?php echo ($i === $pagina) ? 'active' : ''; ?>">
                    <a class="page-link" href="/contatos/lista?pagina=<?php echo $i; ?>&busca=<?php echo urlencode($busca); ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($pagina < $totalPaginas): ?>
                <li class="page-item">
                    <a class="page-link" href="/contatos/lista?pagina=<?php echo $pagina + 1; ?>&busca=<?php echo urlencode($busca); ?>">&raquo;</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>

<?php require_once 'views/rodape.php'; ?>
