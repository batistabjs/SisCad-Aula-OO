<h2><?php echo $cliente ? 'Editar' : 'Cadastrar'; ?> Cliente</h2>

<?php if (isset($erro)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($erro); ?></p>
<?php endif; ?>

<form method="POST" action="index.php?page=/clientes/salvar">
    <?php if ($cliente): ?>
        <input type="hidden" name="id" value="<?php echo $cliente->getId(); ?>">
    <?php endif; ?>
    <div style="margin-bottom: 10px;">
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($cliente ? $cliente->getNome() : ($_POST['nome'] ?? '')); ?>">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="cpf">CPF (000.000.000-00):</label><br>
        <input type="text" name="cpf" id="cpf" maxlength="14" value="<?php echo htmlspecialchars($cliente ? $cliente->getCpf() : ($_POST['cpf'] ?? '')); ?>">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="email">E-mail:</label><br>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($cliente ? $cliente->getEmail() : ($_POST['email'] ?? '')); ?>">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="telefone">Telefone:</label><br>
        <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($cliente ? $cliente->getTelefone() : ($_POST['telefone'] ?? '')); ?>">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="endereco">Endereço:</label><br>
        <input type="text" name="endereco" id="endereco" value="<?php echo htmlspecialchars($cliente ? $cliente->getEndereco() : ($_POST['endereco'] ?? '')); ?>">
    </div>
    <button type="submit">Salvar Cliente</button>
    <a href="index.php?page=/clientes/lista">Voltar</a>
</form>
