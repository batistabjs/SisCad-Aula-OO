<?php
// models/PedidoDAO.php
require_once "Pedido.php";
require_once "PedidoItem.php";

class PedidoDAO {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function save(Pedido $pedido) {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare('INSERT INTO pedidos (cliente_id, valor_total) VALUES (?, ?)');
            $stmt->execute([$pedido->getClienteId(), $pedido->getValorTotal()]);
            $pedidoId = $this->pdo->lastInsertId();

            $stmtItem = $this->pdo->prepare('INSERT INTO pedidos_itens (pedido_id, produto_id, quantidade, preco_unitario) VALUES (?, ?, ?, ?)');
            foreach ($pedido->getItens() as $item) {
                $stmtItem->execute([$pedidoId, $item->getProdutoId(), $item->getQuantidade(), $item->getPrecoUnitario()]);
            }

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw new Exception("Erro ao salvar pedido: " . $e->getMessage());
        }
    }

    public function findAll(): array {
        try {
            $stmt = $this->pdo->query('SELECT p.*, c.nome as cliente_nome FROM pedidos p JOIN clientes c ON p.cliente_id = c.id ORDER BY p.data_pedido DESC');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Erro ao listar pedidos: " . $e->getMessage());
        }
    }

    public function findById(int $id): ?Pedido {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM pedidos WHERE id = ?');
            $stmt->execute([$id]);
            $data = $stmt->fetch();
            if (!$data) return null;

            $pedido = new Pedido($data['id'], $data['cliente_id'], $data['data_pedido'], $data['valor_total']);
            
            $stmtItens = $this->pdo->prepare('SELECT * FROM pedidos_itens WHERE pedido_id = ?');
            $stmtItens->execute([$id]);
            while ($itemData = $stmtItens->fetch()) {
                $item = new PedidoItem($itemData['id'], $itemData['pedido_id'], $itemData['produto_id'], $itemData['quantidade'], $itemData['preco_unitario']);
                $pedido->addItem($item);
            }
            
            return $pedido;
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar pedido: " . $e->getMessage());
        }
    }

    public function countAll(): int {
        return (int)$this->pdo->query('SELECT COUNT(*) FROM pedidos')->fetchColumn();
    }
}
