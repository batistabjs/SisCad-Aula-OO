<?php require_once 'views/cabecalho.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">Criar Novo Pedido</div>
            <div class="card-body p-4">
                <form method="POST" action="/pedidos/salvar">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="cliente_id" class="form-label">Cliente</label>
                            <select name="cliente_id" id="cliente_id" class="form-select" required>
                                <option value="">Selecione um cliente...</option>
                                <?php foreach ($clientes as $cliente): ?>
                                    <option value="<?= $cliente->getId(); ?>"><?= htmlspecialchars($cliente->getNome()); ?> (<?= htmlspecialchars($cliente->getCpf()); ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Data do Pedido</label>
                            <input type="text" class="form-control" value="<?= date('d/m/Y'); ?>" readonly>
                        </div>
                    </div>

                    <h5 class="mb-3">Produtos</h5>
                    <div id="produtos-container">
                        <div class="row g-2 mb-2 product-row">
                            <div class="col-md-4">
                                <select name="produtos[]" class="form-select product-select" required>
                                    <option value="">Selecione o produto...</option>
                                    <?php foreach ($produtos as $produto): ?>
                                        <option value="<?= $produto->getId(); ?>" data-preco="<?= $produto->getPreco(); ?>">
                                            <?= htmlspecialchars($produto->getNome()); ?> - R$ <?= number_format($produto->getPreco(), 2, ',', '.'); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="quantidades[]" class="form-control product-qty" placeholder="Qtd" min="1" value="1" required>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="precos[]" class="form-control product-price" placeholder="Preço" readonly>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text">Subtotal</span>
                                    <input type="text" class="form-control product-subtotal" readonly value="R$ 0,00">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-outline-danger w-100" onclick="removeRow(this)">×</button>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-primary mb-4" onclick="addRow()">+ Adicionar Produto</button>

                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <div class="card bg-light shadow-sm">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Total Geral:</h5>
                                    <h4 class="mb-0 text-primary fw-bold" id="grand-total">R$ 0,00</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/pedidos/lista" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary btn-lg">Finalizar Pedido</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function addRow() {
    const container = document.getElementById('produtos-container');
    const firstRow = document.querySelector('.product-row');
    const newRow = firstRow.cloneNode(true);
    
    // Limpar valores do novo input
    newRow.querySelector('.product-select').value = '';
    newRow.querySelector('.product-price').value = '';
    newRow.querySelector('.product-subtotal').value = 'R$ 0,00';
    
    container.appendChild(newRow);
    setupRowListeners(newRow);
}

function removeRow() {
    const rows = document.querySelectorAll('.product-row');
    if (rows.length > 1) {
        this.closest('.product-row').remove();
        calculateGrandTotal();
    } else {
        alert('O pedido deve conter ao menos um produto.');
    }
}

function setupRowListeners(row) {
    const select = row.querySelector('.product-select');
    const qtyInput = row.querySelector('.product-qty');
    const priceInput = row.querySelector('.product-price');
    const subtotalInput = row.querySelector('.product-subtotal');
    
    const updateSubtotal = () => {
        const price = parseFloat(priceInput.value.replace(',', '.'));
        const qty = parseInt(qtyInput.value) || 0;
        const subtotal = price * qty;
        subtotalInput.value = 'R$ ' + subtotal.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
        calculateGrandTotal();
    };

    select.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-preco');
        priceInput.value = price || '';
        updateSubtotal();
    });

    qtyInput.addEventListener('input', updateSubtotal);
}

function calculateGrandTotal() {
    let total = 0;
    document.querySelectorAll('.product-row').forEach(row => {
        const price = parseFloat(row.querySelector('.product-price').value.replace(',', '.'));
        const qty = parseInt(row.querySelector('.product-qty').value) || 0;
        total += (price * qty);
    });
    document.getElementById('grand-total').innerText = 'R$ ' + total.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
}

// Inicializar a primeira linha
document.querySelectorAll('.product-row').forEach(setupRowListeners);
</script>

<?php require_once 'views/rodape.php'; ?>
