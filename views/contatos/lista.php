<h2>Gerenciamento de Contatos</h2>
<p><a href="index.php?page=/contatos/cadastro">Cadastrar Novo Contato</a></p>

<form method="GET" action="index.php" style="margin-bottom: 20px;">
    <input type="hidden" name="page" value="/contatos/lista">
    <input type="text" name="busca" placeholder="Pesquisar por nome ou e-mail..." value="'.htmlspecialchars($busca).'" style="width: 300px; padding: 5px;">
    <button type="submit">Buscar</button>
    <a href="index.php?page=/contatos/lista">Limpar</a>
</form>

<table>
    <thead>
        <tr><th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr>
    </thead>
    <tbody>
        <?php foreach ($contatos as $indice => $contato): ?>
            <tr>
                <td><?php echo $indice + 1; ?></td>
                <td><?php echo htmlspecialchars($contato->getNome()); ?></td>
                <td><?php echo htmlspecialchars($contato->getEmail()); ?></td>
                <td><?php echo htmlspecialchars($contato->getTelefone()); ?></td>
                <td>
                    <a href="index.php?page=/contatos/cadastro&id=<?php echo $contato->getId(); ?>">Editar</a> | 
                    <a href="index.php?page=/contatos/excluir&id=<?php echo $contato->getId(); ?>" onclick="return confirm('Excluir este contato?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if ($totalPaginas > 1): ?>
    <div style="margin-top: 20px;">
        <strong>Página <?php echo $pagina; ?> de <?php echo $totalPaginas; ?></strong> | 
        <?php if ($pagina > 1): ?>
            <a href="index.php?page=/contatos/lista&pagina=<?php echo $pagina - 1; ?>&busca=<?php echo urlencode($busca); ?>">&laquo; Anterior</a> 
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <a href="index.php?page=/contatos/lista&pagina=<?php echo $i; ?>&busca=<?php echo urlencode($busca); ?>" <?php echo ($i === $pagina) ? 'style="font-weight: bold; text-decoration: none; color: black;"' : ''; ?>> <?php echo $i; ?> </a>
        <?php endfor; ?>

        <?php if ($pagina < $totalPaginas): ?>
            <a href="index.php?page=/contatos/lista&pagina=<?php echo $pagina + 1; ?>&busca=<?php echo urlencode($busca); ?>">Próximo &raquo;</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
