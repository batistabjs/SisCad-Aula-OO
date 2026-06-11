<?php
// models/ProdutoDAO.php
require_once "Produto.php";

class ProdutoDAO {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function save(Produto $produto) {
        try {
            if ($produto->getId()) {
                $stmt = $this->pdo->prepare('UPDATE produtos SET nome = ?, descricao = ?, preco = ?, estoque = ?, imagem = ? WHERE id = ?');
                $stmt->execute([$produto->getNome(), $produto->getDescricao(), $produto->getPreco(), $produto->getEstoque(), $produto->getImagem(), $produto->getId()]);
            } else {
                $stmt = $this->pdo->prepare('INSERT INTO produtos (nome, descricao, preco, estoque, imagem) VALUES (?, ?, ?, ?, ?)');
                $stmt->execute([$produto->getNome(), $produto->getDescricao(), $produto->getPreco(), $produto->getEstoque(), $produto->getImagem()]);
                $produto->setId($this->pdo->lastInsertId());
            }
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erro ao salvar produto: " . $e->getMessage());
        }
    }

    public function findById(int $id): ?Produto {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM produtos WHERE id = ?');
            $stmt->execute([$id]);
            $data = $stmt->fetch();
            return $data ? new Produto($data['id'], $data['nome'], $data['descricao'], $data['preco'], $data['estoque'], $data['imagem']) : null;
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar produto: " . $e->getMessage());
        }
    }

    public function findAll(): array {
        try {
            $stmt = $this->pdo->query('SELECT * FROM produtos ORDER BY nome');
            $produtos = [];
            while ($row = $stmt->fetch()) {
                $produtos[] = new Produto($row['id'], $row['nome'], $row['descricao'], $row['preco'], $row['estoque'], $row['imagem']);
            }
            return $produtos;
        } catch (PDOException $e) {
            throw new Exception("Erro ao listar produtos: " . $e->getMessage());
        }
    }

    public function delete(int $id): bool {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM produtos WHERE id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao excluir produto: " . $e->getMessage());
        }
    }
}
