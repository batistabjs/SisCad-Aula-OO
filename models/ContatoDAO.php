<?php
// models/ContatoDAO.php
require_once "Contato.php";

class ContatoDAO {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function save(Contato $contato) {
        try {
            if ($contato->getId()) {
                $stmt = $this->pdo->prepare('UPDATE contatos SET nome = ?, email = ?, telefone = ? WHERE id = ?');
                $stmt->execute([$contato->getNome(), $contato->getEmail(), $contato->getTelefone(), $contato->getId()]);
            } else {
                $stmt = $this->pdo->prepare('INSERT INTO contatos (nome, email, telefone) VALUES (?, ?, ?)');
                $stmt->execute([$contato->getNome(), $contato->getEmail(), $contato->getTelefone()]);
                $contato->setId($this->pdo->lastInsertId());
            }
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erro ao salvar contato: " . $e->getMessage());
        }
    }

    public function findById(int $id): ?Contato {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM contatos WHERE id = ?');
            $stmt->execute([$id]);
            $data = $stmt->fetch();
            return $data ? new Contato($data['id'], $data['nome'], $data['email'], $data['telefone']) : null;
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar contato: " . $e->getMessage());
        }
    }

    public function findAll(string $busca = '', int $pagina = 1, int $porPagina = 10): array {
        try {
            $offset = ($pagina - 1) * $porPagina;
            $termo = '%' . $busca . '%';
            $stmt = $this->pdo->prepare('SELECT * FROM contatos WHERE nome LIKE ? OR email LIKE ? ORDER BY nome LIMIT ? OFFSET ?');
            $stmt->bindValue(1, $termo, PDO::PARAM_STR);
            $stmt->bindValue(2, $termo, PDO::PARAM_STR);
            $stmt->bindValue(3, $porPagina, PDO::PARAM_INT);
            $stmt->bindValue(4, $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            $contatos = [];
            while ($row = $stmt->fetch()) {
                $contatos[] = new Contato($row['id'], $row['nome'], $row['email'], $row['telefone']);
            }
            return $contatos;
        } catch (PDOException $e) {
            throw new Exception("Erro ao listar contatos: " . $e->getMessage());
        }
    }

    public function countAll(string $busca = ''): int {
        try {
            $termo = '%' . $busca . '%';
            $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM contatos WHERE nome LIKE ? OR email LIKE ?');
            $stmt->execute([$termo, $termo]);
            return (int)$stmt->fetchColumn();
        } catch (PDOException $e) {
            throw new Exception("Erro ao contar contatos: " . $e->getMessage());
        }
    }

    public function delete(int $id): bool {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM contatos WHERE id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao excluir contato: " . $e->getMessage());
        }
    }
}
