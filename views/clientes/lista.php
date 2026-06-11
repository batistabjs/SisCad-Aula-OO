<h2>Gerenciamento de Clientes</h2>
<p><a href="index.php?page=/clientes/cadastro">Cadastrar Novo Cliente</a></p>

<table>
    <thead>
        <tr><th>#</th><th>Nome</th><th>CPF</th><th>E-mail</th><th>Telefone</th><th>Endereço</th><th>Ações</th></tr>
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
                <td>
                    <a href="index.php?page=/clientes/cadastro&id=<?php echo $cliente->getId(); ?>">Editar</a> | 
                    <a href="index.php?page=/clientes/excluir&id=<?php echo $cliente->getId(); ?>" onclick="return confirm('Excluir este cliente?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
