<h2><?php echo $contato ? 'Editar' : 'Cadastrar'; ?> Contato</h2>

<?php if (isset($erro)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($erro); ?></p>
<?php endif; ?>

<form method="POST" action="/contatos/salvar">
    <?php if ($contato): ?>
        <input type="hidden" name="id" value="<?php echo $contato->getId(); ?>">
    <?php endif; ?>
    <div style="margin-bottom: 10px;">
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($contato ? $contato->getNome() : ($_POST['nome'] ?? '')); ?>">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="email">E-mail:</label><br>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($contato ? $contato->getEmail() : ($_POST['email'] ?? '')); ?>">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="telefone">Telefone:</label><br>
        <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($contato ? $contato->getTelefone() : ($_POST['telefone'] ?? '')); ?>">
    </div>
    <button type="submit">Salvar Contato</button>
    <a href="/contatos/lista">Voltar</a>
</form>
